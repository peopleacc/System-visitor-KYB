@section('title', 'barcode')
@section('subtitle', 'Kelola Barcode')
@extends('layout.app')
@section('content')


    <div id="content-visitors" class="tab-content">
        <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b flex justify-between border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">List Barcode</h3>
                <button onclick="openCustomerModal()"
                    class="btn-primary text-white px-5 py-2.5 rounded-xl font-medium text-sm flex items-center gap-2 justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Generate QR Code
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">code
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">is Used
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">aksi
                        </th>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($barcode ?? [] as $visitor)
                            <tr class="table-row-hover">
                                <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $visitor->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $visitor->code }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $visitor->nama_barcode }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium {{ $visitor->status == 'aktif' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $visitor->status }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('barcode.destroy', $visitor->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus barcode ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="py-1.5 px-3 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition-colors duration-150 border border-red-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada data kunjungan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('barcode.modal-generate')


@endsection