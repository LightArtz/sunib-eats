<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Promotion;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil Data Statistik
        $stats = [
            'total_users' => User::count(),
            'total_restaurants' => Restaurant::count(),
            'total_reviews' => Review::count(),
            'active_promotions' => Promotion::whereDate('end_date', '>=', now())->count(),
        ];

        // Ambil 5 Review Terbaru beserta relasinya
        $recentReviews = Review::with(['user', 'restaurant'])
            ->latest()
            ->take(5)
            ->get();
        
        // CHART 1: MONTHLY USER GROWTH (Last 6 Months)
        // Query grouping by Year-Month
        $userGrowth = User::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        // Format data untuk Chart.js
        $chartUserLabels = $userGrowth->map(function($row) {
            return \Carbon\Carbon::createFromFormat('Y-m', $row->month)->format('M Y');
        });
        $chartUserData = $userGrowth->pluck('total');

        // CHART 2: TOP 5 CATEGORIES 
        $topCategories = Category::withCount('restaurants')
            ->orderByDesc('restaurants_count')
            ->take(5)
            ->get();

        $chartCategoryLabels = $topCategories->pluck('name');
        $chartCategoryData = $topCategories->pluck('restaurants_count');

        return view('admin.dashboard', compact(
            'stats', 
            'recentReviews',
            'chartUserLabels',
            'chartUserData',
            'chartCategoryLabels',
            'chartCategoryData'
        ));
    }
}
