@extends('backend.layouts.app')

@section('title',  __('strings.backend.dashboard.title'). ' :: ' . app_name())
@role('seller')
@php $route_pre = 'seller';
 $redirecturl =  route($route_pre.'.stockv2.index');
 @endphp
@else
@php $route_pre = 'admin';
 $redirecturl =  route($route_pre.'.stockv2.index');
 @endphp
@endif
@php $userrole = auth_roles(); @endphp

@section('content')
  <div class="row">
    <div class="col">
      <div class="card"> 
        <div class="card-header card-header-dashboard">
          <!-- <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}! TO VEG KING EUROPE</strong> -->

           <!-- <strong class="note">WELCOME TO VEG KING EUROPE</strong> -->
             <strong>Hello {{ $logged_in_user->name }}! </strong>
        </div><!--card-header-->
          <div class="card-body">
          @if(isset($msg))
          <div class="card-body alert-danger">
                <div class="row">
                    <div class="col-sm-12">
                        <div>{{ $msg }}</div>
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
            @if(Auth()->user()->hasRole('administrator'))
              @php $roles = auth_roles(); @endphp
              @php $selected_role = \Session::get('roles'); @endphp
              <select id="changeApp" class="form-control select2">
                <option>SELECT APP DEV</option>
                <option value="https://dev.vegking.eu">Dev</option>
                <option value="https://dev1.vegking.eu">Dev1</option>
                <option value="https://dev2.vegking.eu">Dev2</option>
                <option value="https://dev3.vegking.eu">Dev3</option>
                <option value="https://dev4.vegking.eu">Dev4</option>
                <option value="https://dev5.vegking.eu">Dev5</option>
                <option value="https://dev6.vegking.eu">Dev6</option>
                <option value="https://vegking.eu/">Live</option>
              </select>
              <select id="changeRole" class="form-control select2">
                <option>Select Role</option>
                @foreach($roles as $role)
                  <option value="{{ $role }}" @if($role == $selected_role)selected="selected"@endif>{{ ucwords($role) }}</option>
                @endforeach
              </select>
               <div class="row">
                  <div class="col-md-6">
                    {{ html()->select("cli")->id("cli")
                      ->class('select2 form-control products-details')
                      ->options(@$tradersArr)
                      ->value(@$traderid)
                      ->attribute('id','trader_selection')
                      ->placeholder('Choose Trader')
                    }}
                  </div>
                </div>
                @php $dataCount = 0; @endphp
                @if(isset($salesByPriceArrSsalesByProduct))
                  @foreach(@$salesByPriceArrSsalesByProduct as $month)
                    @if($month)
                      @php $dataCount++; @endphp
                    @endif
                  @endforeach
                @endif
                @if(@$dataCount)
                  <div class="row">
                    <div class="col-md-6">
                      <canvas id="canvas"></canvas>
                    </div>
                      
                    <div class="col-md-6">
                      <canvas id="canvas2"></canvas>
                    </div>
                  </div>
                @endif
            @endif
            @if (\Session::has('success'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {!! \Session::get('success') !!}
              </div>
            @endif
              @if(auth()->user()->confirmed != 1)
                <!-- <div class="alert alert-light"> -->
                 <!--  {!! __('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e(auth()->user()->{auth()->user()->getUuidName()}) )]) !!} -->
                  
                <!-- </div> -->
                  <div class="text-muted lightblue">
                 
                  Once we verify your account we will update your weekly offers.
                </div>
              @endif
              
              @if(count(auth_roles()) != 1 )
                @if((auth()->user()->hasRole('seller')) || (auth()->user()->hasRole('buyer'))) 
                  @php $roles = \Session::get('roles'); @endphp
                  
                  @if($roles)
                     @if($roles =='seller')
                      <span class="btn" style="font-size: 20px;font-weight: 600;padding: 0;">Please click to </span>
                          <!-- THIS IS SELLER SECTION -->
                      <div class="main-btns">
                       <div class="btn-newStocks stock-btns">
                          <a href="javascript:void(0);" data-toggle="modal" data-target="#createModals" class="btn-shadow" title="Add a New Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> ADD NEW STOCK                       
                          <a class="yellow-btn">ADD A NEW PRODUCT TO YOUR STOCKS</a>

                    @include('backend.includes.stock-modal') 
                   </div>
                     <div class="btn-newStocks stock-btns">
                     <a href="javascript:void(0);" class="gray-btns btn-shadow View_stock" title="View Your Stocks" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> My STOCKS</a>
 <a class="yellow-btn">CHECK ALL YOUR ADDED STOCKS</a>
                        </div>
                      </div>
						@include('backend.includes.stock-modal2',['productimage' => '$productsimage'])
                  
            @if(get_order_count_for_seller() > 0)
                       @can('view sales')
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-5">
                                    <h4 class="card-title mb-0">
                                      {{ __('menus.backend.trading.sales.all') }} <small class="text-muted"></small>
                                    </h4>
                                  </div><!--col-->
                                </div><!--row-->
 
                                <div class="row mt-2">
                                  <div class="col">
                                    <div class="table-offers">
                                      <table id="sales_table" class="table table-bordered data-table">
                                        <thead>
                                          <tr>
                                            <th>@lang('labels.backend.trading.offers.table.id')</th>
                                            @role('administrator')
                                              <th>Buyer</th>
                                            @endif
                                            <th>Payment Term</th>
                                            <th>Payment Type</th>
                                            <th>Payment Currency</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Order Status</th>
                                            <th>@lang('labels.backend.trading.offers.table.status')</th>
                                            <th>@lang('labels.backend.trading.offers.table.date')</th>
                                            @role('administrator')
                                              <th>@lang('labels.general.actions')</th>
                                            @endif
                                          </tr>
                                          </thead>
                                          <tfoot>
                                            <tr id="filter">
                                              <th data-title="@lang('labels.backend.trading.offers.table.id')"></th>
                                              @role('administrator')
                                                <th data-title="Buyer"></th>
                                              @endif  
                                              <th data-title="Payment Term"></th>
                                              <th data-title="Payment Type"></th>
                                              <th data-title="Payment Currency"></th>
                                              <th data-title="Quantity"></th>
                                              <th data-title="Price"></th>
                                              <th data-title="Order Status"></th>
                                              <th data-title="@lang('labels.backend.trading.offers.table.status')"></th>
                                              <th data-title="@lang('labels.backend.trading.offers.table.date')"></th>
                                              @role('administrator') 
                                                <th data-title=""></th> 
                                              @endif
                                            </tr>
                                          </tfoot>   
                                        </table>
                                      </div>
                                    </div><!--col-->
                                  </div><!--row-->
                                </div><!--card-body-->
                              </div><!--card-->
                            @endcan
                          @endif
                      @endif
					 
                        @if($roles =='buyer')
                  <!-- THIS IS BUYER SECTION -->
                     <div class="main-btns">
    <div class="btn-newStocks stock-btns">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#createBuyerModal" class="btn-shadow" title="Add a New Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> ADD PREFERENCES </a>
        <a class="yellow-btn">CLICK TO ADD NEW PREFERENCES</a>
         @include('backend.includes.pref-modal',['productimage' => '$productsimage'])
    </div>
    <div class="btn-yourStocks stock-btns">
        
        <a href="javascript:void(0);"  id="" class="gray-btns btn-shadow updatePrefs" title="UPDATE PREFERENCES" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> UPDATE PREFERENCES</a>
        <a class="yellow-btn">CLICK TO UPDATE PREFERENCES</a>
    </div>
</div>
                                    <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#createBuyerModal" class="btn btn-success ml-1" title="Add a Buyer Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i>  Add Prefrences</a> -->
                 
                          
                              <style type="text/css">
                                .showmore-invalid {border:2px solid #dc3545;}
                              </style>
                              <div class="form-group row mt-3">
                                <div class="col-md-12">
                                  <!-- <button style="bottom:0px; left:15px;" name="Show Buyer Update Prefrences" id="updatePrefs" type="button" class="btn btn-success btn-md">Update Prefrences</button> -->
                                </div>
                              </div>
                              <div class="prefsHide buyerPrefs">
                                <span class="btn" style="font-size: 16px;font-weight: 600;padding: 0;">Please click to </span>
                                <a href="{{ route('buyer.get_quote') }}" class="btn btn-success ml-1" name="Get Qoute Buyer Dashboard" @if(auth()->user()->confirmed != 1) onclick="Swal.fire('Error!', 'Please verify your email first to Get Quote, 'info'); return false;" @endif title="Get Quote" data-toggle="tooltip" ><i class="fas fa-paper-plane"></i> Get Quote</a>
                                <div class="form-group row mt-3">
                                  <div class="col-md-12">
                                    <button style="bottom:0px; left:15px;" type="button" name="Add Your Prefrences Buyer Dashboard" class="pro-btnAdd btn btn-success btn-md">Add your Prefrences +</button>
                                  </div>
                                </div>
                                {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
                                @php @$tab_key =1; @endphp
                                @php @$tab_key_heading = @$tab_key_heading2 = 1; @endphp
                                <div id="product_prefs_box2">
                                  <hr class="mb-4">
                                  <div id="products_specs">
                                    <div class="row">
                                      <div class="col-md-12" id="tabs">
                                        <ul class="nav nav-tabs ui-sortable">
                                          @if(isset($productPrefRel))
                                          @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                                            <li class="nav-item "><a class="nav-link {{ (@$tab_key_heading ==1)?'active':'' }}" href="#pref{{ $tab_key_heading }}" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref #{{ $tab_key_heading }}</a></li>
                                          @php @$tab_key_heading++; @endphp   
                                          @endforeach 
                                          @else
                                            <li class="nav-item "><a class="nav-link active" href="#pref1" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref #1</a></li>
                                          @endif
                                        </ul>
                                        <div class="tab-content">
                                        @if(isset($productPrefRel))
                                            @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                                              <div id="pref{{ @$tab_key_heading2 }}" class="tab-pane {{ (@$tab_key_heading2 ==1)?'active':'' }} product-group">
                                                <div class="form-group row">
                                                  {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".$tab_key_heading2."][product_name]") }}
                                                  <div class="col-md-10">
                                                    {{ html()->select("old_product[".$SPkey."][product_name]")->id("product_".@$tab_key_heading2."_product_name")
                                                      ->class('select2 form-control products-details')
                                                      ->options(@$products)
                                                      ->value(@$productProdRel[$SPkey][product_id])
                                                      ->attribute('data-pref-id', $SPkey)
                                                      ->placeholder('Choose Product')
                                                    }}
                                                  </div>
                                                </div>
                                                <div class="col-md-12">
                                                  <div class="product-nets">
                                                    @include('backend.products.stock-product-multi-pref', ['productSpecRel' => $productSpecRel,'pref_id' => $SPkey])
                                                  </div>
                                                  @if(!empty($productSpecRel))  
                                                    @foreach($productSpecRel as $pKey=>$productSpec)
                                                      @if(isset($productSpec['field_type']) && $productSpec['field_type'] == 'optionrange' )
                                                        <div class="form-group row">
                                                          {{ html()->label('<strong>Size ranges</strong>')->class('col-md-12 form-control-label')->for('size_ranges') }}
                                                          <div id="size_ranges" class="col-md-12" style="padding-bottom:40px; position:relative">
                                                            <div class="r-group form-group row">
                                                              <div class="col-md-3">
                                                                <label class="form-control-label">Min</label>
                                                                <input class="form-control" type="text" value="{{@$stock->size_from ?? '45'}}" placeholder="From" name="size_range[{{ $pKey }}][size_from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />
                                                              </div>
                                                              <div class="col-md-3">
                                                                <label class="form-control-label">Max</label>
                                                                <input class="form-control" type="text" value="{{@$stock->size_to ?? '65'}}" placeholder="to" name="size_range[{{ $pKey }}][size_to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />
                                                              </div>
                                                              <div class="col-md-3">
                                                                <label class="form-control-label">Premium</label>
                                                                <input class="form-control" type="number" name="size_range[0][premium]" id="size_range_0_premium" data-pattern-name="size_range[++][premium]" data-pattern-id="size_range_++_premium" value="0" data-decimals="0" min="-10" max="10" step="1"/>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <label class="form-control-label d-block">&nbsp;</label>
                                                                <button type="button" class="r-btnRemove btn btn-danger btn-md">Remove -</button>
                                                              </div>
                                                            </div>
                                                            <button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd btn btn-success btn-md">Add +</button>
                                                          </div>
                                                        </div>
                                                        <!--form-group-->
                                                      @endif
                                                    @endforeach
                                                  @endif
                                                </div>
                                              </div>
                                            @php @$tab_key = $SPkey; @$tab_key++; @$tab_key_heading2++; @endphp
                                            @endforeach
                                            @else
                                              <div id="pref1" class="tab-pane active product-group">
                                              <div class="form-group row">
                                                  {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".@$tab_key."][product_name]") }}
                                                  <div class="col-md-10">
                                                    {{ html()->select("product[".@$tab_key."][product_name]")->id("product_".@$tab_key."_product_name")
                                                      ->class('select2 form-control products-details')
                                                      ->options(@$products)
                                                      ->value(@$buyer->product->id)
                                                      ->attribute('data-pref-id', @$tab_key)
                                                      ->placeholder('Choose Product')
                                                    }}
                                                  </div>
                                                </div>
                                                <div class="col-md-12">
                                                  <div class="product-nets"></div>
                                                </div>
                                              </div>
                                              @php @$tab_key++; @endphp
                                              @php @$tab_key_heading++; @endphp   
                                        @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                               
                        @endif
                 @endif
                 @endif
                 @else
                 @role('seller')
                 <!--<span class="btn" style="font-size: 20px; font-weight: 600; padding: 0;">Please click to </span>-->
                 <div class="main-btns">
                    <div class="btn-newStocks stock-btns">
                      <a href="javascript:void(0);" data-toggle="modal" data-target="#createModals" class="btn-shadow" title="Add a New Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> ADD NEW STOCK                       
                      <a class="yellow-btn">ADD A NEW PRODUCT TO YOUR STOCKS</a>
                      
                    </div>

                  <div class="btn-yourStocks stock-btns">
                  <a href="javascript:void(0);" class="gray-btns btn-shadow View_stock" title="View Your Stocks" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> My STOCKS</a>
                        <a class="yellow-btn">CHECK ALL YOUR ADDED STOCKS</a>
                      </div>
                    </div>
                  
						      @include('backend.includes.stock-modal2',['productimage' => '$productsimage'])
                  @if(get_order_count_for_seller() > 0)
                            @can('view sales')
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-5">
                                    <h4 class="card-title mb-0">
                                      {{ __('menus.backend.trading.sales.all') }} <small class="text-muted"></small>
                                    </h4>
                                  </div><!--col-->
                                </div><!--row-->

                                <div class="row mt-2">
                                  <div class="col">
                                    <div class="table-offers">
                                      <table id="sales_table" class="table table-bordered data-table">
                                        <thead>
                                          <tr>
                                            <th>@lang('labels.backend.trading.offers.table.id')</th>
                                            @role('administrator')
                                              <th>Buyer</th>
                                            @endif
                                            <th>Payment Term</th>
                                            <th>Payment Type</th>
                                            <th>Payment Currency</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Order Status</th>
                                            <th>@lang('labels.backend.trading.offers.table.status')</th>
                                            <th>@lang('labels.backend.trading.offers.table.date')</th>
                                            @role('administrator')
                                              <th>@lang('labels.general.actions')</th>
                                            @endif
                                          </tr>
                                          </thead>
                                          <tfoot>
                                            <tr id="filter">
                                              <th data-title="@lang('labels.backend.trading.offers.table.id')"></th>
                                              @role('administrator')
                                                <th data-title="Buyer"></th>
                                              @endif  
                                              <th data-title="Payment Term"></th>
                                              <th data-title="Payment Type"></th>
                                              <th data-title="Payment Currency"></th>
                                              <th data-title="Quantity"></th>
                                              <th data-title="Price"></th>
                                              <th data-title="Order Status"></th>
                                              <th data-title="@lang('labels.backend.trading.offers.table.status')"></th>
                                              <th data-title="@lang('labels.backend.trading.offers.table.date')"></th>
                                              @role('administrator') 
                                                <th data-title=""></th> 
                                              @endif
                                            </tr>
                                          </tfoot>   
                                        </table>
                                      </div>
                                    </div><!--col-->
                                  </div><!--row-->
                                </div><!--card-body-->
                              </div><!--card-->
                            @endcan
                         @endif   
                 @endrole
                 @role('buyer')
                      <style type="text/css">
                        .showmore-invalid {border:2px solid #dc3545;}
                      </style>
                         <div class="main-btns">
					   <div class="btn-newStocks stock-btns">
              
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#createBuyerModal" class="btn-shadow" title="ADD PREFERENCES" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> ADD PREFERENCES </a>
                  <a class="yellow-btn">CLICK TO ADD NEW PREFERENCES</a>

                @include('backend.includes.pref-modal',['productimage' => '$productsimage'])
          </div>

          <div class="btn-yourStocks stock-btns">
           
              <a href="javascript:void(0);"  id="" class="gray-btns btn-shadow updatePrefs" title="UPDATE PREFERENCES" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> UPDATE PREFERENCES</a>
              <a class="yellow-btn">CLICK TO UPDATE PREFERENCES</a>
          </div>
        </div>
					    {{-- <a href="javascript:void(0);" data-toggle="modal" data-target="#createBuyerModal" class="btn btn-success ml-1" title="Add a Buyer Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> Add Prefrences</a> --}}
               
				  
                      {{-- <div class="form-group row mt-3">
                        <div class="col-md-12">
                          <button style="bottom:0px; left:15px;" name="Show Buyer Update Prefrences" id="updatePrefs" type="button" class="btn btn-success btn-md">Update Prefrences</button>
                        </div>
                      </div> --}}
                      <div class="prefsHide buyerPrefs">
                        <span class="btn" style="font-size: 16px;font-weight: 600;padding: 0;">Please click to </span>
                        <a href="{{ route('buyer.get_quote') }}" class="btn btn-success ml-1" name="Get Qoute Buyer Dashboard" @if(auth()->user()->confirmed != 1) onclick="Swal.fire('Error!', 'Please verify your email first to Get Quote, 'info'); return false;" @endif title="Get Quote" data-toggle="tooltip" ><i class="fas fa-paper-plane"></i> Get Quote</a>
                        <div class="form-group row mt-3">
                          <div class="col-md-12">
                            <button style="bottom:0px; left:15px;" type="button" name="Add Your Prefrences Buyer Dashboard" class="pro-btnAdd btn btn-success btn-md">Add your Prefrences +</button>
                          </div>
                        </div>
                        {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
                        @php @$tab_key =1; @endphp
                        @php @$tab_key_heading = @$tab_key_heading2 = 1; @endphp
                        <div id="product_prefs_box2">
                          <hr class="mb-4">
                          <div id="products_specs">
                            <div class="row">
                              <div class="col-md-12" id="tabs">
                                <ul class="nav nav-tabs ui-sortable">
                                  @if(isset($productPrefRel))
                                  @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                                    <li class="nav-item "><a class="nav-link {{ (@$tab_key_heading ==1)?'active':'' }}" href="#pref{{ $tab_key_heading }}" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref #{{ $tab_key_heading }}</a></li>
                                  @php @$tab_key_heading++; @endphp   
                                  @endforeach 
                                  @else
                                    <li class="nav-item "><a class="nav-link active" href="#pref1" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref #1</a></li>
                                  @endif
                                </ul>
                                <div class="tab-content">
                                @if(isset($productPrefRel))
                                    @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                                      <div id="pref{{ @$tab_key_heading2 }}" class="tab-pane {{ (@$tab_key_heading2 ==1)?'active':'' }} product-group">
                                        <div class="form-group row">
                                          {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".$tab_key_heading2."][product_name]") }}
                                          <div class="col-md-10">
                                            {{ html()->select("old_product[".$SPkey."][product_name]")->id("product_".@$tab_key_heading2."_product_name")
                                              ->class('select2 form-control products-details')
                                              ->options(@$products)
                                              ->value(@$productProdRel[$SPkey][product_id])
                                              ->attribute('data-pref-id', $SPkey)
                                              ->placeholder('Choose Product')
                                            }}
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="product-nets">
                                            @include('backend.products.stock-product-multi-pref', ['productSpecRel' => $productSpecRel,'pref_id' => $SPkey])
                                          </div>
                                          @if(!empty($productSpecRel))  
                                            @foreach($productSpecRel as $pKey=>$productSpec)
                                              @if(isset($productSpec['field_type']) && $productSpec['field_type'] == 'optionrange' )
                                                <div class="form-group row">
                                                  {{ html()->label('<strong>Size ranges</strong>')->class('col-md-12 form-control-label')->for('size_ranges') }}
                                                  <div id="size_ranges" class="col-md-12" style="padding-bottom:40px; position:relative">
                                                    <div class="r-group form-group row">
                                                      <div class="col-md-3">
                                                        <label class="form-control-label">Min</label>
                                                        <input class="form-control" type="text" value="{{@$stock->size_from ?? '45'}}" placeholder="From" name="size_range[{{ $pKey }}][size_from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />
                                                      </div>
                                                      <div class="col-md-3">
                                                        <label class="form-control-label">Max</label>
                                                        <input class="form-control" type="text" value="{{@$stock->size_to ?? '65'}}" placeholder="to" name="size_range[{{ $pKey }}][size_to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />
                                                      </div>
                                                      <div class="col-md-3">
                                                        <label class="form-control-label">Premium</label>
                                                        <input class="form-control" type="number" name="size_range[0][premium]" id="size_range_0_premium" data-pattern-name="size_range[++][premium]" data-pattern-id="size_range_++_premium" value="0" data-decimals="0" min="-10" max="10" step="1"/>
                                                      </div>
                                                      <div class="col-md-3">
                                                        <label class="form-control-label d-block">&nbsp;</label>
                                                        <button type="button" class="r-btnRemove btn btn-danger btn-md">Remove -</button>
                                                      </div>
                                                    </div>
                                                    <button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd btn btn-success btn-md">Add +</button>
                                                  </div>
                                                </div>
                                                <!--form-group-->
                                              @endif
                                            @endforeach
                                          @endif
                                        </div>
                                      </div>
                                    @php @$tab_key = $SPkey; @$tab_key++; @$tab_key_heading2++; @endphp
                                    @endforeach
                                    @else
                                      <div id="pref1" class="tab-pane active product-group">
                                      <div class="form-group row">
                                          {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".@$tab_key."][product_name]") }}
                                          <div class="col-md-10">
                                            {{ html()->select("product[".@$tab_key."][product_name]")->id("product_".@$tab_key."_product_name")
                                              ->class('select2 form-control products-details')
                                              ->options(get_all_product_name())
                                              ->value(@$buyer->product->id)
                                              ->attribute('data-pref-id', @$tab_key)
                                              ->placeholder('Choose Product')
                                            }}
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="product-nets"></div>
                                        </div>
                                      </div>
                                      @php @$tab_key++; @endphp
                                      @php @$tab_key_heading++; @endphp   
                                @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                 @endrole
                 @endif
                    @if(!empty($buyer->id))
                      @php 
                        @$url =  route('buyer.updateBuyerPref');
                        @$buyerid = $buyer->id;
                      @endphp
                    @endif
                </div><!--card-body-->
                @if(in_array("buyer", $userrole))
                  @role('buyer')
                    <div class="card-footer clearfix">
                      <div class="prefsHide buyerPrefs">
                        <div class="row ">
                          <div class="col">
                            {{ form_cancel(route('admin.buyers.index'), __('buttons.general.cancel')) }}
                          </div><!--col-->

                          <div class="col text-right">
                            {{ form_submit(__('buttons.general.crud.update'), 'btn btn-success') }}
                          </div><!--col-->
                        </div>
                      </div><!--row-->
                    </div><!--card-footer-->
                  {{ html()->form()->close() }}
                  @endrole
                @endif
              </div><!--card-->
            </div><!--col-->
          </div><!--row-->
@endsection
@push('after-scripts')
@role('administrator')
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<script type="text/javascript"> 
var salesByPriceArr = JSON.parse('@json(@$salesByPriceArr)');
var monthNamesArr = JSON.parse('@json(@$monthNames)');
var salesByPriceArrSsalesByProduct = JSON.parse('@json(@$salesByPriceArrSsalesByProduct)');
var sbyPr = [];
$.each(salesByPriceArrSsalesByProduct,function(k,v){
    sbyPr.push(v);
});
console.log(sbyPr);
$(document).on('change','#trader_selection',function(){
    traderid = this.value;
    window.location.href="?traderid="+traderid;
});
    
    
  var barChartData = {
			labels: monthNamesArr,
			datasets: salesByPriceArr

		};
		

         var barChartData2 = {
			labels: monthNamesArr,
			datasets: [{
				label: 'Sales in $',
				backgroundColor: 'rgb(153, 102, 255)',
				data: sbyPr
			}]

		};
        
        window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					title: {
						display: true,
						text: 'Sales By Product'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: true,
						}],
						yAxes: [{
							stacked: true
						}]
					}
				}
			});
            var ctx2 = document.getElementById('canvas2').getContext('2d');
			window.myBar2 = new Chart(ctx2, {
				type: 'bar',
				data: barChartData2,
				options: {
					title: {
						display: true,
						text: 'Total Sales'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: true,
						}],
						yAxes: [{
							stacked: true
						}]
					}
				}
			});
            
          
            
		};
</script>
@endrole
<script type="text/javascript">

  $('body').on('click', '#check-verified', function (e) {
    Swal.fire('Warning!', 'You email is not verified' , 'error');
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".View_stock").click(function(e){ 
    $.ajax({
      url: "{{route('seller.get_stock_count')}}",
      method: 'POST',
      // data: { role:role },
      success: function(data)
      {
          if(data.stock_count == 0 ){
            Swal.fire('Error!',"You don't have a stock please previously add your stock ", 'error');
            setTimeout(function(){
              $('#createModals').modal('show');
          }, 2000);

          }else{
            window.location.href = "{{ route('seller.stockcardview') }}";

          }
         
      },
      error :function( data ) {
        if( data.status === 422 ) {
          $('.loading').addClass('loading_hide');
          Swal.fire('Error!', data.responseJSON.message, 'error');
          $('.btn-success').removeAttr('disabled');
        }
      }
    });
  });
  
  $(".updatePrefs").click(function(e){ 
    $.ajax({
      url: "{{route('buyer.get_pref_count')}}",
      method: 'POST',
      // data: { role:role },
      success: function(data)
      {
          if(data.buyer_count == 0 ){
            Swal.fire('Error!',"You don't have a preference please previously add your preference ", 'error');
            setTimeout(function(){
              $('#createBuyerModal').modal('show');
            }, 3000);
          }else{
            window.location.href = "{{ route('buyer.buyerpref.cardview') }}";
          }
      },
      error :function( data ) {
        if( data.status === 422 ) {
          $('.loading').addClass('loading_hide');
          Swal.fire('Error!', data.responseJSON.message, 'error');
          $('.btn-success').removeAttr('disabled');
        }
      }
    });
  });
  
  $('#changeRole').on('change',function(){
    var role = $(this).val();
    $.ajax({
      url: "{{route($route_pre.'.dashboard.changerole')}}",
      method: 'POST',
      data: { role:role },
      success: function(data)
      {
          if(data.redirect == 'buyer'){
            window.location.href = "{{ route('buyer.dashboard') }}";
          }
          if(data.redirect == 'administrator'){
            window.location.href = "{{ route('admin.dashboard') }}";
          }
          if(data.redirect == 'seller'){
            window.location.href = "{{ route('seller.dashboard') }}";
          }
          if(data.redirect == 'trader'){
            window.location.href = "{{ route('trader.dashboard') }}";
          }
       
      },
      error :function( data ) {
        if( data.status === 422 ) {
          $('.loading').addClass('loading_hide');
          Swal.fire('Error!', data.responseJSON.message, 'error');
          $('.btn-success').removeAttr('disabled');
        }
      }
    });
  });
</script>
@if(in_array("buyer", $userrole) || in_array("seller", $userrole))
@role('buyer')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-dynamic-tabs.css') }}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
  <style>.flex_item{display: inline-block;width: auto;}.checkbox .input-group{margin-right:10px}.more {display: none;}</style>
  <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-dynamic-tabs.js') }}"></script>
    <script type="text/javascript">
	var save_buyerpref_url = '{{route('buyer.buyerpref.storeajax')}}';
    var tabn = {{$tab_key ?? 1}};
    var tab_key_heading = {{$tab_key_heading??1}};
    var tabs = $('#tabs').bootstrapDynamicTabs();
    $("body").on('click','#updatePrefs',function(){
      if($('.buyerPrefs').hasClass('prefsHide')){
        $('.buyerPrefs').removeClass('prefsHide');
        $('.buyerPrefs').addClass('prefsShow');
      }else{
        $('.buyerPrefs').removeClass('prefsShow');
        $('.buyerPrefs').addClass('prefsHide');
      }    
    });
  
    $("body").on('click','.remove-this-tab',function(){
      $(this).parent().remove();
      content_id = $(this).parent().attr('data-content-id');
      $('.tab-content').find('#pref'+content_id).remove();
      $('.nav-tabs a:first').tab('show');
    });  

    $('body').on('DOMNodeInserted', 'select', function () {
      $(this).select2();
    }); 

    var products = JSON.parse('@json(@$products)');
    var selectOpt = '<option value="" selected="selected">Choose Product</option>';
    $.each(products,function(key,value){
      selectOpt += '<option value="'+key+'">'+value+'</option>'
    });

    $(".pro-btnAdd").click(function(){
      $('.nav-tabs').append('<li class="nav-item "><a class="nav-link" data-content-id="'+tabn+'" href="#pref'+tabn+'" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref#'+tab_key_heading+' <button class="close remove-this-tab" type="button">x</button></a></li>');
      $('.tab-content').append('<div id="pref'+tabn+'" class="tab-pane product-group"> <div class="form-group row"><label class="col-md-2 form-control-label" for="product[0][product_name]"><strong>Product</strong></label><div class="col-md-10">  <select class="select2 form-control products-details" data-pref-id="'+tabn+'" name="product['+tabn+'][product_name]" id="product_'+tabn+'_product_name" pref-id="0" tabindex="-1" aria-hidden="true">'+selectOpt+'</select></div></div><div class="col-md-12"> <div class="product-nets"></div></div></div></div>');
      tabn++;
      tab_key_heading++;
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      $('#tabs .showmore-invalid').popover('enable').popover('hide').popover('disable');    
    });

  $('button[type="submit"]').on('click',function(){
      $('#tabs .showmore-invalid').popover('enable').popover('hide').popover('disable');
      $('#tabs .showmore-invalid').removeClass('showmore-invalid');
      $('#tabs .nav.nav-tabs.ui-sortable .nav-link').popover('enable').popover('hide').popover('disable');
      // $('#tabs .nav.nav-tabs a[href="'+target+'"]').popover('destroy');
      // $('#tabs .nav.nav-tabs.ui-sortable .nav-link').popover('hide');

      var activetab_focusid='';
      var inactivetab_focusid='';
      $('.more select').each(function(index){
        if(!$(this)[0].checkValidity()){
            var invalid_id = $(this).closest('.tab-pane').attr('id');     
            inactivetab_focusid = $('#tabs .nav.nav-tabs a[href="#'+invalid_id+'"]');            
            $('#tabs .nav.nav-tabs a[href="#'+invalid_id+'"]').popover('enable').popover('show').popover('disable').focus();
            var target = $('a[data-toggle="tab"].active').attr("href") // activated tab
            $('#tabs .nav.nav-tabs a[href="'+target+'"]').prop('popShown', true).popover('hide');
            if('#'+invalid_id == target){
              // $(target+' .showmore').prop('popShown', true).popover('show');
              activetab_focusid = $(target+' .showmore');              
            }
         }
      });
            
      if(activetab_focusid instanceof jQuery){ 
          activetab_focusid.addClass('showmore-invalid').focus();
          activetab_focusid.popover('enable').popover('show').popover('disable');
      }else if(inactivetab_focusid instanceof jQuery){
          //inactivetab_focusid.focus()
      }
  });

  $('#formsubmit').on('submit', function(event) {
      event.preventDefault();

      var buyerid = '{{ @$buyerid }}';
      var formData = new FormData(this);      

      $( ".pref_contact" ).each(function( key, value ) {
        if(value.value == 0){
          formData.append(value.name, value.value);
        }
      });
      
      if(buyerid != 0)
      {
        formData.append('_method', 'PUT');
      }
      $.ajax({
        url: "{{ route('buyer.updateBuyerPref') }}",
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
              window.location.href = "{{ route('admin.buyers.index') }}"; 
            }, 5000);
          }
          if(data.status == 'error'){
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
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
                var n = key.search(".");
                var res = key.split(".");
                if(res.length > 1){
                    key = res[0]+"_"+res[1];
                }
                $('#'+key).parent().addClass('has-danger');
                $('#'+key).addClass('is-invalid');
                $('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
            })
          }
        }
      });
    });
    
  $('body').on('change', '.products-details', function(){
    var val = $(this).val();
    if(val == '' || val == 'undefined')
    {
        return false;
    }
    var pref_id = $(this).attr('data-pref-id');
   
    var ths = $(this);
    $(this).attr('data-pref-id', pref_id);
    $.ajax({
        type: "POST",
        url: "{{ route('buyer.trading.getproductmultiple') }}",
        data: {pid:val, pref_id:pref_id},
        success: function (data) {
            ths.parents('.product-group').find('.product-nets').html(data);
            ths.parents('.product-group').find(".product-nets input[type='number']").inputSpinner();
            $( ".checkbox.switch-box .switch input" ).each(function( index,element ) {
                switchPremium(element.id);
            });
            $('.select2').select2();
          return false;
        }
    });
  });
    $('.switch').click(function() {
      delivery_same();
      product_prefs();
      //select_all_soil();
      light_same();
      //var id = $(this).children('input').attr('id');
      switchPremium($(this).children('input').attr('id'));
    });
    $( ".checkbox.switch-box .switch input" ).each(function( index,element ) {
      switchPremium(element.id);
    });

    $("body").on("click",".any_type_selected",function(){
    dataGroup = $(this).attr('data-group');
    state = $(this).prop('checked');
    $(this).parents(".app-head-group-outer").find(".switch_select_sub_item").each(function(){
        if(state == true){
            $(this).find('input[type=number]').prop('disabled', false);
            $(this).find('input[type=checkbox]').prop('checked', true);
        } else {
            $(this).find('input[type=number]').prop('disabled', true);
            $(this).find('input[type=checkbox]').prop('checked', false);
        }
        });
    });

    $("body").on("click",".switch_select_sub_item_cb",function(){
        state = $(this).prop('checked');
        if(state == false){
            $(this).parents(".app-head-group-outer").find(".any_type_selected").prop('checked', false);
        }
    });
    $('body').on('click', '.pref_contact', function(){
      if(this.checked){
        $(this).val(1);
        $(this).attr('checked','checked');
      }else{
        $(this).val(0);
        $(this).removeAttr('checked');
      }
    });
    $('body').on('click','.switch',function() { 
       switchPremium($(this).children('input').attr('id'));
    });
 
  function switchPremium(id){
  if ($('input#'+id).prop('checked')) {
    $('input#'+id).parent().parent().find('input[type=number]').prop('disabled', false);
    $('input#'+id).closest('.accept_all').parent().find('select[name^=specification]').removeAttr('required');
  } else {
    $('input#'+id).parent().parent().find('input[type=number]').prop('disabled', true);
    $('input#'+id).closest('.accept_all').parent().find('select[name^=specification]').attr('required',true);
  }
}
function light_same(){
  var checkbox = $('input#light');
  var size_range_0_to =  $('#size_range_0_to').val();
  if ($(checkbox).prop('checked') && size_range_0_to > 65) {
      $('#export').prop('checked', true).change();
  } else {
    $('#export').prop('checked', false).change();
  }
}
  </script>
  @endrole

