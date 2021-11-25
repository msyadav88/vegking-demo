@extends('backend.layouts.app')
@if(@$data->id)
    @section('title',__('Edit Message Template') . ' :: ' . app_name())
@else
    @section('title',__('Create Message Template') . ' :: ' . app_name())
@endif
@section('content')
    {{ html()->form((isset($data->id) ? 'PUT' : 'POST') )->id('form_email_template_submit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                          @if(@$data->id)
                            Edit Message Template
                          @else
                            Create Message Template
                          @endif
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Message Header</h4>
                    </div>
                    <div class="col-md-4">
                        {{ html()->label('Title EN')->class('form-control-label')->for('title_en') }}
                        {{ html()->text('header_en')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.header_title_en'))
                            ->value(old('title', @$data->header_en))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Title DE')->class('form-control-label')->for('title_de') }}
                        {{ html()->text('header_de')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.header_title_de'))
                            ->value(old('title', @$data->header_de))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Title PL')->class('form-control-label')->for('title_pl') }}
                        {{ html()->text('header_pl')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.header_title_pl'))
                            ->value(old('title', @$data->header_pl))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                </div>
                <hr>
                <div id="tabs'.$row->id.'">
                    <ul class="nav nav-tabs ui-sortable">
                        @if( in_array( 1001 ,explode(',',@$data->recipients )))
                            @php 
                                $attrs = 'checked';
                                $roleid = '1001';
                            @endphp
                        @else
                            @php 
                                $attrs = ''; 
                                $roleid = 0;    
                            @endphp
                        @endif
                        <li class="nav-item nav-link recptabs active">
                            <input type="hidden" name="roles[1001]" value="{{ $roleid }}"/>
                            <input type="checkbox" {{ $attrs }} class="userrole" role-id="1001" />
                            <a class="" href="#vk1001" data-toggle="tab" data-container="body" data-placement="top" >
                                THE SELLER
                            </a>
                        </li>
                        @if( in_array( 1002 ,explode(',',@$data->recipients )))
                            @php 
                                $attrs = 'checked';
                                $roleid = '1002';
                            @endphp
                        @else
                            @php 
                                $attrs = ''; 
                                $roleid = 0;    
                            @endphp
                        @endif
                        <li class="nav-item nav-link recptabs">
                            <input type="hidden" name="roles[1002]" value="{{ $roleid }}"/>
                            <input type="checkbox" {{ $attrs }} class="userrole" role-id="1002" />
                            <a class="" href="#vk1002" data-toggle="tab" data-container="body" data-placement="top" >
                                THE BUYER
                            </a>
                        </li>
                        @if( in_array( 1003 ,explode(',',@$data->recipients )))
                            @php 
                                $attrs = 'checked';
                                $roleid = '1003';
                            @endphp
                        @else
                            @php 
                                $attrs = ''; 
                                $roleid = 0;    
                            @endphp
                        @endif
                        <li class="nav-item nav-link recptabs">
                            <input type="hidden" name="roles[1003]" value="{{ $roleid }}"/>
                            <input type="checkbox" {{ $attrs }} class="userrole" role-id="1003" />
                            <a class="" href="#vk1003" data-toggle="tab" data-container="body" data-placement="top" >
                                THE TRADER
                            </a>
                        </li>
                        @php $activerole = 1; @endphp 
                        @foreach($roles as $role)
                            @if( in_array( $role->id ,explode(',',@$data->recipients )))
                                @php 
                                    $attr = 'checked';
                                    $roleid = $role->id;
                                @endphp
                            @else
                                @php 
                                    $attr = ''; 
                                    $roleid = 0;    
                                @endphp
                            @endif
                            <li class="nav-item nav-link recptabs">
                                <input type="hidden" name="roles[{{$activerole}}]" value="{{ $roleid }}"/>
                                <input type="checkbox" {{ $attr }} class="userrole" role-id="{{ $role->id }}" />
                                <a class="" href="#vk{{ $role->id }}" data-toggle="tab" data-container="body" data-placement="top" >
                                    @if($role->name == 'administrator')
                                        ADMINS
                                    @elseif($role->name == 'trans')
                                        TRANS
                                    @elseif($role->name == 'usermanager')
                                        USERMGRS
                                    @else
                                        {{ strtoupper($role->name) }}S
                                    @endif
                                </a>
                            </li>
                            @php $activerole++; @endphp
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div id="vk1001" class="tab-pane active">
                            <div class="row mt-4 mb-4">
                                <div class="col">

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.title'))->class('form-control-label')->for('title') }}
                                            {{ html()->text('title')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.title'))
                                                ->value(old('title', @$data->title))
                                                ->attribute('maxlength', 191)}}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.subject'))->class('form-control-label')->for('subject') }}
                                            {{ html()->text('subject')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.subject'))
                                                ->value(old('title', @$data->subject))
                                                ->attribute('maxlength', 191)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.shortcodes'))->class('form-control-label')->for('shortcodes') }}
                                            @if(@$data->id)
                                                @section('title',__('Edit Message Template') . ' :: ' . app_name())
                                                    <code>{{ @$data->shortcodes }}</code>
                                                @else
                                                    <code>[first_name], [name], [upload_stock_link], [english_phone_number], [phone], [email], [verification_link], [team_member_name], [view_seller_link], [product_name], [contact_preferred_method], [notes], [view_buyer_link], [username], [password], [buyerlead_step1_link], [buyerlead_step2_link], [stock_id], [seller_username], [buyer_id], [buyer_username], [stock_price], [buyer_total_prefs], [profit_per_ton], [view_matches_link], [order_cofirm_url], [order_edit_url]</code>
                                            @endif
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content'))->class('form-control-label')->for('email_content') }}
                                            {{ html()->textarea('email_content')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.email_content'))
                                                ->value(old('email_content', @$data->email_content))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content_de'))->class('form-control-label')->for('email_content_de') }}
                                            {{ html()->textarea('email_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.email_content_de'))
                                                ->value(old('email_content_de', @$data->email_content_de))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content_pl'))->class('form-control-label')->for('email_content_pl') }}
                                            {{ html()->textarea('email_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.email_content_pl'))
                                                ->value(old('email_content_pl', @$data->email_content_pl))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content'))->class('form-control-label')->for('sms_content') }}
                                            {{ html()->textarea('sms_content')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content'))
                                                ->value(old('sms_content', @$data->sms_content))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content_de'))->class('form-control-label')->for('sms_content_de') }}
                                            {{ html()->textarea('sms_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content_de'))
                                                ->value(old('sms_content_de', @$data->sms_content_de))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        
                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content_pl'))->class('form-control-label')->for('sms_content_pl') }}
                                            {{ html()->textarea('sms_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content_pl'))
                                                ->value(old('sms_content', @$data->sms_content_pl))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(EN)'))->class('form-control-label')->for('sms_content_en') }}
                                            {{ html()->textarea('push_notification_content_en')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(EN)'))
                                                ->value(old('push_content_en', @$data->push_content_en))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(DE)'))->class('form-control-label')->for('sms_content_de') }}
                                            {{ html()->textarea('push_notification_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(DE)'))
                                                ->value(old('push_content_de', @$data->push_content_de))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(PL)'))->class('form-control-label')->for('sms_content_pl') }}
                                            {{ html()->textarea('push_notification_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(PL)'))
                                                ->value(old('push_content_pl', @$data->push_content_pl))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                       {{ html()->label('Push Sound')->class('form-control-label') }}
                                        </div>
                                        <div class="col-md-10">
                                        <select name="push_notification_sound" class="form-control">
                                        <option value="1">Sound-1</option>
                                        <option value="2">Sound-2</option>
                                        </select>
                                        </div>
                                        </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            {{ html()->label('Status')->class('form-control-label') }}
                                        </div>
                                        <div class="col-md-10">
                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                    html()->checkbox('status',  @$data->status ?? 1, '1')
                                                    ->class('switch-input pref_check')
                                                    ->id('status')
                                                    . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                                    ->class('switch switch-label switch-pill switch-success mr-2')
                                                    ->for('status') 
                                                }}
                                            </div>
                                        </div>
                                    </div>
                               
                                </div><!--col-->
                            </div><!--row-->
                        </div>
                        <div id="vk1002" class="tab-pane">
                            <div class="row mt-4 mb-4">
                                <div class="col">

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.subject'))->class('form-control-label')->for('subject') }}
                                            {{ html()->text('buyer_subject')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.subject'))
                                                ->value(old('buyer_subject', @$data->buyer_subject))
                                                ->attribute('maxlength', 191)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.shortcodes'))->class('form-control-label')->for('shortcodes') }}
                                            @if(@$data->id)
                                                @section('title',__('Edit Message Template') . ' :: ' . app_name())
                                                    <code>{{ @$data->shortcodes }}</code>
                                                @else
                                                    <code>[first_name], [name], [upload_stock_link], [english_phone_number], [phone], [email], [verification_link], [team_member_name], [view_seller_link], [product_name], [contact_preferred_method], [notes], [view_buyer_link], [username], [password], [buyerlead_step1_link], [buyerlead_step2_link], [stock_id], [seller_username], [buyer_id], [buyer_username], [stock_price], [buyer_total_prefs], [profit_per_ton], [view_matches_link], [order_cofirm_url], [order_edit_url]</code>
                                            @endif
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content'))->class('form-control-label')->for('email_content') }}
                                            {{ html()->textarea('buyer_email_content')
                                                ->class('form-control tiny-editor')
                                                ->placeholder(__('labels.backend.templates.email_content'))
                                                ->value(old('buyer_email_content', @$data->buyer_email_content))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content_de'))->class('form-control-label')->for('email_content_de') }}
                                            {{ html()->textarea('buyer_email_content_de')
                                                ->class('form-control tiny-editor')
                                                ->placeholder(__('labels.backend.templates.email_content_de'))
                                                ->value(old('email_content_de', @$data->buyer_email_content_de))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content_pl'))->class('form-control-label')->for('email_content_pl') }}
                                            {{ html()->textarea('buyer_email_content_pl')
                                                ->class('form-control tiny-editor')
                                                ->placeholder(__('labels.backend.templates.email_content_pl'))
                                                ->value(old('buyer_email_content_pl', @$data->buyer_email_content_pl))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content'))->class('form-control-label')->for('sms_content') }}
                                            {{ html()->textarea('buyer_sms_content')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content'))
                                                ->value(old('buyer_sms_content', @$data->buyer_sms_content))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content_de'))->class('form-control-label')->for('sms_content_de') }}
                                            {{ html()->textarea('buyer_sms_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content_de'))
                                                ->value(old('buyer_sms_content_de', @$data->buyer_sms_content_de))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        
                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content_pl'))->class('form-control-label')->for('sms_content_pl') }}
                                            {{ html()->textarea('buyer_sms_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content_pl'))
                                                ->value(old('buyer_sms_content_pl', @$data->buyer_sms_content_pl))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(EN)'))->class('form-control-label')->for('sms_content_en') }}
                                            {{ html()->textarea('buyer_push_content')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(EN)'))
                                                ->value(old('buyer_push_content', @$data->buyer_push_content))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(DE)'))->class('form-control-label')->for('sms_content_de') }}
                                            {{ html()->textarea('buyer_push_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(DE)'))
                                                ->value(old('buyer_push_content_de', @$data->buyer_push_content_de))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(PL)'))->class('form-control-label')->for('sms_content_pl') }}
                                            {{ html()->textarea('buyer_push_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(PL)'))
                                                ->value(old('buyer_push_content_pl', @$data->buyer_push_content_pl))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                           {{ html()->label('Push Sound')->class('form-control-label') }}
                                            </div>
                                            <div class="col-md-10">
                                            <select name="push_notification_sound" class="form-control">
                                            <option value="1">Sound-1</option>
                                            <option value="2">Sound-2</option>
                                            </select>
                                            </div>
                                            </div>
                                        
                                        
                                        <!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            {{ html()->label('Status')->class('form-control-label') }}
                                        </div>
                                        <div class="col-md-10">
                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                    html()->checkbox('buyer_status',  @$data->buyer_status ?? 1, '1')
                                                    ->class('switch-input pref_check')
                                                    ->id('buyer_status')
                                                    . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                                    ->class('switch switch-label switch-pill switch-success mr-2')
                                                    ->for('buyer_status') 
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div><!--col-->
                            </div><!--row-->
                        </div>
                        <div id="vk1003" class="tab-pane">
                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.subject'))->class('form-control-label')->for('subject') }}
                                            {{ html()->text('trader_subject')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.subject'))
                                                ->value(old('trader_subject', @$data->trader_subject))
                                                ->attribute('maxlength', 191)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.shortcodes'))->class('form-control-label')->for('shortcodes') }}
                                            @if(@$data->id)
                                                @section('title',__('Edit Message Template') . ' :: ' . app_name())
                                                    <code>{{ @$data->shortcodes }}</code>
                                                @else
                                                    <code>[first_name], [name], [upload_stock_link], [english_phone_number], [phone], [email], [verification_link], [team_member_name], [view_seller_link], [product_name], [contact_preferred_method], [notes], [view_buyer_link], [username], [password], [buyerlead_step1_link], [buyerlead_step2_link], [stock_id], [seller_username], [buyer_id], [buyer_username], [stock_price], [buyer_total_prefs], [profit_per_ton], [view_matches_link], [order_cofirm_url], [order_edit_url]</code>
                                            @endif
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content'))->class('form-control-label')->for('email_content') }}
                                            {{ html()->textarea('trader_email_content')
                                                ->class('form-control tiny-editor')
                                                ->placeholder(__('labels.backend.templates.email_content'))
                                                ->value(old('trader_email_content', @$data->trader_email_content))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content_de'))->class('form-control-label')->for('email_content_de') }}
                                            {{ html()->textarea('trader_email_content_de')
                                                ->class('form-control tiny-editor')
                                                ->placeholder(__('labels.backend.templates.email_content_de'))
                                                ->value(old('trader_email_content_de', @$data->trader_email_content_de))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {{ html()->label(__('labels.backend.templates.email_content_pl'))->class('form-control-label')->for('email_content_pl') }}
                                            {{ html()->textarea('trader_email_content_pl')
                                                ->class('form-control tiny-editor')
                                                ->placeholder(__('labels.backend.templates.email_content_pl'))
                                                ->value(old('trader_email_content_pl', @$data->trader_email_content_pl))
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content'))->class('form-control-label')->for('sms_content') }}
                                            {{ html()->textarea('trader_sms_content')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content'))
                                                ->value(old('trader_sms_content', @$data->trader_sms_content))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content_de'))->class('form-control-label')->for('sms_content_de') }}
                                            {{ html()->textarea('trader_sms_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content_de'))
                                                ->value(old('trader_sms_content_de', @$data->trader_sms_content_de))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        
                                        <div class="col-md-4">
                                            {{ html()->label(__('labels.backend.templates.sms_content_pl'))->class('form-control-label')->for('sms_content_pl') }}
                                            {{ html()->textarea('trader_sms_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.templates.sms_content_pl'))
                                                ->value(old('trader_sms_content_pl', @$data->trader_sms_content_pl))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(EN)'))->class('form-control-label')->for('sms_content_en') }}
                                            {{ html()->textarea('trader_push_content')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(EN)'))
                                                ->value(old('trader_push_content', @$data->trader_push_content))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(DE)'))->class('form-control-label')->for('sms_content_de') }}
                                            {{ html()->textarea('trader_push_content_de')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(DE)'))
                                                ->value(old('trader_push_content_de', @$data->trader_push_content_de))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->

                                        <div class="col-md-4">
                                            {{ html()->label(__('Push Notification(PL)'))->class('form-control-label')->for('sms_content_pl') }}
                                            {{ html()->textarea('trader_push_content_pl')
                                                ->class('form-control')
                                                ->placeholder(__('Push Notification(PL)'))
                                                ->value(old('trader_push_content_pl', @$data->trader_push_content_pl))
                                                ->attribute('rows', 8)
                                            }}
                                            <div class="invalid-feedback"></div>
                                        </div><!--col-->
                                    </div><!--form-group-->
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                       {{ html()->label('Push Sound')->class('form-control-label') }}
                                        </div>
                                        <div class="col-md-10">
                                        <select name="push_notification_sound" class="form-control">
                                        <option value="1">Sound-1</option>
                                        <option value="2">Sound-2</option>
                                        </select>
                                        </div>
                                        </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            {{ html()->label('Status')->class('form-control-label') }}
                                        </div>
                                        <div class="col-md-10">
                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                    html()->checkbox('trader_status',  @$data->trader_status ?? 1, '1')
                                                    ->class('switch-input pref_check')
                                                    ->id('trader_status')
                                                    . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                                    ->class('switch switch-label switch-pill switch-success mr-2')
                                                    ->for('trader_status') 
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div><!--col-->
                            </div><!--row-->
                        </div>
                        @foreach($roles as $role)
                        
                                                @php $rolename = $role->name; @endphp
                            <div id="vk{{ $role->id }}" class="tab-pane">
                                <div class="row mt-4 mb-4">
                                    <div class="col">

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                {{ html()->label(__('labels.backend.templates.subject'))->class('form-control-label')->for('subject') }}
                                                {{ html()->text(@$role->name.'[subject]')
                                                    ->class('form-control')
                                                    ->placeholder(__('labels.backend.templates.subject'))
                                                    ->value(old('title', @$data->roles_content->$rolename->subject))
                                                    ->attribute('maxlength', 191)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                {{ html()->label(__('labels.backend.templates.shortcodes'))->class('form-control-label')->for('shortcodes') }}
                                                @if(@$data->id)
                                                    @section('title',__('Edit Message Template') . ' :: ' . app_name())
                                                        <code>{{ @$data->shortcodes }}</code>
                                                    @else
                                                        <code>[first_name], [name], [upload_stock_link], [english_phone_number], [phone], [email], [verification_link], [team_member_name], [view_seller_link], [product_name], [contact_preferred_method], [notes], [view_buyer_link], [username], [password], [buyerlead_step1_link], [buyerlead_step2_link], [stock_id], [seller_username], [buyer_id], [buyer_username], [stock_price], [buyer_total_prefs], [profit_per_ton], [view_matches_link]</code>
                                                @endif
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                {{ html()->label(__('labels.backend.templates.email_content'))->class('form-control-label')->for('email_content') }}
                                                {{ html()->textarea(@$role->name.'[email_content]')
                                                    ->class('form-control tiny-editor')
                                                    ->placeholder(__('labels.backend.templates.email_content'))
                                                    ->value(old('email_content', @$data->roles_content->$rolename->email_content))
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                {{ html()->label(__('labels.backend.templates.email_content_de'))->class('form-control-label')->for('email_content_de') }}
                                                {{ html()->textarea(@$role->name.'[email_content_de]')
                                                    ->class('form-control tiny-editor')
                                                    ->placeholder(__('labels.backend.templates.email_content_de'))
                                                    ->value(old('email_content_de', @$data->roles_content->$rolename->email_content_de))
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                {{ html()->label(__('labels.backend.templates.email_content_pl'))->class('form-control-label')->for('email_content_pl') }}
                                                {{ html()->textarea(@$role->name.'[email_content_pl]')
                                                    ->class('form-control tiny-editor')
                                                    ->placeholder(__('labels.backend.templates.email_content_pl'))
                                                    ->value(old('email_content_pl', @$data->roles_content->$rolename->email_content_pl))
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                {{ html()->label(__('labels.backend.templates.sms_content'))->class('form-control-label')->for('sms_content') }}
                                                {{ html()->textarea(@$role->name.'[sms_content]')
                                                    ->class('form-control')
                                                    ->placeholder(__('labels.backend.templates.sms_content'))
                                                    ->value(old('sms_content', @$data->roles_content->$rolename->sms_content))
                                                    ->attribute('rows', 8)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->

                                            <div class="col-md-4">
                                                {{ html()->label(__('labels.backend.templates.sms_content_de'))->class('form-control-label')->for('sms_content_de') }}
                                                {{ html()->textarea(@$role->name.'[sms_content_de]')
                                                    ->class('form-control')
                                                    ->placeholder(__('labels.backend.templates.sms_content_de'))
                                                    ->value(old('sms_content_de', @$data->roles_content->$rolename->sms_content_de))
                                                    ->attribute('rows', 8)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                            
                                            <div class="col-md-4">
                                                {{ html()->label(__('labels.backend.templates.sms_content_pl'))->class('form-control-label')->for('sms_content_pl') }}
                                                {{ html()->textarea(@$role->name.'[sms_content_pl]')
                                                    ->class('form-control')
                                                    ->placeholder(__('labels.backend.templates.sms_content_pl'))
                                                    ->value(old('sms_content', @$data->roles_content->$rolename->sms_content_pl))
                                                    ->attribute('rows', 8)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                {{ html()->label(__('Push Notification(EN)'))->class('form-control-label')->for('sms_content_en') }}
                                                {{ html()->textarea(@$role->name.'[push_notification_content_en]')
                                                    ->class('form-control')
                                                    ->placeholder(__('Push Notification(EN)'))
                                                    ->value(old('push_content_en', @$data->roles_content->$rolename->push_content_en))
                                                    ->attribute('rows', 8)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->

                                            <div class="col-md-4">
                                                {{ html()->label(__('Push Notification(DE)'))->class('form-control-label')->for('sms_content_de') }}
                                                {{ html()->textarea(@$role->name.'[push_notification_content_de]')
                                                    ->class('form-control')
                                                    ->placeholder(__('Push Notification(DE)'))
                                                    ->value(old('push_content_de', @$data->roles_content->$rolename->push_content_de))
                                                    ->attribute('rows', 8)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->

                                            <div class="col-md-4">
                                                {{ html()->label(__('Push Notification(PL)'))->class('form-control-label')->for('sms_content_pl') }}
                                                {{ html()->textarea(@$role->name.'[push_notification_content_pl]')
                                                    ->class('form-control')
                                                    ->placeholder(__('Push Notification(PL)'))
                                                    ->value(old('push_content_pl', @$data->roles_content->$rolename->push_content_pl))
                                                    ->attribute('rows', 8)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div><!--col-->
                                        </div><!--form-group-->
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                           {{ html()->label('Push Sound')->class('form-control-label') }}
                                            </div>
                                            <div class="col-md-10">
                                            <select name="push_notification_sound" class="form-control">
                                            <option value="1">Sound-1</option>
                                            <option value="2">Sound-2</option>
                                            </select>
                                            </div>
                                            </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                {{ html()->label('Status')->class('form-control-label') }}
                                            </div>
                                            <div class="col-md-10">
                                                <div class="checkbox d-flex align-items-center">
                                                    {{ html()->label(
                                                        html()->checkbox(@$role->name.'[status]',  @$data->roles_content->$rolename->status ?? 1, '1')
                                                        ->class('switch-input pref_check')
                                                        ->id(@$role->name.'_status')
                                                        . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                                        ->class('switch switch-label switch-pill switch-success mr-2')
                                                        ->for(@$role->name.'_status') 
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        
  
                                    </div><!--col-->
                                </div><!--row-->
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Message Footer</h4>
                    </div>
                    <div class="col-md-4">
                        {{ html()->label('Footer EN')->class('form-control-label')->for('footer_en') }}
                        {{ html()->textarea('footer_en')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.footer_title_en'))
                            ->value(old('title', @$data->footer_en))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Footer DE')->class('form-control-label')->for('footer_de') }}
                        {{ html()->textarea('footer_de')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.footer_title_de'))
                            ->value(old('title', @$data->footer_de))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Footer PL')->class('form-control-label')->for('footer_pl') }}
                        {{ html()->textarea('footer_pl')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.footer_title_pl'))
                            ->value(old('title', @$data->footer_pl))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                </div>
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.email-templates.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        <input type="hidden" name="id" value="{{@$data->id}}">
                        @if(@$data->id)
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        @else
                            {{ form_submit(__('buttons.general.crud.create')) }}
                        @endif
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    @php
      $url = route('admin.email-templates.store');
      $redirect_url = route('admin.email-templates.index');
    @endphp
@endsection
@push('after-scripts')

@push('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.9/tinymce.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.9/jquery.tinymce.min.js"></script>
   <script>
        $(document).on('click', '.recptabs', function() {
            $(this).parent().find('li').removeClass('active');
            $(this).addClass('active');
        });
    var editor_config = {
          path_absolute : "",
          selector: "#email_content, #email_content_pl, #email_content_de, .tiny-editor",
          /* plugins:['advlist lists autolink link table wordcount searchreplace imagetools',
         'template paste textcolor colorpicker textpattern media','code','image imagetools'], */
    		 plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak',
    		'searchreplace wordcount visualblocks visualchars code fullscreen',
    		'insertdatetime media nonbreaking save table contextmenu directionality',
    		'emoticons template paste textcolor colorpicker textpattern imagetools'
    		],
    	   toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    	   toolbar2: 'print preview media | forecolor backcolor emoticons',
    	   image_advtab: true,


          relative_urls: false,
          height:400,
          file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
            if (type == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
              file : cmsURL,
              title : 'Filemanager',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no"
            });
          }
        };

        tinymce.init(editor_config);

    </script>
@endpush



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.userrole', function() {
        if($(this).is(':checked')){
            var id = $(this).attr('role-id');
            $(this).prev().val(id);
        }else{
            $(this).prev().val(0);
        }
    });

    $('#formsubmit2').on('submit', function(event) {
        event.preventDefault();

        $('.has-danger').next().children().children().css({
            "border": ""
        });
        $('.is-invalid').removeClass("is-invalid");
        $('.invalid-feedback').html("");
        $('.has-danger').removeClass("has-danger");

        var formData = new FormData($(this)[0]);

        $( ".pref_check" ).each(function( key, value ) {
            if(value.value == 0){
                formData.append(value.name, value.value);
            }
        });

        $.ajax({
            url: "{{ $url }}",
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
             $('.loading').removeClass('loading_hide');
            },
            success: function(data) {
                $('.loading').addClass('loading_hide');
                if (data.status == 'success') {
                    Swal.fire('Sent!', data.message, 'success');
                    setTimeout(function() {
                        window.location.href = "{{ $redirect_url }}";
                    }, 500);
                }
                if (data.status == 'error') {
                    Swal.fire('Error!', data.message, 'error');
                }
            },
            error: function(data) {
                $('.loading').addClass('loading_hide');
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

    $('body').on('click', '.pref_check', function(){
        if(this.checked){
            $(this).val(1);
            $(this).attr('checked','checked');
        }else{
            $(this).val(0);
            $(this).removeAttr('checked');
        }
    })
</script>
 <script type="text/javascript">
    $(document).ready(function() {
    $('#form_email_template_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ (isset($data->id)) ? route('admin.email-templates.update', $data->id) : route('admin.email-templates.store') }}",
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
            $('.loading').addClass('loading_hide');
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
              window.location.href = "{{  route('admin.email-templates.index') }}";
            }, 2000);
          }
          if(data.status == 'error'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
          }
        },
        error :function( data ) {
          $('.loading').addClass('loading_hide');
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
