@extends('layouts.admin')

@section('menu')
  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fa-solid fa-folder-open"></i>
      <p>
        Data
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-circle nav-icon"></i>
          <p>Table</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Create</p>
        </a>
      </li>
    </ul>
  </li>
@endsection
