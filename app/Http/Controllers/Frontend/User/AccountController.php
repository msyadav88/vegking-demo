<?php

namespace App\Http\Controllers\Frontend\User;
use App\LanguageContent;

use App\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $LanguageContent = LanguageContent::where('id',1)->first();
        return view('frontend.user.account', compact('LanguageContent'));
    }
}
