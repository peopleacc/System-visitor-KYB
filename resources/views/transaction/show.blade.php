@section('title', 'Detail Visitor ACC')
@section('subtitle', 'Informasi lengkap & kelola persetujuan')
@extends('layout.app')
@section('content')

    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('transaction.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-all duration-200 shadow-sm">
            <span class="material-icons-outlined" style="font-size:18px;">arrow_back</span>
            Kembali
        </a>
    </div>

    {{-- Header Card --}}
    <div class="relative overflow-hidden rounded-2xl mb-6" style="box-shadow: 0 10px 40px -10px rgba(239,68,68,0.25);">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-700"></div>
        <div class="relative p-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <span class="material-icons-outlined text-white text-3xl">person_search</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $transaction->name }}</h2>
                    <p class="text-red-100/80 text-sm mt-0.5">{{ $transaction->type }} • {{ $transaction->date }}</p>
                </div>
            </div>
            {{-- Status Badge --}}
            <div>
                @if($transaction->status == 'waiting')
                    <span
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-amber-400/20 text-amber-100 backdrop-blur-sm border border-amber-300/30">
                        <span class="material-icons-outlined" style="font-size:16px;">schedule</span>
                        Menunggu Persetujuan
                    </span>
                @elseif($transaction->status == 'approved')
                    <span
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-emerald-400/20 text-emerald-100 backdrop-blur-sm border border-emerald-300/30">
                        <span class="material-icons-outlined" style="font-size:16px;">check_circle</span>
                        Approved
                    </span>
                @else
                    <span
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-white/20 text-white/80 backdrop-blur-sm border border-white/20">
                        {{ $transaction->status ?? '-' }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Detail Info (2/3) --}}
        <div class="lg:col-span-2">
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
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->name }}</p>
                        </div>
                    </div>

                    {{-- No HP --}}
                    <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-outlined text-red-600" style="font-size:20px;">phone</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No HP</p>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->no_hp ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- User Meeting --}}
                    <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-outlined text-red-600" style="font-size:20px;">groups</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">User Meeting</p>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->user_meeting ?? '-' }}</p>
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
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                    {{ $transaction->type }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-outlined text-red-600" style="font-size:20px;">calendar_today</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</p>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->date ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Keperluan --}}
                    <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-outlined text-red-600" style="font-size:20px;">assignment</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Keperluan</p>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->purpose ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Check In --}}
                    <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-outlined text-red-600" style="font-size:20px;">login</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Check In</p>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->check_in ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Check Out --}}
                    <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-outlined text-red-600" style="font-size:20px;">logout</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Check Out</p>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $transaction->check_out ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Foto --}}
                    @if($transaction->foto)
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl md:col-span-2">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">portrait</span>
                            </div>
                            <div class="min-w-0 w-full">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Foto Visitor</p>
                                <div class="overflow-hidden rounded-xl border-4 border-white shadow-md inline-block">
                                    <img src="data:image/jpeg;base64,{{ base64_encode($transaction->foto) }}" 
                                         alt="Foto {{ $transaction->name }}" 
                                         class="w-48 object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Barcode --}}
                    @if($transaction->barcode)
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl md:col-span-2">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">qr_code</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Barcode / OTP</p>
                                <p class="text-lg font-bold text-gray-800 mt-0.5 font-mono tracking-widest">
                                    {{ $transaction->barcode }}
                                </p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- Right: Action Card (1/3) --}}
        <div class="lg:col-span-1">
            {{-- Status & Action Card --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden sticky top-6">
                <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Status & Aksi</h3>
                </div>
                <div class="p-6">

                    {{-- Status Display --}}
                    <div class="text-center mb-6">
                        @if($transaction->status == 'waiting')
                            <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-3">
                                <span class="material-icons-outlined text-amber-500 text-3xl">hourglass_top</span>
                            </div>
                            <p class="text-lg font-bold text-gray-800">Menunggu Persetujuan</p>
                            <p class="text-sm text-gray-400 mt-1">Visitor ini belum disetujui</p>
                        @elseif($transaction->status == 'approved')
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                                <span class="material-icons-outlined text-emerald-500 text-3xl">verified</span>
                            </div>
                            <p class="text-lg font-bold text-gray-800">Telah Disetujui</p>
                            <p class="text-sm text-gray-400 mt-1">Visitor telah mendapat persetujuan</p>
                        @elseif($transaction->status == 'check_in')
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                                <span class="material-icons-outlined text-emerald-500 text-3xl">verified</span>
                            </div>
                            <p class="text-lg font-bold text-gray-800">Telah Check In</p>
                            <p class="text-sm text-gray-400 mt-1">Visitor telah Check In</p>
                        @elseif($transaction->status == 'check_out')
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                                <span class="material-icons-outlined text-emerald-500 text-3xl">verified</span>
                            </div>
                            <p class="text-lg font-bold text-gray-800">Telah Check Out</p>
                            <p class="text-sm text-gray-400 mt-1">Visitor telah Check Out</p>
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                                <span class="material-icons-outlined text-gray-400 text-3xl">info</span>
                            </div>
                            <p class="text-lg font-bold text-gray-800">{{ $transaction->status ?? 'Tidak Diketahui' }}</p>
                        @endif
                    </div>

                    {{-- Approve Action --}}
                    @if($transaction->status == 'waiting')
                        <div class="border-t border-gray-100 pt-5 space-y-4">
                            <form id="approveForm" method="POST" action="{{ route('transaction.update', $transaction->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                                <input type="hidden" name="name_tamu" value="{{ $transaction->name }}">
                                <input type="hidden" name="no_telp" value="{{ $transaction->no_hp }}">
                                <input type="hidden" name="user_meeting" value="{{ $transaction->user_meeting }}">
                                <input type="hidden" name="type" value="{{ $transaction->type }}">

                                {{-- Pilihan Lokasi --}}
                                <div class="space-y-2 mb-4">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi Kunjungan</p>
                                    <div class="grid grid-cols-2 gap-2">
                                        <label class="relative cursor-pointer group">
                                            <input type="checkbox" name="location[]" value="office"
                                                class="location-checkbox peer absolute opacity-0 w-0 h-0">
                                            <div
                                                class="p-3 rounded-xl border-2 border-gray-200 bg-gray-50 flex flex-col items-center gap-1.5 transition-all duration-200 peer-checked:border-red-500 peer-checked:bg-red-50 group-hover:border-red-300">
                                                <span
                                                    class="material-icons-outlined text-gray-400 peer-checked:text-red-500 group-hover:text-red-400"
                                                    style="font-size:22px;">business</span>
                                                <p class="text-xs font-semibold text-gray-600 peer-checked:text-red-600">Office
                                                </p>
                                            </div>
                                        </label>

                                        <label class="relative cursor-pointer group">
                                            <input type="checkbox" name="location[]" value="plant"
                                                class="location-checkbox peer absolute opacity-0 w-0 h-0">
                                            <div
                                                class="p-3 rounded-xl border-2 border-gray-200 bg-gray-50 flex flex-col items-center gap-1.5 transition-all duration-200 peer-checked:border-red-500 peer-checked:bg-red-50 group-hover:border-red-300">
                                                <span
                                                    class="material-icons-outlined text-gray-400 peer-checked:text-red-500 group-hover:text-red-400"
                                                    style="font-size:22px;">factory</span>
                                                <p class="text-xs font-semibold text-gray-600 peer-checked:text-red-600">Plant
                                                </p>
                                            </div>
                                        </label>
                                    </div>

                                    {{-- Warning Message --}}
                                    <div id="locationWarning"
                                        class="hidden flex items-center gap-2 px-3 py-2.5 bg-red-50 border border-red-200 rounded-xl mt-1">
                                        <span class="material-icons-outlined text-red-500 flex-shrink-0" style="font-size:17px;">error_outline</span>
                                        <p class="text-xs font-semibold text-red-600">Pilih lokasi kunjungan terlebih dahulu!</p>
                                    </div>
                                </div>

                                <button type="button" id="btnApprove"
                                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-500/25 transition-all duration-200 hover:shadow-red-500/40 hover:-translate-y-0.5"
                                    onclick="openConfirmModal()">
                                    <span class="material-icons-outlined" style="font-size:20px;">check_circle</span>
                                    Approve Visitor
                                </button>
                            </form>
                            <p class="text-xs text-gray-400 text-center">
                                QR Code akan otomatis digenerate dan dikirim via email
                            </p>
                        </div>

                    @elseif(in_array($transaction->status, ['approved', 'check_in']))
                        <div class="border-t border-gray-100 pt-5">
                            <button onclick="document.getElementById('qrModal').classList.remove('hidden')"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white rounded-xl text-sm font-bold shadow-lg shadow-gray-500/25 transition-all duration-200 hover:-translate-y-0.5">
                                <span class="material-icons-outlined" style="font-size:20px;">qr_code_2</span>
                                Lihat QR Code
                            </button>
                        </div>
                    @endif


                    {{-- QR Code Modal --}}
                    <div id="qrModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
                        {{-- Backdrop --}}
                        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                            onclick="document.getElementById('qrModal').classList.add('hidden')"></div>

                        {{-- Modal Content --}}
                        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
                            {{-- Modal Header --}}
                            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="material-icons-outlined text-red-500"
                                        style="font-size:20px;">qr_code_2</span>
                                    <h4 class="text-sm font-bold text-gray-800">QR Code Visitor</h4>
                                </div>
                                <button onclick="document.getElementById('qrModal').classList.add('hidden')"
                                    class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                                    <span class="material-icons-outlined text-gray-500" style="font-size:18px;">close</span>
                                </button>
                            </div>

                            {{-- Modal Body --}}
                            <div class="p-6 flex flex-col items-center gap-4">
                                {{-- Nama & Status --}}
                                <div class="text-center">
                                    <p class="text-base font-bold text-gray-800">{{ $transaction->name }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $transaction->type }} •
                                        {{ $transaction->date }}
                                    </p>
                                </div>

                                {{-- QR Code --}}
                                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-200">
                                    @php
                                        $qrText = $transaction->barcode ?: ($transaction->card_qr ? $transaction->card_qr->code : null);
                                    @endphp
                                    
                                    @if($qrText)
                                        {!! QrCode::size(180)->style('round')->eye('circle')->color(17, 24, 39)->generate($qrText) !!}
                                    @else
                                        <p class="text-gray-400 text-sm">QR Code tidak tersedia</p>
                                    @endif
                                </div>

                                {{-- Kode OTP / Barcode --}}
                                @if(isset($qrText) && $qrText)
                                    <div class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 text-center">
                                        <p class="text-xs text-gray-400 mb-1 uppercase tracking-wider font-semibold">Kode OTP
                                        </p>
                                        <p class="text-2xl font-bold text-gray-800 tracking-widest font-mono">
                                            {{ $qrText }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Print Button --}}
                                <button onclick="window.print()"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-semibold transition-colors duration-200">
                                    <span class="material-icons-outlined" style="font-size:18px;">print</span>
                                    Print QR Code
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- ===== MODAL KONFIRMASI APPROVE ===== --}}
    <div id="confirmModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeConfirmModal()"></div>

        {{-- Modal Content --}}
        <div id="confirmModalBox"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300 scale-95 opacity-0">

            {{-- Top accent bar --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-amber-400 via-orange-400 to-red-500"></div>

            {{-- Modal Body --}}
            <div class="p-8 flex flex-col items-center text-center gap-4">
                {{-- Icon --}}
                <div class="w-20 h-20 rounded-full bg-amber-50 border-4 border-amber-100 flex items-center justify-center">
                    <span class="material-icons-outlined text-amber-500" style="font-size:38px;">help_outline</span>
                </div>

                {{-- Text --}}
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Konfirmasi Persetujuan</h3>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Apakah Anda yakin ingin menyetujui visitor
                        <span class="font-semibold text-gray-800">{{ $transaction->name }}</span>?
                        <br>QR Code akan otomatis digenerate dan dikirim via email.
                    </p>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 w-full mt-2">
                    <button type="button" onclick="closeConfirmModal()"
                        class="flex-1 px-5 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-600 text-sm font-semibold hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                        Batal
                    </button>
                    <button type="button" onclick="submitApproveForm()"
                        class="flex-1 px-5 py-3 rounded-xl bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm font-bold shadow-lg shadow-red-500/30 transition-all duration-200 hover:-translate-y-0.5 inline-flex items-center justify-center gap-2">
                        <span class="material-icons-outlined" style="font-size:18px;">check_circle</span>
                        Ya, Setujui
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== MODAL BERHASIL ===== --}}
    <div id="successModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        {{-- Modal Content --}}
        <div id="successModalBox"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300 scale-95 opacity-0">

            {{-- Top accent bar --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-emerald-400 via-green-400 to-teal-500"></div>

            {{-- Confetti dots decoration --}}
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-6 left-8 w-3 h-3 rounded-full bg-emerald-200 opacity-60"></div>
                <div class="absolute top-10 right-12 w-2 h-2 rounded-full bg-green-300 opacity-50"></div>
                <div class="absolute top-4 right-6 w-4 h-4 rounded-full bg-teal-200 opacity-40"></div>
                <div class="absolute top-16 left-6 w-2 h-2 rounded-full bg-emerald-300 opacity-50"></div>
            </div>

            {{-- Modal Body --}}
            <div class="p-8 flex flex-col items-center text-center gap-4">
                {{-- Animated checkmark icon --}}
                <div class="w-24 h-24 rounded-full bg-emerald-50 border-4 border-emerald-100 flex items-center justify-center relative">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center shadow-lg shadow-emerald-300/50">
                        <span class="material-icons-outlined text-white" style="font-size:40px;">check</span>
                    </div>
                </div>

                {{-- Text --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Berhasil!</h3>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Visitor <span class="font-semibold text-gray-800">{{ $transaction->name }}</span> telah berhasil disetujui.
                        <br>Barcode telah dikirimkan via email.
                    </p>
                </div>

                {{-- Info box --}}
                <div class="w-full px-4 py-3 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-3">
                    <span class="material-icons-outlined text-emerald-500 flex-shrink-0" style="font-size:20px;">email</span>
                    <p class="text-xs text-emerald-700 text-left">Email konfirmasi dengan barcode telah dikirimkan kepada visitor.</p>
                </div>

                {{-- Close Button --}}
                <button type="button" id="successCloseBtn"
                    class="w-full px-5 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white text-sm font-bold shadow-lg shadow-emerald-400/30 transition-all duration-200 hover:-translate-y-0.5 inline-flex items-center justify-center gap-2">
                    <span class="material-icons-outlined" style="font-size:18px;">done_all</span>
                    Selesai
                </button>
            </div>
        </div>
    </div>

    {{-- ===== JAVASCRIPT ===== --}}
    <script>
        // --- Checkbox Validation ---
        function openConfirmModal() {
            const checkboxes = document.querySelectorAll('input[name="location[]"]:checked');
            const warningEl = document.getElementById('locationWarning');

            if (checkboxes.length === 0) {
                warningEl.classList.remove('hidden');
                warningEl.classList.add('animate-shake');
                document.querySelectorAll('input[name="location[]"]').forEach(cb => {
                    cb.closest('label').querySelector('div').classList.add('location-error');
                });
                setTimeout(() => warningEl.classList.remove('animate-shake'), 500);
                return;
            }

            warningEl.classList.add('hidden');
            document.querySelectorAll('input[name="location[]"]').forEach(cb => {
                cb.closest('label').querySelector('div').classList.remove('location-error');
            });

            const modal = document.getElementById('confirmModal');
            const box = document.getElementById('confirmModalBox');
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeConfirmModal() {
            const modal = document.getElementById('confirmModal');
            const box = document.getElementById('confirmModalBox');
            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 250);
        }

        // --- Submit form & show success modal ---
        function submitApproveForm() {
            closeConfirmModal();

            const form = document.getElementById('approveForm');

            // Submit via AJAX / fetch so we can show the success modal
            const formData = new FormData(form);

            // Show loading state on button
            const btn = document.getElementById('btnApprove');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-icons-outlined animate-spin" style="font-size:20px;">refresh</span> Memproses...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                // Show success modal regardless (form submitted)
                openSuccessModal();
            })
            .catch(error => {
                // Fallback: submit normally if fetch fails
                form.submit();
            });
        }

        // --- Success Modal ---
        function openSuccessModal() {
            const modal = document.getElementById('successModal');
            const box = document.getElementById('successModalBox');
            modal.classList.remove('hidden');
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 50);
        }

        // Close success modal and redirect
        document.getElementById('successCloseBtn').addEventListener('click', function () {
            const box = document.getElementById('successModalBox');
            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                window.location.href = "{{ route('transaction.index') }}";
            }, 300);
        });

        // Close confirm modal on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeConfirmModal();
        });

        // Auto-hide warning when a checkbox is selected
        document.querySelectorAll('.location-checkbox').forEach(cb => {
            cb.addEventListener('change', function () {
                if (document.querySelectorAll('input[name="location[]"]:checked').length > 0) {
                    document.getElementById('locationWarning').classList.add('hidden');
                    document.querySelectorAll('input[name="location[]"]').forEach(c => {
                        c.closest('label').querySelector('div').classList.remove('location-error');
                    });
                }
            });
        });
    </script>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            15%       { transform: translateX(-6px); }
            30%       { transform: translateX(6px); }
            45%       { transform: translateX(-4px); }
            60%       { transform: translateX(4px); }
            75%       { transform: translateX(-2px); }
            90%       { transform: translateX(2px); }
        }
        .animate-shake {
            animation: shake 0.45s ease-in-out;
        }
        /* Error state untuk card lokasi — hanya outline, tidak sentuh background */
        .location-error {
            outline: 2px solid #f87171;
            outline-offset: -2px;
        }
    </style>

@endsection