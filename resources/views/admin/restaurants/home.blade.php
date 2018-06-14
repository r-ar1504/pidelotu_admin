@extends('layouts.admin-app-header')

@section('section-title', 'Restaurantes Registrados')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main2.css') }}">
@endsection

@section('content')
  <div id="index-header">
  <a href="add_restaurant"><p> <span>+</span> Agregar Restaurante</p></a>
  </div>
  <div class="list-container">

    @if(count($restaurants) > 0)
      @foreach($restaurants as $restaurant)
          <div class="element-card">
            <!--<img src="/images/error.png" class="deleteRestaurant" data-id="{{$restaurant->id}}" alt="">-->
            <img src="{{'/images/logos/'.$restaurant->logo }}" alt="restaurant-image">
            <div class="card-overlay">
              <p>{{ $restaurant->name }}</p>
              <div class="overlay-button">
                <a href="{{ '/administrador/modificar-restaurante/'.$restaurant->id }}">Actualizar</a>
              </div>
              <div class="overlay-button">
                <a data-id="{{$restaurant->id}}" class="delete">Eliminar</a>
              </div>
              <div class="overlay-button">
                <a href="{{ '/administrador/restaurante/'.$restaurant->id }}">Ver Mas</a>
              </div>
            </div>
          </div>
      @endforeach
    @else
      <div class="no-content">
        <p>No existen elementos en esta categoria</p>
      </div>
    @endif
  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/js/admin/restaurants/home.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@stop
