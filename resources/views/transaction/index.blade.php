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

    {{-- Header & Filter Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Visitor ACC</h3>
            <p class="text-sm text-gray-400 mt-0.5">Kelola persetujuan kunjungan visitor</p>
        </div>
        <div class="flex items-center gap-3">
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
            <div class="relative">
                <button onclick="toggleAccFilter()" id="filterBtnAcc"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all duration-200 shadow-sm">
                    <span class="material-icons-outlined" style="font-size:18px;">filter_list</span>
                    <span id="filterLabelAcc">Urutkan</span>
                    <span class="material-icons-outlined" style="font-size:16px;">expand_more</span>
                </button>
                <div id="filterDropdownAcc"
                    class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 hidden">
                    <p class="px-4 py-1.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Urutkan</p>
                    <button onclick="setAccFilter('newest')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">schedule</span> Terbaru
                    </button>
                    <button onclick="setAccFilter('oldest')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">history</span> Terlama
                    </button>
                    <button onclick="setAccFilter('name-asc')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">sort_by_alpha</span> Nama
                        A-Z
                    </button>
                    <button onclick="setAccFilter('name-desc')"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">sort_by_alpha</span> Nama
                        Z-A
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Filter Tabs --}}
    <div class="flex items-center gap-2 mb-6 flex-wrap">
        <button onclick="setStatusFilter('all')" id="tab-all"
            class="status-tab active-tab inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-200">
            <span class="material-icons-outlined" style="font-size:14px;">grid_view</span>
            Semua
            <span id="count-all"
                class="ml-1 px-1.5 py-0.5 rounded-md bg-gray-100 text-gray-500 text-xs font-bold tabcount"></span>
        </button>
        <button onclick="setStatusFilter('waiting')" id="tab-waiting"
            class="status-tab inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-200">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-400"></span>
            </span>
            Menunggu
            <span id="count-waiting"
                class="ml-1 px-1.5 py-0.5 rounded-md bg-amber-50 text-amber-600 text-xs font-bold tabcount"></span>
        </button>
        <button onclick="setStatusFilter('approved')" id="tab-approved"
            class="status-tab inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-200">
            <span class="material-icons-outlined text-emerald-500" style="font-size:14px;">check_circle</span>
            Approved
            <span id="count-approved"
                class="ml-1 px-1.5 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-xs font-bold tabcount"></span>
        </button>
        <button onclick="setStatusFilter('check_in')" id="tab-check_in"
            class="status-tab inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-200">
            <span class="material-icons-outlined text-blue-500" style="font-size:14px;">login</span>
            Check In
            <span id="count-check_in"
                class="ml-1 px-1.5 py-0.5 rounded-md bg-blue-50 text-blue-600 text-xs font-bold tabcount"></span>
        </button>
        <button onclick="setStatusFilter('check_out')" id="tab-check_out"
            class="status-tab inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-200">
            <span class="material-icons-outlined text-gray-400" style="font-size:14px;">logout</span>
            Check Out
            <span id="count-check_out"
                class="ml-1 px-1.5 py-0.5 rounded-md bg-gray-100 text-gray-500 text-xs font-bold tabcount"></span>
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="accTable">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-12">
                            NO</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-24">
                            Tipe</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-44">
                            Nama / Perusahaan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-36">
                            No. Telp</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-36">
                            User Meeting</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-32">
                            Waktu Input</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-28">
                            Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-20">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions ?? [] as $visitor)
                        @php
                            $statusConfig = [
                                'waiting' => [
                                    'pill' => 'bg-amber-50 text-amber-600 border border-amber-200 ring-1 ring-amber-100',
                                    'icon' => '<span class="material-icons-outlined" style="font-size:13px;">schedule</span>',
                                    'dot' => 'bg-amber-400',
                                    'label' => 'Menunggu',
                                ],
                                'approved' => [
                                    'pill' => 'bg-emerald-50 text-emerald-600 border border-emerald-200 ring-1 ring-emerald-100',
                                    'icon' => '<span class="material-icons-outlined" style="font-size:13px;">check_circle</span>',
                                    'dot' => 'bg-emerald-400',
                                    'label' => 'Disetujui',
                                ],
                                'check_in' => [
                                    'pill' => 'bg-blue-50 text-blue-600 border border-blue-200 ring-1 ring-blue-100',
                                    'icon' => '<span class="material-icons-outlined" style="font-size:13px;">login</span>',
                                    'dot' => 'bg-blue-400',
                                    'label' => 'Check In',
                                ],
                                'check_out' => [
                                    'pill' => 'bg-gray-100 text-gray-500 border border-gray-200 ring-1 ring-gray-100',
                                    'icon' => '<span class="material-icons-outlined" style="font-size:13px;">logout</span>',
                                    'dot' => 'bg-gray-400',
                                    'label' => 'Check Out',
                                ],
                            ];
                            $status = $visitor->status ?? 'check_out';
                            $cfg = $statusConfig[$status] ?? $statusConfig['check_out'];

                            $typeConfig = [
                                'visitor' => ['pill' => 'bg-green-50 text-green-700 border border-green-100', 'icon' => 'person'],
                                'vendor' => ['pill' => 'bg-blue-50 text-blue-700 border border-blue-100', 'icon' => 'local_shipping'],
                            ];
                            $type = $visitor->type ?? 'visitor';
                            $typeCfg = $typeConfig[$type] ?? $typeConfig['visitor'];
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition-colors duration-150 group"
                            data-searchable="{{ $visitor->name }} {{ $visitor->no_hp }} {{ $visitor->user_meeting }} {{ $visitor->type }} {{ $visitor->status }}"
                            data-name="{{ $visitor->name }}" data-date="{{ $visitor->date }}"
                            data-status="{{ $visitor->status ?? 'check_out' }}">

                            {{-- NO --}}
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-mono text-gray-400 bg-gray-50 border border-gray-100 px-2 py-0.5 rounded-md row-number"></span>
                            </td>

                            {{-- Type --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $typeCfg['pill'] }}">
                                    <span class="material-icons-outlined" style="font-size:12px;">{{ $typeCfg['icon'] }}</span>
                                    {{ ucfirst($type) }}
                                </span>
                            </td>

                            {{-- Nama --}}
                            <td class="px-6 py-4 max-w-[11rem]">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center shrink-0">
                                        <span
                                            class="text-xs font-bold text-red-600">{{ strtoupper(substr($visitor->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 leading-tight truncate"
                                            title="{{ $visitor->name }}">{{ $visitor->name }}</p>
                                        @if($visitor->company ?? null)
                                            <p class="text-xs text-gray-400 mt-0.5 truncate" title="{{ $visitor->company }}">
                                                {{ $visitor->company }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- No HP --}}
                            <td class="px-6 py-4 max-w-[9rem]">
                                <a href="tel:{{ $visitor->no_hp }}"
                                    class="text-sm text-gray-500 hover:text-red-500 transition-colors flex items-center gap-1 min-w-0">
                                    <span class="material-icons-outlined flex-shrink-0" style="font-size:14px;">phone</span>
                                    <span class="truncate" title="{{ $visitor->no_hp }}">{{ $visitor->no_hp }}</span>
                                </a>
                            </td>

                            {{-- User Meeting --}}
                            <td class="px-6 py-4 max-w-[9rem]">
                                <div class="flex items-center gap-1.5 text-sm text-gray-600 min-w-0">
                                    <span class="material-icons-outlined text-gray-300 flex-shrink-0"
                                        style="font-size:15px;">badge</span>
                                    <span class="truncate"
                                        title="{{ $visitor->user_meeting }}">{{ $visitor->user_meeting }}</span>
                                </div>
                            </td>

                            {{-- Waktu Input --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-gray-400">
                                    <span class="material-icons-outlined" style="font-size:14px;">calendar_today</span>
                                    {{ $visitor->date }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $cfg['pill'] }}">
                                    @if($status === 'waiting')
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 {{ $cfg['dot'] }}"></span>
                                        </span>
                                    @else
                                        {!! $cfg['icon'] !!}
                                    @endif
                                    {{ $cfg['label'] }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4">
                                <a href="{{ route('transaction.show', $visitor->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-all duration-200 text-xs font-medium shadow-sm group-hover:shadow">
                                    <span class="material-icons-outlined" style="font-size:15px;">visibility</span>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center">
                                        <span class="material-icons-outlined text-3xl text-gray-300">inbox</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Tidak ada data kunjungan</p>
                                        <p class="text-xs text-gray-300 mt-1">Data akan muncul setelah ada visitor terdaftar</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Empty state saat filter tidak ada hasil --}}
            <div id="noResultRow" class="hidden px-6 py-16 text-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center">
                        <span class="material-icons-outlined text-3xl text-gray-300">search_off</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400" id="noResultText">Tidak ada data</p>
                        <p class="text-xs text-gray-300 mt-1">Coba ubah filter atau kata kunci pencarian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="accPagination"
        class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-white rounded-b-2xl"></div>

    <style>
        .status-tab {
            background: white;
            color: #6b7280;
            border-color: #e5e7eb;
        }

        .status-tab:hover {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .status-tab.active-tab {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
            box-shadow: 0 4px 12px -2px rgba(220, 38, 38, 0.35);
        }

        .status-tab.active-tab .tabcount {
            background: rgba(255, 255, 255, 0.25);
            color: white;
        }

        /* Table truncation */
        #accTable {
            table-layout: fixed;
            width: 100%;
        }

        #accTable td {
            overflow: hidden;
        }

        [title] {
            cursor: default;
        }
    </style>

    <script>
        const PER_PAGE = 10;
        let accFilter = 'newest';
        let statusFilter = 'all';
        let currentPage = 1;
        let processedRows = [];

        // ─── Status Tab Filter ─────────────────────────────────────
        function setStatusFilter(status) {
            statusFilter = status;
            currentPage = 1;

            // Update active tab styling
            document.querySelectorAll('.status-tab').forEach(btn => {
                btn.classList.remove('active-tab');
            });
            document.getElementById('tab-' + status).classList.add('active-tab');

            applyAccSearchAndFilter();
        }

        // ─── Sort Filter Dropdown ──────────────────────────────────
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
            const labels = { newest: 'Terbaru', oldest: 'Terlama', 'name-asc': 'Nama A-Z', 'name-desc': 'Nama Z-A' };
            document.getElementById('filterLabelAcc').textContent = labels[filter];
            document.getElementById('filterDropdownAcc').classList.add('hidden');
            currentPage = 1;
            applyAccSearchAndFilter();
        }

        // ─── Core: Search + Status + Sort + Paginate ───────────────
        function applyAccSearchAndFilter() {
            const query = document.getElementById('searchInputAcc').value.toLowerCase().trim();
            const tbody = document.querySelector('#accTable tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr[data-searchable]'));

            // Count per status (sebelum filter search)
            const counts = { all: 0, waiting: 0, approved: 0, check_in: 0, check_out: 0 };
            allRows.forEach(row => {
                const s = row.dataset.status || 'check_out';
                counts.all++;
                if (counts[s] !== undefined) counts[s]++;
            });
            // Update badge counts
            Object.keys(counts).forEach(key => {
                const el = document.getElementById('count-' + key);
                if (el) el.textContent = counts[key];
            });

            // 1. Filter by search
            let filtered = allRows.filter(row =>
                row.getAttribute('data-searchable').toLowerCase().includes(query)
            );

            // 2. Filter by status tab
            if (statusFilter !== 'all') {
                filtered = filtered.filter(row => row.dataset.status === statusFilter);
            }

            // 3. Sort
            filtered.sort((a, b) => {
                if (accFilter === 'newest') return (b.dataset.date || '').localeCompare(a.dataset.date || '');
                if (accFilter === 'oldest') return (a.dataset.date || '').localeCompare(b.dataset.date || '');
                if (accFilter === 'name-asc') return (a.dataset.name || '').localeCompare(b.dataset.name || '');
                if (accFilter === 'name-desc') return (b.dataset.name || '').localeCompare(a.dataset.name || '');
                return 0;
            });

            processedRows = filtered;

            // 4. Clamp currentPage
            const totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
            if (currentPage > totalPages) currentPage = 1;

            // 5. Show/hide rows based on page + update row numbers
            const start = (currentPage - 1) * PER_PAGE;
            const end = start + PER_PAGE;

            allRows.forEach(row => {
                row.style.display = 'none';
                tbody.appendChild(row);
            });

            filtered.forEach((row, i) => {
                const numEl = row.querySelector('.row-number');
                if (numEl) numEl.textContent = i + 1;

                row.style.display = (i >= start && i < end) ? '' : 'none';
                tbody.appendChild(row);
            });

            // 6. Empty / no-result state
            const noResultRow = document.getElementById('noResultRow');
            if (noResultRow) {
                noResultRow.classList.toggle('hidden', filtered.length > 0);
                const textEl = document.getElementById('noResultText');
                if (textEl) {
                    if (statusFilter !== 'all' && query === '') {
                        const labels = { waiting: 'Menunggu', approved: 'Approved', check_in: 'Check In', check_out: 'Check Out' };
                        textEl.textContent = 'Tidak ada visitor dengan status ' + (labels[statusFilter] || statusFilter);
                    } else {
                        textEl.textContent = 'Tidak ada hasil untuk pencarian "' + query + '"';
                    }
                }
            }

            // 7. Render pagination
            renderPagination(filtered.length, totalPages);
        }

        // ─── Render Pagination UI ──────────────────────────────────
        function renderPagination(totalItems, totalPages) {
            const container = document.getElementById('accPagination');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            const start = (currentPage - 1) * PER_PAGE + 1;
            const end = Math.min(currentPage * PER_PAGE, totalItems);

            let pageButtons = '';
            for (let p = 1; p <= totalPages; p++) {
                if (p === 1 || p === totalPages || Math.abs(p - currentPage) <= 1) {
                    if (p === currentPage) {
                        pageButtons += `<span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold bg-red-500 text-white border border-red-500">${p}</span>`;
                    } else {
                        pageButtons += `<button onclick="goToPage(${p})" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-600 bg-white border border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-colors">${p}</button>`;
                    }
                } else if (Math.abs(p - currentPage) === 2) {
                    pageButtons += `<span class="inline-flex items-center justify-center w-5 text-xs text-gray-300">···</span>`;
                }
            }

            container.innerHTML = `
                    <p class="text-xs text-gray-400">
                        Menampilkan <span class="font-semibold text-gray-600">${start}</span> – <span class="font-semibold text-gray-600">${end}</span>
                        dari <span class="font-semibold text-gray-600">${totalItems}</span> data
                    </p>
                    <div class="flex items-center gap-1">
                        <button onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}
                            class="inline-flex items-center px-2 py-1.5 rounded-lg text-xs border transition-colors ${currentPage === 1 ? 'text-gray-300 bg-gray-50 border-gray-100 cursor-not-allowed' : 'text-gray-600 bg-white border-gray-200 hover:bg-gray-50'}">
                            <span class="material-icons-outlined" style="font-size:14px;">chevron_left</span>
                        </button>
                        ${pageButtons}
                        <button onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}
                            class="inline-flex items-center px-2 py-1.5 rounded-lg text-xs border transition-colors ${currentPage === totalPages ? 'text-gray-300 bg-gray-50 border-gray-100 cursor-not-allowed' : 'text-gray-600 bg-white border-gray-200 hover:bg-gray-50'}">
                            <span class="material-icons-outlined" style="font-size:14px;">chevron_right</span>
                        </button>
                    </div>
                `;
        }

        function goToPage(page) {
            const totalPages = Math.ceil(processedRows.length / PER_PAGE);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            applyAccSearchAndFilter();
            document.getElementById('accTable').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // ─── Init ──────────────────────────────────────────────────
        applyAccSearchAndFilter();
    </script>

@endsection