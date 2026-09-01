<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Item::active()
            ->with('category')
            ->withMin('activeListings as min_price', 'price')
            ->search($request->get('q'));

        if ($slug = $request->get('category')) {
            $query->inCategorySlug($slug);
        }

        $items = $query->orderBy('name')->paginate(24);

        return response()->json([
            'items' => $items->map(fn ($item) => [
                'id' => $item->id,
                'item_no' => $item->item_no,
                'name' => $item->name,
                'category' => $item->category->name,
                'min_price' => $item->min_price ? (float) $item->min_price : null,
                'image' => $item->imageUrl(),
                'url' => route('items.show', $item),
            ]),
            'total' => $items->total(),
            'page' => $items->currentPage(),
            'pages' => $items->lastPage(),
        ]);
    }
}
