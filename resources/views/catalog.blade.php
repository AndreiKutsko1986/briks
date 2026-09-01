@extends('layouts.app')

@section('title', $currentCategory?->name ?? ($searchQuery ? "Search: $searchQuery" : 'Catalog'))

@section('content')
<div class="container catalog-page">
    <aside class="catalog-sidebar">
        <h3>Categories</h3>
        <ul class="category-list">
            <li><a href="{{ route('catalog') }}" class="{{ !request('category') ? 'active' : '' }}">All Items</a></li>
            @foreach($categories as $cat)
            <li>
                <a href="{{ route('catalog', ['category' => $cat->slug]) }}" class="{{ request('category') === $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </aside>

    <div class="catalog-main">
        <div class="catalog-header">
            <h1>@yield('title')</h1>
            <span class="result-count">{{ number_format($items->total()) }} items found</span>
        </div>

        @if($items->isEmpty())
            <div class="empty-state"><p>No items found.</p></div>
        @else
            <div class="item-grid">
                @foreach($items as $item)
                <a href="{{ route('items.show', $item) }}" class="item-card">
                    <div class="item-image">
                        @if($item->imageUrl())
                            <img src="{{ $item->imageUrl() }}" alt="{{ $item->name }}">
                        @else
                            <div class="placeholder-img">🧱</div>
                        @endif
                    </div>
                    <div class="item-info">
                        <span class="item-no">{{ $item->item_no }}</span>
                        <h3>{{ $item->name }}</h3>
                        <span class="item-category">{{ $item->category->name }}</span>
                        <div class="item-meta">
                            @if($item->min_price)
                                <span class="item-price">from ${{ number_format($item->min_price, 2) }}</span>
                            @endif
                            @if($item->listing_count)
                                <span class="listing-count">{{ $item->listing_count }} lots</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="pagination">{{ $items->links() }}</div>
        @endif
    </div>
</div>
@endsection
