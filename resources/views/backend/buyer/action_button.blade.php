<div class="btn-group btn-group-sm">
    @can('edit buyer')
        <button type="button" class="btn btn-edit editItem" data-url="{{ $buyer_edit_url }}"><i class="fas fa-edit"></i></button>
    @endcan
    @can('view buyer')
        <button type="button" class="btn btn-primary viewItem" data-url="{{$buyer_show_url}}"><i class="fas fa-eye"></i></button>
    @endcan
    @can('delete buyer')
        <button data-toggle="tooltip" data-id="{{$row->id}}" data-original-title="{{ __('Delete') }}" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
    @endcan
</div>