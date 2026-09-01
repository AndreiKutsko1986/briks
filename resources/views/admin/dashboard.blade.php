@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-page">
    <h1>Dashboard</h1>
    <div class="admin-stats">
        @foreach($stats as $label => $value)
        <div class="admin-stat-card">
            <span class="stat-label">{{ ucfirst($label) }}</span>
            <span class="stat-value">{{ $value }}</span>
        </div>
        @endforeach
    </div>

    <div class="admin-section">
        <div class="section-header">
            <h2>Recent Items</h2>
            <a href="{{ route('admin.items.create') }}" class="btn btn-primary">Add Item</a>
        </div>
        <table class="admin-table">
            <thead><tr><th>Item No</th><th>Name</th><th>Category</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($recentItems as $item)
                <tr>
                    <td>{{ $item->item_no }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.items.edit', $item) }}">Edit</a>
                        <a href="{{ route('items.show', $item) }}" target="_blank">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
