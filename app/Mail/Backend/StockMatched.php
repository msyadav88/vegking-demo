<?php

namespace App\Mail\Backend;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendContact.
 */
class StockMatched extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct($matches,$user, $email_template = NULL)
    {
        $this->matches = $matches;
        $this->user = $user;
        $this->email_template = $email_template;
        //print_r($this->user->toArray());exit;
        //echo $this->matches[0]['match'];exit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $locale = \App::getLocale();
        if($this->email_template != NULL){
           $email_template = $this->email_template;
        }else{
           $email_template = get_email_template('STOCK MATCHED');
        }

        if($email_template){
            $email_content = 'King [username] [env] [role],';
            if($locale == 'pl'){
                $email_content .= $email_template->email_content_pl;
            }else{
                $email_content .= $email_template->email_content;
            }
            $main_content = $email_content;

            $view_matches_link = '<a href="'.route('admin.matches.index').'">'.route('admin.matches.index').'</a>';

            $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
            $email_content = str_replace("[role]", 'trader', $email_content);
            $middle_content = get_string_between($email_content, '[startloop]', '[endloop]');
            //echo $middle_content;exit;
            $tmp2='';
            $name = ucfirst($this->user->first_name).' '.ucfirst($this->user->last_name);
            //$tmp = str_replace("[team_member_name]", $name, $email_content);
            //echo $tmp;exit;
            
            foreach ($this->matches as $match) {
               if($match['match']->stock->seller != NULL && $match['match']->buyerPref->buyer != NULL){
                $match_url = '<a href="'.route('admin.matches.edit',$match['match']->id).'">'.$match['match']->id.'</a>';
                $stock_url = '<a href="'.route('admin.stock.show',$match['match']->stock->id).'">'.$match['match']->stock->id.'</a>';
                $seller_url = '<a href="'.route('admin.sellers.show',$match['match']->stock->seller->id).'">'.$match['match']->stock->seller->username.'</a>';
                $buyer_pref_url = '<a href="'.route('admin.buyerpref.show',$match['match']['buyer_pref_id']).'">'.$match['match']['buyer_pref_id'].'</a>';
                $buyer_url = '<a href="'.route('admin.buyers.show',$match['match']->buyerPref->buyer->id).'">'.$match['match']->buyerPref->buyer->username.'</a>';                
                
                $tmp = $middle_content;
                $tmp .= "<hr/>";
                $tmp = str_replace("[username]", $name, $tmp);
                $tmp = str_replace("[match_id]", $match_url, $tmp);
                $tmp = str_replace("[stock_id]", $stock_url, $tmp);
                $tmp = str_replace("[seller_username]", $seller_url, $tmp);
                $tmp = str_replace("[buyer_pref_id]", $buyer_pref_url, $tmp);
                $tmp = str_replace("[buyer_username]", $buyer_url, $tmp);
                $tmp = str_replace("[product_name]", $match['match']->stock->product->name, $tmp);
                $tmp = str_replace("[stock_price]", $match['match']->stock->price, $tmp);
                $tmp = str_replace("[buyer_total_prefs]", $match['match']->buyerPref->buyer->total_prefs, $tmp);
                $tmp = str_replace("[profit_per_ton]", $match['pTonCalculation']['profitPerTon'], $tmp);
                $tmp = str_replace("[quantity]", $match['match']->stock->quantity, $tmp);
                $tmp = str_replace("[view_matches_link]", $view_matches_link, $tmp);
                $tmp2 .= $tmp;
               }
            }          
            $tagOne = "[startloop]";
            $tagTwo = "[endloop]";
            $replacement = $tmp2;

            $startTagPos = strrpos($email_content, $tagOne);            
            $endTagPos = strrpos($email_content, $tagTwo);
            $tagLength = $endTagPos - $startTagPos + 9;
            
            $newText = substr_replace($email_content, $replacement, 
                $startTagPos, $tagLength);

            $send_content = str_replace('[team_member_name]', $name, $newText);

            $email_content = $send_content;
        }
        //print_r($email_content);exit;
            return $this->view('frontend.mail.general',['email_content' => $email_content, 'uuid'=>$this->user->uuid])
            ->subject($email_template->subject)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'), config('mail.from.name'));    
        
       
    }
}