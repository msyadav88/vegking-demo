  <!-- Inquire Modal -->

  <div class="modal fade" id="products_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img  class="CloseIcon" src="{{asset('img/crossicon.png')}}"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <h4 class="text-center PorductBannerBg">@lang('inner-content.frontend.popup.product_modal_text')</h4>
              <div class="mobile_only"><img class="productLogo" src="{{asset('img/offer-popup-logo.png')}}"></div>
              <ul class="PorductBuySellButtons">
              <li><a @hasanyrole("buyer") href="{{ url('buyer/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('buyer')" href="javascript:;" @endhasanyrole>BUY</a>
                {{-- @lang('inner-content.frontend.popup.product_modal_Buy_button') --}}
              </li>
              <li class="hide_on_mobile"><img  class="productLogo" src="{{asset('img/offer-popup-logo.png')}}"></li>
              <li>
                <a @hasanyrole("seller") href="{{ url('seller/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('seller')" href="javascript:;" @endhasanyrole>SELL</a>
                {{-- @lang('inner-content.frontend.popup.product_modal_sell_button') --}}
              </li>
              </ul>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



  <?php /*?><div class="modal fade" id="products_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img  class="CloseIcon" src="{{asset('img/crossicon.png')}}"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <h4 class="text-center PorductBannerBg">@lang('inner-content.frontend.popup.product_modal_text')</h4>
            </div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.potatoes')</h4><img src="{{asset('img/POTATOES.jpg')}}" class="img-fluid" alt="POTATOES"></div></div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.onion')</h4><img src="{{asset('img/ONION.jpg')}}" class="img-fluid" alt="ONION"></div></div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.cauliflower')</h4><img src="{{asset('img/CAULIFLOWER.jpg')}}" class="img-fluid" alt="CAULIFLOWER"></div></div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.cabbage')</h4><img src="{{asset('img/CABBAGE.jpg')}}" class="img-fluid" alt="CABBAGE"></div></div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.broccoli')</h4><img src="{{asset('img/BROCCOLI.jpg')}}" class="img-fluid" alt="BROCCOLI"></div></div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.beets')</h4><img src="{{asset('img/BEETS.jpg')}}" class="img-fluid" alt="BEETS"></div></div>
            <div class="col-md-4 mb-4"><div class="text-center"><h4 class="ProductHeading">@lang('inner-content.frontend.popup.other')</h4><img src="{{asset('img/other.jpg')}}" class="img-fluid" alt="OTHER"></div></div>
          </div>

        </div>
      </div>
    </div>
  </div><?php */?>
  @push('after-scripts')
  <script>
  $(document).ready(function(){
    $("#open_buyercontact_modal").click(function() {
        $("#products_modal").modal('hide');
        $("#buyercontact_modal").modal('show');
        setTimeout(function(){
          $("body").addClass('modal-open');
        }, 500);
    });
    $("#open_sellercontact_modal").click(function() {
        $("#products_modal").modal('hide');
        $("#sellercontact_modal").modal('show');
        setTimeout(function(){
          $("body").addClass('modal-open');
        }, 500);
    });

    $("body").click(function() {
      if (window.location.href.indexOf('buy=') > 0 && window.location.href.indexOf('product=') > 0) {
        $('#offer_menu').attr("data-target","#buyercontact_modal");
      }else{
        $('#offer_menu').attr("data-target","#products_modal");
      }
    });

  });
  </script>

  <script type="text/javascript">
    function formatState(state){
      if (!state.id) { return state.text; }
      var $state = $(
       '<span ><img style="display: inline-block;width: 30px;height: 22px;" src="{{url('img/flags')}}/'+state.element.value+'.jpg" /> ' + state.text + '</span>'
      );
      return $state;
    }
    function formatStateSelected(state){
      if (!state.id) { return state.text; }
      var $state = $(
       '<span ><img style="display: inline-block;width: 30px;height: 22px;" src="{{url('img/flags')}}/'+state.element.value+'.jpg" /></span>'
      );
      return $state;
    }

    function validatePassword($this){
      var confirm_password = $this;
      var form_id = $($this).parents("form").attr("id");
    
      if($("#"+form_id+" .password").val() != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      }else{
        confirm_password.setCustomValidity('');
      }
    }
  </script>
  @endpush
