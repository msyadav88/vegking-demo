<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
       //$setting = Setting::where('id',1)->first();
	   $active_lang = \App::getLocale();
	   $setting = Setting::where('site_lang',$active_lang)->first();
	   return view('backend.setting.index',compact('setting'));
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        $setting = Setting::create($request->all());
        return redirect()->route('admin.setting.index')->with('success','Setting created successfully.');
    }
    public function show(Setting $setting){



    }
    public function edit(Setting $setting)
    {
        //
    }
    public function update(Request $request, Setting $setting)
    {

		if(!empty($request->site_logo)){
				request()->validate([
					'site_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$stripped = $request->site_logo->getClientOriginalName();
				$filename = pathinfo($stripped, PATHINFO_FILENAME);
				$extension = pathinfo($stripped, PATHINFO_EXTENSION);
				$sitelogo = str_slug($filename,'-').'-'.time().'.'.$extension;
				$request->site_logo->move(public_path('img'), $sitelogo);

		}else{
				if(!empty($request->id)){
					$sitelogo = Setting::where('id', $request->id)->value('site_logo');
				}else{
					$sitelogo ='';
				}
		}
		if(!empty($request->site_favicon)){
				request()->validate([
					'site_favicon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$stripped = $request->site_favicon->getClientOriginalName();
				$filename = pathinfo($stripped, PATHINFO_FILENAME);
				$extension = pathinfo($stripped, PATHINFO_EXTENSION);
				$sitefavicon = str_slug($filename,'-').'-'.time().'.'.$extension;
				$request->site_favicon->move(public_path('img'), $sitefavicon);

		}else{
				if(!empty($request->id)){
					$sitefavicon = Setting::where('id', $request->id)->value('site_favicon');
				}else{
					$sitefavicon ='';
				}
		}

		$image_fields = array('site_favicon','site_logo');
		foreach($request->all() as $key=>$val){
			if (in_array($key, $image_fields)) {
				if(!empty($key) && $key == 'site_favicon'){
					$tableArray[$key]=$sitefavicon;
				}
				if(!empty($key) && $key == 'site_logo'){
					$tableArray[$key]=$sitelogo;
				}
			}else{
				$tableArray[$key]=$val;
			}
		}
		 $setting->update($tableArray);
		 
		 return response()->json(['status' => 'success', 'message' => 'Settings created successfully.']);

    }

    public function destroy(Setting $setting)
    {
        \Artisan::call('cache:clear');
    }

    public function clearCache(){
        \Artisan::call('cache:clear');
        return redirect()->back();
    }
}
