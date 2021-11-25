@extends('backend.layouts.app')
@section('title', 'Edit Transport Country Price :: ' . app_name())
@section('content')
  {{ html()->form('POST')->id('transPriceform')->class('form-horizontal')->open() }}
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">
              Edit Transport Country Price
              <small class="text-muted"></small>
            </h4>
          </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
          <div class="col-md-8 offset-2">
            <div class="form-group row">
              {{ html()->label('Country <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('country') }}
              <div class="col-md-10">
                {{ html()->select('country')
                  ->class('select2 form-control')
                  ->options(country_list())
                  ->placeholder('-')
                  ->attribute('maxlength', 191)
                  ->value($tran_price->country)
                }}
              </div>      
            </div><!--form-group-->
          </div>
          <div class="col-md-8 offset-2">
            <div class="form-group row">
              {{ html()->label('Region Name <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('country') }}
              <div class="col-md-10">
                <select class="select2 form-control" name="region">
                  <option value="">-</option>
                  @foreach($region as $r) 
                    @if($r->id==$tran_price->region_id)
                      <option value="{{$r->id}}" selected>{{$r->region_name}}</option>
                    @else
                      <option value="{{$r->id}}">{{$r->region_name}}</option>
                    @endif
                  @endforeach
                </select>        
              </div>
            </div>
          </div>
          <div class="col-md-8 offset-2">
            <div class="form-group row">
              {{ html()->label('Price Per KM <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('pricePerKm') }}
              <div class="col-md-10">
                {{ html()->text('pricePerKm')
                  ->class('form-control')
                  ->placeholder('Price Per KM ')
                  ->attribute('maxlength', 191)
                  ->value($tran_price->pricePerKm)
                }}
              </div>
            </div>
          </div>
        </div><!--row-->
      </div><!--card-body-->
      <div class="card-footer clearfix">
        <div class="row">
          <div class="col">
            {{ form_cancel(route('admin.transportprice.index'), __('buttons.general.cancel')) }}
          </div><!--col-->
          <div class="col text-right">
            {{ form_submit(__('buttons.general.crud.update')) }}
          </div><!--col-->
        </div><!--row-->
      </div><!--card-footer-->
  </div><!--card-->
{{ html()->form()->close() }}
@endsection
@push('after-scripts')
 <script type="text/javascript">
    $(document).ready(function() {
    $('#transPriceform').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('admin.transportprice.update', $tran_price->id) }}",
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
              window.location.href = "{{ route('admin.transportprice.index') }}";
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
