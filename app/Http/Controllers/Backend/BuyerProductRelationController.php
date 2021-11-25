<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\BuyerProductRelation;
use App\Product;
use Illuminate\Http\Request;

class BuyerProductRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo "<pre/>"; print_r($request->all()); die;
        $specs = \App\ProductSpecification::with(['options' => function($query) {
                        $query->select(['id', 'product_specification_id', 'value']);
                    }])
                    ->select('product_id','id','display_name','parent_id')
                    //->whereNull('parent_id')
                    ->get()->toArray();
        $productSpecRel = [];
        
        foreach($specs as $spec){
            if($spec['parent_id'] == NULL){
                $productSpecRel[$spec['product_id']][$spec['id']]['name'] = $spec['display_name'];
            } else {
                $productSpecRel[$spec['product_id']][$spec['parent_id']]['childs'][$spec['id']]['name'] = $spec['display_name'];
            }
            foreach($spec['options'] as $option){
                if($spec['parent_id'] == NULL){
                    $productSpecRel[$spec['product_id']][$spec['id']]['values'][$option['id']] = $option['value'];
                }
            }
        }
        $products = Product::all()->where('status', '1')->pluck('name', 'id', 'image');
        //echo "<pre/>"; print_r($productSpecRel); die;
        $data = array('product_id'=> 1,'productSpecRel' => $productSpecRel,'products' => $products);
        return response()->view('backend.buyerproductrelation.create', $data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BuyerProductRelation  $buyerProductRelation
     * @return \Illuminate\Http\Response
     */
    public function show(BuyerProductRelation $buyerProductRelation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuyerProductRelation  $buyerProductRelation
     * @return \Illuminate\Http\Response
     */
    public function edit(BuyerProductRelation $buyerProductRelation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuyerProductRelation  $buyerProductRelation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuyerProductRelation $buyerProductRelation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuyerProductRelation  $buyerProductRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuyerProductRelation $buyerProductRelation)
    {
        //
    }
}
