<div class="modal fade" id="updateMatchesName" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 10px;">
                <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> 
                    Update Matches Columns Short Names
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:15px 10px;">
                <form role="form" method="post" class="form-inline" id="formMatches" style="max-height:500px; overflow:scroll;">
                    <div class="columns col-md-12 row">
                        @php $loops = 1; @endphp
                        @foreach($matches_names->short_names as $name)    
                            <div class="model-row row mb-2 rows" id="remove{{$loops}}">
                                <div class="col-md-4"> 
                                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Columns {{ $loops }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input name="short_names[]" id="shop{{$loops}}" value="{{$name}}" reuired type="text" class="model-row form-control">
                                    <div class="invalid-feedback"></div>   
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <a href="javascript:void(0)" class="addRow btn btn-success" style="padding: 3px 5px 2px 5px;"><span class="fa fa-plus-circle"></span></a>
                                        @if($loops > 1)
                                            <a href="javascript:void(0)" class="removeRow btn btn-danger" style="padding: 3px 5px 2px 5px;"><span class="fa fa-minus-circle"></span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @php $loops++; @endphp
                        @endforeach
                    </div>
                    <div class="model-row row mb-2">
                        <div class="col-md-4"> 
                            <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Status </label>
                        </div>
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
                        <div class="col-md-4">
                            <input class="pref_check" type="checkbox" name="status" id="status" value="{{ $is_checked }}" {{ $checked }} >
                        </div>
                    </div>
                    <button id="update_matches_name" type="submit" class="btn btn-success btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
</div> 