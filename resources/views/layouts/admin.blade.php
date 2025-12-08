<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunib Eats - Admin Dashboard</title>
    <script defer src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --color-primary: #6366f1;
            --color-primary-dark: #4f46e5;
            --color-sidebar: #0f172a;
            --color-bg: #f8fafc;
            --color-border: #e2e8f0;
        }

        /* Smooth transition for sidebar */
        @media (max-width: 768px) {
            [x-cloak] {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-slate-50" x-data="{ sidebarOpen: false, profileOpen: false }">
    <div class="flex h-screen bg-slate-50">
        <!-- Sidebar -->
        <aside 
            class="fixed md:static left-0 top-0 h-full w-64 bg-slate-900 text-white transition-transform duration-300 ease-out z-40"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        >
            <!-- Logo -->
            <div class="px-6 py-8 border-b border-slate-700">
                <h1 class="text-2xl font-bold text-white">Sunib Eats</h1>
                <p class="text-sm text-slate-400 mt-1">Admin Panel</p>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-8 space-y-2">
                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}" 
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors
                   {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Users Link -->
                <a href="{{ route('admin.users.index') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                   {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m4 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Users</span>
                </a>

                <!-- Restaurants Link -->
                <a href="{{ route('admin.restaurants.index') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                   {{ request()->routeIs('admin.restaurants.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    <span>Restaurants</span>
                </a>

                <!-- Categories Link -->
                <a href="{{ route('admin.categories.index') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                   {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.5a2 2 0 00-1 .276M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 01-4 4z"></path>
                    </svg>
                    <span>Categories</span>
                </a>

                <!-- Promotions Link -->
                <a href="{{ route('admin.promotions.index') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                   {{ request()->routeIs('admin.promotions.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Promotions</span>
                </a>

                <!-- Reviews Link -->
                <a href="{{ route('admin.reviews.index') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                   {{ request()->routeIs('admin.reviews.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span>Reviews</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-4 py-6 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button 
                        @click="sidebarOpen = false"
                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Sidebar Overlay -->
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition
        ></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="sticky top-0 bg-white border-b border-slate-200 z-20">
                <div class="px-4 md:px-8 py-4 flex items-center justify-between">
                    <!-- Left: Hamburger Menu (Mobile Only) -->
                    <button 
                        @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden p-2 hover:bg-slate-100 rounded-lg transition-colors"
                    >
                        <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Center: Page Title (Optional - Can be customized per page) -->
                    <h1 class="hidden sm:block text-xl font-semibold text-slate-900">Dashboard</h1>

                    <!-- Right: User Profile Dropdown -->
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button 
                            @click="profileOpen = !profileOpen"
                            class="flex items-center gap-3 px-3 py-2 hover:bg-slate-100 rounded-lg transition-colors"
                        >
                            <!-- Avatar -->
                            <img 
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff" 
                                alt="Admin Avatar" 
                                class="w-8 h-8 rounded-full"
                            >
                            <!-- Name (Hidden on mobile) -->
                            <span class="hidden sm:block text-sm font-medium text-slate-900">{{ Auth::user()->name }}</span>
                            <!-- Dropdown Icon -->
                            <svg 
                                class="w-4 h-4 text-slate-600 transition-transform"
                                :class="profileOpen ? 'rotate-180' : ''"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div 
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200"
                            x-show="profileOpen"
                            @click.outside="profileOpen = false"
                            x-transition
                        >
                            <!-- Profile Option -->
                            <a href="#" class="block px-4 py-2 text-sm text-slate-900 hover:bg-slate-50 rounded-t-lg transition-colors border-b border-slate-200">
                                Profile Settings
                            </a>
                            <!-- Password Option -->
                            <a href="#" class="block px-4 py-2 text-sm text-slate-900 hover:bg-slate-50 transition-colors border-b border-slate-200">
                                Change Password
                            </a>
                            <!-- Logout Option -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button 
                                    @click="profileOpen = false"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg transition-colors font-medium"
                                >
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-auto">
                <div class="px-4 md:px-8 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
