@extends('backend.layouts.app')

@section('title',  __('labels.backend.access.roles.management'). ' | '.app_name())

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
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.roles.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.role.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                     <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('labels.backend.access.roles.table.role')</th>
                            <th>@lang('labels.backend.access.roles.table.permissions')</th>
                            <th>@lang('labels.backend.access.roles.table.number_of_users')</th>
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
            ajax: "{{ route('admin.auth.role.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'permission', name: 'permission'},
                {data: 'no_of_users', name: 'no_of_users'},
                
                {data: 'action', name: 'action'},
                
            ]
        });
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this request!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/auth/role') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Request has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Request not deleted', 'error');
                }
            });
          }
        });
    });
});
  </script>
  @endpush