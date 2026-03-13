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
                <a href="{{ route('desk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('desk.index')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}">
                    <i class="bi bi-kanban"></i> <span class="font-medium"> Desk
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('history.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('history.index')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}">
                    <i class="bi bi-clock-history"></i> <span class="font-medium"> History Visitor
                    </span>
                </a>
            </li>

            <div class="text-xs mt-8 font-semibold text-white/60 uppercase tracking-wider px-4 mb-3">
                Kelola Visitor
            </div>
            @if(Auth::check())

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

                    <li>
                        <a href="{{ route('transaction.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                                                                                                                                                                                                                                                                                                                                          {{ request()->routeIs('transaction.*')
                ? 'menu-item-active'
                : 'hover:bg-white/10' }}"><i class="bi bi-list text-xl"></i> <span class="font-medium">List
                                Visitor</span>
                        </a>
                    </li>
            @endif

            <div class="text-xs mt-8 font-semibold text-white/60 uppercase tracking-wider px-4 mb-3">
                Form Manual
            </div>


            <li>
                <a href="{{ route('form.visitor') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                                                                                                                          {{ request()->routeIs('form.visitor.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}"><i class="bi bi-people"></i>
                    <span class="font-medium">Form
                        Visitor</span>
                </a>
            </li>
            <li>
                <a href="{{ route('form.contraktor') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                                                                                                                          {{ request()->routeIs('check.contraktor.*')
    ? 'menu-item-active'
    : 'hover:bg-white/10' }}"><i class="bi bi-truck"></i>
                    <span class="font-medium">Form
                        Contractor</span>
                </a>
            </li>

        </ul>
    </nav>


</aside>

<!-- Overlay for mobile when sidebar is open -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 hidden transition-opacity duration-300"
    onclick="toggleSidebar()"></div>