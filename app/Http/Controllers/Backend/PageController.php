<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Page;
use DataTables;
use View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:view pages', ['only' => ['index']]);
        $this->middleware('permission:add pages', ['only' => ['create','store']]);
        $this->middleware('permission:edit pages', ['only' => ['edit','update']]);
        $this->middleware('permission:delete pages', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
       if ($request->ajax()) {
          $data = Page::where('is_active', '1')->get();
          return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function($row){
                $view = View::make('backend.includes.action_button', [ 'row' => $row,
                            'edit_url' => route('admin.pages.edit', $row->id),
                            'edit_permission' => 'edit pages',
                            'delete_permission' => 'delete pages'
                            ]);
                        $btn = $view->render();
                        return $btn;
               return $btn;
          })
		  ->addColumn('featured_image', function($row){
			  if(!empty($row->featured_image)){
              $image ='<img id="blah" src="'.url('/').'/images/pages/'.$row->featured_image.'" class="img-responsive mt-2 img-thumbnail" width="50" height="50">';
			  }else{
				$image ='<img id="blah" src="https://via.placeholder.com/500.png" class="img-responsive mt-2 img-thumbnail" width="50" height="50">';
			  }
			  return $image;
          })
          ->rawColumns(['action', 'featured_image'])
          ->make(true);
      }
	   return view('backend.setting.pages');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.setting.pagecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
        'pa_name' => 'required',
        'slug'     => 'required',
        'seo_tag_title' => 'required',
        ]);
		if(!empty($request->featured_image)){
				request()->validate([
					'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$stripped = $request->featured_image->getClientOriginalName();
				$filename = pathinfo($stripped, PATHINFO_FILENAME);
				$extension = pathinfo($stripped, PATHINFO_EXTENSION);
				$featuredimg = str_slug($filename,'-').'-'.time().'.'.$extension;
				$request->featured_image->move(public_path('images/pages'), $featuredimg);

		}else{
				if(!empty($request->id)){
					$featuredimg = Page::where('id', $request->id)->value('featured_image');
				}else{
					$featuredimg ='';
				}
		}

		$image_fields = array('featured_image');
		foreach($request->all() as $key=>$val){
			if (in_array($key, $image_fields)) {
				if(!empty($key) && $key == 'featured_image'){
					$tableArray[$key]=$featuredimg;
				}

			}else{
				$tableArray[$key]=$val;
			}
		}
		$page = Page::create($tableArray);
        
        return response()->json(['status' => 'success', 'message' => 'Page created successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $page = Page::where(['id' => $id])->first();
        if($page){
            return view('backend.setting.pageedit',compact('page'));
         }else{
          
          $msg="Unfortunately this Page is not exist!";
          return view('backend.setting.pages',compact('msg'));
         } 
         
      }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
        'pa_name' => 'required',
        'slug' => 'required',
        'seo_tag_title' => 'required',
        ]);
		if(!empty($request->featured_image)){
				request()->validate([
					'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$stripped = $request->featured_image->getClientOriginalName();
				$filename = pathinfo($stripped, PATHINFO_FILENAME);
				$extension = pathinfo($stripped, PATHINFO_EXTENSION);
				$featuredimg = str_slug($filename,'-').'-'.time().'.'.$extension;
				$request->featured_image->move(public_path('images/pages'), $featuredimg);

		}else{
				if(!empty($request->id)){
					$featuredimg = Page::where('id', $request->id)->value('featured_image');
				}else{
					$featuredimg ='';
				}
		}

		$image_fields = array('featured_image');
		foreach($request->all() as $key=>$val){
			if (in_array($key, $image_fields)) {
				if(!empty($key) && $key == 'featured_image'){
					$tableArray[$key]=$featuredimg;
				}

			}else{
				$tableArray[$key]=$val;
			}
		}
		$page->update($tableArray);
       
        return response()->json(['status' => 'success', 'message' => 'Page Update successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
      $page->delete();
      return response()->json(['success'=>'Page deleted successfully.']);
    }
}
