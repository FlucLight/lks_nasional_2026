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
                <h2 class="text-xl font-bold text-white mb-1 drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]" style="font-family: 'Quicksand', sans-serif;">Masuk</h2>
                <p class="text-xs text-white/80 mb-6 drop-shadow-[0_1px_3px_rgba(0,0,0,0.5)]">Masuk untuk mulai memindai sampah dan melacak riwayat deteksi.</p>

                <x-validation-errors class="mb-4 bg-[#F23A2E]/20 backdrop-blur-sm border border-[#F23A2E]/40 text-white rounded-md p-3 text-xs drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]" />

                @session('status')
                    <div class="mb-4 font-medium text-xs text-[#B7F0A0] drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-semibold text-white mb-1.5 drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="block w-full rounded-md border border-white/30 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/50 focus:ring-2 focus:ring-white focus:border-white/60 focus:outline-none focus:bg-white/15 transition shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-white mb-1.5 drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="block w-full rounded-md border border-white/30 bg-white/10 backdrop-blur-[2px] px-4 py-2.5 pr-11 text-sm text-white placeholder-white/50 focus:ring-2 focus:ring-white focus:border-white/60 focus:outline-none focus:bg-white/15 transition shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-white/60 hover:text-white transition">
                                <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg class="w-4 h-4 eye-closed hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="flex items-center gap-2 text-xs text-white/85 cursor-pointer drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/40 bg-white/10 text-[#3F51B5] focus:ring-white">
                            Ingat Saya
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-white hover:text-[#CFCDFC] font-medium underline drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-[#3F51B5] hover:bg-[#7971EA] active:bg-[#1C4B82] text-white font-semibold rounded-[30px] text-sm transition-all duration-300 shadow-[0_4px_16px_rgba(0,0,0,0.35)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.4)] hover:scale-[1.02] active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </form>

                @if (Route::has('register'))
                    <p class="text-xs text-white/80 mt-5 text-center drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-white font-semibold underline hover:text-[#CFCDFC]">
                            Daftar di sini
                        </a>
                    </p>
                @endif
            </div>

            <div class="fade-in-up delay-3">
                <p class="text-[11px] text-white/60 mt-6 text-center leading-relaxed">
                    Dengan mengklik "Masuk Sekarang", Anda menyetujui
                    <a href="https://policies.google.com/terms?hl=id" class="underline hover:text-white">Syarat Layanan</a> &middot;
                    <a href="https://policies.google.com/privacy?hl=id" class="underline hover:text-white">Kebijakan Privasi</a>
                </p>

                <p class="text-[11px] text-white/50 text-center mt-2 uppercase tracking-wider">
                    &copy; 2026 RASH. SMKN 1 TENGGARONG.
                </p>
            </div>
        </div>
    </div>
    <script>
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const eyeOpen = btn.querySelector('.eye-open');
        const eyeClosed = btn.querySelector('.eye-closed');
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
    </script>
</x-guest-layout>