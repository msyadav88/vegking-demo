<div class="modal fade" id="camera_modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ html()->form('POST',url('savecard'))->id('camera_register')->open() }}
                <input type="hidden" name="user_roles" id="user_roles" value="">
                <input type="hidden" name="image" id='image' class="image-tag">
                <div class="modal-header">
                    <h3 class="modal-title-1"><img src="{{asset('img/vegking-logo-heading.png')}}"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h4 class="modal-title" id="favoritesModalLabel">{{ __('inner-content.frontend.sell_popup.takephoto') }}</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="my_camera" style="width: auto; height: auto;"></div>
                                        </div>
                                    </div>
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="results"><img src="{{asset('img/business-card.png')}}" class="center"/></div>
                                        </div>
                                    </div>
                                </div><!--col-->
                            </div><!--row-->
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 clearfix">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="{{ url('/') }}" name="Cancel Photo" class="btn btn-danger">Cancel</a>
                                            </div>
                                            <div class="col-md-4">
                                                <button name="Take Photo" class="btn btn-primary" type="button" id="takesnapshot">{{ __('inner-content.frontend.sell_popup.takephoto') }}</button>
                                            </div>
                                            <div class="col-md-4">
                                                {{ form_submit(__('inner-content.frontend.sell_popup.submit')) }}
                                            </div>
                                        </div>
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->
                        </div><!--card-body-->
                    </div><!--card-->
                </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
<style type="text/css">
    .loading {
    z-index: 99999999 !important;
}
#camera_modal .select2-container{
  width: 100% !important;
}
#my_camera {
	width: auto !important;
	height: auto !important;
}
</style>
<script type="text/javascript">
    $('#camera_register').on('submit', function(event) {
        event.preventDefault();
        if($('#image').val() == ''){
            Swal.fire('Error!', 'Please take picture first', 'error');
            return false;
        }
		var img = $(".image-tag").val();
		
        $('#camera_register .has-danger').next().children().children().css({"border": ""});
        $('#camera_register .is-invalid').removeClass("is-invalid");
        $('#camera_register .invalid-feedback').html("");
        $('#camera_register .has-danger').removeClass("has-danger");
        var formData = new FormData(this);
        $.ajax({
            url: this.action,
            method: "post",
            dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,
            data: formData,
            beforeSend: function(){
                $('.loading').removeClass('loading_hide');
            },
		}).done(function(response){
            $('.loading').addClass('loading_hide');
            if(response.status == 'success'){
                Swal.fire({title:'Congrats!', text:'Card Send to Team Successfully', type:'success'}).then(function(){
                    window.location.href = "{{route('admin.bizcards')}}";
                });
            }
           // alert(response.message);
            // show_notification(response.status,response.message);
        }).fail(function(jqXHR, textStatus){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', jqXHR.responseJSON.message, 'error');
            callTracker();
            if( jqXHR.status === 422 ) {
                $('.btn-success').removeAttr('disabled');
                var errors = [];
                errors = jqXHR.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('.'+key).parent().addClass('has-danger');
                    $('.'+key).addClass('is-invalid');
                    $('.'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                    $('.'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                })
            }else{
                Swal.fire('Error!', 'Some error occured. Please try again.', 'error');
            }
        }).always(function(){
            $("#camera_register .btn.btn-success").removeAttr('disabled');
        });

    });

</script>
@push('after-styles')
   <link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">
   <style type="text/css">
   #camera_modal .select2.select2-container {
      width: 100% !important;
   }
   </style>
@endpush