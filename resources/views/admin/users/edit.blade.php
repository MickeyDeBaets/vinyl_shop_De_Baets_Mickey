@extends('layouts.template')

@section('title', 'Edit user')

@section('main')
    <h1>Edit user: {{ $user->name }}</h1>
    <form action="/admin/users/{{ $user->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   required
                   value="{{ old('name', $user->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email"
                   minlength="3"
                   required
                   value="{{ old('email', $user->email) }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-check form-check-inline">
            <input type="hidden" name="active" value="0" />
            <input type="checkbox" class="form-check-input" id="active" name="active"
                   value="1" {{ (old('active',$user->active) == 1 ? 'checked' : '') }}>
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="hidden" name="admin" value="0" />
            <input type="checkbox" class="form-check-input" id="admin" name="admin"
                   value="1" {{ (old('admin', $user->admin) == 1 ? 'checked' : '') }}>
            <label class="form-check-label" for="admin">Admin</label>
        </div>
        <button type="submit" class="btn btn-success">Save user</button>
    </form>
@endsection
