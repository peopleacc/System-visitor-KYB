@section('title', 'Visitor Desk')
@section('subtitle', 'Manage Visitor')
@extends('layout.app')
@section('content')
    <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">

        <!-- Content -->
        <div class="p-6">

            <!-- Panels: Active Visitors + History -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-4">
                <!-- Active Visitors -->
                <div class="xl:col-span-2 rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Visitor Aktif</h3>
                        </div>

                        <div class="flex items-center gap-2">
                            <input id="activeSearch" type="text" autocomplete="off"
                                class="w-64 rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-4 focus:ring-red-500/15"
                                placeholder="Cari nama / instansi / kartu..." />
                        </div>
                    </div>

                    <div class="mt-3 overflow-auto">
                        <table class="w-full text-sm">
                            <thead class="text-left text-xs text-slate-500">
                                <tr>
                                    <th class="py-2 pr-3">Kartu</th>
                                    <th class="py-2 pr-3">Nama</th>
                                    <th class="py-2 pr-3">Instansi</th>
                                    <th class="py-2 pr-3">Kontak</th>
                                    <th class="py-2 pr-3">Masuk</th>
                                    <th class="py-2 pr-3">Durasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($card as $item)
                                    @if ($item->transaction_qr && in_array($item->transaction_qr->status, ['approved', 'checked_in']))
                                        <tr class="py-2 pr-3">
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->transaction_qr->name }}</td>
                                            <td>{{ $item->transaction_qr->visitor_1->institution ?? $item->transaction_qr->dept ?? '-' }}</td>
                                            <td>{{ $item->transaction_qr->no_hp }}</td>
                                            <td>{{ $item->transaction_qr->check_in }}</td>
                                            <td>{{ $item->transaction_qr->check_out ?? '-' }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- History -->
                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Histori</h3>
                            <p class="text-xs text-slate-500">Filter tanggal + export CSV</p>
                        </div>

                        <button id="exportBtn"
                            class="rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm hover:bg-slate-50">
                            Export
                        </button>
                    </div>

                    <div class="mt-3 space-y-2">
                        <input id="historyQ" type="text" autocomplete="off"
                            class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-4 focus:ring-red-500/15"
                            placeholder="Cari nama / instansi / kartu..." />

                        <div class="grid grid-cols-2 gap-2">
                            <input id="historyFrom" type="date"
                                class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm">
                            <input id="historyTo" type="date"
                                class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm">
                        </div>

                        <button id="historyLoadBtn"
                            class="w-full rounded-xl bg-slate-900 px-3 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                            Tampilkan
                        </button>

                        <div class="mt-2 max-h-56 overflow-auto border border-slate-100 rounded-xl">
                            <table class="w-full text-xs">
                                <thead class="text-left text-slate-500 bg-slate-50">
                                    <tr>
                                        <th class="py-2 px-2">Kartu</th>
                                        <th class="py-2 px-2">Nama</th>
                                        <th class="py-2 px-2">Masuk</th>
                                        <th class="py-2 px-2">Keluar</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTbody" class="divide-y divide-slate-100"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Sticky summary -->
            <div class="sticky top-3 z-20 mb-4 rounded-2xl border border-slate-200 bg-white/80 backdrop-blur px-4 py-3">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold">Data Kartu</h2>
                        <p id="summaryText" class="text-xs text-slate-500">Cek data visitor di dashboard ini.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5">
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-slate-700 font-semibold">Available</span>
                            </span>

                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5">
                                <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                                <span class="text-slate-700 font-semibold">Booked</span>
                            </span>

                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5">
                                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                <span class="text-slate-700 font-semibold">Digunakan</span>
                            </span>
                        </div>

                        <button id="refreshBtn"
                            class="rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm hover:bg-slate-50">
                            Refresh
                        </button>
                    </div>
                </div>
            </div>
            <!-- Cards: Office | Plant (divider vertikal) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Office -->
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-xs font-semibold tracking-wider text-slate-600 uppercase">Office</div>
                        <div id="officeSummary" class="text-xs text-slate-500"></div>
                    </div>

                    <div id="officeGrid" class="grid [grid-template-columns:repeat(auto-fill,minmax(48px,1fr))] gap-1">
                        @foreach ($card->where('tipe', 'office') as $item)
                            @if($item->transaction_qr && $item->transaction_qr->status == 'approved')
                                <div class="h-11 w-11 rounded-xl border border-amber-200 bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <span class="text-xs font-medium">{{ $item->code }}</span>
                                </div>
                            @elseif ($item->transaction_qr && $item->transaction_qr->status == 'checked_in')
                                <div class="h-11 w-11 rounded-xl border border-red-200 bg-red-50 text-red-600 flex items-center justify-center">
                                    <span class="text-xs font-medium">{{ $item->code }}</span>
                                </div>
                            @else
                                <div class="h-11 w-11 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <span class="text-xs font-medium">{{ $item->code }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Plant -->
                <div class="lg:border-l lg:border-slate-200 lg:pl-6">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-xs font-semibold tracking-wider text-slate-600 uppercase">Plant</div>
                        <div id="plantSummary" class="text-xs text-slate-500"></div>
                    </div>

                    <div id="plantGrid" class="grid [grid-template-columns:repeat(auto-fill,minmax(48px,1fr))] gap-1">
                        @foreach ($card->where('tipe', 'plant') as $item)
                            @if($item->transaction_qr && $item->transaction_qr->status == 'approved')
                                <div class="h-11 w-11 rounded-xl border border-amber-200 bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <span class="text-xs font-medium">{{ $item->code }}</span>
                                </div>
                            @elseif ($item->transaction_qr && $item->transaction_qr->status == 'checked_in')
                                <div class="h-11 w-11 rounded-xl border border-red-200 bg-red-50 text-red-600 flex items-center justify-center">
                                    <span class="text-xs font-medium">{{ $item->code }}</span>
                                </div>
                            @else
                                <div class="h-11 w-11 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <span class="text-xs font-medium">{{ $item->code }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- Divider versi mobile-->
            <div class="my-4 h-px w-full bg-slate-200 lg:hidden"></div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Active Visitor Search ---
        const activeSearch = document.getElementById('activeSearch');
        if (activeSearch) {
            activeSearch.addEventListener('keyup', function() {
                const keyword = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody.divide-slate-100 tr:not(#historyTbody tr)');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(keyword)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // --- History Fetch & Filter ---
        const historyLoadBtn = document.getElementById('historyLoadBtn');
        const historyTbody = document.getElementById('historyTbody');
        const historyQ = document.getElementById('historyQ');
        const historyFrom = document.getElementById('historyFrom');
        const historyTo = document.getElementById('historyTo');
        const exportBtn = document.getElementById('exportBtn');

        function fetchHistory() {
            const q = historyQ.value;
            const from = historyFrom.value;
            const to = historyTo.value;

            // Show loading
            historyTbody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-slate-500">Memuat data...</td></tr>';

            const url = new URL('{{ route("desk.history") }}', window.location.origin);
            if (q) url.searchParams.append('q', q);
            if (from) url.searchParams.append('from', from);
            if (to) url.searchParams.append('to', to);

            fetch(url)
                .then(res => res.json())
                .then(res => {
                    historyTbody.innerHTML = '';
                    if (res.data && res.data.length > 0) {
                        res.data.forEach(item => {
                            const instansi = item.visitor_1 ? item.visitor_1.institution : item.dept;
                            const kartu = item.card_qr ? item.card_qr.code : '-';
                            const checkout = item.check_out ? item.check_out : '-';
                            historyTbody.innerHTML += `
                                <tr class="border-t border-slate-100">
                                    <td class="py-2 px-2">${kartu}</td>
                                    <td class="py-2 px-2">
                                        <div class="font-medium">${item.name}</div>
                                        <div class="text-[10px] text-slate-400">${instansi}</div>
                                    </td>
                                    <td class="py-2 px-2 whitespace-nowrap">${item.check_in}</td>
                                    <td class="py-2 px-2 whitespace-nowrap">${checkout}</td>
                                </tr>
                            `;
                        });
                    } else {
                        historyTbody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-slate-500">Tidak ada data history</td></tr>';
                    }
                })
                .catch(err => {
                    console.error(err);
                    historyTbody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-red-500">Gagal memuat data</td></tr>';
                });
        }

        if (historyLoadBtn) {
            historyLoadBtn.addEventListener('click', fetchHistory);
            
            // Allow enter key on search input
            historyQ.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    fetchHistory();
                }
            });
        }

        // --- Export CSV ---
        if (exportBtn) {
            exportBtn.addEventListener('click', function() {
                const q = historyQ.value;
                const from = historyFrom.value;
                const to = historyTo.value;

                // Hit point desk.exportvisitor
                const url = new URL('{{ route("desk.exportvisitor") }}', window.location.origin);
                if (q) url.searchParams.append('q', q);
                if (from) url.searchParams.append('tanggalawal', from);
                if (to) url.searchParams.append('tanggalakhir', to);

                // Trigger download by setting window.location
                window.location.href = url.toString();
            });
        }
        
        // Initial Fetch
        if (historyLoadBtn) {
             fetchHistory();
        }
    });
</script>
@endpush