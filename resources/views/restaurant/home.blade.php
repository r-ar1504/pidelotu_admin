@extends('layouts.restaurant-app-header')

@section('section-title', $restaurant->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
@endsection

@section('content')
  <div id="index-header">
  <a href="/restaurant/{{$restaurant->id}}/add_category"><p> <span>+</span> Agregar Categoria</p></a>
  </div>
  <div class="list-container">

    @if(count($categories) > 0)
      @foreach($categories as $category)
          <div class="element-card">
            <img src="{{'/storage/restaurants/categories/'.$category->dashboard_banner }}" alt="restaurant-image">
            <a href="{{ '/res/'.$restaurant->id.'/cat/'.$category->id}}">
            <div class="card-overlay">
                <div class="overlay-button">
                  <p>{{$category->name}}</p>
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
