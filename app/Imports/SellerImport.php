<?php

namespace App\Imports;

use App\AppHead;
use App\Events\Backend\StockUpdated;
use App\Models\Auth\User;
use App\Stock;
use App\Seller;
// use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class SellerImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
       
        $request = new Request($row);
        $request->validate([
            'product' => 'required|exists:app_heads,name,type,product',
            'variety' => 'required|exists:app_heads,name,type,potato_variety',
            'flesh_color' => 'required|exists:app_heads,name,type,flesh_color',
            'soil' => 'required|exists:app_heads,name,type,soil',
            'quantity' => 'required',
            'price' => 'required',
            'email' => 'required|email',
            // 'available_from_date' => 'required|date',
            'available_per_day' => 'required|integer',
            'pallets_available' => 'required|integer',
            'city'=>'required',
            'country'=>'required',
            'street'=>'required',
            'postalcode'=>'required|min:2|max:8',
            'size_to'=>'required',
            'size_from'=>'required',
            'stock_status'=>'in:unavailable,available,upcoming_stock',
            'load_status'=>'in:planned,ready_for_collection,unplanned,planned,loaded,unloaded,in_store,rejected,other',
          ],[
            'postalcode.required' => 'The postalcode or city field is required.',
          ]);
        $seller = Seller::where('email', $request->email)->first();    
        
        if($seller==null){
            $seller_user = User::create([
                "first_name"=>$request->seller_name,
                "email"=>$request->email,
                "password"=>\Hash::make("secret123"),
            ]);
            
            $seller_user->assignRole('seller');            
            $seller = Seller::create(['user_id'=>$seller_user->id, "name"=>$request->seller_name, "email"=>$request->email, "username"=>$request->seller_name]);
            
        }  

        $product = AppHead::where('name', $request->product)->where('type', 'product')->first();
        $product_variety = AppHead::where('name', $request->variety)->where('type', 'potato_variety')->first();
        $flesh_color = AppHead::where('name', $request->flesh_color)->where('type', 'flesh_color')->first();   
        $soil = AppHead::where('name', $request->soil)->where('type', 'soil')->first();   
        // dd($product_variety);
        $purposes["washing"] = isset($row["washing"]) ?: "washing";
        $purposes["washed"] = isset($row["washed"]) ?: "washed";
        $purposes["dirty"] = isset($row["dirty"]) ?: "dirty";
        $purposes["peeling"] = isset($row["peeling"]) ?: "peeling";
        $purposes["french_fries"] = isset($row["french_fries"]) ?: "french_fries";
        $purposes["crisping"] = isset($row["crisping"]) ?:"crisping";    

        $defect["scabs"] = isset($row["scabs"]) ?: "scabs";
        $defect["bruising"] = isset($row["bruising"]) ?: "bruising";
        $defect["internals"] = isset($row["internals"]) ?: "internals";
        $defect["rot"] = isset($row["rot"]) ?: "rot";
        $defect["sprouts"] = isset($row["sprouts"]) ?: "sprouts";

        // $packaging["1250_kg_big_bags"]  = $row["1250_kg_big_bags"];
        // $packaging["15kg_nets"]  = $row["15kg_nets"];

        $tableArray['available_from_date'] = date('Y-m-d',strtotime($request->available_from_date));
        $tableArray['pallets_available'] = $request->pallets_available;
        $tableArray['purposes'] = json_encode(@$purposes);
        $tableArray['defects'] = json_encode(@$defect);
        // $tableArray['packaging'] = json_encode(@$packaging);
        $tableArray['stock_status'] = $request->stock_status;
        $tableArray['load_status'] = $request->load_status;  
        $tableArray["quantity"]=$request->quantity;  
        $tableArray["available_per_day"]=$request->available_per_day;  
        $tableArray["price"]=@$request->price;  
        $tableArray["email"]= @$request->email;  
        $tableArray["product_id"]= @$product->id;
        $tableArray["seller_id"]= @$seller->id;  
        $tableArray["variety"]=@$product_variety->id;  
        $tableArray["size_from"]= @$request->size_from;
        $tableArray["size_to"]= @$request->size_to;  
        $tableArray["flesh_color"]=@$flesh_color->id;  
        $tableArray["soil"]= @$soil->id;  
        $tableArray["stock_status"]= @$request->stock_status;  
        $tableArray["load_status"]= @$request->load_status;  
        $tableArray["city"]= @$request->city;  
        $tableArray["street"]=@$request->street;  
        $tableArray["postalcode"]= @$request->postalcode;  
        $tableArray["country"]=@$request->country;  
        $tableArray["note"]= @$request->note;  

        $offer = Stock::create($tableArray);
        event(new StockUpdated($offer));    
        return $offer;
    }
    
}
