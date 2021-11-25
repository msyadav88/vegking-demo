@extends('backend.layouts.app')
@section('title', 'Offer Details #'.$stock->id . ' :: '.app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingofferDetails" data-toggle="collapse" data-target="#collapseofferDetails" aria-expanded="true" aria-controls="collapseofferDetails">
              <strong>Stock Details #{{ $stock->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body">

                  @if($stock->image)
                   <div class="form-group"><strong>Stock Attachment:</strong><a href="{{ asset('images/stock/'.$stock->image) }}" target="_blank" > <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $stock->image }}</a></div>
                  <!-- <div class="form-group">
					  <img src="{{ asset('images/stock/'.$stock->image) }}" class="img-thumbnail" style="max-width:500px; height:200px">
                  </div>-->
                  @endif
                  @if($stock->exp_image)
                    <div class="form-group"><strong>Example Attachment:</strong><a href="{{ asset('images/stock/'.$stock->exp_image) }}" target="_blank" >  <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $stock->exp_image }}</a></div>
                  <!--<div class="form-group">
					  Example Picture
					  <img src="{{ asset('images/stock/'.$stock->exp_image) }}" class="img-thumbnail" style="max-width:500px; height:200px">
                  </div>-->
                  @endif

                <div class="form-group"><strong>Stock ID:</strong> {{ $stock->id }}</div>
                <div class="form-group"><strong>Product Name:</strong> {{ $stock->product->name }}</div>
                <div class="form-group"><strong>Variety:</strong> {{ $stock->variety_detail->name  }}</div>
                <div class="form-group"><strong>Size:</strong> {{ $stock->size_from }} - {{ $stock->size_to }}</div>
                <div class="form-group"><strong>Packing:</strong> {{ $stock->packing_detail->name ?? 'N/A' }}</div>
                <div class="form-group"><strong>Quantity:</strong> {{ $stock->quantity ?? 'N/A' }}</div>
                <div class="form-group"><strong>Flesh Color:</strong> {{ $stock->flesh_color_detail->name ?? 'N/A' }}</div>
                <div class="form-group"><strong>Country:</strong> {{ $stock->country ?? 'N/A' }}</div>
                <div class="form-group"><strong>Street:</strong> {{ $stock->street ?? 'N/A' }}</div>
                <div class="form-group"><strong>City:</strong> {{ $stock->city ?? 'N/A' }}</div>
                <div class="form-group"><strong>Postal code:</strong> {{ $stock->postalcode ?? 'N/A' }}</div>
                <div class="form-group"><strong>Price in GBP:</strong> {{ currency($stock->price) ?? 'N/A' }}</div>
                <div class="form-group"><strong>Note:</strong> {{ $stock->note ?? 'N/A' }}</div>
                <div class="form-group"><strong>Status:</strong> {{ $stock->status }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header collapsed" id="headingSellerDetails" data-toggle="collapse" data-target="#collapseSellerDetails" aria-expanded="false" aria-controls="collapseSellerDetails">
              <strong>Seller Details</strong>
            </div>
            <div id="collapseSellerDetails" class="collapse" aria-labelledby="headingSellerDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Seller ID:</strong> {{ $stock->seller->id ?? 'N/A' }}</div>
                <div class="form-group"><strong>Name:</strong> {{ $stock->seller->name ?? 'N/A' }}</div>
                <div class="form-group"><strong>Email:</strong> {{ $stock->seller->email ?? 'N/A' }}</div>
                <div class="form-group"><strong>Phone:</strong> {{ $stock->seller->phone ?? 'N/A' }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('seller.stock.index') }}"> {{__('buttons.general.back')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});
$('body').on('click', '.viewItem', function () {
    var item_url = $(this).data("url");
    window.location.href = item_url;
});
</script>
@endpush
