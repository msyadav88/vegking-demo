@extends('backend.layouts.app')
@if(!empty($buyer->id))
  @section('title', __('Edit Buyer').':: '.app_name())
@else
  @section('title', __('Add Buyer').' :: '.app_name())
@endif

@section('content')
{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          @if(!empty($buyer->id))
             Edit Buyer
         @else
          Add Buyer
         @endif
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->

    <hr>
    <div class="row mt-4 mb-4">
      <div class="col">

        <div class="form-group row">
          {{ html()->label('<strong>Username</strong> <span style="color:red">*</span>')->class('col-md-12 form-control-label')->for('username') }}

          <div class="col-md-4">
            <div class="form-group">
              {{ html()->text('username')
              ->class('form-control')
              ->placeholder('Username')
              ->value(@$buyer->username)
              ->attribute('id', 'username')
              ->attribute('maxlength', 191)
              }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->
          <div class="col-md-4 row">
              {{ html()->label('<strong>Discount (%)</strong>')->class('col-md-4 form-control-label float-left pl-4 pr-0')->for('transportation') }}
              <div class="col-md-8 float-left pl-md-0">
                 <input type="number" name="disc_upsc" value="{{ @$buyer->disc_upsc }}" data-decimals="2" min="0" max="100" step="0.1" class="float-left" />
              </div>
          </div>


          @php $price =  (isset($price->price) ? '+'.@$price->price : '0' ) @endphp
           {{ html()->label('<strong>Extra transport cost per ton</strong> &nbsp;&nbsp;'.$price)->class('col-md-4 form-control-label  pl-4 pr-0')->for('transportation_cost') }}

        <!--col-->
        </div><!--form-group-->
        
        <div class="form-group row">
          {{ html()->label('<strong>Nickname</strong> <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('nickname') }}
          <div class="col-md-4">
            {{ html()->text('nickname')
            ->class('form-control')
            ->placeholder('Nickname')
            ->value(@$buyer->nickname)
            ->attribute('maxlength', 191) 
            ->attribute('id', 'nickname') }}
			<div class="invalid-feedback"></div>
          </div><!--col-->
        </div><!--form-group-->
        
        <div class="form-group row">
          <label class="col-md-12 form-control-label" for="note"><strong>Notes</strong></label>
          <div class="col-md-12">
            <textarea class="form-control" name="note" rows="3" placeholder="Notes" id="note">{{@$buyer->note}}</textarea>
          </div>
        </div>

        <div class="form-group row">
          {{ html()->label('<strong>Prefferred Contect Method</strong>')->class('col-md-12 form-control-label')->for('contact-method') }}
          <div class="col-md-3">
            <div class="checkbox d-flex align-items-center">
            @if(!empty($buyer->id))
              @php $is_checked = $buyer->contact_email @endphp
            @else
              @php $is_checked = 1 @endphp
            @endif
              {{ html()->label(
                html()->checkbox('contact_email', $is_checked, $is_checked)
                ->class('switch-input pref_contact')
                ->id('contact_email')
                . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                ->class('switch switch-label switch-pill switch-success mr-2')
                ->for('contact_email') 
              }}
              {{ html()->label('EMAIL')->for('contacts_email')->class('flex-1') }}
            </div>
          </div>
          <div class="col-md-3">
            <div class="checkbox d-flex align-items-center">
              @if(!empty($buyer->id))
                @php $is_checked = $buyer->contact_sms @endphp
              @else
                @php $is_checked = 1 @endphp
              @endif
              {{ html()->label(
                html()->checkbox('contact_sms', $is_checked, $is_checked)
                ->class('switch-input pref_contact')
                ->id('contact_sms')
                . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                ->class('switch switch-label switch-pill switch-success mr-2')
                ->for('contact_sms') 
              }}
              {{ html()->label('SMS')->for('contacts_sms')->class('flex-1') }}
            </div>
          </div>
          <div class="col-md-3">
            <div class="checkbox d-flex align-items-center">
              @if(!empty($buyer->id))
                @php $is_checked = $buyer->contact_whatsapp @endphp
              @else
                @php $is_checked = 1 @endphp
              @endif
              {{ html()->label(
                html()->checkbox('contact_whatsapp', $is_checked, $is_checked)
                ->class('switch-input pref_contact')
                ->id('contact_whatsapp')
                . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                ->class('switch switch-label switch-pill switch-success mr-2')
                ->for('contact_whatsapp') 
              }}
              {{ html()->label('WHATS APP')->for('contacts_whatsapp')->class('flex-1') }}
            </div>
          </div>
        </div>

        <div class="form-group row">
          {{ html()->label('<strong>Buyer 1 Contact Info</strong>')->class('col-md-12 form-control-label')->for('name') }}

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  {{ html()->label('Phone <small><i>(with county code)</i></small> <span style="color:red">*</span>')->class('form-control-label')->for('phone') }}
                  {{ html()->number('phone')
                  ->class('form-control')
                  ->value(@$buyer->phone)
                  ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
                  ->attribute('maxlength', 191)
                }}
                <div class="invalid-feedback"></div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                {{ html()->label('Name')->class('form-control-label')->for('name') }}
                {{ html()->text('name')
                ->class('form-control')
                ->value(@$buyer->name)
                ->placeholder('Name')
                ->attribute('maxlength', 191)
              }}
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('E-mail Address <span style="color:red">*</span>')->class('form-control-label')->for('email') }}
              {{ html()->email('email')
              ->class('form-control')
              ->value(@$buyer->email)
              ->placeholder(__('validation.attributes.backend.access.users.email'))
              ->attribute('maxlength', 191)
            }}
            <div class="invalid-feedback"></div>
          </div>
        </div>

      </div>
    </div><!--col-->
  </div><!--form-group-->
  <!--Seller 1-->
  @php
  $buyer2_contact = json_decode(@$buyer->buyer2_contact);
  $transport_contact = json_decode(@$buyer->transport_contact);
  $accounts_contact = json_decode(@$buyer->accounts_contact);
  @endphp

  <div class="form-group row">
    {{ html()->label('<strong>Buyer 2 Contact Info </strong>')->class('col-md-12 form-control-label')->for('seller2_contact_phone') }}

    <div class="col-md-12">
      <div class="row">


        <div class="col-md-3">
          <div class="form-group">
            {{ html()->label('Phone <small><i>(with county code)</i></small>')->class('form-control-label')->for('seller2_contact_phone') }}
            {{ html()->text('buyer2_contact[phone]')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
            ->attribute('maxlength', 191)
            ->attribute('id', 'buyer2_contact_phone')
            ->value(@$buyer2_contact->phone)
          }}
           <div class="invalid-feedback"></div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Name')->class('form-control-label')->for('seller2_contact_name') }}
          {{ html()->text('buyer2_contact[name]')
          ->class('form-control')
          ->placeholder('Name')
          ->attribute('maxlength', 191)
          ->value(@$buyer2_contact->name)
        }}
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        {{ html()->label('E-mail Address')->class('form-control-label')->for('seller2_contact_email') }}
        {{ html()->email('buyer2_contact[email]')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.users.email'))
        ->attribute('maxlength', 191)
        ->value(@$buyer2_contact->email)
      }}
    </div>
  </div>

</div>
</div><!--col-->
</div><!--form-group-->
<!--Transport-->
<div class="form-group row">
  {{ html()->label('<strong>Transport Contact Info</strong>')->class('col-md-12 form-control-label')->for('transport_contact_phone') }}

  <div class="col-md-12">
    <div class="row">


      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Phone <small><i>(with county code)</i></small>')->class('form-control-label')->for('transport_contact_phone') }}
          {{ html()->text('transport_contact[phone]')
          ->class('form-control')
          ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
          ->attribute('maxlength', 191)
          ->attribute('id', 'transport_contact_phone')
          ->value(@$transport_contact->phone)
        }}
        <div class="invalid-feedback"></div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        {{ html()->label('Name')->class('form-control-label')->for('transport_contact_name') }}
        {{ html()->text('transport_contact[name]')
        ->class('form-control')
        ->placeholder('Name')
        ->attribute('maxlength', 191)
        ->value(@$transport_contact->name)
      }}
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      {{ html()->label('E-mail Address')->class('form-control-label')->for('transport_contact_email') }}
      {{ html()->email('transport_contact[email]')
      ->class('form-control')
      ->placeholder(__('validation.attributes.backend.access.users.email'))
      ->attribute('maxlength', 191)
      ->value(@$transport_contact->email)
    }}
  </div>
</div>

</div>
</div><!--col-->
</div>
<!--Accounts-->
<div class="form-group row">
  {{ html()->label('<strong>Accounts Contact Info</strong>')->class('col-md-12 form-control-label')->for('accounts_contact_phone') }}

  <div class="col-md-12">
    <div class="row">


      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Phone <small><i>(with county code)</i></small>')->class('form-control-label')->for('accounts_contact_phone') }}
          {{ html()->text('accounts_contact[phone]')
          ->class('form-control')
          ->placeholder(__('validation.attributes.backend.access.users.phone_placeholder'))
          ->attribute('maxlength', 191)
          ->attribute('id', 'accounts_contact_phone')
          ->value(@$accounts_contact->phone)
        }}
        <div class="invalid-feedback"></div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        {{ html()->label('Name')->class('form-control-label')->for('accounts_contact_name') }}
        {{ html()->text('accounts_contact[name]')
        ->class('form-control')
        ->placeholder('Name')
        ->attribute('maxlength', 191)
        ->value(@$accounts_contact->name)
      }}
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      {{ html()->label('E-mail Address')->class('form-control-label')->for('accounts_contact_email') }}
      {{ html()->email('accounts_contact[email]')
      ->class('form-control')
      ->placeholder(__('validation.attributes.backend.access.users.email'))
      ->attribute('maxlength', 191)
      ->value(@$accounts_contact->email)
    }}
  </div>
</div>

</div>
</div><!--col-->
</div>

<div class="form-group row">
  {{ html()->label('<strong>Company</strong>')->class('col-md-12 form-control-label')->for('company_name') }}
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Name')->class('form-control-label')->for('email') }}
          {{ html()->text('company')->value(@$buyer->company)->class('form-control')->placeholder('Company Name')->attribute('maxlength', 191) }}
        </div>
      </div><!--col-->
      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('VAT')->class('form-control-label')->for('vat') }}
          {{ html()->text('vat')->value(@$buyer->vat)->class('form-control')->placeholder('Company VAT')->attribute('maxlength', 191) }}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Trust Level')->class('form-control-label')->for('trust_level') }}
            <select name="trust_level" class="select2 form-control" data-placeholder="Trust Level" >
               <option></option>
            @foreach(trustlevel_list() as $key => $value)
               @php 
               $tmp = explode('@',$value->desc);
               $label = $value->name.' - '. @$tmp[0] @endphp
               <option value="{{$value->id}}" @if($value->id==@$buyer->trust_level) selected @endif>{{$label}}</option>
            @endforeach

            </select>
        </div>
      </div><!--col-->
    </div><!--form-group-->
  </div>
</div>

<div class="form-group row">
  {{ html()->label('<strong>Company Address</strong>')->class('col-md-12 form-control-label')->for('company_name') }}
  <div class="col-md-12">
    <div class="row">

      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
          {{ html()->text('city')->value(@$buyer->city)->class('form-control')->placeholder('City')->attribute('maxlength', 191) }}
          <div class="invalid-feedback"></div>
        </div>
      </div><!--col-->

      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
          {{ html()->text('postalcode')->value(@$buyer->postalcode)->class('form-control')->placeholder('Postal Code')->attribute('maxlength', 191) }}
          <div class="invalid-feedback"></div>
        </div>
      </div><!--col-->

      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Street Address')->class('form-control-label')->for('address') }}
          {{ html()->text('address')->value(@$buyer->address)->class('form-control')->placeholder('Street Address')->attribute('maxlength', 191) }}
        </div>
      </div><!--col-->

      <div class="col-md-3">
        <div class="form-group">
          {{ html()->label('Country')->class('form-control-label')->for('country') }}
          {{ html()->select('country')
          ->class('select2 form-control')
          ->options(country_list())
          ->attribute('maxlength', 191)
          ->value(@$buyer->country ?? 'PL')
          ->attribute('onblur', 'changeRequered()')
        }}
      </div>
    </div><!--col-->

  </div><!--form-group-->
</div>
</div>

<div class="form-group row">
  {{ html()->label('<strong>Delivery Address Is Same ?</strong>')->class('col-md-12 form-control-label')->for('email') }}
  <div class="col-md-12">
    <div class="checkbox d-flex align-items-center">
      @php
      if(isset($buyer->delivery_same)){
        $is_checked = in_array($buyer->delivery_same, array('1'));
      }else{
        $is_checked = 1;
      }
      @endphp
      {{ html()->label(
        html()->checkbox('delivery_same', $is_checked, '1')
        ->class('switch-input')
        ->id('delivery_same')
        . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
        ->class('switch switch-label switch-pill switch-success mr-2')
        ->for('delivery_same') }}
      </div>
    </div>
  </div>

  <div class="form-group row">
    {{ html()->label('<strong>Delivery Address</strong>')->class('col-md-12 form-control-label')->for('delivery_address') }}
    <div id="delivery_address" class="col-md-12" style="padding-bottom:40px; position:relative">
      <div class="del-group form-group row">
        <div class="col-md-3">
          <div class="form-group">
            {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('delivery_address_0_city') }}

            <input class="form-control" type="text" placeholder="City"
            name="delivery_address[0][city]" id="delivery_address_0_city"
            data-pattern-name="delivery_address[++][city]"
            data-pattern-id="delivery_address_++_city" />
            <div class="invalid-feedback"></div>
          </div>
        </div><!--col-->

        <div class="col-md-2">
          <div class="form-group">
            {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('delivery_address_0_postalcode') }}
            <input class="form-control" type="text" placeholder="Postal Code"
            name="delivery_address[0][postalcode]" id="delivery_address_0_postalcode"
            data-pattern-name="delivery_address[++][postalcode]"
            data-pattern-id="delivery_address_++_postalcode" />
            <div class="invalid-feedback"></div>
          </div>
        </div><!--col-->

        <div class="col-md-3">
          <div class="form-group">
            {{ html()->label('Street Address')->class('form-control-label')->for('delivery_address_0_address') }}
            <input class="form-control" type="text" placeholder="Street Address"
            name="delivery_address[0][address]" id="delivery_address_0_address"
            data-pattern-name="delivery_address[++][address]"
            data-pattern-id="delivery_address_++_address" />
          </div>
        </div><!--col-->

        <div class="col-md-2">
          <div class="form-group">
            {{ html()->label('Country')->class('form-control-label')->for('delivery_address_0_country') }}
            {{ html()->select('delivery_address[0][country]')
            ->class('select2 form-control')
            ->options(country_list())
            ->attribute('maxlength', 191)
            ->attribute('id', 'delivery_address_0_country')
            ->attribute('data-pattern-id', 'delivery_address_++_country')
            ->attribute('data-pattern-name', 'delivery_address[++][country]')
            ->value('PL')
          }}
          </div>
        </div><!--col-->

        <div class="col-md-2">
          <label class="form-control-label d-block">&nbsp;</label>
          <button type="button" class="del-btnRemove btn btn-danger btn-md">Remove -</button>
        </div>
      </div>

      <button style="position:absolute; bottom:0px; left:15px;" type="button" class="del-btnAdd btn btn-success btn-md">Add +</button>
    </div>
  </div>

  <div class="form-group row">
    {{ html()->label('<strong>Credit Limit in PLN</strong>')->class('col-md-2 form-control-label')->for('credit_limit') }}
    <div class="col-xl-2 col-md-4">
      <input type="number" name="credit_limit" id="credit_limit" value="{{$buyer->credit_limit ?? 0 }}" data-decimals="2" min="0" step="5000"/>
    </div><!--col-->
  </div><!--form-group-->

  <!--form-group-->
  <div class="form-group row">
      {{ html()->label('<strong>Number of Trucks Loads Desired Per Week</strong>')->class('col-md-2 form-control-label')->for('truck_quantity') }}
      <div class="col-md-2 col-sm-6">
        {{ html()->text('truck_quantity')
        ->class('form-control')
        ->attribute('maxlength', 191)
        ->value(@$buyer->truck_quantity)
         }}
      </div><!--col-->
    </div>

    <hr class="mb-4">

    <div class="form-group row">
        <div class="col-md-12">
          <button style="bottom:0px; left:15px;" type="button" class="pro-btnAdd btn btn-success btn-md">Add +</button>
        </div>
    </div>
      @php $tab_key = 1; @endphp
      @php $tab_key_heading = $tab_key_heading2 = 1; @endphp
    <div id="product_prefs_box2">       
        <div id="products_specs">
            <div class="row">
                <div class="col-md-12" id="tabs">
                    <ul class="nav nav-tabs ui-sortable tabbarmenu ">
                        @if(isset($productPrefRel))
                        @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                            <li class="nav-item "><a class="nav-link {{ ($tab_key_heading ==1)?'active':'' }}" href="#pref{{ $tab_key_heading }}" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref #{{ $tab_key_heading }}</a></li>
                        @php $tab_key_heading++; @endphp   
                        @endforeach 
                        @else
                           <!--  <li class="nav-item "><a class="nav-link active" href="#pref1" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">Pref #1</a></li> -->
                        @endif
                    </ul>
                    <div class="tab-content tabbar">
                    @if(isset($productPrefRel))
                        @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                        <div id="pref{{ $tab_key_heading2 }}" class="tab-pane {{ ($tab_key_heading2 ==1)?'active':'' }} product-group">
                       <div class="form-group row">
                             {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".$tab_key_heading2."][product_name]") }}
                            <div class="col-md-10">
                            {{ html()->select("old_product[".$SPkey."][product_name]")->id("product_".$tab_key_heading2."_product_name")
                              ->class('select2 form-control products-details')
                              ->options($products)
                              ->value(@$productProdRel[$SPkey])
                              ->attribute('data-pref-id', $SPkey)
                              ->placeholder('Choose Product')
                            }}
                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="product-nets">
                                    @include('backend.products.stock-product-multi-pref', ['productSpecRel' => $productSpecRel,'pref_id' => $SPkey])
                                </div>
                                @if(!empty($productSpecRel))
                                
                              @foreach($productSpecRel as $pKey=>$productSpec)
                              @if(isset($productSpec['field_type']) && $productSpec['field_type'] == 'optionrange' )
                              <div class="form-group row">
                            {{ html()->label('<strong>Size ranges</strong>')->class('col-md-12 form-control-label')->for('size_ranges') }}
                            <div id="size_ranges" class="col-md-12" style="padding-bottom:40px; position:relative">
                              <div class="r-group form-group row">
                                <div class="col-md-3">
                                  <label class="form-control-label">Min</label>
                                  <input class="form-control" type="text" value="{{@$stock->size_from ?? '45'}}" placeholder="From" name="size_range[{{ $pKey }}][size_from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />
                                </div>
                                <div class="col-md-3">
                                  <label class="form-control-label">Max</label>
                                  <input class="form-control" type="text" value="{{@$stock->size_to ?? '65'}}" placeholder="to" name="size_range[{{ $pKey }}][size_to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />
                                </div>
                                <div class="col-md-3">
                                  <label class="form-control-label">Premium</label>
                                  <input class="form-control" type="number" name="size_range[0][premium]" id="size_range_0_premium" data-pattern-name="size_range[++][premium]" data-pattern-id="size_range_++_premium" value="0" data-decimals="0" min="-10" max="10" step="1"/>
                                </div>
                                <div class="col-md-3">
                                  <label class="form-control-label d-block">&nbsp;</label>
                                  <button type="button" class="r-btnRemove btn btn-danger btn-md">Remove -</button>
                                </div>
                              </div>
                              <button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd btn btn-success btn-md">Add +</button>
                            </div>
                          </div>
                              
                              <!--form-group-->
                              @endif
                              @endforeach
                              @endif
                            </div>
                        </div>
                        @php $tab_key = $SPkey; $tab_key++; $tab_key_heading2++; @endphp
                        @endforeach 
                    @else
                        <!-- <div id="pref1" class="tab-pane active product-group">
                     <div class="form-group row">
                             {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".$tab_key."][product_name]") }}
                            <div class="col-md-10">
                            {{ html()->select("product[".$tab_key."][product_name]")->id("product_".$tab_key."_product_name")
                              ->class('select2 form-control products-details')
                              ->options($products)
                              ->value(@$buyer->product->id)
                              ->attribute('data-pref-id', $tab_key)
                              ->placeholder('Choose Product')
                            }}
                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="product-nets"></div>
                            </div>
                        </div> -->
                        @php $tab_key++; @endphp
                        @php $tab_key_heading++; @endphp   
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



<!--form-group-->
<div class="form-group row">

  {{ html()->label('<strong>Size ranges</strong>')->class('col-md-12 form-control-label')->for('size_ranges') }}

  <div id="size_ranges" class="col-md-12" style="padding-bottom:40px; position:relative">

    <div class="r-group form-group row">

      <div class="col-md-3">

        <label class="form-control-label">Min</label>

        <input class="form-control" type="text" value="40" placeholder="From" name="size_range[0][from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />

      </div>

      <div class="col-md-3">

        <label class="form-control-label">Max</label>

        <input class="form-control" type="text" value="80" placeholder="to" name="size_range[0][to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />

      </div>

      <div class="col-md-3">

        <label class="form-control-label">Premium</label>

        <input class="form-control" type="number" name="size_range[0][premium]" id="size_range_0_premium" data-pattern-name="size_range[++][premium]" data-pattern-id="size_range_++_premium" value="0" data-decimals="0" min="-10" max="10" step="1"/>

      </div>

      <div class="col-md-3">

        <label class="form-control-label d-block">&nbsp;</label>

        <button type="button" class="r-btnRemove btn btn-danger btn-md">Remove -</button>

      </div>

    </div>

    <button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd btn btn-success btn-md">Add +</button>

  </div>

</div>



<div class="form-group row">
  {{ html()->label('<strong>Payment Preference</strong>')->class('col-md-12 form-control-label')->for('payment_details') }}

   <div id="payment_details" class="col-md-12" style="padding-bottom:40px; position:relative">
  
   @if(isset($buyer->payment_details) && is_array($buyer->payment_details))
   @foreach(@$buyer->payment_details as $key=>$pd)
    <div class="p-group form-group row">
      
        <div class="col-md-3">
            {{ html()->label('Payment Type <span style="color:red">*</span>')->class('form-control-label')->for('payment_type') }}
          {{ html()->select("payment_details[".$key."][payment_type]")->id("payment_details_".$key."_payment_type")
          ->class('select2 form-control')
          ->options(payment_type_list())
          ->value($pd['payment_type'])->attributes(['data-pattern-name'=>"payment_details[++][payment_type]", 'data-pattern-id'=>"payment_details_++_payment_type"])
            }}
        </div><!--col-->
        <div class="col-md-3">
         
          {{ html()->label('Payment Terms')->class('form-control-label')->for('payment_terms') }}
          {{ html()->select("payment_details[".$key."][payment_terms]")->id("payment_details_".$key."_payment_terms")
          ->class('select2 form-control')
          ->options(payment_terms_list())
          ->value($pd['payment_terms'])->attributes(['data-pattern-name'=>"payment_details[++][payment_terms]", 'data-pattern-id'=>"payment_details_++_payment_terms"])
        }}
          
        </div>
        <div class="col-md-3">
         
          {{ html()->label('Currency')->class('form-control-label')->for('currency') }}
          {{ html()->select("payment_details[".$key."][currency]")->id("payment_details_".$key."_currency")
          ->class('select2 form-control')
          ->options(currency_list())
          ->attribute('maxlength', 191)
          ->value($pd['currency'])->attributes(['data-pattern-name'=>"payment_details[++][currency]", 'data-pattern-id'=>"payment_details_++_currency"])
        }}
         
        </div><!--col-->
        <div class="col-md-3">
        <label class="form-control-label d-block">&nbsp;</label>
        <button type="button" class="p-btnRemove btn btn-danger btn-md">Remove -</button>
         </div>
    </div>
   
    @endforeach 
    @else 
        
    @php $key = 0; @endphp
    <div class="p-group form-group row">
        <div class="col-md-3">
          {{ html()->label('Payment Type <span style="color:red">*</span>')->class('form-control-label')->for('payment_type') }}
         {{ html()->select("payment_details[".$key."][payment_type]")->id("payment_details_".$key."_payment_type")
          ->class('select2 form-control')
          ->options(payment_type_list())
          ->value()->attributes(['data-pattern-name'=>"payment_details[++][payment_type]", 'data-pattern-id'=>"payment_details_++_payment_type"])
            }}
        </div><!--col-->
        <div class="col-md-3">
          {{ html()->label('Payment Terms')->class('form-control-label')->for('payment_terms') }}
          {{ html()->select("payment_details[".$key."][payment_terms]")->id("payment_details_".$key."_payment_terms")
          ->class('select2 form-control')
          ->options(payment_terms_list())
          ->value()->attributes(['data-pattern-name'=>"payment_details[++][payment_terms]", 'data-pattern-id'=>"payment_details_++_payment_terms"])
        }}
        </div>
        <div class="col-md-3">
          {{ html()->label('Currency')->class('form-control-label')->for('currency') }}
          {{ html()->select("payment_details[".$key."][currency]")->id("payment_details_".$key."_currency")
          ->class('select2 form-control')
          ->options(currency_list())
          ->attribute('maxlength', 191)
          ->value()->attributes(['data-pattern-name'=>"payment_details[++][currency]", 'data-pattern-id'=>"payment_details_++_currency"])
        }}
        </div><!--col-->
        <div class="col-md-3">
        <label class="form-control-label d-block">&nbsp;</label>
        <button type="button" class="p-btnRemove btn btn-danger btn-md">Remove -</button>
        </div>
    </div>
   
    @endif
    
    <button style="position:absolute; bottom:0px; left:15px;" type="button" class="p-btnAdd btn btn-success btn-md">Add +</button>
    </div>
</div>



</div><!--col-->

</div><!--row-->
</div><!--card-body-->














<div class="card-footer clearfix">
  <div class="row">
    <div class="col">
      {{ form_cancel(route('admin.buyers.index'), __('buttons.general.cancel')) }}
    </div><!--col-->

    <div class="col text-right">
      @if(!empty($buyer->id))
      {{ form_submit(__('buttons.general.crud.update')) }}
      @else
      {{ form_submit(__('buttons.general.crud.create')) }}
      @endif
    </div><!--col-->
  </div><!--row-->
</div><!--card-footer-->
</div><!--card-->
{{ html()->form()->close() }}



<div class="modal fade" id="createPrefModal" role="dialog">
    <div class="modal-dialog" style="min-width:800px;">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px;">
                <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title">Add Pref</span> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
            </div>
            <div class="modal-body" style="padding:15px;">
                <div id="product_prefs_box2">
                    <div id="products_specs">
                        <div class="row">
                            <div class="col-md-12" id="tabs">
                                <form id="prefadd" method="get" role="form">
                                    <div class="tab-content">
                                    @if(isset($productPrefRel))
                                    @foreach(@$productPrefRel as $SPkey=>$productSpecRel)
                                    <div id="pref{{ $tab_key_heading2 }}" class="tab-pane {{ ($tab_key_heading2 ==1)?'active':'' }} product-group">
                                        <div class="form-group row">
                                            {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[".$tab_key_heading2."][product_name]") }}
                                            <div class="col-md-10">
                                            {{ html()->select("old_product[".$SPkey."][product_name]")->id("product_".$tab_key_heading2."_product_name")
                                            ->class('select2 form-control products-details')
                                            ->options($products)
                                            ->value(@$productProdRel[$SPkey])
                                            ->attribute('data-pref-id', $SPkey)
                                            ->placeholder('Choose Product')
                                            }}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="product-nets">
                                                @include('backend.products.stock-product-multi-pref', ['productSpecRel' => $productSpecRel,'pref_id' => $SPkey])
                                            </div>
                                            @if(!empty($productSpecRel))
                                                @foreach($productSpecRel as $pKey=>$productSpec)
                                                    @if(isset($productSpec['field_type']) && $productSpec['field_type'] == 'optionrange' )
                                                        <div class="form-group row">
                                                        {{ html()->label('<strong>Size ranges</strong>')->class('col-md-12 form-control-label')->for('size_ranges') }}
                                                        <div id="size_ranges" class="col-md-12" style="padding-bottom:40px; position:relative">
                                                        <div class="r-group form-group row">
                                                        <div class="col-md-3">
                                                        <label class="form-control-label">Min</label>
                                                        <input class="form-control" type="text" value="{{@$stock->size_from ?? '45'}}" placeholder="From" name="size_range[{{ $pKey }}][size_from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />
                                                        </div>
                                                        <div class="col-md-3">
                                                        <label class="form-control-label">Max</label>
                                                        <input class="form-control" type="text" value="{{@$stock->size_to ?? '65'}}" placeholder="to" name="size_range[{{ $pKey }}][size_to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />
                                                        </div>
                                                        <div class="col-md-3">
                                                        <label class="form-control-label">Premium</label>
                                                        <input class="form-control" type="number" name="size_range[0][premium]" id="size_range_0_premium" data-pattern-name="size_range[++][premium]" data-pattern-id="size_range_++_premium" value="0" data-decimals="0" min="-10" max="10" step="1"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <label class="form-control-label d-block">&nbsp;</label>
                                                        <button type="button" class="r-btnRemove btn btn-danger btn-md">Remove -</button>
                                                        </div>
                                                        </div>
                                                        <button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd btn btn-success btn-md">Add +</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    </div>
                                    @php $tab_key = $SPkey; $tab_key++; $tab_key_heading2++; @endphp
                                    @endforeach 
                                    @else
                                    <div id="pref1" class="tab-pane active product-group">
                                        <div class="form-group row">
                                            {{ html()->label('<strong>Product</strong>')->class('col-md-2 form-control-label')->for("product[1][product_name]") }}
                                            <div class="col-md-10">
                                            {{ html()->select("product[1][product_name]")->id("product_1_product_name")
                                            ->class('select2 form-control products-details')
                                            ->options($products)
                                            ->value(@$buyer->product->id)
                                            ->attribute('data-pref-id', $tab_key)
                                            ->placeholder('Choose Product')
                                            }}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="product-nets"></div>
                                        </div>
                                    </div>
                                    @php $tab_key++; @endphp
                                    @php $tab_key_heading++; @endphp   
                                    @endif
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <button type="button" id="CancelProductSpecification" class="btn btn-danger btn-sm">
                                                Cancel
                                            </button> 
                                            <button type="button" id="AddProductSpecification" class="btn btn-success pull-right btn-sm">
                                                Done
                                            </button>                                        
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@if(!empty($buyer->id))
  @php 
    $url =  route('admin.buyers.update', $buyer->id);
    $buyerid = $buyer->id;
  @endphp
@else
  @php 
    $url =  route('admin.buyers.store');
    $buyerid = 0;
  @endphp
@endif
@endsection
@push('after-styles')
<style type="text/css">
   <?php foreach(trustlevel_list() as $key=>$value){ 
      $tmp = explode('@',$value->desc);
      ?>
      ul[id^="select2-trust_level"] li:nth-child(<?php echo $key+1 ?>){
         background-color: <?php echo strtolower(trim(@$tmp[1])) ?>!important;
      }
   <?php } ?>
   .showmore-invalid {border:2px solid #dc3545;}
</style>
@endpush

@push('after-scripts')
<link rel="stylesheet" href="{{ asset('css/bootstrap-dynamic-tabs.css') }}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap-dynamic-tabs.js') }}"></script>

@php $countryNameList = country_list(); @endphp
<script type="text/javascript">
    let tabNumber =0;
    let productNameList = JSON.parse('@json($products)');    
    let countryNameList = JSON.parse('@json($countryNameList)');    
    console.log(countryNameList);
    $(document).on('click','#CancelProductSpecification',function(){
        $("#createPrefModal").modal("hide");
    });
    $(document).on('click','#AddProductSpecification',function() {
        let tableContent = "";
        let product_name = productNameList[$("#product_1_product_name").val()];
        $(".tabbarmenu .nav-item a").removeClass("active");
        $(".tabbar div").removeClass("active");
        $(".tabbarmenu").append(`<li class="nav-item ">
        <a class="nav-link active" href="#preft${tabNumber}" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">
        Pref #${tabNumber}
        </a>
        </li>`);   
        $("#createPrefModal").modal("hide");    
        tableContent +=`<div id="preft${tabNumber}" class="tab-pane active product-group"><table id="table${tabNumber}" class='table display responsive nowrap table-bordered data-table'>`;
        let form = $("#prefadd").serializeArray();   
        let columnList = [];       
        tableContent +=`<tr>`;
        for (let i = 0; i < form.length; i++) {
            let name = form[i].name.substr(0,form[i].name.indexOf("[")).replace(/_/g, " ");
            if(!(name=="specification" || name=="premium")){
                columnList.push({"sTitle": name,"sWidth" : "33%"});
                if(name=="product") {
                    tableContent +=`<td>${product_name}`;
                }
                else if(name=="delivery country"){
                    tableContent +=`<td>${countryNameList[form[i].value]}`;
                }
                else {
                    tableContent +=`<td>${form[i].value}`;   
                }
                tableContent +=`<input type='hidden' name='${form[i].name}' value='${form[i].value}' /></td>`; 
            }
            else{    
                tableContent +=`<input type='hidden' name='${form[i].name}' value='${form[i].value}' />`;    
            }

        }
        tableContent +=`</tr></div>`;
        $(".tabbar").append(tableContent);
        $('#table'+tabNumber).DataTable( {
            responsive: true,
            searching: false,
            paging: false,
            bInfo: false,
            aoColumns : columnList
        });
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $($.fn.dataTable.tables( true ) ).css('width', '100%');
            $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();
        }); 
    });
    var tabn = {{$tab_key}};
    var tab_key_heading = {{$tab_key_heading}};
    var tabs = $('#tabs').bootstrapDynamicTabs();
    $("body").on('click','.remove-this-tab',function(){
        $(this).parent().remove();
        content_id = $(this).parent().attr('data-content-id');
        $('.tab-content').find('#pref'+content_id).remove();
        $('.nav-tabs a:first').tab('show');
    });
    $('body').on('DOMNodeInserted', 'select', function () {
        $(this).select2();
    }); 
    var products = JSON.parse('@json($products)');
    var selectOpt = '<option value="" selected="selected">Choose Product</option>';
    $.each(products,function(key,value){
        selectOpt += '<option value="'+key+'">'+value+'</option>'
    });

   
$(".pro-btnAdd").click(function(){
    $("#prefadd")[0].reset();
    $(".select2").val('').trigger('change')
    $(".product-nets").html("");
    $("#createPrefModal").modal("show");
    tabNumber++;
    $("#product_1_product_name").attr("name","product["+tabNumber+"][product_name]");
    $("#product_1_product_name").attr("data-pref-id",tabNumber);  
    tabn++;
    tab_key_heading++;
});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#tabs .showmore-invalid').popover('enable').popover('hide').popover('disable');    
    });

    $('button[type="submit"]').on('click',function(){
        $('#tabs .showmore-invalid').popover('enable').popover('hide').popover('disable');
        $('#tabs .showmore-invalid').removeClass('showmore-invalid');
        $('#tabs .nav.nav-tabs.ui-sortable .nav-link').popover('enable').popover('hide').popover('disable');  
        var activetab_focusid='';
        var inactivetab_focusid='';
        $('.more select').each(function(index){
            if(!$(this)[0].checkValidity()){
                let invalid_id = $(this).closest('.tab-pane').attr('id');            
                inactivetab_focusid = $('#tabs .nav.nav-tabs a[href="#'+invalid_id+'"]');
                $('#tabs .nav.nav-tabs a[href="#'+invalid_id+'"]').popover('enable').popover('show').popover('disable').focus();
                let target = $('a[data-toggle="tab"].active').attr("href") // activated tab
                $('#tabs .nav.nav-tabs a[href="'+target+'"]').popover('hide');
                if('#'+invalid_id == target) {            
                    activetab_focusid = $(target+' .showmore');              
                }
            }
        });

        if(activetab_focusid instanceof jQuery){ 
            activetab_focusid.addClass('showmore-invalid').focus();
            activetab_focusid.popover('enable').popover('show').popover('disable');
        }else if(inactivetab_focusid instanceof jQuery){
            inactivetab_focusid.focus();
        }
    });
    $('#formsubmit').on('submit', function(event) {
        event.preventDefault();
        let buyerid = {{ $buyerid }};
        let formData = new FormData(this);
        $( ".pref_contact" ).each(function( key, value ) {
            if(value.value == 0)
                formData.append(value.name, value.value);            
        });      
        if(buyerid != 0) {
            formData.append('_method', 'PUT');
        }
      $.ajax({
        url: "{{ $url }}",
        method: 'POST',
        data: formData,
        contentType: false,             
        cache: false,
        processData: false,
        dataType: "json",
        beforeSend: function(){
            $('.loading').removeClass('loading_hide');
        },
        success: function(data)
        {         
          $('.loading').addClass('loading_hide');
          if(data.status == 'success'){
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
              window.location.href = "{{ route('admin.buyers.index') }}"; 
            }, 2000);
          }
          if(data.status == 'error'){
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
          }
        },
        error :function( data ) {
          $('.loading').addClass('loading_hide');
          if( data.status === 422 ) {
            Swal.fire('Error!', data.responseJSON.message, 'error');
            $('.btn-success').removeAttr('disabled');
            var errors = [];
            errors = data.responseJSON.errors
            $.each(errors, function (key, value) {
                console.log(key);
                var n = key.search(".");
                var res = key.split(".");
                if(res.length > 1){
                    key = res[0]+"_"+res[1];
                }
                $('#'+key).parent().addClass('has-danger');
                $('#'+key).addClass('is-invalid');
                $('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
            })
          }
        }
      });
    });
