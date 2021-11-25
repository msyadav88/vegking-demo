<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\CurrencyRate;
use DataTables;
use View;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CurrencyRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view currency rate', ['only' => ['index']]);
        $this->middleware('permission:add currency rate', ['only' => ['create','store']]);
        $this->middleware('permission:edit currency rate', ['only' => ['edit','update']]);
        $this->middleware('permission:delete currency rate', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
       if ($request->ajax()) {
            $data = CurrencyRate::get();
                return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.currencyrates.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                          <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                        </div>';
                $view = View::make('backend.includes.action_button', [ 'row' => $row,
                'edit_url' => route('admin.currencyrates.edit', $row->id),
                'edit_permission' => 'edit currency rate',
                'delete_permission' => 'delete currency rate',
                'delete_url' => '']);
                $btn = $view->render();
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('backend.currencyrates.index');
    }

    public function create(){
        return view('backend.currencyrates.create');
    }

    public function store(Request $request){
        $request->validate([
          'from' => 'required',
          'to' => 'required',
          'rate' => 'required',
        ]);
        if(isset($request->default)){
            $tableArray = $request->all();
        }else{
            $tableArray = array_merge($request->all(), ['default' => '0']);
        }
        $currencyrate = CurrencyRate::create($tableArray);
        // return response()->json(['status' => 'success', 'message' => 'Currency Rate created successfully.']);
      
        return response()->json(['status' => 'success', 'message' => 'Currency Rate created successfully.']);
    }

    public function show(CurrencyRate $currencyrate){
        //
    }

    public function edit($id){
        $currencyrate = CurrencyRate::where(['id' => $id])->first();
        if($currencyrate){
            return view('backend.currencyrates.create',compact('currencyrate'));
         }else{
          $msg="Unfortunately this Currency Rate is not exist!";
          return view('backend.currencyrates.index',compact('msg'));
         } 
      }
    public function update(Request $request, CurrencyRate $currencyrate){
        $request->validate([
          'from' => 'required',
          'to' => 'required',
          'rate' => 'required',
        ]);
         $tableArray = $request->all();
        $currencyrate->update($tableArray);
      
        return response()->json(['status' => 'success', 'message' => 'Currency Rate updated successfully.']);
    }

    public function destroy(CurrencyRate $currencyrate){
      $currencyrate->delete();
      return response()->json(['success'=>'Currency Rate deleted successfully.']);
    }

    public function currencyRate(){
        $client = new Client();
        $base_array= array('PLN','GBP','USD','EUR');
        // print_r($base_array); exit;
        foreach($base_array as $key => $base){
        
        $data = $client->get('https://api.exchangerate-api.com/v4/latest/'. $base );
       
        $response = json_decode($data->getBody(), true);
        // dd($response);
        if(isset($response['rates'])){
          foreach($response['rates'] as $key => $rate){
            $currency_rate = CurrencyRate::where('from',$base)->Where('to',$key)->count();
            $currency = CurrencyRate::where('from',$base)->Where('to',$key)->first();
            if($currency_rate){
              $currency->update(['from'=>$response['base'],'to'=>$key,'rate'=>round($rate,2)]);
            }
            // else{
            //   CurrencyRate::create(['from'=>$response['base'],'to'=>$key,'rate'=>round($rate,2)]);
            // }
          }
        }
      }
      return response()->json(["status"=>'success','message'=>'Currencies updated with latest currencies']);
    }


}
