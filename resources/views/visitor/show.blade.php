@section('title', 'Detail Visitor')
@section('subtitle', 'Informasi lengkap data visitor')
@extends('layout.app')
@section('content')

    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('visitor.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-all duration-200 shadow-sm">
            <span class="material-icons-outlined" style="font-size:18px;">arrow_back</span>
            Kembali
        </a>
    </div>

    {{-- Header Card --}}
    <div class="relative overflow-hidden rounded-2xl mb-6" style="box-shadow: 0 10px 40px -10px rgba(239,68,68,0.25);">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-700"></div>
        <div class="relative p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                <span class="material-icons-outlined text-white text-3xl">person</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $visitor->name_tamu_decrypted }}</h2>
                <p class="text-red-100/80 text-sm mt-0.5">Visitor • Terdaftar {{ $visitor->created_at->format('d M Y') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Detail Grid --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Informasi Detail</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Nama Tamu --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">badge</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Tamu</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->name_tamu_decrypted }}</p>
                </div>
            </div>

            {{-- Alamat --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">home</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Alamat</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->Alamat ?? '-' }}</p>
                </div>
            </div>

            {{-- No Telp --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">phone</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No Telp</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->no_telp ?? '-' }}</p>
                </div>
            </div>

            {{-- No Kendaraan --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">directions_car</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No Kendaraan</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->no_police ?? '-' }}</p>
                </div>
            </div>

            {{-- Bertemu --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">groups</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Bertemu</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->user_meeting ?? '-' }}</p>
                </div>
            </div>

            {{-- Keperluan --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">assignment</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Keperluan</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->keperluan ?? '-' }}</p>
                </div>
            </div>

            {{-- Jumlah Pengunjung --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">people</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jumlah Pengunjung</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->jumlah_pengunjung ?? '-' }}</p>
                </div>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">calendar_today</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Masuk</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->tanggal_masuk ?? '-' }}</p>
                </div>
            </div>

            {{-- Waktu Input --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl md:col-span-2">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">access_time</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Waktu Input</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $visitor->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

        </div>
    </div>

@endsection