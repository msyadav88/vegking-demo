<?php

namespace App\Http\Controllers\Backend\Auth\Role;

use App\Models\Auth\Role;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\Role\RoleDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Auth\Role\UpdateRoleRequest;
use DataTables;
use Lang;
/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageRoleRequest $request)
    {
         if ($request->ajax()) {
            $data = $this->roleRepository
            ->with('users', 'permissions')
            ->orderBy('id')->get();
            return Datatables::of($data)
            ->addIndexColumn()
               ->addColumn('permission', function($row){
                  if($row->id == 1){
                    return Lang::get('labels.general.all');
                  }else{
                    if($row->permissions->count()){
                        foreach($row->permissions as $permission){
                            return ucwords($permission->name) ;
                        }
                    }
                    else
                        return Lang::get('labels.general.none');
                    }
                }
            )
               ->addColumn('no_of_users', function($row){
                 return $row->users->count();
                }
            )
             ->addColumn('action', function($row){
                 return $row->action_buttons;
                }
            )
            ->rawColumns(['action'])
            ->make(true);
      }
        return view('backend.auth.role.index');
           
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create(ManageRoleRequest $request)
    {
        $response = $this->permission_group_name();
        $permissionArr =  $response['permissionArr'];
        $groups = $response['groups'];
        $custom_group_names = $response['custom_group_names'];
        return view('backend.auth.role.create',compact('permissionArr','groups','custom_group_names'));
            //->withPermissions($this->permissionRepository->get());
    }
    
    private function permission_group_name(){
        $permissions = $this->permissionRepository->get();
        $permissionArr = array();
        foreach($permissions as $permission){
            $permissionArr[$permission->name] = $permission->id;
        }
        
        $groups = array();
        $user_group = array('view user','add user','edit user','delete user','user login as','user change password','user deactive');
        $role_group = array('view role','add role','edit role','delete role');
        $stock_group = array('view stock','add stock','edit stock','delete stock','export stocks');
        $sales_group = array('view sales','add sales','edit sales','delete sales','export sales','sales - view PDF');
        $seller_group = array('view seller','add seller','edit seller','delete seller','import sellers','export sellers');
        $buyer_group = array('view buyer','add buyer','edit buyer','delete buyer','import buyers','export buyers');
        $product_group = array('view products','add products','edit products','delete products','export products');
        $purchase_order_group = array('view purchase order','add purchase order','edit purchase order','delete purchase order');
        $transport_list_group = array('view transport list','add transport list','edit transport list','delete transport list');
        $product_spec_group = array('view product spec','add product spec','edit product spec','delete product spec','export product spec');
        $product_spec_val_group = array('view product spec values','add product spec values','edit product spec values','delete product spec values','export product spec values');
        
        $matches_group = array('edit match','match - invoice','match - all send invoice','view matches');
        
        $buyer_pref_group = array('view buyer pref','add buyer pref','edit buyer pref','delete buyer pref');
        $buyer_leads_group = array('view buyer leads','delete buyer leads');
        $postal_code_group = array('view postal code','add postal code','edit postal code','delete postal code');
        $order_group = array('view order','edit order','delete order');
        $translations_group = array('view translations','add translations','edit translations','delete translations');
        $currency_rate_group = array('view currency rate','add currency rate','edit currency rate','delete currency rate');
        $offer_sent_group = array('view offer sent','offer sent - send PDF');
        $trade_setting_group = array('view trade setting','add trade setting','edit trade setting','delete trade setting');
        $pages_group = array('view pages','add pages','edit pages','delete pages');
        $email_template_group = array('view email templates','add email templates','edit email templates','delete email templates');
        
        $custom_groups = array('user_group','role_group','stock_group','sales_group','seller_group','buyer_group','product_group','product_spec_group','product_spec_val_group','purchase_order_group','transport_list_group','matches_group','buyer_pref_group','buyer_leads_group','postal_code_group','order_group','translations_group','currency_rate_group','offer_sent_group','trade_setting_group','pages_group','email_template_group');
        
        $custom_group_names = array(
                    'user_group'=>'User',
                    'role_group'=>'Role',
                    'stock_group'=>'Stock',
                    'sales_group'=>'Sales',
                    'seller_group'=>'Seller',
                    'buyer_group'=>'Buyer',
                    'product_group'=>'Products',
                    'product_spec_group'=>'Product Spec',
                    'product_spec_val_group'=>'Product Spec Values',
                    'purchase_order_group'=>'Purchase Order',
                    'transport_list_group'=>'Transport Llist',
                    'matches_group'=>'Matches',
                    'buyer_pref_group'=>'Buyer Pref',
                    'buyer_leads_group'=>'Buyer Leads',
                    'postal_code_group'=>'Postal Code',
                    'order_group'=>'Order',
                    'translations_group'=>'Translations',
                    'currency_rate_group'=>'Currency Rate',
                    'offer_sent_group'=>'Offer Sent',
                    'trade_setting_group'=>'Trade Settings',
                    'pages_group'=>'Pages',
                    'email_template_group'=>'Email Templates',
                    );
        
        foreach($custom_groups as $cgroup){
            foreach($$cgroup as $cgroupItem){
                if(isset($permissionArr[$cgroupItem])){
                    $groups[$cgroup][$permissionArr[$cgroupItem]] = $cgroupItem;
                    unset($permissionArr[$cgroupItem]);
                }
            }
        }
        $response = array();
        $response['permissionArr'] = $permissionArr;
        $response['groups'] = $groups;
        $response['custom_group_names'] = $custom_group_names;
        return $response;
    }
    /**
     * @param StoreRoleRequest $request
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function store(StoreRoleRequest $request)
    {
        if(array_key_exists("permissions",$request->toArray())){
            $this->roleRepository->create($request->only('name', 'associated-permissions', 'permissions', 'sort'));       
            return response()->json(['status' => 'success', 'message' => 'Role created successfully.']);    
        }else{
            return response()->json(['status' => 'error', 'message' => 'Please, assign atleast one permission to this role.']);    
        }
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @return mixed
     */
  
    public function edit($id){
        $role = Role::where(['id' => $id])->first();
        if($role){
            if ($role->isAdmin()) {
                return redirect()->route('admin.auth.role.index')->withFlashDanger('You can not edit the administrator role.');
            }
            $response = $this->permission_group_name();
            $permissionArr =  $response['permissionArr'];
            $groups = $response['groups'];
            $custom_group_names = $response['custom_group_names'];
            //echo "<pre/>"; print_r($permissionArr); die;
            return view('backend.auth.role.edit',compact('permissionArr','groups','custom_group_names'))
                ->withRole($role)
                ->withRolePermissions($role->permissions->pluck('name')->all());
                //->withPermissions($this->permissionRepository->get());
         }else{
          
          $msg="Unfortunately this Role is not exist!";
          return view('backend.auth.role.index',compact('msg'));
        } 
         
      }

    /**
     * @param UpdateRoleRequest $request
     * @param Role              $role
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if(array_key_exists("permissions",$request->toArray())){
            $this->roleRepository->update($role, $request->only('name', 'permissions'));
            return response()->json(['status' => 'success', 'message' => 'Role updated successfully.']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Please, assign atleast one permission to this role.']);    
        }
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageRoleRequest $request, Role $role)
    {
        if ($role->isAdmin()) {
            return redirect()->route('admin.auth.role.index')->withFlashDanger(__('exceptions.backend.access.roles.cant_delete_admin'));
        }
        $this->roleRepository->deleteById($role->id);

        event(new RoleDeleted($role));
        if ($request->ajax()) {
         return response()->json(['success'=>__('alerts.backend.roles.deleted')]);
        }else{
           return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.roles.deleted'));
         }
    }
}
