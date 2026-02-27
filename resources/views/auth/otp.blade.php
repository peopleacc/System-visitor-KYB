<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi OTP - KYB System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-base leading-relaxed antialiased min-h-screen">

    <!-- Gradient Background -->
    <div class="fixed inset-0 gradient-red"></div>

    <!-- Decorative Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-red-400/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-8">

        <div class="w-full max-w-md animate-fade-in">

            <!-- OTP Card -->
            <div class="glass rounded-3xl shadow-2xl p-8 sm:p-10">

                <!-- Icon -->
                <div class="flex justify-center mb-6">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <!-- Header Text -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Verifikasi OTP</h1>
                    <p class="text-gray-500 text-sm">
                        Masukkan kode 6 digit yang telah dikirim ke
                        <br>
                        <span class="font-medium text-gray-700">{{ session('otp_email', 'your@email.com') }}</span>
                    </p>
                </div>

                <!-- OTP Form -->
                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf

                    <!-- OTP Input Fields -->
                    <div class="flex justify-center gap-2 sm:gap-3 mb-6">
                        <input type="text" name="otp[]" maxlength="1"
                            class="otp-input w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none transition-all"
                            inputmode="numeric" pattern="[0-9]" required>
                        <input type="text" name="otp[]" maxlength="1"
                            class="otp-input w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none transition-all"
                            inputmode="numeric" pattern="[0-9]" required>
                        <input type="text" name="otp[]" maxlength="1"
                            class="otp-input w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none transition-all"
                            inputmode="numeric" pattern="[0-9]" required>
                        <input type="text" name="otp[]" maxlength="1"
                            class="otp-input w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none transition-all"
                            inputmode="numeric" pattern="[0-9]" required>
                        <input type="text" name="otp[]" maxlength="1"
                            class="otp-input w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none transition-all"
                            inputmode="numeric" pattern="[0-9]" required>
                        <input type="text" name="otp[]" maxlength="1"
                            class="otp-input w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 outline-none transition-all"
                            inputmode="numeric" pattern="[0-9]" required>
                    </div>

                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                            <p class="text-red-600 text-sm text-center">{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <!-- Timer -->
                    <div class="text-center mb-6">
                        <p class="text-gray-500 text-sm">
                            Kode berlaku selama <span id="timer" class="font-semibold text-red-500">05:00</span>
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold text-base shadow-lg">
                        Verifikasi
                    </button>
                </form>

                <!-- Resend OTP (outside form) -->
                <div class="text-center mt-4">
                    <p class="text-gray-500 text-sm mb-2">Tidak menerima kode?</p>
                    <a href="{{ route('otp.resend') }}" id="resendBtn"
                        class="inline-block text-red-500 hover:text-red-600 font-medium text-sm transition pointer-events-none opacity-50">
                        <span id="resendText">Kirim Ulang OTP (<span id="resendTimer">60</span>s)</span>
                    </a>
                </div>

                <!-- Debug: Show OTP (hapus di production) -->
                @if(config('app.debug') && isset($otp))
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-xl">
                        <p class="text-yellow-700 text-sm text-center">
                            <strong>Debug OTP:</strong> {{ $otp }}
                        </p>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-xl">
                        <p class="text-green-600 text-sm text-center">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Back to Login -->
                <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                    <a href="{{ route('login') }}"
                        class="text-gray-500 hover:text-gray-700 text-sm flex items-center justify-center gap-2 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Login
                    </a>
                </div>

            </div>

        </div>
    </div>

    <script>
        // Auto-focus and move to next input
        const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Only allow numbers
                e.target.value = e.target.value.replace(/[^0-9]/g, '');

                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });

            // Handle paste
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                pastedData.split('').forEach((char, i) => {
                    if (otpInputs[i]) {
                        otpInputs[i].value = char;
                    }
                });
                if (pastedData.length > 0) {
                    otpInputs[Math.min(pastedData.length, otpInputs.length) - 1].focus();
                }
            });
        });

        // Focus first input on load
        otpInputs[0].focus();

        // OTP Expiry Timer (5 minutes)
        let otpTimeLeft = 300;
        const timerDisplay = document.getElementById('timer');

        const otpCountdown = setInterval(() => {
            otpTimeLeft--;
            const minutes = Math.floor(otpTimeLeft / 60);
            const seconds = otpTimeLeft % 60;
            timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            if (otpTimeLeft <= 0) {
                clearInterval(otpCountdown);
                timerDisplay.textContent = '00:00';
                timerDisplay.classList.add('text-red-600');
            }
        }, 1000);

        // Resend Cooldown Timer (60 seconds)
        let resendTimeLeft = 60;
        const resendBtn = document.getElementById('resendBtn');
        const resendTimerSpan = document.getElementById('resendTimer');
        const resendText = document.getElementById('resendText');

        const resendCountdown = setInterval(() => {
            resendTimeLeft--;
            resendTimerSpan.textContent = resendTimeLeft;

            if (resendTimeLeft <= 0) {
                clearInterval(resendCountdown);
                // Enable resend button
                resendBtn.classList.remove('pointer-events-none', 'opacity-50');
                resendBtn.classList.add('hover:underline');
                resendText.textContent = 'Kirim Ulang OTP';
            }
        }, 1000);
    </script>

</body>

</html>