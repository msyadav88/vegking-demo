@extends('backend.layouts.app')
@section('title', 'Add Postal Code :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('form_postal_code_submit')->class('form-horizontal')->open() }} 
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Add Postal Code
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                          {{ html()->label('Name')->class('col-md-2 form-control-label')->for('name') }}
                            <div class="col-md-3">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder('Name')
                                    ->attribute('maxlength', 191)
                                    }}
                            </div><!--col-->
                              
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Type')->class('col-md-2 form-control-label')->for('type') }}
                            <div class="col-md-3">
                                {{ html()->select('type')
                                    ->class('select2 form-control')
                                    ->options(['city' => 'City', 'country' => 'Country'])
                                    ->attribute('maxlength', 191)
                                }}
                            </div>
                             
                        </div>

                        <div class="form-group row">
                            {{ html()->label('Country')->class('col-md-2 form-control-label')->for('variety') }}
                            <div class="col-md-3">
                                {{ html()->select('country')
                                    ->class('select2 form-control')
                                    ->options(country_list())
                                    ->placeholder('-')
                                    ->attribute('maxlength', 191)
                                }}
                            </div>
                        </div>

                        <div class="form-group row">
                        {{ html()->label('Postal Code')->class('col-md-2 form-control-label')->for('postal_code') }}
                            <div class="col-md-3">
                                {{ html()->text('postal_code')
                                    ->class('form-control')
                                    ->placeholder('Postal Code')
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Postal Code Short')->class('col-md-2 form-control-label')->for('postal_code_short') }}
                            <div class="col-md-3">
                                {{ html()->text('postal_code_short')
                                    ->class('form-control')
                                    ->placeholder('Postal Code Short')
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Country Code')->class('col-md-2 form-control-label')->for('code') }}
                            <div class="col-md-3">
                                {{ html()->text('code')
                                    ->class('form-control')
                                    ->placeholder('Code')
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label('Phone Code')->class('col-md-2 form-control-label')->for('ph_code') }}
                            <div class="col-md-3">
                                {{ html()->text('ph_code')
                                    ->class('form-control')
                                    ->placeholder('Phone Code')
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                          {{ html()->label(__('Price'))->class('col-md-2 form-control-label')->for('price') }}
                          <div class="col-md-3">
                            <input type="number" name="price" value="0" data-decimals="2" step="0.1"/>
                          </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.products.index'), __('buttons.general.cancel')) }}
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
    $('#form_postal_code_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('admin.postalcodes.store') }}",
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
              window.location.href = "{{ route('admin.postalcodes.index') }}";
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