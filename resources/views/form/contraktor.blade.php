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

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 w-full max-w-2xl">
        <!-- Main Card -->
        <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-100 px-8 py-6">
                <div class="flex flex-col items-center text-center">
                    <img class="h-16 w-auto mb-3" src="{{ asset('image/kayaba-logo.png') }}" alt="Kayaba Logo">
                    <h1 class="text-2xl font-bold text-gray-800">Form Kunjungan</h1>
                    <p class="text-sm text-gray-400">PT KAYABA INDONESIA</p>

                    <span
                        class="mt-2 inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Contraktor
                    </span>
                </div>
            </header>

            <!-- Form -->
            <section class="p-8">
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

                <form action="{{ route('form.contraktor-store') }}" method="POST" class="space-y-5" id="contraktorForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">



                        <!-- Name Field -->
                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Nama PT <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama_pt" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="Masukkan nama lengkap Perusahaan">
                            @error('nama_pt')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Nama Perusahaan <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama_perusahaan" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="Masukkan nama lengkap PT">
                            @error('nama_perusahaan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                    <!-- Company -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Area Pekerjaan <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="area_pekerjaan" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="Area pekerjaan">
                            @error('area_pekerjaan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                email <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="email" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="example@email.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class=" block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                No Police <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="no_police" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="B 1234 ">
                            @error('no_police')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class=" block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Tanggal <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="B 1234 ">
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>



                    </div>

                    <!-- Two Column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                user Pic <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="pic" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="Nama Lengkap Pic">
                            @error('pic')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Jumlah MP <span class="text-red-400">*</span>
                            </label>
                            <input type="number" name="jumlah_mp" min="0" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="">
                            @error('jumlah_mp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                        <!-- Phone -->
                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Safety Officer Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="safety_officer_nama" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="Nama Lengkap Safety Officer">
                            @error('safety_officer_nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">
                                Safety Officer No Telp <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="safety_officer_hp" required
                                class="input-field w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                                placeholder="08xxxxxxxxxxx">
                            @error('safety_officer_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <!-- Email -->




                    {{-- Camera Section --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                            <h3 class="text-xs font-semibold text-red-600 uppercase tracking-wider">Foto Muka</h3>
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


                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-semibold text-lg rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Submit Kunjungan</span>
                        </button>
                    </div>
                </form>

                <!-- Back Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('transaction.index') }}"
                        class="inline-flex items-center text-gray-500 hover:text-red-600 transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke halaman sebelumnya
                    </a>
                </div>
            </section>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
        let facingMode = 'user';

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

</html>