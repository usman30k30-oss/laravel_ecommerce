@extends('admin.layouts.admin')

@section('content')

<h1>Categories</h1>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
</tr>

@foreach($categories as $cat)
<tr>
<td>{{ $cat->id }}</td>
<td>{{ $cat->name }}</td>
</tr>
@endforeach

</table>

@endsection