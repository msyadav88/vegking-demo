@extends('backend.layouts.app')
 @php if(!empty($currencyrate->id))
   $titlename= 'Edit Currency Rate';
    else
    $titlename= 'Add Currency Rate';
@endphp

@section('title', ''.$titlename.' :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('form_currency_rate_submit')->class('form-horizontal')->open() }}
    @if(!empty($currencyrate->id))
      <input type="hidden" name="_method" value="PUT">
    @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                                @if(!empty($currencyrate->id))
                                Edit Currency Rate
                                @else
                                Add Currency Rate
                                @endif
                          
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">

                        <div class="form-group row">
                        {{ html()->label(__('From <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name') }}
                            <div class="col-md-10">
                                {{ html()->text('from')
                                    ->class('form-control')
                                    ->placeholder('From')
                                    ->value(@$currencyrate->from)
                                    ->attribute('maxlength', 191)
                                }}
                                   <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                        {{ html()->label(__('To <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name') }}
                            <div class="col-md-10">
                                {{ html()->text('to')
                                    ->class('form-control')
                                    ->placeholder('To')
                                    ->value(@$currencyrate->to)
                                    ->attribute('maxlength', 191)
                                   }}
                                      <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                        {{ html()->label(__('Rate <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name') }}
                            <div class="col-md-10">
                                {{ html()->text('rate')
                                    ->class('form-control')
                                    ->placeholder('Rate')
                                    ->value(@$currencyrate->rate)
                                    ->attribute('maxlength', 191)
                                   }}
                                      <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>

                          
                       

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.currencyrates.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                     @if(!empty($currencyrate->id))
                     {{ form_submit(__('buttons.general.crud.update')) }}
                     @else
                     {{ form_submit(__('buttons.general.crud.create')) }}
                     @endif
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
@push('after-scripts')
  <script type="text/javascript">
    $(document).ready(function() {
    $('#form_currency_rate_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ (!empty($currencyrate->id) ? route('admin.currencyrates.update', $currencyrate->id) : route('admin.currencyrates.store')) }}",
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
              window.location.href = "{{ route('admin.currencyrates.index') }}";
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
