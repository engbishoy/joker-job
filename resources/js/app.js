/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//site


    // online status

    window.Echo.join(`online`)
    .here((users) => {
        //
        $.each(users,function(key,user){

          $(`.online-right-${user.id}`).fadeIn(1000);
          $(`.offline-right-${user.id}`).hide(); 

        });

      })
    .joining((user) => {
      $(`.online-right-${user.id}`).fadeIn(1000);
      $(`.offline-right-${user.id}`).hide();
        
    })
    .leaving((user) => {
      $(`.online-right-${user.id}`).hide();
      $(`.offline-right-${user.id}`).fadeIn(1000);
        
    });


   
   $('.notifi-message').on('click',function(){
    $('.message-badge').hide();
   });
 
   $('.read-message').on('click',function(){
     var fromuserid=$(this).data('fromuserid');
    $.ajax({
      url: "/home/notification/message/read",
      method:'get',
      data:{
        "_token": "{{ csrf_token() }}",
        fromuser:fromuserid,
      },
      success:function(){
        console.log('true read');
      }
    });
   });
 
   $('.notifi-service').on('click',function(){
    $('.orders-badge').hide();
     $.ajax({
       url: "/home/notification/orderservice/read",
       method:'get',
       data:'',
     });
   });







   // seen notification admin
   $('.seen-admin-notification').on('click',function(){
    $('.count-notifi').hide();
     $.ajax({
       url: "/dashboard/notification/seen",
       method:'get',
       data:'',
  
     });
   });












   $(function(){


    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
          $('#blah').fadeIn(1000);
  
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    
    $("#imgInp").change(function() {
      readURL(this);
    });
  
  
    // plugin file upload
  
    // initialize with defaults
    $('input[name="attachment[]"]').fileuploader();
    $('input[name="file[]"]').fileuploader();
  
  
  
  });

   
$("#form").submit(function (e) {
  //disable the submit button
  $("#btnSubmit").attr("disabled", true);
  return true;
  });
  
  $('input[name="photo[]"]').on('click',function(){
    $('.img-admin').css('display','none');
    });
    