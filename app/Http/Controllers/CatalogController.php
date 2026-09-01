<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Item::active()
            ->with('category')
            ->withMin('activeListings as min_price', 'price')
            ->withCount('activeListings as listing_count')
            ->search($request->get('q'));

        if ($slug = $request->get('category')) {
            $query->inCategorySlug($slug);
        }

        $items = $query->orderBy('name')->paginate(24)->withQueryString();

        return view('catalog', [
            'items' => $items,
            'categories' => Category::topLevel()->get(),
            'currentCategory' => $request->get('category') ? Category::where('slug', $request->get('category'))->first() : null,
            'searchQuery' => $request->get('q', ''),
        ]);
    }
}
