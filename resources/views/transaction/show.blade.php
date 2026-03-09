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
                        @elseif($transaction->status == 'checked_in')
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                                <span class="material-icons-outlined text-emerald-500 text-3xl">verified</span>
                            </div>
                            <p class="text-lg font-bold text-gray-800">Telah Check In</p>
                            <p class="text-sm text-gray-400 mt-1">Visitor telah Check In</p>
                        @elseif($transaction->status == 'checked_out')
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
                            <form method="POST" action="{{ route('transaction.update', $transaction->id) }}">
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
                                            <input type="radio" name="location" value="office"
                                                class="peer absolute opacity-0 w-0 h-0" required>
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
                                            <input type="radio" name="location" value="plant"
                                                class="peer absolute opacity-0 w-0 h-0" required>
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
                                </div>

                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-500/25 transition-all duration-200 hover:shadow-red-500/40 hover:-translate-y-0.5"
                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui visitor ini?')">
                                    <span class="material-icons-outlined" style="font-size:20px;">check_circle</span>
                                    Approve Visitor
                                </button>
                            </form>
                            <p class="text-xs text-gray-400 text-center">
                                Barcode akan otomatis digenerate dan dikirim via email
                            </p>
                        </div>

                    @elseif(in_array($transaction->status, ['approved', 'checked_in']))
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
                                        // Gunakan barcode transaksi jika ada, jika tidak ada fallback ke kode di card_qr
                                        $qrText = $transaction->barcode ?: ($transaction->card_qr ? $transaction->card_qr->code : null);
                                    @endphp
                                    
                                    @if($qrText)
                                        {{-- Jika barcode berupa teks/OTP, generate QR via API --}}
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

@endsection