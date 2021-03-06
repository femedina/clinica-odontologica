@extends('layouts.app1')
@section('sidebar')
<div class="bg-light border-right" id="sidebar-wrapper">
  <div class="sidebar-heading"> <h3 class="{{-- logo --}} text-center">{{ config('app.name', 'Laravel') }}</h3>  </div>
  <div class="list-group list-group-flush">
    <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action @yield('bg users link')"> @yield('users selected') Usuarios</a>
    <a href="{{ route('admin brands') }}" class="list-group-item list-group-item-action @yield('bg brands link')">@yield('brands selected') Marcas</a>
    <a href="{{ route('admin item types') }}" class="list-group-item list-group-item-action @yield('bg item types link')"> @yield('item types selected') Tipos de producto</a>
    <a href="{{ route('admin procedure types') }}" class="list-group-item list-group-item-action @yield('bg procedure types link')">@yield('procedure types selected') Tipos de procedimiento</a>
  </div>
</div>
@endsection
@section('toggle')
<button class="btn btn-secondary" id="menu-toggle">&#9776;</button>
@endsection