<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use DataTables;
use GuzzleHttp\Client;
use Cache;

class VehicleController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:view vehicles', ['only' => ['index']]);
        $this->middleware('permission:add vehicles', ['only' => ['create','store']]);
        $this->middleware('permission:edit vehicles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete vehicles', ['only' => ['destroy']]);
    }

    public function index(Request $request){

        $vehicles_data = Cache::remember('vehicles_data', 30, function () {
            $client = new Client();
            $data = $client->get('https://cx.transportexchangegroup.com/cxshared/v1/vehicles?applicationType=HX&region=UK#live_availability');
            $vehicles = $data->getBody();
            $response = json_decode($data->getBody(), true);
            return $response;
        });

        if ($request->ajax()) {
          return Datatables::of($vehicles_data)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('backend.vehicles.index');
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Vehicle $vehicle){
        //
    }

    public function edit(Vehicle $vehicle){
        //
    }

    public function update(Request $request, Vehicle $vehicle){
        //
    }

    public function destroy(Vehicle $vehicle){
        //
    }

}
