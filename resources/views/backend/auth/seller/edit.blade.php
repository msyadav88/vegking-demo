
@extends('backend.layouts.app')

@section('title', __('labels.backend.access.sellers.management') . ' | ' . __('labels.backend.access.sellers.edit'))


@section('content')
{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                @if(!@chanel_confirmation('email-confirmed'))
                <div class="col-md-12 alert alert-warning" role = "alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="">
                        <div class="col-md-12">
                            <a href="{{route('frontend.auth.account.confirm.resend',e(auth()->user()->{auth()->user()->getUuidName()}))}}">Click here to resend Email verification link</a>
                        </div>
                    </div>
                </div>
                @endif
                @if(!empty($logged_in_seller->whatsapp_number) && $logged_in_seller->whatsapp_verified_at == NULL)
                <div class="col-md-12 alert alert-warning" role = "alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="">
                        <div class="col-md-12">
                            <a href="{{route('frontend.auth.whatsapp.verify.resend',e(auth()->user()->{auth()->user()->getUuidName()}))}}">Click here to resend whatsapp verification link</a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-sm-10">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.sellers.management')
                        <small class="text-muted"></small>
                    </h4>
                </div>
                <div class="col-sm-2">
                    <!-- <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('frontend.user.account') }}" class="btn btn-success ml-1">@lang('navs.frontend.user.change_password')</a>
                    </div> -->
                    <!--btn-toolbar-->
                </div>
                <!--col-->
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                        <div id="tabs">
                            <ul class="nav nav-tabs ui-sortable">
                                <li class="nav-item "><a class="nav-link active" href="#vk1" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Edit Profile</a> </li>
                                <li class="nav-item "><a class="nav-link" href="#vk2" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Notifications</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk3" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Change Password</a></li>
                            </ul>
                           <div class="tab-content">
                                <div id="vk1" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mt-4 mb-4">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.gender'))->class('col-md-2 form-control-label')->for('gender') }}
                                                        <div class="col-md-10">
                                                            <div class="checkbox d-flex align-items-center produttype">
                                                                {{ html()->label(
                                                                    html()->checkbox('gender', @$user->gender)
                                                                    ->class('switch-input type_check')
                                                                    ->id('gender')
                                                                    . '<span class="switch-slider" data-checked="Queen" data-unchecked="King"></span>')
                                                                    ->class('switch switch-label switch-pill switch-success mr-2')
                                                                    ->for('gender')
                                                                }}
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.name'))->class('col-md-2 form-control-label')->for('username') }}
                                                        <div class="col-md-10">
                                                            {{ html()->text('username')
                                                                ->class('form-control')
                                                                ->placeholder(__('validation.attributes.backend.access.sellers.name'))
                                                                ->value(@$user->first_name. ' '. @$user->last_name)
                                                                ->attribute('maxlength', 191)
                                                            }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--form-group-->

                                                    <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.email'))->class('col-md-2 form-control-label')->for('email') }}
                                                        <div class="col-md-10">
                                                            {{ html()->email('email')
                                                                ->class('form-control')
                                                                ->value(@$seller->email)
                                                                ->placeholder(__('validation.attributes.backend.access.sellers.email'))
                                                                ->attribute('maxlength', 191)
                                                                ->attribute('disabled', 'disabled')
                                                            }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--form-group-->

                                                    <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.phone'))->class('col-md-2 form-control-label')->for('phone') }}
                                                        <div class="col-md-10">
                                                            {{ html()->text('phone')
                                                                ->class('form-control')
                                                                ->value(@$seller->phone)
                                                                ->placeholder(__('validation.attributes.backend.access.sellers.phone_placeholder'))
                                                                ->attribute('maxlength', 191)
                                                            }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--form-group-->
                                                    
                                                    <div class="form-group row">
                                                        {{ html()->label('Nickname')->class('col-md-2 form-control-label')->for('Nickname') }}
                                                        <div class="col-md-10">
                                                            {{ html()->text('nickname')
                                                                ->class('form-control')
                                                                ->value(@$seller->nickname)
                                                                ->placeholder('Nickname')
                                                                ->attribute('maxlength', 191)
                                                            }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--form-group-->
                                                    
                                                    <div class="form-group row">
                                                        {{ html()->label('Company Address')->class('col-md-2 form-control-label')->for('company_name') }}
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
                                                                        {{ html()->text('city')->class('form-control')->placeholder('City')->value($seller->city)->attribute('maxlength', 191) }}
                                                                    </div>
                                                                </div>
                                                                <!--col-->

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
                                                                        {{ html()->text('postalcode')->class('form-control')->placeholder('Postal Code')->value($seller->postalcode)->attribute('maxlength', 191) }}
                                                                    </div>
                                                                </div>
                                                                <!--col-->

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        {{ html()->label('Street Address')->class('form-control-label')->for('address') }}
                                                                        {{ html()->text('address')->class('form-control')->value($seller->address)->placeholder('Street Address')->attribute('maxlength', 191) }}
                                                                    </div>
                                                                </div>
                                                                <!--col-->

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
                                                                </div>
                                                                <!--col-->
                                                            </div>
                                                            <!--form-group-->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.email_preference'))->class('col-md-2 form-control-label')->for('phone') }}
                                                        <div class="col-md-10">
                                                            <div class="checkbox d-flex align-items-center">
                                                                {{ html()->label(
                                                                    html()->checkbox('contact_email',@$seller->contact_email)
                                                                        ->class('switch-input')
                                                                        ->id('contact_email')
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                        ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                        ->for('contact_email')
                                                                }}
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--form-group-->
                                                    <!-- <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.sms_preference'))->class('col-md-2 form-control-label')->for('phone') }}
                                                        <div class="col-md-10 row">
                                                            <div class="col-md-1">
                                                                {{ html()->label(
                                                                    html()->checkbox('contact_sms',@$seller->contact_sms)
                                                                        ->class('switch-input')
                                                                        ->id('contact_sms')
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                        ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                        ->for('contact_sms')
                                                                }}
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    {{ html()->text('sms_number')->class('form-control')->value($logged_in_seller->sms_number)->placeholder('SMS Number')->attribute('maxlength', 191) }}
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        
                                                    </div> -->
                                                    <!--form-group-->
                                                    <div class="form-group row">
                                                        {{ html()->label(__('validation.attributes.backend.access.sellers.whatsapp_preference'))->class('col-md-2 form-control-label')->for('phone') }}
                                                        <div class="col-md-10 row">
                                                            <div class="col-md-1">
                                                                {{ html()->label(
                                                                    html()->checkbox('contact_whatsapp',@$seller->contact_whatsapp)
                                                                        ->class('switch-input')
                                                                        ->id('contact_whatsapp')
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                        ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                        ->for('contact_whatsapp')
                                                                }}
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    {{ html()->text('whatsapp_number')->class('form-control')->value($logged_in_seller->whatsapp_number)->placeholder('WhatsApp Number')->attribute('maxlength', 191) }}
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--form-group-->
                                                </div>
                                                <!--col-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="vk2" class="tab-pane ">
                                      @php $options = array(
                                            '0' => 'Any time',
                                            '1' => '1 day',
                                            '2' => '3 day',
                                            '3' => '1 week',
                                            '4' => '2 week',
                                            '5' => '1 month',
                                            '6' => 'Never'
                                         );
                                         @endphp
                                    <div class="row">
                                        <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 form-control-label" for="gender">Sale Confirmed</label>
                                                        <div class="col-md-10">
                                                            <div class="col-md-2">
                                                              <select class="form-control select2" id="sale_confirmed" name="sale_confirmed">
                                                                @foreach($options as $key => $val)
                                                                  <option value="{{$key}}" @if(@$notifications['sale_confirmed'] == $key) selected @endif>{{ $val}}</option>
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 form-control-label" for="gender">Delivery Update</label>
                                                        <div class="col-md-10">
                                                            <div class="col-md-2">
                                                              <select class="form-control select2" id="delivery_update" name="delivery_update">
                                                                @foreach($options as $key => $val)
                                                                  <option value="{{$key}}" @if(@$notifications['delivery_update'] == $key) selected @endif>{{ $val}}</option>
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 form-control-label" for="gender">Offers messages</label>
                                                        <div class="col-md-10">
                                                            <div class="col-md-2">
                                                              <select class="form-control select2" id="offers_messages" name="offers_messages">
                                                                @foreach($options as $key => $val)
                                                                  <option value="{{$key}}" @if(@$notifications['offers_messages'] == $key) selected @endif>{{ $val}}</option>
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                        <div id="vk3" class="tab-pane">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                        {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}
                                                        </div>
                                                        <div class="col-md-10">

                                                            <div class="notification-alert d-none error" >
                                                                @lang('inner-content.frontend.password_rule')</div>
                                                                {{ html()->password('old_password')
                                                                    ->class('form-control password')
                                                                    ->placeholder(__('validation.attributes.frontend.old_password'))
                                                                }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>       
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                        {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                                                        </div>
                                                        <div class="col-md-10">

                                                            <div class="notification-alert d-none" >@lang('inner-content.frontend.password_rule')</div>
                                                                {{ html()->password('password')
                                                            ->class('form-control password')
                                                                ->placeholder(__('validation.attributes.frontend.password'))
                                                                 }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>       
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                        {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
                                                        </div>
                                                        <div class="col-md-10">
                                                               {{ html()->password('password_confirmation')
                                                                ->class('form-control')
                                                                ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                                                 }}
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <!--col-->
                                                    </div>                 

                                                </div>
                                            </div>
                                     </div>
                            </div>
                        </div>

                </div>
            </div>
            <!--row-->


            <!--row-->
        </div>
        <!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('seller.dashboard'), __('buttons.general.cancel')) }}
                </div>
                <!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div>
                <!--row-->
            </div>
            <!--row-->
        </div>
        <!--card-footer-->
    </div>
    <!--card-->
{{ html()->closeModelForm() }}
@php
    $url = route('seller.user.edit', $seller->id);
    $redirecturl = route('seller.user.edit', Auth()->user()->id);
@endphp
@endsection


@push('after-scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#formsubmit').on('submit', function(event) {
            event.preventDefault();
            $('.has-danger').next().children().children().css({
                "border": ""
            });
            $('.is-invalid').removeClass("is-invalid");
            $('.invalid-feedback').html("");
            $('.has-danger').removeClass("has-danger");

            var formData = new FormData(this);
            formData.append('_method', 'POST');
            $.ajax({
                url: "{{ $url }}",
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'success')
                    {
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function() {
                            window.location.href = "{{ $redirecturl }}";
                        }, 5000);
                    }
                    if (data.status == 'error')
                    {
                        Swal.fire('Error!', data.message, 'error');
                        $('.btn-success').removeAttr('disabled');
                    }
                },
                error: function(data) {
                    if (data.status === 422) {
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
    });
</script>
@endpush