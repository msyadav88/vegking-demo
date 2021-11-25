@extends('frontend.layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col col-sm-12 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('navs.frontend.user.account')
                    </strong>
                </div>

                <div class="card-body" style="padding: 15px 0;">





















                  <div class="container emp-profile">

                                  <div class="row">
                                      <div class="col-md-4">

                                        <!-- <div class="profile-img mb-4">
                                            <img src="{{ $logged_in_user->picture }}" class="user-profile-image" style="max-width:100%"/>
                                        </div> -->

                                        <div class="profile-head">
                                                    <h5>{{ $logged_in_user->name }}</h5>
                                                    <h6><i class="fas fa-envelope-open-text"></i> {{ $logged_in_user->email }}</h6>
                                                    <h6><i class="fas fa-phone-square-alt"></i> {{ $logged_in_user->phone }}</h6>
                                                    <hr>
                                                    <!-- <p class="proile-rating"><i class="far fa-clock"></i> <strong>@lang('labels.frontend.user.profile.created_at') :</strong><br>
                                                      <small>{{ timezone()->convertToLocal($logged_in_user->created_at) }} ({{ $logged_in_user->created_at->diffForHumans() }})</small>
                                                    </p>
                                                    <p class="proile-rating"><i class="far fa-clock"></i> <strong>@lang('labels.frontend.user.profile.last_updated') :</strong><br>
                                                      <small>{{ timezone()->convertToLocal($logged_in_user->updated_at) }} ({{ $logged_in_user->updated_at->diffForHumans() }})</small>
                                                    </p> -->

                                        </div>
                                      </div>
                                      <div class="col-md-8">
                                         <div role="tabpanel">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a href="#edit" class="nav-link active" aria-controls="edit" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.update_information')</a>
                                                </li>

                                                @if($logged_in_user->canChangePassword())
                                                    <li class="nav-item">
                                                        <a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab">@lang('navs.frontend.user.change_password')</a>
                                                    </li>
                                                @endif
                                            </ul>

                                            <div class="tab-content">

                                                <div role="tabpanel" class="tab-pane fade show active pt-3" id="edit" aria-labelledby="edit-tab">
                                                    @include('frontend.user.account.tabs.edit')
                                                </div><!--tab panel profile-->

                                                @if($logged_in_user->canChangePassword())
                                                    <div role="tabpanel" class="tab-pane fade show pt-3" id="password" aria-labelledby="password-tab">
                                                        @include('frontend.user.account.tabs.change-password')
                                                    </div><!--tab panel change password-->
                                                @endif
                                            </div><!--tab content-->
                                        </div><!--tab panel-->




                                      </div>
                                  </div>

                          </div>
























                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection
