<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-[#5f6b73]">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50 font-sans text-gray-900 overflow-hidden">
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 bg-gray-900/50 backdrop-blur-sm lg:hidden"
            @click="sidebarOpen = false" style="display: none;"></div>

        <!-- 1. Sidebar -->
        <!-- Mobile hidden, Tablet mini (md:w-20), Desktop full (lg:w-64) -->
        <aside :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full w-64 md:w-20 md:translate-x-0 lg:w-64'"
            class="fixed inset-y-0 left-0 z-30 flex flex-col transition-all duration-300 transform bg-white border-r border-gray-100 shadow-sm md:relative block">

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-100 px-4">
                <span class="text-xl font-bold text-indigo-600 truncate transition-opacity duration-300"
                    :class="sidebarOpen ? 'block' : 'hidden lg:block'">AdminPanel</span>
                <!-- Icon for mini sidebar -->
                <svg :class="sidebarOpen ? 'hidden' : 'hidden md:block lg:hidden'" class="w-8 h-8 text-indigo-600"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
                <!-- Active: Dashboard -->
                <a href="#"
                    class="flex items-center px-3 py-3 text-indigo-700 bg-indigo-50 rounded-lg group transition-colors"
                    :class="sidebarOpen ? 'justify-start' : 'justify-center lg:justify-start'">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3 font-medium transition-all duration-300"
                        :class="sidebarOpen ? 'block' : 'hidden lg:block'">Dashboard</span>
                </a>
            </nav>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50">

            <!-- 2. Header -->
            <header
                class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-100 shadow-sm z-10 w-full shrink-0 h-16">
                <div class="flex items-center">
                    <!-- Mobile menu toggle button (hamburger icon) -->
                    <button @click="sidebarOpen = true"
                        class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden mr-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 tracking-tight">Dashboard</h1>
                </div>

                <!-- User profile section -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="hidden md:block text-sm font-medium text-gray-700">Admin</span>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') ?? '#' }}" class="mt-0">
                        @csrf
                        <button type="submit"
                            class="flex items-center text-gray-500 hover:text-red-500 transition-colors bg-gray-50 hover:bg-red-50 p-2 rounded-full"
                            title="Logout">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- 3. Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 scroll-smooth">

                <div class="max-w-7xl mx-auto space-y-8">

                    <!-- A. Statistics Cards Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- 1. Total Users Card -->
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center hover:shadow-md transition-shadow">
                            <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600 mr-4">
                                <!-- Users icon -->
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Users</p>
                                <!-- Dynamic value: $usersTotal -->
                                <p class="text-2xl font-bold text-gray-800">{{ $usersTotal }}</p>
                            </div>
                        </div>

                        <!-- 2. Active Users Card -->
                        <div
                            class="bg-green-50 rounded-xl shadow-sm border border-green-100 p-5 flex items-center hover:shadow-md transition-shadow">
                            <div class="p-3 rounded-xl bg-green-100 text-green-600 mr-4">
                                <!-- CheckCircle icon -->
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-green-800 font-medium">Active Users</p>
                                <!-- Dynamic value: $usersActif -->
                                <p class="text-2xl font-bold text-green-900">{{ $usersActif }}</p>
                            </div>
                        </div>

                        <!-- 3. Banned Users Card -->
                        <div
                            class="bg-red-50 rounded-xl shadow-sm border border-red-100 p-5 flex items-center hover:shadow-md transition-shadow">
                            <div class="p-3 rounded-xl bg-red-100 text-red-600 mr-4">
                                <!-- Ban icon -->
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-red-800 font-medium">Banned Users</p>
                                <!-- Dynamic value: $usersBanned -->
                                <p class="text-2xl font-bold text-red-900">{{ $usersBanned }}</p>
                            </div>
                        </div>

                        <!-- 4. Total Colocations Card -->
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center hover:shadow-md transition-shadow">
                            <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600 mr-4">
                                <!-- Home icon -->
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Colocations</p>
                                <!-- Dynamic value: $colocsTotal -->
                                <p class="text-2xl font-bold text-gray-800">{{ $colocsTotal }}</p>
                            </div>
                        </div>

                        <!-- 5. Active Colocations Card -->
                        <div
                            class="bg-green-50 rounded-xl shadow-sm border border-green-100 p-5 flex items-center hover:shadow-md transition-shadow">
                            <div class="p-3 rounded-xl bg-green-100 text-green-600 mr-4">
                                <!-- CheckCircle icon -->
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-green-800 font-medium">Active Colocations</p>
                                <!-- Dynamic value: $colocsActif -->
                                <p class="text-2xl font-bold text-green-900">{{ $colocsActif }}</p>
                            </div>
                        </div>

                        <!-- 6. Inactive Colocations Card -->
                        <div
                            class="bg-gray-100 rounded-xl shadow-sm border border-gray-200 p-5 flex items-center hover:shadow-md transition-shadow">
                            <div class="p-3 rounded-xl bg-gray-200 text-gray-600 mr-4">
                                <!-- XCircle icon -->
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Inactive Colocations</p>
                                <!-- Dynamic value: $colocsInactif -->
                                <p class="text-2xl font-bold text-gray-800">{{ $colocsInactif }}</p>
                            </div>
                        </div>

                    </div>

                    <!-- B. Users Tables Section -->
                    <div class="flex flex-col lg:flex-row gap-6 w-full">

                        <!-- Left Table: Recent Users -->
                        <div
                            class="w-full lg:w-1/2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                            <div
                                class="p-5 border-b border-gray-100 flex justify-between items-center bg-white flex-wrap gap-4">
                                <h2 class="text-lg font-bold text-gray-800">Recent Users</h2>
                            </div>

                            <div class="overflow-x-auto flex-1 h-full">
                                @if ($recentUsers->isEmpty())
                                    <div
                                        class="p-8 text-center text-gray-500 flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="text-sm font-medium">No recent users found.</p>
                                    </div>
                                @else
                                    <table class="w-full text-left border-collapse whitespace-nowrap">
                                        <thead>
                                            <tr
                                                class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-100">
                                                <th class="p-4">User</th>
                                                <th class="p-4">Status</th>
                                                <th class="p-4">Joined</th>
                                                <th class="p-4 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <!-- Loop through $recentUsers -->
                                            @foreach ($recentUsers as $user)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="p-4 flex items-center space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <!-- Avatar Placeholder -->
                                                            <svg class="w-9 h-9 text-gray-400 bg-gray-100 rounded-full p-1"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-semibold text-gray-800">
                                                                {{ $user->name }}</p>
                                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="p-4">
                                                        @if ($user->status === 'actif')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                                <span
                                                                    class="w-1.5 h-1.5 bg-green-600 rounded-full mr-1.5"></span>
                                                                actif
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                                <span
                                                                    class="w-1.5 h-1.5 bg-red-600 rounded-full mr-1.5"></span>
                                                                banned
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="p-4 text-sm text-gray-600">
                                                        {{ $user->created_at->format('M d, Y') }}
                                                    </td>
                                                    <td class="p-4 text-center">
                                                        <form action="{{ route('admin.users.ban', $user) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors focus:outline-none border border-transparent hover:border-red-100"
                                                                title="Ban User"
                                                                onclick="return confirm('Are you sure you want to ban this user?')">
                                                                <!-- Ban icon -->
                                                                <svg class="w-5 h-5 mx-auto" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>

                        <!-- Right Table: Banned Users -->
                        <div
                            class="w-full lg:w-1/2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                            <div
                                class="p-5 border-b border-gray-100 flex justify-between items-center bg-white flex-wrap gap-4">
                                <h2 class="text-lg font-bold text-gray-800 flex items-center">
                                    Banned Users
                                    <span
                                        class="ml-2 bg-red-100 text-red-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $usersBanned }}</span>
                                </h2>
                            </div>

                            <div class="overflow-x-auto flex-1 h-full">
                                @if ($bannedUsers->isEmpty())
                                    <div
                                        class="p-8 text-center text-gray-500 flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <p class="text-sm font-medium">No banned users found.</p>
                                    </div>
                                @else
                                    <table class="w-full text-left border-collapse whitespace-nowrap">
                                        <thead>
                                            <tr
                                                class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-100">
                                                <th class="p-4">User</th>
                                                <th class="p-4">Banned On</th>
                                                <th class="p-4 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <!-- Loop through $bannedUsers -->
                                            @foreach ($bannedUsers as $user)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="p-4 flex items-center space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <!-- Avatar Placeholder -->
                                                            <svg class="w-9 h-9 text-gray-400 bg-gray-100 rounded-full p-1 border-2 border-red-50"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-semibold text-gray-800">
                                                                {{ $user->name }}</p>
                                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="p-4 text-sm text-gray-600">
                                                        {{ $user->updated_at->format('M d, Y') }}
                                                    </td>
                                                    <td class="p-4 text-center">
                                                        @if ($user->id !== 1)
                                                            <form method="POST"
                                                                action="{{ route('admin.users.unban', $user) }}"
                                                                class="inline-block m-0">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="p-1.5 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors focus:outline-none border border-transparent hover:border-green-100"
                                                                    title="Unban user">
                                                                    <!-- Unlock icon -->
                                                                    <svg class="w-5 h-5 mx-auto" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500">
                                                                Protected
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </main>
        </div>
    </div>
</body>
