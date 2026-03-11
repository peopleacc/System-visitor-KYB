<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kunjungan - PT KAYABA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #991b1b 100%);
        }

        .floating-label {
            transition: all 0.2s ease;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4 font-[Inter]">

    <div class="relative z-10 w-full max-w-2xl my-6">
        {{-- Main Card --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            {{-- Red accent bar --}}
            <div class="h-1.5 bg-red-600"></div>

            {{-- Header --}}
            <header class="px-8 pt-8 pb-6 text-center border-b border-gray-100">
                <div class="flex flex-col items-center gap-3">
                    <img class="h-16 w-auto mb-3" src="{{ asset('image/kayaba-logo.png') }}" alt="Kayaba Logo">

                    <div class="space-y-1">
                        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Form Kunjungan</h1>
                        <p class="text-sm text-gray-400">PT KAYABA INDONESIA</p>
                    </div>

                    <span
                        class="inline-flex items-center gap-1.5 px-4 py-1.5 m-2 rounded-full text-xs font-semibold bg-red-50 text-red-600 border border-red-100 uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Visitor
                    </span>
                </div>
            </header>
            {{-- Form --}}
            <section class="px-8 py-7 mt-4">
                {{-- Error Alert --}}
                @if(session('error'))
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                        <div class="p-2 bg-red-100 rounded-lg shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-red-800">Mohon Maaf</h4>
                            <p class="text-sm text-red-600 mt-0.5">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('form.visitor-store') }}" method="POST" class="space-y-5" id="visitorForm"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                    {{-- Row 1: Nama & Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name_tamu" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="Masukkan nama lengkap Anda">
                            @error('name_tamu')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="Masukkan email Anda">
                            @error('email')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 2: Alamat & No. Telepon --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                Alamat Perusahaan <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="Alamat" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="Masukkan alamat perusahaan Anda">
                            @error('Alamat')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                No. Telepon <span class="text-red-400">*</span>
                            </label>
                            <input type="tel" name="no_telp" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="08xxxxxxxxxx">
                            @error('no_telp')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 3: Yang Ditemui & No. Telepon Yang Ditemui --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                Yang Ditemui <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="user_meeting" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="Nama orang yang ditemui">
                            @error('user_meeting')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                No. Telepon Yang Ditemui <span class="text-red-400">*</span>
                            </label>
                            <input type="tel" name="no_telp_user" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="08xxxxxxxxxx">
                            @error('no_telp_user')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    {{-- Vehicle Section --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                            <h3 class="text-sm font-semibold text-red-500">Informasi Kendaraan</h3>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
                            <label class="block text-sm font-medium text-gray-700">
                                Apakah Anda membawa kendaraan? <span class="text-red-400">*</span>
                            </label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="vehicle_option" id="vehicleYes" value="yes"
                                        class="peer absolute opacity-0 w-0 h-0" checked>
                                    <div
                                        class="p-3 rounded-xl border-2 border-gray-200 bg-white flex items-center transition-all duration-200 peer-checked:border-red-500 peer-checked:bg-red-50 group-hover:border-red-300 group-hover:bg-red-50/50">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3 shrink-0">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm">Ya, membawa kendaraan</p>
                                            <p class="text-xs text-gray-500">Isi nomor polisi kendaraan Anda</p>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="vehicle_option" id="vehicleNo" value="no"
                                        class="peer absolute opacity-0 w-0 h-0">
                                    <div
                                        class="p-3 rounded-xl border-2 border-gray-200 bg-white flex items-center transition-all duration-200 peer-checked:border-red-500 peer-checked:bg-red-50 group-hover:border-red-300 group-hover:bg-red-50/50">
                                        <div
                                            class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-3 shrink-0">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm">Tidak membawa kendaraan</p>
                                            <p class="text-xs text-gray-500">Anda datang tanpa kendaraan</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            {{-- Police Number Input --}}
                            <div id="policeInputSection" class="transition-all duration-300">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="no_police" id="no_police"
                                        class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:shadow-sm"
                                        placeholder="Masukkan nomor polisi (contoh: B 1234 XYZ)">
                                </div>
                                <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Isi dengan nomor polisi kendaraan yang Anda bawa
                                </p>
                            </div>

                            {{-- No Vehicle Info --}}
                            <div id="noVehicleInfo" class="hidden transition-all duration-300">
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 p-4 rounded-xl flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Anda tidak membawa kendaraan</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Silakan lanjutkan ke langkah berikutnya.
                                            Anda tidak perlu mengisi nomor polisi.</p>
                                    </div>
                                </div>
                            </div>

                            @error('no_police')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Urusan --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                            Urusan <span class="text-red-400">*</span>
                        </label>
                        <textarea name="keperluan" rows="3" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 resize-none transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                            placeholder="Urusan kunjungan"></textarea>
                        @error('keperluan')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Row 4: Jumlah & Tanggal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                Jumlah Pengunjung <span class="text-red-400">*</span>
                            </label>
                            <input name="jumlah_pengunjung" type="number" min="1" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm"
                                placeholder="Jumlah pengunjung">
                            @error('jumlah_pengunjung')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-semibold text-red-400 uppercase tracking-wider">
                                Tanggal Masuk <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal_masuk" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 focus:bg-white focus:shadow-sm">
                            @error('tanggal_masuk')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Camera Section --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                            <h3 class="text-sm font-semibold text-red-500">Foto Pengunjung</h3>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
                            <div class="relative w-full aspect-[4/3] bg-black rounded-xl overflow-hidden"
                                id="cameraContainer">
                                <video id="cameraPreview" autoplay playsinline
                                    class="w-full h-full object-cover"></video>
                                <img id="photoResult" class="w-full h-full object-cover hidden" alt="Foto">
                                <div id="cameraPlaceholder"
                                    class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 bg-gray-100">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-sm">Klik tombol di bawah untuk membuka kamera</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <button type="button" id="btnOpenCamera"
                                    class="flex-1 min-w-[120px] py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Buka Kamera
                                </button>
                                <button type="button" id="btnSwitchCamera"
                                    class="py-2.5 px-4 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2 hidden">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Ganti Kamera
                                </button>
                                <button type="button" id="btnCapture"
                                    class="flex-1 min-w-[120px] py-2.5 px-4 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2 hidden">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2" />
                                        <circle cx="12" cy="12" r="4" fill="currentColor" />
                                    </svg>
                                    Ambil Foto
                                </button>
                                <button type="button" id="btnRetake"
                                    class="flex-1 min-w-[120px] py-2.5 px-4 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2 hidden">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Foto Ulang
                                </button>
                            </div>

                            <input type="hidden" name="foto" id="fotoInput">
                            <canvas id="cameraCanvas" class="hidden"></canvas>
                        </div>
                    </div>

                    {{-- Confirmation --}}
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 space-y-3">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="confirmationCheck" required name="penting"
                                class="mt-0.5 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 shrink-0 cursor-pointer accent-red-600">
                            <label for="confirmationCheck" class="text-sm text-gray-600 leading-relaxed cursor-pointer">
                                Saya menyatakan bahwa data yang saya isi adalah benar dan dapat
                                dipertanggungjawabkan. Saya menyetujui bahwa data ini akan disimpan
                                dan digunakan sesuai dengan kebijakan privasi perusahaan.
                            </label>
                        </div>

                        <div class="flex items-center gap-2 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                            <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs text-blue-600">
                                Data yang Anda berikan akan disimpan dalam sistem kami dan hanya akan
                                digunakan untuk keperluan administrasi kunjungan.
                            </span>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-1 m-4">
                        <button type="submit" id="submitBtn"
                            class="w-full py-3.5 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-semibold text-base rounded-xl shadow-lg shadow-red-500/25 hover:shadow-xl hover:shadow-red-500/30 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Kunjungan
                        </button>
                    </div>
                </form>

                {{-- Back Link --}}
                <div class="m-4 text-center">
                    <a href="{{ route('desk.index') }}"
                        class="inline-flex items-center gap-1.5 text-gray-400 hover:text-red-500 transition-colors duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke halaman sebelumnya
                    </a>
                </div>
            </section>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const vehicleYes = document.getElementById('vehicleYes');
            const vehicleNo = document.getElementById('vehicleNo');
            const policeInputSection = document.getElementById('policeInputSection');
            const noVehicleInfo = document.getElementById('noVehicleInfo');
            const policeInput = document.getElementById('no_police');

            function updateVehicleSection() {
                if (vehicleYes.checked) {
                    policeInputSection.classList.remove('hidden');
                    noVehicleInfo.classList.add('hidden');
                    policeInput.required = true;
                    policeInput.disabled = false;
                    policeInput.name = 'no_police';

                    const hidden = document.getElementById('no_police_hidden');
                    if (hidden) hidden.remove();

                } else if (vehicleNo.checked) {
                    policeInputSection.classList.add('hidden');
                    noVehicleInfo.classList.remove('hidden');
                    policeInput.required = false;
                    policeInput.disabled = true;
                    policeInput.name = '';

                    if (!document.getElementById('no_police_hidden')) {
                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'no_police';
                        hidden.id = 'no_police_hidden';
                        hidden.value = 'tidak membawa kendaraan';
                        policeInput.parentElement.appendChild(hidden);
                    }
                }
            }

            updateVehicleSection();
            vehicleYes.addEventListener('change', updateVehicleSection);
            vehicleNo.addEventListener('change', updateVehicleSection);

            // Form submission & confirmation checkbox
            const form = document.getElementById('visitorForm');
            const confirmationCheck = document.getElementById('confirmationCheck');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function (e) {
                if (!confirmationCheck.checked) {
                    e.preventDefault();
                    showAlert();
                    highlightCheckbox();
                }
            });

            submitBtn.addEventListener('click', function (e) {
                if (!confirmationCheck.checked) {
                    e.preventDefault();
                    highlightCheckbox();
                }
            });

            function showAlert() {
                const alertDiv = document.createElement('div');
                alertDiv.className = 'fixed top-4 right-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg z-50 flex items-center gap-2 translate-x-full transition-transform duration-300';
                alertDiv.innerHTML = `
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-red-700">Harap centang kotak konfirmasi bahwa data Anda akan disimpan</p>
            `;
                document.body.appendChild(alertDiv);

                requestAnimationFrame(() => {
                    alertDiv.classList.remove('translate-x-full');
                    alertDiv.classList.add('translate-x-0');
                });

                setTimeout(() => {
                    alertDiv.classList.remove('translate-x-0');
                    alertDiv.classList.add('translate-x-full');
                    setTimeout(() => alertDiv.remove(), 300);
                }, 4000);
            }

            function highlightCheckbox() {
                confirmationCheck.scrollIntoView({ behavior: 'smooth', block: 'center' });
                confirmationCheck.classList.add('ring-2', 'ring-red-500');
                setTimeout(() => confirmationCheck.classList.remove('ring-2', 'ring-red-500'), 3000);
            }

            // ========== Camera Logic ==========
            const video = document.getElementById('cameraPreview');
            const canvas = document.getElementById('cameraCanvas');
            const photoResult = document.getElementById('photoResult');
            const placeholder = document.getElementById('cameraPlaceholder');
            const fotoInput = document.getElementById('fotoInput');
            const btnOpen = document.getElementById('btnOpenCamera');
            const btnSwitch = document.getElementById('btnSwitchCamera');
            const btnCapture = document.getElementById('btnCapture');
            const btnRetake = document.getElementById('btnRetake');

            let currentStream = null;
            let facingMode = 'user'; // 'user' = depan, 'environment' = belakang

            async function startCamera() {
                if (currentStream) {
                    currentStream.getTracks().forEach(t => t.stop());
                }
                try {
                    currentStream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: facingMode, width: { ideal: 1280 }, height: { ideal: 960 } },
                        audio: false
                    });
                    video.srcObject = currentStream;
                    video.classList.remove('hidden');
                    photoResult.classList.add('hidden');
                    placeholder.classList.add('hidden');
                    btnOpen.classList.add('hidden');
                    btnCapture.classList.remove('hidden');
                    btnSwitch.classList.remove('hidden');
                    btnRetake.classList.add('hidden');
                } catch (err) {
                    alert('Tidak dapat mengakses kamera. Pastikan izin kamera sudah diaktifkan.');
                    console.error(err);
                }
            }

            btnOpen.addEventListener('click', startCamera);

            btnSwitch.addEventListener('click', function () {
                facingMode = facingMode === 'user' ? 'environment' : 'user';
                startCamera();
            });

            btnCapture.addEventListener('click', function () {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
                photoResult.src = dataUrl;
                fotoInput.value = dataUrl;

                // Stop camera
                if (currentStream) {
                    currentStream.getTracks().forEach(t => t.stop());
                }
                video.classList.add('hidden');
                photoResult.classList.remove('hidden');
                btnCapture.classList.add('hidden');
                btnSwitch.classList.add('hidden');
                btnRetake.classList.remove('hidden');
                btnOpen.classList.add('hidden');
            });

            btnRetake.addEventListener('click', function () {
                fotoInput.value = '';
                photoResult.src = '';
                startCamera();
            });
        });
    </script>
</body>

</html>