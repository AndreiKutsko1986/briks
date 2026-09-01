@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero">
    <div class="container">
        <h1>Find LEGO Parts, Sets &amp; Minifigures</h1>
        <p>Browse the catalog, compare prices, and find items from sellers worldwide.</p>
        <form class="hero-search" action="{{ route('catalog') }}" method="get">
            <input type="search" name="q" placeholder="Search by item number or name...">
            <button type="submit" class="btn btn-primary">Search Catalog</button>
        </form>
    </div>
</div>

<div class="container">
    <section class="stats-bar">
        @foreach($stats as $label => $value)
        <div class="stat"><strong>{{ number_format($value) }}</strong> {{ ucfirst($label) }}</div>
        @endforeach
    </section>

    <section class="category-cards">
        <h2>Browse by Category</h2>
        <div class="card-grid">
            @foreach($categories as $cat)
            <a href="{{ route('catalog', ['category' => $cat->slug]) }}" class="category-card">
                <h3>{{ $cat->name }}</h3>
                <span class="card-link">Browse →</span>
            </a>
            @endforeach
        </div>
    </section>

    <section class="featured-items">
        <h2>Featured Items</h2>
        <div class="item-grid">
            @foreach($featured as $item)
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
                    @if($item->min_price)
                        <span class="item-price">from ${{ number_format($item->min_price, 2) }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
