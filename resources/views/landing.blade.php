@extends('master.master-template')

@section('css')
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "baedd007-9325-4e3e-83fc-d8be136450bd",
    });
  });
</script>
@stop

@section('presentation-app')
<br>
<br>
<br>
<div class="owl-carousel">
  <div class="item">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 id="text-carrucel">Ordena lo que mas te gusta sin tener que moverte de donde estás</h1>
          <p>Con  <strong><span>Pídelo</span><span>Tú</span></strong>  ordenar comida nunca fue tan sencillo.</p>
        </div>
        <div class="col-md-6">
          <img class="image" src="{{asset('images/icons/banner-preview.png')}}" alt="imagen-carrucel">
        </div>
      </div>
    </div>
  </div>
  <div class="item">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 id="text-carrucel">Disfruta de la comida que más te gusta desde la comodidad de tu hogar.</h1>
          <p>Con  <strong><span>Pídelo</span><span>Tú</span></strong>  Disfrutaras tu comida al 100%</p>
        </div>
        <div class="col-md-6">
          <img class="image" src="{{asset('images/food-1.jpg')}}" alt="food-1">
        </div>
      </div>
    </div>
  </div>
  <div class="item">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 id="text-carrucel">Ordena lo que mas te gusta sin tener que moverte de donde estás</h1>
          <p>Con  <strong><span>Pídelo</span><span>Tú</span></strong>  ordenar comida nunca fue tan sencillo.</p>
        </div>
        <div class="col-md-6">
          <img class="image" src="{{asset('images/food-2.jpg')}}" alt="food-2">
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('download')
<div class="container">
  <div class="row">
    <div id="preview-section"><!--SOS-->
      <div class="col-md-8">
        <div class="preview-text">
          <h1>No te quedes sin opciones con +65 restaurantes para ordenar</h1>
          <ul>
            <li> <i class="fa fa fa-lock"></i><p>Rapido y seguro</p> </li>
            <li> <i class="fa fa fa-cutlery"></i><p>Encuentra tus platillos favoritos</p> </li>
            <li> <i class="fa fa fa-credit-card"></i><p>Pago desde la aplicación</p> </li>
          </ul>
        </div>
        <a href="#"><img src="{{ asset('images/google.png') }}" alt="google-icon" class="store"></a>
        <a href="#"><img src="{{ asset('images/ios.png') }}" alt="ios-icon" class="store"></a>
      </div>
      <div class="col-md-4">
        <div id="iphone-preview">
          <div id="screens-container">
            <img src="{{ asset('images/screen.jpeg')}}" alt="preview-app" id="preview-img" class="screenshot">
          </div>
          <img src="{{ asset('images/iphone-mk.png')}}" alt="iphone-muckup" id="iphone-mk">
        </div>
      </div>
      <div class="preview-text">

      </div>
    </div><!--EOS-->
  </div>
</div>
@stop

@section('services')
<div id="stores-section"><!--SOS-->
  <div class="overlay">
    <h1>¡Descarga Pídelo<span>Tú</span> !</h1>
    <div id="store-icons">
      <a href="#"><img src="{{ asset('images/google.png') }}" alt="google-icon" class="store-icon"></a>
      <a href="#"><img src="{{ asset('images/ios.png') }}" alt="ios-icon" class="store-icon"></a>
    </div>
  </div>
</div><!--EOS-->
<div id="footer-section"><!--SOS-->
  <div ="">

  </div>
</div><!--EOS-->
@stop

@section('js')
<script type="text/javascript">
  /*Script para el carrusel*/
  $('.owl-carousel').owlCarousel({
    autoplay:true,
    loop:true,
    margin:0,
    nav:false,
    navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    animateOut: 'slideOutDown',
    animateIn: 'flipInX',
    smartSpeed:500,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:1
      },
      1000:{
        items:1
      }
    }
  });
</script>
@stop