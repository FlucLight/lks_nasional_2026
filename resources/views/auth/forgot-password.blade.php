<x-guest-layout>
    <div class="relative min-h-screen w-full flex items-center justify-center px-4 py-12"
         style="font-family: 'Poppins', sans-serif;">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,900;1,400&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">

        <style>
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(14px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
            .delay-1 { animation-delay: 0.05s; }
            .delay-2 { animation-delay: 0.2s; }
            .delay-3 { animation-delay: 0.35s; }
        </style>

        <div class="fixed inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/sekolah.jpg') }}');"></div>
        <div class="fixed inset-0 bg-black/35"></div>

        <a href="{{ url('/') }}" class="absolute top-6 left-6 z-20 flex items-center gap-2 text-white text-sm font-medium bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-full transition hover:scale-105">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>

        <div class="relative z-10 w-full max-w-md">

            <div class="flex flex-col items-center mb-8 fade-in-up delay-1">
                <img src="{{ asset('images/logo_smk.png') }}" alt="Logo SMKN 1 Tenggarong"
                     class="w-16 h-16 object-contain mb-3">
                <h1 class="text-2xl font-black tracking-tight text-white uppercase" style="font-family: 'Quicksand', sans-serif;">
                    Rash
                </h1>
                <p class="text-xs text-white/70 mt-1 text-center">
                    SMK Negeri 1 Tenggarong &middot; Sistem Deteksi Sampah Berbasis AI
                </p>
            </div>

            <div class="bg-white/5 backdrop-blur-[1px] rounded-[16px] shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/25 p-8 fade-in-up delay-2">
                <h2 class="text-xl font-bold text-white mb-1 drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]" style="font-family: 'Quicksand', sans-serif;">Lupa Kata Sandi</h2>
                <p class="text-xs text-white/80 mb-6 drop-shadow-[0_1px_3px_rgba(0,0,0,0.5)]">
                    {{ __('Lupa kata sandi kamu? Tenang. Masukkan alamat email kamu, nanti kami kirimkan link untuk mengatur ulang kata sandi.') }}
                </p>

                @session('status')
                    <div class="mb-4 font-medium text-xs text-[#B7F0A0] drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">
                        {{ $value }}
                    </div>
                @endsession

                <x-validation-errors class="mb-4 bg-[#F23A2E]/20 backdrop-blur-sm border border-[#F23A2E]/40 text-white rounded-md p-3 text-xs drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-semibold text-white mb-1.5 drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">{{ __('Alamat Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="block w-full rounded-md border border-white/30 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/50 focus:ring-2 focus:ring-white focus:border-white/60 focus:outline-none focus:bg-white/15 transition shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-[#3F51B5] hover:bg-[#7971EA] active:bg-[#1C4B82] text-white font-semibold rounded-[30px] text-sm transition-all duration-300 shadow-[0_4px_16px_rgba(0,0,0,0.35)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.4)] hover:scale-[1.02] active:scale-[0.98]">
                        {{ __('Kirim Link Reset Kata Sandi') }}
                    </button>
                </form>

                <p class="text-xs text-white/80 mt-5 text-center drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">
                    Sudah ingat kata sandinya?
                    <a href="{{ route('login') }}" class="text-white font-semibold underline hover:text-[#CFCDFC]">
                        Masuk di sini
                    </a>
                </p>
            </div>

            <div class="fade-in-up delay-3">
                <p class="text-[11px] text-white/50 text-center mt-6 uppercase tracking-wider">
                    &copy; 2026 RASH. SMKN 1 TENGGARONG.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>