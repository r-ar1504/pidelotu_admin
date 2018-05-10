@extends('layouts.restaurant-app-header')

@section('section-title')

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
@endsection

@section('content')
  <div id="index-header">
    <a href="/restaurant/add-meal/{{$id}}" ><p> <span>+</span> Agregar Comida</p></a>
  </div>


  <div class="list-container">
    @if(count($meals) > 0)
      @foreach($meals as $meal)
          <div class="element-card">
            <img src="{{'/images/restaurants/categories/'.$meal->image }}" alt="restaurant-image">
            <a href="/restaurant/ingredients/{{$meal->id}}">
            <div class="card-overlay">
              <div class="overlay-button">
                <p>{{$meal->id}}</p>
              </div>
            </div>

          </a>
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
<script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
@endsection
