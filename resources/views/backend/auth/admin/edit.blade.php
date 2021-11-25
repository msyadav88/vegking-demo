@extends('backend.layouts.app')

@section('title', __('Edit Profile'). ' | ' . __('Edit Profile'))


@section('content')
{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="card-title mb-0">
                        Edit Profile
                    <small class="text-muted"></small>
                </h4>
            </div>
            <div class="col-sm-2">
                    <!-- <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('frontend.user.account') }}" class="btn btn-success ml-1">@lang('navs.frontend.user.change_password')</a>
                    </div> --><!--btn-toolbar-->
                </div>

            <!--col-->
        </div>
        <!--row-->
        <hr>
        <div class="row mt-4 mb-4">
            <div class="col">
                @if(!empty($logged_in_buyer->whatsapp_number) && $logged_in_buyer->whatsapp_verified_at == NULL)
                <div class="alert alert-warning" role="alert">
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
                                        {{ html()->label('Name')->class('col-md-2 form-control-label')->for('username') }}
                                        <div class="col-md-10">
                                            {{ html()->text('username')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.backend.access.buyers.name'))
                                                    ->value(@$user->first_name. ' '. @$user->last_name)
                                                    ->attribute('maxlength', 191)
                                                }}
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->
                                  <div class="form-group row">
                                        {{ html()->label('E-mail Address')->class('col-md-2 form-control-label')->for('email') }}
                                        <div class="col-md-10">
                                            {{ html()->email('email')
                                                    ->class('form-control')
                                                    ->value(@$buyer->email)
                                                    ->placeholder(__('validation.attributes.backend.access.buyers.email'))
                                                    ->attribute('maxlength', 191)
                                                    ->attribute('disabled', 'disabled')
                                                }}
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->

                                    <div class="form-group row">
                                        {{ html()->label('Phone <small>(with county code)</small>')->class('col-md-2 form-control-label')->for('phone') }}
                                        <div class="col-md-10">
                                            {{ html()->number('phone')
                                                    ->class('form-control')
                                                    ->value(@$buyer->phone)
                                                    ->placeholder(__('validation.attributes.backend.access.buyers.phone_placeholder'))
                                                    ->attribute('maxlength', 191)
                                                }}
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!--col-->
                                    </div>
                                   <!--form-group-->
                                   <!--  <div class="form-group row">
                                        {{ html()->label('Company Address')->class('col-md-2 form-control-label')->for('company_name') }}
                                        <div class="col-md-10">
                                            <div class="row"> -->

                                               <!--  <div class="col-md-3">
                                                    <div class="form-group">
                                                        {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
                                                        {{ html()->text('city')->class('form-control')->placeholder('City')->value($buyer->city)->attribute('maxlength', 191) }}
                                                    </div>
                                                </div> -->
                                                <!--col-->
<!--
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
                                                        {{ html()->text('postalcode')->class('form-control')->placeholder('Postal Code')->value($buyer->postalcode)->attribute('maxlength', 191) }}
                                                    </div>
                                                </div> -->
                                                <!--col-->

                                                <!-- <div class="col-md-3">
                                                    <div class="form-group">
                                                        {{ html()->label('Street Address')->class('form-control-label')->for('address') }}
                                                        {{ html()->text('address')->class('form-control')->value($buyer->address)->placeholder('Street Address')->attribute('maxlength', 191) }}
                                                    </div>
                                                </div> -->
                                                <!--col-->
<!--
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        {{ html()->label('Country')->class('form-control-label')->for('country') }}
                                                        {{ html()->select('country')
                                                ->class('select2 form-control')
                                                ->options(country_list())
                                                ->id('country')
                                                ->value($buyer->country)
                                                ->attribute('maxlength', 191)
                                              }}
                                                    </div>
                                                </div> -->
                                                <!--col-->

                                            <!-- </div> -->
                                            <!--form-group-->
                                        <!-- </div>
                                    </div> -->
                                    <div class="form-group row">
                                        {{ html()->label('Email Preference')->for('phone')->class('col-md-2 form-control-label') }}
                                        <div class="col-md-10">

                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                            html()->checkbox('email_subscription',@$user->email_subscription)
                                                                    ->class('switch-input')
                                                                    ->id('email_subscription')
                                                                . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                            ->class('switch switch-label switch-pill switch-primary mr-2')
                                                        ->for('email_subscription') }}
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->
                                    <!-- <div class="form-group row">
                                        {{ html()->label('SMS Preference')->for('phone')->class('col-md-2 form-control-label') }}
                                        <div class="col-md-10 row">
                                            <div class="col-md-1">

                                                {{ html()->label(
                                                            html()->checkbox('contact_sms',@$buyer->contact_sms)
                                                                    ->class('switch-input')
                                                                    ->id('contact_sms')
                                                                . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                            ->class('switch switch-label switch-pill switch-primary mr-2')
                                                        ->for('contact_sms') }}

                                            </div>
                                            <div class="col-md-5">


                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>    -->
                                    <!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('WhatsApp Preference')->for('phone')->class('col-md-2 form-control-label') }}
                                        <div class="col-md-10 row">
                                            <div class="col-md-1">

                          {{ html()->label(
                  html()->checkbox('whatsapp_subscription',@$user->whatsapp_subscription)
                 ->class('switch-input')
                  ->id('whatsapp_subscription')
                                                                . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                            ->class('switch switch-label switch-pill switch-primary mr-2')
                                                        ->for('whatsapp_subscription') }}
                                            </div>
                                            <div class="col-md-2">
                                                   {{ html()->label('Whatsapp Number') }} 
                                            </div>
                                            <div class="col-md-5">
                                                {{ html()->number('whatsapp_number')->class('form-control')->value(@$user->whatsapp_number)->placeholder('Whatsapp Number')->name('whatsapp_number')->attribute('maxlength', 191)
                                                }}
                                                    <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <!--form-group-->    

                                    <!-- </div> -->
                                    <!--form-group-->


                                 </div>
                                 <div id="vk2" class="tab-pane">
                                        @php $options = array(
                                            '0' => 'Any time',
                                            '1' => '1 day',
                                            '3' => '3 day',
                                            '7' => '1 week',
                                            '14' => '2 week',
                                            '30' => '1 month',
                                            '-1' => 'Never'
                                         );
                                         @endphp
                                    <div class="row">
                                        <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 form-control-label" for="gender">Sale Created
                                                            
                                                        </label>
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

            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                {{ form_cancel(route('buyer.dashboard'), __('buttons.general.cancel')) }}
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
$url = route('admin.user.edit', $buyer->id);
$redirecturl = route('admin.profile.edit', Auth()->user()->id);
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
                    if (data.status == 'success') {
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function() {
                            window.location.href = "{{ $redirecturl }}";
                        }, 5000);
                    }
                    if (data.status == 'error') {
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