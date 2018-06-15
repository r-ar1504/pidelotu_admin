@extends('layouts.restaurant-app-header')

@section('section-title', $categories[0]->name)

@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/admin/restaurants/main2.css') }}">
<link rel="stylesheet" href="{{ asset('css/restaurants/category/main.css') }}">
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
@endsection

@section('content')
<div class="row">
  <div class="col-md-6" align="center">
    <p style="color: black; font-size: 2rem;">Categorias</p>
  </div>
  <div id="index-header" class="col-md-6">
    <a href="/restaurante/{{$restaurant->id}}/agregar-categoria"><p> <span>+</span> Agregar Categoria</p></a>
  </div>
</div>
<div class="container" align="center">
  <div class="row">
    <!--@if(count($categories) > 0)
    @foreach($CategoriesR as $category)
    <div class="col-md-4">
     <div class="element-card">
      <img src="{{'/images/restaurants/categories/'.$category->dashboard_banner}}" alt="restaurant-image">
      <a href="/restaurante/comidas/{{$category->id}}">
        <div class="card-overlay" align="center">
          <div class="overlay-button" align="center">
            <p>{{$category->name}}</p>
          </div>
        </div>
      </a>
    </div>
    <button class="btn btn-success">Actualizar</button>
    <button type="submit" class="btn btn-danger delete">Eliminar</button>
  </div>
  @endforeach
  @else
  <div class="no-content">
    <p>No existen platillos en este restaurante</p>
  </div>
  @endif-->
  @if(count($categories) > 0)
  @foreach($CategoriesR as $category)
  @if($category->active == 1)
  <div class="element-card" style="width: 300px !important; height: 250px !important;">
    <img src="{{'/images/restaurants/categories/'.$category->dashboard_banner}}" alt="restaurant-image">
    <div class="card-overlay">
      <div class="overlay-button">
        <a href="{{ '/administrador/modificar-categoria/'.$category->id }}">Actualizar</a>
      </div>
      <div class="overlay-button">
        <a data-id="{{$category->id}}" class="delete">Eliminar</a>
      </div>
      <div class="overlay-button">
        <a href="/restaurante/meals/{{$category->id}}">Ver Mas</a>
      </div>
      <br>
      <br>
      <br>
      <br>
      <p>{{$category->name}}</p>
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
@endsection

@section('javascript')
<script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          url: "/restaurante/dcomida",
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
