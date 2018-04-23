var restaurantData = $('form#restaurantForm')
var uploading_image = $('#restaurant-photo')
var image_input = $('#upload')


/* Create Form Object & Send To The Server*/
restaurantData.submit(function(e){

  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
     url: "create_restaurant",
     type: 'POST',
     data: formData,
     success: function (data) {
      alert(data)
      console.log(data);
     },
     cache: false,
     contentType: false,
     processData: false
 })
})

/*Change Image On File Selected*/
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      uploading_image.attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
image_input.change(function() {
  readURL(this)
});
