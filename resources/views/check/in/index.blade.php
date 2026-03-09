@section('title', 'Check In Visitor')
@section('subtitle', 'Scan barcode untuk check-in visitor')
@extends('layout.app')
@section('content')

    {{-- Header Card --}}
    <div class="relative overflow-hidden rounded-2xl mb-6" style="box-shadow: 0 10px 40px -10px rgba(239,68,68,0.25);">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-700"></div>
        <div class="relative p-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <span class="material-icons-outlined text-white text-3xl">login</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Check In</h2>
                    <p class="text-red-100/80 text-sm mt-0.5">Scan atau input kode untuk check-in</p>
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

                        {{-- Check In Time --}}
                        <div class="flex items-start gap-3 p-4 bg-green-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-green-600" style="font-size:20px;">login</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Check In</p>
                                <p id="visitorCheckIn" class="text-sm font-medium text-gray-800 mt-0.5">-</p>
                            </div>
                        </div>

                        {{-- Kode Card --}}
                        <div class="flex items-start gap-3 p-4 bg-blue-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-blue-600"
                                    style="font-size:20px;">credit_card</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Kode Card</p>
                                <p id="visitorCardCode"
                                    class="text-sm font-medium text-gray-800 mt-0.5 font-mono tracking-widest">-</p>
                            </div>
                        </div>

                    </div>

                    {{-- Checkout Button (tampil jika status checked_in) --}}
                    <div id="checkoutSection" class="hidden px-6 pb-6">
                        <div class="border-t border-gray-100 pt-5">
                            <button id="checkoutBtn" type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-500/25 transition-all duration-200 hover:-translate-y-0.5">
                                <span class="material-icons-outlined" style="font-size:20px;">logout</span>
                                Check Out Visitor
                            </button>
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
                        <p class="text-sm text-gray-300 mt-1">Untuk Check-In Visitor</p>
                    </div>

                    {{-- Success State --}}
                    <div id="statusSuccess" class="hidden text-center">
                        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-3">
                            <span class="material-icons-outlined text-green-500 text-3xl">check_circle</span>
                        </div>
                        <p id="statusTitle" class="text-lg font-bold text-green-600">Check-In Berhasil!</p>
                        <p id="statusSubtitle" class="text-sm text-green-500 mt-1">Visitor telah melakukan check-in</p>
                    </div>

                    {{-- Checked Out State --}}
                    <div id="statusCheckedOut" class="hidden text-center">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-3">
                            <span class="material-icons-outlined text-red-500 text-3xl">logout</span>
                        </div>
                        <p class="text-lg font-bold text-red-600">Check-Out Berhasil!</p>
                        <p class="text-sm text-red-500 mt-1">Visitor telah check-out</p>
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
        const checkoutSection = document.getElementById('checkoutSection');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const statusDefault = document.getElementById('statusDefault');
        const statusSuccess = document.getElementById('statusSuccess');
        const statusCheckedOut = document.getElementById('statusCheckedOut');
        const statusTitle = document.getElementById('statusTitle');
        const statusSubtitle = document.getElementById('statusSubtitle');

        let currentTransactionId = null;

        function resetUI() {
            loadingIndicator.classList.add('hidden');
            errorMessage.classList.add('hidden');
            visitorData.classList.add('hidden');
            checkoutSection.classList.add('hidden');
            statusDefault.classList.remove('hidden');
            statusSuccess.classList.add('hidden');
            statusCheckedOut.classList.add('hidden');
            currentTransactionId = null;
        }

        function showError(message) {
            loadingIndicator.classList.add('hidden');
            visitorData.classList.add('hidden');
            errorMessage.classList.remove('hidden');
            errorText.textContent = message;
        }

        function showVisitorData(data, message) {
            loadingIndicator.classList.add('hidden');
            errorMessage.classList.add('hidden');
            visitorData.classList.remove('hidden');

            document.getElementById('visitorName').textContent = data.name || '-';
            document.getElementById('visitorPhone').textContent = data.no_hp || '-';
            document.getElementById('visitorMeeting').textContent = data.user_meeting || '-';
            document.getElementById('visitorType').textContent = data.type || '-';
            document.getElementById('visitorCheckIn').textContent = data.check_in || '-';
            document.getElementById('visitorCardCode').textContent = data.card_code || '-';

            currentTransactionId = data.id;

            // Tampilkan tombol checkout jika status checked_in
            if (data.status === 'checked_in') {
                checkoutSection.classList.remove('hidden');
            }

            // Update status sidebar
            statusDefault.classList.add('hidden');
            statusSuccess.classList.remove('hidden');
            statusCheckedOut.classList.add('hidden');
            statusTitle.textContent = message || 'Check-In Berhasil!';
            statusSubtitle.textContent = data.status === 'checked_in' ? 'Visitor telah melakukan check-in' : 'Data visitor ditemukan';
        }

        // Auto-submit dengan debounce (tunggu 600ms setelah berhenti ketik)
        let debounceTimer = null;
        kodeInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const kode = this.value.trim();
            if (kode.length === 0) { resetUI(); return; }

            debounceTimer = setTimeout(() => handleCheckin(kode), 600);
        });

        // Juga submit saat tekan Enter
        kodeInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(debounceTimer);
                const kode = this.value.trim();
                if (kode.length > 0) handleCheckin(kode);
            }
        });

        async function handleCheckin(kode) {
            resetUI();
            loadingIndicator.classList.remove('hidden');
            statusDefault.classList.add('hidden');

            try {
                const response = await fetch("{{ route('scan.store') }}", {
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
                    showVisitorData(result.data, result.message);
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

        // Checkout button
        checkoutBtn.addEventListener('click', async function () {
            if (!currentTransactionId) return;
            if (!confirm('Apakah Anda yakin ingin checkout visitor ini?')) return;

            this.disabled = true;
            this.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div> Memproses...';

            try {
                const response = await fetch("{{ route('checkin.checkout.api') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ id: currentTransactionId }),
                });

                const result = await response.json();

                if (result.success) {
                    checkoutSection.classList.add('hidden');
                    statusSuccess.classList.add('hidden');
                    statusCheckedOut.classList.remove('hidden');

                    // Update check-in display to show checkout time
                    document.getElementById('visitorCheckIn').textContent = result.data.check_out || '-';
                } else {
                    alert(result.message);
                }
            } catch (error) {
                alert('Terjadi kesalahan jaringan.');
            }

            this.disabled = false;
            this.innerHTML = '<span class="material-icons-outlined" style="font-size:20px;">logout</span> Check Out Visitor';
        });
    </script>

@endsection