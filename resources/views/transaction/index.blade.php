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
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
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
                    <span id="filterLabelAcc">Filter</span>
                    <span class="material-icons-outlined" style="font-size:16px;">expand_more</span>
                </button>
                <div id="filterDropdownAcc"
                    class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 hidden">
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

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="accTable">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">NO
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Tipe
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama
                            / Perusahaan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">No.
                            Telp</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">User
                            Meeting</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Waktu
                            Input</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi
                        </th>
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
                                'checked_in' => [
                                    'pill' => 'bg-blue-50 text-blue-600 border border-blue-200 ring-1 ring-blue-100',
                                    'icon' => '<span class="material-icons-outlined" style="font-size:13px;">login</span>',
                                    'dot' => 'bg-blue-400',
                                    'label' => 'Check In',
                                ],
                                'checked_out' => [
                                    'pill' => 'bg-gray-100 text-gray-500 border border-gray-200 ring-1 ring-gray-100',
                                    'icon' => '<span class="material-icons-outlined" style="font-size:13px;">logout</span>',
                                    'dot' => 'bg-gray-400',
                                    'label' => 'Check Out',
                                ],
                            ];
                            $status = $visitor->status ?? 'checked_out';
                            $cfg = $statusConfig[$status] ?? $statusConfig['checked_out'];

                            $typeConfig = [
                                'visitor' => ['pill' => 'bg-green-50 text-green-700 border border-green-100', 'icon' => 'person'],
                                'vendor' => ['pill' => 'bg-blue-50 text-blue-700 border border-blue-100', 'icon' => 'local_shipping'],
                            ];
                            $type = $visitor->type ?? 'visitor';
                            $typeCfg = $typeConfig[$type] ?? $typeConfig['visitor'];
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition-colors duration-150 group"
                            data-searchable="{{ $visitor->name }} {{ $visitor->no_hp }} {{ $visitor->user_meeting }} {{ $visitor->type }} {{ $visitor->status }}"
                            data-name="{{ $visitor->name }}" data-date="{{ $visitor->date }}">

                            {{-- ID --}}
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs font-mono text-gray-400 bg-gray-50 border border-gray-100 px-2 py-0.5 rounded-md">
                                    {{ $loop->iteration }}
                                </span>
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
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center shrink-0">
                                        <span
                                            class="text-xs font-bold text-red-600">{{ strtoupper(substr($visitor->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800 leading-tight">{{ $visitor->name }}</p>
                                        @if($visitor->company ?? null)
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $visitor->company }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- No HP --}}
                            <td class="px-6 py-4">
                                <a href="tel:{{ $visitor->no_hp }}"
                                    class="text-sm text-gray-500 hover:text-red-500 transition-colors flex items-center gap-1">
                                    <span class="material-icons-outlined" style="font-size:14px;">phone</span>
                                    {{ $visitor->no_hp }}
                                </a>
                            </td>

                            {{-- User Meeting --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-gray-600">
                                    <span class="material-icons-outlined text-gray-300" style="font-size:15px;">badge</span>
                                    {{ $visitor->user_meeting }}
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
                                    {{-- Animated dot for "waiting" --}}
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
                        <tr>
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
        </div>
    </div>
    <div id="accPagination"
        class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-white rounded-b-2xl"></div>

    <script>
        const PER_PAGE = 10;
        let accFilter = 'newest';
        let currentPage = 1;
        let processedRows = []; // rows setelah filter+sort

        // ─── Filter Dropdown ───────────────────────────────────────
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
            currentPage = 1; // reset ke halaman 1 saat filter berubah
            applyAccSearchAndFilter();
        }

        // ─── Core: Search + Sort + Paginate ────────────────────────
        function applyAccSearchAndFilter() {
            const query = document.getElementById('searchInputAcc').value.toLowerCase().trim();
            const tbody = document.querySelector('#accTable tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr[data-searchable]'));
            const emptyRow = tbody.querySelector('tr:not([data-searchable])');

            // 1. Filter by search
            const filtered = allRows.filter(row =>
                row.getAttribute('data-searchable').toLowerCase().includes(query)
            );

            // 2. Sort
            filtered.sort((a, b) => {
                if (accFilter === 'newest') return (b.dataset.date || '').localeCompare(a.dataset.date || '');
                if (accFilter === 'oldest') return (a.dataset.date || '').localeCompare(b.dataset.date || '');
                if (accFilter === 'name-asc') return (a.dataset.name || '').localeCompare(b.dataset.name || '');
                if (accFilter === 'name-desc') return (b.dataset.name || '').localeCompare(a.dataset.name || '');
                return 0;
            });

            processedRows = filtered;

            // 3. Clamp currentPage
            const totalPages = Math.ceil(filtered.length / PER_PAGE);
            if (currentPage > totalPages) currentPage = Math.max(1, totalPages);

            // 4. Show/hide rows based on page
            const start = (currentPage - 1) * PER_PAGE;
            const end = start + PER_PAGE;

            allRows.forEach(row => row.style.display = 'none');
            filtered.forEach((row, i) => {
                row.style.display = (i >= start && i < end) ? '' : 'none';
                tbody.appendChild(row); // re-order DOM
            });

            // 5. Empty state
            if (emptyRow) {
                emptyRow.style.display = filtered.length === 0 ? '' : 'none';
            }

            // 6. Render pagination UI
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

            // Build page number buttons
            let pageButtons = '';
            for (let p = 1; p <= totalPages; p++) {
                if (
                    p === 1 ||
                    p === totalPages ||
                    Math.abs(p - currentPage) <= 1
                ) {
                    if (p === currentPage) {
                        pageButtons += `
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold bg-red-500 text-white border border-red-500">
                                                    ${p}
                                                </span>`;
                    } else {
                        pageButtons += `
                                                <button onclick="goToPage(${p})"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-600 bg-white border border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-colors">
                                                    ${p}
                                                </button>`;
                    }
                } else if (Math.abs(p - currentPage) === 2) {
                    pageButtons += `<span class="inline-flex items-center justify-center w-5 text-xs text-gray-300">···</span>`;
                }
            }

            container.innerHTML = `
                                    {{-- Info --}}
                                    <p class="text-xs text-gray-400">
                                        Menampilkan
                                        <span class="font-semibold text-gray-600">${start}</span>
                                        –
                                        <span class="font-semibold text-gray-600">${end}</span>
                                        dari
                                        <span class="font-semibold text-gray-600">${totalItems}</span>
                                        data
                                    </p>

                                    {{-- Buttons --}}
                                    <div class="flex items-center gap-1">
                                        <button onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}
                                            class="inline-flex items-center px-2 py-1.5 rounded-lg text-xs border transition-colors
                                                ${currentPage === 1
                    ? 'text-gray-300 bg-gray-50 border-gray-100 cursor-not-allowed'
                    : 'text-gray-600 bg-white border-gray-200 hover:bg-gray-50'}">
                                            <span class="material-icons-outlined" style="font-size:14px;">chevron_left</span>
                                        </button>

                                        ${pageButtons}

                                        <button onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}
                                            class="inline-flex items-center px-2 py-1.5 rounded-lg text-xs border transition-colors
                                                ${currentPage === totalPages
                    ? 'text-gray-300 bg-gray-50 border-gray-100 cursor-not-allowed'
                    : 'text-gray-600 bg-white border-gray-200 hover:bg-gray-50'}">
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
            // Scroll ke atas tabel
            document.getElementById('accTable').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // ─── Init ──────────────────────────────────────────────────
        applyAccSearchAndFilter();
    </script>

@endsection