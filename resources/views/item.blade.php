@extends('layouts.app')

@section('title', $item->name)

@section('content')
<div class="container item-page">
    <div class="item-header">
        <div class="item-gallery">
            @if($item->imageUrl())
                <img src="{{ $item->imageUrl() }}" alt="{{ $item->name }}" class="main-image">
            @else
                <div class="placeholder-img large">🧱</div>
            @endif
        </div>
        <div class="item-details">
            <nav class="item-breadcrumb">Catalog: {{ $item->category->name }}: {{ $item->item_no }}</nav>
            <h1>{{ $item->name }}</h1>
            <p class="item-number">Item No: <strong>{{ $item->item_no }}</strong></p>
            @if($item->description)<p class="item-description">{{ $item->description }}</p>@endif

            <div class="item-specs">
                @if($item->year_from)
                <div class="spec"><label>Years Released</label><span>{{ $item->year_from }} – {{ $item->year_to ?? date('Y') }}</span></div>
                @endif
                @if($item->weight_grams)
                <div class="spec"><label>Weight</label><span>{{ $item->weight_grams }}g</span></div>
                @endif
                @if($item->stud_dimensions)
                <div class="spec"><label>Stud Dimensions</label><span>{{ $item->stud_dimensions }}</span></div>
                @endif
            </div>

            @if($item->colors->isNotEmpty())
            <div class="color-selector">
                <label>Select Color</label>
                <div class="color-swatches">
                    @foreach($item->colors as $color)
                    <a href="{{ route('items.show', ['item' => $item, 'color' => $color->id, 'condition' => $condition]) }}"
                       class="color-swatch {{ $selectedColorId === $color->id ? 'active' : '' }}"
                       style="background-color: {{ $color->hex_code ?? '#ccc' }}"
                       title="{{ $color->name }}"></a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($priceGuide?->min_price)
            <div class="price-guide-box">
                <h3>Price Guide</h3>
                <div class="price-stats">
                    <div><label>Min</label><span>${{ number_format($priceGuide->min_price, 2) }}</span></div>
                    <div><label>Avg</label><span>${{ number_format($priceGuide->avg_price, 2) }}</span></div>
                    <div><label>Max</label><span>${{ number_format($priceGuide->max_price, 2) }}</span></div>
                    <div><label>Qty</label><span>{{ number_format($priceGuide->total_qty) }}</span></div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <section class="listings-section">
        <div class="listings-header">
            <h2>Lots For Sale</h2>
            <div class="listings-filters">
                <a href="{{ route('items.show', ['item' => $item, 'color' => $selectedColorId]) }}" class="filter-btn {{ !$condition ? 'active' : '' }}">All</a>
                <a href="{{ route('items.show', ['item' => $item, 'color' => $selectedColorId, 'condition' => 'new']) }}" class="filter-btn {{ $condition === 'new' ? 'active' : '' }}">New</a>
                <a href="{{ route('items.show', ['item' => $item, 'color' => $selectedColorId, 'condition' => 'used']) }}" class="filter-btn {{ $condition === 'used' ? 'active' : '' }}">Used</a>
            </div>
        </div>

        @if($listings->isEmpty())
            <div class="empty-state"><p>No listings available.</p></div>
        @else
            <table class="listings-table">
                <thead>
                    <tr><th>Seller</th><th>Color</th><th>Condition</th><th>Qty</th><th>Country</th><th>Price</th></tr>
                </thead>
                <tbody>
                    @foreach($listings as $listing)
                    <tr>
                        <td>{{ $listing->seller_name }}</td>
                        <td>{{ $listing->color?->name ?? '—' }}</td>
                        <td><span class="badge badge-{{ $listing->condition_type }}">{{ ucfirst($listing->condition_type) }}</span></td>
                        <td>{{ $listing->quantity }}</td>
                        <td>{{ $listing->country }}</td>
                        <td class="price-cell">${{ number_format($listing->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</div>
@endsection
