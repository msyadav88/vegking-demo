@extends('backend.layouts.app')
@section('title', 'Add Carrier :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('carrierform')->class('form-horizontal')->open() }} 
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Add Carrier
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col-md-6">
						<div class="form-group row">
						   {{ html()->label('Name <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('name') }}
							<div class="col-md-10">
								{{ html()->text('name')
									->class('form-control')
									->placeholder('Name')
									->attribute('maxlength', 191)
									}}
							</div><!--col-->
							  
						</div><!--form-group-->
					</div>
					
					<div class="col-md-6">
						<div class="form-group row">
							{{ html()->label('Vat <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('vat') }}
							<div class="col-md-10">
								{{ html()->text('vat')
									->class('form-control')
									->placeholder('Vat')
									->attribute('maxlength', 191)
									}}
							</div>
							 
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group row">
						{{ html()->label('Country <span style="color:red">*</span>')->class('col-md-3 form-control-label')->for('variety') }}
						<div class="col-md-8">
							{{ html()->select('country')
								->class('select2 form-control')
								->options(country_list())
								->placeholder('-')
								->attribute('maxlength', 191)
							}}
						</div>
						</div>
					</div>
					
					 <div class="col-md-4">
						<div class="form-group row">
						{{ html()->label('City <span style="color:red">*</span>')->class('col-md-4 form-control-label')->for('city') }}
						<div class="col-md-8">
							{{ html()->text('city')
								->class('form-control')
								->placeholder('city')
								->attribute('maxlength', 191)
								}}
						</div>
						 </div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group row">
					{{ html()->label('Postal Code <span style="color:red">*</span>')->class('col-md-4 form-control-label')->for('postal_code') }}
						<div class="col-md-8">
							{{ html()->text('postal_code')
								->class('form-control')
								->placeholder('Postal Code')
								->attribute('maxlength', 191)
							}}
						</div><!--col-->
						</div>
					</div><!--form-group-->
					
					<div class="col-md-12 ">
						<div class="form-group row">
					  {{ html()->label(__('Address <span style="color:red">*</span>'))->class('col-md-1 form-control-label')->for('address') }}
					  <div class="col-md-11">
						<textarea name="address" id="address" class="form-control"></textarea>
					  </div><!--col-->
					  </div>
					</div><!--form-group-->
                </div><!--row-->
				
				<table class="table table-bordered" id="dynamicTable">  
				<h4>Carrier Contact</h4>
            <tr>
                <th>Type</th>
                <th>Contact Person Name <span style="color:red">*</span></th>
                <th>Email <span style="color:red">*</span></th>
                <th>Phone <span style="color:red">*</span></th>
                <th>Action</th>
            </tr>
            <tr>  
                <td>
				<select name="addmore[0][type]" class="form-control">
				<option value="p">Primary</option>
				<option value="a" disabled>Accounts</option>
				<option value="t" disabled>Transport</option>
				</select>
				</td>  
                <td><input type="text" name="addmore[0][personname]" id="addmore[0][personname]" placeholder="Enter Name" class="form-control" required></td>  
                <td><input type="text" name="addmore[0][email]" placeholder="Enter Email" class="form-control" required></td>  
                <td><input type="text" name="addmore[0][phone]" placeholder="Enter Phone" class="form-control" required></td>  
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
            </tr>  
        </table> 
				
				
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.carrier.index'), __('buttons.general.cancel')) }}
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
	
	 var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append('<tr><td><select name="addmore['+i+'][type]" class="form-control"><option value="p">Primary</option><option value="a">Accounts</option><option value="t">Transport</option></select></td><td><input type="text" name="addmore['+i+'][personname]" placeholder="Enter Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][email]" placeholder="Enter Email" class="form-control" /></td><td><input type="text" name="addmore['+i+'][phone]" placeholder="Enter Phone" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  

    $(document).ready(function() {
    $('#carrierform').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('admin.carrier.store') }}",
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
              window.location.href = "{{ route('admin.carrier.index') }}";
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