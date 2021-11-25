@extends('backend.layouts.app')

@section('title', 'Create Offer :: '.app_name())
@php $company = json_decode($seller->company); @endphp
@section('content')
  {{ html()->form('PUT')->id('formsubmit')->class('form-horizontal')->open() }}
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">
              Add Sellers
              <small class="text-muted"></small>
            </h4>
          </div><!--col-->
        </div><!--row-->
        <hr>
        <div class="row mt-4 mb-4">
          <div class="col">
            <div class="form-group row">
              {{ html()->label('<strong>Username</strong>')->class('col-md-2 form-control-label')->for('username') }}
              <div class="col-md-10">
                {{ html()->text('username')
                  ->class('form-control')
                  ->placeholder('Username')
                  ->attribute('maxlength', 191)
                  ->value($seller->username)
                  ->required() 
                }}
              </div><!--col-->
            </div><!--form-group-->
            <div class="form-group row">
					    {{ html()->label('<strong>Company</strong>')->class('col-md-2 form-control-label')->for('company_name') }}
					    <div class="col-md-10">
						    <div class="row">
						      <div class="col-md-4">
							      <div class="form-group">
							        {{ html()->label('Company')->class('form-control-label')->for('company') }}
							        {{ html()->text('company')->class('form-control')->placeholder('Company Name')->value($seller->company)->attribute('maxlength', 191) }}
							      </div>
						      </div><!--col-->
						      <div class="col-md-4">
							      <div class="form-group">
							        {{ html()->label('Vat')->class('form-control-label')->for('vat') }}
							        {{ html()->text('vat')->class('form-control')->placeholder('Company VAT')->value($seller->vat)->attribute('maxlength', 191) }}
							      </div>
						      </div><!--col-->
						    </div><!--form-group-->
					    </div>
					  </div>
            @php
            $seller2_contact = json_decode($seller->seller2_contact);
            $transport_contact = json_decode($seller->transport_contact);
            $accounts_contact = json_decode($seller->accounts_contact);
            @endphp
					  <div class="form-group row">
              {{ html()->label('<strong>Seller 1 Contact Info</strong>')->class('col-md-2 form-control-label')->for('name') }}
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      {{ html()->label('Phone <small><i>(with county code)</i></small> ')->class('form-control-label')->for('phone') }}
                      {{ html()->number('phone')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
                        ->attribute('maxlength', 191)
                        ->value(@$seller->phone)
                      }}
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
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      {{html()->label('E-mail Address')->class('form-control-label')->for('seller2_contact_email') }}
                      {{ html()->email('seller2_contact[email]')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.email'))
                        ->attribute('maxlength', 191)
                        ->value(@$seller2_contact->email)
                      }}
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
						          {{ html()->text('city')->class('form-control')->placeholder('City')->value($seller->city)->attribute('maxlength', 191) }}
						        </div>
						      </div><!--col-->

                  <div class="col-md-3">
                    <div class="form-group">
                      {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
                      {{ html()->text('postalcode')->class('form-control')->placeholder('Postal Code')->value($seller->postalcode)->attribute('maxlength', 191) }}
                    </div>
                  </div><!--col-->

                  <div class="col-md-3">
                    <div class="form-group">
                    {{ html()->label('Street Address')->class('form-control-label')->for('address') }}
                    {{ html()->text('address')->class('form-control')->value($seller->address)->placeholder('Street Address')->attribute('maxlength', 191) }}
                    </div>
                  </div><!--col-->

                  <div class="col-md-3">
                    <div class="form-group">
                      {{ html()->label('Country')->class('form-control-label')->for('country') }}
                      {{ html()->select('country')
                        ->class('select2 form-control')
                        ->options(country_list())
                        ->id('country')
                        ->value($seller->country)
                        ->attribute('maxlength', 191)
                      }}
                    </div>
                  </div><!--col-->
                </div><!--form-group-->
					    </div>
				    </div>

            <div class="form-group row">
              {{ html()->label('<strong># of available stocks</strong>')->class('col-md-2 form-control-label')->for('available_stocks') }}
              <div class="col-md-3">
                {{ html()->text('available_stocks')
                  ->class('form-control')
                  ->placeholder('# of available stocks')
                  ->attribute('maxlength', 191)
                  ->value($seller->available_stocks)
                }}
              </div><!--col-->
            </div><!--form-group-->

				    <div class="form-group row">
					    <label class="col-md-2 form-control-label" for="note"><strong>Notes</strong></label>
              <div class="col-md-10">
                <textarea class="form-control" name="note" rows="3" placeholder="Note" id="note">{{ $seller->note }}</textarea>
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
		var sellerId = "<?php if(!empty($seller->id)) { echo $seller->id; } ?>";
		if(sellerId)
		{
			var url = "{{ url('admin/sellers/update') }}"+'/'+'{{ $seller->id}}'
		}
		else
		{
			var url = "{{ url('admin/sellers/store') }}"
		}
		$.ajaxSetup({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
		});
		$('#formsubmit').on('submit', function(event) {
			event.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: url,
				method: 'POST',
				data: formData,
				contentType: false,							
				cache: false,
				processData: false,
				dataType: "json",
				beforeSend: function(){
				},
				success: function(data)
				{
					if(data.status == 'success'){
						setTimeout(function(){
							Swal.fire('Sent!', data.message, 'success');
							window.location.href = "{{ url('admin/sellers') }}"; 
						}, 5000);
					}
					if(data.status == 'error'){
						setTimeout(function(){
							Swal.fire('Error!', data.message, 'error');
							window.location.href = "{{ url('admin/sellers/create') }}";
						}, 5000);
					}
				},
				error :function( data ) {
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
</script>
@endpush