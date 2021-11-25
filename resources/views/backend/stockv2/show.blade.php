@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.offers.show').' #'.$stock->id . ' :: '.app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif
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
                  <div class="form-group"><strong>Stock Attachment:</strong>
                    @php $images = (isset($stock->image) ? (is_array(json_decode(@$stock->image)) ? json_decode(@$stock->image) : array($stock->image)) : array()); @endphp
                    @foreach(@$images as $img)
                      <a href="{{ asset('images/stock/'.$img) }}" data-fancybox data-caption="{{@$stock->product->name}}"><i class="fa fa-paperclip" aria-hidden="true"></i>{{ $img }}</a>
                    @endforeach
                  </div>
                  @endif
                  @if($stock->exp_image)
                    <div class="form-group"><strong>Example Attachment:</strong><a href="{{ asset('images/stock/'.$stock->exp_image) }}" target="_blank" >  <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $stock->exp_image }}</a></div>
                  <!--<div class="form-group">
					  Example Picture
					  <img src="{{ asset('images/stock/'.$stock->exp_image) }}" class="img-thumbnail" style="max-width:500px; height:200px">
                  </div>-->
                  @endif

                <div class="form-group"><strong>Stock ID:</strong> {{ $stock->id }}</div>
                <div class="form-group"><strong>Product Name:</strong> {{ @$stock->product->name }}</div>
                <div class="form-group"><strong>Size:</strong> {{ $stock->size_from }} - {{ $stock->size_to }}</div>
                @foreach($offerPropertyArr as $display_name=>$productPref)
                    @if(is_array($productPref)&& !empty($productPref))
                        <div class="form-group"><strong>{{ @$display_name }}: </strong>{{  implode(', ',@$productPref) }}</div>
                    @endif
                @endforeach
                <div class="form-group"><strong>Quantity:</strong> {{ $stock->quantity ?? 'N/A' }}</div>
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
                <div class="form-group"><strong>Seller ID:</strong> {{ @$stock->seller->id ?? 'N/A' }}</div>
                <div class="form-group"><strong>Name:</strong> {{ @$stock->seller->name ?? 'N/A' }}</div>
                <div class="form-group"><strong>Email:</strong> {{ @$stock->seller->email ?? 'N/A' }}</div>
                <div class="form-group"><strong>Phone:</strong> {{ @$stock->seller->phone ?? 'N/A' }}</div>
              </div>
            </div>
          </div>
        </div>
        <h3 class="mt-5">Seller Stocks</h3>
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
                    <th>@lang('labels.backend.trading.offers.table.size_from')</th>
                    <th>@lang('labels.backend.trading.offers.table.size_to')</th>
                    <th>@lang('labels.backend.trading.offers.table.quantity')</th>
                    <th>Country</th>
                    <th>Price in GBP</th>
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
        <a class="btn btn-primary" href="{{ route($route_pre.'.stock.index') }}"> {{__('buttons.general.back')}}</a>
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
    ajax: "{{ route($route_pre.'.stock.matchings',isset($stock->seller)?$stock->seller->id:0) }}",
    columns: [
        {data: 'id', name: 'id'},
        {data: 'seller_username', name: 'seller_username'},
        {data: 'product_name', name: 'product_name'},
        {data: 'size_from', name: 'size_from'},
        {data: 'size_to', name: 'size_to'},
        {data: 'quantity', name: 'quantity'},
        {data: 'country', name: 'country'},
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
    var offer_id = '{{ $stock->id }}';
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
          url: "{{ route($route_pre.'.stock.matching.apply') }}?request_id="+request_id+"&offer_id="+offer_id,
          success: function (data) {
            Swal.fire('Applied!', 'Notification sent to buyer, seller and transport.', 'success');
            table.draw();
          },
          error: function (data) {
            Swal.fire('Error!', 'Stock not applied', 'error');
          }
        });
      }
    });
  });
  $('body').on('click', '.viewItem', function () {
      var item_url = $(this).data("url");
      window.location.href = item_url;
  });
  $('body').on('click', '.editItem', function () {
      var item_url = $(this).data("url");
      window.location.href = item_url;
  });
  $('body').on('click', '.deleteItem', function () {
      var product_id = $(this).data("id");
      Swal.fire({
        title: 'Are You sure want to delete?',
        text: 'You will not be able to recover this offer!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
      }).then((result) => {
        if (result.value) {
          $.ajax({
              type: "DELETE",
              url: "{{ url($route_pre.'/trading/stock') }}"+'/'+product_id,
              success: function (data) {
                  Swal.fire('Deleted!', 'Offer has been deleted.', 'success');
                  table.draw();
              },
              error: function (data) {
                Swal.fire('Error!', 'Offer not deleted', 'error');
              }
          });
        }
      });
    });
});

</script>
@endpush
