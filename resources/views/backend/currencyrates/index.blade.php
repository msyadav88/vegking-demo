@extends('backend.layouts.app')
@section('title',('Currency Rate'). ' :: ' . app_name())
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
                    Currency Rate <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            <div class="col-sm-8">

               <div class=" float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="javascript:void(0);" id="get_currencies" class="btn btn-success ml-1"> <i class="nav-icon fa fa-dollar-sign"></i> Update Currecny</a>
                </div><!--btn-toolbar-->
                @can('add currency rate')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.currencyrates.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
                @endcan
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Rate</th>
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
        ajax: "{{ route('admin.currencyrates.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'from', name: 'from'},
            {data: 'to', name: 'to'},
            {data: 'rate', name: 'rate'},
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
        var product_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this currency rate!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/currencyrates') }}"+'/'+product_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Currency Rate has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Currency Rate not deleted', 'error');
                }
            });
          }
        });
    });

    $("#get_currencies").click(function() {
			$.ajax( {
				url: "{{ route('admin.currencyRate') }}",
				method: 'POST',
                beforeSend: function() {
             $('.loading').removeClass('loading_hide');
            },
				success: function(data) {
                    if(data.status == 'success')
                    {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Updated!', data.message, 'success');
                        table.draw();
                    }
				}
			});
		});
  });
  </script>
  @endpush
