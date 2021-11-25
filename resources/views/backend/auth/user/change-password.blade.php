@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.change_password'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.change_password')</small>
                    </h4>

                    <div class="small text-muted">
                        @lang('labels.backend.access.users.change_password_for', ['user' => $user->name])
                    </div>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                        <div class="notification-alert d-none" >@lang('inner-content.frontend.password_rule')</div>
                            {{ html()->password('password')
                                ->class('form-control password')
                                ->placeholder( __('validation.attributes.backend.access.users.password'))
                                ->autofocus() }}
                                <div class="invalid-feedback"></div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

                        <div class="col-md-10">
                            {{ html()->password('password_confirmation')
                                ->class('form-control')
                                ->placeholder( __('validation.attributes.backend.access.users.password_confirmation'))
                            }}
                            <div class="invalid-feedback"></div>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@php  
    $url = route('admin.auth.user.change-password.post', $user);  
    $redirecturl = route('admin.auth.user.index');
@endphp
@endsection

@push('after-scripts')
<script type="text/javascript">
 
    $(document).ready(function() {

        $('.password').focus(function(){
            $('.notification-alert').removeClass('d-none');
        });

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $('#formsubmit').on('submit', function(event) {
            
            event.preventDefault();
            
            $('.has-danger').next().children().children().css({"border": ""});
            $('.is-invalid').removeClass("is-invalid");
            $('.invalid-feedback').html("");
            $('.has-danger').removeClass("has-danger");
            
            var formData = new FormData(this);

            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ $url }}",
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                },
                success: function(data)
                {
                    if(data.status == 'success'){
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function(){
                            window.location.href = "{{ $redirecturl }}";
                        }, 5000);
                    }
                    if(data.status == 'error'){
                        $('.btn-success').removeAttr('disabled');
                        Swal.fire('Error!', data.message, 'error');
                    }
                },
                error :function( data ) {
                    if( data.status === 422 ) {
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