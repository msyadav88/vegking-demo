<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadSubmit(Request $request){

        $file     = request()->file('file');
        $fileName = $file->getClientOriginalName();
        
        $path = $request->file('file')->storeAs("",$fileName
        );


        return $path;     
    }
    public function downloadFile( Request $request){
        $file=$request->input('file');
        $file_path = storage_path('') . "/" . $file;
        //echo $file_path;
        return Response::download($file_path);
    }

}
