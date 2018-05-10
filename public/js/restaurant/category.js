var categoryData = $('form#categoryForm')
var uploading_image = $('#category-photo')
var image_input = $('#upload')
var restaurantId =  categoryData.find('input[name="id"]').val()
var addProducts = false
$("#restaurantActive").addClass('active');

/* Create Form Object & Send To The Server*/
categoryData.submit(function(e){

  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
     url: "/restaurant/"+ restaurantId +"/create_category",
     type: 'POST',
     data: formData,
     success: function (data) {
       if(addProducts != false){
         window.location.href = "/res/"+ restaurantId +"/cat/" + data.id;
       }else{
         window.location.href = "/restaurant/home/"+restaurantId;
       }
     },
     cache: false,
     contentType: false,
     processData: false
 })
})

/* Create Form Object & Send To The Server*/
$('#new-p').on('click',function(){
  addProducts = true;
  categoryData.submit()
});



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
