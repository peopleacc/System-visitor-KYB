<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - KYB System</title>
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
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-red-400/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-8">

        <div class="w-full max-w-md animate-fade-in">

            <!-- Login Card -->
            <div class="glass rounded-3xl shadow-2xl p-8 sm:p-10">

                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <div class="bg-white rounded-2xl p-4 shadow-lg">
                        <img src="{{ asset('image/kayaba-logo.png') }}" alt="Kayaba Logo" class="h-12 w-auto">
                    </div>
                </div>

                <!-- Welcome Text -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back</h1>
                    <p class="text-gray-500 text-sm">Sign in to continue to KYB System</p>
                </div>

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Email Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" name="npk" placeholder="npk" required
                                class="input-enhanced w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 focus:bg-white focus:outline-none">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </span>
                            <input type="password" name="password" placeholder="••••••••" p required
                                class="input-enhanced w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 focus:bg-white focus:outline-none">

                            @if ($errors->has('password'))
                                <span class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</span>

                            @endif
                        </div>
                    </div>


                    <!-- captcha -->
                    <div class="mb-3">
                        <label>Masukkan Angka Berikut</label>
                        <div class="flex items-center gap-3">
                            <span class="captcha-img">{!! captcha_img('math') !!}</span>
                            <button type="button" onclick="refreshCaptcha()" class="text-red-500 hover:text-red-700">↻
                                Refresh</button>
                        </div>
                        <input type="text" name="captcha" 
                            class="border-black border mt-2 {{ $errors->has('captcha') ? 'border-red-500' : '' }} " required />
                        @error('captcha')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <script>
                        function refreshCaptcha() {
                            fetch('/refresh-captcha')
                                .then(response => response.json())
                                .then(data => {
                                    document.querySelector('.captcha-img').innerHTML = data.captcha;
                                });
                        }
                    </script>


                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-red-500 focus:ring-red-400" />
                            <span class="text-sm text-gray-600 group-hover:text-gray-800 transition">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-red-500 hover:text-red-600 font-medium transition">Forgot
                            password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn-primary w-full text-white py-3.5 rounded-xl font-semibold text-base shadow-lg">
                        Sign In
                    </button>
                </form>

                @if (session('status') || session('error') || $errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border-l-4 border-red-500 p-5 shadow-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                @if (session('error'))
                                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                                @endif

                                @if ($errors->has('npk'))
                                    <p class="text-sm text-red-700 mt-1">{{ $errors->first('npk') }}</p>
                                @endif

                                @if ($errors->has('password'))
                                    <p class="text-sm text-red-700 mt-1">{{ $errors->first('password') }}</p>
                                @endif

                                @if ($errors->has('captcha'))
                                    <p class="text-sm text-red-700 mt-1">{{ $errors->first('captcha') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} KYB System. All rights reserved.
                    </p>
                </div>

            </div>

        </div>
    </div>

</body>

</html>