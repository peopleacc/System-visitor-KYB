@section('title', 'Detail Visitor ACC')
@section('subtitle', 'Informasi lengkap & kelola persetujuan')
@extends('layout.app')
@section('content')




    {{-- Header Card --}}
    <div class="relative overflow-hidden rounded-2xl mb-6" style="box-shadow: 0 10px 40px -10px rgba(239,68,68,0.25);">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-700"></div>
        <div class="relative p-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <span class="material-icons-outlined text-white text-3xl">person_search</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Check OUt </h2>
                </div>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Detail Info (2/3) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-4">

                <form method="POST" action="{{ route('scan-out.store') }}">
                    @csrf

                    {{-- Nama --}}
                    <input type="text" id="kode" name="kode" maxlength="6" autofocus
                        class="p-4 w-full border border-gray-500 bg-gray-50 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                        placeholder="Masukan 6 Angka untuk Mendeteksi Barcodenya">

                    <script>
                        document.getElementById('kode').addEventListener('input', function () {
                            if (/^\d{6}$/.test(this.value)) {
                                this.form.submit();
                            }
                        });
                    </script>
                </form>

                {{-- No HP --}}
            </div>

            @if ($checkin)

                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mt-8">
                    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Informasi Visitor</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- nama  -->
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">badge</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama</p>
                                <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $checkin->name }}</p>
                            </div>
                        </div>
                        <!-- nama  -->
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">badge</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama</p>
                                <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $checkin->name }}</p>
                            </div>
                        </div>
                        {{-- No HP --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">phone</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No HP</p>
                                <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $checkin->no_hp ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- User Meeting --}}
                        <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-red-600" style="font-size:20px;">groups</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">User Meeting</p>
                                <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $checkin->user_meeting ?? '-' }}</p>
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
                                        {{ $checkin->type }}
                                    </span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>

        {{-- Right: Action Card (1/3) --}}
        <div class="lg:col-span-1">
            {{-- Status & Action Card --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden sticky top-6">
                <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Status & Aksi</h3>
                </div>
                <div class="p-6">
                    @if ($checkin)
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-3">
                                <i class="bi bi-box-arrow-in-right text-red-600 text-2xl"></i>
                            </div>
                            <p class="text-lg font-bold text-red-600">Check-Out Berhasil</p>
                            <p class="text-sm text-red-500 mt-1">Visitor telah melakukan check-out</p>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                                <i class="bi bi-exclamation-circle text-gray-500 text-2xl"></i>
                            </div>
                            <p class="text-lg font-bold text-gray-400">Silakan Scan Barcode Untuk Check-Out</p>
                        </div>
                    @endif
                    {{-- Status Display --}}

                </div>
            </div>
        </div>

    </div>

@endsection