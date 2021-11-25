{{ html()->form('PATCH')->id('form_pass_update_submit')->class('form-horizontal')->open() }}
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}
                <div class="notification-alert d-none" >@lang('inner-content.frontend.password_rule')</div>
                {{ html()->password('old_password')
                    ->class('form-control password')
                    ->placeholder(__('validation.attributes.frontend.old_password'))
                }}
                <div class="invalid-feedback"></div>
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
  <input type="hidden" name="check_route" value="for_user">
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                <div class="notification-alert d-none" >@lang('inner-content.frontend.password_rule')</div>
                {{ html()->password('password')
                ->class('form-control password')
                    ->placeholder(__('validation.attributes.frontend.password'))
                     }}
                     <div class="invalid-feedback"></div>
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                     }}
                     <div class="invalid-feedback"></div>
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.password')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->form()->close() }}
@push('after-scripts')
     <script type="text/javascript">
    $(document).ready(function() {

      $('.password').focus(function(){
        $('.notification-alert').removeClass('d-none');
      });

    $('#form_pass_update_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('frontend.auth.password.update') }}",
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
            location.reload();
          }
          if(data.status == 'error'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.message, 'error');
            $('#old_password').val('');
            $('.password').val('');
            $('#password_confirmation').val('');
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
