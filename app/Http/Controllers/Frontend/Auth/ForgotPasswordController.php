<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\LanguageContent;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $LanguageContent = LanguageContent::where('id',1)->first();
        return view('frontend.auth.passwords.email', compact('LanguageContent'));
    }
}
