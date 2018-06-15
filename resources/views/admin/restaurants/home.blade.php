@extends('layouts.admin-app-header')

@section('section-title', 'Restaurantes Registrados')

@section('stylesheets')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
@endsection

@section('content')
  <div id="index-header">
  <a href="add_restaurant"><p> <span>+</span> Agregar Restaurante</p></a>
  </div>
  <div class="list-container">

    @if(count($restaurants) > 0)
      @foreach($restaurants as $restaurant)
          <div class="element-card">
            <img src="{{'/images/logos/'.$restaurant->logo }}" alt="restaurant-image">
            <div class="card-overlay">
              <p>{{ $restaurant->name }}</p>
              <div class="overlay-button">
                <a href="{{ '/administrador/modificar-restaurante/'.$restaurant->id }}">Actualizar</a>
              </div>
              <div class="overlay-button">
                <a data-id="{{$restaurant->id}}" class="delete">Eliminar</a>
              </div>
              <div class="overlay-button">
                <a href="{{ '/administrador/restaurante/'.$restaurant->id }}">Ver Mas</a>
              </div>
            </div>
          </div>
      @endforeach
    @else
      <div class="no-content">
        <p>No existen elementos en esta categoria</p>
      </div>
    @endif
  </div>
@endsection

@section('javascript')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    $("body").on('click', '.delete', function(){

    swal({
      title: "Estas seguro de eliminarlo?",
      text: "Una vez eliminado no podras recuperarlo ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        let data = {id: $(this).data('id')};

        $.ajax({
          url: "/administrador/deleteRestaurant/",
          type: "POST",
          data: data,
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
@stop