$(function() {
  if($("#size_ranges").length>0){
   $('#size_ranges').repeater({
     btnAddClass: 'r-btnAdd',
     btnRemoveClass: 'r-btnRemove',
     groupClass: 'r-group',
     minItems: 0,
     maxItems: 0,
     startingIndex: 0,
     showMinItemsOnLoad: true,
     reindexOnDelete: true,
     repeatMode: 'append',
     animation: null,
     animationSpeed: 400,
     animationEasing: 'swing',
     clearValues: true,
     afterAdd: function($doppleganger) {
         $('#size_ranges').find('input[type="number"]').nextAll('div[class^="input-group"]').remove();
         $('#size_ranges input[type="number"]').inputSpinner();
     },
   }, [
     @if(isset($buyer->size_range))
     @foreach(json_decode($buyer->size_range) as $key => $val)
       {"size_range[{{$key}}][from]":"{{isset($val->from)?$val->from:''}}", "size_range[{{$key}}][to]":"{{isset($val->to)?$val->to:''}}", "size_range[{{$key}}][premium]":"{{isset($val->premium)?$val->premium:''}}"},
     @endforeach
     @endif
   ]);
  }
});


  $('body').on('change', '.products-details', function(){
    $('.loading').removeClass('loading_hide');
    var val = $(this).val();    
    console.log($(this).parents('.product-group').find('.product-nets'));
    if(val == '' || val == 'undefined')
    {
        $('.loading').addClass('loading_hide');
        return false;
    }
    var pref_id = $(this).attr('data-pref-id');
   
    var ths = $(this);
    $(this).attr('data-pref-id', pref_id);
    $.ajax({
        type: "POST",
        url: "{{ route('admin.trading.getproductmulitple') }}",
        data: {pid:val, pref_id:pref_id},
        success: function (data) {
            ths.parents('.product-group').find('.product-nets').html(data);
            ths.parents('.product-group').find(".product-nets input[type='number']").inputSpinner();
            $( ".checkbox.switch-box .switch input" ).each(function( index,element ) {
                switchPremium(element.id);
            });
            $('.select2').select2();
            $('.loading').addClass('loading_hide');

          return false;
        }
    });
  });

