@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="admin-page">
    <h1>Categories</h1>
    <form class="admin-form compact" method="post" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-grid">
            <label>Slug *<input type="text" name="slug" required pattern="[a-z0-9-]+"></label>
            <label>Name *<input type="text" name="name" required></label>
            <label>Parent
                <select name="parent_id">
                    <option value="">None</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>Sort Order<input type="number" name="sort_order" value="0"></label>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>

    <table class="admin-table">
        <thead><tr><th>ID</th><th>Slug</th><th>Name</th><th>Parent</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->slug }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->parent?->name ?? '—' }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="post" class="inline-form" onsubmit="return confirm('Delete?')">
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
