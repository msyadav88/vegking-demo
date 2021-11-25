@extends('backend.layouts.app')

@section('title', __('Matches') . ' | ' . __('Edit Stock Match'))

@section('content')
    {{ html()->form('POST', route('admin.matches.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Edit Stock Match
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr/>

        <div id="accordion">
          <div class="card">
            <div class="card-header collapsed" id="headingofferDetails" data-toggle="collapse" data-target="#collapseofferDetails" aria-expanded="true" aria-controls="collapseofferDetails">
              <strong>Stock Details</strong>
            </div>
            <div id="collapseofferDetails" class="collapse " aria-labelledby="headingofferDetails" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group"><strong>Stock ID:</strong> {{ $stock->id }}</div>
                        <div class="form-group"><strong>Product Name:</strong> {{ $stock->product->name }}</div>
                        <div class="form-group"><strong>Size:</strong> {{ $stock->size_from }} - {{ $stock->size_to }}</div>
                        <div class="form-group"><strong>Quantity:</strong> {{ $stock->quantity ?? 'N/A' }}</div>
                        @foreach($match->offerproperty as $spec)
                            <div class="form-group"><strong>{{ isset($spec->productspec->display_name)?$spec->productspec->display_name:'' }}: </strong>{{ isset($spec->productspecvalue->value)?$spec->productspecvalue->value:''}}</div>
                        @endforeach
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group"><strong>Price in GBP:</strong> {{ currency(@$stock->price) ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Status:</strong> {{ $stock->status }}</div>
                        <div class="form-group"><strong>Country:</strong> {{ $stock->country ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Postal code:</strong> {{ $stock->postalcode ?? 'N/A' }}</div>
                        <div class="form-group"><strong>City:</strong> {{ $stock->city ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Street:</strong> {{ $stock->street ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Note:</strong> {{ $stock->note ?? 'N/A' }}</div>
                    </div>
                    <div class="col-sm-4">
                        @if($stock_image)
                           <div class="form-group"><img width="200" src="{{ asset('images/stock/'.$stock_image) }}" /></div>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header collapsed" id="headingSellerDetails" data-toggle="collapse" data-target="#collapseSellerDetails" aria-expanded="false" aria-controls="collapseSellerDetails">
              <strong>Seller Details</strong>
            </div>
            <div id="collapseSellerDetails" class="collapse" aria-labelledby="headingSellerDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group"><strong>Seller ID:</strong> {{ $seller->id ?? 'N/A' }}</div>
                    <div class="form-group"><strong>Name:</strong> {{ $seller->username ?? 'N/A' }}</div>
                    <div class="form-group"><strong>Email:</strong> {{ $seller->email ?? 'N/A' }}</div>
                    <div class="form-group"><strong>Phone:</strong> {{ $seller->phone ?? 'N/A' }}</div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group"><strong>Country:</strong> {{ $seller->country ?? 'N/A' }}</div>
                    <div class="form-group"><strong>Postalcode:</strong> {{ $seller->postalcode ?? 'N/A' }}</div>
                    <div class="form-group"><strong>City:</strong> {{ $seller->city ?? 'N/A' }}</div>
                    <div class="form-group"><strong>Address:</strong> {{ $seller->address ?? 'N/A' }}</div>
                </div>
                </div>
              </div>
            </div>
          </div>

            <div class="card">
                <div class="card-header collapsed" id="headingBuyerDetails" data-toggle="collapse" data-target="#collapseBuyerDetails" aria-expanded="false" aria-controls="collapseBuyerDetails">
                  <strong>Buyer Details</strong>
                </div>
                <div id="collapseBuyerDetails" class="collapse" aria-labelledby="headingBuyerDetails" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group"><strong>Buyer ID:</strong> {{ $buyer->id ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Name:</strong> {{ $buyer->username ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Email:</strong> {{ $buyer->email ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Credit Limit:</strong> {{ $buyer->credit_limit ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Balance:</strong> {{ 'N/A' }}</div>
                        <div class="form-group"><strong>Discount(%):</strong> {{ $buyer->disc_upsc ?? 'N/A' }}</div>
                    </div>
                    <div class="col-sm-4">
                         <div class="form-group"><strong>Phone:</strong> {{ $buyer->phone ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Country:</strong> {{ $buyer->country ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Postalcode:</strong> {{ $buyer->postalcode ?? 'N/A' }}</div>
                        <div class="form-group"><strong>City:</strong> {{ $buyer->city ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Address:</strong> {{ $buyer->address ?? 'N/A' }}</div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>

            <div class="card">
                <div class="card-header " id="headingOfferDetails" data-toggle="collapse" data-target="#collapseOfferDetails" aria-expanded="false" aria-controls="collapseOfferDetails">
                  <strong>Offer Details</strong>
                </div>
                <div id="collapseOfferDetails" class="collapse show" aria-labelledby="headingOfferDetails" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group"><strong>Number of 24T Truck Loads:</strong> {{ $stock->quantity ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Truckloads available per day:</strong> {{ $stock->available_per_day ?? 'N/A' }}</div>
                        <div class="form-group"><strong>Available From Date:</strong> <input class="datepicker" name="available_from_date" type="text" id="available_from_date" value="{{ $available_from_date }}"/></div>
                        <div class="form-group"><strong>Profit/Ton:</strong> <span class="profitPerTon">{{ ((@$pTonCalculation['profitPerTon'] != '')?currency(@$pTonCalculation['profitPerTon']):'N/A') }}</span></div>
                        <div class="form-group"><strong>Profit/Truck:</strong> <span class="profitPerTruck">{{ ((@$pTonCalculation['profitPerTruck'] != '')?currency(@$pTonCalculation['profitPerTruck']):'N/A') }}</span></div>
                        <div class="form-group"><strong>Total profit:</strong> <span class="totalProfit">{{ ((@$pTonCalculation['profit'] != '')?currency(@$pTonCalculation['profit']):'N/A') }}</span></div>
                        <div class="form-group"><strong>Profit per ton calculation:</strong><br> <span class="reloadOfferPrice">{!!$pTonCalculation['pton_calculation']!!}</span></div>
                        <input type="hidden" name="match_id" value="{{$match->id}}"/>
                        <div class="form-group"><strong>#Mismatches:</strong> {{ $match->numofmismatches ?? 'N/A' }}</div>

                        <div class="form-group"><strong>Order Id:</strong>
                        <select class="form-control" name="order_id" id="order_id" maxlength="191">
                                  <option value="">Select order Id</value>
                                  @foreach($order_ids as $order_id)
                                  <option value="{{ $order_id->id}}">{{ $order_id->id}}</option>
                                  @endforeach
                        </select> 
                        </div>

                        <div class="form-group"><strong>Offer Price :</strong>
                          <input class="form-control price odf" name="price" type="text" value="@if(!empty(@$offer->offerprice)) {{number_format((float)@$offer->offerprice, 2, '.', '') }} @else {{ number_format((float)@$salePrice, 2, '.', '') }} @endif"/>
                        </div>

                        @php
                            $offer_price = (!empty($offer->offerprice) ? $offer->offerprice : $salePrice);
                            $disc = 100-(100*($offer_price/$salePrice));
                            $discount = number_format((float)$disc, 2, '.', '');
                            $discount_flat_amount = number_format((float)$salePrice - $offer_price, 2, '.', '');
                        @endphp

                        <div class="form-group"><strong>Discount (%) :</strong>
                          <input class="form-control discount_percent odf" name="discount_percent" type="text" value="@if(!empty(@$discount)) {{@$discount}} @else {{ 0.00 }} @endif"/>
                        </div>

                        <div class="form-group"><strong>Discount Flat Amount :</strong>
                          <input class="form-control discount_flat_amount odf" name="discount_flat_amount" type="text" value="@if(!empty(@$discount_flat_amount)) {{@$discount_flat_amount}} @else {{ 0.00 }} @endif"/>
                        </div>

                        <input type="hidden" class="avgsaleprice" name="avgsaleprice" value="{{@$avgSalePrice}}"/>
                        <input type="hidden" class="saleprice" name="saleprice" value="{{@$salePrice}}"/>

                        <div class="form-group"><strong>Truckloads available per day :</strong>
                          <select name="available_per_day" id="available_per_day" class="form-control select2">
                            <option value="">Select Available per day</option>
                            <option value="1" <?php echo (@$stock->available_per_day=='1'?'selected':'')?>>1</option>
                            <option value="2" <?php echo (@$stock->available_per_day=='2'?'selected':'')?>>2</option>
                            <option value="3" <?php echo (@$stock->available_per_day=='3'?'selected':'')?>>3</option>
                            <option value="4" <?php echo (@$stock->available_per_day=='4'?'selected':'')?>>4</option>
                            <option value="5" <?php echo (@$stock->available_per_day=='5'?'selected':'')?>>5</option>
                          </select>
                        </div>
                        <div class="form-group"><strong>Note :</strong>
                          <textarea class="form-control" name="note" placeholder="note">{{@$stock->note}}</textarea>
                        </div>

                    </div>
                    </div>
                  </div>
                </div>
            </div>

        </div>


                <div class="row mt-4 mb-4">
                    <div class="col">

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.matches.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('Send Offer')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
@push('after-scripts')
<style>
  .datepicker > div.datepicker-days{display:block !important;}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $( "#available_from_date" ).datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        calendarWeeks: true,
        autoclose: true,
      });
    
    $("#collapseOfferDetails .odf").change(function(){
        var fieldname = "";
        var fieldvalue = "";
        if($(this).attr('name') == "price"){
            fieldname = "price";
        }else if($(this).attr('name') == "discount_percent"){
            fieldname = "discount_percent";
        }else if($(this).attr('name') == "discount_flat_amount"){
            fieldname = "discount_flat_amount";
        }        
        fieldvalue = $(this).val();

        $.ajax({
            url: "{{ route('admin.matches.reloadOfferPrice') }}",
            method: "GET",
            dataType:"json",
            data: { '_token' : $('meta[name="csrf-token"]').attr('content'), fieldname : fieldname, fieldvalue : fieldvalue, matchId : $("input[name='match_id']").val(), 'salePrice' : "{{ @$salePrice }}" },
        }).done(function(response){
            //alert(response);
            $("#collapseOfferDetails .profitPerTon").html(response.profitPerTon);
            $("#collapseOfferDetails .profitPerTruck").html(response.profitPerTruck);
            $("#collapseOfferDetails .totalProfit").html(response.profit);
            $("#collapseOfferDetails .reloadOfferPrice").html(response.pton_calculation);
            $("#collapseOfferDetails .price").val(response.offerprice);
            $("#collapseOfferDetails .discount_percent").val(response.discount);
            $("#collapseOfferDetails .discount_flat_amount").val(response.discount_flat_amount);            
        });
    });
});
</script>
@endpush
