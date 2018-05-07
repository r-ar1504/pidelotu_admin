$(function(){

  $("body").on('click', '#restaurantActive', function(){
    window.location.href = "/admin/restaurants";
  });

  $("body").on('click', '#pedidosActive', function(){
    window.location.href = "/admin/orders";
  });

});
