<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoScan AI - SMK Negeri 1 Tenggarong</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,900;1,400&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            background-color: #F8F9FA;
            color: #343A40;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #343A40;
        }

        button[aria-expanded="true"] .hamburger-icon {
            display: none !important;
        }
        button[aria-expanded="true"] .close-icon {
            display: block !important;
        }
        button[aria-expanded="false"] .hamburger-icon {
            display: block !important;
        }
        button[aria-expanded="false"] .close-icon {
            display: none !important;
        }
        el-disclosure:not([hidden]) {
            display: block;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col antialiased selection:bg-[#3F51B5]/30 selection:text-[#343A40]">

    <nav class="relative bg-[#343A40] border-b border-[#343A40]/80 sticky top-0 z-50 shadow-md">
        <div class="w-full px-4 sm:px-8">
            <div class="relative flex h-16 items-center justify-between">

                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button" command="--toggle" commandfor="mobile-menu-welcome" aria-expanded="false"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-white/10 focus:outline-2 focus:-outline-offset-1 focus:outline-[#CFCDFC]">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Buka menu utama</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="w-6 h-6 hamburger-icon">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="w-6 h-6 close-icon hidden">
                            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <a href="/" class="flex shrink-0 items-center gap-2 group">
                        <img src="{{ asset('images/logo_smk.png') }}" alt="Logo SMKN 1 Tenggarong" class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-110">                        <span class="text-base font-black tracking-tight text-white uppercase">Rash</span>
                    </a>
                    <div class="hidden sm:ml-8 sm:block">
                        <div class="flex space-x-1">
                            <a href="/" aria-current="page" class="rounded-md bg-white/15 px-3 py-2 text-sm font-semibold text-white">Live Scan</a>
                            <a href="/history" class="rounded-md px-3 py-2 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-colors">Riwayat</a>
                            <a href="/analytics" class="rounded-md px-3 py-2 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-colors">Statistik</a>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    @auth
                        <div class="relative ml-3">
                            <button type="button" 
                                onclick="const menu = this.nextElementSibling; menu.classList.toggle('hidden'); const closeMenu = (e) => { if (!menu.contains(e.target) && e.target !== this) { menu.classList.add('hidden'); document.removeEventListener('click', closeMenu); } }; document.addEventListener('click', closeMenu); event.stopPropagation();"
                                class="relative flex items-center gap-1.5 rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#CFCDFC] focus:outline-none">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Buka menu user</span>
                                <div class="size-8 rounded-full bg-[#3F51B5] flex items-center justify-center text-white text-xs font-bold uppercase">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline text-xs font-semibold text-white/80">{{ auth()->user()->name }}</span>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 top-full mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg border border-[#E9ECEF] z-50">
                                <div class="px-4 py-2 text-xs text-[#6C757D] border-b border-[#E9ECEF] truncate">{{ auth()->user()->email }}</div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-[#F23A2E] hover:bg-[#F8F9FA]">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="text-white/70 hover:text-white text-xs font-semibold transition px-2">
                            Register
                        </a>
                        <a href="{{ route('login') }}" class="ml-2 px-4 py-1.5 bg-[#3F51B5] hover:bg-[#7971EA] text-white rounded-[30px] text-xs font-semibold transition shadow-md">
                            Login
                        </a>
                    @endauth
                </div>

            </div>
        </div>

        <el-disclosure id="mobile-menu-welcome" hidden class="sm:hidden border-t border-white/10">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <a href="/" aria-current="page" class="block rounded-md bg-white/15 px-3 py-2 text-base font-semibold text-white">Live Scan</a>
                <a href="/history" class="block rounded-md px-3 py-2 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white">Riwayat</a>
                <a href="/analytics" class="block rounded-md px-3 py-2 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white">Statistik</a>
                @auth
                    <div class="border-t border-white/10 mt-2 pt-2">
                        <div class="px-3 py-1 text-xs text-white/50 truncate">{{ auth()->user()->email }}</div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block rounded-md px-3 py-2 text-base font-medium text-[#F23A2E] hover:bg-white/10">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white">Register</a>
                    <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-semibold text-white bg-[#3F51B5] hover:bg-[#7971EA]">Login</a>
                @endauth
            </div>
        </el-disclosure>
    </nav>

    <main class="flex-grow max-w-6xl w-full mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-4">
        <p id="status" class="text-[12px] font-medium inline-flex items-center gap-2 text-[#6C757D]">
            <span class="w-1.5 h-1.5 bg-[#17A2B8] rounded-full"></span>
            Menyiapkan mesin deteksi
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">

        <div class="lg:col-span-3 flex flex-col gap-4">

            <div class="w-full bg-white rounded-[16px] shadow-[0_2px_4px_rgba(0,0,0,0.075)] p-4 border border-[#E9ECEF] flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-[#343A40] uppercase tracking-wider">Mode Scan:</span>
                    <div class="relative inline-flex items-center bg-[#F1F2F4] rounded-full p-1 gap-1">
                        <input type="checkbox" id="modeToggle" class="hidden" checked>
                        <button type="button" id="modeBtnAuto"
                            class="px-3.5 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wide transition-all duration-200 bg-[#3F51B5] text-white shadow-sm">
                            Otomatis
                        </button>
                        <button type="button" id="modeBtnManual"
                            class="px-3.5 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wide transition-all duration-200 text-[#6C757D] hover:text-[#343A40]">
                            Manual
                        </button>
                    </div>
                </div>

                <button id="btnToggleCameraFacing" class="px-4 py-1.5 bg-[#6C757D] hover:bg-[#495057] text-white rounded-[30px] text-[11px] font-bold uppercase tracking-wide transition shadow-sm flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 15v-1a4 4 0 00-4-4H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Ganti Kamera
                </button>
            </div>

            <div class="w-full bg-white rounded-[16px] shadow-[0_2px_4px_rgba(0,0,0,0.075)] p-4 border border-[#E9ECEF] hover:shadow-[0_4px_10px_rgba(0,0,0,0.1)] transition-all duration-300 relative">

                <div id="videoContainer"
                    class="relative w-full aspect-video bg-[#222222] rounded-[12px] overflow-hidden border border-[#D1D5DB] flex items-center justify-center transition-all duration-300">

                    <div id="cameraFlash" class="absolute inset-0 bg-white opacity-0 pointer-events-none transition-opacity duration-150 z-30"></div>

                    <div id="cameraPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-[#6C757D] text-xs p-6 text-center z-20">
                        <svg class="animate-spin h-8 w-8 text-[#3F51B5] mb-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-[14px] font-semibold text-[#6C757D]">Menyiapkan kamera</span>
                    </div>

                    <video id="webcam" autoplay playsinline muted class="absolute inset-0 w-full h-full object-cover block opacity-0 transition-opacity duration-300"></video>

                    <img id="previewImage" class="hidden absolute inset-0 w-full h-full object-cover" alt="Preview File" />

                    <canvas id="overlay" class="absolute top-0 left-0 w-full h-full pointer-events-none z-10"></canvas>

                </div>

                <div class="mt-3 bg-[#F8F9FA] rounded-[12px] p-3 border border-[#E9ECEF] text-center relative overflow-hidden">
                    <div class="text-[12px] font-bold uppercase tracking-wider text-[#6C757D] mb-1">Deteksi Terakhir</div>
                    <div class="text-lg font-black text-[#3F51B5] tracking-tight transition-colors duration-200">
                        <span id="liveCategory" class="text-[#6C757D] uppercase tracking-wider text-xs">Belum ada objek terdeteksi</span>
                    </div>
                </div>

            </div>

            <button id="btnCaptureManual" class="w-full flex items-center justify-center gap-2 py-3 px-10 bg-[#3F51B5] hover:bg-[#7971EA] active:bg-[#1C4B82] text-white rounded-[30px] text-xs font-semibold uppercase tracking-wider transition-all duration-300 shadow-[0_2px_10px_rgba(0,0,0,0.1)] hover:shadow-[0_4px_14px_rgba(0,0,0,0.15)]">
                Ambil Foto Sekarang
            </button>

            <button id="btnSwitchCamera" class="hidden w-full flex items-center justify-center gap-2 py-3 px-10 bg-[#8BC34A] hover:bg-[#7CB342] text-white rounded-[30px] text-xs font-semibold uppercase tracking-wider transition-all duration-300 shadow-md">
                Lanjutkan Kamera Live
            </button>

        </div>

        <div class="lg:col-span-2 flex flex-col gap-4">

            <label id="uploadLabel" class="flex items-center justify-center w-full border border-dashed border-[#D1D5DB] bg-white hover:bg-[#F8F9FA] rounded-[16px] cursor-pointer transition duration-300 group py-4 px-4 h-[78px]">
                <svg class="w-6 h-6 text-[#3F51B5] shrink-0 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 7.5m0 0L7.5 12m4.5-4.5v9" />
                </svg>
                <div class="text-left">
                    <p class="text-[14px] font-semibold text-[#343A40]">
                        <span class="text-[#3F51B5] group-hover:underline">Unggah Gambar</span> atau seret kemari
                    </p>
                    <p class="text-[12px] text-[#6C757D] mt-0.5 italic opacity-80">PNG, JPG, JPEG (Maks. 5MB)</p>
                </div>
                <input id="fileInput" type="file" accept="image/*" class="hidden" />
            </label>

            <div class="bg-white border border-[#E9ECEF] rounded-[16px] p-4 text-left shadow-[0_2px_4px_rgba(0,0,0,0.075)]">
                <h4 class="text-[15.2px] font-bold text-[#343A40] mb-3 flex items-center gap-1.5">
                    <span class="text-lg">Objek yang Dikenali</span>
                </h4>
                <div class="text-[13.5px] text-[#6C757D] space-y-3 leading-relaxed">
                    <p>
                        <span class="inline-block text-[10px] font-bold tracking-wider uppercase text-[#8BC34A] bg-[#8BC34A]/10 px-2 py-0.5 rounded-full mr-1">Organik</span><br>
                        daun kering, sisa makanan, kulit buah, ranting, sayuran, cangkang telur, kertas/kardus basah
                    </p>
                    <p>
                        <span class="inline-block text-[10px] font-bold tracking-wider uppercase text-[#F23A2E] bg-[#F23A2E]/10 px-2 py-0.5 rounded-full mr-1">Anorganik</span><br>
                        botol plastik, kaleng minuman, kantong plastik, gelas kaca, sedotan, styrofoam, karet, kain bekas
                    </p>
                    <p>
                        <span class="inline-block text-[10px] font-bold tracking-wider uppercase text-[#F59E0B] bg-[#F59E0B]/10 px-2 py-0.5 rounded-full mr-1">B3 (Berbahaya)</span><br>
                        baterai bekas, lampu neon, botol parfum/semprotan, masker medis, jarum suntik, oli bekas, wadah detergen
                    </p>
                </div>
            </div>
        </div>

    </div>

</main>

    <footer class="bg-[#343A40] border-t border-[#6C757D]/30 py-6 text-center text-[12px] text-white/80 uppercase tracking-wider">
        <p>&copy; 2026 RASH. SMKN 1 TENGGARONG.</p>
    </footer>

    <script>
    const isAuthenticated = @json(auth()->check());

    const video = document.getElementById('webcam');
    const previewImage = document.getElementById('previewImage');
    const canvas = document.getElementById('overlay');
    const ctx = canvas.getContext('2d');
    const statusEl = document.getElementById('status');
    const videoContainer = document.getElementById('videoContainer');
    const cameraPlaceholder = document.getElementById('cameraPlaceholder');
    const fileInput = document.getElementById('fileInput');
    const btnSwitchCamera = document.getElementById('btnSwitchCamera');
    const btnCaptureManual = document.getElementById('btnCaptureManual');
    const btnToggleCameraFacing = document.getElementById('btnToggleCameraFacing');

    const modeToggle = document.getElementById('modeToggle');
    const modeBtnAuto = document.getElementById('modeBtnAuto');
    const modeBtnManual = document.getElementById('modeBtnManual');

    let currentFacingMode = "environment";

    function updateModeButtonsUI() {
        const activeClasses = ['bg-[#3F51B5]', 'text-white', 'shadow-sm'];
        const inactiveClasses = ['text-[#6C757D]'];

        if (modeToggle.checked) {
            modeBtnAuto.classList.add(...activeClasses);
            modeBtnAuto.classList.remove(...inactiveClasses);
            modeBtnManual.classList.remove(...activeClasses);
            modeBtnManual.classList.add(...inactiveClasses);
        } else {
            modeBtnManual.classList.add(...activeClasses);
            modeBtnManual.classList.remove(...inactiveClasses);
            modeBtnAuto.classList.remove(...activeClasses);
            modeBtnAuto.classList.add(...inactiveClasses);
        }
    }

    modeBtnAuto.addEventListener('click', () => {
        if (modeToggle.checked) return;
        modeToggle.checked = true;
        updateModeButtonsUI();
        modeToggle.dispatchEvent(new Event('change'));
    });

    modeBtnManual.addEventListener('click', () => {
        if (!modeToggle.checked) return;
        modeToggle.checked = false;
        updateModeButtonsUI();
        modeToggle.dispatchEvent(new Event('change'));
    });

    updateModeButtonsUI();

function syncCanvasSize() {
    const rect = videoContainer.getBoundingClientRect();
    if (rect.width > 0 && rect.height > 0) {
        canvas.width = Math.round(rect.width);
        canvas.height = Math.round(rect.height);
    }
}

function getContentRenderRect(srcW, srcH) {
    const dw = canvas.width;
    const dh = canvas.height;
    if (!srcW || !srcH || !dw || !dh) return null;
    
    const scale = Math.max(dw / srcW, dh / srcH);
    const rw = srcW * scale;
    const rh = srcH * scale;
    return { x: (dw - rw) / 2, y: (dh - rh) / 2, w: rw, h: rh, scale };
}

let lastSpokenText = "";
let speechThrottleTimeout = false;
let isStaticMode = false;
let isFrozen = false;

let lastSavedCategory = "";
let lastSavedTime = 0;
let categoryThrottleTimestamps = {};
let liveLoopTimeoutId = null;

const CATEGORY_STYLE = {
    organik:   { label: "Sampah Organik",   color: "#10B981", emoji: "🍂" },
    anorganik: { label: "Sampah Anorganik", color: "#EF4444", emoji: "🧴" },
    b3:        { label: "Sampah B3",        color: "#F59E0B", emoji: "⚠️" },
};

const PREDICT_CONFIDENCE_THRESHOLD = 0.5;

async function callPredictAPI(blob) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const formData = new FormData();
    formData.append('image', blob, 'snapshot.jpg');

    const res = await fetch('/api/predict', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData,
    });

    if (!res.ok) throw new Error('Predict API error: ' + res.status);
    return res.json();
}

function frameToBlob(source, width, height) {
    return new Promise((resolve) => {
        const tmp = document.createElement('canvas');
        tmp.width = width;
        tmp.height = height;
        tmp.getContext('2d').drawImage(source, 0, 0, width, height);
        tmp.toBlob((blob) => resolve(blob), 'image/jpeg', 0.85);
    });
}

function renderPredictionToCanvas(result, canvasWidth, canvasHeight) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    if (!result || result.confidence < PREDICT_CONFIDENCE_THRESHOLD) {
        return null;
    }

    const style = CATEGORY_STYLE[result.class] || { label: result.class, color: "#6366F1", emoji: "" };
    const labelText = `${style.emoji} ${style.label} (${(result.confidence * 100).toFixed(0)}%)`;

    if (result.bbox) {
        const rr = getContentRenderRect(result.image_width, result.image_height);
        if (rr) {
            const x = rr.x + result.bbox.x * rr.scale;
            const y = rr.y + result.bbox.y * rr.scale;
            const w = result.bbox.width * rr.scale;
            const h = result.bbox.height * rr.scale;

            ctx.strokeStyle = style.color;
            ctx.lineWidth = 3;
            ctx.strokeRect(x, y, w, h);

            const lblW = Math.min(w, 210);
            const lblH = 26;
            ctx.fillStyle = style.color;
            ctx.fillRect(x, Math.max(rr.y, y - lblH), lblW, lblH);

            ctx.fillStyle = "#FFFFFF";
            ctx.font = "bold 12px sans-serif";
            ctx.fillText(labelText, x + 5, Math.max(rr.y + 17, y - 8));
        }
    }

    return labelText;
}

async function setupCamera() {
    const constraintsList = [
        { video: { facingMode: currentFacingMode, width: { ideal: 640 }, height: { ideal: 480 } }, audio: false },
        { video: { facingMode: currentFacingMode }, audio: false },
        { video: true, audio: false }
    ];

    let stream = null;
    let lastError = null;

    for (const constraints of constraintsList) {
        try {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                stream = await navigator.mediaDevices.getUserMedia(constraints);
                if (stream) break;
            }
        } catch (err) {
            console.warn("Constraint failed:", constraints, err);
            lastError = err;
        }
    }

    if (!stream) {
        const errorMsg = lastError ? lastError.message : "Kamera tidak didukung atau tidak ditemukan.";
        showCameraError(errorMsg);
        throw lastError || new Error("Kamera tidak ditemukan");
    }

    video.srcObject = stream;

    return new Promise((resolve) => {
        video.onloadedmetadata = () => {
            video.play().then(() => resolve(video)).catch(err => {
                console.error("Gagal memutar stream video:", err);
                resolve(video);
            });
        };
        setTimeout(() => {
            if (video.videoWidth > 0) resolve(video);
        }, 2000);
    });
}

function stopCamera() {
    if (video.srcObject) {
        video.srcObject.getTracks().forEach(track => track.stop());
        video.srcObject = null;
    }
}

function showCameraError(msg) {
    if (cameraPlaceholder) {
        cameraPlaceholder.innerHTML = `
            <div class="p-4 text-center">
                <span class="text-3xl block mb-2">⚠️</span>
                <p class="text-xs font-bold text-red-500 mb-1">Akses Kamera Gagal</p>
                <p class="text-[10px] text-gray-500 max-w-[240px] mx-auto mb-3">${msg}</p>
                <button onclick="window.location.reload()" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-[10px] font-semibold transition">
                    Coba Lagi
                </button>
            </div>
        `;
    }
    statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Akses Kamera Gagal!`;
    statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-red-500/10 text-red-400 border border-red-500/20 px-3.5 py-1.5 rounded-full animate-none";
}

async function main() {
    try {
        statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Menghubungkan Kamera...`;
        await setupCamera();

        if (cameraPlaceholder) cameraPlaceholder.classList.add('hidden');
        video.classList.remove('opacity-0');

        updateStatusTextByMode();
        syncCanvasSize();

        liveTrackLoop();
    } catch (err) {
        console.error("Inisialisasi aplikasi gagal:", err);
        if (!statusEl.innerText.includes("Gagal")) {
            showCameraError(err.message || "Gagal memuat tracker.");
        }
    }
}

