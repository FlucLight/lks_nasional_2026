<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Scan - EcoScan AI</title>

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
<img src="{{ asset('images/logo_smk.png') }}" alt="Logo SMKN 1 Tenggarong" class="w-10 h-10 object-contain transition-transform duration-300 group-hover:scale-110">                        <span class="text-base font-black tracking-tight text-white uppercase">Rash</span>
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

        <div class="flex items-center gap-2">
            <button id="btnClearAll" class="px-5 py-2 border border-[#D1D5DB] hover:bg-[#F8F9FA] text-[#F23A2E] rounded-[30px] text-xs font-semibold transition-all duration-300">
                Hapus Semua Log
            </button>
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

    <div id="historyContainer" class="bg-white rounded-[12px] border border-[#E9ECEF] overflow-hidden">

        <div class="px-6 py-5 flex items-center justify-between border-b border-[#E9ECEF]">
            <div>
                <h2 class="text-base font-bold text-[#343A40]">Daftar Deteksi</h2>
                <p class="text-[13px] text-[#6C757D] mt-0.5">Riwayat lengkap objek yang berhasil dipindai kamera.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#E9ECEF]">
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Preview</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Nama Objek</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Kategori</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Akurasi</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] whitespace-nowrap">Waktu Scan</th>
                        <th class="px-6 py-3.5 font-semibold text-[#495057] text-right whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="historyList">
                    <tr class="border-b border-[#E9ECEF] odd:bg-white even:bg-[#F8F9FA]/60 hover:bg-[#F1F3FE] transition-colors">
                        <td class="px-6 py-4"><img src="..." class="w-10 h-10 rounded-[8px] object-cover" /></td>
                        <td class="px-6 py-4 font-semibold text-[#343A40]">Botol Plastik</td>
                        <td class="px-6 py-4 text-[#6C757D]">Anorganik</td>
                        <td class="px-6 py-4 text-[#6C757D]">92%</td>
                        <td class="px-6 py-4 text-[#6C757D]">2 menit lalu</td>
                        <td class="px-6 py-4 text-right"><a href="#" class="text-[#3F51B5] hover:text-[#7971EA] font-semibold">Hapus</a></td>
                    </tr>
                    
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
                Kamera belum mendeteksi sampah organik/anorganik dengan akurasi kuat.
            </p>
            <a href="/" class="mt-4 px-6 py-2 bg-[#3F51B5] hover:bg-[#7971EA] text-white rounded-[30px] text-xs font-semibold transition shadow-md">
                Mulai Scan Sekarang
            </a>
        </div>
    </div>

    <div id="previewModal" class="fixed inset-0 bg-[#343A40]/80 backdrop-blur-sm z-50 flex items-center justify-center hidden transition-opacity duration-300 opacity-0 p-4">
        <div class="relative max-w-4xl w-full bg-white rounded-[16px] overflow-hidden border border-[#E9ECEF] shadow-2xl transition-transform duration-300 transform scale-95">
            
            <div class="px-6 py-4 flex items-center justify-between border-b border-[#E9ECEF]">
                <div>
                    <h3 id="modalTitle" class="text-base font-bold text-[#343A40] capitalize">Detail Gambar</h3>
                    <p id="modalSubtitle" class="text-xs text-[#6C757D] mt-0.5">Waktu Scan: ...</p>
                </div>
                <button id="closeModal" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#F8F9FA] hover:bg-[#E9ECEF] text-[#343A40] transition focus:outline-none text-xl font-bold">
                    &times;
                </button>
            </div>
            
            <div class="flex items-center justify-center bg-[#1a1a1a]">
                <img id="modalImage" src="" class="w-full h-auto max-h-[85vh] object-contain" alt="Full Preview" />
            </div>
        </div>
    </div>

