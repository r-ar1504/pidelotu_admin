@extends('layouts.admin-app-header')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
  <link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
  <link rel="stylesheet" href="/libs/animateCss/animate.css">
@endsection

@section('section-title', 'Actualiza tu restaurante')

@section('content')

@if($restaurant)
  <div align="center">
    <div class="row">
      {{Form::open(array('url' => '/administrador/actualizando', 'method' => 'post', 'files' => true))}}
        <div class="col-md-7">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <p>Corrige los siguientes errores:</p>
              <ul>
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <br>
          <br>
          <div id="">
            {!! Form::token() !!}
            <input hidden="true" type="password" name="id" value="{{$restaurant->id}}">
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
              {!! Form::text('user', $ru[0]->username) !!}
            </div>
            <div class="field-label">
              <p>Correo Electronico</p>
            </div>
            <div class="form-field">
              <input type="email" name="email" value="{{$ru[0]->email}}">
            </div>
            <div class="field-label">
              <p>Contaseña</p>
            </div>
            <div class="form-field">
              <!--{!! Form::text('password') !!}-->
              <input type="text" name="password" id="password">
            </div>
            <div class="field-label">
              <p>Dirección del Restaurante</p>
            </div>
            <div class="form-field">
              {!! Form::text('address', $restaurant->address) !!}
            </div>
            <div class="row" align="center">
              <div class="col-md-6" align="center">
                <div class="field-label">
                  <p>Apertura</p>
                </div>
                <div class="form-field">
                  <input type="time" class="form-control" style="height: 30px;" name="open_time" value="{{$restaurant->open_time}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="field-label">
                  <p>Cierre</p>
                </div>
                <div class="form-field">
                  <input type="time" class="form-control" style="height: 30px;" name="close_time" value="{{$restaurant->close_time}}" value="$07:00" required>
                </div>
              </div>
            </div>
            <div class="field-label">
              <p>Detalles del Restaurante</p>
            </div>
            <div class="form-field-text">
              {!! Form::textarea('details', $restaurant->details) !!}
            </div>
            <button type="submit" style="margin-top: 2rem;" class="btn btn-success">Guardar Cambios</button>
          </div>
        </div>
        <div class="col-md-5">
          <div id="photo-field">
            <p>Logo</p>
            <img src="{{ asset('images/pidelo-icon.gif') }}" alt="restaurant-photo" id="restaurant-photo">
            <div id="image-upload">
              <label for="upload">
                <img src="{{ asset('images/image-upload.png') }}" alt="upload-icon" id="upload-placeholder" >
              </label>
            </div>
            <input type="file" name="image" id="upload">
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @else
  <div align="center">
    <div class="row">
      <!--<form action="/administrador/agregando" files="true" method="POST">-->
      {{Form::open(array('url' => '/administrador/agregando', 'method' => 'post', 'files' => true))}}
        <div class="col-md-7">
          <br>
          <br>
          {!! Form::token() !!}
          <div class="field-label">
            <p>Nombre del Restaurante</p>
          </div>
          <div class="form-field">
            <!--{!! Form::text('name') !!}-->
            <input type="text" name="name" required>
          </div>
          <div class="field-label">
            <p>Nombre de Usuario</p>
          </div>
          <div class="form-field">
            <!--{!! Form::text('user') !!}-->
            <input type="text" name="user" required>
          </div>
          <div class="field-label">
            <p>Correo Electronico</p>
          </div>
          <div class="form-field">
            <input type="email" name="email" required="">
          </div>
          <div class="field-label">
            <p>Contaseña</p>
          </div>
          <div class="form-field">
            <!--{!! Form::text('password') !!}-->
            <input type="password" name="password" id="password" required>
          </div>
          <div class="field-label">
            <p>Dirección del Restaurante</p>
          </div>
          <div class="form-field">
            <!--{!! Form::text('address') !!}-->
            <input type="text" name="address" required>
          </div>
          <div class="row" align="center">
            <div class="col-md-6" align="center">
              <div class="field-label">
                <p>Apertura</p>
              </div>
              <div class="form-field">
                <input type="time" class="form-control" style="height: 30px;" name="open_time" placeholder="12:00:00" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="field-label">
                <p>Cierre</p>
              </div>
              <div class="form-field">
                <input type="time" class="form-control" style="height: 30px;" name="close_time" placeholder="12:00:00" required>
              </div>
            </div>
          </div>
          <div class="field-label">
            <p>Detalles del Restaurante</p>
          </div>
          <div class="form-field-text">
            {!! Form::textarea('details') !!}
          </div>
          <button type="submit" style="margin-top: 2rem;" name="save" class="btn btn-success">Guardar Cambios</button>
        </div>
        <div class="col-md-5">
          <div id="photo-field">
            <p>Logo</p>
            <img src="{{ asset('images/pidelo-icon.gif') }}" alt="restaurant-photo" id="restaurant-photo">
            <div id="image-upload">
              <label for="upload">
                <img src="{{ asset('images/image-upload.png') }}" alt="upload-icon" id="upload-placeholder" >
              </label>
            </div>
            <input type="file" name="image" id="upload">
          </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <p>Corrige los siguientes errores:</p>
          <ul>
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      <!--</form>-->
      {!! Form::close() !!}
    </div>
  </div>

    <!--{!! Form::open(['id' => 'restaurantForm', 'files' => true]) !!}
    <!--<div id="form-fields">

      <div class="field-label">
        <p>Nombre del Restaurante</p>
      </div>
      <div class="form-field">
        {!! Form::text('name') !!}
      </div>
      <div class="field-label">
        <p>Nombre de Usuario</p>
      </div>
      <div class="form-field">
        {!! Form::text('user') !!}
      </div>
      <div class="field-label">
        <p>Contaseña</p>
      </div>
      <div class="form-field">
        <input type="password" name="password" id="password">
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
      <button type="button" style="margin-top: 2rem;" name="save">Guardar cambios</button>
    </div>-->
    <!--<div id="photo-field">
      <img src="{{ asset('images/pidelo-icon.gif') }}" alt="restaurant-photo" id="restaurant-photo">

      <div id="image-upload">

        <label for="upload">
          <img src="{{ asset('images/image-upload.png') }}" alt="upload-icon" id="upload-placeholder" >
        </label>
        <input type="file" name="image" id="upload">

      </div>

    </div>-->
    <!--{!! Form::close() !!}-->
  @endif
  <br>
  <br>
  <br>
  <div id="bottom-links">

    <a href="/administrador/restaurantes">Regresar a lista de restaurantes</a>
    <a href="/administrador/restaurantes">Cancelar</a>

  </div>
  <br>
  <br>
  <br>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/admin/restaurants/restaurants.js') }}"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
