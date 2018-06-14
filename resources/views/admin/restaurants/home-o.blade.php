@extends('layouts.admin-restaurant-app-header')

@section('section-title', $restaurant->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
@endsection

@section('content')
  <div id="index-header">
    <a href="/restaurante/{{$restaurant->id}}/agregar-categoria"><p> <span>+</span> Agregar Categoria</p></a>
  </div>
  <div class="list-container">

    @if(count($categories) > 0)
      @foreach($categories as $category)
        <div class="row">
          <div class="element-card col-md-4">
            <img src="{{'/images/restaurants/categories/'.$category->dashboard_banner }}" alt="restaurant-image">
            <a href="/restaurante/comidas/2">
              <div class="card-overlay">
                <div class="overlay-button">
                  <p>{{$category->name}}</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      @endforeach

    @else
      <div class="no-content">
        <p>No existen platillos en este restaurante</p>
      </div>
    @endif

  </div>
@endsection

@section('javascript')
<script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
<script src="/js/restaurant/home.js"></script>
@endsection
