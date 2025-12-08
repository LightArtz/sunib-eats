@extends('layouts.admin')

@section('header')
    Dashboard
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dashboard Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users Card -->
    <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-600 mb-2">Total Users</p>
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_users']) }}</p>
            <!-- <p class="text-xs text-green-600 mt-2">↑ 12% from last month</p> -->
        </div>
        <div class="bg-indigo-100 rounded-lg p-3">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM15 20H9m6 0h6"></path>
            </svg>
        </div>
        </div>
    </div>

    <!-- Total Restaurants Card -->
    <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-600 mb-2">Total Restaurants</p>
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_restaurants']) }}</p>
            <!-- <p class="text-xs text-green-600 mt-2">↑ 5% from last month</p> -->
        </div>
        <div class="bg-violet-100 rounded-lg p-3">
            <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
        </div>
        </div>
    </div>

    <!-- Total Reviews Card -->
    <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-600 mb-2">Total Reviews</p>
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_reviews']) }}</p>
            <!-- <p class="text-xs text-green-600 mt-2">↑ 8% from last month</p> -->
        </div>
        <div class="bg-blue-100 rounded-lg p-3">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
        </div>
        </div>
    </div>

    <!-- Active Promotions Card -->
    <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-600 mb-2">Active Promotions</p>
            <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['active_promotions']) }}</p>
            <!-- <p class="text-xs text-amber-600 mt-2">→ No change from last month</p> -->
        </div>
        <div class="bg-amber-100 rounded-lg p-3">
            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        </div>
    </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-slate-900">Recent Reviews</h2>
        <a href="/admin/reviews" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View All</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
        <thead>
            <tr class="border-b border-slate-200">
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">User Name</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Restaurant</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Rating</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Date</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentReviews as $review)
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 text-sm text-slate-900 font-medium">
                        {{ $review->user->name }}
                    </td>
                    
                    <td class="px-4 py-3 text-sm text-slate-600">
                        {{ $review->restaurant->name }}
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center gap-1">
                            <span class="text-amber-400">★</span>
                            <span class="text-slate-600 text-xs font-bold">{{ $review->rating }}.0</span>
                        </div>
                    </td>
                    
                    <td class="px-4 py-3 text-sm text-slate-600">
                        {{ $review->created_at->diffForHumans() }}
                    </td>
                    
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Hapus review ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 text-xs font-medium">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-slate-500 text-sm">
                        Belum ada review terbaru.
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Monthly User Growth</h3>
            <div class="h-64">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Top Categories</h3>
            <div class="h-64">
                <canvas id="topCategoriesChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- Chart 1: User Growth (Line Chart) ---
            const ctx1 = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: @json($chartUserLabels), 
                    datasets: [{
                        label: 'New Users',
                        data: @json($chartUserData),
                        borderColor: '#6366f1', // Indigo color
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [2, 4] } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // --- Chart 2: Top Categories (Bar Chart) ---
            const ctx2 = document.getElementById('topCategoriesChart').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: @json($chartCategoryLabels),
                    datasets: [{
                        label: 'Total Restaurants',
                        data: @json($chartCategoryData),
                        backgroundColor: [
                            '#f59e0b', '#10b981', '#3b82f6', '#ef4444', '#8b5cf6'
                        ],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
@endsection