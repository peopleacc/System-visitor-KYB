@section('title', 'ACC-Visitor')
@section('subtitle', 'Kelola Barcode')
@extends('layout.app')
@section('content')

    @if(session('success'))
        <div
            class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700 flex items-center gap-2">
            <span class="material-icons-outlined" style="font-size:18px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- Search & Filter Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Visitor ACC</h3>
            <p class="text-sm text-gray-400 mt-0.5">Kelola persetujuan kunjungan visitor</p>
        </div>
        <div class="flex items-center gap-3">
            {{-- Search --}}
            <div class="relative flex-1 sm:w-64">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="searchInputAcc" placeholder="Cari visitor..."
                    class="input-enhanced w-full pl-10 pr-4 py-2.5 rounded-xl bg-gray-50 focus:bg-white focus:outline-none text-sm"
                    oninput="applyAccSearchAndFilter()">
            </div>

            {{-- Filter Dropdown --}}
            <div class="relative">
                <button onclick="toggleAccFilter()" id="filterBtnAcc"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all duration-200 shadow-sm">
                    <span class="material-icons-outlined" style="font-size:18px;">filter_list</span>
                    <span id="filterLabelAcc">Filter</span>
                    <span class="material-icons-outlined" style="font-size:16px;">expand_more</span>
                </button>
                <div id="filterDropdownAcc"
                    class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 hidden">
                    <button onclick="setAccFilter('newest')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">schedule</span>
                        Terbaru
                    </button>
                    <button onclick="setAccFilter('oldest')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">history</span>
                        Terlama
                    </button>
                    <button onclick="setAccFilter('name-asc')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">sort_by_alpha</span>
                        Nama A-Z
                    </button>
                    <button onclick="setAccFilter('name-desc')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">sort_by_alpha</span>
                        Nama Z-A
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="accTable">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No Telp
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User
                        Meeting</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu Input
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($transactions ?? [] as $visitor)
                        <tr class="table-row-hover"
                            data-searchable="{{ $visitor->name }} {{ $visitor->no_hp }} {{ $visitor->user_meeting }} {{ $visitor->type }} {{ $visitor->status }}"
                            data-name="{{ $visitor->name }}" data-date="{{ $visitor->date }}">
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $visitor->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $visitor->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $visitor->no_hp }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $visitor->user_meeting }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $visitor->date }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                    {{ $visitor->type }}
                                </span>
                            </td>
                            @if ($visitor->status == "waiting")
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                                        <span class="material-icons-outlined" style="font-size:14px;">schedule</span>
                                        {{ $visitor->status }}
                                    </span>
                                </td>
                            @elseif ($visitor->status == "approved")
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        <span class="material-icons-outlined" style="font-size:14px;">check_circle</span>
                                        {{ $visitor->status }}
                                    </span>
                                </td>
                            @else
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-600">
                                        {{ $visitor->status ?? '-' }}
                                    </span>
                                </td>
                            @endif
                            <td class="px-6 py-4">
                                <a href="{{ route('transaction.show', $visitor->id) }}"
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

    <script>
        let accFilter = 'newest';

        function toggleAccFilter() {
            document.getElementById('filterDropdownAcc').classList.toggle('hidden');
        }

        document.addEventListener('click', function (e) {
            const btn = document.getElementById('filterBtnAcc');
            const dropdown = document.getElementById('filterDropdownAcc');
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        function setAccFilter(filter) {
            accFilter = filter;
            const labels = { 'newest': 'Terbaru', 'oldest': 'Terlama', 'name-asc': 'Nama A-Z', 'name-desc': 'Nama Z-A' };
            document.getElementById('filterLabelAcc').textContent = labels[filter];
            document.getElementById('filterDropdownAcc').classList.add('hidden');
            applyAccSearchAndFilter();
        }

        function applyAccSearchAndFilter() {
            const query = document.getElementById('searchInputAcc').value.toLowerCase().trim();
            const tbody = document.querySelector('#accTable tbody');
            const rows = Array.from(tbody.querySelectorAll('tr[data-searchable]'));

            // Search
            rows.forEach(row => {
                const text = row.getAttribute('data-searchable').toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });

            // Sort visible rows
            const visibleRows = rows.filter(r => r.style.display !== 'none');

            visibleRows.sort((a, b) => {
                if (accFilter === 'newest') {
                    return (b.getAttribute('data-date') || '').localeCompare(a.getAttribute('data-date') || '');
                } else if (accFilter === 'oldest') {
                    return (a.getAttribute('data-date') || '').localeCompare(b.getAttribute('data-date') || '');
                } else if (accFilter === 'name-asc') {
                    return (a.getAttribute('data-name') || '').localeCompare(b.getAttribute('data-name') || '');
                } else if (accFilter === 'name-desc') {
                    return (b.getAttribute('data-name') || '').localeCompare(a.getAttribute('data-name') || '');
                }
                return 0;
            });

            visibleRows.forEach(row => tbody.appendChild(row));
            rows.filter(r => r.style.display === 'none').forEach(row => tbody.appendChild(row));

            const emptyRow = tbody.querySelector('tr:not([data-searchable])');
            if (emptyRow) {
                emptyRow.style.display = visibleRows.length === 0 ? '' : 'none';
            }
        }
    </script>

@endsection