@extends('frontend.layouts.app')
@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="container">
	<div class="row">
		<h2 class="ContactPageHeading">Profile</h2>
	</div>
	<div class="row" style="margin-bottom: 40px;">
		<div class="row">
			<div class="col">
			@foreach($user as $value)
				@if($value->avatar_location)
					<img src="{{ url('storage/app/public').'/'.$value->avatar_location}}" class="img-avatar" alt="{{ $value->first_name }}">
				@endif	
			@endforeach
			</div><!--col-->
		</div><!--row-->
		{{ html()->modelForm($user, 'POST')->id('formsubmit')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
			<div class="row">
				<div class="col">
				   <div class="form-group" id="" style="display:none !important;"><input type="hidden" id="id" name="id" value="{{$user}}"> </div>
					<div class="form-group" id="" style="display:block !important;"> {{ html()->file('avatar_location')->class('') }}</div>
					
				</div><!--col-->
			</div><!--row-->

			<div class="row">
				<div class="col">
					<div class="form-group mb-0 clearfix">
						 {{ form_submit(__('buttons.general.crud.update')) }}
					</div><!--form-group-->
				</div><!--col-->
			</div><!--row-->
		{{ html()->closeModelForm() }}
	</div>
</div>
@php 
    $url =  url('/').'/publicpage_updateprofilepic/updateimage';
	$redirecturl =  url('/').'/publicpage_updateprofilepic/'.$user;
@endphp
@endsection


@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                //avatar_location.show();
            } else {
               // avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    //avatar_location.show();
                } else {
                    //avatar_location.hide();
                }
            });
        });
		
    </script>
 <script type="text/javascript">
    $(document).ready(function() {
    $('#formsubmit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
	  
      $.ajax({
        url: "{{  $url }}",
        method: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        beforeSend: function(){
          $('.loading').removeClass('loading_hide');
        },
        success: function(data)
        {
		if(data.status == 'success'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
            window.location.href = "{{ $redirecturl }}"
            }, 2000);
          }
          if(data.status == 'error'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
          }
        },
        error :function( data ) {
          if( data.status === 422 ) {
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.responseJSON.message, 'error');
            $('.btn-success').removeAttr('disabled');
            var errors = [];
            errors = data.responseJSON.errors
            $.each(errors, function (key, value) {
              $('#'+key).parent().addClass('has-danger');
              $('#'+key).addClass('is-invalid');
              $('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
              $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
            })
          }
        }
      }); 
    });
  });
    </script>

@endpush
	
