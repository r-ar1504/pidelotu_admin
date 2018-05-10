$(function(){

  $("#restaurantActive").addClass('active');

  $("body").on('click', '.saveIngredient', function(){
    var id =  $(this).data('id');
    let data = {
      name: $("#name").val(),
      price: $("#price").val(),
      meal_id: id
    }


    $.ajax({
      url: "/create-ingredient",
      type: "POST",
      data: data,
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(response){
      window.location.reload();
    });

  });

});//->cierre jquery
