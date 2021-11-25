git @extends('backend.layouts.app')

@section('title', __('strings.backend.import_product.title') . ' :: ' .app_name())

@section('content')
    

     <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Product Import using Excel') }}</strong>
                </div><!--card-header-->
                <div class="card-body">
                  <form role="form" id="product_excelupload_form" method="POST" enctype="multipart/form-data" action="{{ route('admin.import_parse') }}" onsubmit='return false'>
                    <div class="row">
                     
                      <div class="col-md-2">
                        <input type="hidden" name="file_upload" id="file_upload" value="1">
                      </div>
                      <div class="col-md-5">
                        {{ csrf_field() }}
                         <div class="col-md-10">
                            <div class="form-group">
                            <div class="input-group input-file" name="csv_file" id="csv_file">
                              <span class="input-group-prepend">
                                <button class="btn btn-info btn-choose" type="button">Choose</button>
                              </span>
                              <input type="text" class="form-control" placeholder='Choose a file...' />
                              <span class="input-group-append">
                                <button class="btn btn-danger btn-reset" type="button">Reset</button>
                              </span>
                            </div>
                            </div>
                            </div>
                          <!--/select-->
                      </div>
                      <div class="col-md-4">
                        <button id="import_file" class="btn btn-primary">
                                @lang("Import Excel") 
                        </button>
                        <span id="upload-process" class="d-none">
                        <img src="{{url('/img/loading.gif')}}" alt="Image" width="24px" height="24px" />
                      </span>
                      
                      </div>
                    </div>
                  </form>
                </div><!--card-body-->
            </div><!--card-->
          
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('Add Manually')</strong>
                </div><!--card-header-->
                <div class="card-body">
                  <form role="form" id="seller_scrape_form">
                    <div class="row">
                    
                      <div class="col-md-5">
                      <input type="hidden" name="file_upload" id="file_upload" value="0">
                      
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                               
                               <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#productvariety_modal" value="ADD Manually">
                                 @lang("ADD Manually") 
                                </button>
                                <span id="upload-process" class="d-none">
                                    <img src="{{url('/img/loading.gif')}}" alt="Image" width="24px" height="24px" />
                                </span>
                            </div>  
                      </div>
                    </div>
                  </form>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
 
<!-- add manually product model  -->
<div class="modal fade" id="productvariety_modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     {{ html()->form('POST', route('admin.saveProductVariety'))->id('productvariety_form')->open() }}

      <div class="modal-header">
      <h3 class="modal-title-1">@lang('Add Product Variaty')</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <div class="card">
                <div class="card-body">

                <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.product'))->for('product') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->select('product_id')
                                      ->class('select2 form-control')
                                      ->attribute('maxlength', 191)
                                      ->options($products)
                                      ->placeholder('Choose Product')
                                    }}
                                    <div class="invalid-feedback"></div>
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.url'))->for('URL') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('URL')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.url'))
                                    }}
                                    <div class="invalid-feedback"></div>
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.higher_taxon'))->for('higher_taxon') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('higher taxon')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.higher_taxon'))
                                    }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.genus'))->for('genus') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('genus')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.genus'))
                                    }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.species'))->for('species') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('species')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.species'))
                                    }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.parentage'))->for('parentage') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('parentage')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.parentage'))
                                    }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.breeder'))->for('breeder') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('breeder')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.breeder'))
                                    }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.variety_popup.species'))->for('breeder_agent') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->text('breeder_agent')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.variety_popup.breeder_agent'))
                                    }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                       
                        <div class="row">
                            <div class="col">
                            <div class="form-group row">
                          {{ html()->label('Status')->class('col-md-2 form-control-label')->for('status') }}
                          <div class="col-md-10">
                            <div class="checkbox d-flex align-items-center">
                                {{ html()->label(
                                        html()->checkbox('status',  1, '1')
                                        ->class('switch-input variety_check')
                                        ->id('status')
                                        . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                        ->class('switch switch-label switch-pill switch-success mr-2')
                                        ->for('status') 
                                    }}

                              </div>
                            </div>
                        </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('inner-content.frontend.variety_popup.add')) }}
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

@endsection


@push('after-scripts')
<script type="text/javascript">
  $(document).ready(function(){

    $("#product_id").select2();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#productvariety_modal').on('submit', function(event) {
        event.preventDefault();
        form_values = $("#productvariety_form").serialize();
       

        $.ajax( {
          url: "{{ route('admin.saveProductVariety') }}",
				method: 'POST',
				data: form_values,
				beforeSend: function(){
				$('.loading').removeClass('loading_hide');
				},
				success: function(json_data) {
          $("#productvariety_modal").modal("hide");
					if( json_data.status == "success" ){
						$('.loading').addClass('loading_hide');
						Swal.fire(json_data.message , json_data.message, 'success');
					}
				},
				error: function(data) {
					
                if (data.status === 422) {
					$('.loading').addClass('loading_hide');
                    Swal.fire('Error!', data.responseJSON.message, 'error');
                    $('.btn-success').removeAttr('disabled');
                    var errors = [];
                    errors = data.responseJSON.errors
                    $.each(errors, function(key, value) {
                        $('#' + key).parent().addClass('has-danger');
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).parent('.has-danger').find('.invalid-feedback').html(value);
                        $('#' + key).next().children().children().css({
                            "border": "1px solid #f86c6b"
                        });
                    })
                }
            }
			});
    });
 
    $("#import_file").click(function() {
      $("#import_file").attr('disabled','disabled');
      $("#upload-process").removeClass('d-none');


      var form_values = new FormData($("#product_excelupload_form")[0]);
      console.log(form_values);
      $.ajax({
        url: "{{ route('admin.import_product_parse') }}",
        method: "POST",
        data: form_values,
        contentType:false,
        success: function(json_data) {
          $("#import_file").removeAttr('disabled','disabled');
          $("#upload-process").addClass('d-none');
          if( json_data.error == 1 ){
            Swal.fire('Error!', json_data.msg , 'error');
            return;
          }
        },
        cache: false,
        processData: false
      });
  });

  $('body').on('click', '.variety_check', function(){
    alert(this.checked);
        if(this.checked){
            $(this).val(1);
            $(this).attr('checked','checked');
        }else{
            $(this).val(0);
            $(this).removeAttr('checked');
        }
    })
 
});

</script>
@endpush