$('#payment_details').repeater({
  btnAddClass: 'p-btnAdd',
  btnRemoveClass: 'p-btnRemove',
  groupClass: 'p-group',
  minItems: 1,
  maxItems: 0,
  startingIndex: 0,
  showMinItemsOnLoad: true,
  reindexOnDelete: true,
  repeatMode: 'append',
  animation: null,
  animationSpeed: 400,
  animationEasing: 'swing',
  clearValues: true,
  beforeAdd: function($doppleganger) {
    return $doppleganger;
  },
  afterAdd: function($elem) {
    //$elem.val() = '';
  },
  beforeDelete: function($elem) {},
  afterDelete: function() {}
});

$('#delivery_address').repeater({
  btnAddClass: 'del-btnAdd',
  btnRemoveClass: 'del-btnRemove',
  groupClass: 'del-group',
  minItems: 1,
  maxItems: 0,
  startingIndex: 0,
  showMinItemsOnLoad: true,
  reindexOnDelete: true,
  repeatMode: 'append',
  animation: null,
  animationSpeed: 400,
  animationEasing: 'swing',
  clearValues: false
});

$(function() {
  delivery_same();
  product_prefs();
  changeRequered();
  Purpose_Check();
  //select_all_soil();
  light_same();
});

$('.switch').click(function() {
  delivery_same();
  product_prefs();
  //select_all_soil();
  light_same();
  //var id = $(this).children('input').attr('id');
  switchPremium($(this).children('input').attr('id'));
});

