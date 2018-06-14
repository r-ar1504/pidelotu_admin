@extends('layouts.restaurant-app-header')

@section('section-title', $categorie[0]->name)

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
@endsection

@section('content')
<div class="row">
  <div class="col-md-6" align="center">
    <p style="color: black; font-size: 2rem;">Comidas</p>
  </div>
  <div id="index-header" class="col-md-6">
    <a href="/restaurante/add-meal/{{$id}}"><p> <span>+</span> Agregar Comida</p></a>
  </div>
</div>


<div class="list-container">
  <div class="row">
    @if(count($meals) > 0)
    @foreach($meals as $meal)
    @if($meal->active ==1)
    <div class="element-card">
      <img src="{{'/images/meals/'.$meal->image }}" alt="restaurant-image">
      <a href="/restaurante/ingredientes/{{$meal->id}}">
        <div class="card-overlay">
          <div class="overlay-button">
            <p>{{$meal->name}}</p>
            <div align="cetner">
              <button class="btn btn-info">Actualizar</button>
              <button class="btn btn-danger">Eliminar</button>
            </div>
          </div>
        </div>
      </a>
    </div>
    @endif
    @endforeach
    @else
    <div class="no-content">
      <p>No existen elementos en esta categoria</p>
    </div>
    @endif
  </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
<script>
  $(function(){
    $("#restaurantActive").addClass('active');
  });
</script>
@endsection
