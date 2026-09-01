<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Item;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListingController extends Controller
{
    public function index(): View
    {
        return view('admin.listings.index', [
            'listings' => Listing::with(['item', 'color'])->latest()->take(100)->get(),
            'items' => Item::orderBy('name')->get(),
            'colors' => Color::orderBy('sort_order')->get(),
            'editing' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Listing::create($this->validated($request) + ['is_active' => $request->boolean('is_active', true)]);
        return back()->with('success', 'Listing created.');
    }

    public function update(Request $request, Listing $listing): RedirectResponse
    {
        $listing->update($this->validated($request) + ['is_active' => $request->boolean('is_active', true)]);
        return back()->with('success', 'Listing updated.');
    }

    public function destroy(Listing $listing): RedirectResponse
    {
        $listing->delete();
        return back()->with('success', 'Listing deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'item_id' => 'required|exists:items,id',
            'color_id' => 'nullable|exists:colors,id',
            'seller_name' => 'required|string|max:100',
            'condition_type' => 'required|in:new,used',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'currency' => 'string|size:3',
            'country' => 'string|max:80',
        ]);
    }
}
