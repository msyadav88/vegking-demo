@extends('backend.layouts.app')
@section('title',  __('Show Trade Settings').' #'.$offer->id . ' :: '.app_name())
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
              <strong>Offer Details #{{ $offer->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Offer ID:</strong> {{ $offer->id }}</div>
                <div class="form-group"><strong>Product Name:</strong> {{ $offer->product->name }}</div>
                <div class="form-group"><strong>Variety:</strong> {{ $offer->variety }}</div>
                <div class="form-group"><strong>Size:</strong> {{ $offer->size_from }} - {{ $offer->size_to }}</div>
                <div class="form-group"><strong>Packing:</strong> {{ $offer->packing }}</div>
                <div class="form-group"><strong>Quantity:</strong> {{ $offer->quantity }}</div>
                <div class="form-group"><strong>Flesh Color:</strong> {{ $offer->flesh_color }}</div>
                <div class="form-group"><strong>Location From:</strong> {{ $offer->location_from }}</div>
                <div class="form-group"><strong>Location To:</strong> {{ $offer->location_to }}</div>
                <div class="form-group"><strong>Price:</strong> {{ currency($offer->price) }}</div>
                <div class="form-group"><strong>Status:</strong> {{ $offer->status }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header collapsed" id="headingSellerDetails" data-toggle="collapse" data-target="#collapseSellerDetails" aria-expanded="false" aria-controls="collapseSellerDetails">
              <strong>Seller Details</strong>
            </div>
            <div id="collapseSellerDetails" class="collapse" aria-labelledby="headingSellerDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Seller ID:</strong> {{ $offer->seller->id }}</div>
                <div class="form-group"><strong>Name:</strong> {{ $offer->seller->full_name }}</div>
                <div class="form-group"><strong>Email:</strong> {{ $offer->seller->email }}</div>
                <div class="form-group"><strong>Phone:</strong> {{ $offer->seller->phone }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header collapsed" id="headingproductDetails" data-toggle="collapse" data-target="#productDetails" aria-expanded="false" aria-controls="productDetails">
              <strong>Product Details</strong>
            </div>
            <div id="productDetails" class="collapse" aria-labelledby="headingproductDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Product ID:</strong> {{ $offer->product->id }}</div>
                <div class="form-group"><strong>Variety:</strong> {{ $offer->product->variety }}</div>
                <div class="form-group"><strong>Size:</strong> {{ $offer->product->size_from }} - {{ $offer->product->size_to }}</div>
                <div class="form-group"><strong>Packing:</strong> {{ $offer->product->packing }}</div>
                <div class="form-group"><strong>Quantity:</strong> {{ $offer->product->quantity }}</div>
                <div class="form-group"><strong>Flesh Color:</strong> {{ $offer->product->flesh_color }}</div>
                <div class="form-group"><strong>Location:</strong> {{ $offer->product->location }}</div>
                <div class="form-group"><strong>Price:</strong> {{ currency($offer->product->price) }}</div>
              </div>
            </div>
          </div>
        </div>
        <h3 class="mt-5">Maching Requests</h3>
        <hr>
        <div class="row mt-2">
          <div class="col">
            <div class="table-offers">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>@lang('labels.backend.trading.requests.table.id')</th>
                    <th>@lang('labels.backend.trading.requests.table.buyer')</th>
                    <th>@lang('labels.backend.trading.requests.table.product')</th>
                    <th>@lang('labels.backend.trading.requests.table.variety')</th>
                    <th>@lang('labels.backend.trading.requests.table.size_from')</th>
                    <th>@lang('labels.backend.trading.requests.table.size_to')</th>
                    <th>@lang('labels.backend.trading.requests.table.packing')</th>
                    <th>@lang('labels.backend.trading.requests.table.quantity')</th>
                    <th>@lang('labels.backend.trading.requests.table.color')</th>
                    <th>@lang('labels.backend.trading.requests.table.location_from')</th>
                    <th>@lang('labels.backend.trading.requests.table.location_to')</th>
                    <th>@lang('labels.backend.trading.requests.table.price_from')</th>
                    <th>@lang('labels.backend.trading.requests.table.price_to')</th>
                    <th>@lang('labels.backend.trading.requests.table.status')</th>
                    <th>@lang('labels.backend.trading.requests.table.date')</th>
                    <th>@lang('labels.general.actions')</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('admin.offers.index') }}"> {{__('buttons.general.back')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
$(function () {
  var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    responsive: true,
    ajax: "{{ route('admin.offers.matchings', $offer->id) }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'buyer.full_name', name: 'buyer.full_name'},
      {data: 'product.name', name: 'product.name'},
      {data: 'variety', name: 'variety'},
      {data: 'size_from', name: 'size_from'},
      {data: 'size_to', name: 'size_to'},
      {data: 'packing', name: 'packing'},
      {data: 'quantity', name: 'quantity'},
      {data: 'flesh_color', name: 'flesh_color'},
      {data: 'location_from', name: 'location_from'},
      {data: 'location_to', name: 'location_to'},
      {data: 'price_from', name: 'price_from'},
      {data: 'price_to', name: 'price_to'},
      {data: 'status', name: 'status'},
      {data: 'created_at', name: 'created_at'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('body').on('click', '.ApplyItem', function () {
    var request_id = $(this).data("request_id");
    var offer_id = '{{ $offer->id }}';
    Swal.fire({
      title: 'Are You sure?',
      text: 'Want to apply for this request!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, apply it!',
      cancelButtonText: 'No, don\'t apply'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "{{ route('admin.offers.matching.apply') }}?request_id="+request_id+"&offer_id="+offer_id,
          success: function (data) {
            Swal.fire('Applied!', 'Notification sent to buyer, seller and transport.', 'success');
            table.draw();
          },
          error: function (data) {
            Swal.fire('Error!', 'Offer not applied', 'error');
          }
        });
      }
    });
  });
});
</script>
@endpush
