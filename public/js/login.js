$(function(){

  $("body").on('click', '#check', function(){

    let data = {
      password: $("#password").val(),
      email: $("#email").val()
    }

    $.ajax({
      url: "/checkOut",
      type: "POST",
      data: data,
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(response){
      if (response.status == "200") {
        if (response.role == "admin") {
          window.location.href = "/admin/restaurants";
        }else {
          // window.location.href = "/"
        }
      }
    });
  });

});
