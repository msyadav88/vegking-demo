@extends('backend.layouts.app')

@section('title', __('strings.backend.import_seller.title') . ' :: ' .app_name())

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.import_seller.title')</strong>
                </div><!--card-header-->
                <div class="card-body">
                  <form role="form" id="seller_scrape_form">
                    <div class="row">
                      <div class="col-md-6">
                          <input type="text" value="" name="seller_scrape_url" id="seller_scrape_url" class="form-control" placeholder="Scrape Url" /> 
                      </div>
                      <div class="col-md-6">
                          <a href="javascript:void(0);" id="importBtn" class="btn btn-primary">@lang('strings.backend.import_seller.title')</a>
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
                    <strong>{{ __('Seller Import using Excel') }}</strong>
                </div><!--card-header-->
                <div class="card-body">
                  <form role="form" id="seller_excelupload_form" method="POST" enctype="multipart/form-data" action="{{ route('admin.import_parse') }}" onsubmit='return false'>
                    <div class="row">
                      <div class="col-md-1">
                        <label>Product</label>
                      </div>
                      <div class="col-md-2">
                        <input type="hidden" name="file_upload" id="file_upload" value="1">
                        <select name='product_id' id='product_id'>
                        @foreach( $products_all_arr as $product )
                        <option value="{{$product['id']}}">{{$product['name']}}</option>
                        @endforeach
                        </select>
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
            <div class="card d-none" id="xl_mapper" >
                <div class="card-header">
                    <strong>{{ __('Seller excel columns mapping') }}</strong>
                </div><!--card-header-->
                <div class="card-body">
                  <form role="form" id="seller_columnmap" method="POST" enctype="multipart/form-data" action="{{ route('admin.import_seller_parse') }}" onsubmit='return false'>
                    <input type="hidden" name="xl_path" id="xl_path" value="">
                    <input type="hidden" name="file_upload" id="file_upload" value="0">
                    <input type="hidden" name="product_id" id="product_id_mapping" value="">
                    <div class="row">
                      <div class="col-md-12" id="mapper_columns">
                      </div>
                      <div class="col-md-6">
                        {{ html()->label(
                          html()->checkbox('update_current')
                          ->class('switch-input')
                          ->id('update_current')
                          ->value('1')
                          . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                          ->class('switch switch-label switch-pill switch-success mr-2 float-left')
                        }}
                        {{ html()->label( __('Update Existing?') )->for('update_current')->class('flex-1') }}
                      </div>
                      <div class="col-md-6 text-right">
                        <button id="mapped_data" class="btn btn-primary">
                                @lang("Import Excel Records") 
                        </button><span id="import-process" class="d-none"><img src="{{url('/img/loading.gif')}}" alt="Image" width="24px" height="24px" /></span>
                        
                    </div>
                    <div class="info mt-2" id="import_msg"></div>
                  </form>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
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

  $("#importBtn").click(function() {
      form_values = $("#seller_scrape_form").serialize();
      console.log(form_values);
      $.ajax({
        url: "{{ route('admin.seller_import_scrape') }}",
        method: "GET",
        data: form_values,
        success: function(json_data) {
          console.log( json_data );
        }
      });
  });

    $("#import_file").click(function() {
      $("#import_file").attr('disabled','disabled');
      $("#upload-process").removeClass('d-none');


      var form_values = new FormData($("#seller_excelupload_form")[0]);
      console.log(form_values);
      $.ajax({
        url: "{{ route('admin.import_seller_parse') }}",
        method: "POST",
        data: form_values,
        contentType:false,
        success: function(json_data) {
          $("#import_file").removeAttr('disabled','disabled');
          $("#upload-process").addClass('d-none');
          if( json_data.error == 1 ){
//            alert(file_upload_error);
            Swal.fire('Error!', json_data.msg , 'error');
            return;
          }
          console.log( json_data );
          console.log( json_data.xl_path );
          var product_columns_excel_arr =json_data.product_columns_excel_arr;
          var product_specifications_arr =json_data.product_specifications_arr;
          var users_column_arr =json_data.users_column_arr;
          var sellers_column_arr =json_data.sellers_column_arr;
          var xl_path =json_data.xl_path;
          xl_column_option = '<option>Select</option><option value="--skip--">Skip</option>';
          for ( i in product_columns_excel_arr ) {
            if( product_columns_excel_arr[i] != 'null' && product_columns_excel_arr[i] != null ){
              xl_column_option = xl_column_option + '<option value="'+product_columns_excel_arr[i]+'">'+product_columns_excel_arr[i]+'</option>';
//              $("#mapper_columns").append('<div>'+xl_column+column_mapper_dd+'</div>');
  //            $("#product_list").append("<option value='" + json_data[i] + "'>" + json_data[i] + "</option>");
            }
          }
          user_options = '';
          seller_options = '';
          product_pref_options = '';
          all_option='';

          for(  j in users_column_arr ){
            users_column_str = _sanitize_me( users_column_arr[j] );
            user_options = user_options + '<div class="col-md-6 mb-1" >'+ users_column_str +': <select class="mapper-select" name="users_table['+users_column_arr[j]+']">'+xl_column_option+'</select></div>';

          }
          //console.log(user_options);
          for(  j in sellers_column_arr ){
            seller_column_str = _sanitize_me( sellers_column_arr[j] );
            seller_options = seller_options  + '<div class="col-md-6  mb-1">'+seller_column_str+': <select class="mapper-select" name="sellers_table['+sellers_column_arr[j]+']">'+xl_column_option+'</select></div>';

          }
          //console.log(seller_options);
          /*for( j in product_specifications_arr ){
            spec_column_str = _sanitize_me( product_specifications_arr[j].display_name );

            product_pref_options = product_pref_options + '<div class="col-md-6 mb-1">'+spec_column_str +': <select class="mapper-select" name="specification_table['+product_specifications_arr[j].id+']">'+xl_column_option+'</select></div>';

          }*/
          console.log(product_specifications_arr);
          console.log(product_pref_options);
          
          all_option = all_option + '<div class="row"> <h2 class="col-lg-12 mb-2 mt-2">Select For User table</h2><br />'+user_options+" </div> \n"+'<div class="msgs" id="user_error"></div>';
          all_option = all_option + '<hr><div class="row"><h2 class="col-lg-12 mb-2 mt-2">Select For Seller table</h2><br />'+seller_options+"</div> \n"+'<div class="msgs" id="seller_error"></div>';
          //all_option = all_option + '<hr><div class="row"><h2 class="col-lg-12 mb-2 mt-2">Select for specification</h2> <br />'+product_pref_options+'</div> \n<div class="msgs" id="spec_error"></div>';

          $("#mapper_columns").html("");
          $("#mapper_columns").append('<div>'+all_option+'</div>'); 

          $("#product_id_mapping").val( $("#product_id").val() );
          $("#xl_path").val( xl_path );
          $("#xl_mapper").removeClass('d-none');

          $(".mapper-select").select2();
          
        },
        cache: false,
        processData: false
      });
  });
          function _sanitize_me( str_to_santize ){
            str_to_santize_str = str_to_santize.replace("_"," ");
            str_to_santize_str_first = str_to_santize_str.charAt( 0 );
            str_to_santize_str = str_to_santize_str_first.toUpperCase() + str_to_santize_str.slice(1);
            return str_to_santize_str;
          }

  $("#mapped_data").click( function(){
    $("#mapped_data").attr('disabled','disabled');
    $("#import-process").removeClass('d-none');
    var form_values = new FormData($("#seller_columnmap")[0]);
      console.log(form_values);
      $.ajax({
        url: "{{ route('admin.import_seller_parse') }}",
        method: "POST",
        data: form_values,
        contentType:false,
        success: function(json_data) {
          $("#mapped_data").removeAttr('disabled');
          $("#import-process").addClass('d-none');
          console.log( json_data );
          $("#import_msg").html("");
          msg = '';
          err_msg = '';
          for( j in json_data['record_created_result'] ){
            if( json_data['record_created_result'][j]['error'] == 0 ){
              if( msg != '' ){
                msg = msg+'<br />';
              }
              for( inde in json_data['record_created_result'][j] ){
                console.log(inde);
               // console.log(json_data.inde)
                if( inde != 'error' ){
                  msg = msg + inde+' '+json_data['record_created_result'][j][inde];
                }
              }
            }
            else{
              for( inde in json_data['record_created_result'][j] ){
                console.log(inde);
               // console.log(json_data.inde)
                if( inde != 'error' ){
                  console.log("in if");
                  if( err_msg != '' ){
                    err_msg = err_msg+'<br />';
                  }
                  err_msg = err_msg + json_data['record_created_result'][j][inde];
                }
              }
            }
          }
          $("#import_msg").html('');
          if( msg != '' ){
            $("#import_msg").append('<div class="alert alert-success">'+msg+'</div>');
          }
          if( err_msg != '' ){
            $("#import_msg").append('<div class="alert alert-danger">'+err_msg+'</div>');
          }
        },

        cache: false,
        processData: false
      });
  });
});

</script>
@endpush