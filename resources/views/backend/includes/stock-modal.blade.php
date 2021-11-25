<div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 10px;">
            <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body" style="padding:15px 10px;">
          <form role="form" class="form-inline" id="create_create_stock">
          	
            <div class="model-row row mb-2">
                <div class="col-md-4">
                    <label for="product_id" class=""><span class="glyphicon glyphicon-user"></span> Product </label>
                </div>
                <div class="col-md-8">
                    <select class="product model-row edit_product_id form-control" name="product_id" id="product_id" >
                        <option value="">Choose</option>
                        @foreach($products as $key=>$value)
                            <option value="{{@$value->id}}">{{@$value->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
			</div>

            <div class="model-row row mb-2">
               <div class="col-md-4"> <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Variety</label>
               </div>
               <div class="col-md-8">
              <select class="field1 model-row form-control">
                <option value="">Choose Variety</option>
             </select>
             </div>
			  <div class="invalid-feedback"></div>
		    </div>
            
            <div id="repeater">
                <div class="size-group model-row row mb-2">
                    <div class="col-md-4"> 
                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Size (mm)</label>
                    </div>
                    <div class="col-md-4 model-row">
                        <input name="size[0][from]" id="size_from" type="text" data-pattern-name="size[++][from]" data-pattern-id="size_range_++_from" class="form-control col-md-5 sizefrom"/>
                        <input type="text" name="size[0][to]" id="size_to" data-pattern-name="size[++][to]" data-pattern-id="size_range_++_to" class="sizeto col-md-5 form-control"/>
                    </div>
                    <button style="" type="button" class="del-btnAdd btn btn-success btn-md">Add +</button>
                    <!--- <div class="col-md-2">
                        <button type="button" class="del-btnRemove btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    --->
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            
            
            <div class="model-row row mb-2">
                <div class="col-md-4"> <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Quality</label>
                </div>
                <div class="col-md-8">
                <select class="field3 model-row form-control select2" multiple>
                    <option value="">Choose Variety</option>
                </select>
                </div>
                <div class="invalid-feedback"></div>
		    </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-4"> 
                <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Defects</label>
                </div>
                <div class="col-md-8">
                <select class="field4 model-row form-control select2" multiple>
                    <option value="">Choose Defects</option>
                </select>
                </div>
                <div class="invalid-feedback"></div>
		    </div>
            <div class="model-row add-nets-row vk_hide row mb-2">
                <div class="col-md-4"> 
                    <label class=""><span class="glyphicon glyphicon-eye-open"></span>Nets</label>
                </div>
                <div class="col-md-4">
                    <input type="text" id="additional-nets" data-defect-id="" data-defect-name="" class="col-md-12 form-control"/>
                </div>
                <div class="col-md-2">
                    <input type="button" class="btn btn-primary save_nets" value="Save"/>
                </div>
                <div class="col-md-2">
                    <button type="button" class="cancel_nets btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></button>
                </div>
		    </div>
            
            <div class="model-row row mb-2">
             <div class="col-md-4"> 
                <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Price</label>
                </div>
                <div class="col-md-8">
                <input name="price" id="price" type="text" class="price-field model-row price form-control">
                <div class="invalid-feedback"></div>   
            </div>
		    </div>

            <div class="model-row row mb-2">
             <div class="col-md-4"> 
                <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Price currency</label>
                </div>
                <div class="col-md-8">
                <input name="price_currency" id="price_currency" type="text" class="price-field model-row price form-control">
                <div class="invalid-feedback"></div>   
            </div>
		    </div>

            <div class="model-row row mb-2">
                 <div class="col-md-4"> 
                 <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Status</label>
                 </div>
                <div class="col-md-8 model-row">
                <select name="stock_status" class="status form-control">
                    <option value="unavailable">Unavailable</option>
                    <option selected value="available">Available</option>
                    <option value="upcoming_stock">Upcoming Stock</option>
                </select>
                </div>
                <div class="invalid-feedback"></div>
		    </div>
            
            <div class="model-row row mb-2 packing_group vk_hide">
                 <div class="col-md-4"> 
                 <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Packing</label>
                 </div>
                <div class="col-md-8 model-row packing_options">
                
                </div>
                <div class="invalid-feedback"></div>
		    </div>
            
            <div class="model-row row mb-2 cleaning_group vk_hide">
                 <div class="col-md-4"> 
                 <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Cleaning</label>
                 </div>
                <div class="col-md-8 model-row cleaning_options">
                
                </div>
                <div class="invalid-feedback"></div>
		    </div>
            
            <div class="model-row row mb-2 cleaning_group vk_hide">
                <div class="col-md-4"> 
                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Total Price:</label>
                </div>
                <div class="col-md-8 model-row total_price">
                    
                </div>
            </div>
            
            <button id="create_stock_model" type="button" class="btn btn-success btn-block">Create</button>
            </form>
        </div>
        </div>
    </div>
</div> 