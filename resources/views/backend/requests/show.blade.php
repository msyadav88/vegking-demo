@extends('backend.layouts.app')
@section('title', 'Request Details #'.$offer_request->id . ' :: ' . app_name())
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
              <strong>Request Details #{{ $offer_request->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Request ID:</strong> {{ $offer_request->id }}</div>
                <div class="form-group"><strong>Product Name:</strong> {{ $offer_request->product->name }}</div>
                <div class="form-group"><strong>Variety:</strong> {{ $offer_request->variety }}</div>
                <div class="form-group"><strong>Size:</strong> {{ $offer_request->size_from }} - {{ $offer_request->size_to }}</div>
                <div class="form-group"><strong>Packing:</strong> {{ $offer_request->packing }}</div>
                <div class="form-group"><strong>Quantity:</strong> {{ $offer_request->quantity }}</div>
                <div class="form-group"><strong>Flesh Color:</strong> {{ $offer_request->flesh_color }}</div>
                <div class="form-group"><strong>Location:</strong> {{ $offer_request->location_from }} - {{ $offer_request->location_to }}</div>
                <div class="form-group"><strong>Price:</strong> {{ currency($offer_request->price_from) }} - {{ currency($offer_request->price_to) }}</div>
                <div class="form-group"><strong>Status:</strong> {{ $offer_request->status }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header collapsed" id="headingSellerDetails" data-toggle="collapse" data-target="#collapseSellerDetails" aria-expanded="false" aria-controls="collapseSellerDetails">
              <strong>Buyer Details</strong>
            </div>
            <div id="collapseSellerDetails" class="collapse" aria-labelledby="headingSellerDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Buyer ID:</strong> {{ $offer_request->buyer->id }}</div>
                <div class="form-group"><strong>Name:</strong> {{ $offer_request->buyer->full_name }}</div>
                <div class="form-group"><strong>Email:</strong> {{ $offer_request->buyer->email }}</div>
                <div class="form-group"><strong>Phone:</strong> {{ $offer_request->buyer->phone }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header collapsed" id="headingproductDetails" data-toggle="collapse" data-target="#productDetails" aria-expanded="false" aria-controls="productDetails">
              <strong>Product Details</strong>
            </div>
            <div id="productDetails" class="collapse" aria-labelledby="headingproductDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Product ID:</strong> {{ $offer_request->product->id }}</div>
                <div class="form-group"><strong>Variety:</strong> {{ $offer_request->product->variety }}</div>
                <div class="form-group"><strong>Size:</strong> {{ $offer_request->product->size_from }} - {{ $offer_request->product->size_to }}</div>
                <div class="form-group"><strong>Packing:</strong> {{ $offer_request->product->packing }}</div>
                <div class="form-group"><strong>Quantity:</strong> {{ $offer_request->product->quantity }}</div>
                <div class="form-group"><strong>Flesh Color:</strong> {{ $offer_request->product->flesh_color }}</div>
                <div class="form-group"><strong>Location:</strong> {{ $offer_request->product->location }}</div>
                <div class="form-group"><strong>Price:</strong> {{ currency($offer_request->product->price) }}</div>
              </div>
            </div>
          </div>
        </div>
        <h3 class="mt-5">Maching Offers</h3>
        <hr>
        <div class="row mt-2">
          <div class="col">
            <div class="table-offers">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>@lang('labels.backend.trading.offers.table.id')</th>
                    <th>@lang('labels.backend.trading.requests.table.seller')</th>
                    <th>@lang('labels.backend.trading.offers.table.product')</th>
                    <th>@lang('labels.backend.trading.offers.table.variety')</th>
                    <th>@lang('labels.backend.trading.offers.table.size_from')</th>
                    <th>@lang('labels.backend.trading.offers.table.size_to')</th>
                    <th>@lang('labels.backend.trading.offers.table.packing')</th>
                    <th>@lang('labels.backend.trading.offers.table.quantity')</th>
                    <th>@lang('labels.backend.trading.offers.table.color')</th>
                    <th>@lang('labels.backend.trading.offers.table.location_from')</th>
                    <th>@lang('labels.backend.trading.offers.table.location_to')</th>
                    <th>@lang('labels.backend.trading.offers.table.price')</th>
                    <th>@lang('labels.backend.trading.offers.table.status')</th>
                    <th>@lang('labels.backend.trading.offers.table.date')</th>
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
        <a class="btn btn-primary" href="{{ route('admin.requests.index') }}"> {{__('buttons.general.back')}}</a>
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
    ajax: "{{ route('admin.requests.matchings', $offer_request->id) }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'seller.full_name', name: 'seller.full_name'},
      {data: 'product.name', name: 'product.name'},
      {data: 'variety', name: 'variety'},
      {data: 'size_from', name: 'size_from'},
      {data: 'size_to', name: 'size_to'},
      {data: 'packing', name: 'packing'},
      {data: 'quantity', name: 'quantity'},
      {data: 'flesh_color', name: 'flesh_color'},
      {data: 'location_from', name: 'location_from'},
      {data: 'location_to', name: 'location_to'},
      {data: 'price', name: 'price'},
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
    var offer_id = '{{ $offer_request->id }}';
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
          url: "{{ route('admin.requests.matching.apply') }}?request_id="+request_id+"&offer_id="+offer_id,
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
