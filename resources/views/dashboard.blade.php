@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang di dashboard KYB')
@extends('layout.app')
@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
    <!-- Card: Total Users -->
    <div class="card-hover bg-white rounded-xl shadow-md p-5 lg:p-6 border-l-4 border-blue-500 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/5 rounded-full -mr-10 -mt-10"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Users</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1">1,245</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-1 text-sm">
            <span class="text-green-500 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                12%
            </span>
            <span class="text-gray-400">from last month</span>
        </div>
    </div>

    <!-- Card: Total Orders -->
    <div class="card-hover bg-white rounded-xl shadow-md p-5 lg:p-6 border-l-4 border-green-500 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-20 h-20 bg-green-500/5 rounded-full -mr-10 -mt-10"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Orders</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1">568</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-1 text-sm">
            <span class="text-green-500 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                8%
            </span>
            <span class="text-gray-400">from last month</span>
        </div>
    </div>

    <!-- Card: Revenue -->
    <div class="card-hover bg-white rounded-xl shadow-md p-5 lg:p-6 border-l-4 border-purple-500 relative overflow-hidden sm:col-span-2 lg:col-span-1">
        <div class="absolute top-0 right-0 w-20 h-20 bg-purple-500/5 rounded-full -mr-10 -mt-10"></div>
        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Revenue</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1">$52.4K</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center gap-1 text-sm">
            <span class="text-green-500 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                15%
            </span>
            <span class="text-gray-400">from last month</span>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-6">
    <!-- Line Chart -->
    <div class="card-hover bg-white rounded-xl shadow-md p-5 lg:p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-blue-500 rounded-full"></span>
            Penjualan Bulanan
        </h3>
        <div class="w-full h-48 sm:h-56 lg:h-64">
            <canvas id="salesChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="card-hover bg-white rounded-xl shadow-md p-5 lg:p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-green-500 rounded-full"></span>
            Distribusi Kategori
        </h3>
        <div class="w-full h-48 sm:h-56 lg:h-64">
            <canvas id="categoryChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>

<!-- Bar Chart -->
<div class="card-hover bg-white rounded-xl shadow-md p-5 lg:p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <span class="w-1 h-6 bg-purple-500 rounded-full"></span>
        Performa Per Divisi
    </h3>
    <div class="w-full h-48 sm:h-56 lg:h-64">
        <canvas id="performanceChart" class="w-full h-full"></canvas>
    </div>
</div>

<!-- Table Section -->
<div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-5 lg:px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-1 h-6 bg-red-500 rounded-full"></span>
            Transaksi Terbaru
        </h3>
        <button class="text-sm text-red-500 hover:text-red-600 font-medium transition">
            Lihat Semua →
        </button>
    </div>
    
    <!-- Desktop Table -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nilai</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="table-row-hover">
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">#TXN001</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">John Doe</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Laptop Pro</td>
                    <td class="px-6 py-4 text-sm text-gray-600">2</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">$3,500</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                            Selesai
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">06 Feb 2026</td>
                </tr>
                <tr class="table-row-hover">
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">#TXN002</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">Jane Smith</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Monitor 4K</td>
                    <td class="px-6 py-4 text-sm text-gray-600">1</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">$1,200</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                            Pending
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">05 Feb 2026</td>
                </tr>
                <tr class="table-row-hover">
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">#TXN003</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">Mike Johnson</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Keyboard</td>
                    <td class="px-6 py-4 text-sm text-gray-600">5</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">$450</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                            Diproses
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">04 Feb 2026</td>
                </tr>
                <tr class="table-row-hover">
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">#TXN004</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">Sarah Williams</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Mouse</td>
                    <td class="px-6 py-4 text-sm text-gray-600">3</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">$180</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                            Selesai
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">03 Feb 2026</td>
                </tr>
                <tr class="table-row-hover">
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">#TXN005</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">Robert Brown</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Webcam</td>
                    <td class="px-6 py-4 text-sm text-gray-600">1</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">$320</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                            Batal
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">02 Feb 2026</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="sm:hidden divide-y divide-gray-100">
        <div class="p-4 table-row-hover">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <span class="text-xs text-gray-400 font-mono">#TXN001</span>
                    <div class="text-sm font-semibold text-gray-800">John Doe</div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Selesai</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500">Laptop Pro × 2</span>
                <span class="font-semibold text-gray-800">$3,500</span>
            </div>
            <div class="text-xs text-gray-400 mt-1">06 Feb 2026</div>
        </div>
        
        <div class="p-4 table-row-hover">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <span class="text-xs text-gray-400 font-mono">#TXN002</span>
                    <div class="text-sm font-semibold text-gray-800">Jane Smith</div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500">Monitor 4K × 1</span>
                <span class="font-semibold text-gray-800">$1,200</span>
            </div>
            <div class="text-xs text-gray-400 mt-1">05 Feb 2026</div>
        </div>
        
        <div class="p-4 table-row-hover">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <span class="text-xs text-gray-400 font-mono">#TXN003</span>
                    <div class="text-sm font-semibold text-gray-800">Mike Johnson</div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Diproses</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500">Keyboard × 5</span>
                <span class="font-semibold text-gray-800">$450</span>
            </div>
            <div class="text-xs text-gray-400 mt-1">04 Feb 2026</div>
        </div>
        
        <div class="p-4 table-row-hover">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <span class="text-xs text-gray-400 font-mono">#TXN004</span>
                    <div class="text-sm font-semibold text-gray-800">Sarah Williams</div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Selesai</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500">Mouse × 3</span>
                <span class="font-semibold text-gray-800">$180</span>
            </div>
            <div class="text-xs text-gray-400 mt-1">03 Feb 2026</div>
        </div>
        
        <div class="p-4 table-row-hover">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <span class="text-xs text-gray-400 font-mono">#TXN005</span>
                    <div class="text-sm font-semibold text-gray-800">Robert Brown</div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Batal</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500">Webcam × 1</span>
                <span class="font-semibold text-gray-800">$320</span>
            </div>
            <div class="text-xs text-gray-400 mt-1">02 Feb 2026</div>
        </div>
    </div>
</div>

<script>
    // Chart.js configuration
    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.color = '#6b7280';
    
    // Sales Chart (Line Chart)
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 200);
    salesGradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
    salesGradient.addColorStop(1, 'rgba(59, 130, 246, 0)');
    
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Penjualan',
                data: [12000, 19000, 15000, 25000, 22000, 30000],
                borderColor: '#3b82f6',
                backgroundColor: salesGradient,
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: {
                        callback: value => '$' + value.toLocaleString()
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Category Chart (Doughnut)
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Electronics', 'Software', 'Hardware', 'Services'],
            datasets: [{
                data: [35, 25, 20, 20],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 20, usePointStyle: true }
                }
            }
        }
    });

    // Performance Chart (Horizontal Bar)
    const performanceCtx = document.getElementById('performanceChart').getContext('2d');
    new Chart(performanceCtx, {
        type: 'bar',
        data: {
            labels: ['Sales', 'Marketing', 'IT', 'HR', 'Finance'],
            datasets: [{
                label: 'Target',
                data: [90, 85, 88, 80, 92],
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: '#3b82f6',
                borderWidth: 2,
                borderRadius: 6
            }, {
                label: 'Realisasi',
                data: [75, 80, 92, 85, 88],
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                borderColor: '#10b981',
                borderWidth: 2,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: {
                    position: 'top',
                    labels: { usePointStyle: true }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                y: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection