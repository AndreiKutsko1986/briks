<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Listing;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'items' => Item::count(),
            'categories' => Category::count(),
            'listings' => Listing::active()->count(),
            'colors' => \App\Models\Color::count(),
        ];

        return view('home', [
            'categories' => Category::topLevel()->get(),
            'featured' => Item::active()->with('category')->withMin('activeListings as min_price', 'price')->latest()->take(8)->get(),
            'stats' => $stats,
        ]);
    }
}
