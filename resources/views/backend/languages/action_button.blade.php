<div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-primary editItem" data-id="{{$row->id}}"><i class="fas fa-edit"></i></button>
                          <button data-toggle="tooltip" data-id="{{$row->id}}" data-original-title="{{ __('Delete') }}" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                        </div>