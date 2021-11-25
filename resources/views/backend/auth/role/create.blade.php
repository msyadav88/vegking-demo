@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.create'). ' | ' . app_name())

@section('content')
{{ html()->form('POST')->id('form_role_submit')->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.roles.management')
                        <small class="text-muted">@lang('labels.backend.access.roles.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.roles.name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.roles.name'))
                                ->attribute('maxlength', 191)
                               
                                ->autofocus() }}
                                 <div class="invalid-feedback"></div>
                        </div><!--col-->
                    </div><!--form-group-->
                    @if(($groups))
                        @foreach($groups as $groupName=>$groupItems)
                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="permissions">{{$custom_group_names[$groupName]}}</label>
                            <div class="col-md-10">
                            <div class="row">
                                    @foreach($groupItems as $groupItemKey=>$groupItemName)
                                        <div class="col-md-3 checkbox d-flex align-items-center">
                                            {{ html()->label(
                                                    html()->checkbox('permissions[]', old('permissions') && in_array($groupItemName, old('permissions')) ? true : false, $groupItemName)
                                                          ->class('switch-input')
                                                          ->id('permission-'.$groupItemKey)
                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                ->for('permission-'.$groupItemKey) }}
                                            {{ html()->label(ucwords($groupItemName))->for('permission-'.$groupItemKey) }}
                                        </div>
                                    @endforeach
                            </div><!--col-->
                            </div><!--col-->
                        </div><!--form-group-->
                        @endforeach
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="permissions">Other Permissions</label>
                        <div class="col-md-10">
                        <div class="row">
                            @if(($permissionArr))
                                @foreach($permissionArr as $permissionName=>$permissionId)
                                    <div class="col-md-3 checkbox d-flex align-items-center">
                                        {{ html()->label(
                                                html()->checkbox('permissions[]', old('permissions') && in_array($permissionName, old('permissions')) ? true : false, $permissionName)
                                                      ->class('switch-input')
                                                      ->id('permission-'.$permissionId)
                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                            ->for('permission-'.$permissionId) }}
                                        {{ html()->label(ucwords($permissionName))->for('permission-'.$permissionId) }}
                                    </div>
                                @endforeach
                            @endif
                        </div><!--row-->
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.role.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
@push('after-scripts')
  <script type="text/javascript">
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#form_role_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('admin.auth.role.store') }}",
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
          $('.loading').addClass('loading_hide');
          if(data.status == 'success'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
              window.location.href = "{{ route('admin.auth.role.index') }}";
            }, 2000);
          }
          if(data.status == 'error'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
          }
        },
        error :function( data ) {
          $('.loading').addClass('loading_hide');
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