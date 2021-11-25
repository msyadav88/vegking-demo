<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\AppHead;
use DataTables;
use Illuminate\Http\Request;

class AppHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
       if(isset($request->typename) && !empty($request->typename)){
         $data = AppHead::with('flesh_color')->with('product_id')->where('type', $_GET['typename'])->get();
       }else{
         $data = AppHead::with('flesh_color')->with('product_id')->get();
       }

       if ($request->ajax()) {
    			return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = ' <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.appheads.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                          <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                        </div>';
                return $btn;
            })
    				->addColumn('type', function($row){
                return ucwords(str_replace('_', ' ',$row->type));
            })
            ->addColumn('is_active', function($row){
               if ($row->is_active == '1') {
                return 'Active';
               }else{
                return 'Inactive';
               }
            })
            ->rawColumns(['action', 'type'])
            ->make(true);
      }
      return view('backend.heads.index');
    }

    public function reorder(Request $request){
        $count = 0;
        if (count($request->json()->all())) {
            $ids = $request->json()->all();
            foreach($ids as $i => $key){
                $id = $key['id'];
                $position = $key['position'];
                $mymodel = AppHead::find($id);
                $mymodel->order = $position;
                if($mymodel->save())
                {
                    $count++;
                }
            }
            $response = 'send response records updated goes here';
            return response()->json( $response );
        } else {
            $response = 'send nothing to sort response goes here';
            return response()->json( $response );
        }
    }

    public function create(){
        return view('backend.heads.create');
    }

    public function store(Request $request){
        $request->validate([
          'name' => 'required',
          'product_id' => 'required',
          'type' => 'required',
        ]);
        if(isset($request->default)){
            $tableArray = $request->all();
        }else{
            $tableArray = array_merge($request->all(), ['default' => '0']);
        }
        $tableArray['unique_hash'] =  md5($tableArray['name'].$tableArray['type']);
        if($request->image){
          $imageName = time().'.'.request()->image->getClientOriginalExtension();
          request()->image->move(public_path('images/stock'), $imageName);
        }
    		$json_fields = array('image');
        foreach($request->all() as $key=>$val){
          if (in_array($key, $json_fields)) {
    				$tableArray[$key] = $imageName;
    			}else{
    				$tableArray[$key]=$val;
    			}
        }
        if(isset($tableArray['enable_extra_supply_cost']) && $tableArray['enable_extra_supply_cost'] == 1){
            $tableArray['extra_supply_cost'] = $tableArray['extra_supply_cost'] ;
        } else {
            $tableArray['extra_supply_cost'] = NULL;
        }
        $apphead = AppHead::create($tableArray);
        return response()->json(['status' => 'success', 'message' => 'Heads created successfully.']);
        //return redirect()->route('admin.appheads.index', array('typename' => $apphead->type))->with('success','Heads created successfully.');
    }

    public function show(AppHead $apphead){
        //
    }

 
    public function edit($id){
      $apphead = AppHead::where(['id' => $id])->first();
      if($apphead){
        return view('backend.heads.edit',compact('apphead'));
       }else{
        $msg="Unfortunately this AppHead is not exist!";
        return view('backend.heads.index',compact('msg'));
       } 
       
    }

    public function update(Request $request, AppHead $apphead){
      
        $request->validate([
          'name' => 'required',
          'product_id' => 'required',
          'type' => 'required',
        ]);

        if(isset($request->default)){
            $tableArray = $request->all();
        }else{
            $tableArray = array_merge($request->all(), ['default' => '0']);
        }

        if($request->image){
          $imageName = time().'.'.request()->image->getClientOriginalExtension();
          request()->image->move(public_path('images/stock'), $imageName);
        }
    		$json_fields = array('image');
        foreach($request->all() as $key=>$val){
          if (in_array($key, $json_fields)) {
    				$tableArray[$key] = $imageName;
    			}else{
    				$tableArray[$key]=$val;
    			}
        }
        if(!isset($request->is_active)){
            $tableArray['is_active'] = '0';
        }
        if(isset($tableArray['enable_extra_supply_cost']) && $tableArray['enable_extra_supply_cost'] == 1){
            $tableArray['extra_supply_cost'] = $tableArray['extra_supply_cost'] ;
        } else {
            $tableArray['extra_supply_cost'] = NULL;
        }
        $apphead->update($tableArray);
        return response()->json(['status' => 'success', 'typename' => $apphead->type, 'message' => 'Heads updated successfully.']);
        // /return redirect()->route('admin.appheads.index', array('typename' => $apphead->type))->with('success','Head updated successfully.');
    }

    public function destroy(AppHead $apphead){
      $apphead->delete();
      return response()->json(['success'=>'Heads deleted successfully.']);
    }


}
