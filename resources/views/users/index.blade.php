@section('title', 'Users & Visitors')
@section('subtitle', 'Kelola data pengguna dan pengunjung')
@extends('layout.app')
@section('content')

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabs -->
    <div class="mb-6">
    </div>

    <!-- Users Tab -->
    <div id="content-users" class="tab-content">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="relative flex-1 sm:w-64">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari pengguna..."
                        class="input-enhanced w-full pl-10 pr-4 py-2.5 rounded-xl bg-gray-50 focus:bg-white focus:outline-none text-sm">
                </div>
            </div>
            <button
                class="btn-primary text-white px-5 py-2.5 rounded-xl font-medium text-sm flex items-center gap-2 justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah User
            </button>
        </div>

        <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users ?? [] as $user)
                            <tr class="table-row-hover">
                                <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $user->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold 
                                                                                        @if($user->role == 'admin') bg-purple-100 text-purple-700
                                                                                        @elseif($user->role == 'manager') bg-blue-100 text-blue-700
                                                                                        @elseif($user->role == 'sales') bg-green-100 text-green-700
                                                                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($user->role ?? 'user') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-gray-400 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada data pengguna</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Visitors Tab -->
    <div id="content-visitors" class="tab-content hidden">
        <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Kunjungan</h3>
                <p class="text-sm text-gray-500">Kelola status kunjungan visitor</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Perusahaan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tujuan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($visitors ?? [] as $visitor)
                            <tr class="table-row-hover">
                                <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $visitor->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-800 font-medium">{{ $visitor->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $visitor->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $visitor->company }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                        {{ $visitor->tujuan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($visitor->status == 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif($visitor->status == 'selesai')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                            {{ ucfirst($visitor->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $visitor->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($visitor->status == 'pending')
                                        <form action="{{ route('visitor.updateStatus', $visitor->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Selesai
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada data kunjungan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Visitor Sessions Tab -->
    <div id="content-sessions" class="tab-content hidden">
        <div class="card-hover bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Visitor Sessions Aktif</h3>
                <p class="text-sm text-gray-500">Kelola sesi visitor yang sedang aktif</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Dibuat</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($visitorUsers ?? [] as $vUser)
                            <tr class="table-row-hover">
                                <td class="px-6 py-4 text-sm text-gray-500 font-mono">#{{ $vUser->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $vUser->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $vUser->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vUser->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <form action="{{ route('visitor.logout', $vUser->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin logout visitor ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada sesi visitor aktif</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all content
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            // Reset all tabs
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('border-red-500', 'text-red-600');
                el.classList.add('border-transparent', 'text-gray-500');
            });
            // Show selected content
            document.getElementById('content-' + tabName).classList.remove('hidden');
            // Activate selected tab
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-red-500', 'text-red-600');
        }
    </script>

@endsection