@extends('backend.layouts.app')

@section('title',  __('Setting').' :: '.app_name())

@section('content')
{{ html()->form('PUT')->id('form_role_submit3')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          Setting
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->
    <hr>
    <div class="row mt-4 mb-4">
      <div class="col">
        <div class="form-group row">
          {{ html()->label('Site Name')->class('col-md-2 form-control-label')->for('site_name') }}
          <div class="col-md-10">
		    <input type="hidden" class="form-control" name="id" id="id" placeholder="id" value="{{ @$setting['id'] }}">
            <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name" value="{{ @$setting['site_name'] != "" ? $setting['site_name'] : old('site_name') }}">
          </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
          {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}
          <div class="col-md-10">
             <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ @$setting['email'] != "" ? $setting['email'] : old('email') }}">
          </div><!--col-->
       </div><!--form-group-->

      <div class="form-group row">
        {{ html()->label(__('validation.attributes.backend.access.users.phone'))->class('col-md-2 form-control-label')->for('phone') }}
        <div class="col-md-10">
         <input type="text" class="form-control" name="phone" id="email" placeholder="Phone" value="{{ @$setting['phone'] != "" ? $setting['phone'] : old('phone') }}">
      </div><!--col-->
    </div><!--form-group-->
    <div class="form-group row">
      {{ html()->label('Company Address')->class('col-md-2 form-control-label')->for('company_address') }}
      <div class="col-md-10">
	     <textarea class="form-control" name="address" id="address" placeholder="Company Address" rows="3">{{ @$setting['address'] != "" ? $setting['address'] : old('address') }}</textarea>
      </div>
    </div>
	<div class="form-group row">
      {{ html()->label('Footer About')->class('col-md-2 form-control-label')->for('footer_about') }}
      <div class="col-md-10">
	    <textarea class="form-control" name="footer_about" id="footer_about" placeholder="Footer About" rows="3">{{ @$setting['footer_about'] != "" ? $setting['footer_about'] : old('footer_about') }}</textarea>
      </div>
    </div>
	<div class="form-group row">
      <label class="col-md-2 form-control-label" for="currency">Currency Logo</label>
	  <div class="col-md-10">
	  
       <input type="text" class="form-control" id="currency" name="currency" value="{{ @$setting['currency'] != "" ? $setting['currency'] : old('currency') }}">
	  </div>  
    </div>
	<div class="form-group row">
	<label class="col-md-2" for=""></label>
	<div class="col-md-10">
	<img id="blah" alt="{{ @$setting['site_logo'] }}" src="@if(!empty($setting['site_logo'])) {{ url('/img')}}/{{ @$setting['site_logo'] }} @else https://via.placeholder.com/500.png @endif" class="img-responsive mt-2 img-thumbnail" width="128" height="128">
	</div>
	</div>
    <div class="form-group row">
      <label class="col-md-2" for="site_logo">Site Logo</label>
     <div class="col-md-10">
      <div class="form-group">
      <div class="input-group input-file" id="site_logo" name="site_logo">
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
    </div>
	<div class="form-group row">
	<label class="col-md-2" for=""></label>
	<div class="col-md-10">
	<img id="blah" alt="{{ @$setting['site_favicon'] }}" src="@if(!empty($setting['site_favicon'])) {{ url('/img')}}/{{ @$setting['site_favicon'] }} @else https://via.placeholder.com/500.png @endif" class="img-responsive mt-2 img-thumbnail" width="128" height="128">
	</div>
	</div>
	
	
	<div class="form-group row">
      <label class="col-md-2" for="site_logo">Site Favicon</label>
      <div class="col-md-10">
      <div class="form-group">
      <div class="input-group input-file" id="site_favicon" name="site_favicon">
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
    </div>
  </div><!--col-->
</div><!--row-->
</div><!--card-body-->

<div class="card-footer clearfix">
  <div class="row">
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
    $('#form_role_submit3').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('admin.setting.update', $setting['id']) }}",
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
              window.location.href = "{{ route('admin.setting.index') }}";
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
