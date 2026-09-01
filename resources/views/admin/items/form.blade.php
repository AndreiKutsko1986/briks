@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Item' : 'Add Item')

@section('content')
<div class="admin-page">
    <h1>{{ $item->exists ? 'Edit Item' : 'Add Item' }}</h1>
    <form class="admin-form" method="post" action="{{ $item->exists ? route('admin.items.update', $item) : route('admin.items.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="form-grid">
            <label>Item Number *<input type="text" name="item_no" required value="{{ old('item_no', $item->item_no) }}"></label>
            <label>Category *
                <select name="category_id" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $item->category_id) == $cat->id)>
                        {{ $cat->parent ? $cat->parent->name.' › ' : '' }}{{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </label>
            <label class="full-width">Name *<input type="text" name="name" required value="{{ old('name', $item->name) }}"></label>
            <label class="full-width">Description<textarea name="description" rows="4">{{ old('description', $item->description) }}</textarea></label>
            <label>Weight (g)<input type="number" step="0.01" name="weight_grams" value="{{ old('weight_grams', $item->weight_grams) }}"></label>
            <label>Stud Dimensions<input type="text" name="stud_dimensions" value="{{ old('stud_dimensions', $item->stud_dimensions) }}"></label>
            <label>Year From<input type="number" name="year_from" value="{{ old('year_from', $item->year_from) }}"></label>
            <label>Year To<input type="number" name="year_to" value="{{ old('year_to', $item->year_to) }}"></label>
            <label>Image<input type="file" name="image" accept="image/*"></label>
            <label class="checkbox-label"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true))> Active</label>
        </div>
        <fieldset class="color-fieldset">
            <legend>Available Colors</legend>
            <div class="color-checkboxes">
                @foreach($colors as $color)
                <label class="color-check">
                    <input type="checkbox" name="color_ids[]" value="{{ $color->id }}" @checked(in_array($color->id, old('color_ids', $selectedColors)))>
                    <span class="swatch" style="background:{{ $color->hex_code }}"></span>
                    {{ $color->name }}
                </label>
                @endforeach
            </div>
        </fieldset>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Item</button>
            <a href="{{ route('admin.items.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
