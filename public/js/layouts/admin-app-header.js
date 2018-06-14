$(function(){

  $("body").on('click', '#restaurantActive', function(){
    window.location.href = "/administrador/restaurantes";
  });

  $("body").on('click', '#pedidosActive', function(){
    window.location.href = "/administrador/repartidores";
  });

});
