@extends('admin.layouts.admin')

@section('content')
    
    <h1>Products Table</h1>
    
    <!-- <a href="/products/create" class="btn btn-primary mb-2">Add Product</a> -->
    <div class="d-flex justify-content-between mb-2">

        <a href="/products/create" class="btn btn-primary">Add Product</a>

        <button class="btn btn-dark" onclick="toggleFilter()">
            <i class="fas fa-filter"></i> Filter
        </button>

    </div>

    <div id="filterBox" class="card p-3 mb-3" style="display:none;">

      <form method="GET" action="/products" class="row">

        <!-- Search -->
        <div class="col-md-3 mb-2">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search">
        </div>

        <!-- Category -->
        <div class="col-md-3 mb-2">
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                <option value="1" {{ request('category')==1?'selected':'' }}>Category 1</option>
                <option value="2" {{ request('category')==2?'selected':'' }}>Category 2</option>
            </select>
        </div>

        <!-- Sort -->
        <div class="col-md-3 mb-2">
            <select name="sort" class="form-control">
                <option value="">Sort</option>
                <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Price Low → High</option>
                <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price High → Low</option>
                <option value="name" {{ request('sort')=='name'?'selected':'' }}>Name A → Z</option>
            </select>
        </div>

        <!-- Button -->
        <div class="col-md-3 mb-2">
            <button class="btn btn-success w-100">Apply Filters</button>
        </div>


     </form>
    </div>
    
    @if(request('search') || request('category') || request('sort'))

     <div class="mb-2">

        @if(request('search'))
            <span class="badge bg-primary">Search: {{ request('search') }}</span>
        @endif

        @if(request('category'))
            <span class="badge bg-info">Category: {{ request('category') }}</span>
        @endif

        @if(request('sort'))
            <span class="badge bg-success">Sort: {{ request('sort') }}</span>
        @endif

        <a href="/products" class="btn btn-sm btn-danger">Clear</a>

     </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success" id="msg-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="msg-error">
            {{ session('error') }}
        </div>
    @endif
    
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Category_id</th>
            <th>Name</th>
            <th>Image url</th>
            <th>Price</th>
        </tr>
        
        @if($products->count() > 0)
         @foreach($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category_id }}</td>
            <td>{{ $product->name }}</td>
            <td>
                <img src="{{ asset('uploads/products/'.$product->image) }}" width="50">
            </td>
            <td>{{ $product->price }}</td>
            <td>
                <a href="/products/edit/{{ $product->id }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="/products/delete/{{ $product->id }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                     Delete
                    </button>
                </form>
            </td>
          </tr>
         @endforeach
        
         @else
          <tr>
           <td colspan="6" class="text-center">No products found</td>
          </tr>
        @endif
    </table>
    
    <div class="mt-3">
        {{ $products->appends(request()->query())->links() }}
    </div>
@endsection


<script>
setTimeout(function () {
    var success = document.getElementById('msg-success');
    var error = document.getElementById('msg-error');

    if (success) success.style.display = 'none';
    if (error) error.style.display = 'none';

}, 5000);

function toggleFilter() {
    var box = document.getElementById('filterBox');
    box.style.display = (box.style.display === 'none') ? 'block' : 'none';
}
</script>
