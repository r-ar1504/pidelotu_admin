@extends('layouts.admin-app-header')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
@endsection

@section('section-title', 'restaurantes')

@section('content')
  <div id="form-holder">

    {!! Form::open(['id' => 'restaurantForm', 'files' => true]) !!}
    <div id="form-fields">

      <div class="field-label">
        <p>Nombre del Restaurante</p>
      </div>
      <div class="form-field">
        {!! Form::text('name') !!}
      </div>
      <div class="field-label">
        <p>Dirección del Restaurante</p>
      </div>
      <div class="form-field">
        {!! Form::text('address') !!}
      </div>
      <div class="field-label">
        <p>Detalles del Restaurante</p>
      </div>
      <div class="form-field-text">
        {!! Form::textarea('details') !!}
      </div>
      <button type="submit" name="save">Guardar cambios</button>
    </div>
    <div id="photo-field">
      <img src="{{ asset('images/pidelo-icon.gif') }}" alt="restaurant-photo" id="restaurant-photo">

      <div id="image-upload">

        <label for="upload">
          <img src="{{ asset('images/image-upload.png') }}" alt="upload-icon" id="upload-placeholder" >
        </label>
        <input type="file" name="image" id="upload">

      </div>

    </div>
    {!! Form::close() !!}

  </div>
  <div id="bottom-links">

    <a href="/admin/restaurants">Regresar a lista de restaurantes</a>
    <a href="/admin/restaurants">Cancelar</a>

  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="{{ asset('js/admin/restaurants/restaurants.js') }}">

  </script>
@endsection
