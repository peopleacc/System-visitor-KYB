<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-40 w-[240px] gradient-red-vertical text-white shadow-2xl transform -translate-x-full md:translate-x-0 md:static md:inset-auto md:transform-none transition-transform duration-300 ease-in-out flex flex-col min-h-screen">

    <!-- Header with Logo -->
    <div class="p-5">
        <div class="bg-white rounded-xl shadow-lg p-3 flex items-center justify-center">
            <img src="{{ asset('image/kayaba-logo.png') }}" alt="Kayaba Logo" class="h-10 w-auto">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-4 py-2">
        <div class="text-xs font-semibold text-white/60 uppercase tracking-wider px-4 mb-3">
            Menu Utama
        </div>

        <ul class="space-y-1">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('dashboard')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            <div class="text-xs mt-8 font-semibold text-white/60 uppercase tracking-wider px-4 mb-3">
                Kelola Visitor
            </div>
            @if(Auth::check())
                    <!-- Approval -->
                    <li>
                        <a href="{{ route('transaction.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                                                          {{ request()->routeIs('transaction.*')
                ? 'menu-item-active'
                : 'hover:bg-white/10' }}"><i class="bi bi-kanban"></i> <span class="font-medium"> Desk
                            </span>
                        </a>
                    </li>

                    <!-- Approval -->
                    <li>
                        <a href="{{ route('check.in.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                                                  {{ request()->routeIs('check.in.*')
                ? 'menu-item-active'
                : 'hover:bg-white/10' }}"><i class="bi bi-box-arrow-in-right"></i>
                            <span class="font-medium">Check
                                In/Out</span>
                        </a>
                    </li>
            @endif

            @if (Auth::guard('lembur')->check())

                    <!-- Approval -->
                    <li>
                        <a href="{{ route('transaction.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                                                                  {{ request()->routeIs('transaction.*')
                ? 'menu-item-active'
                : 'hover:bg-white/10' }}"><i class="bi bi-list text-xl"></i> <span class="font-medium">List
                                Visitor</span>
                        </a>
                    </li>
            @endif




            <!-- visitor -->

            <!-- <li>
                <a href="route('visitor.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('visitor.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium">User</span>
                </a>
            </li> -->

            <!-- transation -->
            <!-- <li>
                <a href="{{ route('transaction.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('transaction.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}"><i class="bi bi-clipboard2-check"></i>
                    <span class="font-medium">accecpt</span>
                </a>
            </li> -->


            <!-- Check In -->


            <!-- Barcode  -->
            <!-- <li>
                <a href="{{ route('barcode.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('barcode.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}"> <i class="bi bi-qr-code"></i>
                    <span class="font-medium">Barcode</span>
                </a>
            </li>

            <div class="text-xs mt-8 sidefont-semibold text-white/60 uppercase tracking-wider px-4 mb-3">
                Menu Check Visitor
            </div> -->

            <!-- <li>
                <a href="{{ route('check.in.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('check.in.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}"> <i class="bi bi-box-arrow-in-right"></i>

                    <span class="font-medium">Check In</span>
                </a>
            </li> -->


            <!-- Check out -->
            <!-- <li>

                <a href="{{ route('check.out.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('check.out.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}"> <i class="bi bi-box-arrow-left"></i>
                    <span class="font-medium">Check out</span>
                </a>
            </li> -->






        </ul>
    </nav>

    <!-- Bottom Section -->
    <!-- <div class="absolute bottom-0 left-0 right-0 p-4">
        <div class="bg-white/10 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium truncate">{{ Auth::user()->name ?? 'User' }}</div>
                    <div class="text-xs text-white/70 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</div>
                </div>
            </div>
        </div>
    </div> -->
</aside>

<!-- Overlay for mobile when sidebar is open -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 hidden transition-opacity duration-300"
    onclick="toggleSidebar()"></div>