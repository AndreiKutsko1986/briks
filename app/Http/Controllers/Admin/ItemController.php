<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        return view('admin.items.index', [
            'items' => Item::with('category')->latest('updated_at')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.items.form', [
            'item' => new Item(),
            'categories' => Category::with('parent')->orderBy('sort_order')->get(),
            'colors' => Color::orderBy('sort_order')->get(),
            'selectedColors' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $item = Item::create($data);

        if ($request->hasFile('image')) {
            $item->update(['image_path' => $request->file('image')->store('items', 'public')]);
        }

        $item->colors()->sync($request->input('color_ids', []));

        return redirect()->route('admin.items.index')->with('success', 'Item created.');
    }

    public function edit(Item $item): View
    {
        return view('admin.items.form', [
            'item' => $item,
            'categories' => Category::with('parent')->orderBy('sort_order')->get(),
            'colors' => Color::orderBy('sort_order')->get(),
            'selectedColors' => $item->colors()->pluck('colors.id')->toArray(),
        ]);
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        $data = $this->validated($request);
        $item->update($data);

        if ($request->hasFile('image')) {
            $item->update(['image_path' => $request->file('image')->store('items', 'public')]);
        }

        $item->colors()->sync($request->input('color_ids', []));

        return redirect()->route('admin.items.index')->with('success', 'Item updated.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'item_no' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weight_grams' => 'nullable|numeric',
            'stud_dimensions' => 'nullable|string|max:50',
            'year_from' => 'nullable|integer',
            'year_to' => 'nullable|integer',
            'is_active' => 'boolean',
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }
}