function updateStatusTextByMode() {
    if (isStaticMode) return;
    if (modeToggle.checked) {
        statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Live AI Tracker Aktif (Mode Otomatis)`;
        statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-green-500/10 text-green-400 border border-green-500/20 px-3.5 py-1.5 rounded-full animate-none";
    } else {
        statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Kamera Siap (Mode Manual)`;
        statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 px-3.5 py-1.5 rounded-full animate-none";
    }
}

async function liveTrackLoop() {
    if (liveLoopTimeoutId) clearTimeout(liveLoopTimeoutId);

    if (isStaticMode || isFrozen) {
        liveLoopTimeoutId = setTimeout(liveTrackLoop, 100);
        return;
    }

    if (video.readyState >= 2) {
        syncCanvasSize();

        try {
            const blob = await frameToBlob(video, video.videoWidth, video.videoHeight);
            const result = await callPredictAPI(blob);
            const labelText = renderPredictionToCanvas(result, canvas.width, canvas.height);

            const liveCategoryEl = document.getElementById('liveCategory');
            if (liveCategoryEl) {
                liveCategoryEl.innerText = labelText || "Menunggu Objek...";
            }

            if (labelText && result.confidence > PREDICT_CONFIDENCE_THRESHOLD) {
                const style = CATEGORY_STYLE[result.class];
                
                if (modeToggle.checked) {
                    autoSnapshotHandler(result.class, style ? style.label : result.class, result.confidence, true);
                }
            }
        } catch (err) {
            console.error("Live predict error:", err);
        }
    }

    liveLoopTimeoutId = setTimeout(liveTrackLoop, 100);
}

