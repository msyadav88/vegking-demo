@php $productTypeManualData = get_buyer_popup_product_types(); @endphp
@php $active_lang = App::getLocale(); @endphp

<div class="modal fade" id="buyerform_modal" tabindex="-1" role="dialog" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{{ html()->form('POST', url('register'))->id('buyercontact_form')->open() }}
				<input type="hidden" name="referral" value="{{request()->referral}}">
				<input type="hidden" name="user_role" value="buyer">
				<div class="modal-header">
					<h3 class="modal-title-1">@lang('inner-content.frontend.buyform_popup.heading1')</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="card">
						<h4 class="modal-title" id="favoritesModalLabel">@lang('inner-content.frontend.buyform_popup.heading')</h4>
            
						<div class="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div class="row mt-2 mr-0 ml-0">
							<div class="col">
								<div class="form-group text-left">
									<a href="javascript:;" class="BuyBackBtn btn btn-primary previous_btn" data-id="1" disabled="disabled">@lang('inner-content.frontend.buyform_popup.back_Button')</a>
								</div>
							</div>
							<div class="col">
								<div class="form-group text-right">
									<a href="javascript:;" class="BuyNextBtn btn btn-primary next_btn disabled" data-id="2" disabled="disabled">@lang('inner-content.frontend.buyform_popup.next_Button')</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="card">
						<div class="card-body">
							@php $i=1; $products = get_products(); $pCount = count($products);
							$pdata = $products->toArray(); @endphp
							@foreach($pdata as $value)
								@php
									$product_id="";
									if(strtolower(request()->product)==strtolower($value['name'])){
										$product_id = $value['id'];
										break;
									}
								@endphp
							@endforeach                        
							@if(Auth::check())                  
								<div class="user-login text-center text-danger">You are already logged in.</div>
							@endif
							<div class="row">
								@foreach($products as $product)                    
									<div class="col-md-4 buyer_step1">
										<p class="text-center ProductNameStyle">{{$product['name']}}</p>
											<a href="javascript:void(0);" class="product-img-select" data-id="{{$product->id}}" data-caption="{{$product['name']}}">
											<img src="{{ asset('images/products/') }}/{{$product->homepage_image}}" style="width:100%;" class="mb-2 img-thumbnail" />
										</a>
									</div><!--col-->
									@php $i++; @endphp
								@endforeach
							</div>
						</div>
					</div>
				</div>
			{{ html()->form()->close() }}
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#buyerform_modal.modal').on('show.bs.modal', function () {
      var url = new URL(window.location);
      url.searchParams.set("buyform", "0"); // setting your param
      window.history.pushState(null, document.title, url);
    });
	setProgressBar(form_count);  
  function setProgressBar(curStep){
    var percent = parseFloat(100 / total_forms) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  } 
</script>