@extends('layouts.login')

@section('input-id')
  <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
@endsection

@section('admin-user')
  <p class="mb-1">
    <a href="/admin/login">Login as admin</a>
  </p>
@endsection
