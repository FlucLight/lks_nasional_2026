import os
os.environ["TF_CPP_MIN_LOG_LEVEL"] = "3"
from flask import Flask, request, jsonify
from PIL import Image
from ultralytics import YOLO

YOLO_MODEL_PATH = os.environ.get("YOLO_MODEL_PATH", "best_yolo.pt")
YOLO_CONFIDENCE_THRESHOLD = 0.5

app = Flask(__name__)

print(f"[startup] Loading YOLO dari {YOLO_MODEL_PATH} ...")
yolo_model = YOLO(YOLO_MODEL_PATH)
print(f"[startup] YOLO loaded. Class names: {yolo_model.names}")


@app.route("/health", methods=["GET"])
def health():
    return jsonify({
        "status": "ok",
        "yolo_classes": yolo_model.names,
    })


@app.route("/detect", methods=["POST"])
def detect():
    if "image" not in request.files:
        return jsonify({"error": "Field 'image' (file) tidak ditemukan di request."}), 400

    file = request.files["image"]
    try:
        img = Image.open(file.stream).convert("RGB")
    except Exception as e:
        return jsonify({"error": f"Gagal membaca gambar: {str(e)}"}), 400

    results = yolo_model.predict(img, conf=YOLO_CONFIDENCE_THRESHOLD, verbose=False)
    boxes = results[0].boxes.xyxy.cpu().numpy()
    yolo_confs = results[0].boxes.conf.cpu().numpy()
    yolo_cls_ids = results[0].boxes.cls.cpu().numpy()

    predictions = []
    for box, conf, cls_id in zip(boxes, yolo_confs, yolo_cls_ids):
        x1, y1, x2, y2 = map(int, box)
        if x2 <= x1 or y2 <= y1:
            continue

        predictions.append({
            "bbox": [x1, y1, x2, y2],
            "class": yolo_model.names[int(cls_id)],
            "confidence": float(conf),
        })

    return jsonify({"predictions": predictions})


if __name__ == "__main__":
    port = int(os.environ.get("PORT", 8000))
    app.run(host="0.0.0.0", port=port)