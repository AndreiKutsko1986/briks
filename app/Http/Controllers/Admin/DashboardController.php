<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\Listing;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'items' => Item::count(),
                'categories' => Category::count(),
                'listings' => Listing::active()->count(),
                'colors' => Color::count(),
            ],
            'recentItems' => Item::with('category')->latest('updated_at')->take(5)->get(),
        ]);
    }
}
