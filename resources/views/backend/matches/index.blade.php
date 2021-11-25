@extends('backend.layouts.app')

@section('title', 'Matches  :: ' . app_name())
@section('content')
@if(!empty($msg))
  <div class="card-body alert-danger">
    <div class="row">
      <div class="col-sm-12">
        <div>{{ $msg }}</div>
      </div>
    </div>
  </div>
@endif
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group row" >
          <label class="col-md-12 form-control-label" for="type">Filter Matches</label>
          {{-- @if(isset($stock_list))
            <div class="col-md-2" style="display: none">
              <select class="form-control select2" name="stock_filter">
                <option value="">Select Stock</option>
                @foreach($stock_list as $stock)
                <option value="{{$stock->id}}" @if(isset($_GET['stock']) && $_GET['stock'] == $stock->id) selected @endif>
                  #{{ @$stock->id }} {{ @$stock->product->name}} [{{ @$stock->seller->username}}]
                </option>
                @endforeach
              </select>
            </div>
          @endif

          @if(isset($buyers_list))
            <div class="col-md-2" style="display: none">
              <select class="form-control select2"  name="buyer_filter">
                <option value="">Select Buyer</option>
                @foreach($buyers_list as $buyer)
                <option value="{{$buyer->id}}" @if(isset($_GET['buyer']) && $_GET['buyer'] == $buyer->id) selected @endif>
                  {{ @$buyer->username}}
                </option>
                @endforeach
              </select>
            </div>
          @endif --}}
          @if(isset($products))
            <div class="col-md-2">
              <select class="form-control select2" id="product_id" name="product_id">                  
                @foreach($products as $key => $val)
                  <option value="{{$key}}" @if(in_array($key, explode(',',@$_GET['product_id']))) selected @endif>{{ $val}}</option>
                @endforeach
              </select>
            </div>
          @endif
          @if(isset($product_specifications))
          <div class="col-md-2">
            <select class="form-control select2" id="match_type" name="match_type" multiple="multiple" data-placeholder="Match Requirement">
              @foreach($product_specifications as $key => $val)
                <option value="{{$key}}" @if(in_array($key, explode(',',@$_GET['match_type']))) selected @endif>{{ $val}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-control select2" id="exclude_match_type" name="exclude_match_type" multiple="multiple" data-placeholder="Exclude Match Requirement">
              @foreach($product_specifications as $key => $val)
                <option value="{{$key}}" @if(in_array($key, explode(',',@$_GET['exclude_match_type']))) selected @endif>{{ $val}}</option>
              @endforeach
            </select>
          </div>
          
          @endif
          <div class="col-md-2 input-boxes" style="display: none">            
            <!--please do not remove it-->
            <input type="text" value=""  id="buyer_input" class="form-control" placeholder="P Ton value" >
            <input type="text" value=""  id="stock_input" class="form-control" placeholder="P Ton value" >
            <input type="text" value="0"  id="input_press" class="form-control" placeholder="P Ton value" >
          </div>
          <div class="col-md-8">
            <div class="matches_top">
              <div class="matches_header">
                <button id="filter" class="btn btn-success" type="submit" name="filter_matches"><i class="fas fa-filter"></i>Filter</button>
                <button class="btn btn-primary"  style="margin-left:5px"type="submit" id="clear_filter" name="clear_filter"><i class="fas fa-filter"></i>Clear</button>
                <button class="btn btn-primary"  style="margin-left:5px"type="submit" id="clear_table_filter" name="clear_table_filter"><i class="fas fa-filter"></i>Clear Table Filter</button>
                <a href="{{ route('admin.matches.updateAll') }}" style="margin-left:5px" class="btn btn-primary" role="button">Rematch</a>
                <button type="button" class="m-0 btn btn-primary sendtoall mobile-view-button" style="margin-left:5px" title="Sent Invoice to All" data-url="{{ route('admin.matches.InvoiceSendtoAll') }}"><i class="fas fa-file-invoice"></i></button>
                <a href="{{ route('admin.matches.matchesexports') }}?@if(isset($_GET['stock']))stock={{$_GET['stock']}}&buyer={{$_GET['buyer']}}@endif @if(isset($_GET['match_type']))&match_type={{$_GET['match_type']}} @endif @if(isset($_GET['show_matched']))&show_matched={{$_GET['show_matched']}} @endif" class="m-0 btn btn-primary mobile-view-button" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>                

                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#updateMatchesName" class="btn btn-success btn-md ml-1 pull-right" title="Update Matches Name" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> Names</a>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#hideShowCols" class="btn btn-success btn-md ml-1 pull-right" title="Hide/Show Cols" data-toggle="tooltip" ><i class="fas fa-eye"></i> Cols</a>-->
              </div>
            </div>
        </div>

        @include('backend.includes.matches-details')
        {{-- @include('backend.includes.matches-columns', $matches_names)
        @include('backend.includes.matches-shortname', $matches_names)--}}
        
      </div>
      <div class="filterdivs">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" id="firsttoast">
          <div class="toast-header" style="background-color:#FF7F50;">
            <svg  class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
              focusable="false" role="img"></svg>
            <strong class="mr-auto"></strong>
            <small class="text-muted"></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="toast-body">
            Started Filter
          </div>
        </div>

        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" id="secondtoast">
          <div class="toast-header" style="background-color:#008000;">
            <svg  class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
              focusable="false" role="img"></svg>
            <strong class="mr-auto"></strong>
            <small class="text-muted"></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="toast-body">
            Completed Filter
          </div>
        </div>
      </div>


      <input type="hidden" name="checkfilter" id="checkfilter" value="0">
      

      <div class="col-sm-12">
        <h4 class="card-title mb-0">
          Stock Matches <small class="text-muted"></small>
        </h4>
      </div>
    
      <!--col-->
      <div id="show_matched_div" class="row col-md-12 mt-3">
        <ul class="nav nav-tabs col-md-12" role="tablist">
          <li class="nav-item"><a class="nav-link @if(request()->input('show_matched') == 'yes') active @endif " href="yes" data-toggle="tab" role="tab" id="yes"><span >M</span><span class="notificaion_badge">{{$matched_count}}</span></a></li>
          <li class="nav-item"><a class="nav-link @if(request()->input('show_matched') == 'no') active @endif" href="no" data-toggle="tab" role="tab"><span>MM</span><span class="notificaion_badge">{{$mismatched_count}}</span></a></li>
          <li class="nav-item"><a class="nav-link @if(request()->input('show_matched') == 'rejected') active @endif" href="rejected" data-toggle="tab" role="tab"><span>Rej</span><span class="notificaion_badge">{{$rejected_count}}</span></a></li>
          <li class="nav-item"><a class="nav-link @if(request()->input('show_matched') == 'loaded') active @endif" href="loaded" data-toggle="tab" role="tab"><span>WH</span><span class="notificaion_badge">{{$warehouse_count}}</span></a></li>
          <li class="nav-item"><a class="nav-link @if(!request()->input('show_matched')) active @endif" href="" data-toggle="tab" role="tab"><span>All</span><span class="notificaion_badge">{{$all_count}}</span></a></li>
        </ul>
      </div>
    </div><!--row-->
    <button type="button" class="button_class" style="border-radius: 50%;border: 1px solid;background: #0275d8;color:white;margin-top: 5%;" data-toggle="collapse" data-target="#demo" >+</button>
    <br>
    <div class="col-sm-12 collapse" id="demo">
      <div class="">Product<div>
      <input type="text" column="1" class="search_input"></div></div>
      <div id="P/Ton" data-title="Product">
        P/Ton<div class="numeric" style="display:flex"><input type="text" id="pton_input" style="width:100%" placeholder="" class="" autocomplete="off"><select id="search_pton"><option value="equal">=</option><option value="greater">&lt;</option><option value="less">&gt;</option></select></div>
      </div>
      <div class="">QTS
        <div>
          <input type="text" column="3" class="search_input">
        </div>
      </div>
      <div id="QN">QNS
        <div class="numeric" style="display:flex">
          <input type="text" id="tsb_qns" style="width:100%" placeholder="" autocomplete="off" class="">
          <select id="search_qns">
            <option value="equal">=</option>
            <option value="greater">&lt;</option>
            <option value="less">&gt;</option>
          </select>
        </div>
      </div>
      
      <div id="TSB">TSB
        <div class="numeric" style="display:flex">
          <input type="text" id="tsb_input" style="width:100%" placeholder="" autocomplete="off" class="">
          <select id="search_tsb">
            <option value="equal">=</option>
            <option value="greater">&lt;</option>
            <option value="less">&gt;</option>
          </select>
        </div>
      </div>
      <div id="TSS">TSS
        <div class="numeric" style="display:flex">
          <input type="text" id="tss_input" style="width:100%" placeholder="" autocomplete="off" class="">
          <select id="search_tss">
            <option value="equal">=</option>
            <option value="greater">&lt;</option>
            <option value="less">&gt;</option>
          </select>
        </div>
    </div>
    <div id="Buyer">
      Buyer
      <div>
        <select class="form-control select2 select1" id="buyer_filter_upper" name="buyer_filter">
          <option value="">Buyer</option>
          @foreach($buyers_list as $buyer)
          <option value="{{$buyer->id}}">
            {{ @$buyer->username}}
          </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="">Seller
      <div>
        <input type="text" column="8" class="search_input"></div>
      </div>
      <div id="PID">
        <div class="">PID
          <div>
            <input type="text" column="9" class="search_input">
          </div>
        </div>
     </div>
      <div id="SID">Stock
        <select class="form-control select2 buyer select1"  id="stock_filter_upper" name="stock_filter_upper">
          <option value="">Stock</option>
          @foreach($stock_list as $stock)
            <option value="{{$stock->id}}">
              #{{ @$stock->id }} {{ @$stock->product->name}} [{{ @$stock->seller->username}}]
            </option>
          @endforeach
        </select>
      </div>
      <div class="">Flesh Color
        <div>
          <input type="text" column="11" class="search_input">
        </div>
      </div>
      <div class="">Packaging
        <div>
          <input type="text" column="12" class="search_input">
        </div>
      </div>
      <div class="">MM
        <div>
          <input type="text" column="15" class="search_input">
        </div>
      </div>
      <div class="">Added
        <div>
          <input type="text" column="16" class="search_input">
        </div>
      </div>
      <div class="">Id
        <div>
          <input type="text" column="18" class="search_input">
        </div>
      </div>

      <div id="Seller"></div>
      
      <div id="Product"></div>
        @foreach($ProdSpecArr as $spec)
          <div id="{{ $spec['shortcode'] }}"></div>
        @endforeach
      <!-- <div id="P/Ton Calculation"></div> -->
      <div id="MM_id"></div>
      <div id="MM"></div>
      <div id="Added"></div>                  
      <div id="Id"></div>
    </div>
    @if(isset($_GET['show_matched']) && ($_GET['show_matched'] === 'loaded' || $_GET['show_matched'] === 'rejected'))
        <div class="mt-2 warehouse_table">
          <div class="col">
            <div class="table-offers">
              <table id="warehouse_table" class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Flesh Color</th>
                    <th>Purpose</th>
                    <th>Defect</th>
                    <th>Soil</th>
                    <th>Variety Name</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Postcode</th>
                    <th>Tons</th>
                    <!-- <th>Product</th> -->
                    <th>Date Stored</th>
                    <th>Notes</th>
                    <th>@lang('labels.general.actions')</th>
                    <th>Id</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="matches-filter" id="filter">
                    <th data-title="Flesh Color"></th>
                    <th data-title="Purpose"></th>
                    <th data-title="Defect"></th>
                    <th data-title="Soil"></th>
                    <th data-title="Variety Name"></th>
                    <th data-title="Country"></th>
                    <th data-title="City"></th>
                    <th data-title="Postcode"></th>
                    <th data-title="Tons" class="number"></th>
                    <!-- <th data-title="Product"></th> -->
                    <th data-title="Date Stored"></th>
                    <th data-title="Notes"></th>
                    <th data-title=""></th>
                    <th data-title="Id"></th>
                </tr>
              </tfoot>   
            </table>
          </div>
        </div><!--col-->
      </div><!--row-->
    @else
      <div class="mt-2 col-md-12 matches_table" >
        <div class="">
          <div class="table-offers" style="overflow: scroll;">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th></th>
                    <!-- <th>Product</th> -->
                      <th data-original-title="Profit per Ton" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">P/Ton</th>
                      @foreach($ProdSpecArr as $spec)
                        @if($spec['type_name'] == 'Purpose')
                          <th data-original-title="{{ $spec['display_name'] }}" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title="">{{ $spec['shortcode'] }}</th>
                        @endif
                      @endforeach
                      @foreach($ProdSpecArr as $spec)
                        @if($spec['type_name'] == 'Quality')
                          <th data-original-title="{{ $spec['display_name'] }}" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title="QNB">{{ $spec['shortcode'] }}</th>
                        @endif
                      @endforeach
                      {{-- <th data-original-title="QNB" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">QNB</th> --}}
                      <th data-original-title="QND" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">QND</th>
                      <th data-original-title="TSB" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">TSB</th>
                      <th data-original-title="Buyer" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">Buyer</th>
                      <th data-original-title="PID" data-toggle="tooltip" data-placement="bottom" class="matrisHeader">PID</th>
                      @foreach($ProdSpecArr as $spec)
                        @if($spec['type_name'] != 'Purpose' && $spec['type_name'] != 'Quality')
                          <th data-original-title="{{ $spec['display_name'] }}" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title="">{{ $spec['shortcode'] }}</th>
                        @endif
                      @endforeach
                      <th data-original-title="Added Prefs" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title="">Added Prefs</th>
                      <th data-original-title="MM" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title="">MM</th>
                      <th data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title=""></th>
                      <th data-toggle="tooltip" data-placement="bottom" class="matrisHeader" title=""></th>
                      <th data-original-title="price per ton" title="P/Ton" data-name="price_per_ton">P/Ton</th>
                      @foreach($ProdSpecArr as $spec)
                        @if($spec['type_name'] == 'Purpose')
                          <th title="{{ $spec['display_name'] }}">{{ $spec['shortcode'] }}</th>
                        @endif
                      @endforeach
                       @foreach($ProdSpecArr as $spec)
                        @if($spec['type_name'] == 'Quality')
                          <th title="QNS">{{ $spec['shortcode'] }}</th>
                        @endif
                      @endforeach
                      {{-- <th title="QNS">QNS</th> --}}
                      <th title="#MM">#MM</th>
                      <th title="TSS">TSS</th>
                      <th title="Seller">Seller</th>
                      <th title="SID">SID</th>
                      @foreach($ProdSpecArr as $spec)
                        @if($spec['type_name'] != 'Purpose' && $spec['type_name'] != 'Quality')
                          <th title="{{ $spec['display_name'] }}">{{ $spec['shortcode'] }}</th>
                        @endif
                      @endforeach
                      <!-- <th>P/Ton Calculation</th> -->
                      <!-- <th>Profit</th> -->
                      <th title="Added Stock">Added Stock</th>
                      <th title="Id">Id</th>
                      <th title="Actions">Actions</th>
                  </tr>
                </thead>
                <tfoot>
                <tr class="matches-filter" id="filter">
                  <th data-title=""></th>
                  <th data-title="P/Ton" data-name="profit_per_ton"   class="number"></th>
                  @foreach($ProdSpecArr as $spec)
                     @if($spec['type_name']=='Purpose')
                        <th data-title="QTB" data-name="{{$spec['shortcode']}}-{{$spec['id']}}-buyer" ></th>
                     @endif
                  @endforeach
                  @foreach($ProdSpecArr as $spec)
                     @if($spec['type_name']=='Quality')
                        <th data-title="QNB" data-name="{{$spec['type_name']}}-{{$spec['id']}}-buyer"  class="number" ></th>
                     @endif
                  @endforeach
                  {{-- <th data-title="QNB" data-name="QNB" class="number"></th> --}}
                  <th data-title="QND" data-name="QND" class="number"></th>
                  <th data-title="TSB" data-name="trust_level_buyer" class="number"></th>
                  <th data-title="Buyer" data-name="buyer_show_url"></th>
                  <th data-title="PID" data-name="buyer_pref_id">PID</th>
                  @foreach($ProdSpecArr as $spec)
                     @if($spec['type_name']!='Purpose' && $spec['type_name']!='Quality')
                       <th data-title="{{ $spec['shortcode'] }}" data-name="{{$spec['shortcode']}}-{{$spec['id']}}-buyer"></th>
                     @endif
                  @endforeach
                  <th data-title="pref_created_at" data-name="pref_created_at" class="number"></th>
                  <th data-title="MM"></th>
                  <th data-title=""></th>
                  <th data-title=""></th>
                  <th data-title="P/Ton"   class="number"></th>
                  @foreach($ProdSpecArr as $spec)
                     @if($spec['type_name']=='Purpose')
                        <th data-title="QTS" data-name="{{$spec['shortcode']}}-{{$spec['id']}}-seller" ></th>
                     @endif
                  @endforeach
                  @foreach($ProdSpecArr as $spec)
                     @if($spec['type_name']=='Quality')
                        <th data-title="QNS" data-name="{{$spec['type_name']}}-{{$spec['id']}}-seller" class="number" ></th>
                     @endif
                  @endforeach
                  {{-- <th data-title="QNS" data-name="QNS" class="number"></th> --}}
                  <th data-title="#MM" data-name="numofmismatches" class="number"></th>
                  <th data-title="TSS" data-name="trust_level_seller" class="number"></th>
                  <th data-title="Seller" data-name="seller_show_url"></th>
                  <th data-title="SID" data-name="stock_show_url" class="number"></th>
                  @foreach($ProdSpecArr as $spec)
                     @if($spec['type_name']!='Purpose' && $spec['type_name']!='Quality')
                       <th data-title="{{ $spec['shortcode'] }}" data-name="{{$spec['shortcode']}}-{{$spec['id']}}-seller"></th>
                     @endif
                  @endforeach
                  <th data-title="stock_created_at" data-name="stock_created_at" class="number"></th>
                  <th data-title="Id"></th>
                  <th data-title=""></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div><!--col-->
      </div><!--row-->
    @endif
  </div><!--card-body-->
</div><!--card-->

  <!-- Modal -->
  <div class="modal fade" id="notifyModel" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notify Buyer & Seller</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Are you sure ? want to <span class="badge badge-info">Notify Buyer & Seller</span> or <span class="badge badge-success">Make Sale</span> for:
            <br>Stock ID: <span class="badge badge-info" id="stock_id"></span>
            <br>Order ID: <span class="badge badge-info" id="order_id"></span>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-info pull-left notifyBTN" data-loading-text="Notifying…"><i class="fa fa-paper-plane"></i> Notify Buyer & Seller</button>
          <button type="button" class="btn btn-sm btn-success pull-left makesaleBTN" data-loading-text="Making Sale…"><i class="fa fa-paper-plane"></i> Make Sale</button>
          <button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewMismatches" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Mismatches</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </div>

    </div>
  </div>
  <div class="modal fade" id="ptonModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Profit per ton calculation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-scripts')
  <script type="text/javascript">
    $( document ).ready(function() {
      $('.data-table').on('draw.dt', function() {
        $('.matrisHeader').tooltip({html: true}); // Or your function for tooltips
      });
      $('.matrisHeader').tooltip();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      //$("[data-toggle='tooltip']").tooltip();
    
      $("body").on("click", ".expand_row", function(event){
        var id = $(this).attr('id_v');
        $('#tab_show'+id).toggle();
      });  
      $("body").on("click", ".tabs li a", function(event){
        var t = $(this).attr('id');
        if($(this).hasClass('inactive'))
        { //this is the start of our condition 
          $('.tabs li a').addClass('inactive');           
          $(this).removeClass('inactive');
          $(this).addClass('active');
          $('.containerss').hide();
          $('#'+ t + 'C').fadeIn('slow');
        }
      });
    
      setTimeout(function() {
        $(".alert-danger").hide();
      }, 3000);
    
      var count=0;
      var queryStr = window.location.search;
      queryArr = queryStr.replace('?','').split('&');
      queryParams = {};
      for(var q = 0, qArrLength = queryArr.length; q < qArrLength; q++){
        var qArr = queryArr[q].split('=');
        queryParams[qArr[0]] = qArr[1];
      }
      //console.log(queryParams.price_per_ton);
      var product_specification_values = <?=json_encode($product_specification_values)?>;
      $('.table.table-bordered.data-table #filter th').each( function () {
        count++;
        var title = $(this).attr('data-title');
        var dataname = ($(this).data('name') ? $(this).data('name') : '');
        if(title=='SID')
        {
          $(this).html(`<div>
            <select class="form-control select2 buyer select1"  id="stock_filter" name="stock_filter">
              <option value="">Stock</option>
              @foreach($stock_list as $stock)
              <option value="{{$stock->id}}">
                #{{ @$stock->id }} {{ @$stock->product->name}} [{{ @$stock->seller->username}}]
              </option>
              @endforeach
            </select>
          </div>`);
          if(queryParams.stock_filter!="" && queryParams.stock_filter!=undefined){            
            $('#stock_filter').val(queryParams.stock_filter).trigger('change.select2');
          }
        }
        else if(title=='PID')
        {
          $(this).html(`<div>
            <select class="form-control select2 buyer select1" id="pref_filter" name="pref_filter">
              <option value="">PID</option>
              @foreach($buyer_pref_list as $buyer_pref)
              <option value="{{$buyer_pref->id}}">
                #{{ @$buyer_pref->id }} {{ @$buyer_pref->product->name}} [{{ @$buyer_pref->buyer->username}}]
              </option>
              @endforeach
            </select>
          </div>`);
          if(queryParams.pref_filter!="" && queryParams.pref_filter!=undefined){            
            $('#pref_filter').val(queryParams.pref_filter).trigger('change.select2');
          }
        }
        else if(title=='Buyer')
        {
          $(this).html(` <div>
            <select class="form-control select2 select1" id="buyer_filter" name="buyer_filter">
              <option value="">Buyer</option>
              @foreach($buyers_list as $buyer)
              <option value="{{$buyer->id}}">
                {{ @$buyer->username}}
              </option>
              @endforeach
            </select>
          </div>`);
          if(queryParams.buyer_filter!="" && queryParams.buyer_filter!=undefined){
            $("#buyer_filter").val(queryParams.buyer_filter);
          }
        }
        else if(title=='Seller')
        {
          $(this).html(` <div>
            <select class="form-control select2 select1" id="seller_show_url" name="seller_show_url">
              <option value="">Seller</option>
              @foreach($sellers_list as $seller)
              <option value="{{$seller->id}}">
                {{ @$seller->username}}
              </option>
              @endforeach
            </select>
          </div>`);
          if(queryParams.seller_show_url!="" && queryParams.seller_show_url!=undefined){
            $("#seller_show_url").val(queryParams.seller_show_url);
          }
        }else if(dataname.indexOf('Quality-') === -1 && (dataname.indexOf('-buyer') != -1 || dataname.indexOf('-seller') != -1)){
          var tmp = dataname.split('-');
          $(this).html(` <div>
            <select class="form-control select2 select1" id="`+dataname+`" name="`+dataname+`">
              <option value="">`+tmp[0]+`</option>
            </select>
          </div>`);
          $.each(product_specification_values, function(key, value){
            if(value.product_specification_id == tmp[1]){
               $('#'+dataname).append('<option value="'+value.id+'">'+(value.shortcode!=null?value.shortcode:'')+' - '+value.value+'</option>');
            }
          })
          if(queryParams[dataname]!="" && queryParams[dataname]!=undefined){
            $("#"+dataname).val(queryParams[dataname]).trigger('change.select2');
          }
        }
        else if(title != '')
        {
          if(queryParams[dataname]!="" && queryParams[dataname]!=undefined){
            var qdata = queryParams[dataname];
            var operator_qdata = queryParams['operator_'+dataname];
          }else{
            var qdata = "";
          }
          if($(this).hasClass('number'))
          {
            $(this).html( '<div class="numeric" style="display:grid"><input type="text" id="'+dataname+'" style="width:100%" placeholder="" value="'+qdata+'"/><select class="search" id="operator_'+dataname+'"><option value="less" >></option><option value="greater"><</option><option value="equal">=</option></select></div>');
            if(queryParams[dataname]!="" && queryParams[dataname]!=undefined){
              $("#operator_"+dataname).val(operator_qdata);
            }
          }
          else
          {
            $(this).html( '<input type="text" id="'+dataname+'" style="width:100%" placeholder="" value="'+qdata+'"/>' );
          }
        } 
      });
    
      var table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        autoWidth: false,
        // "scrollX": true,
        // responsive: false,
        order: [],
    // fixedColumns: true,
    fnHeaderCallback: function( firstHeader, aData, displayStart, displayEnd ){
      if($('.table-offers thead tr').length > 1){
         return null;
      }
      // alert(this.api().columns().count());
      // alert(Math.ceil(this.api().columns().count() / 2));
      // if ( aData!= undefined && $('th', firstHeader).length >= aData.length ){
        
        var secondHeader = $(firstHeader).clone(true);
        var half = Math.floor(this.api().columns().count() / 2);
        $('th:gt(' + (half-1) + ')', firstHeader).remove();
        $('th:lt(' + half+ ')', secondHeader).remove();        
        $(firstHeader).after(secondHeader);
        
      // console.log($(firstHeader).html());
      // }
    },
    fnFooterCallback: function( firstFooter, aData, displayStart, displayEnd ){//alert(aData.length);alert($('th', firstFooter).length);
      if($('.table-offers tfoot tr').length > 1){
         return null;
      }
      if ( aData!= undefined && $('th', firstFooter).length >= aData.length ){
        var secondFooter = $(firstFooter).clone(true);
        var half = Math.floor(this.api().columns().count() / 2);
        $('th:gt(' + (half-1) + ')', firstFooter).remove();
        $('th:lt(' + half + ')', secondFooter).remove();        
        $(firstFooter).after(secondFooter);
      }
      $("#pref_filter, #stock_filter").select2({templateSelection: function(item){ if(item.id){return item.id} else{return item.text}}});
      if(queryParams.stock_filter!="" && queryParams.stock_filter!=undefined){        
        $('#stock_filter').val(queryParams.stock_filter).trigger('change.select2');
      }
      $("#buyer_filter, #seller_show_url").select2();
      $(".select2[name$='-buyer'], .select2[name$='-seller']").select2({
         templateSelection: function(item){ 
            var tmp = item.text.split(' - '); 
            if(tmp[0] != ''){return tmp[0]} else{return tmp[1]}
         }
      });
      if(queryParams.seller_show_url!="" && queryParams.seller_show_url!=undefined){        
        $('#seller_show_url').val(queryParams.seller_show_url).trigger('change.select2');
      }
    },
   "drawCallback":function(settings){
      var api = this.api();
      var rows = api.rows( {page:'current'} ).nodes();
      var half = Math.floor(api.columns().count() / 2);
      // alert(half);
      rows.each(function(row,index){
         var secondRow = $(row).clone(true);
         // $(row).after('<tr><td colspan="10"></td></tr>')
         $('td:gt(' + (half-1) + ')', row).remove();
         $('td:lt(' + (half) + ')', secondRow).remove();         
         $(row).css('background-color', '#b2f6b240');
         $(row).after(secondRow);
         $(secondRow).css('background-color', '#f7f79573');
      });

   },
 
 
        ajax:  {
          url: "{{ route('admin.matches.index') }}?@if(isset($_GET['stock']))stock={{$_GET['stock']}}&buyer={{$_GET['buyer']}}@endif &product_id=@if(isset($_GET['product_id'])){{$_GET['product_id']}} @else "+$('#product_id').val()+" @endif @if(isset($_GET['match_type']))&match_type={{$_GET['match_type']}} @endif @if(isset($_GET['exclude_match_type']))&exclude_match_type={{$_GET['exclude_match_type']}} @endif @if(isset($_GET['show_matched']))&show_matched={{$_GET['show_matched']}} @endif",
          data: function(d){
            $('#filter th').each( function () { // TO INITIALIZE SEARCH QUERY BASED ON PREPOPULATED INPUT
               var that = $(this).find('div .select1');
               if(that.length > 0 && that.val() != '' && (that.attr('id').indexOf('-buyer') != -1 || that.attr('id').indexOf('-seller') != -1)){ // FOR SPECS EXCEPT QUALITY
               // alert('dfd');
                  d.columns[$(this).index()].search.value = that.val();
               }
            })
            $('#filter .search').each(function(){
               d[$(this).attr('id')] = $('#'+$(this).attr('id')).val();               
               if($(this).attr('id').indexOf('Quality-') != -1){
                  d[$(this).attr('id').replace('operator_','')] = $(this).prev('input').val();  // FOR Quality
               }
            })
            d.p_ton = $('#profit_per_ton').val();
            d.buyer = $('#buyer_filter').val();
            d.seller = $('#seller_show_url').val();
            d.pid = $('#pref_filter').val();
            d.price_per_ton = $('#price_per_ton').val();
            d.operator = $('#operator').val();
            d.input_press=$('#input_press').val();
            d.tsb= $('#trust_level_buyer').val();
            d.tss= $('#trust_level_seller').val();
            d.mm = $('#numofmismatches').val();
            d.sid = $('#stock_filter').val();
            if($('#QND').val() != ''){
               d.qnd = $('#QND').val();
            }
            d.pref_created_at = $('#pref_created_at').val();
            d.stock_created_at = $('#stock_created_at').val();
    
          },
          beforeSend: function () {
            var checkfilter = $('#checkfilter').val();
            if(checkfilter ==1)
            {
                $('#firsttoast').toast('show');
            }
          },
          complete: function () {
            var checkfilter = $('#checkfilter').val();
            if(checkfilter ==1)
            {
              $('#firsttoast').toast('hide');
              $('#secondtoast').toast('show');
              $('#checkfilter').val(0);
            }
          }
        },
    
        columns: [
            @if(isset($_GET['show_matched']) && ($_GET['show_matched'] === 'loaded' || $_GET['show_matched'] === 'rejected'))
              {data: 'flesh_color', name: 'flesh_color'},
              {data: 'purposes', name: 'purposes'},
              {data: 'defect', name: 'defect'},
              {data: 'soil', name: 'soil'},
              {data: 'variety_name', name: 'variety_name'},
              {data: 'country', name: 'country'},
              {data: 'city', name: 'city'},
              {data: 'postcode', name: 'postcode'},
              {data: 'tons', name: 'tons'},
              //{data: 'product', name: 'product'},
              {data: 'dateStored', name: 'dateStored'},
              {data: 'notes', name: 'notes'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
              {data: 'id', name: 'id'},
            @else
              {data: 'checkbox', name: 'checkbox', selectRow: true, orderable: false, searchable: false},
              {data: 'profit_per_ton', name: 'profit_per_ton'},
              @foreach($ProdSpecArr as $key => $val)
               @if($val['type_name']=='Purpose')
                {data: '{{$val['shortcode']}}-{{$val['id']}}-buyer', name: '{{$val['shortcode']}}-{{$val['id']}}-buyer', orderable: false },
               @endif
               @if($val['type_name']=='Quality')
                {data: '{{$val['shortcode']}}-{{$val['id']}}-buyer', name: '{{$val['type_name']}}-{{$val['id']}}-buyer', orderable: false },
               @endif
              @endforeach 
              // {data: 'QNB', name: 'QNB'},
              {data: 'QND', name: 'QND'},
              {data: 'trust_level_buyer', name: 'trust_level_buyer'},
              {data: 'buyer_show_url', name: 'buyer_show_url'},
              {data: 'buyer_pref_id', name: 'buyer_pref_id'},
              @foreach($ProdSpecArr as $key => $val)
               @if($val['type_name']!='Purpose' && $val['type_name']!='Quality')
                {data: '{{$val['shortcode']}}-{{$val['id']}}-buyer', name: '{{$val['shortcode']}}-{{$val['id']}}-buyer', orderable: false },
               @endif
              @endforeach 
              {data: 'pref_created_at', name: 'pref_created_at'},
              {data: 'mismatches', name: 'mismatches', orderable: false},   
              {data: 'Test', name: 'Test', orderable: false, searchable: false},   
              {data: 'Test1', name: 'Test1', orderable: false, searchable: false},   
              {data: 'price_per_ton', name: 'price_per_ton'},
              @foreach($ProdSpecArr as $key => $val)
               @if($val['type_name']=='Purpose')
                {data: '{{$val['shortcode']}}-{{$val['id']}}-seller', name: '{{$val['shortcode']}}-{{$val['id']}}-seller', orderable: false },
               @endif
               @if($val['type_name']=='Quality')
                {data: '{{$val['shortcode']}}-{{$val['id']}}-seller', name: '{{$val['type_name']}}-{{$val['id']}}-seller', orderable: false },
               @endif
              @endforeach 
              // {data: 'QNS', name: 'QNS'},
              {data: 'numofmismatches', name: 'numofmismatches'},
              {data: 'trust_level_seller', name: 'trust_level_seller'},
              {data: 'seller_show_url', name: 'seller_show_url'},
              {data: 'stock_show_url', name: 'stock_show_url'},            
              @foreach($ProdSpecArr as $key => $val)
               @if($val['type_name']!='Purpose' && $val['type_name']!='Quality')
                {data: '{{$val['shortcode']}}-{{$val['id']}}-seller', name: '{{$val['shortcode']}}-{{$val['id']}}-seller', orderable: false },
               @endif
              @endforeach 
              {data: 'stock_created_at', name: 'stock_created_at'},
              {data: 'id', name: 'id'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
            @endif
        ]
      });
      table.columns().every( function () {
        var that = this;
        $('.select1', this.footer() ).on( 'keyup change', function () {
          $('#checkfilter').val(1);
          $("#buyer_input").val('');
          $("#stock_input").val('');
          $('#operator').val($(this).val());
          if($(this).attr('id')=='buyer_filter')
          {
            $("#buyer_input").val(this.value)
          }
          if($(this).attr('id')=='stock_filter')
          {
            $("#buyer_input").val('');
            $("#stock_input").val(this.value)
          }
          that
            .search( this.value)
            .draw();
        });
    
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
          $('#checkfilter').val(1);
          if($(this).parent().hasClass('numeric'))
          {
            return true;
          }
          $("#input_press").val('1');
          that
            .search( this.value)
            .draw();
        });
    
        $('.search_input').keyup(function(){
          var column=$(this).attr('column');
          that.columns(column).search($(this).val()).draw();
        })     
      });
    
      $("#operator").change(function() {
        $.fn.dataTable.ext.search.push(
          function( settings, data, dataIndex ) {
            return parseFloat(data[4])<50
              ? true
              : false
            }     
        );
        table.draw();
        $.fn.dataTable.ext.search.pop();
      });
    
      $("#buyer_filter_upper").change(function(){
        $("#buyer_input").val($(this).val());
        $('.data-table').DataTable().ajax.reload();
      });
      $("#stock_filter_upper").change(function(){
          $("#stock_input").val($(this).val());
          $('.data-table').DataTable().ajax.reload();
      });
      $("#search_pton").change(function(){
        $("#p_ton").val($("#pton_input").val());
        $('#operator').val($(this).val());
        $('.data-table').DataTable().ajax.reload();
      });
      $("#search_tsb").change(function(){
        $("#tsb").val($("#tsb_input").val());
        $('#operator').val($(this).val());
        $('.data-table').DataTable().ajax.reload();
      });
      $("#search_tss").change(function(){
        $("#tss").val($("#tss_input").val());
        $('#operator').val($(this).val());
        $('.data-table').DataTable().ajax.reload();
      });
    
      $( '.search' ).on( 'change ', function () {
        $('#checkfilter').val(1);
        $('#operator').val($(this).val());
        $.fn.dataTable.ext.search.push(
          function( settings, data, dataIndex ) {
            return parseFloat(data[4])<50
              ? true
              : false
            }     
        );
        table.draw();
        $.fn.dataTable.ext.search.pop();
        
      });
    
      $('body').on('click', '.pton', function () {
        $("#ptonModal .modal-body p").html($(this).next('div.pton_calculation').html());
        $("#ptonModal").modal({
            backdrop: 'static',
            keyboard: false
          });
      });
    
      $('body').on('click', '.editItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
      });
    
      $('body').on('click', '.viewItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
      });
    
      $('body').on('click', '.notifyItem', function () {
        var stock_id = $(this).data("stock_id");
        var order_id = $(this).data("order_id");
        var seller_id = $(this).data("seller_id");
        var buyer_id = $(this).data("buyer_id");
        $("#notifyModel #order_id").text(order_id);
        $("#notifyModel #stock_id").text(stock_id);
        $("#notifyModel").modal({
          backdrop: 'static',
          keyboard: false
        });
      });
    
      $('body').on('click', '.notifyBTN', function () {
        var order_id = $("#notifyModel #order_id").text();
        var stock_id = $("#notifyModel #stock_id").text();
        $.ajax({
          type: "POST",
          url: "{{ url('admin/matches-notify') }}/"+ order_id +"/"+stock_id,
          success: function (data) {
            Swal.fire('Success!', 'Notification sent.', 'success');
            table.draw();
          },
          error: function (data) {
            Swal.fire('Error!', 'Notification not sent', 'error');
          }
        });
      });
    
      $('body').on('click', '.makesaleBTN', function () {
        var order_id = $("#notifyModel #order_id").text();
        var stock_id = $("#notifyModel #stock_id").text();
        $.ajax({
          type: "POST",
          url: "{{ url('admin/matches-makesale') }}/"+ order_id +"/"+stock_id,
          success: function (data) {
            $('#notifyModel').modal('hide');
            Swal.fire('Success!', 'Sale has made.', 'success');
            table.draw();
          },
          error: function (data) {
            $('#notifyModel').modal('hide');
            Swal.fire('Error!', 'Sale has not made', 'error');
          }
        });
      });
    
      var viewinvoiceUrl,sendInvoiceUrl;
      $('body').on('click','.sendInvoice',function(e){
        e.preventDefault();
        viewinvoiceUrl = $(this).data("viewurl");
        sendInvoiceUrl = $(this).data("url");
        Swal.fire({
          title: "Are you sure?",
          html: '<div><button class="btn btn-primary" value="send" id="sendPdf">Send</button> <button class="btn btn-success" id="viewPdf">View PDF</button> <button class="btn btn-secondary" id="cancel">Cancel</button></div>',
          type: "warning",
          showConfirmButton: false,
          showCancelButton: false
        });
      })
      $('body').on('click','#sendPdf',function(e){
        e.preventDefault();
        window.location.href = sendInvoiceUrl;
        Swal.close();
      });
    
      // View pdf
      $('body').on('click','#viewPdf',function(e){
        e.preventDefault();
        window.open(viewinvoiceUrl, '_blank');
      });
    
      $('body').on('click','#cancel',function(e){
        e.preventDefault();
        Swal.close();
      });
    
      $('body').on('click', '.sendtoall', function (e) {
        e.preventDefault();
        var array_main = [];
        // Read all checked checkboxes
        $("input:checkbox[type=checkbox]:checked").each(function () {
          var id  = $(this).data('id');
          array_main.push({
              match_id: id,
            });
        });
        if(array_main.length === 0)
        {
          Swal.fire('Error!','Please select at least 1 record to send notification.', 'error');
        }
        else if(array_main.length > 10)
        {
          Swal.fire('Error!', 'Maximum 10 notification can be send at a time.', 'error');
        } 
        else
        {
          var jsonString = JSON.stringify(array_main);
          $.ajax({
            type: "POST",
            url: "{{ url('admin/InvoiceSendtoAll') }}",
            data: {array_main},
            dataType:'json',
            success: function (data) {
              Swal.fire('Sent!', data.success, 'success');
              $("input:checkbox[type=checkbox]").each(function () {
                $(this).prop('checked',false);
              }); 
            },
            error: function (data) {
              Swal.fire('Error!', '', 'error');
            }
          });
        }
      });
    
      $('#show_matched_div a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var show_matched = $(e.target).attr("href");
        if(show_matched == '' || show_matched == 'yes' || show_matched== 'no' || show_matched== 'loaded' || show_matched== 'rejected')
        {
          window.location.href = "{{ route('admin.matches.index') }}?stock="+$('#stock_filter').val()+"&buyer="+$('#buyer_filter').val()+($('#product_id').val()!=''? '&product_id='+$('#product_id').val() : '')+"&match_type="+$('#match_type').val()+"&show_matched="+show_matched;  
        }
      });
    
      $('body').on('click', '.pref_check', function(){
        if(this.checked)
        {
          $(this).val(1);
          $(this).attr('checked','checked');
          var columnId = $(this).attr('data-column');
          var column = table.column( columnId );
          // Toggle the visibility
          column.visible( ! column.visible() );
        }
        else
        {
          $(this).val(0);
          $(this).removeAttr('checked');
          var columnId = $(this).attr('data-column');
          var column = table.column( columnId );
          // Toggle the visibility
          column.visible( ! column.visible() );
        }
      })
      $('body').on('click', '.removeRow', function(){ 
        var rowId = $(this).parent().parent().parent().attr('id');
        $('#'+rowId).remove();
      });
    
      $('body').on('click', '.addRow', function(){
        var count = 1;
        $(".rows").each(function( key, value ) {
          count++;
        });
        var rowId = $(this).parent().parent().parent().attr('id');
        var newrow = '<div class="rows model-row row mb-2" id="remove'+count+'">'+
                        '<div class="col-md-4">'+ 
                          '<label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Columns '+count+'</label>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                          '<input name="short_names[]" id="shop'+count+'" value="" reuired type="text" class="model-row form-control">'+
                          '<div class="invalid-feedback"></div>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                          '<div class="row">'+
                            '<a href="javascript:void(0)" class="addRow btn btn-success" style="padding: 3px 5px 2px 5px;"><span class="fa fa-plus-circle"></span></a>'+
                            '<a href="javascript:void(0)" class="removeRow btn btn-danger" style="padding: 3px 5px 2px 5px;"><span class="fa fa-minus-circle"></span></a>'+
                          '</div>'+
                        '</div>'+
                    '</div>';
        $('.columns').append(newrow)
      });
    
      $('body').on('submit', '#formMatches', function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $("#status").each(function( key, value ) {
          if(value.value == 0)
          {
            formData.append(value.name, value.value);
          }
        });
        $.ajax({
          url: "{{ route('admin.matches.shortname') }}",
          type: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function (data) {
            if(data.status)
            {
              Swal.fire('Success!', data.message, 'success');
              setTimeout(function() {
                location.reload();
              }, 500);
            }
          },
          error: function (data) {
            Swal.fire('Error!', data.message, 'error');
          }
        });
      });
    
      $("#product_id").on("change", function () {
        var prd_id = $(this).val();
        $.ajax({
          type: "GET",
          url: "{{ url('admin/getSpecsByProduct') }}",
          data: {prd_id : prd_id},          
          success: function (data) {
            $("#match_type").html(data);
          },
          error: function (data) {
            Swal.fire('Error!', '', 'error');
          }
        });
      });
    
      $("#clear_filter").bind("click", function () {
        $("#stock_filter,#buyer_filter,#match_type,#exclude_match_type").val("");
        $("#stock_filter,#buyer_filter,#match_type,#exclude_match_type").select2().trigger('change');
      });
    
      $('body').on('click', '.buyerPrefs', function () {
        var prefsId = $(this).attr('data-prefid');
        $.ajax({
          type: "POST",
          url: "{{ route('admin.buyerpref.ajax') }}",
          data: {prefsId: prefsId},
          success: function (data) {
            if(data.status == 'success')
            {
              $('#loadData').empty();
              $('#loadData').html(data.prefs);
              $('#showModal').modal('show');
            }
          },
          error: function (data) {
            Swal.fire('Error!', 'No data loaded for selected buyer!', 'error');
          }
        });
      });
    
      $('body').on('click', '.stockShow', function () {
        var stockId = $(this).attr('data-stockid');
        $.ajax({
          type: "GET",
          url: "{{ url('admin/trading/stockv2/ajax') }}/"+stockId,
          success: function (data) {
            if(data.status == 'success')
            {
              $('#loadData').empty();
              $('#loadData').html(data.stocks);
              $('#showModal').modal('show');
            }
          },
          error: function (data) {
            Swal.fire('Error!', 'No data loaded for selected buyer!', 'error');
          }
        });
      });
    
      $('#filter').on('click', function () {
        var current_url;
        var url="";        
        current_url = ($('#product_id').val()!=''? '&product_id='+$('#product_id').val() : '')+"&match_type="+$('#match_type').val()+"&exclude_match_type="+$('#exclude_match_type').val()+"@if(isset($_GET['show_matched']))&show_matched={{$_GET['show_matched']}}@endif";
        //alert(current_url);
    
        var myArray = {};
        $(".table.table-bordered.data-table #filter th input[type='text']").each( function () {
          if($(this).val()!=""){
            myArray[$(this).attr('id')] = $(this).val();
            if($(this).parent().hasClass('numeric')){
              myArray['operator_'+$(this).attr('id')] = $("#operator_"+$(this).attr('id')).val();
            }
          }
        });
    
        $(".table.table-bordered.data-table #filter th select.select2").each( function () {
          if($(this).val()!=""){
            myArray[$(this).attr('id')] = $(this).val();
          }
        });
    
        var queryString = $.param(myArray);
        var newurl = '?'+current_url+((queryString != '') ? '&' : '')+queryString;
        window.history.pushState({path:current_url},'',newurl);        
        window.location.href = newurl;
      });
    
      $("#clear_table_filter").on("click", function () {
        $(".table.table-bordered.data-table #filter th input[type='text']").val("");
        $(".table.table-bordered.data-table #filter th select.select2").val("").trigger('change');
        $(".table.table-bordered.data-table #filter th select.search").val("less");
        var oTable = $('.data-table').dataTable();
        oTable.fnSort([]);        
      });
    });
  </script>
@endpush
@push('after-styles')
  <style type="text/css">
    table.dataTable thead .sorting:before, table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:before{
      position: absolute;
      bottom: 0;
    }
    table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, .sorting_desc_disabled:before{
      left: 20px;
    }
    table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, .sorting_desc_disabled:after{    
      left:25px;    
    }
    .matches_header .fa-file-invoice, .matches_header .fa-download{
      padding: 0 1px;
    }
    .filterdivs
      {
        position: absolute;
        top: 80px;
        right: 30px;
        width: 300px;
        float: right;
      }
    @media (max-width: 767px)
    {
      .matches_header
      {
        padding: 0 15px;
      }
      #show_matched_div ul.nav
      {
        padding-right: 0px;
      }
    }
    @media (min-width: 320px) and (max-width: 414px)
    {
      .matches_header .btn
      {
        padding: 9px;
        font-size: 12px;
      }
    }
    @media (min-width: 320px) and (max-width: 492px)
    {
      #show_matched_div
      {
        margin-left: 0px;          
      }
      #show_matched_div a.nav-link
      {
        padding: 0px !important;
        padding-left: 2px !important;
      }
    }
  </style>
@endpush
