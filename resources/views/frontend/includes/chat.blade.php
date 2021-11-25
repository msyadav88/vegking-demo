<div class="contact-panel" id="contact-panel" data-toggler=".is-active">
  <a class="contact-panel-button" data-toggle="contact-panel">Contact us</a>
  <form name="contactsend_form" id="contactsend_form" action="{{url('contact_send')}}">
    <div class="row">
      <label>Full name *
        <input type="text" placeholder="Full name" name="name" id="name" required="">
      </label>
    </div>
    <div class="row">
      <label>Company *
        <input type="text" placeholder="Company" name="company" id="company" required="">
      </label>
    </div>
    <div class="row">
      <label>Email *
        <input type="email" placeholder="Email address" id="email" name="email" required="">
      </label>
    </div>
    <div class="row">
      <label>Phone</label>
      <label>
        <input type="text" placeholder="Phone" name="phone" id="phone">
      </label>
    </div>
    <div class="row">
      <label>Message *
        <textarea placeholder="Describe your needs" rows="3" name="message" id="message" required=""></textarea>
      </label>
    </div>
    <div class="contact-panel-actions">
      <button class="cancel-button" data-toggle="contact-panel">Nevermind</button>
      <input type="submit" class="button submit-button" value="Submit">
    </div>
  </form>
</div>
@push('after-scripts')
 <script type="text/javascript">
    // closes the panel on click outside
   $(document).mouseup(function (e) {
     var container = $('#contact-panel');
     if (!container.is(e.target) // if the target of the click isn't the container...
     && container.has(e.target).length === 0) // ... nor a descendant of the container
       {
         //container.removeClass('is-active');
         $('#contact-panel').removeClass('is-active');
       }else{
        $('#contact-panel').addClass('is-active');
      }
   });

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $('#contactsend_form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: this.action,
          method: "post",
          processData: false,
          contentType: false,
          data: formData,
          beforeSend: function(){
            $('.loading').removeClass('loading_hide');
          },
        }).done(function(response){
          $('.loading').addClass('loading_hide');
          //alert(response);
          if(response.status == 'success'){
            $("#contactsend_form input[type='text']").val("");
            $("#contactsend_form input[type='email']").val("");
            $("#contactsend_form textarea").val("");            
            Swal.fire('Success',response.message,response.status);
          }else{
            Swal.fire('Error!',response.message,'error');
          }          
        }).fail(function(jqXHR, textStatus){
          $('.loading').addClass('loading_hide');
          if( jqXHR.status === 422 ) {
            Swal.fire('Error!', jqXHR.responseJSON.message, 'error');
            $('.button.submit-button').removeAttr('disabled');
          }else{
              Swal.fire('Error!', 'Some error occured. Please try again.', 'error');
          }
        }).always(function(){
          $("#contactsend_form .button.submit-button").removeAttr('disabled');
        });
    });

 </script>
@endpush()
@push('after-styles')
   <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/contact-panel.css').getAutoVersion('css/contact-panel.css')}}">
@endpush()