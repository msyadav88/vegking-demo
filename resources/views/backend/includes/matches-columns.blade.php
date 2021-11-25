<div class="modal fade" id="hideShowCols" role="dialog">
    <div class="modal-dialog" style="width: 300px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 10px;">
                <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> 
                    Hide Show columns
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:15px 10px; max-height:400px; overflow:scroll;">
                <div class="model-row row mb-2">
                    @if($matches_names->status)
                        @php 
                            $is_checked = $matches_names->status;
                            $checked = 'checked="checked"';
                        @endphp
                    @else
                        @php
                            $checked = '';
                            $is_checked = 0;
                        @endphp
                    @endif
                    @if($matches_names->status == 1)
                        @php $counting = 1; @endphp
                        @foreach($matches_names->short_names as $name)
                            <div class="col-md-12">
                                <label for="key" class="col-md-8"><span class="glyphicon glyphicon-eye-open"></span> {{$name}} </label>
                                <input class="pref_check" type="checkbox" id="status{{$counting}}" data-column="{{$counting}}" value="{{ $is_checked }}" {{ $checked }} >
                            </div>
                            @php $counting++; @endphp
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 