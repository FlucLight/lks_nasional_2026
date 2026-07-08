<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Negeri 1 Tenggarong RASH</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon-192.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/favicon-192.png') }}">

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
                    <button type="button" command="--toggle" commandfor="mobile-menu-history" aria-expanded="false"
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
                        <img src="{{ asset('images/logo_smk.png') }}" alt="Logo SMKN 1 Tenggarong" class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-110">                        
                        <span class="text-base font-black tracking-tight text-white uppercase">Rash</span>
                    </a>
                    <div class="hidden sm:ml-8 sm:block">
                        <div class="flex space-x-1">
                            <a href="/" class="rounded-md px-3 py-2 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-colors">Live Scan</a>
                            <a href="/history" aria-current="page" class="rounded-md bg-white/15 px-3 py-2 text-sm font-semibold text-white">Riwayat</a>
                            <a href="/analytics" class="rounded-md px-3 py-2 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-colors">Statistik</a>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
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
                </div>

            </div>
        </div>

        <el-disclosure id="mobile-menu-history" hidden class="sm:hidden border-t border-white/10">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <a href="/" class="block rounded-md px-3 py-2 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white">Live Scan</a>
                <a href="/history" aria-current="page" class="block rounded-md bg-white/15 px-3 py-2 text-base font-semibold text-white">Riwayat</a>
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
                @endauth
            </div>
        </el-disclosure>
    </nav>

    <main class="flex-grow max-w-4xl w-full mx-auto px-4 py-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-[32px] font-bold tracking-tight text-[#343A40] leading-[38.4px]">
                Riwayat Deteksi Sampah
            </h1>
            <p class="text-[14.08px] text-[#6C757D] mt-1">
                Daftar sampah yang berhasil dideteksi oleh kamera Anda dan tersimpan secara otomatis.
            </p>
        </div>
    </div>

    <div class="flex border-b border-[#E9ECEF] gap-6 mb-6 text-[14px] font-semibold">
        <button id="tabAll" class="border-b-2 border-[#3F51B5] pb-2 text-[#3F51B5] transition-all">
            Semua Snapshot (<span id="countAll">0</span>)
        </button>
        <button id="tabPermanent" class="border-b-2 border-transparent pb-2 text-[#6C757D] hover:text-[#343A40] transition-all">
            Galeri Permanen (<span id="countPermanent">0</span>)
        </button>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 -mx-1 px-1 sm:mx-0 sm:px-0 sm:flex-wrap scrollbar-hide">
            <span class="text-[11px] font-bold text-[#6C757D] uppercase tracking-wider mr-1 shrink-0">Kategori:</span>
            <button data-category-filter="all" class="category-filter-btn shrink-0 px-3 py-1 rounded-[30px] text-[11px] font-semibold border transition bg-[#3F51B5] text-white border-[#3F51B5]">
                Semua
            </button>
            <button data-category-filter="organik" class="category-filter-btn shrink-0 px-3 py-1 rounded-[30px] text-[11px] font-semibold border transition bg-white text-[#6C757D] border-[#D1D5DB] hover:bg-[#F8F9FA]">
                🍂 Organik
            </button>
            <button data-category-filter="anorganik" class="category-filter-btn shrink-0 px-3 py-1 rounded-[30px] text-[11px] font-semibold border transition bg-white text-[#6C757D] border-[#D1D5DB] hover:bg-[#F8F9FA]">
                🧴 Anorganik
            </button>
            <button data-category-filter="b3" class="category-filter-btn shrink-0 px-3 py-1 rounded-[30px] text-[11px] font-semibold border transition bg-white text-[#6C757D] border-[#D1D5DB] hover:bg-[#F8F9FA]">
                ⚠️ B3
            </button>
        </div>

        <div class="flex items-center gap-1.5 sm:ml-auto">
            <span class="text-[11px] font-bold text-[#6C757D] uppercase tracking-wider shrink-0">Urutkan:</span>
            <select id="sortSelect" class="flex-1 sm:flex-none text-[11px] font-semibold border border-[#D1D5DB] rounded-[30px] px-3 py-1.5 bg-white text-[#343A40] focus:outline-none focus:ring-2 focus:ring-[#3F51B5]/30 cursor-pointer">
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="score_desc">Akurasi Tertinggi</option>
                <option value="score_asc">Akurasi Terendah</option>
            </select>
        </div>
    </div>

    <div id="historyContainer" class="bg-white rounded-[12px] border border-[#E9ECEF] overflow-hidden">

        <div class="px-6 py-5 flex items-center justify-between border-b border-[#E9ECEF]">
            <div>
                <h2 class="text-base font-bold text-[#343A40]">Daftar Deteksi</h2>
                <p class="text-[13px] text-[#6C757D] mt-0.5">Riwayat lengkap objek yang berhasil dipindai kamera.</p>
            </div>
            <div class="flex items-center gap-2">
            <button id="btnClearAll" class="px-5 py-2 border border-[#D1D5DB] hover:bg-[#F8F9FA] text-[#F23A2E] rounded-[30px] text-xs font-semibold transition-all duration-300">
                Hapus Semua Log
            </button>
        </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#E9ECEF]">
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Preview</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Jenis Sampah</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Akurasi</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Waktu Scan</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] text-right whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="historyList">

                </tbody>
            </table>
        </div>

        <div id="paginationFooter" class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-[#E9ECEF] bg-[#F8F9FA]/50">
            <div class="flex items-center gap-2 text-xs text-[#6C757D]">
                <span>Tampilkan:</span>
                <button id="btnSize5" class="px-3 py-1 rounded-[30px] font-semibold border transition duration-200 bg-[#3F51B5] text-white border-[#3F51B5]">5</button>
                <button id="btnSize15" class="px-3 py-1 rounded-[30px] font-semibold border transition duration-200 bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]">15</button>
            </div>
            <div id="paginationButtons" class="flex items-center gap-1">
                
            </div>
        </div>

        <div id="emptyState" class="hidden flex flex-col items-center justify-center p-12 text-center text-[#6C757D]">
            <svg class="w-12 h-12 text-[#6C757D] mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <h3 class="text-[15.2px] font-bold text-[#343A40]">Belum ada riwayat scan</h3>
            <p class="text-[14.08px] text-[#6C757D] mt-1 mx-auto max-w-[280px] leading-relaxed">
                Kamera belum mendeteksi sampah organik/anorganik/B3 dengan akurasi kuat.
            </p>
            <a href="/" class="mt-4 px-6 py-2 bg-[#3F51B5] hover:bg-[#7971EA] text-white rounded-[30px] text-xs font-semibold transition shadow-md">
                Mulai Scan Sekarang
            </a>
        </div>
    </div>

<div id="previewModal" class="fixed inset-0 bg-[#343A40]/80 backdrop-blur-sm z-50 flex items-center justify-center hidden transition-opacity duration-300 opacity-0 p-4">
    <div class="relative max-w-3xl w-full bg-white rounded-[16px] overflow-hidden border border-[#E9ECEF] shadow-2xl transition-transform duration-300 transform scale-95 max-h-[90vh] flex flex-col">
        
        <div class="px-6 py-4 flex items-center justify-between border-b border-[#E9ECEF] shrink-0">
            <div>
                <h3 id="modalTitle" class="text-base font-bold text-[#343A40]">Detail Deteksi</h3>
                <p id="modalSubtitle" class="text-xs text-[#6C757D] mt-0.5">Waktu Scan: ...</p>
            </div>
            <button id="closeModal" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#F8F9FA] hover:bg-[#E9ECEF] text-[#343A40] transition focus:outline-none text-xl font-bold">
                &times;
            </button>
        </div>
        
        <div class="overflow-y-auto">
            <div class="flex items-center justify-center bg-[#1a1a1a]">
                <img id="modalImage" src="" class="w-full h-auto max-h-[50vh] object-contain" alt="Full Preview" />
            </div>

            <div class="p-6 flex flex-col gap-4">
                <div class="flex items-center gap-3 flex-wrap justify-between">
    <div class="flex items-center gap-3 flex-wrap">
        <span id="modalCategoryBadge" class="inline-flex px-3 py-1 rounded-[30px] text-xs font-bold">
            Kategori
        </span>
        <span id="modalScore" class="text-sm font-bold text-[#3F51B5]">Akurasi: -</span>
    </div>
    <button id="btnDownloadModal" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#3F51B5] hover:bg-[#7971EA] text-white rounded-[30px] text-xs font-semibold transition shadow-sm">
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-4-4m4 4l4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
    </svg>
    Unduh Foto
</button>
</div>

                <div class="bg-[#F8F9FA] rounded-[12px] p-4 border border-[#E9ECEF]">
                    <h4 class="text-[13px] font-bold text-[#343A40] mb-2 flex items-center gap-1.5">
                        💡 Saran Penanganan
                    </h4>
                    <ul id="modalAdviceList" class="text-[13px] text-[#495057] space-y-1.5 list-disc list-inside leading-relaxed">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirmModal" class="fixed inset-0 bg-[#343A40]/80 backdrop-blur-sm z-[60] flex items-center justify-center hidden transition-opacity duration-300 opacity-0 p-4">
    <div class="relative max-w-sm w-full bg-white rounded-[16px] overflow-hidden border border-[#E9ECEF] shadow-2xl transition-transform duration-300 transform scale-95">
        <div class="p-6 text-center">
            <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-[#F23A2E]/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-[#F23A2E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h3 id="confirmModalTitle" class="text-base font-bold text-[#343A40] mb-2">Hapus Data?</h3>
            <p id="confirmModalMessage" class="text-[13px] text-[#6C757D] leading-relaxed mb-6">Apakah Anda yakin?</p>
            <div class="flex gap-3">
                <button id="confirmModalCancel" class="flex-1 px-4 py-2.5 border border-[#D1D5DB] hover:bg-[#F8F9FA] text-[#343A40] rounded-[30px] text-xs font-semibold transition">
                    Batal
                </button>
                <button id="confirmModalOk" class="flex-1 px-4 py-2.5 bg-[#F23A2E] hover:bg-[#d32e24] text-white rounded-[30px] text-xs font-semibold transition">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>


</main>

    <footer class="bg-[#343A40] border-t border-[#6C757D]/30 py-6 text-center text-[12px] text-white/80 uppercase tracking-wider mt-auto">
        <p>&copy; 2026 RASH. SMKN 1 TENGGARONG.</p>
    </footer>

    <script>
        const CATEGORY_ADVICE = {
    organik: {
        title: "Sampah Organik",
        color: "#10B981",
        tips: [
            "Bisa dijadikan kompos atau pupuk alami untuk tanaman.",
            "Pisahkan dari sampah lain agar tidak mencemari sampah anorganik.",
            "Jika berupa sisa makanan, bisa juga dimanfaatkan sebagai pakan ternak/maggot."
        ]
    },
    anorganik: {
        title: "Sampah Anorganik",
        color: "#F23A2E",
        tips: [
            "Pisahkan berdasarkan jenis material (plastik, kaca, logam) sebelum dibuang.",
            "Bersihkan dari sisa makanan/cairan agar bisa didaur ulang dengan baik.",
            "Setor ke bank sampah atau pengepul untuk didaur ulang, hindari dibakar."
        ]
    },
    b3: {
        title: "Sampah B3 (Berbahaya)",
        color: "#F59E0B",
        tips: [
            "JANGAN dibuang ke tempat sampah biasa, bisa mencemari tanah dan air.",
            "Simpan di wadah tertutup dan antar ke drop box/TPS B3 terdekat.",
            "Hindari kontak langsung dengan kulit saat menangani."
        ]
    }
};

function getAdviceByCategory(category) {
    const key = category.toLowerCase();
    if (key.includes('organik') && !key.includes('anorganik')) return CATEGORY_ADVICE.organik;
    if (key.includes('anorganik')) return CATEGORY_ADVICE.anorganik;
    if (key.includes('b3') || key.includes('berbahaya')) return CATEGORY_ADVICE.b3;
    return { title: category, color: "#3F51B5", tips: ["Belum ada saran khusus untuk kategori ini."] };
}
        const historyList = document.getElementById('historyList');
        const emptyState = document.getElementById('emptyState');
        const countAll = document.getElementById('countAll');
        const countPermanent = document.getElementById('countPermanent');
        const btnClearAll = document.getElementById('btnClearAll');

        const tabAll = document.getElementById('tabAll');
        const tabPermanent = document.getElementById('tabPermanent');

        const paginationFooter = document.getElementById('paginationFooter');
        const paginationButtons = document.getElementById('paginationButtons');
        const btnSize5 = document.getElementById('btnSize5');
        const btnSize15 = document.getElementById('btnSize15');
        
        let currentFilter = 'all';        
        let currentCategoryFilter = 'all'; 
        let currentSort = 'newest';        
        let itemsPerPage = 5;      
        let currentPage = 1;
        let currentModalDownload = null;       

        const categoryFilterBtns = document.querySelectorAll('.category-filter-btn');
        const sortSelect = document.getElementById('sortSelect');     

        btnSize5.addEventListener('click', () => {
            itemsPerPage = 5;
            currentPage = 1;
            btnSize5.className = 'px-3 py-1 rounded-[30px] font-semibold border transition duration-200 bg-[#3F51B5] text-white border-[#3F51B5]';
            btnSize15.className = 'px-3 py-1 rounded-[30px] font-semibold border transition duration-200 bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]';
            renderHistory();
        });

        btnSize15.addEventListener('click', () => {
            itemsPerPage = 15;
            currentPage = 1;
            btnSize15.className = 'px-3 py-1 rounded-[30px] font-semibold border transition duration-200 bg-[#3F51B5] text-white border-[#3F51B5]';
            btnSize5.className = 'px-3 py-1 rounded-[30px] font-semibold border transition duration-200 bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]';
            renderHistory();
        });

        function getHistoryData() {
            return JSON.parse(localStorage.getItem('ecoscan_history') || '[]');
        }

        function saveHistoryData(data) {
            localStorage.setItem('ecoscan_history', JSON.stringify(data));
        }

        async function fetchHistoryAndSync() {
            try {
                const res = await fetch('/api/scans');
                if (res.ok) {
                    const dbData = await res.json();

                    const normalized = dbData.map(item => ({
    id: item.uuid,
    uuid: item.uuid,
    timestamp: new Date(item.created_at).toLocaleString('id-ID', {
        year: 'numeric', month: '2-digit', day: '2-digit',
        hour: '2-digit', minute: '2-digit', second: '2-digit'
    }),
    objectName: item.object_name,
    category: item.category,
    score: item.score,
    thumbnail: item.thumbnail,
    fullImage: item.full_image || item.thumbnail,  
    isPermanent: Boolean(item.is_permanent)
}));
                    
                    saveHistoryData(normalized);
                }
            } catch (err) {
                console.warn("Database sync failed, using LocalStorage data copy:", err);
            }
            renderHistory();
        }

        function renderHistory() {
            const history = getHistoryData();

            const totalCount = history.length;
            const permanentCount = history.filter(item => item.isPermanent).length;

            countAll.innerText = totalCount;
            countPermanent.innerText = permanentCount;

             let filteredList = history;
            if (currentFilter === 'permanent') {
                filteredList = filteredList.filter(item => item.isPermanent);
            }

            if (currentCategoryFilter !== 'all') {
                filteredList = filteredList.filter(item => {
                    const cat = item.category.toLowerCase();
                    if (currentCategoryFilter === 'organik') return cat.includes('organik') && !cat.includes('anorganik');
                    if (currentCategoryFilter === 'anorganik') return cat.includes('anorganik');
                    if (currentCategoryFilter === 'b3') return cat.includes('b3') || cat.includes('berbahaya');
                    return true;
                });
            }

            filteredList = [...filteredList].sort((a, b) => {
                if (currentSort === 'newest') return b.uuid.localeCompare(a.uuid);
                if (currentSort === 'oldest') return a.uuid.localeCompare(b.uuid);
                if (currentSort === 'score_desc') return b.score - a.score;
                if (currentSort === 'score_asc') return a.score - b.score;
                return 0;
            });

            const totalFilteredCount = filteredList.length;
            const totalPages = Math.ceil(totalFilteredCount / itemsPerPage) || 1;

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            historyList.innerHTML = '';
            
            if (totalFilteredCount === 0) {
                emptyState.classList.remove('hidden');
                document.querySelector('table').classList.add('hidden');
                paginationFooter.classList.add('hidden');

                const emptyTitle = emptyState.querySelector('h3');
                const emptyDesc = emptyState.querySelector('p');
                if (currentCategoryFilter !== 'all') {
                    emptyTitle.innerText = 'Tidak ada data untuk kategori ini';
                    emptyDesc.innerText = 'Coba pilih kategori lain atau reset filter ke "Semua".';
                } else {
                    emptyTitle.innerText = 'Belum ada riwayat scan';
                    emptyDesc.innerText = 'Kamera belum mendeteksi sampah organik/anorganik/B3 dengan akurasi kuat.';
                }
                return;
            }

            emptyState.classList.add('hidden');
            document.querySelector('table').classList.remove('hidden');
            paginationFooter.classList.remove('hidden');

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedList = filteredList.slice(startIndex, endIndex);

            paginatedList.forEach(item => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-[#F8F9FA] transition-all duration-150';

                let badgeClass = '';
                let categoryLower = item.category.toLowerCase();
                
                if (categoryLower.includes('organik') && !categoryLower.includes('anorganik')) {
                    badgeClass = 'bg-[#10B981]/10 text-[#10B981] border border-[#10B981]/20';
                } else if (categoryLower.includes('anorganik')) {
                    badgeClass = 'bg-[#F23A2E]/10 text-[#F23A2E] border border-[#F23A2E]/20';
                } else if (categoryLower.includes('b3') || categoryLower.includes('berbahaya')) {
                    badgeClass = 'bg-[#F59E0B]/10 text-[#F59E0B] border border-[#F59E0B]/20';
                } else {
                    badgeClass = 'bg-[#3F51B5]/10 text-[#3F51B5] border border-[#3F51B5]/20';
                }

                const starIcon = item.isPermanent ? '⭐' : '☆';
                const starTitle = item.isPermanent ? 'Batal Simpan Permanen' : 'Simpan Permanen ke Galeri';
                const starBtnClass = item.isPermanent 
                    ? 'text-amber-400 hover:text-[#6C757D] scale-110' 
                    : 'text-[#6C757D] hover:text-amber-400';

                tr.className = 'hover:bg-[#F8F9FA] transition-all duration-150 cursor-pointer';
tr.onclick = () => openImagePreview(
    item.fullImage || item.thumbnail || 'https://via.placeholder.com/640x480/F8F9FA/343A40?text=EcoScan',
    item.objectName,
    item.timestamp,
    item.category,
    item.score
);

tr.innerHTML = `
    <td class="px-6 py-3">
        <div class="w-12 h-9 rounded-[8px] overflow-hidden border border-[#E9ECEF] bg-[#F8F9FA]">
            <img src="${item.thumbnail || 'https://via.placeholder.com/120x90/F8F9FA/343A40?text=EcoScan'}" class="w-full h-full object-cover hover:scale-110 transition duration-200" alt="Trash Thumbnail" />
        </div>
    </td>
    <td class="px-6 py-3">
        <span class="inline-flex px-2.5 py-0.5 rounded-[30px] text-[10px] font-bold ${badgeClass}">
            ${item.category}
        </span>
    </td>
    <td class="px-6 py-3 font-bold text-[#3F51B5]">${item.score}%</td>
    <td class="px-6 py-3 text-[#6C757D]">${item.timestamp}</td>
    <td class="px-6 py-3 text-right flex items-center justify-end gap-2.5 h-16">
    <button onclick="event.stopPropagation(); downloadPhoto('${item.uuid}')" title="Unduh Foto" class="text-[#6C757D] hover:text-[#3F51B5] transition duration-200">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-4-4m4 4l4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
        </svg>
    </button>
    <button onclick="event.stopPropagation(); togglePermanent('${item.uuid}')" title="${starTitle}" class="text-xs transition duration-200 ${starBtnClass}">
        ${starIcon}
    </button>
    <button onclick="event.stopPropagation(); deleteRecord('${item.uuid}')" title="Hapus Log" class="text-[#6C757D] hover:text-[#F23A2E] text-xs transition duration-200">
        🗑️
    </button>
</td>
`;

                historyList.appendChild(tr);
            });

            renderPaginationControls(totalPages);
        }

        function renderPaginationControls(totalPages) {
    paginationButtons.innerHTML = '';

    if (totalPages <= 1) {
        return; 
    }

    const navBtnClass = (disabled) => 'w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold border transition duration-200 ' +
        (disabled
            ? 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed'
            : 'bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]');

    const makeNavBtn = (label, disabled, onClick, title) => {
        const btn = document.createElement('button');
        btn.innerHTML = label;
        btn.title = title || '';
        btn.className = navBtnClass(disabled);
        if (!disabled) btn.addEventListener('click', onClick);
        return btn;
    };

    const makePageBtn = (page) => {
        const btn = document.createElement('button');
        btn.innerText = page;
        btn.className = 'w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold border transition duration-200 ' +
            (currentPage === page
                ? 'bg-[#3F51B5] text-white border-[#3F51B5]'
                : 'bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]');
        btn.addEventListener('click', () => {
            currentPage = page;
            renderHistory();
        });
        return btn;
    };

    const makeEllipsis = () => {
        const span = document.createElement('span');
        span.innerText = '...';
        span.className = 'w-8 h-8 flex items-center justify-center text-sm text-[#6C757D] select-none';
        return span;
    };

    paginationButtons.appendChild(
        makeNavBtn('«', currentPage === 1, () => { currentPage = 1; renderHistory(); }, 'Halaman Pertama')
    );

    paginationButtons.appendChild(
        makeNavBtn('‹', currentPage === 1, () => { currentPage--; renderHistory(); }, 'Sebelumnya')
    );

    const delta = 1;
    const range = [];

    for (let i = 1; i <= totalPages; i++) {
        if (
            i === 1 ||
            i === totalPages ||
            (i >= currentPage - delta && i <= currentPage + delta)
        ) {
            range.push(i);
        }
    }

    let lastPage = 0;
    range.forEach((page) => {
        if (lastPage && page - lastPage > 1) {
            paginationButtons.appendChild(makeEllipsis());
        }
        paginationButtons.appendChild(makePageBtn(page));
        lastPage = page;
    });

    paginationButtons.appendChild(
        makeNavBtn('›', currentPage === totalPages, () => { currentPage++; renderHistory(); }, 'Berikutnya')
    );

    paginationButtons.appendChild(
        makeNavBtn('»', currentPage === totalPages, () => { currentPage = totalPages; renderHistory(); }, 'Halaman Terakhir')
    );
}

        window.togglePermanent = function(uuid) {
            const history = getHistoryData();
            const updated = history.map(item => {
                if (item.uuid === uuid) {
                    item.isPermanent = !item.isPermanent;
                }
                return item;
            });
            saveHistoryData(updated);
            renderHistory();

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            fetch(`/api/scans/${uuid}/toggle-permanent`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => console.log("Permanent status toggled in database:", data))
            .catch(err => console.error("Database toggle failed:", err));
        };

        window.deleteRecord = function(uuid) {
    openConfirmModal({
        title: "Hapus Log Ini?",
        message: "Data scan ini akan dihapus secara permanen dari riwayat.",
        onConfirm: () => {
            const history = getHistoryData();
            const updated = history.filter(item => item.uuid !== uuid);
            saveHistoryData(updated);
            renderHistory();

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            fetch(`/api/scans/${uuid}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => console.log("Record deleted in database:", data))
            .catch(err => console.error("Database delete failed:", err));
        }
    });
};

        let confirmModalCallback = null;

function openConfirmModal({ title, message, onConfirm }) {
    const modal = document.getElementById('confirmModal');
    document.getElementById('confirmModalTitle').innerText = title;
    document.getElementById('confirmModalMessage').innerText = message;
    confirmModalCallback = onConfirm;

    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }, 50);
}

function closeConfirmModal() {
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('opacity-100');
    modal.querySelector('.transform').classList.add('scale-95');
    modal.querySelector('.transform').classList.remove('scale-100');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
    confirmModalCallback = null;
}

document.getElementById('confirmModalCancel').addEventListener('click', closeConfirmModal);
document.getElementById('confirmModalOk').addEventListener('click', () => {
    if (confirmModalCallback) confirmModalCallback();
    closeConfirmModal();
});
document.getElementById('confirmModal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('confirmModal')) closeConfirmModal();
});

        btnClearAll.addEventListener('click', () => {
    const history = getHistoryData();
    const deletableCount = history.filter(item => !item.isPermanent).length;

    if (deletableCount === 0) {
        alert("Tidak ada log yang bisa dihapus (semua sudah di-favoritkan).");
        return;
    }

    openConfirmModal({
        title: "Hapus Semua Log?",
        message: `Ini akan menghapus ${deletableCount} log non-favorit secara permanen. Item yang sudah di-favoritkan (⭐) akan tetap aman. Lanjutkan?`,
        onConfirm: () => {
            const remaining = history.filter(item => item.isPermanent);
            saveHistoryData(remaining);
            renderHistory();

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            fetch('/api/scans/clear-all', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => console.log("Database logs cleared:", data))
            .catch(err => console.error("Database clear failed:", err));
        }
    });
});

        tabAll.addEventListener('click', () => {
            currentFilter = 'all';
            tabAll.className = 'border-b-2 border-[#3F51B5] pb-2 text-[#3F51B5] transition-all';
            tabPermanent.className = 'border-b-2 border-transparent pb-2 text-[#6C757D] hover:text-[#343A40] transition-all';
            renderHistory();
        });

        tabPermanent.addEventListener('click', () => {
            currentFilter = 'permanent';
            tabPermanent.className = 'border-b-2 border-[#3F51B5] pb-2 text-[#3F51B5] transition-all';
            tabAll.className = 'border-b-2 border-transparent pb-2 text-[#6C757D] hover:text-[#343A40] transition-all';
            renderHistory();
        });
        categoryFilterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                currentCategoryFilter = btn.dataset.categoryFilter;
                currentPage = 1;

                categoryFilterBtns.forEach(b => {
                    b.className = 'category-filter-btn px-3 py-1 rounded-[30px] text-[11px] font-semibold border transition bg-white text-[#6C757D] border-[#D1D5DB] hover:bg-[#F8F9FA]';
                });
                btn.className = 'category-filter-btn px-3 py-1 rounded-[30px] text-[11px] font-semibold border transition bg-[#3F51B5] text-white border-[#3F51B5]';

                renderHistory();
            });
        });
        
        sortSelect.addEventListener('change', () => {
            currentSort = sortSelect.value;
            currentPage = 1;
            renderHistory();
        });

    window.openImagePreview = function(imageUrl, objectName, timestamp, category, score) {
    const modal = document.getElementById('previewModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalSubtitle = document.getElementById('modalSubtitle');
    const modalCategoryBadge = document.getElementById('modalCategoryBadge');
    const modalScore = document.getElementById('modalScore');
    const modalAdviceList = document.getElementById('modalAdviceList');

    currentModalDownload = {
        url: imageUrl,
        filename: `rash_${sanitizeFilename(category || objectName)}_${sanitizeFilename(timestamp)}.jpg`
    };

    modalImage.src = imageUrl;
    modalTitle.innerText = objectName;
    modalSubtitle.innerText = `Waktu Scan: ${timestamp}`;

    const advice = getAdviceByCategory(category || '');
    modalCategoryBadge.innerText = advice.title;
    modalCategoryBadge.style.backgroundColor = advice.color + '1A';
    modalCategoryBadge.style.color = advice.color;
    modalCategoryBadge.style.border = `1px solid ${advice.color}33`;

    modalScore.innerText = `Akurasi: ${score !== undefined ? score : '-'}%`;

    modalAdviceList.innerHTML = advice.tips.map(tip => `<li>${tip}</li>`).join('');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }, 50);
};

        window.closeImagePreview = function() {
            const modal = document.getElementById('previewModal');
            if (!modal.classList.contains('hidden')) {
                modal.classList.remove('opacity-100');
                modal.querySelector('.transform').classList.add('scale-95');
                modal.querySelector('.transform').classList.remove('scale-100');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        };

        document.getElementById('closeModal').addEventListener('click', window.closeImagePreview);
        document.getElementById('previewModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('previewModal')) {
                window.closeImagePreview();
            }
        });
        document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        window.closeImagePreview();
        closeConfirmModal();
    }
});
function sanitizeFilename(str) {
    return String(str)
        .replace(/[^a-z0-9]+/gi, '_')
        .replace(/^_+|_+$/g, '')
        .toLowerCase() || 'foto';
}

function triggerImageDownload(imageUrl, filename) {
    if (!imageUrl) return;
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

window.downloadPhoto = function(uuid) {
    const history = getHistoryData();
    const item = history.find(i => i.uuid === uuid);
    if (!item) return;
    const imageUrl = item.fullImage || item.thumbnail;
    const filename = `rash_${sanitizeFilename(item.category)}_${sanitizeFilename(item.timestamp)}.jpg`;
    triggerImageDownload(imageUrl, filename);
};

document.getElementById('btnDownloadModal').addEventListener('click', () => {
    if (currentModalDownload) {
        triggerImageDownload(currentModalDownload.url, currentModalDownload.filename);
    }
});

        window.addEventListener('DOMContentLoaded', fetchHistoryAndSync);
    </script>

</body>

</html>