@extends('backend.layouts.app')

@if($createfrom == 'add seller')
    @section('title',  __('Add Seller').' :: '.app_name())
@else
	@section('title', __('Edit Seller ').' :: '.app_name())
@endif

@section('content')

{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
		@if($createfrom == 'add seller')
		  Add Seller
		@else
		  Edit Seller
		@endif
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->
    <hr>
    <div class="row mt-4 mb-4">
      <div class="col">

        <div class="form-group row">
          {{ html()->label('<strong>Username</strong> <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('username') }}
          <div class="col-md-10">
            {{ html()->text('username')
            ->class('form-control')
            ->placeholder('Username')
            ->value(@$seller->username)
            ->attribute('maxlength', 191) 
            ->attribute('id', 'username') }}
			<div class="invalid-feedback"></div>
          </div><!--col-->
        </div><!--form-group-->
    
      <div class="form-group row">
          {{ html()->label('<strong>Nickname</strong> <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('nickname') }}
          <div class="col-md-10">
            {{ html()->text('nickname')
            ->class('form-control')
            ->placeholder('Nickname')
            ->value(@$seller->nickname)
            ->attribute('maxlength', 191) 
            ->attribute('id', 'nickname') }}
			<div class="invalid-feedback"></div>
          </div><!--col-->
        </div><!--form-group-->


        <div class="form-group row">
		  {{ html()->label('<strong>Company</strong>')->class('col-md-2 form-control-label')->for('company_name') }}
		  <div class="col-md-10">
			<div class="row">
			  <div class="col-md-3">
				<div class="form-group">
                {{ html()->label('Company')->class('form-control-label')->for('company') }}
				{{ html()->text('company')->value(@$seller->company)->class('form-control')->placeholder('Company Name')->attribute('maxlength', 191) }}
				</div>
			  </div><!--col-->
			  <div class="col-md-3">
				<div class="form-group">
                 {{ html()->label('Vat')->class('form-control-label')->for('vat') }}
				{{ html()->text('vat')->class('form-control')->value(@$seller->vat)->placeholder('Company VAT')->attribute('maxlength', 191) }}
				</div>
			  </div>
           <div class="col-md-3">
              <div class="form-group">
                {{ html()->label('Trust Level')->class('form-control-label')->for('trust_level') }}
                  <select name="trust_level" class="select2 form-control" data-placeholder="Trust Level" >
                     <option></option>
                  @foreach(trustlevel_list() as $key => $value)
                     @php
                     $tmp = explode('@',$value->desc);
                     $label = $value->name.' - '. @$tmp[0] @endphp
                     <option value="{{$value->id}}" @if($value->id==@$seller->trust_level) selected @endif>{{$label}}</option>
                  @endforeach
				  </select>
				  <div class="invalid-feedback"></div>
              </div>
            </div><!--col-->
			</div><!--form-group-->
		  </div>
		</div>
		<!-- contact preference -->
		<div class="form-group row">
	
          	{{ html()->label('<strong>Contact Preference</strong>')->class('col-md-2 form-control-label')->for('Contact_us') }}
		
			<div class="col-md-3">
				<div class="checkbox d-flex align-items-center">
				@if(@$seller->contact_email == 1)    
                      @php $active = '1' @endphp
                  @else
                      @php $active = '0' @endphp
                  @endif
				{{ html()->label(
					html()->checkbox('contact_email',$active,$active)
					->class('switch-input contact_email')
					->id('contact_email')
					. '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
					->class('switch switch-label switch-pill switch-success mr-2')
					->for('contact_email') 
				}}
				{{ html()->label('Email')->for('contact_email')->id('contact_email')->class('flex-1') }}
				</div>
			</div>
			<div class="col-md-3">
				<div class="checkbox d-flex align-items-center">
				@if(@$seller->contact_sms == 1)    
                      @php $active = '1' @endphp
                  @else
                      @php $active = '0' @endphp
                  @endif
				{{ html()->label(
					html()->checkbox('contact_sms', $active,$active)
					->class('switch-input contact_sms')
					->id('contact_sms')
					. '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
					->class('switch switch-label switch-pill switch-success mr-2')
					->for('contact_sms') 
				}}
				{{ html()->label('SMS')->for('contact_sms')->id('contact_sms')->class('flex-1') }}
				</div>
			</div>
			<div class="col-md-3">
				<div class="checkbox d-flex align-items-center">
				@if(@$seller->contact_whatsapp == 1)    
                      @php $active = '1' @endphp
                  @else
                      @php $active = '0' @endphp
                  @endif
				{{ html()->label(
					html()->checkbox('contact_whatsapp', $active,$active)
					->class('switch-input contact_whatsapp')
					->id('contact_whatsapp')
					. '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
					->class('switch switch-label switch-pill switch-success mr-2')
					->for('contact_whatsapp') 
				}}
				{{ html()->label('Whatsapp')->for('contact_whatsapp')->id('contact_whatsapp')->class('flex-1') }}
				</div>
			</div>
	  	</div>
    @php
    $seller2_contact = json_decode(@$seller->seller2_contact);
    $transport_contact = json_decode(@$seller->transport_contact);
    $accounts_contact = json_decode(@$seller->accounts_contact);
    @endphp
        <div class="form-group row">
			{{ html()->label('<strong>Seller 1 Contact Info</strong>')->class('col-md-2 form-control-label')->for('name') }}

			<div class="col-md-10">
			  <div class="row">
				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Phone <small><i>(with county code)</i></small><span style="color:red">*</span> ')->class('form-control-label')->for('phone') }}
					{{ html()->number('phone')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
					  ->attribute('maxlength', 191)
            ->value(@$seller->phone)

					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Name')->class('form-control-label')->for('name') }}
					{{ html()->text('name')
					  ->class('form-control')
					  ->placeholder('Name')
					  ->attribute('maxlength', 191)
					  ->value(@$seller->name)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('E-mail Address')->class('form-control-label')->for('email') }}
					{{ html()->email('email')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.email'))
					  ->attribute('maxlength', 191)
            		  ->value(@$seller->email)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

			  </div>
			</div><!--col-->
		  </div><!--form-group-->
		  <!--Seller 1-->
		  <div class="form-group row">
			{{ html()->label('<strong>Seller  2 Contact Info </strong>')->class('col-md-2 form-control-label')->for('seller2_contact_phone') }}
			<div class="col-md-10">
			  <div class="row">
				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Phone <small><i>(with county code)</i></small>')->class('form-control-label')->for('seller2_contact_phone') }}
					{{ html()->text('seller2_contact[phone]')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
					  ->attribute('maxlength', 191)
            		  ->value(@$seller2_contact->phone)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Name')->class('form-control-label')->for('seller2_contact_name') }}
					{{ html()->text('seller2_contact[name]')
					  ->class('form-control')
					  ->placeholder('Name')
					  ->attribute('maxlength', 191)
            		  ->value(@$seller2_contact->name)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('E-mail Address')->class('form-control-label')->for('seller2_contact_email') }}
					{{ html()->email('seller2_contact[email]')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.email'))
					  ->attribute('maxlength', 191)
            		  ->value(@$seller2_contact->email)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

			  </div>
			</div><!--col-->
		  </div><!--form-group-->
		  <!--Transport-->
		  <div class="form-group row">
			{{ html()->label('<strong>Transport Contact Info</strong>')->class('col-md-2 form-control-label')->for('transport_contact_phone') }}
			<div class="col-md-10">
			  <div class="row">
				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Phone <small><i>(with county code)</i></small>')->class('form-control-label')->for('transport_contact_phone') }}
					{{ html()->text('transport_contact[phone]')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
					  ->attribute('maxlength', 191)
            		  ->value(@$transport_contact->phone)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Name')->class('form-control-label')->for('transport_contact_name') }}
					{{ html()->text('transport_contact[name]')
					  ->class('form-control')
					  ->placeholder('Name')
					  ->attribute('maxlength', 191)
            		  ->value(@$transport_contact->name)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('E-mail Address')->class('form-control-label')->for('transport_contact_email') }}
					{{ html()->email('transport_contact[email]')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.email'))
					  ->attribute('maxlength', 191)
            		  ->value(@$transport_contact->email)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

			  </div>
			</div><!--col-->
		  </div>
		   <!--Accounts-->
		  <div class="form-group row">
			{{ html()->label('<strong>Accounts Contact Info</strong>')->class('col-md-2 form-control-label')->for('accounts_contact_phone') }}

			<div class="col-md-10">
			  <div class="row">
				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Phone <small><i>(with county code)</i></small>')->class('form-control-label')->for('accounts_contact_phone') }}
					{{ html()->text('accounts_contact[phone]')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
					  ->attribute('maxlength', 191)
        			  ->value(@$accounts_contact->phone)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('Name')->class('form-control-label')->for('accounts_contact_name') }}
					{{ html()->text('accounts_contact[name]')
					  ->class('form-control')
					  ->placeholder('Name')
					  ->attribute('maxlength', 191)
            		  ->value(@$accounts_contact->name)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					{{ html()->label('E-mail Address')->class('form-control-label')->for('accounts_contact_email') }}
					{{ html()->email('accounts_contact[email]')
					  ->class('form-control')
					  ->placeholder(__('validation.attributes.backend.access.users.email'))
					  ->attribute('maxlength', 191)
            		  ->value(@$accounts_contact->email)
					}}
					<div class="invalid-feedback"></div>
				  </div>
				</div>

			  </div>
			</div><!--col-->
		  </div>
		   <div class="form-group row">
		{{ html()->label('<strong>Company Address</strong>')->class('col-md-2 form-control-label')->for('company_name') }}
		<div class="col-md-10">
		  <div class="row">
			<div class="col-md-3">
			  <div class="form-group">
			  {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
			  {{ html()->text('city')->class('form-control')->value(@$seller->city)->placeholder('City')->attribute('maxlength', 191) }}
			  <div class="invalid-feedback"></div>
			  </div>
			</div><!--col-->

			<div class="col-md-3">
			  <div class="form-group">
			  {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
			  {{ html()->text('postalcode')->class('form-control')->value(@$seller->postalcode)->placeholder('Postal Code')->attribute('maxlength', 191) }}
			  <div class="invalid-feedback"></div>
			  </div>
			</div><!--col-->

			<div class="col-md-3">
			  <div class="form-group">
			  {{ html()->label('Street Address')->class('form-control-label')->for('address') }}
			  {{ html()->text('address')->class('form-control')->value(@$seller->address)->placeholder('Street Address')->attribute('maxlength', 191) }}
			  <div class="invalid-feedback"></div>
			  </div>
			</div><!--col-->

			<div class="col-md-3">
			  <div class="form-group">
			  {{ html()->label('Country')->class('form-control-label')->for('country') }}
			  {{ html()->select('country')
				->class('select2 form-control')
				->options(country_list())
				->id('country')
			  	->value(@$seller->country ?? 'UK')
				->attribute('maxlength', 191)
			  }}
			  <div class="invalid-feedback"></div>
			  </div>
			</div><!--col-->

		  </div><!--form-group-->
		</div>
	  </div>
	  	<div class="form-group row">
          	{{ html()->label('<strong>Available Status</strong>')->class('col-md-12 form-control-label')->for('available-status') }}
			<div class="col-md-3">
				<div class="checkbox d-flex align-items-center">
				@if(!empty($seller->id))
				@php $is_checked = $seller->status @endphp
				@else
				@php $is_checked = 1 @endphp
				@endif
				{{ html()->label(
					html()->checkbox('status', $is_checked, $is_checked)
					->class('switch-input status')
					->id('status')
					. '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
					->class('switch switch-label switch-pill switch-success mr-2')
					->for('status') 
				}}
				{{ html()->label('Available')->for('availables_status')->id('availables_status')->class('flex-1') }}
				</div>
			</div>
	  	</div>
    <div class="form-group row">
      {{ html()->label('<strong>Number of 24T Truck Loads per Day</strong>')->class('col-md-2 form-control-label')->for('truck_loads_day') }}
      <div class="col-xl-2 col-md-4">
        <input type="number" name="truck_loads_day" value="{{$seller->truck_loads_day ?? 1 }}" data-decimals="0" min="1" step="1"/>
      </div><!--col-->
    </div><!--form-group-->

    <div class="form-group row">
      {{ html()->label('<strong>Number of 24T Truck Loads per Week</strong>')->class('col-md-2 form-control-label')->for('truck_loads_week') }}
      <div class="col-xl-2 col-md-4">
        <input type="number" name="truck_loads_week" value="{{$seller->truck_loads_week ?? 1 }}" data-decimals="0" min="1" step="1"/>
      </div><!--col-->
    </div><!--form-group-->

    <div class="form-group row">
      {{ html()->label('<strong>Total Number of 24T Truck Loads Available</strong>')->class('col-md-2 form-control-label')->for('truck_loads_total') }}
      <div class="col-xl-2 col-md-4">
        <input type="number" name="truck_loads_total" value="{{$seller->truck_loads_total ?? 1 }}" data-decimals="0" min="1" step="1"/>
      </div><!--col-->
    </div><!--form-group-->

    <!--<div class="form-group row">
      {{ html()->label('<strong># of available stocks</strong>')->class('col-md-2 form-control-label')->for('available_stocks') }}
      <div class="col-md-3">
        {{ html()->text('available_stocks')
        ->class('form-control')
        ->placeholder('# of available stocks')
        ->attribute('maxlength', 191)
        ->value(@$seller->available_stocks)
		}}
		<div class="invalid-feedback"></div>
      </div>
    </div>-->

	  <div class="form-group row">
		<label class="col-md-2 form-control-label" for="note"><strong>Notes</strong></label>
		<div class="col-md-10">
		 <textarea class="form-control" name="note" rows="3" placeholder="Note" id="note">{{ @$seller->note }}</textarea>
		</div>
	  </div>

  </div><!--col-->
</div><!--row-->
</div><!--card-body-->

<div class="card-footer clearfix">
  <div class="row">
    <div class="col">
      {{ form_cancel(route('admin.sellers.index'), __('buttons.general.cancel')) }}
    </div><!--col-->

    <div class="col text-right">
	  
	  	@if($createfrom == 'add seller')
			{{ form_submit(__('buttons.general.crud.create')) }}
		@else
			{{ form_submit(__('buttons.general.crud.update')) }}
		@endif
    </div><!--col-->
  </div><!--row-->
</div><!--card-footer-->
</div><!--card-->
{{ html()->form()->close() }}
@if(!empty($seller->id))
  @php
	  $url =  route('admin.sellers.update', $seller->id);
	  $sellerid = $seller->id;
  @endphp
@else
  @php
  	$url = route('admin.sellers.store');
	$sellerid = 0;
  @endphp
@endif
@endsection
@push('after-styles')
<style type="text/css">
   <?php foreach(trustlevel_list() as $key=>$value){
      	$tmp = explode('@',$value->desc);
    ?>
	ul[id^="select2-trust_level"] li:nth-child(<?php echo $key+1 ?>){
		background-color: <?php echo strtolower(trim(@$tmp[1])) ?>!important;
	}
   <?php } ?>
</style>
@endpush

@push('after-scripts')
<script type="text/javascript">
	$(document).ready(function() {
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

			$( ".status" ).each(function( key, value ) {
				if(value.value == 0){
					formData.append(value.name, value.value);
				}
			});

			var sellerid =  {{ $sellerid }};
			if(sellerid != 0){
				formData.append('_method', 'PUT');
			}

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
					$('.loading').addClass('loading_hide');
					if(data.status == 'success'){
						Swal.fire('Sent!', data.message, 'success');
						setTimeout(function(){
							window.location.href = "{{ url('admin/sellers') }}";
						}, 5000);
					}
					if(data.status == 'error'){
						Swal.fire('Error!', data.message, 'error');
						setTimeout(function(){
							window.location.href = "{{ $url }}";
						}, 5000);
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
						})
					}
				}
			});
		});
	} );

	$('body').on('click', '.status', function(){
		if(this.checked){
			$(this).val(1);
			$(this).attr('checked','checked');
			$('#availables_status').text('Available');
		}else{
			$(this).val(0);
			$(this).removeAttr('checked');
			$('#availables_status').text('Unavailable');
		}
	})
	$('body').on('click', '.contact_email', function(){
		if(this.checked){
			$(this).val(1);
			$(this).attr('checked','checked');
		}else{
			$(this).val(0);
			$(this).removeAttr('checked');
		}
	})
	$('body').on('click', '.contact_sms', function(){
		if(this.checked){
			$(this).val(1);
			$(this).attr('checked','checked');
		}else{
			$(this).val(0);
			$(this).removeAttr('checked');
		}
	})
	$('body').on('click', '.contact_whatsapp', function(){
		if(this.checked){
			$(this).val(1);
			$(this).attr('checked','checked');
		}else{
			$(this).val(0);
			$(this).removeAttr('checked');
		}
	})
</script>
@endpush
