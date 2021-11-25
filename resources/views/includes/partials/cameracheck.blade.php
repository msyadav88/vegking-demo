@if(Auth::check())
    @if(auth()->user()->hasRole('administrator') || auth()->user()->hasRole('trader'))
        <div class="alert alert-warning logged-in-as">
            <div class="form-group form-check" style="text-align: center">
                <input class="form-check-input" type="checkbox" name="camera" id="camera" value="1" required="required">
                <label class="form-check-label" for="agree">Click the checkbox to make picture</label>
            </div>
        </div><!--alert alert-warning logged-in-and-capture-->
    @endif
@endif