@section('title', 'Check Out Visitor')
@section('subtitle', 'Scan barcode untuk check-out visitor')
@extends('layout.app')
@section('content')

    {{-- Header Card --}}
    <div class="relative overflow-hidden rounded-2xl mb-6" style="box-shadow: 0 10px 40px -10px rgba(239,68,68,0.25);">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-700"></div>
        <div class="relative p-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <span class="material-icons-outlined text-white text-3xl">logout</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Check Out</h2>
                    <p class="text-red-100/80 text-sm mt-0.5">Scan atau input kode untuk check-out</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Input + Data (2/3) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-4">
                {{-- Input Kode --}}
                <input type="text" id="kode" autofocus
                    class="p-4 w-full border border-gray-500 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent text-center text-2xl font-mono tracking-widest"
                    placeholder="Masukan Kode Card">
            </div>

            {{-- Loading Indicator --}}
            <div id="loadingIndicator" class="hidden mt-4">
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-8 text-center">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-500 mx-auto mb-3"></div>
                    <p class="text-sm text-gray-500">Memproses kode...</p>
                </div>
            </div>

            {{-- Error Message --}}
            <div id="errorMessage" class="hidden mt-4">
                <div class="bg-red-50 rounded-2xl shadow-md border border-red-200 overflow-hidden p-6 text-center">
                    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-3">
                        <span class="material-icons-outlined text-red-500 text-2xl">error_outline</span>
                    </div>
                    <p id="errorText" class="text-base font-semibold text-red-600"></p>
                </div>
            </div>

            {{-- Visitor Data (muncul setelah AJAX) --}}
            <div id="visitorData" class="hidden mt-4">
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Informasi Visitor</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Nama --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">badge</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama</p>
                                <p id="visitorName" class="text-sm font-medium text-gray-800 mt-0.5">-</p>
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">phone</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No HP</p>
                                <p id="visitorPhone" class="text-sm font-medium text-gray-800 mt-0.5">-</p>
                            </div>
                        </div>

                        {{-- User Meeting --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">groups</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">User Meeting</p>
                                <p id="visitorMeeting" class="text-sm font-medium text-gray-800 mt-0.5">-</p>
                            </div>
                        </div>

                        {{-- Type --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">category</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Type</p>
                                <p class="text-sm font-medium text-gray-800 mt-0.5">
                                    <span id="visitorType"
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">-</span>
                                </p>
                            </div>
                        </div>

                        {{-- Check In --}}
                        <div class="flex items-start gap-3 p-4 bg-green-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-green-600" style="font-size:20px;">login</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Check In</p>
                                <p id="visitorCheckIn" class="text-sm font-medium text-gray-800 mt-0.5">-</p>
                            </div>
                        </div>

                        {{-- Check Out --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">logout</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Check Out</p>
                                <p id="visitorCheckOut" class="text-sm font-medium text-gray-800 mt-0.5">-</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Status Card (1/3) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden sticky top-6">
                <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Status & Aksi</h3>
                </div>
                <div class="p-6">
                    {{-- Default State --}}
                    <div id="statusDefault" class="text-center">
                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                            <span class="material-icons-outlined text-gray-400 text-3xl">qr_code_scanner</span>
                        </div>
                        <p class="text-lg font-bold text-gray-400">Silakan Scan Barcode</p>
                        <p class="text-sm text-gray-300 mt-1">Untuk Check-Out Visitor</p>
                    </div>

                    {{-- Success State --}}
                    <div id="statusSuccess" class="hidden text-center">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-3">
                            <span class="material-icons-outlined text-red-500 text-3xl">logout</span>
                        </div>
                        <p class="text-lg font-bold text-red-600">Check-Out Berhasil!</p>
                        <p class="text-sm text-red-500 mt-1">Visitor telah melakukan check-out</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AJAX Script --}}
    <script>
        const kodeInput = document.getElementById('kode');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const errorMessage = document.getElementById('errorMessage');
        const errorText = document.getElementById('errorText');
        const visitorData = document.getElementById('visitorData');
        const statusDefault = document.getElementById('statusDefault');
        const statusSuccess = document.getElementById('statusSuccess');

        function resetUI() {
            loadingIndicator.classList.add('hidden');
            errorMessage.classList.add('hidden');
            visitorData.classList.add('hidden');
            statusDefault.classList.remove('hidden');
            statusSuccess.classList.add('hidden');
        }

        function showError(message) {
            loadingIndicator.classList.add('hidden');
            visitorData.classList.add('hidden');
            errorMessage.classList.remove('hidden');
            errorText.textContent = message;
        }

        function showVisitorData(data) {
            loadingIndicator.classList.add('hidden');
            errorMessage.classList.add('hidden');
            visitorData.classList.remove('hidden');

            document.getElementById('visitorName').textContent = data.name || '-';
            document.getElementById('visitorPhone').textContent = data.no_hp || '-';
            document.getElementById('visitorMeeting').textContent = data.user_meeting || '-';
            document.getElementById('visitorType').textContent = data.type || '-';
            document.getElementById('visitorCheckIn').textContent = data.check_in || '-';
            document.getElementById('visitorCheckOut').textContent = data.check_out || '-';

            // Update status sidebar
            statusDefault.classList.add('hidden');
            statusSuccess.classList.remove('hidden');
        }

        // Auto-submit dengan debounce (tunggu 600ms setelah berhenti ketik)
        let debounceTimer = null;
        kodeInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const kode = this.value.trim();
            if (kode.length === 0) { resetUI(); return; }

            debounceTimer = setTimeout(() => handleCheckout(kode), 600);
        });

        // Juga submit saat tekan Enter
        kodeInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(debounceTimer);
                const kode = this.value.trim();
                if (kode.length > 0) handleCheckout(kode);
            }
        });

        async function handleCheckout(kode) {
            resetUI();
            loadingIndicator.classList.remove('hidden');
            statusDefault.classList.add('hidden');

            try {
                const response = await fetch("{{ route('scan-out.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ kode: kode }),
                });

                const result = await response.json();

                if (result.success) {
                    showVisitorData(result.data);
                } else {
                    showError(result.message);
                    statusDefault.classList.remove('hidden');
                }
            } catch (error) {
                showError('Terjadi kesalahan jaringan. Coba lagi.');
                statusDefault.classList.remove('hidden');
            }

            // Clear input untuk scan berikutnya
            setTimeout(() => { kodeInput.value = ''; kodeInput.focus(); }, 500);
        }
    </script>

@endsection