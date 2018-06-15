@extends('layouts.restaurant-app-header')

@section('section-title', $categorie[0]->name)

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
@endsection

@section('content')
<div class="row">
  <div class="col-md-6" align="center">
    <p style="color: black; font-size: 2rem;">Comidas</p>
  </div>
  <div id="index-header" class="col-md-6">
    <a href="/restaurante/add-meal/{{$id}}"><p> <span>+</span> Agregar Comida</p></a>
  </div>
</div>


<div class="list-container">
  <div class="row">
    @if(count($meals) > 0)
    @foreach($meals as $meal)
    @if($meal->active ==1)
    <!--<div class="col-md-4" align="center">
      <div class="element-card">
        <img src="{{'/images/meals/'.$meal->image }}" alt="restaurant-image">
        <a href="/restaurante/ingredientes/{{$meal->id}}">
          <div class="card-overlay">
            <div class="overlay-button">
              <p>{{$meal->name}}</p>
            </div>
          </div>
        </a>
      </div>
      <div align="cetner">
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="{{$meal->id}}">Actualizar</button>
        <button class="btn btn-danger delete"  data-id="{{$meal->id}}">Eliminar</button>
      </div>
    </div>-->
    <div class="element-card" style="width: 100% !important">
      <img src="{{'/images/logos/'.$meal->image }}" alt="restaurant-image">
      <div class="card-overlay">
        <p>{{ $meal->name }}</p>
        <div class="overlay-button">
          <a href="#" data-toggle="modal" data-target="#myModal" data-id="{{$meal->name}}">Actualizar</a>
        </div>
        <div class="overlay-button">
          <a data-id="{{$meal->id}}" class="delete">Eliminar</a>
        </div>
        <div class="overlay-button">
          <a href="/restaurante/ingredientes/{{$meal->id}}">Ver Mas</a>
        </div>
      </div>
    </div>
    @endif
    @endforeach
    @else
    <div class="no-content">
      <p>No existen elementos en esta categoria</p>
    </div>
    @endif
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <p>Actualiza tu comida</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="photo-field" align="center" class="col-md-5">
            <img src="{{ asset('images/pidelo-icon.gif') }}" alt="restaurant-photo" id="restaurant-photo">
            <div id="image-upload">
              <label for="upload">
                <img src="{{ asset('images/image-upload.png') }}" alt="upload-icon" id="upload-placeholder" >
              </label>
            </div>
            <input type="file" name="image-logo" id="upload-logo">
          </div>
          <div class="col-md-7">
            <input type="text" name="name" placeholder="Nombre">
            <br>
            <br>
            <br>
            <input type="text" name="description" placeholder="Descripcion">
            <br>
            <br>
            <br>
            <input type="text" name="time" placeholder="Tiempo de preparación">
            <br>
            <br>
            <br>
            <input type="text" name="price" placeholder="Precio">
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Actualizar</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(function(){
    $("#restaurantActive").addClass('active');
  });
</script>
<script type="text/javascript">
  $("body").on('click', '.delete', function(){

    swal({
      title: "¿Estas seguro de eliminarlo?",
      text: "Una vez eliminado no podras recuperarlo ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        let data = {id: $(this).data('id')};
        $.ajax({
          url: "/restaurante/dc",
          type: "POST",
          dataType: 'json',
          data: {
            id: $(this).data('id')
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        .done(function(response){
          swal({
            title: "Excelente",
            text: "Se ha eliminado con exito ",
            icon: "success",
          })
          .then((willDelete) => {
            window.location.reload()
          });
        });
      } else {
        swal("Todo esta como lo dejaste!");
      }
    });

  });
</script>
@endsection
