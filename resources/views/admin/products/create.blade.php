@extends('admin.layouts.admin')

@section('content')

<h1>Add Product</h1>

{{-- Errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/products/store" enctype="multipart/form-data">
@csrf

<div class="mb-2">
    <input type="text" name="name"
           value="{{ old('name') }}"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="Product Name">

    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-2">
    <input type="text" name="price"
        value="{{ old('price') }}"
        class="form-control @error('price') is-invalid @enderror"
        placeholder="Product Price"
    >

    @error('price')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-2">
    <textarea name="description" class="form-control" placeholder="Product Description">{{ old('description') }}</textarea>
</div>

<div class="mb-2">
    <input type="file" name="image" class="form-control">
</div>

<div class="mb-2">
    <input type="number" name="category_id"
        value="{{ old('category_id') }}"
        class="form-control"
        placeholder="Category Id"
    >
</div>

<button class="btn btn-success">Save</button>

</form>

@endsection