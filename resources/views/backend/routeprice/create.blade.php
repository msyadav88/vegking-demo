@extends('backend.layouts.app')
@section('title', 'Add Route Price :: ' . app_name())
@section('content')
  {{ html()->form('POST')->id('routepriceform')->class('form-horizontal')->open() }} 
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
              <h4 class="card-title mb-0">
                Add Route Price
                <small class="text-muted"></small>
              </h4>
          </div><!--col-->
        </div><!--row-->

        <hr>
        <div class="row mt-4 mb-4">
          <div class="col-md-6">
            <div class="form-group row">
              {{ html()->label('Country <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('country') }}
              <div class="col-md-10">
                <select class="select2 form-control" name="from_region">
                  <option value="">-</option>
                  @foreach($region as $r) 
                    <option value="{{$r->id}}">{{$r->region_name}}</option>
                  @endforeach
                </select>        
              </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group row">
            {{ html()->label('From <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('from') }}
            <div class="col-md-10">
              {{ html()->text('from')
                ->class('form-control')
                ->placeholder('From')
                ->attribute('maxlength', 191)
              }}
            </div><!--col-->  
          </div><!--form-group-->
        </div>
        <div class="col-md-6">
          <div class="form-group row">
            {{ html()->label('Country <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('country') }}
            <div class="col-md-10">
              <select class="select2 form-control" name="to_region">
                <option value="">-</option>
                  @foreach($region as $r) 
                    <option value="{{$r->id}}">{{$r->region_name}}</option>
                  @endforeach
              </select>        
            </div>
          </div>
        </div>
					
        <div class="col-md-6">
          <div class="form-group row">
            {{ html()->label('To <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('to') }}
            <div class="col-md-10">
              {{ html()->text('to')
                ->class('form-control')
                ->placeholder('To')
                ->attribute('maxlength', 191)
              }}
            </div>	 
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
          {{ html()->label('KMS <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('kms') }}
            <div class="col-md-10">
              {{ html()->text('kms')
                ->class('form-control')
                ->placeholder('KMS')
                ->attribute('maxlength', 191)
              }}
            </div>
          </div>
        </div>
					
        <div class="col-md-6">
          <div class="form-group row">
					{{ html()->label('Price <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('price') }}
						<div class="col-md-10">
							{{ html()->text('price')
								->class('form-control')
								->placeholder('Price')
								->attribute('maxlength', 191)
							}}
						</div><!--col-->
          </div>
        </div><!--form-group-->	
      </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer clearfix">
      <div class="row">
        <div class="col">
          {{ form_cancel(route('admin.routeprices.index'), __('buttons.general.cancel')) }}
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
        $('#routepriceform').on('submit', function(event) {
          event.preventDefault();
          var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('admin.routeprices.store') }}",
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
                      window.location.href = "{{ route('admin.routeprices.index') }}";
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