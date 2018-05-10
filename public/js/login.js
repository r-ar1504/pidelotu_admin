$(function(){

  $("body").on('click', '#check', function(){
    $.ajax({
      url: "/checkOut",
      type: "POST",
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(response){

    });
  });

});
