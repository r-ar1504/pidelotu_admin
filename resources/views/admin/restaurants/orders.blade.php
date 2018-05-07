@extends('layouts.admin-app-header')

@section('section-title', 'Opciones')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/admin/restaurants/main.css') }}">
@endsection

@section('content')
<div class="container" style="padding:2rem;">
  <div class="row">
    <div id="photo-fields2">
      <img src="{{ asset('images/bg-cat.png')}}" alt="category-photo" id="category-photo">
    </div>
  </div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript" src="/libs/jquery-validate/bootstrap.min.js"></script>
  <script type="text/javascript" src="/libs/jquery-validate/jquery.validate.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/admin/restaurants/orders.js') }}"></script>
  <script type="text/javascript" src="/libs/bootstrap-notify-master/bootstrap-notify.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="/js/admin/orders/order.js"></script>
@endsection