</main>

    <footer class="bg-[#343A40] border-t border-[#6C757D]/30 py-6 text-center text-[12px] text-white/80 uppercase tracking-wider mt-auto">
        <p>&copy; 2026 RASH. SMKN 1 TENGGARONG.</p>
    </footer>

    <script>
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
        let itemsPerPage = 5;      
        let currentPage = 1;       

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
                filteredList = history.filter(item => item.isPermanent);
            }

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
                if (item.category.includes('Organik')) {
                    badgeClass = 'bg-[#10B981]/10 text-[#10B981] border border-[#10B981]/20';
                } else if (item.category.includes('Anorganik')) {
                    badgeClass = 'bg-[#F23A2E]/10 text-[#F23A2E] border border-[#F23A2E]/20';
                } else {
                    badgeClass = 'bg-[#3F51B5]/10 text-[#3F51B5] border border-[#3F51B5]/20';
                }

                const starIcon = item.isPermanent ? '⭐' : '☆';
                const starTitle = item.isPermanent ? 'Batal Simpan Permanen' : 'Simpan Permanen ke Galeri';
                const starBtnClass = item.isPermanent 
                    ? 'text-amber-400 hover:text-[#6C757D] scale-110' 
                    : 'text-[#6C757D] hover:text-amber-400';

                tr.innerHTML = `
                    <td class="px-6 py-3">
                        <button onclick="openImagePreview('${item.thumbnail || 'https://via.placeholder.com/640x480/F8F9FA/343A40?text=EcoScan'}', '${item.objectName}', '${item.timestamp}')" class="w-12 h-9 rounded-[8px] overflow-hidden border border-[#E9ECEF] bg-[#F8F9FA] block focus:outline-none focus:ring-2 focus:ring-[#3F51B5]">
                            <img src="${item.thumbnail || 'https://via.placeholder.com/120x90/F8F9FA/343A40?text=EcoScan'}" class="w-full h-full object-cover hover:scale-110 transition duration-200" alt="Trash Thumbnail" />
                        </button>
                    </td>
                    <td class="px-6 py-3 font-semibold text-[#343A40] capitalize">${item.objectName}</td>
                    <td class="px-6 py-3">
                        <span class="inline-flex px-2.5 py-0.5 rounded-[30px] text-[10px] font-bold ${badgeClass}">
                            ${item.category}
                        </span>
                    </td>
                    <td class="px-6 py-3 font-bold text-[#3F51B5]">${item.score}%</td>
                    <td class="px-6 py-3 text-[#6C757D]">${item.timestamp}</td>
                    <td class="px-6 py-3 text-right flex items-center justify-end gap-2.5 h-16">
                        <button onclick="togglePermanent('${item.uuid}')" title="${starTitle}" class="text-xs transition duration-200 ${starBtnClass}">
                            ${starIcon}
                        </button>
                        <button onclick="deleteRecord('${item.uuid}')" title="Hapus Log" class="text-[#6C757D] hover:text-[#F23A2E] text-xs transition duration-200">
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

            const prevBtn = document.createElement('button');
            prevBtn.innerText = '‹';
            prevBtn.className = 'w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold border transition duration-200 ' +
                (currentPage === 1 
                    ? 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed' 
                    : 'bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]');
            if (currentPage > 1) {
                prevBtn.addEventListener('click', () => {
                    currentPage--;
                    renderHistory();
                });
            }
            paginationButtons.appendChild(prevBtn);

            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.innerText = i;
                pageBtn.className = 'w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold border transition duration-200 ' +
                    (currentPage === i
                        ? 'bg-[#3F51B5] text-white border-[#3F51B5]'
                        : 'bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]');
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    renderHistory();
                });
                paginationButtons.appendChild(pageBtn);
            }

            const nextBtn = document.createElement('button');
            nextBtn.innerText = '›';
            nextBtn.className = 'w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold border transition duration-200 ' +
                (currentPage === totalPages 
                    ? 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed' 
                    : 'bg-white text-[#343A40] border-[#D1D5DB] hover:bg-[#F8F9FA]');
            if (currentPage < totalPages) {
                nextBtn.addEventListener('click', () => {
                    currentPage++;
                    renderHistory();
                });
            }
            paginationButtons.appendChild(nextBtn);
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
            if (confirm("Apakah Anda yakin ingin menghapus log scan ini?")) {

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
        };

        btnClearAll.addEventListener('click', () => {
            const history = getHistoryData();
            if (history.length === 0) {
                alert("Log riwayat kosong.");
                return;
            }

            if (confirm("⚠️ PERINGATAN! Ini akan menghapus seluruh data scan secara permanen dari Database dan LocalStorage. Lanjutkan?")) {

                localStorage.removeItem('ecoscan_history');
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

        window.openImagePreview = function(imageUrl, objectName, timestamp) {
            const modal = document.getElementById('previewModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalSubtitle = document.getElementById('modalSubtitle');
            
            modalImage.src = imageUrl;
            modalTitle.innerText = objectName;
            modalSubtitle.innerText = `Waktu Scan: ${timestamp}`;
            
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
            }
        });

        window.addEventListener('DOMContentLoaded', fetchHistoryAndSync);
    </script>

</body>

</html>
