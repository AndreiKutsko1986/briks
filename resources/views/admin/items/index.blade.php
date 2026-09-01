@extends('layouts.admin')

@section('title', 'Items')

@section('content')
<div class="admin-page">
    <div class="section-header">
        <h1>Items</h1>
        <a href="{{ route('admin.items.create') }}" class="btn btn-primary">Add Item</a>
    </div>
    <table class="admin-table">
        <thead><tr><th>ID</th><th>Item No</th><th>Name</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->item_no }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->is_active ? 'Active' : 'Inactive' }}</td>
                <td class="actions">
                    <a href="{{ route('admin.items.edit', $item) }}">Edit</a>
                    <form action="{{ route('admin.items.destroy', $item) }}" method="post" class="inline-form" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="link-btn danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
</div>
@endsection
