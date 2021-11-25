<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Frontend\User\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use App\LanguageContent;
use DateTime;
use Illuminate\Support\Facades\Route;
//use App\Http\Requests\Frontend\Auth\ManageUserRequest;

/**
 * Class AccountController.
 */
class UsersController extends Controller
{
	
	/**
     * @var UserRepository
     */
    protected $userRepository;

	
    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
	/* public function publicpage_updateprofilepic(ManageUserRequest $request, User $user)
    {
         return view('frontend.publicpage_updateprofilepic')
                ->withUser($user);
        
    } */
	
	public function publicpage_updateprofilepic($user)
    {
		$LanguageContent = LanguageContent::where('id',1)->first();
		$user = DB::table('users')->select('id','first_name','avatar_location')->where('users.id',$user)->get();
		
        return view('frontend.publicpage_updateprofilepic', compact('LanguageContent'))->withUser($user);
		

		
        /* return view('frontend.publicpage_updateprofilepic')
                ->withUser($user);
         */
    }
	
	 public function updateimage(UpdateUserRequest $request, User $user)
    {
		/* $this->userRepository->updateimage($user, $request->only(
            'avatar_location'
        )); */
		
		 $output = $this->userRepository->updateimage(
            $request->user()->id,
            $request->only('avatar_location'),
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );


        return response()->json(['status' => 'success', 'message' => 'Profile Updated successfully']);
		
    }
	
	public function useraffiliatecode($user)
    { 
		$LanguageContent = LanguageContent::where('id',1)->first();
		$users = DB::table('affiliate_data')->select('id','aff_code','user_code')->where('affiliate_data.user_code',$user)->get();
		$dt = new DateTime();
		//print_r($user->count());
		if($users->count() == 0) {
			$data = array('aff_code'=>'ac',"user_code"=>$user,'created_at' => $dt->format('Y-m-d H:i:s'),'updated_at'=> $dt->format('Y-m-d H:i:s'));
			DB::table('affiliate_data')->insert($data);
			//return response()->json(['status' => 'success', 'message' => 'Affiliate code added successfully.']);
			echo "<div class='container'><div class='row'>Record inserted successfully.</div></div>";
			redirect()->intended('/').'/ac='.$user;
			
	
			
		} //else {
			//return response()->json(['status' => 'success', 'message' => 'Affiliate code is already exists.']);
			//echo "<div class='container'><div class='row'>Record is already there.</div></div>";
		//}
		
		return view('frontend.useraffiliatecode', compact('LanguageContent'))->withUser($users);
		
    }
}

