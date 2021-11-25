<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  Contact::orderBy('id','desc')->get();
            
            return Datatables::of($data)
            ->addIndexColumn()
            
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('company', function($row){
                return $row->company;
            })  
            ->addColumn('email', function($row){
                return $row->email;
            })  
            ->addColumn('phone', function($row){
                return $row->phone;
            })  
            ->addColumn('message', function($row){
                return $row->message;
            })  
            ->addColumn('created_at', function($row){
                return date("M-j-Y h:i:s A",strtotime($row->created_at));
            })  
            ->rawColumns(['id'])
            ->make(true);
        }
        return view('backend.contact.index');
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
}