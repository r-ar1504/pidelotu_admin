@extends('layouts.restaurant-app-header')

@section('section-title')

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
<link rel="stylesheet" href="/css/restaurants/restaurants-orders.css">
@endsection

@section('content')
<div class="container">
<h2>Pedidos</h2>
<div class="text-right">
  <a href="#" data-toggle="modal" data-target="#exampleModal"><p> <span>+</span> Agregar Categoria</p></a>
</div>
<input class="form-control" id="myInput" type="text" placeholder="Busqueda">

<br>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody id="myTable">
    @foreach($ingredients as $ingredient)
    <tr>
      <td>{{$ingredient->name}}</td>
      <td>{{$ingredient->price}}</td>
      <td>
        <button type="button" class="btn btn-primary" name="button">Actualizar</button>
        <button type="button" class="btn btn-danger" name="button">Eliminar</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <label for="">Nombre</label>
          <input type="text" id="name" class="form-control" name="" value="">
          <label for="">Precio</label>
          <input type="text" id="price" class="form-control" name="" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary saveIngredient" data-id="{{$id}}">Guardar Ingrediente</button>
      </div>
    </div>
  </div>
</div>

</div>
@endsection

@section('javascript')
<script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/restaurant/restaurants-orders.js"></script>
<script type="text/javascript" src="/js/restaurant/ingredients.js"></script>
@endsection
