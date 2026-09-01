<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::with('parent')->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($this->validated($request));
        return back()->with('success', 'Category created.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($this->validated($request));
        return back()->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'slug' => 'required|string|max:50|regex:/^[a-z0-9-]+$/',
            'name' => 'required|string|max:100',
            'parent_id' => 'nullable|exists:categories,id',
            'sort_order' => 'integer',
        ]);
    }
}
