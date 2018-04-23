@extends('layouts.admin-app-header')

@section('section-title', 'restaurant')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
@endsection

@section('content')
  <div id="index-header">
  <a href="add_restaurant"><p> <span>+</span> Agregar Restaurante</p></a>
  </div>
  <div class="list-container">

    @if(count($restaurants) > 1)
      @foreach($restaurants as $restaurant)
          <div class="element-card">
            <img src="{{'/storage/'.$restaurant->logo }}" alt="restaurant-image">
            <div class="card-overlay">
              <p>{{ $restaurant->name }}</p>
              <div class="overlay-button">
                <a href="{{ '/restaurant/home/'.$restaurant->id }}">Ver Mas</a>
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
