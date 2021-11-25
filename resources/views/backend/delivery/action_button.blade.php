@if(auth()->user()->hasRole('trader') && Request::segment(1) == 'trader')
    @php $route_pre = 'trader'; @endphp
@else
    @php $route_pre = 'admin'; @endphp
@endif
<div class="btn-group btn-group-sm">
  <button type="button" class="btn btn-primary editWeight" data-id="{{$row->id}}" title="Edit weight"> Edit Weight</button>
  <br>
  <div>
    <a class="btn btn-success" href="{{ route($route_pre.'.deliveries.edit', $row->id) }}"> <i class="fas fa-edit"></i></a>
  </div>
</div>