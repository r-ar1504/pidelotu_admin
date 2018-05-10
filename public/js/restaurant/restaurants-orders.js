$(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $("body").on('click', '#getDelivery', function(){
    $.ajax({
      url: "/getDelivery",
      type: "POST",
      data: {id: $(this).data('id')},
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(response){

    });
  });
});
