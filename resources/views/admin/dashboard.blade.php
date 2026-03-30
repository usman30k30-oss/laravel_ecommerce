@extends('admin.layouts.admin')

@section('content')

<h2 class="mb-3">Dashboard</h2>

<!-- Stats Cards -->
<div class="row">

    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            <h5>Total Products</h5>
            <h2>{{ $totalProducts }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            <h5>Total Categories</h5>
            <h2>{{ $totalCategories }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-dark text-white p-3">
            <h5>Total Users</h5>
            <h2>{{ $totalUsers }}</h2>
        </div>
    </div>

</div>

<!-- Quick Actions -->
<div class="mt-3 mb-3">
    <a href="/products/create" class="btn btn-primary">Add Product</a>
    <a href="/categories" class="btn btn-success">View Categories</a>
</div>

@endsection