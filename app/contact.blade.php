@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col col-sm-8">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.contact.box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

                                    {{ html()->text('name', optional(auth()->user())->name)
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.name'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                    }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email', optional(auth()->user())->email)
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

                                    {{ html()->number('phone')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.phone'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.message'))->for('message') }}

                                    {{ html()->textarea('message')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.message'))
                                        ->attribute('rows', 3)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        @if(config('access.captcha.contact'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('labels.frontend.contact.button'))->class('btn-lg') }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->

        <div class="col col-sm-4">
          <div class="card">
          <img src="{{asset('images/banner-contact.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"> Casa Borinquen Vacation Rental</h5>
            <p class="card-text"><a href="tel:1321-754-8056"><i class="fas fa-phone-square-alt"></i> 1321-754-8056</a></p>
            <p class="card-text"><a href="mailto:casaborinquenrental@gmail.com"><i class="fas fa-envelope-open-text"></i> Email Us!</a></p>
          </div>
          </div>
        </div>


    </div><!--row-->
  </div><!--container-->
@endsection

@push('after-scripts')
    @if(config('access.captcha.contact'))
        @captchaScripts
    @endif
@endpush
