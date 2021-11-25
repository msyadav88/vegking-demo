@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card mb-5">
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.auth.login_box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.auth.login.post'))->id('form_login_submit')->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                    }}
                                    <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <input type="hidden" name="seller_route" value="seller_route">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                                    {{ html()->password('password')
                                        ->class('form-control password')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                    }}
                                    <div class="notification-alert d-none">@lang('inner-content.frontend.password_rule')</div>
                                    <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="checkbox">
                                        {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group clearfix">
                                    {{ form_submit(__('labels.frontend.auth.login_button')) }}
                                </div><!--form-group-->
                            </div><!--col-->
                            <div class="col">
                                <div class="form-group clearfix">
                                    <button type="button" class="btn btn-success btn-md float-right" data-toggle="modal" data-target="#sellercontact_modal">@lang('labels.frontend.auth.register_button')</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-right">
                                    <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                {!! $socialiteLinks !!}
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card body-->
            </div><!--card-->
        </div><!-- col-md-8 -->
    </div><!-- row -->
@endsection

@push('after-scripts')
<script type="text/javascript">
   $('.password').focus(function(){
    $('.notification-alert').removeClass('d-none');
   });
 </script>
<!--<script type="text/javascript">
    $(document).ready(function() {
    $('#form_login_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('frontend.auth.login.post') }}",
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
            /*setTimeout(function(){
              window.location.href = "{{ route('admin.dashboard') }}";
            }, 2000);*/
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
</script>-->
 @endpush
