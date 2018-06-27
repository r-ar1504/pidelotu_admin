@extends('layouts.restaurant-app-header')
@section('section-title')

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="/libs/animateCss/animate.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/form.css') }}">
@endsection

@section('section-title', 'Añade tu comida')

@section('content')
  <div id="form-holder">
    <div class="row">
      <div class="col-md-12">
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
        <form action="/restaurante/agregando" method="POST" enctype="multipart/form-data">
          <div id="photo-field">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="text" name="id" hidden value="{{$id}}">
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
            <div class="field-label">
              <p>Precio</p>
            </div>
            <div class="form-field">
              {!! Form::text('price') !!}
            </div>
            <button type="submit" name="save">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>

    <!--{!! Form::open(['id' => 'categoryForm', 'files' => true]) !!}
    {{ Form::hidden('id', $id) }}

    

    {!! Form::close() !!}-->

  </div>
  <div id="bottom-links">
    <a href="/restaurante/inicio/">Regresar a lista de categorias</a>
    <a href="/restaurante/inicio/">Cancelar</a>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="/js/restaurant/addMeal.js"></script>
@endsection
