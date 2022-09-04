@extends('layouts.login')

@section('input-id')
  <input type="text" class="form-control" placeholder="Id" name="admin_id" value="{{ old('admin_id') }}">
@endsection

@section('admin-user')
  <p class="mb-1">
    <a href="/user/login">Login as user</a>
  </p>
@endsection
