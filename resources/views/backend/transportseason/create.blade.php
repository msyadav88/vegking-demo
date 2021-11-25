@extends('backend.layouts.app')
@section('title', 'Add Transport Country Season Per Factor :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('seasonform')->class('form-horizontal')->open() }} 
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Add Transport Country Season Per Factor
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
                                }}
                            </div>
							  
						</div><!--form-group-->
					</div>

					<div class="col-md-8 offset-2">
						<div class="form-group row">
							{{ html()->label('Region <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('region') }}
							<div class="col-md-10">
								{{ html()->text('region')
									->class('form-control')
									->placeholder('Region')
									->attribute('maxlength', 191)
									}}
							</div>
						</div>
					</div>

					<div class="col-md-8 offset-2">
						<div class="form-group row">
    						{{ html()->label('fromTo <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('fromTo') }}

                            @php
                                $fromtoopt = array(
                                    'F' => 'From',
                                    'T' => 'To'
                                );
                            @endphp
    						<div class="col-md-10">
    							<select class="form-control" id="fromTo" name="fromTo">
                                    <option value="">Select Option</option>
                                    @foreach($fromtoopt as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
    						</div>
						</div>
					</div>
					
					<div class="col-md-8 offset-2">
						<div class="form-group row">
    					   {{ html()->label('Season <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('season') }}

                            @php
                                $seasonopt = array(
                                    'S' => 'Summer',
                                    'W' => 'Winter'
                                );
                            @endphp
    						<div class="col-md-10">
    							<select class="form-control" id="season" name="season">
                                    <option value="">Select Season</option>
                                    @foreach($seasonopt as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
    						</div><!--col-->
						</div>
					</div><!--form-group-->

                    <div class="col-md-8 offset-2">
                        <div class="form-group row">
                           {{ html()->label('Factor <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('factor') }}
                            <div class="col-md-10">
                                {{ html()->text('factor')
                                    ->class('form-control')
                                    ->placeholder('Factor')
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
                        {{ form_cancel(route('admin.season.index'), __('buttons.general.cancel')) }}
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
        $('#seasonform').on('submit', function(event) {
          event.preventDefault();
          var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('admin.season.store') }}",
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
                      window.location.href = "{{ route('admin.season.index') }}";
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