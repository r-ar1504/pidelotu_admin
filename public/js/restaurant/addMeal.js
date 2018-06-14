$(function(){
var categoryData = $('form#categoryForm')
var uploading_image = $('#category-photo')
var image_input = $('#upload')
var restaurantId =  categoryData.find('input[name="id"]').val()
var addProducts = false

/**
 * click events
 */

 //save click

  $("body").on('click', '#save', function(e){
    e.preventDefault();
    categoryData.validate({
       rules : {
          name : {required: true},
          preparation_time  : {required: true},
          description : {required: true}
       },
       messages: {
        name: {required: "Ingresa un nombre de restaurante"},
        preparation_time: {required: "Ingresa la direccion del restaurante"},
        description: {required: "Ingresa los detalles del restaurante"}
      }
    });
    if (categoryData.valid()){
      var formData = new FormData($("#categoryForm")[0]);
      $.ajax({
        url: "/restaurante/create-meal",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      .done(function(response){
        alert(response)
      });
    }else {
      let BreakException = {};
      $.each($("[id*=-error]"),function(i){
        if ($($("[id*=-error]")[i]) && $($("[id*=-error]")[i]).text() != "") {
          $.notify({
            title: '<strong>Atencion!</strong>',
            message: $($("[id*=-error]")[i]).text()
          },{
            type: 'danger'
          });
          throw BreakException;
        }
      });
    }

  });


  /**
   * on change functions
   */

   $("body").on('change', image_input, function(){
       selectFile(image_input, uploading_image);
   });

});//->cierre jquery

/**
 * function
 */

 var file = {
   validExtension : function ($file, $types) {
      extension = ($file.substring($file.lastIndexOf("."))).toLowerCase();
      $available = false;
      for (var i = 0; i < $types.length; i++) {
         if ($types[i] == extension) {
            $available = true;
            break;
         }
      }
      if ($available) {
         return true;
      }else{
         return false;
      }
   },
   validSize : function($idInput, $mb){
      var files = document.getElementById($idInput).files;
      $max = (1024000 * $mb);
      if(files[0].size > $max){
         return null;
      }
      else{
         return files[0];
      }
   }
 }

 function makeBlob($idInput){
   try {
      var files = document.getElementById($idInput).files;
      var browser = window.URL || window.webkitURL;
      var url = browser.createObjectURL(files[0]);
      return url;
   } catch (e) {
      return null;
   }
 }

 function selectFile($input, $prev){
      var exts = new Array(".png", ".jpg", "jpeg", "JPEG", "JPG", "PNG");
      var $file = $input;
      var maxMegas = 2;
      if ($file.val() != ""){
         if(file.validExtension($file.val(), exts)){
            var files = file.validSize($file.attr("id"), maxMegas);
            if (files != null){
               var url = makeBlob($file.attr("id"));
               $($prev).attr("src", url);
            }
            else{
               this.resetImage();
               $.notify({
               	message: "El archivo excede los "+maxMegas+" MB máximos permitidos"
               },{
               	type: 'danger'
               });
            }
         }
         else{
            $file.val("");
            $.notify({
              message: "Selecciona un archivo de imagen valido"
            },{
              type: 'danger'
            });
         }
      }
   }
