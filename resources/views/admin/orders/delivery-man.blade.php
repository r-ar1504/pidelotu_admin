@extends('layouts.admin-app-header')

@section('section-title', 'Opciones')

@section('stylesheets')
<link rel="stylesheet" href="/libs/jquery-validate/bootstrap.css">
<link rel="stylesheet" href="/css/admin/orders/delivery-man.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
@endsection

@section('content')
<div class="container" style="padding:2rem;">
  <div class="row">

    <div class="col-md-12">
      <div class="text-right">
        <p class="addDeliveryMan"><span class="plus">+</span>agregar repartidor</p><br><br>
      </div>
    </div>

    @foreach($deliveryMans as $deliveryMan)
      <div class="col-md-4">
        <div class="text-center">
          <span></span>
          <img src="/images/delivery_man/{{$deliveryMan->logo}}" class="deliveryMan-img" alt="">
          <b><p>{{$deliveryMan->name}}</p></b>
          <button type="button" class="btn btn-success update" data-id="{{$deliveryMan->id}}" name="button">Actualizar</button>
        </div>
      </div>
      <div class="col-md-8">
        <img src="/images/error.png" class="deleteDeliveryMan" data-id="{{$deliveryMan->id}}" alt="">
        <span><i class="far fa-user"></i><p class="text-deliveryMan">{{$deliveryMan->details}}</p></span><br>
        <span><i class="fas fa-map-pin"></i><p class="text-deliveryMan">{{$deliveryMan->address}}</p></span><br>
        <span><i class="fas fa-mobile-alt"></i><p class="text-deliveryMan">{{$deliveryMan->phone}}</p></span>
        <div class="text-right">
          <button type="button" class="btn btn-primary btn_msj" name="button">Enviar mensaje</button>
        </div>
      </div>
    @endforeach

  </div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/admin/restaurants/orders.js') }}"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="/js/admin/orders/delivery-man.js"></script>
@endsection