@role('seller')
@push('after-scripts')
<script type="text/javascript">

var save_stock_url = '{{route($route_pre.'.stockv2.store')}}';
var getproductforstock_url = '{{ route($route_pre.'.trading.getproductforstock') }}';
var redirecturl = '{{ $redirecturl }}';

$(document).on('click','#create_stock',function(){
    var formData = new FormData();
    formDataArr = $("#create_create_stock").serializeArray();
    $.each(formDataArr,function(k,d){
        formData.append(d.name, d.value);
    });
    
    $.ajax({
        url: "{{route($route_pre.'.stockv2.store')}}",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data)
        {
            $("#fieldset_8, #create_stock").hide();
            $("#stock_progress_bar").width('100%');
            $("#stock_progress_bar").text('100% Completed');
            $("#success_msg").show();
            Swal.fire('Sent!','Stock is successfully added.', 'success');
            setTimeout(function(){
                window.location.href = "{{ $redirecturl }}";
            }, 2000);
        },
        error :function( data ) {
            if( data.status === 422 ) {
                $('.loading').addClass('loading_hide');
               Swal.fire('Error!', data.responseJSON.message, 'error');
                $('.btn-success').removeAttr('disabled');
                var errors = [];
                errors = data.responseJSON.errors
                $.each(errors, function (key, value) {
                    var n = key.search(".");
                    var res = key.split(".");
                    if(res.length > 1){
                        key = res[0];
                        for(i=1;i<res.length;i++){
                            key += "["+res[i]+"]";
                        }
                    }
                    $('#'+key).parent().addClass('has-danger');
                    $('#'+key).addClass('is-invalid');
                    $('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                    $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                })
            }
        }
    });
    return false;
});
$("#changeApp").change(function(){
  window.location.href = $(this).val();
});


$(document).on('change','.packing-change',function(){
   $(this).parents('div.checkbox-inline').find('input[type="text"]').toggle(); 
});
$(document).on('change','.product',function(){
   var productid = $(this).val();
   var ths = $(this);
   $.ajax({
        url: "{{ route($route_pre.'.trading.getproductforstock') }}",
        method: 'POST',
        data: {'productid':productid},
        success: function(data)
        {
            var selectvariety = '';
            var selectpacking = '';
            var selectquality = ''; 
            var selectdefects = '';
           
            $.each(data.Variety,function(key,value){
                selectvariety += '<option value="'+key+'">'+value+'</option>'
            });
           
            if(data.Variety_id != null){
                $(".field1").html(selectvariety);
                $(".field1").attr('name',"fields["+data.Variety_id+"]");
                $(".field1").attr('data-id',data.Variety_id);
            } else { 
                $(".field1").html('');
                $(".field1").attr('name',"");
                $(".field1").attr('data-id',"");

            }
            
            $.each(data.Packing,function(key,value){
                inp = '';
                if(data.spec_array_packing['Packing'][key] == 1){
                    inp = "<input type='text' style='display:none;' class='vk_hide form-control col-md-3 ml-3' name='ecs["+data.Packing_id+"]["+key+"]'/>"
                }
                
                selectpacking +='<div class="checkbox-inline"><label style=" float: left;display: inline-block;"><input class="packing-change" type="checkbox" name="fields['+data.Packing_id+'][]" value="'+key+'"/>'+value+'</label>'+inp+'</div>';
            })
            $(".packing_options").html(selectpacking);
            if(selectpacking != ''){
                $(".packing_group").removeClass('vk_hide');
            } else {
                $(".packing_group").addClass('vk_hide');
            }
           
            
            $.each(data.Quality,function(key,value){
                selectquality +='<option value="'+key+'">'+value+'</option>'
            })
            
            if(data.Quality_id != null){
                $(".field3").html(selectquality);
                $(".field3").attr('name',"fields["+data.Quality_id+"][]");
                $(".field3").attr('data-id',data.Quality_id);
            } else { 
                $(".field3").html('');
                $(".field3").attr('name',"");
                $(".field3").attr('data-id',"");
            }
            
            
            $.each(data.Defects,function(key,value){
                selectdefects +='<option value="'+key+'">'+value+'</option>'
            })
            
            if(data.Defects_id != null){
                $(".field4").html(selectdefects);
                $(".field4").attr('name',"fields["+data.Defects_id+"][]");
                $(".field4").attr('data-id',data.Defects_id);
            } else { 
                $(".field4").html('');
                $(".field4").attr('name',"");
                $(".field4").attr('data-id',"");
            }
            
        },
        error :function( data ) {
            
        }
    });
});


      $(function () {
        setTimeout(function() {
            $(".alert-danger").hide();
        }, 3000);
        $('#sales_table #filter th').each( function () {
        
            var title = $(this).attr('data-title');
            if(title != '')
                $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
        } );
      
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('seller.sales.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                @if(auth()->user()->hasRole('administrator'))
                {data: 'buyer_name', name: 'buyer_name'},
                @endif
                {data: 'payment_terms_name', name: 'payment_terms_name'},
                {data: 'payment_type_name', name: 'payment_type_name'},
                {data: 'currency_name', name: 'currency_name'},
                {data: 'quantity', name: 'quantity'},
                {data: 'price', name: 'price'},
                {data: 'status', name: 'status'},
                {data: 'payment_status', name: 'payment_status'},
                {data: 'created_at', name: 'created_at'},
                @if(auth()->user()->hasRole('administrator'))
                {data: 'action', name: 'action', orderable: false, searchable: false},
                @endif
            ]
        });
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      });
      </script>

      <script type="text/javascript" src="{{asset('js/stock-modal.js')}}"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
      

  @endpush

 @endrole
 @endif
@endpush