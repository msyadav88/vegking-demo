<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;
use DataTables;
use Cookie;



/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public $_locale;
    public function __construct(){
        $this->_locale = config('locale');
    }

    public function swap($locale)
    {   
        if (array_key_exists($locale, config('locale.languages'))) {
            Cookie::queue('language', $locale, 2628000);
        }  
                
        if (strpos(url()->previous(), 'admin') !== false || strpos(url()->previous(), 'seller') !== false || strpos(url()->previous(), 'buyer') !== false || strpos(url()->previous(), 'contact') !== false || strpos(url()->previous(), 'account') !== false || strpos(url()->previous(), 'password/reset') !== false || strpos(url()->previous(), 'privacy-policy') !== false || strpos(url()->previous(), 'terms-conditions') !== false)  {
            return redirect()->back();
        }
        return redirect()->route('frontend.language', $locale);
    }

    public function index(){
        $lang_path = base_path('resources/lang');
        $locale_path_arr = array();
        foreach( $this->_locale['languages'] as $lang_code => $lang_arr ){
            if( file_exists( $lang_path ."/{$lang_code}"."/." ) ){
                $locale_path_arr[ $lang_code ] = scandir( $lang_path."/{$lang_code}" );
            }
        }
        $items = LanguageLine::get(['id', 'group', 'key', 'text'])->toArray();
        return view('backend.languages.index', array( 'locale'=> $this->_locale, 'locale_path_arr' => $locale_path_arr, 'lang_path' => $lang_path, 'all_lines' => $items ) );
    }



    public function loadLanguageFile(Request $request){
        if( $request->ajax() ){

        $items = LanguageLine::get(['id', 'group', 'key', 'text']);//->toArray();
          return Datatables::of($items)
          ->addIndexColumn()
          ->addColumn('action', function($row){
               $view = \View::make('backend.languages.action_button', [ 'row' => $row ]);
               return $view;
          })
          ->addColumn('group', function($row){
            if($row->group){
              return ucwords($row->group);
            }else{
              return '-';
            }
          })
           ->addColumn('key', function($row){
            if($row->key){
                $key = $row->key;
                return $key;
            }else{
              return '-';
            }
        })
          ->rawColumns(['group', 'key'])
          ->make(true);
        }
        return response()->json( $locale_path_arr );

    }

    public function getLanguageLine(Request $request){
        $LangLine = LanguageLine::where( [ "id" => $request->edit_id ] )->get()->toArray();
        if( $LangLine && is_array( $LangLine[0] ) ){
            return response()->json( ["error" => 0, "status" => 'success', 'message' => 'Record Found', 'langData' => $LangLine[0] ]);
        }else{
            return response()->json( ["error" => 1, "status" => 'failed', 'message' => 'Could not found the specified language line for id '.$request->edit_id ]);
        }
        
    }


    public function deleteLanguageLine(Request $request){
        $request_all = $request->all();
        $deleted = LanguageLine::where( [ "id" => $request->del_id ] )->delete();
        if( $deleted ){
            return response()->json( ["request"=>$request_all, "error" => 0, "status" => 'success', 'message' => 'Deleted Successfully' ]);
        }else{
            return response()->json( ["request"=>$request_all, "error" => 1, "status" => 'failed', 'message' => 'Could not be deleted' ]);
        }
    }
    public function saveLanguageTrans(Request $request){
        $valid_array = array();
        $rules['group'] = 'required';
        $rules['key'] = 'required';
        foreach( $this->_locale['languages'] as $lang_key => $lang_code){
            $rules[$lang_code[0]] =  'required';
        }
        $request->validate($rules);
        
        $request_all = $request->all();
        // print_r($this->_locale['languages']);
        $lang_trans_arr = array();
        $id = $request->rec_id;

        foreach ( $this->_locale['languages'] as $locale_key => $locale_nm ){
            if( isset( $request_all[ $locale_key ] ) ){
                $lang_trans_arr[ $locale_key ] = $request_all[ $locale_key ];
            }
        }
        $lang_line_arr = [
            'group'=> $request_all['group'],
            'key' => $request_all['key'],
            'text' => $lang_trans_arr,//['en' => 'Hello all', 'pl' => 'Howdy all', 'es' => 'Hola all'],
        ];
        
        $arr = LanguageLine::where( array( 'group' => $request_all['group'], 'key' => $request_all['key'] ) )->get()->toArray();
        //$arr = LanguageLine::where( array( 'id' => $id )->get()->toArray();


        if ( $arr && count($arr) ==1 && (int)$id == 0 ){

            $action = 'Duplicate';
            $error = 1;
            $status = 'failed';
            $msg = 'Duplicate group "'.$request_all['group'].'" Key "'.$request_all['key'].'" Combination.';
        }else{
            // echo "id in else is".$id;
            if( (int)$id >= 1 ){
                // echo " - id in sec if is".$id;
                $updated = LanguageLine::where( [ "id" => $id ] )->update( [ 'group' => $request_all['group'], 'key' => $request_all['key'], 'text' => $lang_trans_arr] );

                $action = 'update';
                if( $updated ){
                    $error = 0;
                    $status = 'success';
                    $msg = 'Translations Updated  Successfully.';
                }else{
                    $error = 1;
                    $status = 'failed';
                    $msg = 'Failed to Updated Translations';
                }
            }else{
                // echo "id in sec else is".$id;

                $created = LanguageLine::create( $lang_line_arr );
                $action = 'create';
                if( $created ){
                    $error = 0;
                    $status = 'success';
                    $msg = 'Translations Created Successfully.';
                }else{
                    $error = 1;
                    $status = 'failed';
                    $msg = 'Failed to Created Translations';
                }
            }
        }
        return response()->json( [ "error" => $error, 'action' => $action, 'status' => $status, 'message' => $msg ] );
        //return response()->json( $locale_path_arr );
        //$created = LanguageLine::create();
        //exit;
    }

}
