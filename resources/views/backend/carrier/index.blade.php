@extends('backend.layouts.app')
@section('title', 'Carrier :: ' . app_name())
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
            <div class="col-sm-6">
                <h4 class="card-title mb-0">
                    Carrier <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            
            <div class="col-sm-6">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.carrier.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.products.table.id')</th>
                            <th>Name</th>
                            <th>Vat</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Postal</th>
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
        ajax: "{{ route('admin.carrier.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'vat', name: 'vat'},
            {data: 'country', name: 'country'},
            {data: 'city', name: 'city'},
            {data: 'postal', name: 'postal'},
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
          text: 'You will not be able to recover this carrier!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/transport/carrier') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Carrier has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Carrier not deleted', 'error');
                }
            });
          }
        });
    });

  });
  </script>
  @endpush
