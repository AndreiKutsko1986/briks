@extends('layouts.admin')

@section('title', 'Listings')

@section('content')
<div class="admin-page">
    <h1>Manage Listings</h1>
    <form class="admin-form compact" method="post" action="{{ route('admin.listings.store') }}">
        @csrf
        <div class="form-grid">
            <label>Item *<select name="item_id" required>
                <option value="">Select item</option>
                @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->item_no }} - {{ $item->name }}</option>
                @endforeach
            </select></label>
            <label>Color<select name="color_id"><option value="">N/A</option>
                @foreach($colors as $color)<option value="{{ $color->id }}">{{ $color->name }}</option>@endforeach
            </select></label>
            <label>Seller<input type="text" name="seller_name" value="Store" required></label>
            <label>Condition<select name="condition_type"><option value="new">New</option><option value="used">Used</option></select></label>
            <label>Quantity<input type="number" name="quantity" value="1" min="1"></label>
            <label>Price<input type="number" step="0.01" name="price" required></label>
            <label>Country<input type="text" name="country" value="USA"></label>
            <label class="checkbox-label"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Listing</button>
    </form>

    <table class="admin-table">
        <thead><tr><th>Item</th><th>Color</th><th>Seller</th><th>Qty</th><th>Price</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($listings as $listing)
            <tr>
                <td>{{ $listing->item->item_no }}</td>
                <td>{{ $listing->color?->name ?? '—' }}</td>
                <td>{{ $listing->seller_name }}</td>
                <td>{{ $listing->quantity }}</td>
                <td>${{ number_format($listing->price, 2) }}</td>
                <td>
                    <form action="{{ route('admin.listings.destroy', $listing) }}" method="post" class="inline-form" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="link-btn danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
