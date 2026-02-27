@section('title', 'Visitor')
@section('subtitle', 'Kelola data pengguna sistem')
@extends('layout.app')
@section('content')

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="showTab('visitors')" id="tab-visitors"
                    class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm border-red-500 text-red-600">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Visitors
                </button>
                <button onclick="showTab('supplyer')" id="tab-supplyer"
                    class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="bi bi-box-seam"></i>
                    supplyer
                </button>
                <button onclick="showTab('contractor')" id="tab-contractor"
                    class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="bi bi-truck"></i>
                    Contractor
                </button>

            </nav>
        </div>

        <div class="flex items-center gap-3">
            {{-- Search --}}
            <div class="relative flex-1 sm:w-64">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="searchInput" placeholder="Cari data..."
                    class="input-enhanced w-full pl-10 pr-4 py-2.5 rounded-xl bg-gray-50 focus:bg-white focus:outline-none text-sm"
                    oninput="applySearchAndFilter()">
            </div>

            {{-- Filter Dropdown --}}
            <div class="relative">
                <button onclick="toggleFilterDropdown()" id="filterBtn"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all duration-200 shadow-sm">
                    <span class="material-icons-outlined" style="font-size:18px;">filter_list</span>
                    <span id="filterLabel">Filter</span>
                    <span class="material-icons-outlined" style="font-size:16px;">expand_more</span>
                </button>
                <div id="filterDropdown"
                    class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 hidden">
                    <button onclick="setFilter('newest')"
                        class="filter-option w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">schedule</span>
                        Terbaru
                    </button>
                    <button onclick="setFilter('oldest')"
                        class="filter-option w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">history</span>
                        Terlama
                    </button>
                    <button onclick="setFilter('name-asc')"
                        class="filter-option w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">sort_by_alpha</span>
                        Nama A-Z
                    </button>
                    <button onclick="setFilter('name-desc')"
                        class="filter-option w-full text-left px-4 py-2.5 text-sm hover:bg-red-50 flex items-center gap-2.5 transition-colors">
                        <span class="material-icons-outlined text-red-400" style="font-size:18px;">sort_by_alpha</span>
                        Nama Z-A
                    </button>
                </div>
            </div>
        </div>

    </div>


    <!-- Visitors Tab -->
    @include('visitor.jenis.visitor')


    <!-- supplyer -->

    @include('visitor.jenis.supply')


    <!-- contractor -->
    @include('visitor.jenis.contraktor')



    <script>
        let currentFilter = 'newest';

        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('border-red-500', 'text-red-600');
                el.classList.add('border-transparent', 'text-gray-500');
            });
            document.getElementById('content-' + tabName).classList.remove('hidden');
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-red-500', 'text-red-600');

            // Re-apply search & filter to new tab
            applySearchAndFilter();
        }

        function toggleFilterDropdown() {
            document.getElementById('filterDropdown').classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('filterBtn');
            const dropdown = document.getElementById('filterDropdown');
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        function setFilter(filter) {
            currentFilter = filter;
            const labels = { 'newest': 'Terbaru', 'oldest': 'Terlama', 'name-asc': 'Nama A-Z', 'name-desc': 'Nama Z-A' };
            document.getElementById('filterLabel').textContent = labels[filter];
            document.getElementById('filterDropdown').classList.add('hidden');
            applySearchAndFilter();
        }

        function applySearchAndFilter() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();

            // Find the currently visible tab content
            const visibleTab = document.querySelector('.tab-content:not(.hidden)');
            if (!visibleTab) return;

            const tbody = visibleTab.querySelector('tbody');
            if (!tbody) return;

            const rows = Array.from(tbody.querySelectorAll('tr[data-searchable]'));

            // Search: filter rows
            rows.forEach(row => {
                const text = row.getAttribute('data-searchable').toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });

            // Sort visible rows
            const visibleRows = rows.filter(r => r.style.display !== 'none');

            visibleRows.sort((a, b) => {
                if (currentFilter === 'newest') {
                    return (b.getAttribute('data-date') || '').localeCompare(a.getAttribute('data-date') || '');
                } else if (currentFilter === 'oldest') {
                    return (a.getAttribute('data-date') || '').localeCompare(b.getAttribute('data-date') || '');
                } else if (currentFilter === 'name-asc') {
                    return (a.getAttribute('data-name') || '').localeCompare(b.getAttribute('data-name') || '');
                } else if (currentFilter === 'name-desc') {
                    return (b.getAttribute('data-name') || '').localeCompare(a.getAttribute('data-name') || '');
                }
                return 0;
            });

            // Re-append sorted rows
            visibleRows.forEach(row => tbody.appendChild(row));

            // Also re-append hidden rows at the end
            rows.filter(r => r.style.display === 'none').forEach(row => tbody.appendChild(row));

            // Handle empty state row
            const emptyRow = tbody.querySelector('tr:not([data-searchable])');
            if (emptyRow) {
                emptyRow.style.display = visibleRows.length === 0 ? '' : 'none';
            }
        }
    </script>

@endsection