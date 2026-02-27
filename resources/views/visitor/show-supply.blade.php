@section('title', 'Detail Supplyer')
@section('subtitle', 'Informasi lengkap data supplyer')
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
                <span class="material-icons-outlined text-white text-3xl">local_shipping</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $supplyer->sopir }}</h2>
                <p class="text-red-100/80 text-sm mt-0.5">Supplyer • {{ $supplyer->name_perushaan }}</p>
            </div>
        </div>
    </div>

    {{-- Detail Grid --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Informasi Detail</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Sopir --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">person</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sopir</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $supplyer->sopir }}</p>
                </div>
            </div>

            {{-- Perusahaan --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">business</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Perusahaan</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $supplyer->name_perushaan }}</p>
                </div>
            </div>

            {{-- No Kendaraan --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">directions_car</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No Kendaraan</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $supplyer->nomor_police }}</p>
                </div>
            </div>

            {{-- Paraf --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">draw</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Paraf</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                            {{ $supplyer->paraf ?? '-' }}
                        </span>
                    </p>
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="flex items-start gap-3 p-4 bg-red-50/50 rounded-xl md:col-span-2">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-icons-outlined text-red-600" style="font-size:20px;">calendar_today</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Input</p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $supplyer->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

        </div>
    </div>

@endsection