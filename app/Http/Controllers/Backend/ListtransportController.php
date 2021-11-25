<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Sale;
use App\Stock;
use DataTables;

class ListtransportController extends Controller{

  public function index(Request $request){
    $name = $request->input('comp');
    $file = $request->input('file');
    $cfile = $request->input('cfile');
    $data=array();
    if($name!=null){
        $data=  $this->csvToArray(base_path("csv/".$name.".csv"));
    }
    $files=$this->getDirContents(base_path("csv/"));

	$fn=array();
	foreach($files as $f){
		$n=explode("/",$f["path"]);
		$fn[]=explode(".",$n[count($n)-1])[0];
	}
	if($file!=null){

    $data=  $this->csvToArray(base_path("csv/".$file.".csv"));
    
    $rowindex=$request->input('edit');

   
    return view('backend.list.edit',array("data"=>$data,"fname"=>$file,"rowindex"=>$rowindex));
}else if($cfile!=null){

    $data=  $this->csvToArray(base_path("csv/".$cfile.".csv"));
  
    $rowindex=$request->input('copy');
 
  return view('backend.list.create',array("data"=>$data,"fname"=>$cfile,"rowindex"=>$rowindex));
}else{
    return view('backend.list.index',array("files"=>$fn,"data"=>$data,"fname"=>$name));
}
 
      
  }
  
	public function addtransport(Request $request){
		$sale = Sale::select('stock_id')->distinct()->get();
		return view('backend.list.addtransport',compact('sale'));
	}
	
	/*public function getsales(Request $request){
		//$sale = Sale::where('id', $request->stock_id)->first();
		
		$Offer = Stock::with('productname')->where('id', $request->stock_id)->first();
		//$seller_username = @$sale->sellerId->product_id;
		
		return response()->json(['variety'=>'','size'=>@$Offer->size_from.'-'.@$Offer->size_to,'goods'=>@$Offer->productname->name]);
	}*/
 
  public function store(Request $request){
    $file=$request->input('file');
    $type=$request->input('type');
    if($type=="write"){
        $rowindex=$request->input("copy");
        $editr=$request->input("editr");
        if(!key_exists("33",$editr)){
            $editr[33]="No";
    
           }
        $csv_handler = fopen(base_path("csv/".$request->input('file').".csv"),'a');
        fputcsv($csv_handler, $editr);
        fclose ($csv_handler);
        return redirect('admin/transport/list?cfile='.$request->input("file").'&copy='.$rowindex)->with('success','Transportation details added');

    }
      if($type=="edit"){
   $editr=$request->input("editr");
 
    $rowindex=$request->input("rowindex");
    $data=  $this->csvToArray(base_path("csv/".$request->input('file').".csv"));

   
        $csv_handler = fopen(base_path("csv/xxx".$request->input('file').".csv"),'w');
        $keys=array();
        $keys=array_keys($data[0]);
       $edlist=array();
       $nc=0;
       if(!key_exists("32",$editr)){
        $editr[32]="No";

       }
       $editr[15]=$editr[15].$request->input("curreny");
        foreach($keys as $k){
            $edlist[$nc]=$editr[$nc];
            $nc++;
       }
        $count=0;
       
        fputcsv($csv_handler, $keys);
        foreach($data as $k=>$d) {
            if($count==$rowindex){
            fputcsv($csv_handler, $edlist);
           
           
            }else{
               
                fputcsv($csv_handler, $d); 
            }
            $count++;

        }
        
 
fclose ($csv_handler);
unlink(base_path("csv/".$request->input('file').".csv"));
rename(base_path("csv/xxx".$request->input('file').".csv"),base_path("csv/".$request->input('file').".csv"));
return redirect('admin/transport/list?file='.$request->input("file").'&edit='.$rowindex)->with('success','Transportation details updated');
    }
}

  function getDirContents($dir, &$results = array()){
    $files = scandir($dir);
    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = ['path'=>$path,'size'=>filesize($path)];
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = ['path'=>$path,'size'=>filesize($path)];
        }
    }
    return $results;
}
public function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header){
                $header = $row;
            }
            else{
                /*print_r(count($header));
                print_r($row);
                break;*/

                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }

    return $data;
}

}
