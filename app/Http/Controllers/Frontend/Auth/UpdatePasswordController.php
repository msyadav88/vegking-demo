<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Frontend\User\UpdatePasswordRequest;

/**
 * Class UpdatePasswordController.
 */
class UpdatePasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdatePasswordRequest $request
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function update(UpdatePasswordRequest $request)
    {
        $res= $this->userRepository->updatePassword($request->only('old_password', 'password','password_confirmation'));
        if ($request->check_route == 'for_user') {
            if($res == 1){
                return response()->json(['status' => 'success', 'message' => 'Password Updated successfully.']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Password not Updated,please try again.']);
            }
        }
        // return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.password_updated'));
    }
}