$("#dry_matter_content_to, #soil, #size_range_0_to").on('keydown keyup keypress blur', function(){
  Purpose_Check();
  light_same();
});

$('#country').on('select2:select', function (e) {
  changeRequered();
});
function changeRequered(){
  var val = $('#country').val();
  if(val === 'PL'){   
    $('#city').parent('.form-group').find('span').show();
    $('#postalcode').parent('.form-group').find('span').show();
    $('#phone').parent('.form-group').find('span').show();
    $('#email').prop('required',false);
    $('#email').parent('.form-group').find('span').hide();
    $('#username').parent('.form-group').parent().parent('.form-group').find('span').show();
  }else{
    $('#city').prop('required',false);
    $('#city').parent('.form-group').find('span').hide();
    $('#postalcode').prop('required',false);
    $('#postalcode').parent('.form-group').find('span').hide();
    $('#phone').prop('required',false);
    $('#phone').parent('.form-group').find('span').hide();
    $('#email').prop('required',false);
    $('#email').parent('.form-group').find('span').show();
    $('#username').prop('required',false);
    $('#username').parent('.form-group').parent().parent('.form-group').find('span').hide();    
}
}

function delivery_same(){
  var checkbox = $('input#delivery_same');
  if ($(checkbox).prop('checked')) {
    $("#delivery_address").parent().hide();
  } else {
    $("#delivery_address").parent().show();
  }
}

