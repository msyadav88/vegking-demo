<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Warehouse;
use DataTables;
use App\Exports\WarehouseExport;
use Maatwebsite\Excel\Facades\Excel;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $status = $request->show_matched;
           
            $data = Warehouse::with('stock','sale')->whereHas('stock', function($q) use($status){
            $q->where('load_status',  $status);
            })->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                     $btn = ' <div class="btn-group btn-group-sm">
                              </div>';
                      return $btn;
              })
              ->addColumn('flesh_color', function($row){
                return @$row->stock->flesh_color_detail->name;
              })
              ->addColumn('purposes', function($row){
                 $tmp = json_decode(@$row->stock->purposes,true);
                 $data = (is_array($tmp) ? implode(',',@$tmp) : '');
                return @$data;
              })
              ->addColumn('defect', function($row){
                $tmp = json_decode(@$row->stock->defect,true);
                $data = (is_array($tmp) ? implode(',',@$tmp) : '');
               return @$data;
             })
             ->addColumn('soil', function($row){
                $tmp = json_decode(@$row->stock->soil,true);
                $data = (is_array($tmp) ? implode(',',@$tmp) : '');
               return @$data;
             })
              ->addColumn('variety_name', function($row){
                return @$row->stock->variety_detail->name;
              })
              ->addColumn('country', function($row){
                    return (@$row->country?@$row->country:'-');
                })
                ->addColumn('city', function($row){
                    return (@$row->city?@$row->city:'-');
                })
                ->addColumn('postcode', function($row){
                    return (@$row->postcode?@$row->postcode:'-');
                })
                ->addColumn('tons', function($row){
                    return (@$row->tons?@$row->tons:'-');
                })
                ->addColumn('product', function($row){
                    return (@$row->product?@$row->product:'-');
                })
                ->addColumn('dateStored', function($row){
                    return (@$row->dateStored?@$row->dateStored:'-');
                })
                ->addColumn('notes', function($row){
                    return (@$row->notes?@$row->notes:'-');
                })
          ->rawColumns(['action'])
          ->make(true);
        }
        return view('backend.warehouse.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function warehouseexports() 
    {
        return Excel::download(new WarehouseExport, 'warehouse.xlsx');
    }
}
