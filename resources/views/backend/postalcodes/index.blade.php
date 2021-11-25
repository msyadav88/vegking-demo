@extends('backend.layouts.app')
@section('title', 'Postal Codes :: ' . app_name())
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
            <div class="col-sm-4">
                <h4 class="card-title mb-0">
                    Postal Codes <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            <div class="col-sm-4">
              <select class="form-control" id="type" name="type" onchange="window.location.href='{{ route('admin.postalcodes.index') }}?type='+this.value">
                <option value="">Filter City/Country</option>
                <option value="city" @if(isset($_GET['type']) && $_GET['type'] =='city' ) selected @endif >City</option>
                <option value="country" @if(isset($_GET['type']) && $_GET['type'] =='country' ) selected @endif >Country</option>
              </select>
            </div>
            @can('add postal code')
            <div class="col-sm-4">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.postalcodes.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div><!--col-->
            @endcan
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.products.table.id')</th>
                            @if((isset($_GET['type']) && $_GET['type'] == 'city') || !isset($_GET['type']))
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Country</th>
                            <th>Price</th>
                            @elseif(isset($_GET['type']) && $_GET['type'] == 'country')
                            <th>Country</th>
                            <th>Country Code</th>
                            <th>Phone Code</th>
                            @endif
                            <th>Status</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script type="text/javascript">
  $(function () {
    setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route('admin.postalcodes.index') }}"+'?@if(isset($_GET['type']))type={{$_GET['type']}}@endif',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            @if((isset($_GET['type']) && $_GET['type'] == 'city') || !isset($_GET['type']))
            {data: 'postal_code', name: 'postal_code'},
            {data: 'country', name: 'country'},
            {data: 'price', name: 'price'},
            @elseif(isset($_GET['type']) && $_GET['type'] == 'country')
            {data: 'code', name: 'code'},
            {data: 'ph_code', name: 'ph_code'},
            @endif
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });

    $('body').on('click', '.viewItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });

    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this product!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/transport/postalcodes') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Product not deleted', 'error');
                }
            });
          }
        });
    });

  });
  </script>
  @endpush
