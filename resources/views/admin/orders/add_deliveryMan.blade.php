@extends('layouts.admin-app-header')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
  <link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
  <link rel="stylesheet" href="/libs/animateCss/animate.css">
@endsection

@section('section-title', 'restaurantes')

@section('content')
@if ($delivery_man)
    <div id="form-holder">

      {!! Form::open(['id' => 'restaurantForm', 'files' => true]) !!}
      <div id="form-fields">

        <div class="field-label">
          <p>Nombre Completo</p>
        </div>
        <div class="form-field">
          {!! Form::text('name', $delivery_man->name) !!}
        </div>
        <div class="field-label">
          <p>Edad</p>
        </div>
        <div class="form-field">
          {!! Form::text('age', $delivery_man->age) !!}
        </div>
        <div class="field-label">
          <p>Sexo</p>
        </div>
        <div class="form-field">
          {!! Form::text('gender', $delivery_man->gender) !!}
        </div>
        <div class="field-label">
          <p>Dirección Completa</p>
        </div>
        <div class="form-field">
          {!! Form::text('address', $delivery_man->address) !!}
        </div>
        <div class="field-label">
          <p>CURP</p>
        </div>
        <div class="form-field">
          {!! Form::text('curp', $delivery_man->curp) !!}
        </div>
        <div class="field-label">
          <p>Celular</p>
        </div>
        <div class="form-field">
          {!! Form::text('phone', $delivery_man->phone) !!}
        </div>
        <div class="field-label">
          <p>Informacion adicional</p>
        </div>
        <div class="form-field-text">
          {!! Form::textarea('details', $delivery_man->details) !!}
        </div>
        <button type="button" style="margin-top: 2rem;" id="saveUpdate" data-id="{{$delivery_man->id}}" name="save">Guardar cambios</button>
      </div>
      <div id="photo-field">
        <img src="/images/delivery_man/{{$delivery_man->logo}}" alt="restaurant-photo" id="restaurant-photo">

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
  <div align="center">
    <div class="row">
      <form id="restaurantForm">
        <div class="col-md-7">
          <div id="s">
            <div class="field-label">
              <p>Nombre Completo</p>
            </div>
            <div class="form-field">
              {!! Form::text('name') !!}
            </div>
            <div class="field-label">
              <p>Edad</p>
            </div>
            <div class="form-field">
              {!! Form::text('age') !!}
            </div>
            <div class="field-label">
              <p>Sexo</p>
            </div>
            <div class="form-field">
              {!! Form::text('gender') !!}
            </div>
            <div class="field-label">
              <p>Dirección Completa</p>
            </div>
            <div class="form-field">
              {!! Form::text('address') !!}
            </div>
            <div class="field-label">
              <p>CURP</p>
            </div>
            <div class="form-field">
              {!! Form::text('curp') !!}
            </div>
            <div class="field-label">
              <p>Celular</p>
            </div>
            <div class="form-field">
              {!! Form::text('phone') !!}
            </div>
            <div class="field-label">
              <p>Informacion adicional</p>
            </div>
            <div class="form-field-text">
              {!! Form::textarea('details') !!}
            </div>
            <button type="button" style="margin-top: 2rem;" id="save" name="save">Guardar cambios</button>
          </div>
        </div>
        <div class="col-md-5">
          <div id="photo-field">
            <img src="{{ asset('images/pidelo-icon.gif') }}" alt="restaurant-photo" id="restaurant-photo">
            <div id="image-upload">
              <label for="upload">
                <img src="{{ asset('images/image-upload.png') }}" alt="upload-icon" id="upload-placeholder" >
              </label>
              <input type="file" name="image" id="upload">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endif

  <div id="bottom-links">

    <a href="/administrador/repartidores">Regresar a lista de restaurantes</a>
    <a href="/administrador/repartidores">Cancelar</a>

  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/js/admin/orders/add_deliveryMan.js"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
