@extends('layouts.restaurant-app-header')
@section('section-title')

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="/libs/animateCss/animate.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/form.css') }}">
@endsection

@section('section-title', 'restaurantes')

@section('content')
  <div id="form-holder">

    {!! Form::open(['id' => 'categoryForm', 'files' => true]) !!}
    {{ Form::hidden('id', $id) }}

    <div id="photo-field">
      <img src="{{ asset('images/bg-cat.png')}}" alt="category-photo" id="category-photo">

      <div id="image-upload">

        <label for="upload">
          <p>+ Agregar imagen de fondo</p>
        </label>
        <input type="file" name="image" id="upload">

      </div>

    </div>

    <div id="form-fields">

      <div class="field-label">
        <p>Nombre de la comida</p>
      </div>
      <div class="form-field">
        {!! Form::text('name') !!}
      </div>
      <div class="field-label">
        <p>Tiempo de preparacion</p>
      </div>
      <div class="form-field">
        {!! Form::text('preparation_time') !!}
      </div>
      <div class="field-label">
        <p>Descripcion</p>
      </div>
      <div class="form-field">
        {!! Form::text('description') !!}
      </div>
        <!-- <p id="new-p"><span>+</span>  Agregar producto</p>
        <div class="productos">

        </div> -->
      <button type="submit" name="save" id="save">Guardar cambios</button>
    </div>

    {!! Form::close() !!}

  </div>
  <div id="bottom-links">

    <a href="/restaurant/home/">Regresar a lista de categorias</a>
    <a href="/restaurant/home/">Cancelar</a>

  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="/js/restaurant/addMeal.js"></script>
@endsection
