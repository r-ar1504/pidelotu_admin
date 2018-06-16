$(function(){
  $("#restaurantActive").addClass('active');
  $("body").on('click', '.delete', function(){

    swal({
      title: "Estas seguro de eliminarlo?",
      text: "Una vez eliminado no podras recuperarlo ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        let data = {id: $(this).data('id')};

        $.ajax({
          url: "/restaurantes/categoria",
          type: "POST",
          data: data,
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
});//->cierre jquery
