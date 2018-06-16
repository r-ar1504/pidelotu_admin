@extends('layouts.restaurant-app-header')
@section('section-title', $restaurant[0]->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/restaurants/category/form.css') }}">
@endsection

@section('section-title', 'restaurantes')

@section('content')
  <div id="form-holder">

    {!! Form::open(['id' => 'categoryForm', 'files' => true]) !!}
    {{ Form::hidden('id', $restaurant[0]->id) }}

    <div id="photo-field">
      <img src="{{ asset('images/bg-cat.png')}}" alt="category-photo" id="category-photo">

      <div id="image-upload">

        <label for="upload">
          <p>+ Agregar imagen</p>
        </label>
        <input type="file" name="image" id="upload">

      </div>

    </div>

    <div id="form-fields">

      <div class="field-label">
        <p>Nombre de la categoría</p>
      </div>
      <div class="form-field">
        {!! Form::text('name') !!}
      </div>
        <p id="new-p"><span>+</span>  Agregar producto</p>
        <div class="productos">

        </div>
      <button type="submit" name="save">Guardar cambios</button>
    </div>

    {!! Form::close() !!}

  </div>
  <div id="bottom-links">

    <a href="/restaurante/inicio">Regresar a lista de categorias</a>
    <a href="/restaurante/ordenes">Cancelar</a>

  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="{{ asset('js/restaurant/category.js') }}">
  </script>
@endsection