function select_all_soil(){
  var checkbox = $('input#any_soil');
  if($(checkbox).prop('checked')) {
    @foreach(soil_list() as $key => $soil)
    $('#{{ str_slug($soil, '_')}}').prop('checked', true).change();
    @endforeach
  }
}

function product_prefs(){
  var checkbox = $('input#product_prefs');
  if ($(checkbox).prop('checked')) {
    $("#product_prefs_box").show();
  } else {
    $("#product_prefs_box").hide();
  }
}

function Purpose_Check(){
  var dmc = $('#dry_matter_content_to').val();
  var soil = $('#soil').val();
  var size1 = $('#size_range_0_to').val();
  var size2 = $('#size_range_1_to').val();
  var size3 = $('#size_range_2_to').val();
  var size4 = $('#size_range_3_to').val();
  var size = Math.max(size1, size2, size3, size4);

  if(soil == '28' && size1 > 65){
    $('#Export').prop('checked', true).change();
  }else{
    $('#Export').prop('checked', false).change();
  }

  if(dmc > 22){
    $('#Peeling').prop('checked', false).change();
  }else{
    $('#Peeling').prop('checked', true).change();
  }
}


$( ".checkbox.switch-box .switch input" ).each(function( index,element ) {
  switchPremium(element.id);  
});


