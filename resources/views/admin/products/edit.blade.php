@extends('admin.layouts.admin')

@section('content')

<h1>Edit Product</h1>

<div class="mb-2">
    <input type="text" name="name"
           value="{{ old('name', $product->name) }}"
           class="form-control @error('name') is-invalid @enderror">

    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-2">
    <input type="text" name="price"
           value="{{ old('price', $product->price) }}"
           class="form-control @error('price') is-invalid @enderror">

    @error('price')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-2">
    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
</div>

<div class="mb-2">
    <img src="{{ asset('uploads/products/'.$product->image) }}" width="80" class="mb-2">
    <input type="file" name="image" class="form-control">
</div>

<div class="mb-2">
    <input type="number" name="category_id"
           value="{{ old('category_id', $product->category_id) }}"
           class="form-control">
</div>

<button class="btn btn-success">Update</button>

</form>
@endsection