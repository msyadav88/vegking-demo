<div class="btn-group btn-group-sm">
    @can('edit seller')
        <button type="button" class="btn btn-edit editItem" data-url="{{ $seller_edit_url }}"><i class="fas fa-edit"></i></button>
    @endcan
    @can('view seller')
        <button type="button" class="btn btn-primary viewItem" data-url="{{$seller_show_url}}"><i class="fas fa-eye"></i></button>
    @endcan
    @can('delete seller')
        <button data-toggle="tooltip" data-id="{{$row->id}}" data-original-title="{{ __('Delete') }}" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
    @endcan
    <button type="button" class="btn btn-primary resend_invite" data-id="{{$row->id}}" data-url="{{$seller_resend_url}}" data-toggle="tooltip" title="@lang('labels.general.resend')"><i class="fas fa-paper-plane"></i></button>
</div>