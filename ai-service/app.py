import os
os.environ["TF_CPP_MIN_LOG_LEVEL"] = "3"

import json
import numpy as np
import cv2
from flask import Flask, request, jsonify
from PIL import Image
import tensorflow as tf
from tensorflow.keras.applications.efficientnet import preprocess_input

MODEL_PATH = os.environ.get("MODEL_PATH", "best_efficientnet.keras")
CLASS_NAMES_PATH = os.environ.get("CLASS_NAMES_PATH", "class_names.json")
IMG_SIZE = (224, 224)

app = Flask(__name__)

print(f"[startup] Loading model dari {MODEL_PATH} ...")
model = tf.keras.models.load_model(
    MODEL_PATH,
    safe_mode=False,
    custom_objects={"preprocess_input": preprocess_input},
)

with open(CLASS_NAMES_PATH, "r") as f:
    class_names = json.load(f)

print(f"[startup] Model loaded. Class names: {class_names}")

def preprocess_pil_image(img: Image.Image):
    img_resized = img.resize(IMG_SIZE)
    img_array = np.array(img_resized, dtype=np.float32)
    img_array = np.expand_dims(img_array, axis=0)
    return img_array

def detect_object_bbox(img: Image.Image, min_area_ratio=0.02):
    
    img_np = np.array(img.convert("RGB"))
    gray = cv2.cvtColor(img_np, cv2.COLOR_RGB2GRAY)
    blur = cv2.GaussianBlur(gray, (7, 7), 0)

    _, thresh = cv2.threshold(blur, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)
    thresh_inv = cv2.bitwise_not(thresh)

    h_img, w_img = gray.shape
    total_area = h_img * w_img

    def cari_kontur_terbesar(mask):
        kernel = np.ones((9, 9), np.uint8)
        mask = cv2.morphologyEx(mask, cv2.MORPH_CLOSE, kernel)
        kontur, _ = cv2.findContours(mask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
        if not kontur:
            return None
        terbesar = max(kontur, key=cv2.contourArea)
        area = cv2.contourArea(terbesar)
        return terbesar, area

    kandidat = []
    for mask in (thresh, thresh_inv):
        hasil = cari_kontur_terbesar(mask)
        if hasil is not None:
            kandidat.append(hasil)

    if not kandidat:
        return None

    valid = [
        (kontur, area) for kontur, area in kandidat
        if min_area_ratio * total_area <= area <= 0.95 * total_area
    ]
    if not valid:
        return None

    kontur_pilihan, _ = max(valid, key=lambda pair: pair[1])
    x, y, w, h = cv2.boundingRect(kontur_pilihan)

    margin = int(0.03 * max(w_img, h_img))
    x = max(0, x - margin)
    y = max(0, y - margin)
    w = min(w_img - x, w + 2 * margin)
    h = min(h_img - y, h + 2 * margin)

    return (int(x), int(y), int(w), int(h))

@app.route("/health", methods=["GET"])
def health():
    return jsonify({"status": "ok", "classes": class_names})

@app.route("/predict", methods=["POST"])
def predict():
    if "image" not in request.files:
        return jsonify({"error": "Field 'image' (file) tidak ditemukan di request."}), 400

    file = request.files["image"]

    try:
        img = Image.open(file.stream).convert("RGB")
    except Exception as e:
        return jsonify({"error": f"Gagal membaca gambar: {str(e)}"}), 400

    img_array = preprocess_pil_image(img)
    prediction = model.predict(img_array, verbose=0)[0]

    idx = int(np.argmax(prediction))
    predicted_class = class_names[idx]
    confidence = float(prediction[idx])

    probabilities = {
        class_names[i]: float(prediction[i]) for i in range(len(class_names))
    }

    bbox = detect_object_bbox(img)
    bbox_json = None
    if bbox is not None:
        x, y, w, h = bbox
        bbox_json = {"x": x, "y": y, "width": w, "height": h}

    return jsonify({
        "class": predicted_class,
        "confidence": confidence,
        "probabilities": probabilities,
        "bbox": bbox_json,
        "image_width": img.width,
        "image_height": img.height,
    })

if __name__ == "__main__":
    port = int(os.environ.get("PORT", 8000))
    app.run(host="0.0.0.0", port=port)