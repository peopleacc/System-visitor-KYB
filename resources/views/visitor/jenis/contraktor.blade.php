<div id="content-contractor" class="tab-content hidden">
    <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Contractor</h3>
            <p class="text-sm text-gray-500">Kelola status kunjungan contractor</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">PIC
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Perusahaan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Pekerjaan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Area
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                    </th>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($contractors ?? [] as $contractor)
                        <tr class="table-row-hover"
                            data-searchable="{{ $contractor->pic }} {{ $contractor->nama_pt }} {{ $contractor->nama_pekerjaan }} {{ $contractor->area_pekerjaan }}"
                            data-name="{{ $contractor->pic }}"
                            data-date="{{ $contractor->created_at->format('Y-m-d H:i:s') }}">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $contractor->id }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 font-medium">{{ $contractor->pic }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contractor->nama_pt }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contractor->nama_pekerjaan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contractor->area_pekerjaan ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $contractor->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('contractor.show', $contractor->id) }}"
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
                                    <p class="text-gray-400 text-sm">Tidak ada data contractor</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>