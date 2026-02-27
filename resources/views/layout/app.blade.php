<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - KYB System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 font-sans min-h-screen">

    <div class="flex min-h-screen">
        <!-- Sidebar component (full height, left column) -->
        <x-sidebar />

        <!-- Right column: Navbar + Main Content -->
        <div class="flex-1 flex flex-col min-h-screen md:ml-0">
            <!-- Navbar component -->
            <x-nav />

            <!-- Main Content -->
            <main class="flex-1 p-4 lg:p-6 overflow-x-hidden">

                <div class="max-w-7xl mx-auto animate-fade-in">
                    <!-- Content Card -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 min-h-[calc(100vh-140px)] overflow-hidden">

                        <!-- Header (inside box) -->
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-white to-gray-50/50">
                            <h2 class="text-xl lg:text-2xl font-bold text-gray-800">
                                @yield('title')
                            </h2>
                            <p class="text-gray-500 text-sm mt-1">
                                @yield('subtitle', 'Dashboard overview')
                            </p>
                        </div>

                        <!-- Content Area -->
                        <div class="p-4 lg:p-6 overflow-y-auto max-h-[calc(100vh-220px)]">
                            @yield('content')
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>

</body>

</html>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (!sidebar) return;

        sidebar.classList.toggle('-translate-x-full');

        if (overlay) {
            if (sidebar.classList.contains('-translate-x-full')) {
                overlay.classList.add('hidden');
            } else {
                overlay.classList.remove('hidden');
            }
        }
    }

    // Close sidebar when resizing to desktop
    window.addEventListener('resize', function () {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (window.innerWidth >= 768) {
            if (sidebar && sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
            }
            if (overlay && !overlay.classList.contains('hidden')) {
                overlay.classList.add('hidden');
            }
        }
    });
</script>