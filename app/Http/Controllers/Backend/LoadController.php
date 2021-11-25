<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Load;
use DataTables;
use GuzzleHttp\Client;
use Cache;

class LoadController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:view loads', ['only' => ['index']]);
    }

    public function index(Request $request){

      $loads_data = Cache::remember('loads_data', 30, function () {
          $client = new Client();
          $data = $client->get('https://cx.transportexchangegroup.com/cxshared/v1/loads?applicationType=HX&region=UK#live_availability');
          $vehicles = $data->getBody();
          $response = json_decode($data->getBody(), true);
          return $response;
      });

      if ($request->ajax()) {
        return Datatables::of($loads_data)
          ->addIndexColumn()
          ->rawColumns(['action'])
          ->make(true);
      }
      return view('backend.loads.index');
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Load $load){
        //
    }

    public function edit(Load $load){
        //
    }

    public function update(Request $request, Load $load){
        //
    }

    public function destroy(Load $load){
        //
    }
}
