<div class="btn-group btn-group-sm">
    @if(isset($edit_permission)) @can($edit_permission)
        <button type="button" class="btn btn-edit editItem" data-url="{{ $edit_url }}"><i class="fas fa-edit"></i></button>
    @endcan @endif
    @if(isset($show_permission)) @can($show_permission)
        <button type="button" class="btn btn-primary viewItem" data-url="{{$show_url}}"><i class="fas fa-eye"></i></button>
    @endcan @endif
    @if(isset($delete_permission)) @can($delete_permission)
        <button data-toggle="tooltip" data-id="{{$row->id}}" data-original-title="{{ __('Delete') }}" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
    @endcan @endif
</div>