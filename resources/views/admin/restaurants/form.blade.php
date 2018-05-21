@extends('layouts.admin-app-header')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
  <link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
  <link rel="stylesheet" href="/libs/animateCss/animate.css">
@endsection

@section('section-title', 'restaurantes')

@section('content')

@if($restaurant)
  <div id="form-holder">

    {!! Form::open(['id' => 'restaurantForm', 'files' => true]) !!}
    <div id="form-fields">

      <div class="field-label">
        <p>Nombre del Restaurante</p>
      </div>
      <div class="form-field">
        {!! Form::text('name', $restaurant->name) !!}
      </div>
      <div class="field-label">
        <p>Usuario</p>
      </div>
      <div class="form-field">
        {!! Form::text('user', $restaurant->username) !!}
      </div>
      <div class="field-label">
        <p>Contasena</p>
      </div>
      <div class="form-field">
        {!! Form::text('password') !!}
      </div>
      <div class="field-label">
        <p>Dirección del Restaurante</p>
      </div>
      <div class="form-field">
        {!! Form::text('address', $restaurant->address) !!}
      </div>
      <div class="field-label">
        <p>Detalles del Restaurante</p>
      </div>
      <div class="form-field-text">
        {!! Form::textarea('details', $restaurant->details) !!}
      </div>
      
      <div class="field-label">
        <p>Imagen para aplicación</p>
      </div>
      <div class="form-field-text">
        <input type="file" name="ban" id="b">
      </div>
      <button type="button" style="margin-top: 2rem;" data-id="{{$restaurant->id}}" id="saveUpdate" name="save">Guardar cambios</button>
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
  @else
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
        <p>Usuario</p>
      </div>
      <div class="form-field">
        {!! Form::text('user') !!}
      </div>
      <div class="field-label">
        <p>Contasena</p>
      </div>
      <div class="form-field">
        {!! Form::text('password') !!}
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
      <button type="button" style="margin-top: 2rem;" id="save" name="save">Guardar cambios</button>
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
  @endif
  <div id="bottom-links">

    <a href="/admin/restaurants">Regresar a lista de restaurantes</a>
    <a href="/admin/restaurants">Cancelar</a>

  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/admin/restaurants/restaurants.js') }}"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
