@section('title', 'Detail Contractor')
@section('subtitle', 'Informasi lengkap data contractor')
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
                <span class="material-icons-outlined text-white text-3xl">engineering</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $contractor->pic }}</h2>
                <p class="text-red-100/80 text-sm mt-0.5">Contractor • {{ $contractor->nama_pt }}</p>
            </div>
        </div>
    </div>

    {{-- Detail Grid --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Informasi Detail</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- PIC --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">person</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">PIC</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->pic }}</p>
                </div>
            </div>

            {{-- Perusahaan --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">business</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Perusahaan (PT)</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->nama_pt }}</p>
                </div>
            </div>

            {{-- Pekerjaan --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">construction</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Pekerjaan</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->nama_pekerjaan }}</p>
                </div>
            </div>

            {{-- Area --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">location_on</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Area Pekerjaan</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->area_pekerjaan ?? '-' }}</p>
                </div>
            </div>

            {{-- Jumlah MP --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">people</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jumlah Man Power</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->jumlah_mp ?? '-' }}</p>
                </div>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">calendar_today</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Masuk</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->tanggal_masuk ?? '-' }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Safety Officer Card --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                <span class="material-icons-outlined text-red-500" style="font-size:18px;">health_and_safety</span>
                Safety Officer
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Nama --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">person</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Safety Officer</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->safety_officer_nama ?? '-' }}</p>
                </div>
            </div>

            {{-- HP --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">phone</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">HP Safety Officer</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $contractor->safety_officer_hp ?? '-' }}</p>
                </div>
            </div>

        </div>
    </div>

@endsection