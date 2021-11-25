<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\Stock;
use App\Buyer;
use App\Seller;
use DataTables;
use App\Invoice;
use App\Product;
use App\AppHead;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller{

    public function index(Request $request){
       
        $buyers_list = Buyer::select('id', 'username')->get();
        $seller_list = Seller::select('id', 'username')->get();
		 if ($request->ajax()) {
            $data = Invoice::with('product','seller', 'buyer');
           
            if(isset($request->type) && !empty($request->type)){
                $data->where('invoice_type', $request->type);
            }
            if(isset($request->seller) && !empty($request->seller)){
                $data->where('seller_id', $request->seller);
            }

            if(isset($request->buyer) && !empty($request->buyer)){
                $data->where('buyer_id', $request->buyer);
            }
            $data = $data->get();
            if(auth()->user()->hasRole('seller')){
                $seller_id = get_buyer_by_user_id()['id'];
                $data = Invoice::with('product','seller', 'buyer')->where('seller_id', $seller_id)->get();
            }
		
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){
                    if(in_array('seller', auth_roles())){
                        $route_pre = 'seller';
                    }else{
                        $route_pre = 'admin';
                    }
                    
				   $btn = '<div class="btn-group btn-group-sm">
								<button data-toggle="tooltip" title="Add Payment" type="button" class="btn btn-success  editItem" data-url="'.route($route_pre.'.invoices.payment', $row->id).'"><i class="fa fa-share "></i></button>
								<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                            </div>';
                    // $btn = '<div class="btn-group btn-group-sm">
                    //           <button type="button" class="btn btn-edit editItem" data-url="'.route($route_pre.'.invoices.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                    //           <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                    //           <button type="button" class="btn btn-warning sendInvoice" title="Send PDF" data-url="'.route($route_pre.'.accounts.OrderInvoiceSend', $row->id).'" data-viewurl="'.route($route_pre.'.accounts.OrderInvoiceView', $row->id).'"><i class="fas fa-file-invoice"></i></button>
                    //         </div>';
					return $btn;
                })
                ->addColumn('product_name', function($row){
					return (@$row->product->name?@$row->product->name:'-');
				})
				->addColumn('buyer_name', function($row){
					return (@$row->buyer->username?@$row->buyer->username:'-');
				})
				->addColumn('seller_name', function($row){
					return (@$row->seller->username?@$row->seller->username:'-');
                })
                ->addColumn('sale_show_url', function($row){
                    $data = '<a href="'.route('admin.sales.show', $row->sale_id).'" target="_blank">'.$row->sale_id.'</a>';
                    return $data;
				})
				->rawColumns(['action','buyer_name','seller_name','sale_show_url'])
				->make(true);
		  }
		  return view('backend.invoices.index',compact('buyers_list','seller_list'));    }

    public function create(){
        $stockid = Stock::pluck('id','id');
        $buyers = Buyer::where('status', '1')->pluck('username','id');
        $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
        return view('backend.invoices.create',compact('buyers', 'stockid','sellers'));
    }

    public function store(Request $request){
        if(in_array('seller', auth_roles())){
            $route_pre = 'seller';
        }else{
            $route_pre = 'admin';
        }
        $request->validate([
         'stock_id' => 'required',
         'buyer_id' => 'required',
         'seller_id' => 'required',
         'price' => 'required',
         'delivery_date' => 'required',
        ]);
       Invoice::create($request->all());
       return redirect()->route($route_pre.'.invoices.index')->with('success','Purchase Order created successfully.');
    }

    public function show(Invoice $invoices)
    {
        //
    }

    public function edit(Invoice $invoices){
        $stockid = Stock::select('id')->get();
        $buyers = Buyer::where('status', '1')->select('id', 'username', 'name')->get();
        $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
        return view('backend.invoices.edit',compact('invoices','buyers', 'stockid','sellers'));
    }

    public function update(Request $request,Invoice $invoice){
        if(in_array('seller', auth_roles())){
            $route_pre = 'seller';
        }else{
            $route_pre = 'admin';
        }
       
        $invoice_data = $request->all();
        
        $request->validate([
            'product_id' => 'required',
            'buyer_id' => 'required',
            'seller_id' => 'required',
            'paid' => 'required|min:1|numeric|max:'.$invoice['amount'],
            'invoice_type' => 'required',
        ]);
        // dd($invoice['amount']);
        $invoice_data['gross'] = $invoice['amount'];
        $invoice_data['net'] = $invoice['amount'] - $invoice_data['paid'];

        if($invoice_data['paid'] >= $invoice['amount']){
            $invoice_data['status'] = 'PAID'; 
        }
        $invoice->update($invoice_data); 
        return redirect()->route($route_pre.'.invoices.index')->with('success','Payment created successfully.');
    }

    public function destroy(Invoice $invoice){
       $invoice->delete();
       return response()->json(['success'=>'Purchase Order deleted successfully.']);
    }
    public function productsexports() 
    {
        return Excel::download(new ProductExport, 'invoices.xlsx');
    }
    public function payment($invoice_id=NULL){
        $invoice = Invoice::where(['id' => $invoice_id])->first();
        if($invoice){
            $invoices = Invoice::with('product','seller', 'buyer')->where('id', $invoice_id)->first();
            $stockid = Stock::select('id')->get();
            $product_list = Product::select('name','id')->get();
            $buyers = Buyer::where('status', '1')->select('id', 'username', 'name')->get();
            $sellers = Seller::where('status', '1')->select('id', 'username', 'name')->get();
            return view('backend.invoices.payment',compact('invoices','buyers', 'stockid','sellers','product_list'));
         }else{
          
          $msg="Unfortunately this Invoices is not exist!";
          return view('backend.invoices.index',compact('msg'));
         } 
      }
}
