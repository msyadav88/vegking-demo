@extends('backend.layouts.app')

@section('title',   __('labels.backend.access.users.management'). ' | ' .app_name())

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

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
<style>
.btn-group .dropdown-item{padding: 2px 20px;}
</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                {{ __('labels.backend.access.users.management') }} <small class="text-muted">{{ __('labels.backend.access.users.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.user.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                     <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>ID </th>
                            <th>
                            @lang('labels.backend.access.users.table.first_name')</th>
                            <th>@lang('labels.backend.access.users.table.last_name')</th>
                            <th>@lang('labels.backend.access.users.table.email')</th>
                            <th>Phone</th>
                            <th>@lang('labels.backend.access.users.table.confirmed')</th>
                            <th>@lang('labels.backend.access.users.table.roles')</th>
							<th>Affiliate Code</th>
                            <th>Referrer</th>
                            <th>@lang('labels.backend.access.users.table.other_permissions')</th>
                            <th>@lang('labels.backend.access.users.table.social')</th>
                            <th>@lang('labels.backend.access.users.table.last_updated')</th>
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
             createdRow: function( row, data, dataIndex ) {
                $(row).find('.btn-group').find('.btn-group').find('.dropdown-menu').find('[data-method]').append(function () {
                    if (!$(this).find('form').length > 0) {
                        return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" + "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" + "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" + '</form>\n';
                    } else {
                        return '';
                    }
                }).attr('href', '#').attr('style', 'cursor:pointer;').attr('onclick', '$(this).find("form").submit();');
            },
            ajax: "{{ route('admin.auth.user.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'confirmed_label', name: 'confirmed_label'},
                {data: 'roles_label', name: 'roles_label'},
				{data: 'user_code', name: 'user_code'},
                {data: 'referrer', name: 'referrer'},
                {data: 'permissions_label', name: 'permissions_label'},
                {data: 'social_buttons', name: 'social_buttons'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'},
            ]
        });
        $('.data-table tbody').on('click', '.child #userActions', function () {
            $('.btn-group').find('.btn-group').find('.dropdown-menu').find('[data-method]').append(function () {
                if (!$(this).find('form').length > 0) {
                    return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" + "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" + "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" + '</form>\n';
                } else {
                    return '';
                }
        }).attr('href', '#').attr('style', 'cursor:pointer;').attr('onclick', '$(this).find("form").submit();');
	});

    });
  </script>
  @endpush