$('body').on('click','.switch',function() {
   switchPremium($(this).children('input').attr('id'));
});

function switchPremium(id){
  if ($('input#'+id).prop('checked')) {
    $('input#'+id).parent().parent().find('input[type=number]').prop('disabled', false);
    $('input#'+id).closest('.accept_all').parent().find('select[name^=specification]').removeAttr('required');
  } else {
    $('input#'+id).parent().parent().find('input[type=number]').prop('disabled', true);
    $('input#'+id).closest('.accept_all').parent().find('select[name^=specification]').attr('required',true);
  }
}

$("body").on("click",".any_type_selected",function(){
    dataGroup = $(this).attr('data-group');
    state = $(this).prop('checked');
    $(this).parents(".app-head-group-outer").find(".switch_select_sub_item").each(function(){
        if(state == true){
            $(this).find('input[type=number]').prop('disabled', false);
            $(this).find('input[type=checkbox]').prop('checked', true);
        } else {
            $(this).find('input[type=number]').prop('disabled', true);
            $(this).find('input[type=checkbox]').prop('checked', false);
        }
    });
});

$("body").on("click",".switch_select_sub_item_cb",function(){
    state = $(this).prop('checked');
    if(state == false){
        $(this).parents(".app-head-group-outer").find(".any_type_selected").prop('checked', false);
    }
});


function light_same(){
  var checkbox = $('input#light');
  var size_range_0_to =  $('#size_range_0_to').val();
  if ($(checkbox).prop('checked') && size_range_0_to > 65) {
      $('#export').prop('checked', true).change();
  } else {
    $('#export').prop('checked', false).change();
  }
}

$('body').on('click', '.pref_contact', function(){
  if(this.checked){
    $(this).val(1);
    $(this).attr('checked','checked');
  }else{
    $(this).val(0);
    $(this).removeAttr('checked');
  }
})

function showMorePref($this) {
  if($this.hasClass("showmore")){
    $this.text("Show less");
    $('.active .more').show();
    $this.removeClass("showmore");
    $this.addClass("showless");
  }else if($this.hasClass("showless")){
    $this.text("Show more");
    $('.active .more').hide();
    $this.removeClass("showless");
    $this.addClass("showmore");
  }
}
</script>
@endpush