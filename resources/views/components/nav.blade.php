<nav
    class="w-full h-[60px] bg-white shadow-sm border-b border-gray-200 text-gray-800 flex items-center justify-between px-4 lg:px-6 z-[300] relative">
    <div class="relative flex items-center gap-4">
        <!-- Mobile menu button -->
        <button class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-all duration-200"
            aria-label="Toggle sidebar" onclick="toggleSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <span class="font-bold text-lg tracking-tight text-gray-800">KYB System</span>
        </div>
    </div>

    <div class="relative flex items-center gap-3 lg:gap-5">
        <!-- Status Badge -->
        <div class="hidden sm:flex items-center gap-2 bg-gray-100 px-3 py-1.5 rounded-full">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span class="text-xs font-medium text-gray-600">Online</span>
        </div>

        <!-- Date -->
        <div class="hidden lg:flex items-center gap-2 text-sm text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>{{ now()->format('d M Y') }}</span>
        </div>

        <!-- User Menu -->
        <div class="flex items-center gap-3">
            <div class="hidden md:block text-right">
                <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'User' }}</div>
                <div class="text-xs text-gray-500">{{ Auth::user()->role ?? 'Admin' }}</div>
            </div>

            <!-- User Avatar -->
            <div class="w-9 h-9 bg-red-500 rounded-full flex items-center justify-center ring-2 ring-red-100">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
            @csrf
            <button
                class="bg-red-500 text-white font-semibold px-4 py-2 rounded-xl hover:bg-red-600 hover:shadow-lg transition-all duration-200 text-sm">
                Logout
            </button>
        </form>

        <!-- Mobile Logout -->
        <form action="{{ route('logout') }}" method="POST" class="md:hidden">
            @csrf
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-all duration-200" title="Logout">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</nav>