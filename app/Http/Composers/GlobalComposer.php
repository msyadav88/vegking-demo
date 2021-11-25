<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Seller;
use App\Buyer;

/**
 * Class GlobalComposer.
 */
class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $roles = auth_roles();
        //print_r($roles);exit;
        $logged_in_seller = '';
        $logged_in_buyer = '';
        
        if(in_array("seller", $roles)){
            if(auth()->user()){
                $logged_in_seller = Seller::where('user_id',auth()->user()->id)->first();
                $logged_in_seller['whatsapp_number'] = auth()->user()->whatsapp_number;
                $logged_in_seller['sms_number'] = auth()->user()->sms_number;
                $logged_in_seller['whatsapp_verified_at'] = auth()->user()->whatsapp_verified_at;
            }else{
                $logged_in_seller = '';
            }                
        }elseif(in_array("buyer", $roles)){
            if(auth()->user()){
                $logged_in_buyer = Buyer::where('user_id',auth()->user()->id)->first();
                $logged_in_buyer['whatsapp_number'] = auth()->user()->whatsapp_number;
                $logged_in_buyer['sms_number'] = auth()->user()->sms_number;
                $logged_in_buyer['whatsapp_verified_at'] = auth()->user()->whatsapp_verified_at;
            }else{
                $logged_in_buyer = '';
            }
        }
        $view->with(['logged_in_user'=>auth()->user(),'logged_in_seller'=>$logged_in_seller, 'logged_in_buyer'=>$logged_in_buyer]);
    }
}
