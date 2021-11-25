<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    @php ($sel_lang = '')
    <?php
    $localelanguage = config('locale.languages');
	// print_r($localelanguage);
    foreach(array_keys(config('locale.languages')) as $lang){  ?>
        @if($lang != app()->getLocale())
            <div><a href="{{ url('lang/'.$lang) }}" class="dropdown-item"> <img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" style="height: 25px;"><span style="margin-left: 10%;" >@lang('menus.language-picker.langs.'.$lang)</span></a></div>
        @else
        	@php ($sel_lang = $lang)
        @endif
    <?php } ?>
</div>
<!--input type="button" id="close_google"  value="Close Google" -->
<div id="google_translate_element" style="display: none;"></div>

<script type="text/javascript">
	function triggerHtmlEvent(element, eventName) {
		var event;
		if(document.createEvent) {
		    event = document.createEvent('HTMLEvents');
		    event.initEvent(eventName, true, true);
		    element.dispatchEvent(event);
		} else {
		    event = document.createEventObject();
		    event.eventType = eventName;
		    element.fireEvent('on' + event.eventType, event);
		}
	}

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
  	$(document).ready( function () {
		setTimeout( function(){
			$("select.goog-te-combo").val("{{$sel_lang}}");
			sel_element = document.getElementsByClassName("goog-te-combo");
			triggerHtmlEvent( sel_element[0] , 'change');
		}, 3000);
	});
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
