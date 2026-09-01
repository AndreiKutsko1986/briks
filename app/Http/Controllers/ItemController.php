<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function show(Request $request, Item $item): View
    {
        $item->load(['category', 'colors']);

        $selectedColorId = (int) $request->get('color', $item->colors->first()?->id ?? 0);
        $condition = $request->get('condition');

        $listingsQuery = Listing::active()
            ->where('item_id', $item->id)
            ->with('color')
            ->orderBy('price');

        if ($selectedColorId) {
            $listingsQuery->where('color_id', $selectedColorId);
        }
        if (in_array($condition, ['new', 'used'], true)) {
            $listingsQuery->where('condition_type', $condition);
        }

        $listings = $listingsQuery->get();

        $priceGuide = Listing::active()
            ->where('item_id', $item->id)
            ->when($selectedColorId, fn ($q) => $q->where('color_id', $selectedColorId))
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price, AVG(price) as avg_price, SUM(quantity) as total_qty, COUNT(*) as seller_count')
            ->first();

        return view('item', compact('item', 'listings', 'priceGuide', 'selectedColorId', 'condition'));
    }
}