modeToggle.addEventListener('change', () => {
    updateStatusTextByMode();
    if (!modeToggle.checked) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
});

btnToggleCameraFacing.addEventListener('click', async () => {
    if (isStaticMode) return;
    
    currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
    
    statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Mengubah Kamera...`;
    statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3.5 py-1.5 rounded-full animate-pulse";
    
    stopCamera();
    
    try {
        await setupCamera();
        updateStatusTextByMode();
        syncCanvasSize();
    } catch (err) {
        console.error("Ganti kamera gagal:", err);
    }
});

function triggerCameraFlashAndFreeze(isAuto = false) {
    const flash = document.getElementById('cameraFlash');
    if (flash) {
        flash.classList.remove('opacity-0');
        flash.classList.add('opacity-85');
        setTimeout(() => flash.classList.replace('opacity-85', 'opacity-0'), 150);
    }

    isFrozen = true;
    video.pause();

    if (isAuto) {
        setTimeout(() => {
            if (isFrozen && !isStaticMode) resumeCameraLive();
        }, 1500);
    } else {
        btnSwitchCamera.classList.remove('hidden');
        btnCaptureManual.classList.add('hidden');
    }
}

function resumeCameraLive() {
    isFrozen = false;
    video.play().then(() => {
        btnSwitchCamera.classList.add('hidden');
        btnCaptureManual.classList.remove('hidden');
        updateStatusTextByMode();
    }).catch(err => console.error("Resume failed:", err));
}

btnCaptureManual.addEventListener('click', async () => {
    if (isStaticMode || isFrozen) return;

    triggerCameraFlashAndFreeze(false);

    statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Menganalisis Snapshot...`;
    statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-3.5 py-1.5 rounded-full animate-none";

    try {
        syncCanvasSize();

        const blob = await frameToBlob(video, video.videoWidth, video.videoHeight);
        const result = await callPredictAPI(blob);
        const labelText = renderPredictionToCanvas(result, canvas.width, canvas.height);

        if (labelText) {
            const style = CATEGORY_STYLE[result.class];
            speakCategory(style ? style.label : result.class);
            autoSnapshotHandler(result.class, style ? style.label : result.class, result.confidence, false);
        }

        statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Snapshot Manual Selesai`;
        statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-green-500/10 text-green-400 border border-green-500/20 px-3.5 py-1.5 rounded-full animate-none";

        const liveCategoryEl = document.getElementById('liveCategory');
        if (liveCategoryEl) {
            liveCategoryEl.innerText = labelText || "Tidak ada objek sampah terdeteksi.";
        }
    } catch (err) {
        console.error("Manual detection error:", err);
    }
});

fileInput.addEventListener('change', async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    isStaticMode = true;
    stopCamera();

    video.classList.add('hidden');
    previewImage.classList.remove('hidden');
    btnSwitchCamera.classList.remove('hidden');
    btnCaptureManual.classList.add('hidden');
    if (cameraPlaceholder) cameraPlaceholder.classList.add('hidden');

    statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Menganalisis Gambar...`;
    statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-3.5 py-1.5 rounded-full animate-none";

    const reader = new FileReader();
    reader.onload = (event) => {
        previewImage.src = event.target.result;
        previewImage.onload = async () => {
            await runStaticDetection(file);
        };
    };
    reader.readAsDataURL(file);
});

async function runStaticDetection(originalFile) {
    if (!isStaticMode) return;

    syncCanvasSize();

    try {
        const result = await callPredictAPI(originalFile);
        const labelText = renderPredictionToCanvas(result, canvas.width, canvas.height);

        if (labelText) {
            const style = CATEGORY_STYLE[result.class];
            speakCategory(style ? style.label : result.class);
            autoSnapshotHandler(result.class, style ? style.label : result.class, result.confidence, false);
        }

        statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Analisis File Selesai`;
        statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-green-500/10 text-green-400 border border-green-500/20 px-3.5 py-1.5 rounded-full animate-none";

        const liveCategoryEl = document.getElementById('liveCategory');
        if (liveCategoryEl) {
            liveCategoryEl.innerText = labelText || "Tidak ada sampah terdeteksi.";
        }
    } catch (err) {
        console.error("Static image analysis error:", err);
        statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Gagal Analisis Gambar`;
        statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-red-500/10 text-red-400 border border-red-500/20 px-3.5 py-1.5 rounded-full animate-none";
    }
}

    btnSwitchCamera.addEventListener('click', () => {
        if (isStaticMode) {
            isStaticMode = false;
            fileInput.value = ""; 
            previewImage.classList.add('hidden');
            video.classList.remove('hidden');
            if (cameraPlaceholder) cameraPlaceholder.classList.remove('hidden');

            statusEl.innerHTML = `<span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Menghubungkan Kamera...`;
            statusEl.className = "text-xs font-semibold inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3.5 py-1.5 rounded-full animate-pulse";

            setupCamera().then(() => {
                if (cameraPlaceholder) cameraPlaceholder.classList.add('hidden');
                video.classList.remove('opacity-0');
                updateStatusTextByMode();

                syncCanvasSize();

                isFrozen = false;
                btnCaptureManual.classList.remove('hidden');
                btnSwitchCamera.classList.add('hidden');
                liveTrackLoop();
            }).catch(err => console.error("Webcam reconnect failed:", err));
        } else {
            resumeCameraLive();
        }
    });

    function autoSnapshotHandler(objectName, category, score, needsVisualFreeze = false) {
        const now = Date.now();

        if (category === lastSavedCategory && (now - lastSavedTime) < 10000) {
            return;
        }

        const lastCategoryThrottle = categoryThrottleTimestamps[category] || 0;
        if ((now - lastCategoryThrottle) < 10000) {
            return;
        }
        
        lastSavedCategory = category;
        lastSavedTime = now;
        categoryThrottleTimestamps[category] = now;

        if (needsVisualFreeze && !isStaticMode && !isFrozen) {
            triggerCameraFlashAndFreeze(true); 
        }

        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = 120;
        tempCanvas.height = 90;
        const tempCtx = tempCanvas.getContext('2d');
        
        if (isStaticMode) {
            tempCtx.drawImage(previewImage, 0, 0, tempCanvas.width, tempCanvas.height);
        } else {
            tempCtx.drawImage(video, 0, 0, tempCanvas.width, tempCanvas.height);
        }
        const thumbnail = tempCanvas.toDataURL('image/jpeg', 0.6);
        
        const recordUuid = 'scan_' + now + '_' + Math.random().toString(36).substr(2, 9);
        const recordTimestamp = new Date().toLocaleString('id-ID', { 
            year: 'numeric', month: '2-digit', day: '2-digit',
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        });

        const newRecord = {
            uuid: recordUuid,
            timestamp: recordTimestamp,
            objectName: objectName,
            category: category,
            score: Math.round(score * 100),
            thumbnail: thumbnail,
            isPermanent: false
        };

        const history = JSON.parse(localStorage.getItem('ecoscan_history') || '[]');
        history.unshift(newRecord);
        localStorage.setItem('ecoscan_history', JSON.stringify(history));

        if (isAuthenticated) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            fetch('/api/scans', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    uuid: recordUuid,
                    object_name: objectName,
                    category: category,
                    score: Math.round(score * 100),
                    thumbnail: thumbnail,
                    is_permanent: false
                })
            })
            .then(res => {
                if (!res.ok) throw new Error("HTTP error " + res.status);
                return res.json();
            })
            .then(data => {
                console.log("Scan record persisted to database:", data);
            })
            .catch(err => {
                console.error("Failed to persist scan record to database:", err);
            });
        }
        
        showAutoSnapshotNotification(newRecord);
    }

    let notificationTimeout = null;

    function showAutoSnapshotNotification(record) {
        const existing = document.getElementById('snapshotNotification');
        if (existing) {
            existing.remove();
        }
        if (notificationTimeout) {
            clearTimeout(notificationTimeout);
        }
        
        const toast = document.createElement('div');
        toast.id = 'snapshotNotification';
        toast.className = 'fixed bottom-4 right-4 bg-white border border-[#E9ECEF] text-[#343A40] rounded-[16px] p-3 shadow-[0_2px_10px_rgba(0,0,0,0.1)] z-50 flex items-center gap-3 max-w-sm transition-all duration-300 transform translate-y-10 opacity-0';
        
        toast.innerHTML = `
            <div class="w-12 h-12 rounded-[12px] overflow-hidden border border-[#E9ECEF] flex-shrink-0 bg-[#F8F9FA]">
                <img src="${record.thumbnail}" class="w-full h-full object-cover" />
            </div>
            <div class="flex-grow">
                <p class="text-[10px] text-[#6C757D] font-semibold uppercase tracking-wider">📸 Auto-Snapshot</p>
                <p class="text-[14px] font-bold text-[#3F51B5] leading-tight">${record.category} (${record.objectName})</p>
                <p class="text-[11px] text-[#6C757D]">Akurasi: ${record.score}%</p>
            </div>
            <div class="flex flex-col gap-1 flex-shrink-0">
                <button id="btnKeepPermanent" class="px-3 py-1 bg-[#3F51B5] hover:bg-[#7971EA] text-white rounded-[30px] text-[10px] font-semibold transition">
                    Simpan
                </button>
                <button id="btnCloseNotification" class="px-3 py-1 bg-[#F8F9FA] hover:bg-[#E9ECEF] text-[#343A40] rounded-[30px] text-[10px] font-medium transition">
                    Abaikan
                </button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
        }, 100);
        
        document.getElementById('btnKeepPermanent').addEventListener('click', () => {
            const history = JSON.parse(localStorage.getItem('ecoscan_history') || '[]');
            const updated = history.map(item => {
                if (item.uuid === record.uuid) {
                    item.isPermanent = true;
                }
                return item;
            });
            localStorage.setItem('ecoscan_history', JSON.stringify(updated));

            if (isAuthenticated) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch(`/api/scans/${record.uuid}/toggle-permanent`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(res => res.json())
                .then(data => console.log("Database status updated permanent:", data))
                .catch(err => console.error("Database permanent update failed:", err));
            }
            
            const titleEl = toast.querySelector('p');
            if (titleEl) titleEl.innerHTML = '✅ Berhasil Disimpan!';
            toast.querySelector('#btnKeepPermanent').disabled = true;
            toast.querySelector('#btnKeepPermanent').classList.replace('bg-indigo-600', 'bg-emerald-600');
            toast.querySelector('#btnKeepPermanent').innerText = 'Tersimpan';
            
            setTimeout(() => {
                dismissToast(toast);
            }, 1200);
        });
        
        document.getElementById('btnCloseNotification').addEventListener('click', () => {
            dismissToast(toast);
        });
        
        notificationTimeout = setTimeout(() => {
            dismissToast(toast);
        }, 5000);
    }

    function dismissToast(toast) {
        toast.classList.add('translate-y-10', 'opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }

    function speakCategory(kategori) {
        if (speechThrottleTimeout || lastSpokenText === kategori) return;

        speechThrottleTimeout = true;
        lastSpokenText = kategori;

        if (window.speechSynthesis) {
            window.speechSynthesis.cancel();
        }

        const utterance = new SpeechSynthesisUtterance(kategori);
        utterance.lang = 'id-ID';
        utterance.rate = 1.0;

        window.speechSynthesis.speak(utterance);

        setTimeout(() => {
            speechThrottleTimeout = false;
        }, 5000);
    }

    window.addEventListener('DOMContentLoaded', main);
    window.addEventListener('resize', syncCanvasSize);
    </script>
</body>

</html>