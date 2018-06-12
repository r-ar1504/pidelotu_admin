$(function(){

  $("body").on('click', '.deleteDeliveryMan', function(){
    let id = $(this).data('id');
    swal({
      title: "Estas seguro de eliminarlo?",
      text: "Una vez eliminado ya no podras recuperarlo!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "/administrador/deleteDeliveryMan",
          type: "POST",
          data: {id: id},
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        .done(function(){

        });
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  });

  $("body").on('click', '.update', function(){
    $id = $(this).data('id');
    window.location.href = "/administrador/update_deliveryMan/"+$id;
  });

});
