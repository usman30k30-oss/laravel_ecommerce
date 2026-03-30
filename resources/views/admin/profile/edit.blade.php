@extends('admin.layouts.admin')

@section('content')

<h2 class="mb-3">My Profile</h2>

@if(session('success'))
<div class="alert alert-success" id="msg-success">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
@csrf
@method('PATCH')

<!-- Name -->
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Email -->
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Current Image -->
<div class="mb-3">
    <label>Current Image</label><br>
    <img src="{{ asset('uploads/users/'.($user->image ?? 'default.png')) }}"
         width="80" style="border-radius:50%;">
</div>

<!-- Upload -->
<div class="mb-3">
    <label>Change Image</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary">Update Profile</button>

</form>

@endsection

<script>
setTimeout(function () {
    var msg = document.getElementById('msg-success');
    if (msg) msg.style.display = 'none';
}, 3000);
</script>