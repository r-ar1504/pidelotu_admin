@extends('layouts.admin-restaurant-app-header')

@section('section-title', $name[0]->name)

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12" align="center">
      <p style="font-size: 2rem;">Comidas</p>
    </div>
  </div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      @if(count($meals) > 0)
      @foreach($meals as $meal)
      <div class="element-card">
        <img src="{{'/images/meals/'.$meal->image }}" alt="restaurant-image">
        <a href="/administrador/restaurante/ingredientes/{{$meal->id}}">
          <div class="card-overlay">
            <div class="overlay-button">
              <p>{{$meal->name}}</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      @else
      <div class="no-content" align="center">
        <p>No existen elementos en esta comida</p>
      </div>
      @endif
    </div>
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
