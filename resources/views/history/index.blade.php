@section('title', 'History Visitor')
@section('subtitle', 'Riwayat kunjungan yang telah check-out')
@extends('layout.app')

@section('content')

    {{-- ══════════════════════════════════════════════════════
    LAYOUT UTAMA: Kalender kiri + Tabel kanan
    ══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-[320px_1fr] gap-5">

        {{-- ─── PANEL KIRI: KALENDER ─────────────────────── --}}
        <div class="flex flex-col gap-4">

            {{-- Kalender --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                {{-- Nav bulan --}}
                <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100">
                    <button id="prevMonth"
                        class="w-8 h-8 rounded-xl bg-gray-50 hover:bg-red-50 hover:text-red-600 text-gray-500 flex items-center justify-center transition-colors">
                        <span class="material-icons-outlined" style="font-size:18px;">chevron_left</span>
                    </button>
                    <div class="text-center">
                        <p id="calMonthLabel" class="text-sm font-bold text-gray-800"></p>
                    </div>
                    <button id="nextMonth"
                        class="w-8 h-8 rounded-xl bg-gray-50 hover:bg-red-50 hover:text-red-600 text-gray-500 flex items-center justify-center transition-colors">
                        <span class="material-icons-outlined" style="font-size:18px;">chevron_right</span>
                    </button>
                </div>

                {{-- Grid kalender --}}
                <div class="p-4">
                    {{-- Nama hari --}}
                    <div class="grid grid-cols-7 mb-2">
                        @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $d)
                            <div class="text-center text-xs font-semibold text-gray-400 py-1">{{ $d }}</div>
                        @endforeach
                    </div>
                    {{-- Tanggal --}}
                    <div id="calGrid" class="grid grid-cols-7 gap-y-1"></div>
                </div>

                {{-- Legend --}}
                <div class="px-4 pb-4 flex items-center gap-4 text-xs text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Ada data
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-600 ring-2 ring-red-200"></span> Dipilih
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span> Hari ini
                    </span>
                </div>
            </div>

            {{-- Stats mini --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 space-y-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Ringkasan</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Total ditampilkan</span>
                    <span id="statTotal" class="text-sm font-bold text-gray-800">0</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Rata-rata durasi</span>
                    <span id="statAvgDuration" class="text-sm font-bold text-gray-800">-</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Durasi terpanjang</span>
                    <span id="statMaxDuration" class="text-sm font-bold text-gray-800">-</span>
                </div>
                <div class="w-full h-px bg-gray-100"></div>
                <button id="btnToday"
                    class="w-full py-2 rounded-xl bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors">
                    Hari Ini
                </button>
                <button id="btnClearDate"
                    class="w-full py-2 rounded-xl bg-gray-50 text-gray-500 text-xs font-semibold hover:bg-gray-100 transition-colors">
                    Tampilkan Semua
                </button>
            </div>
        </div>

        {{-- ─── PANEL KANAN: TABEL ────────────────────────── --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">

            {{-- Header tabel --}}
            <div class="px-5 py-4 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Riwayat Check-Out</h3>
                    <p id="tableSubtitle" class="text-xs text-gray-400 mt-0.5">Pilih tanggal di kalender untuk filter</p>
                </div>
                <div class="flex items-center gap-2">
                    {{-- Search --}}
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons-outlined text-gray-400"
                            style="font-size:16px;">search</span>
                        <input id="searchInput" type="text" placeholder="Cari nama / kartu..."
                            class="pl-9 pr-4 py-2 w-52 rounded-xl border border-gray-200 text-sm focus:border-red-400 focus:ring-2 focus:ring-red-400/20 outline-none transition">
                    </div>
                    {{-- Export --}}
                    <button id="btnExport"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-slate-700 transition-colors">
                        <span class="material-icons-outlined" style="font-size:15px;">download</span>
                        Export
                    </button>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-sm" style="table-layout:fixed;">
                    <colgroup>
                        <col style="width:48px">
                        <col style="width:52px">
                        <col style="width:160px">
                        <col style="width:130px">
                        <col style="width:130px">
                        <col style="width:110px">
                        <col style="width:80px">
                        <col style="width:80px">
                        <col style="width:90px">
                    </colgroup>
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">No
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Kartu</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Dept</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                User Meeting</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Masuk</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Keluar</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Durasi</th>
                        </tr>
                    </thead>
                    <tbody id="historyTbody" class="divide-y divide-gray-50">
                        <tr>
                            <td colspan="9" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-icons-outlined text-4xl text-gray-200">history</span>
                                    <p class="text-sm text-gray-400">Pilih tanggal untuk melihat history</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div id="pagination"
                class="px-5 py-3 border-t border-gray-100 flex items-center justify-between bg-white hidden">
                <p id="paginationInfo" class="text-xs text-gray-400"></p>
                <div id="paginationBtns" class="flex items-center gap-1"></div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            // ── State ──────────────────────────────────────────────────
            let currentYear = new Date().getFullYear();
            let currentMonth = new Date().getMonth(); // 0-indexed
            let selectedDate = null;   // 'YYYY-MM-DD' atau null = semua
            let activeDates = {};     // { 'YYYY-MM-DD': count }
            let allRows = [];     // data dari API
            let filteredRows = [];
            let currentPage = 1;
            const PER_PAGE = 15;

            const MONTHS_ID = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            // ── Kalender ───────────────────────────────────────────────
            function renderCalendar() {
                const label = document.getElementById('calMonthLabel');
                const grid = document.getElementById('calGrid');
                const today = new Date();
                const todayStr = toYMD(today);

                label.textContent = `${MONTHS_ID[currentMonth]} ${currentYear}`;

                const firstDay = new Date(currentYear, currentMonth, 1).getDay(); // 0=Sun
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                let html = '';

                // Padding awal
                for (let i = 0; i < firstDay; i++) {
                    html += `<div></div>`;
                }

                for (let d = 1; d <= daysInMonth; d++) {
                    const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                    const isToday = dateStr === todayStr;
                    const isSelected = dateStr === selectedDate;
                    const hasData = activeDates[dateStr] !== undefined;
                    const count = activeDates[dateStr] || 0;

                    let cls = 'relative flex flex-col items-center justify-center h-9 w-full rounded-xl text-xs font-semibold cursor-pointer transition-all duration-150 select-none ';

                    if (isSelected) {
                        cls += 'bg-red-600 text-white shadow-md shadow-red-300 scale-105 ';
                    } else if (isToday) {
                        cls += 'bg-blue-50 text-blue-600 border border-blue-200 ';
                    } else if (hasData) {
                        cls += 'bg-red-50 text-red-700 hover:bg-red-100 ';
                    } else {
                        cls += 'text-gray-500 hover:bg-gray-50 ';
                    }

                    const dot = hasData && !isSelected
                        ? `<span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-red-400"></span>`
                        : '';

                    const badge = isSelected && count > 0
                        ? `<span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-white text-red-600 text-[9px] font-bold flex items-center justify-center shadow">${count}</span>`
                        : '';

                    html += `<div class="${cls}" onclick="selectDate('${dateStr}')" title="${count > 0 ? count + ' visitor' : ''}">
                            ${d}${dot}${badge}
                         </div>`;
                }

                grid.innerHTML = html;
            }

            async function loadActiveDates() {
                const month = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}`;
                try {
                    const res = await fetch(`{{ route('history.dates') }}?month=${month}`);
                    const json = await res.json();
                    activeDates = json.dates || {};
                } catch (e) {
                    activeDates = {};
                }
                renderCalendar();
            }

            // ── Fetch data tabel ───────────────────────────────────────
            let debounceTimer;
            function scheduleLoad(delay = 300) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(loadTableData, delay);
            }

            async function loadTableData() {
                const tbody = document.getElementById('historyTbody');
                const search = document.getElementById('searchInput').value.trim();

                tbody.innerHTML = `<tr><td colspan="9" class="py-12 text-center">
                <span class="inline-flex items-center gap-2 text-sm text-gray-400">
                    <svg class="animate-spin w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    Memuat data...
                </span>
            </td></tr>`;

                const url = new URL('{{ route("history.api") }}', window.location.origin);
                if (selectedDate) url.searchParams.append('date', selectedDate);
                if (search) url.searchParams.append('q', search);

                try {
                    const res = await fetch(url);
                    const json = await res.json();
                    allRows = json.data || [];
                } catch (e) {
                    allRows = [];
                }

                filteredRows = [...allRows];
                currentPage = 1;
                updateStats();
                renderTable();
                updateSubtitle();
            }

            // ── Render tabel ───────────────────────────────────────────
            function renderTable() {
                const tbody = document.getElementById('historyTbody');
                const start = (currentPage - 1) * PER_PAGE;
                const page = filteredRows.slice(start, start + PER_PAGE);

                if (filteredRows.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="9" class="py-16 text-center">
                    <div class="flex flex-col items-center gap-2">
                        <span class="material-icons-outlined text-4xl text-gray-200">search_off</span>
                        <p class="text-sm text-gray-400">Tidak ada data ditemukan</p>
                    </div>
                </td></tr>`;
                    document.getElementById('pagination').classList.add('hidden');
                    return;
                }

                const typeColors = {
                    visitor: 'bg-green-50 text-green-700 border-green-100',
                    vendor: 'bg-blue-50 text-blue-700 border-blue-100',
                };

                const durColor = (mins) => {
                    if (mins < 30) return 'bg-emerald-50 text-emerald-700 border-emerald-100';
                    if (mins < 120) return 'bg-amber-50 text-amber-700 border-amber-100';
                    return 'bg-red-50 text-red-700 border-red-100';
                };

                tbody.innerHTML = page.map((r, i) => {
                    const typeCls = typeColors[r.type] || typeColors['visitor'];
                    const durCls = durColor(r.duration_mins);
                    const num = start + i + 1;

                    return `<tr class="hover:bg-gray-50/60 transition-colors">
                    <td class="px-3 py-3">
                        <span class="text-xs font-mono text-gray-400 bg-gray-50 border border-gray-100 px-1.5 py-0.5 rounded">${num}</span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-mono font-semibold
                            ${r.card_tipe === 'plant' ? 'bg-orange-50 text-orange-700 border border-orange-100' : 'bg-slate-50 text-slate-700 border border-slate-200'}">
                            ${escHtml(r.card_code)}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center flex-shrink-0">
                                <span class="text-xs font-bold text-red-600">${escHtml(r.name.charAt(0).toUpperCase())}</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-800 truncate" title="${escHtml(r.name)}">${escHtml(r.name)}</p>
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium border ${typeCls} mt-0.5">${escHtml(r.type)}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-3 text-xs text-gray-500 truncate" title="${escHtml(r.dept)}">${escHtml(r.dept)}</td>
                    <td class="px-3 py-3 text-xs text-gray-500 truncate" title="${escHtml(r.user_meeting)}">${escHtml(r.user_meeting)}</td>
                    <td class="px-3 py-3 text-xs text-gray-500 whitespace-nowrap">${escHtml(r.date)}</td>
                    <td class="px-3 py-3">
                        <span class="inline-flex items-center gap-1 text-xs text-emerald-700 font-semibold">
                            <span class="material-icons-outlined" style="font-size:13px;">login</span>
                            ${escHtml(r.check_in)}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="inline-flex items-center gap-1 text-xs text-gray-600 font-semibold">
                            <span class="material-icons-outlined" style="font-size:13px;">logout</span>
                            ${escHtml(r.check_out)}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold border ${durCls}">
                            <span class="material-icons-outlined mr-0.5" style="font-size:11px;">schedule</span>
                            ${escHtml(r.duration)}
                        </span>
                    </td>
                </tr>`;
                }).join('');

                renderPagination();
            }

            // ── Pagination ─────────────────────────────────────────────
            function renderPagination() {
                const total = filteredRows.length;
                const totalPages = Math.ceil(total / PER_PAGE);
                const pag = document.getElementById('pagination');
                const info = document.getElementById('paginationInfo');
                const btns = document.getElementById('paginationBtns');

                if (totalPages <= 1) { pag.classList.add('hidden'); return; }
                pag.classList.remove('hidden');

                const s = (currentPage - 1) * PER_PAGE + 1;
                const e = Math.min(currentPage * PER_PAGE, total);
                info.textContent = `${s}–${e} dari ${total} data`;

                let html = `<button onclick="gotoPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} 
                class="w-7 h-7 rounded-lg border text-xs flex items-center justify-center transition
                ${currentPage === 1 ? 'text-gray-300 bg-gray-50 border-gray-100 cursor-not-allowed' : 'text-gray-600 bg-white border-gray-200 hover:bg-gray-50'}">
                <span class="material-icons-outlined" style="font-size:14px;">chevron_left</span></button>`;

                for (let p = 1; p <= totalPages; p++) {
                    if (p === 1 || p === totalPages || Math.abs(p - currentPage) <= 1) {
                        html += p === currentPage
                            ? `<span class="w-7 h-7 rounded-lg bg-red-500 text-white text-xs font-semibold flex items-center justify-center">${p}</span>`
                            : `<button onclick="gotoPage(${p})" class="w-7 h-7 rounded-lg border border-gray-200 bg-white text-xs text-gray-600 hover:bg-red-50 hover:text-red-600 transition">${p}</button>`;
                    } else if (Math.abs(p - currentPage) === 2) {
                        html += `<span class="w-5 text-xs text-gray-300 text-center">···</span>`;
                    }
                }

                html += `<button onclick="gotoPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} 
                class="w-7 h-7 rounded-lg border text-xs flex items-center justify-center transition
                ${currentPage === totalPages ? 'text-gray-300 bg-gray-50 border-gray-100 cursor-not-allowed' : 'text-gray-600 bg-white border-gray-200 hover:bg-gray-50'}">
                <span class="material-icons-outlined" style="font-size:14px;">chevron_right</span></button>`;

                btns.innerHTML = html;
            }

            window.gotoPage = function (p) {
                const total = Math.ceil(filteredRows.length / PER_PAGE);
                if (p < 1 || p > total) return;
                currentPage = p;
                renderTable();
            };

            // ── Stats ──────────────────────────────────────────────────
            function updateStats() {
                document.getElementById('statTotal').textContent = allRows.length;
                if (allRows.length === 0) {
                    document.getElementById('statAvgDuration').textContent = '-';
                    document.getElementById('statMaxDuration').textContent = '-';
                    return;
                }
                const mins = allRows.map(r => r.duration_mins);
                const avg = Math.round(mins.reduce((a, b) => a + b, 0) / mins.length);
                const max = Math.max(...mins);
                const fmtMins = m => m >= 60 ? `${Math.floor(m / 60)}j ${m % 60}m` : `${m}m`;
                document.getElementById('statAvgDuration').textContent = fmtMins(avg);
                document.getElementById('statMaxDuration').textContent = fmtMins(max);
            }

            function updateSubtitle() {
                const el = document.getElementById('tableSubtitle');
                if (selectedDate) {
                    const [y, m, d] = selectedDate.split('-');
                    el.textContent = `Tanggal ${parseInt(d)} ${MONTHS_ID[parseInt(m) - 1]} ${y} — ${allRows.length} visitor`;
                } else {
                    el.textContent = `Semua data — ${allRows.length} visitor`;
                }
            }

            // ── Select date ────────────────────────────────────────────
            window.selectDate = function (dateStr) {
                selectedDate = (selectedDate === dateStr) ? null : dateStr;
                renderCalendar();
                scheduleLoad(0);
            };

            // ── Event listeners ────────────────────────────────────────
            document.getElementById('prevMonth').addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) { currentMonth = 11; currentYear--; }
                loadActiveDates();
            });

            document.getElementById('nextMonth').addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) { currentMonth = 0; currentYear++; }
                loadActiveDates();
            });

            document.getElementById('btnToday').addEventListener('click', () => {
                const t = new Date();
                currentYear = t.getFullYear();
                currentMonth = t.getMonth();
                selectedDate = toYMD(t);
                loadActiveDates();
                scheduleLoad(0);
            });

            document.getElementById('btnClearDate').addEventListener('click', () => {
                selectedDate = null;
                renderCalendar();
                scheduleLoad(0);
            });

            document.getElementById('searchInput').addEventListener('input', () => {
                currentPage = 1;
                scheduleLoad(400);
            });

            // Export
            document.getElementById('btnExport').addEventListener('click', () => {
                const search = document.getElementById('searchInput').value.trim();
                const url = new URL('{{ route("history.export") }}', window.location.origin);
                if (selectedDate) url.searchParams.append('date', selectedDate);
                if (search) url.searchParams.append('q', search);
                window.location.href = url.toString();
            });

            // ── Utils ──────────────────────────────────────────────────
            function toYMD(d) {
                return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
            }

            function escHtml(str) {
                return String(str ?? '-').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
            }

            // ── Init ───────────────────────────────────────────────────
            loadActiveDates();
            loadTableData();

        })();
    </script>

@endsection