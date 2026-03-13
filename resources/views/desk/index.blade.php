@section('title', 'Visitor Desk')
@section('subtitle', 'Manage Visitor')
@extends('layout.app')

@section('content')

    @php
        $allCards = $card;
        $totalCards = $allCards->count();
        $available = $allCards->where('status', 'available')->count();
        $booked = $allCards->where('status', 'booked')->count();
        $inUse = $allCards->where('status', 'in_use')->count();

        $totalApproved = $statCounts['approved'] ?? 0;
        $totalCheckedIn = $statCounts['check_in'] ?? 0;
        $totalCheckedOut = $statCounts['check_out'] ?? 0;
        $totalWaiting = $statCounts['waiting'] ?? 0;
        $totalVisitor = $totalApproved + $totalCheckedIn + $totalCheckedOut + $totalWaiting;
    @endphp

    {{-- ══════════════════════════════════════════════════════════
    STAT CARDS
    ══════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Total Visitor --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 p-5 text-white shadow-lg">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-white/5"></div>
            <div class="absolute -right-2 -bottom-6 w-16 h-16 rounded-full bg-white/5"></div>
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center mb-3">
                <span class="material-icons-outlined text-white" style="font-size:20px;">groups</span>
            </div>
            <p class="text-3xl font-bold">{{ $totalVisitor }}</p>
            <p class="text-xs text-slate-400 mt-1 font-medium">Total Visitor</p>
        </div>

        {{-- Approved --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 p-5 text-white shadow-lg shadow-amber-500/25">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-white/10"></div>
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center mb-3">
                <span class="material-icons-outlined text-white" style="font-size:20px;">verified</span>
            </div>
            <p class="text-3xl font-bold">{{ $totalApproved }}</p>
            <p class="text-xs text-amber-100 mt-1 font-medium">Approved</p>
        </div>

        {{-- Check In --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 to-red-600 p-5 text-white shadow-lg shadow-red-500/25">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-white/10"></div>
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center mb-3">
                <span class="material-icons-outlined text-white" style="font-size:20px;">login</span>
            </div>
            <p class="text-3xl font-bold">{{ $totalCheckedIn }}</p>
            <p class="text-xs text-red-100 mt-1 font-medium">Sedang Check In</p>
        </div>

        {{-- Check Out --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-500 p-5 text-white shadow-lg shadow-emerald-500/25">
            <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-white/10"></div>
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center mb-3">
                <span class="material-icons-outlined text-white" style="font-size:20px;">logout</span>
            </div>
            <p class="text-3xl font-bold">{{ $totalCheckedOut }}</p>
            <p class="text-xs text-emerald-100 mt-1 font-medium">Check Out</p>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
    CHARTS ROW
    ══════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

        {{-- Donut: Status Visitor --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex flex-col">
            <h3 class="text-sm font-semibold text-slate-800 mb-1">Status Visitor Hari Ini</h3>
            <p class="text-xs text-slate-400 mb-4">Distribusi status kunjungan</p>
            <div class="flex-1 flex items-center justify-center" style="min-height:180px;">
                <canvas id="statusDonut" style="max-height:180px;"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-2">
                <div class="flex items-center gap-2 text-xs text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-amber-400 flex-shrink-0"></span> Approved ({{ $totalApproved }})
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-red-500 flex-shrink-0"></span> Check In ({{ $totalCheckedIn }})
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 flex-shrink-0"></span> Check Out
                    ({{ $totalCheckedOut }})
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-600">
                    <span class="w-3 h-3 rounded-full bg-slate-300 flex-shrink-0"></span> Menunggu ({{ $totalWaiting }})
                </div>
            </div>
        </div>

        {{-- Bar: Visitor per hari (7 hari) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex flex-col">
            <div class="flex items-center justify-between mb-1">
                <h3 class="text-sm font-semibold text-slate-800">Tren Visitor 7 Hari Terakhir</h3>
                <span class="text-xs text-slate-400">Total masuk per hari</span>
            </div>
            <p class="text-xs text-slate-400 mb-4">Berdasarkan tanggal kunjungan</p>
            <div class="flex-1" style="min-height:180px; position:relative;">
                <canvas id="trendBar"></canvas>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
    MAIN CONTENT: Active Visitors + History
    ══════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-6">

        {{-- Active Visitors Table --}}
        <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900">Visitor Aktif</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Status approved & sedang di dalam</p>
                </div>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons-outlined text-slate-400"
                        style="font-size:16px;">search</span>
                    <input id="activeSearch" type="text" autocomplete="off"
                        class="pl-9 pr-4 py-2 w-56 rounded-xl border border-slate-200 text-sm focus:border-red-400 focus:ring-2 focus:ring-red-400/20 outline-none transition"
                        placeholder="Cari nama / kartu..." />
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" style="table-layout:fixed;">
                    <colgroup>
                        <col style="width:80px">
                        <col style="width:160px">
                        <col style="width:140px">
                        <col style="width:120px">
                        <col style="width:120px">
                    </colgroup>
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Kartu</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Instansi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Kontak</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                Check In</th>
                          
                        </tr>
                    </thead>
                    <tbody id="activeVisitorsTbody" class="divide-y divide-slate-50">
                        @php $hasActive = false; @endphp
                        @foreach ($card as $item)
                            @if ($item->transaction_qr && $item->transaction_qr->status === 'check_in')
                                @php $hasActive = true; @endphp
                                <tr class="hover:bg-slate-50/70 transition-colors active-row">
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-mono font-semibold bg-red-50 text-red-600 border border-red-100">
                                            {{ $item->code }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div
                                                class="w-7 h-7 rounded-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center flex-shrink-0">
                                                <span
                                                    class="text-xs font-bold text-red-600">{{ strtoupper(substr($item->transaction_qr->name, 0, 1)) }}</span>
                                            </div>
                                            <span class="text-sm font-medium text-slate-800 truncate"
                                                title="{{ $item->transaction_qr->name }}">{{ $item->transaction_qr->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-slate-500 truncate"
                                        title="{{ $item->transaction_qr->visitor_1->institution ?? $item->transaction_qr->dept ?? '-' }}">
                                        {{ $item->transaction_qr->visitor_1->institution ?? $item->transaction_qr->dept ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-xs text-slate-500 truncate">{{ $item->transaction_qr->no_hp }}</td>
                                    <td class="px-4 py-3 text-xs text-slate-500 whitespace-nowrap">
                                        {{ $item->transaction_qr->check_in ? \Carbon\Carbon::parse($item->transaction_qr->check_in)->format('H:i') : '-' }}
                                    </td>
                                    
                                </tr>
                            @endif
                        @endforeach
                        @if(!$hasActive)
                            <tr id="activeEmptyRow">
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="material-icons-outlined text-3xl text-slate-200">person_off</span>
                                        <p class="text-sm text-slate-400">Tidak ada visitor aktif</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- History Panel --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900">Histori Kunjungan</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Filter & export CSV</p>
                </div>
                <button id="exportBtn"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-slate-700 transition-colors">
                    <span class="material-icons-outlined" style="font-size:15px;">download</span>
                    Export
                </button>
            </div>
            <div class="p-4 space-y-2.5 flex-1 flex flex-col">
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons-outlined text-slate-400"
                        style="font-size:15px;">search</span>
                    <input id="historyQ" type="text" autocomplete="off"
                        class="pl-9 pr-4 py-2 w-full rounded-xl border border-slate-200 text-xs focus:border-red-400 focus:ring-2 focus:ring-red-400/20 outline-none transition"
                        placeholder="Cari nama / instansi / kartu..." />
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs text-slate-400 mb-1 block">Dari</label>
                        <input id="historyFrom" type="date"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-red-400 focus:ring-2 focus:ring-red-400/20 outline-none transition">
                    </div>
                    <div>
                        <label class="text-xs text-slate-400 mb-1 block">Sampai</label>
                        <input id="historyTo" type="date"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:border-red-400 focus:ring-2 focus:ring-red-400/20 outline-none transition">
                    </div>
                </div>
                <button id="historyLoadBtn"
                    class="w-full py-2.5 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold hover:from-red-600 hover:to-red-700 transition-all shadow-sm shadow-red-500/25 inline-flex items-center justify-center gap-1.5">
                    <span class="material-icons-outlined" style="font-size:15px;">filter_list</span>
                    Tampilkan
                </button>

                <div class="flex-1 overflow-auto rounded-xl border border-slate-100" style="max-height:280px;">
                    <table class="w-full text-xs">
                        <thead class="sticky top-0 bg-slate-50">
                            <tr>
                                <th class="py-2 px-3 text-left text-slate-400 font-semibold uppercase tracking-wider">Kartu
                                </th>
                                <th class="py-2 px-3 text-left text-slate-400 font-semibold uppercase tracking-wider">Nama
                                </th>
                                <th class="py-2 px-3 text-left text-slate-400 font-semibold uppercase tracking-wider">Masuk
                                </th>
                                <th class="py-2 px-3 text-left text-slate-400 font-semibold uppercase tracking-wider">Keluar
                                </th>
                            </tr>
                        </thead>
                        <tbody id="historyTbody" class="divide-y divide-slate-50">
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400 text-xs">Klik Tampilkan untuk melihat
                                    histori</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
    CARD STATUS GRID
    ══════════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        {{-- Header --}}
        <div class="px-5 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-sm font-semibold text-slate-900">Status Kartu</h2>
                <p id="summaryText" class="text-xs text-slate-400 mt-0.5">
                    {{ $available }} tersedia · {{ $booked }} booked · {{ $inUse }} digunakan · {{ $totalCards }} total
                </p>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <div class="flex items-center gap-3 text-xs">
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-emerald-100 bg-emerald-50 text-emerald-700 font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Available ({{ $available }})
                    </span>
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-amber-100 bg-amber-50 text-amber-700 font-semibold">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span> Booked ({{ $booked }})
                    </span>
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-red-100 bg-red-50 text-red-700 font-semibold">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span> Digunakan ({{ $inUse }})
                    </span>
                </div>
                <button id="refreshBtn"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 text-xs font-medium hover:bg-slate-50 transition-colors">
                    <span class="material-icons-outlined" style="font-size:15px;">refresh</span>
                    Refresh
                </button>
            </div>
        </div>

        {{-- Grids --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
            {{-- Office --}}
            <div class="p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-icons-outlined text-slate-500" style="font-size:16px;">business</span>
                        <span class="text-xs font-bold tracking-widest text-slate-600 uppercase">Office</span>
                    </div>
                    <span class="text-xs text-slate-400">
                        {{ $card->where('tipe', 'office')->where('status', 'available')->count() }} /
                        {{ $card->where('tipe', 'office')->count() }} tersedia
                    </span>
                </div>
                <div class="grid gap-1.5" style="grid-template-columns: repeat(auto-fill, minmax(52px, 1fr))">
                    @foreach ($card->where('tipe', 'office') as $item)
                        @php
                            $txStatus = $item->transaction_qr->status ?? null;
                            if ($txStatus === 'check_in') {
                                $cardClass = 'border-red-200 bg-red-50 text-red-600 shadow-sm shadow-red-100';
                                $dot = 'bg-red-500 animate-pulse';
                            } elseif ($txStatus === 'approved') {
                                $cardClass = 'border-amber-200 bg-amber-50 text-amber-600 shadow-sm shadow-amber-100';
                                $dot = 'bg-amber-400';
                            } else {
                                $cardClass = 'border-emerald-200 bg-emerald-50 text-emerald-700';
                                $dot = 'bg-emerald-400';
                            }
                        @endphp
                        <div class="h-12 rounded-xl border {{ $cardClass }} flex flex-col items-center justify-center gap-0.5 relative group cursor-default"
                            title="{{ $txStatus === 'check_in' ? ($item->transaction_qr->name ?? '') . ' - Di Dalam' : ($txStatus === 'approved' ? ($item->transaction_qr->name ?? '') . ' - Approved' : 'Available') }}">
                            <span class="text-xs font-bold font-mono">{{ $item->code }}</span>
                            <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Plant --}}
            <div class="p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-icons-outlined text-slate-500" style="font-size:16px;">factory</span>
                        <span class="text-xs font-bold tracking-widest text-slate-600 uppercase">Plant</span>
                    </div>
                    <span class="text-xs text-slate-400">
                        {{ $card->where('tipe', 'plant')->where('status', 'available')->count() }} /
                        {{ $card->where('tipe', 'plant')->count() }} tersedia
                    </span>
                </div>
                <div class="grid gap-1.5" style="grid-template-columns: repeat(auto-fill, minmax(52px, 1fr))">
                    @foreach ($card->where('tipe', 'plant') as $item)
                        @php
                            $txStatus = $item->transaction_qr->status ?? null;
                            if ($txStatus === 'check_in') {
                                $cardClass = 'border-red-200 bg-red-50 text-red-600 shadow-sm shadow-red-100';
                                $dot = 'bg-red-500 animate-pulse';
                            } elseif ($txStatus === 'approved') {
                                $cardClass = 'border-amber-200 bg-amber-50 text-amber-600 shadow-sm shadow-amber-100';
                                $dot = 'bg-amber-400';
                            } else {
                                $cardClass = 'border-emerald-200 bg-emerald-50 text-emerald-700';
                                $dot = 'bg-emerald-400';
                            }
                        @endphp
                        <div class="h-12 rounded-xl border {{ $cardClass }} flex flex-col items-center justify-center gap-0.5 cursor-default"
                            title="{{ $txStatus === 'check_in' ? ($item->transaction_qr->name ?? '') . ' - Di Dalam' : ($txStatus === 'approved' ? ($item->transaction_qr->name ?? '') . ' - Approved' : 'Available') }}">
                            <span class="text-xs font-bold font-mono">{{ $item->code }}</span>
                            <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
    SCRIPTS — ditaruh langsung di content agar pasti ter-render
    ══════════════════════════════════════════════════════════ --}}
    <script>
        // Load Chart.js lalu langsung init
        (function () {
            var s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
            s.onload = function () { initDeskPage(); };
            document.head.appendChild(s);
        })();

        function initDeskPage() {

            // ─── Chart: Status Donut ────────────────────────────────
            const donutCtx = document.getElementById('statusDonut');
            if (donutCtx) {
                new Chart(donutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Approved', 'Check In', 'Check Out', 'Menunggu'],
                        datasets: [{
                            data: [{{ $totalApproved }}, {{ $totalCheckedIn }}, {{ $totalCheckedOut }}, {{ $totalWaiting }}],
                            backgroundColor: ['#f59e0b', '#ef4444', '#10b981', '#cbd5e1'],
                            borderWidth: 0,
                            hoverOffset: 6,
                        }]
                    },
                    options: {
                        cutout: '72%',
                        plugins: {
                            legend: { display: false }, tooltip: {
                                callbacks: {
                                    label: ctx => ` ${ctx.label}: ${ctx.raw}`
                                }
                            }
                        },
                        animation: { animateScale: true }
                    }
                });
            }

            // ─── Chart: Trend Bar ───────────────────────────────────
            const barCtx = document.getElementById('trendBar');
            if (barCtx) {
                const trendData = @json($trendData ?? []);
                const trendLabels = trendData.map(d => d.label);
                const trendValues = trendData.map(d => d.count);

                new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: trendLabels,
                        datasets: [{
                            label: 'Visitor',
                            data: trendValues,
                            backgroundColor: 'rgba(239,68,68,0.15)',
                            borderColor: '#ef4444',
                            borderWidth: 2,
                            borderRadius: 8,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }, tooltip: {
                                callbacks: {
                                    label: ctx => ` ${ctx.raw} visitor`
                                }
                            }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                            y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, color: '#94a3b8', stepSize: 1 }, beginAtZero: true }
                        }
                    }
                });
            }

            // ─── Active Visitors Search ─────────────────────────────
            const activeSearch = document.getElementById('activeSearch');
            if (activeSearch) {
                activeSearch.addEventListener('input', function () {
                    const kw = this.value.toLowerCase();
                    document.querySelectorAll('.active-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(kw) ? '' : 'none';
                    });
                });
            }

            // ─── History Fetch ──────────────────────────────────────
            const historyTbody = document.getElementById('historyTbody');
            const historyQ = document.getElementById('historyQ');
            const historyFrom = document.getElementById('historyFrom');
            const historyTo = document.getElementById('historyTo');
            const historyLoadBtn = document.getElementById('historyLoadBtn');
            const exportBtn = document.getElementById('exportBtn');

            function fetchHistory() {
                historyTbody.innerHTML = '<tr><td colspan="4" class="py-6 text-center text-slate-400"><span class="inline-block animate-spin material-icons-outlined" style="font-size:20px;">refresh</span></td></tr>';

                const url = new URL('{{ route("desk.history") }}', window.location.origin);
                if (historyQ.value) url.searchParams.append('q', historyQ.value);
                if (historyFrom.value) url.searchParams.append('from', historyFrom.value);
                if (historyTo.value) url.searchParams.append('to', historyTo.value);

                fetch(url)
                    .then(r => r.json())
                    .then(res => {
                        historyTbody.innerHTML = '';
                        if (res.data && res.data.length > 0) {
                            res.data.forEach(item => {
                                const instansi = item.visitor_1 ? item.visitor_1.institution : (item.dept || '-');
                                const kartu = item.card_qr ? item.card_qr.code : '-';
                                const checkin = item.check_in ? (item.check_in.length > 8 ? item.check_in.substring(11, 16) : item.check_in.substring(0, 5)) : '-';
                                const checkout = item.check_out ? (item.check_out.length > 8 ? item.check_out.substring(11, 16) : item.check_out.substring(0, 5)) : '-';

                                const statusBadge = item.status === 'check_in'
                                    ? '<span class="px-1.5 py-0.5 rounded-full bg-red-50 text-red-600 border border-red-100 font-semibold" style="font-size:10px;">Dalam</span>'
                                    : item.status === 'check_out'
                                        ? '<span class="px-1.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 font-semibold" style="font-size:10px;">Keluar</span>'
                                        : '<span class="px-1.5 py-0.5 rounded-full bg-amber-50 text-amber-600 border border-amber-100 font-semibold" style="font-size:10px;">Approved</span>';

                                historyTbody.innerHTML += `
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-3">
                                                <span class="font-mono text-xs font-semibold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">${kartu}</span>
                                            </td>
                                            <td class="py-2.5 px-3">
                                                <div class="font-semibold text-slate-700 truncate max-w-[90px]" title="${item.name}">${item.name}</div>
                                                <div class="text-slate-400 truncate max-w-[90px]" style="font-size:10px;" title="${instansi}">${instansi}</div>
                                            </td>
                                            <td class="py-2.5 px-3 whitespace-nowrap text-slate-500">${checkin}</td>
                                            <td class="py-2.5 px-3 whitespace-nowrap">${statusBadge}</td>
                                        </tr>`;
                            });
                        } else {
                            historyTbody.innerHTML = '<tr><td colspan="4" class="py-8 text-center text-slate-400">Tidak ada data histori</td></tr>';
                        }
                    })
                    .catch(() => {
                        historyTbody.innerHTML = '<tr><td colspan="4" class="py-6 text-center text-red-400">Gagal memuat data</td></tr>';
                    });
            }

            if (historyLoadBtn) historyLoadBtn.addEventListener('click', fetchHistory);
            if (historyQ) historyQ.addEventListener('keypress', e => { if (e.key === 'Enter') fetchHistory(); });

            // ─── Export CSV ─────────────────────────────────────────
            if (exportBtn) {
                exportBtn.addEventListener('click', function () {
                    const url = new URL('{{ route("desk.export") }}', window.location.origin);
                    if (historyQ.value) url.searchParams.append('q', historyQ.value);
                    if (historyFrom.value) url.searchParams.append('from', historyFrom.value);
                    if (historyTo.value) url.searchParams.append('to', historyTo.value);
                    window.location.href = url.toString();
                });
            }

            // ─── Refresh Button ─────────────────────────────────────
            const refreshBtn = document.getElementById('refreshBtn');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', function () {
                    const icon = this.querySelector('.material-icons-outlined');
                    if (icon) icon.classList.add('spin-once');
                    setTimeout(() => window.location.reload(), 300);
                });
            }

            // Auto fetch history on load
            fetchHistory();
        }
    </script>

    <style>
        @keyframes spin-once {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .spin-once {
            animation: spin-once 0.4s ease;
        }
    </style>
@endsection