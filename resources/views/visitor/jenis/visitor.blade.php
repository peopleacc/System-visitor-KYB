<div id="content-visitors" class="tab-content">
    <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Kunjungan</h3>
            <p class="text-sm text-gray-500">Kelola status kunjungan visitor</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tamu
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kontak
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Kendaraan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Bertemu
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Keperluan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi
                    </th>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($visitors ?? [] as $visitor)
                        <tr class="table-row-hover"
                            data-searchable="{{ $visitor->name_tamu_decrypted }} {{ $visitor->Alamat }} {{ $visitor->no_telp }} {{ $visitor->no_police }} {{ $visitor->user_meeting }} {{ $visitor->keperluan }}"
                            data-name="{{ $visitor->name_tamu_decrypted }}"
                            data-date="{{ $visitor->created_at->format('Y-m-d H:i:s') }}">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $visitor->id }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 font-medium">
                                    {{ $visitor->name_tamu_decrypted }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $visitor->Alamat }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visitor->no_telp }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visitor->no_police }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visitor->user_meeting }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $visitor->keperluan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $visitor->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('visitor.show', $visitor->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200 text-xs font-medium">
                                    <span class="material-icons-outlined" style="font-size:18px;">visibility</span>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-icons-outlined text-4xl text-gray-300">inbox</span>
                                    <p class="text-gray-400 text-sm">Tidak ada data kunjungan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>