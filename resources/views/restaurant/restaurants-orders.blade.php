@extends('layouts.restaurant-app-header')

@section('section-title')

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="/css/restaurants/restaurants-orders.css">
@endsection

@section('content')
<div class="container">
<h2>Pedidos</h2>
<input class="form-control" id="myInput" type="text" placeholder="Busqueda">
<br>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody id="myTable">
    <tr>
      <td>Anja</td>
      <td>Ravendale</td>
      <td>a_r@test.com</td>
      <td>
        <button type="button" class="btn btn-danger" name="button">Eliminar</button>
      </td>
    </tr>
  </tbody>
</table>

</div>
@endsection

@section('javascript')
<script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/restaurant/restaurants-orders.js"></script>
@endsection
