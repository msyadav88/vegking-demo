<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\User;
use App\Seller;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Product;
use Illuminate\Support\Facades\Request;
use DataTables;
use App\Rules\Captcha;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:add user', ['only' => ['create','store']]);
        $this->middleware('permission:edit user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        // $user_count = User::where('active',1)->count();
        // return view('backend.auth.user.index')
        //     ->withUsers($this->userRepository->getActivePaginated($user_count, 'id', 'asc'));
        //$data = $this->userRepository->getActivePaginated(25, 'id', 'asc');
        $data = $this->userRepository->orderBy('id', 'asc')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('confirmed_label', function($row){
                  return  strip_tags($row->confirmed_label);
            }) 
            ->addColumn('roles_label', function($row){
                  return  strip_tags($row->roles_label);
            }) 
			->addColumn('user_code', function($row){
                $link = route('frontend.index');
				if($row->user_code == '') {
					$user_code =  '<a href='.$link.'>Affiliate Link</a>';
				} else {
					$user_code =  '<a href='.$link.'/ac='.$row->user_code.'>Affiliate Link</a>';
				}
                
                  return ($user_code);
            }) 
            ->editColumn('referrer', function($row){
                $link = route('frontend.index');
                $referrer =  '<a href='.$link.'?r='.encrypt($row->id).')">Referrer Link</a>';
                  return ($referrer);
            }) 
             ->addColumn('permissions_label', function($row){
                   return  strip_tags($row->permissions_label);
                 
            }) 
            ->addColumn('social_buttons', function($row){
                   return  strip_tags($row->social_buttons);
                 
            }) 
            ->addColumn('updated_at', function($row){
                   return  strip_tags($row->updated_at->diffForHumans());
                 
            }) 
            ->addColumn('action', function($row){
                   return  $row->action_buttons;
                 
            }) 
           // ->rawColumns(['action','referrer'])
		    ->rawColumns(['referrer' => 'referrer','user_code' => 'user_code'])
            ->make(true);
      }
        return view('backend.auth.user.index');
            
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $products = Product::all()->where('status', '1')->pluck('name', 'id');
        return view('backend.auth.user.create',compact('products'))
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->only(
            'name',
            'email',
            'phone',
            'company_name',
            'password',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));
		
        return response()->json(['status' => 'success', 'roles'=>$request->roles ,'message' => __('alerts.backend.users.created')]);
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        if($user->active){
            return view('backend.auth.user.show')
                ->withUser($user);
        }else{
            return abort(404);
        }
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        if($user->active){
            $products = Product::all()->where('status', '1')->pluck('name', 'id');
            return view('backend.auth.user.edit',compact('products','user'))
                ->withUser($user)
                ->withRoles($roleRepository->get())
                ->withUserRoles($user->roles->pluck('name')->all())
                ->withPermissions($permissionRepository->get(['id', 'name']))
                ->withUserPermissions($user->permissions->pluck('name')->all());
        }else{
            return abort(404);
        }
    }
    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->only(
            'name',
            'email',
            'phone',
            'roles',
            'permissions'
        ));
        return response()->json(['status' => 'success', 'message' => __('alerts.backend.users.updated')]);
        //return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }

    public function excelUpload(Request $request){

    }
}


