<div id="content-supplyer" class="tab-content hidden">
    <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Supplyer</h3>
            <p class="text-sm text-gray-500">Kelola status kunjungan supplyer</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sopir
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Perusahaan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Kendaraan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Paraf
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                    </th>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($supplyers ?? [] as $supplyer)
                        <tr class="table-row-hover"
                            data-searchable="{{ $supplyer->sopir }} {{ $supplyer->name_perushaan }} {{ $supplyer->nomor_police }} {{ $supplyer->paraf }}"
                            data-name="{{ $supplyer->sopir }}"
                            data-date="{{ $supplyer->created_at->format('Y-m-d H:i:s') }}">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $supplyer->id }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 font-medium">{{ $supplyer->sopir }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $supplyer->name_perushaan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $supplyer->nomor_police }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                    {{ $supplyer->paraf ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $supplyer->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('supply.show', $supplyer->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200 text-xs font-medium">
                                    <span class="material-icons-outlined" style="font-size:18px;">visibility</span>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-icons-outlined text-4xl text-gray-300">inbox</span>
                                    <p class="text-gray-400 text-sm">Tidak ada data supplyer</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>