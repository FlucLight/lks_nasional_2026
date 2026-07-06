<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Deteksi - EcoScan AI</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,900;1,400&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    <button type="button" command="--toggle" commandfor="mobile-menu-analytics" aria-expanded="false"
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
                            <a href="/history" class="rounded-md px-3 py-2 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-colors">Riwayat</a>
                            <a href="/analytics" aria-current="page" class="rounded-md bg-white/15 px-3 py-2 text-sm font-semibold text-white">Statistik</a>
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

        <el-disclosure id="mobile-menu-analytics" hidden class="sm:hidden border-t border-white/10">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <a href="/" class="block rounded-md px-3 py-2 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white">Live Scan</a>
                <a href="/history" class="block rounded-md px-3 py-2 text-base font-medium text-white/70 hover:bg-white/10 hover:text-white">Riwayat</a>
                <a href="/analytics" aria-current="page" class="block rounded-md bg-white/15 px-3 py-2 text-base font-semibold text-white">Statistik</a>
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
        
        <div class="mb-8">
            <h1 class="text-[32px] font-bold tracking-tight text-[#343A40] leading-[38.4px]">
                Statistik Deteksi Sampah
            </h1>
            <p class="text-[14.08px] text-[#6C757D] mt-1">
                Grafik perbandingan jenis sampah organik dan anorganik yang berhasil di scan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-[#E9ECEF] border border-[#E9ECEF] rounded-[16px] bg-white mb-8">

    <div class="p-6">
        <div class="text-[11px] font-semibold text-[#6C757D] uppercase tracking-wider mb-3">Total Deteksi</div>
        <div class="flex items-baseline gap-1">
            <span id="statTotal" class="text-4xl font-bold text-[#343A40] tabular-nums">0</span>
        </div>
        <div class="text-[11px] text-[#ADB5BD] mt-2">Seluruh item tersimpan</div>
    </div>

    <div class="p-6">
        <div class="text-[11px] font-semibold text-[#6C757D] uppercase tracking-wider mb-3">Sampah Organik</div>
        <div class="flex items-baseline gap-1">
            <span id="statOrganik" class="text-4xl font-bold text-[#10B981] tabular-nums">0</span>
        </div>
        <div id="percOrganik" class="text-[11px] text-[#ADB5BD] mt-2">0% dari total sampah</div>
    </div>

    <div class="p-6">
        <div class="text-[11px] font-semibold text-[#6C757D] uppercase tracking-wider mb-3">Sampah Anorganik</div>
        <div class="flex items-baseline gap-1">
            <span id="statAnorganik" class="text-4xl font-bold text-[#F23A2E] tabular-nums">0</span>
        </div>
        <div id="percAnorganik" class="text-[11px] text-[#ADB5BD] mt-2">0% dari total sampah</div>
    </div>

</div>

        <div id="chartsWrapper" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-white border border-[#E9ECEF] rounded-[16px] p-6 shadow-[0_2px_4px_rgba(0,0,0,0.075)] flex flex-col items-center">
                <h3 class="text-[13.6px] font-bold text-[#343A40] mb-6 uppercase tracking-wider text-center w-full">Rasio Kategori Sampah</h3>
                <div class="w-full max-w-[200px] aspect-square flex items-center justify-center">
                    <canvas id="ratioChart"></canvas>
                </div>
                <div class="flex gap-6 mt-6 text-[10px] font-bold uppercase tracking-wider">
                    <div class="flex items-center gap-1.5 text-[#10B981]">
                        <span class="w-2.5 h-2.5 bg-[#10B981] rounded-full inline-block"></span> Organik
                    </div>
                    <div class="flex items-center gap-1.5 text-[#F23A2E]">
                        <span class="w-2.5 h-2.5 bg-[#F23A2E] rounded-full inline-block"></span> Anorganik
                    </div>
                </div>
            </div>

            <div class="bg-white border border-[#E9ECEF] rounded-[16px] p-6 shadow-[0_2px_4px_rgba(0,0,0,0.075)] flex flex-col">
                <h3 class="text-[13.6px] font-bold text-[#343A40] mb-6 uppercase tracking-wider text-center w-full">Item Paling Sering Di-scan</h3>
                <div class="w-full flex-grow flex items-center justify-center min-h-[220px]">
                    <canvas id="objectsChart"></canvas>
                </div>
            </div>
        </div>

        <div id="emptyState" class="hidden bg-white rounded-[16px] border border-[#E9ECEF] shadow-[0_2px_4px_rgba(0,0,0,0.075)] p-12 text-center text-[#6C757D] flex flex-col items-center justify-center">
            <svg class="w-12 h-12 text-[#6C757D] mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
            </svg>
            <h3 class="text-[15.2px] font-bold text-[#343A40]">Belum ada statistik tersedia</h3>
            <p class="text-[14.08px] text-[#6C757D] mt-1 max-w-[280px]">
                Gunakan detektor sampah di halaman utama untuk mengumpulkan data riwayat.
            </p>
            <a href="/" class="mt-4 px-6 py-2 bg-[#3F51B5] hover:bg-[#7971EA] text-white rounded-[30px] text-xs font-semibold transition shadow-md">
                Mulai Scan Pertama
            </a>
        </div>

    </main>

    <footer class="bg-[#343A40] border-t border-[#6C757D]/30 py-6 text-center text-[12px] text-white/80 uppercase tracking-wider mt-auto">
        <p>&copy; 2026 RASH. SMKN 1 TENGGARONG.</p>
    </footer>

    <script>
        function getHistoryData() {
            return JSON.parse(localStorage.getItem('ecoscan_history') || '[]');
        }

        let ratioChartInstance = null;
        let objectsChartInstance = null;

        async function loadAnalytics() {
            let history = [];
            
            const statTotal = document.getElementById('statTotal');
            const statOrganik = document.getElementById('statOrganik');
            const statAnorganik = document.getElementById('statAnorganik');
            const percOrganik = document.getElementById('percOrganik');
            const percAnorganik = document.getElementById('percAnorganik');
            const chartsWrapper = document.getElementById('chartsWrapper');
            const emptyState = document.getElementById('emptyState');

            try {

                const res = await fetch('/api/scans');
                if (res.ok) {
                    const dbData = await res.json();
                    
                    history = dbData.map(item => ({
                        objectName: item.object_name,
                        category: item.category,
                        score: item.score,
                        isPermanent: Boolean(item.is_permanent)
                    }));

                    localStorage.setItem('ecoscan_history', JSON.stringify(dbData.map(item => ({
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
                    }))));
                } else {
                    history = getHistoryData();
                }
            } catch (err) {
                console.warn("Database sync failed, falling back to LocalStorage copy:", err);
                history = getHistoryData();
            }

            const total = history.length;
            
            if (total === 0) {
                chartsWrapper.classList.add('hidden');
                emptyState.classList.remove('hidden');

                statTotal.innerText = '0';
                statOrganik.innerText = '0';
                statAnorganik.innerText = '0';
                percOrganik.innerText = '0% dari total sampah';
                percAnorganik.innerText = '0% dari total sampah';
                return;
            }

            chartsWrapper.classList.remove('hidden');
            emptyState.classList.add('hidden');

            const organicCount = history.filter(item => item.category.includes('Organik')).length;
            const anorganicCount = history.filter(item => item.category.includes('Anorganik')).length;

            const organicPerc = total > 0 ? Math.round((organicCount / total) * 100) : 0;
            const anorganicPerc = total > 0 ? Math.round((anorganicCount / total) * 100) : 0;

            statTotal.innerText = total;
            statOrganik.innerText = organicCount;
            statAnorganik.innerText = anorganicCount;
            percOrganik.innerText = `${organicPerc}% dari total sampah`;
            percAnorganik.innerText = `${anorganicPerc}% dari total sampah`;

            const objectCounts = {};
            history.forEach(item => {
                const name = item.objectName.toLowerCase();
                objectCounts[name] = (objectCounts[name] || 0) + 1;
            });

            const sortedObjects = Object.entries(objectCounts)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 5); 

            const topLabels = sortedObjects.map(entry => entry[0]);
            const topData = sortedObjects.map(entry => entry[1]);

            Chart.defaults.color = '#6C757D'; 
            Chart.defaults.font.family = "'Poppins', sans-serif";

            const ctxRatio = document.getElementById('ratioChart').getContext('2d');
            if (ratioChartInstance) ratioChartInstance.destroy();
            
            ratioChartInstance = new Chart(ctxRatio, {
                type: 'doughnut',
                data: {
                    labels: ['Organik', 'Anorganik'],
                    datasets: [{
                        data: [organicCount, anorganicCount],
                        backgroundColor: ['#10B981', '#F23A2E'], 
                        borderColor: '#ffffff', 
                        borderWidth: 3,
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false 
                        },
                        tooltip: {
                            backgroundColor: '#343A40', 
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderWidth: 1,
                            borderColor: '#E9ECEF'
                        }
                    },
                    cutout: '75%',
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            const ctxObjects = document.getElementById('objectsChart').getContext('2d');
            if (objectsChartInstance) objectsChartInstance.destroy();

            objectsChartInstance = new Chart(ctxObjects, {
                type: 'bar',
                data: {
                    labels: topLabels,
                    datasets: [{
                        label: 'Frekuensi Scan',
                        data: topData,
                        backgroundColor: '#3F51B5', 
                        borderRadius: 30,
                        hoverBackgroundColor: '#7971EA'
                    }]
                },
                options: {
                    indexAxis: 'y', 
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#343A40',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderWidth: 1,
                            borderColor: '#E9ECEF'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: '#E9ECEF'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        window.addEventListener('DOMContentLoaded', loadAnalytics);
    </script>
</body>

</html>
