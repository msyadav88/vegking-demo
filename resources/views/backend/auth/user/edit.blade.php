@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'). ' | ' . app_name())

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
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.name'))->class('col-md-2 form-control-label')->for('first_name') }}
                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.name'))
                                ->value(@$user->first_name.' '.@$user->last_name)
                                ->attribute('maxlength', 191)
                            }}
                            <div class="invalid-feedback"></div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <!--<div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}
                        <div class="col-md-10">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->value(@$user->last_name)
                                ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                ->attribute('maxlength', 191)
                            }}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>--><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->value(@$user->email)
                                ->placeholder(__('validation.attributes.backend.access.users.email'))
                                ->attribute('maxlength', 191)
                            }}
                            <div class="invalid-feedback"></div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.phone'))->class('col-md-2 form-control-label')->for('phone') }}
                        <div class="col-md-10">
                            {{ html()->number('phone')
                                ->class('form-control')
                                ->value(@$user->phone)
                                ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
                                ->attribute('maxlength', 191)
                            }}
                            <div class="invalid-feedback"></div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="table-responsive col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        <th>@lang('labels.backend.access.users.table.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox d-flex align-items-center">
                                                                {{ html()->label(
                                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                                                ->class('switch-input')
                                                                                ->id('role-'.$role->id)
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                    ->for('role-'.$role->id) }}
                                                                {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($role->id != 1)
                                                                @if($role->permissions->count())
                                                                    @foreach($role->permissions as $permission)
                                                                        <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                                    @endforeach
                                                                @else
                                                                    @lang('labels.general.none')
                                                                @endif
                                                            @else
                                                                @lang('labels.backend.access.users.all_permissions')
                                                            @endif
                                                        </div>
                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($permissions->count())
                                                @foreach($permissions as $permission)
                                                    <div class="checkbox d-flex align-items-center">
                                                        {{ html()->label(
                                                                html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
                                                                        ->class('switch-input')
                                                                        ->id('permission-'.$permission->id)
                                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                                            ->for('permission-'.$permission->id) }}
                                                        {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
{{ html()->closeModelForm() }}
@php 
    $url =  route('admin.auth.user.update', $user->id);
    $redirecturl = route('admin.auth.user.index');
@endphp
@endsection


@push('after-scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $(document).ready(function() {
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
                 $('.loading').removeClass('loading_hide');
                },
                success: function(data)
                {
                    if(data.status == 'success'){
                      $('.loading').addClass('loading_hide');
                    Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function(){
                            window.location.href = "{{ $redirecturl }}"; 
                        }, 5000);
                    }
                    if(data.status == 'error'){
                        Swal.fire('Error!', data.message, 'error');
                        $('.btn-success').removeAttr('disabled');
                    }
                },
                error :function( data ) {
                    $('.loading').addClass('loading_hide');
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
