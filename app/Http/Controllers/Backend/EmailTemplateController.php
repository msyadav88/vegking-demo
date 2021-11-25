<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\EmailTemplate;
use App\EmailTemplateHeaderFooter;
use App\Roles;
use App\Pushsounds;
use Illuminate\Http\Request;
use DataTables;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->ajax()) {
      $data = EmailTemplate::select('id','title','subject','recipients','sent','status','global_header')->get();
      return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
              $btn = '<div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-edit editItem" data-url="'.route('admin.email-templates.edit', $row->id).'"><i class="fas fa-edit"></i></button>
                        <button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                      </div>';
                return $btn;
            })
            ->addColumn('recipients', function($row){
              $roles = Roles::get();
              $rolebtn = '';
              if( in_array( 1001 ,explode(',',$row->recipients ))){
                $attr = 'checked';
                $roleid = 1001;
              }else{
                $attr = '';
                $roleid = 0;
              }
              $rolebtn .= '<input type="hidden" name="email['.$row->id.'][]" value="'.$roleid.'" /><input type="checkbox" '.$attr.' class="userrole" role-id="1001" email-id="'.$row->id.'" /> THE SELLER | ';

              if( in_array( 1002 ,explode(',',$row->recipients ))){
                $attr = 'checked';
                $roleid = 1002;
              }else{
                $attr = '';
                $roleid = 0;
              }
              $rolebtn .= '<input type="hidden" name="email['.$row->id.'][]" value="'.$roleid.'" /><input type="checkbox" '.$attr.' class="userrole" role-id="1002" email-id="'.$row->id.'" /> THE BUYER | ';

              if( in_array( 1003 ,explode(',',$row->recipients ))){
                $attr = 'checked';
                $roleid = 1003;
              }else{
                $attr = '';
                $roleid = 0;
              }
              $rolebtn .= '<input type="hidden" name="email['.$row->id.'][]" value="'.$roleid.'" /><input type="checkbox" '.$attr.' class="userrole" role-id="1003" email-id="'.$row->id.'" /> THE TRADER | ';
              foreach($roles as $role){
                if( in_array( $role->id ,explode(',',$row->recipients ))){
                  $attr = 'checked';
                  $roleid = $role->id;
                }else{
                  $attr = '';
                  $roleid = 0;
                }
                $rolebtn .= '<input type="hidden" name="email['.$row->id.'][]" value="'.$roleid.'" /><input type="checkbox" '.$attr.' class="userrole" role-id="'.$role->id.'" email-id="'.$row->id.'" />
                  '.substr(strtoupper($role->name), 0, 5).' | ';
              }
              return rtrim($rolebtn, ' | ');
           })
          ->addColumn('status', function($row){
            if($row->status== '1')
             return 'Active';
             else{ return 'Inactive'; }
          })
          ->addColumn('global_header', function($row){
            if($row->global_header== '1')
            {
              $attr = 'checked';
            }
            else
            { 
              $attr = '';
            }
            $header = '<input class="global-header" template="'.$row->id.'" type="checkbox" '.$attr.' value="'.$row->global_header.'" />';
            return rtrim($header, ' | ');
          })
           ->rawColumns(['global_header','recipients','action'])
           ->make(true);
      }
     $push_sounds=Pushsounds::get()->where('status',1);
 
     return view('backend.email-templates.index',compact('push_sounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Roles::get();
      return view('backend.email-templates.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_push(Request $request){
      echo $request->push_notification;
      Pushsounds::where('status', 1)
      ->update(['status' => 0]); 

      $roles = Pushsounds::find($request->push_notification);
      $roles->status=1;
      $roles->save();
       return redirect()->back()->with('success', ['your message,here']);   
      
    }
    public function store(Request $request)
    {
      $request->validate([
        'title' => 'required',
      ]);

      $tableArray = $request->all();

      unset($tableArray['_method']);
      unset($tableArray['_token']);
      unset($tableArray['header_en']);
      unset($tableArray['header_pl']);
      unset($tableArray['header_de']);
      unset($tableArray['footer_en']);
      unset($tableArray['footer_pl']);
      unset($tableArray['footer_de']);
      unset($tableArray['title']);
      unset($tableArray['subject']);
      unset($tableArray['email_content']);
      unset($tableArray['email_content_de']);
      unset($tableArray['email_content_pl']);
      unset($tableArray['sms_content']);
      unset($tableArray['sms_content_de']);
      unset($tableArray['sms_content_pl']);
      unset($tableArray['push_notification_content_en']);
      unset($tableArray['push_notification_content_de']);
      unset($tableArray['push_notification_content_pl']);
      unset($tableArray['buyer_subject']);
      unset($tableArray['buyer_email_content']);
      unset($tableArray['buyer_email_content_de']);
      unset($tableArray['buyer_email_content_pl']);
      unset($tableArray['buyer_sms_content']);
      unset($tableArray['buyer_sms_content_de']);
      unset($tableArray['buyer_sms_content_pl']);
      unset($tableArray['buyer_push_content_en']);
      unset($tableArray['buyer_push_content_de']);
      unset($tableArray['buyer_push_content_pl']);
      unset($tableArray['trader_subject']);
      unset($tableArray['trader_email_content']);
      unset($tableArray['trader_email_content_de']);
      unset($tableArray['trader_email_content_pl']);
      unset($tableArray['trader_sms_content']);
      unset($tableArray['trader_sms_content_de']);
      unset($tableArray['trader_sms_content_pl']);
      unset($tableArray['trader_push_content_en']);
      unset($tableArray['trader_push_content_de']);
      unset($tableArray['trader_push_content_pl']);
      unset($tableArray['whatsapp_content']);
      unset($tableArray['roles']);
      unset($tableArray['status']);
      unset($tableArray['buyer_status']);
      unset($tableArray['trader_status']);
      unset($tableArray['whatsapp_content']);
      unset($tableArray['roles']);
      unset($tableArray['status']);
      unset($tableArray['id']);

      EmailTemplate::create([
        'header_en' => $request->header_en,
        'header_pl' => $request->header_pl,
        'header_de' => $request->header_de,
        'footer_en' => $request->footer_en,
        'footer_pl' => $request->footer_pl,
        'footer_de' => $request->footer_de,
        'title' => $request->title,
        'subject' => $request->subject,
        'email_content' => $request->email_content,
        'email_content_de' => $request->email_content_de,
        'email_content_pl' => $request->email_content_pl,
        'sms_content' => $request->sms_content,
        'sms_content_de' => $request->sms_content_de,
        'sms_content_pl' => $request->sms_content_pl,
        'push_content_en' => $request->push_notification_content_en,
        'push_content_de' => $request->push_notification_content_de,
        'push_content_pl' => $request->push_notification_content_pl,
        'buyer_subject' => $request->buyer_subject,
        'buyer_email_content' => $request->buyer_email_content,
        'buyer_email_content_de' => $request->buyer_email_content_de,
        'buyer_email_content_pl' => $request->buyer_email_content_pl,
        'buyer_sms_content' => $request->buyer_sms_content,
        'buyer_sms_content_de' => $request->buyer_sms_content_de,
        'buyer_sms_content_pl' => $request->buyer_sms_content_pl,
        'buyer_push_content' => $request->buyer_push_content,
        'buyer_push_content_de' => $request->buyer_push_content_de,
        'buyer_push_content_pl' => $request->buyer_push_content_pl,
        'trader_subject' => $request->trader_subject,
        'trader_email_content' => $request->trader_email_content,
        'trader_email_content_de' => $request->trader_email_content_de,
        'trader_email_content_pl' => $request->trader_email_content_pl,
        'trader_sms_content' => $request->trader_sms_content,
        'trader_sms_content_de' => $request->trader_sms_content_de,
        'trader_sms_content_pl' => $request->trader_sms_content_pl,
        'trader_push_content_en' => $request->trader_push_content_en,
        'trader_push_content_de' => $request->trader_push_content_de,
        'trader_push_content_pl' => $request->trader_push_content_pl,
        'whatsapp_content' => '',
        'recipients' => implode(',',$request->roles),
        'roles_content' => json_encode($tableArray),
        'status' => $request->status,
        'buyer_status' => $request->buyer_status,
        'trader_status' => $request->trader_status
      ]);
      return response()->json(['status' => 'success', 'message' => 'Template created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $emailTemplate = EmailTemplate::where(['id' => $id])->first();
      if($emailTemplate)
      {
        $emailTemplate->roles_content = json_decode($emailTemplate->roles_content);
        $data = $emailTemplate;
        $roles = Roles::get();
        return view('backend.email-templates.create',compact('data', 'roles'));
      }
      else
      {
        $msg="Unfortunately this EmailTemplate is not exist!";
        return view('backend.email-templates.index',compact('msg'));
      } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
      $request->validate([
        'title' => 'required'
      ]);
      
      $tableArray = $request->all();

      unset($tableArray['_method']);
      unset($tableArray['_token']);
      unset($tableArray['header_en']);
      unset($tableArray['header_pl']);
      unset($tableArray['header_de']);
      unset($tableArray['footer_en']);
      unset($tableArray['footer_pl']);
      unset($tableArray['footer_de']);
      unset($tableArray['title']);
      unset($tableArray['subject']);
      unset($tableArray['email_content']);
      unset($tableArray['email_content_de']);
      unset($tableArray['email_content_pl']);
      unset($tableArray['sms_content']);
      unset($tableArray['sms_content_de']);
      unset($tableArray['sms_content_pl']);
      unset($tableArray['push_notification_content_en']);
      unset($tableArray['push_notification_content_de']);
      unset($tableArray['push_notification_content_pl']);
      unset($tableArray['push_notification_sound']);
      unset($tableArray['buyer_subject']);
      unset($tableArray['buyer_email_content']);
      unset($tableArray['buyer_email_content_de']);
      unset($tableArray['buyer_email_content_pl']);
      unset($tableArray['buyer_sms_content']);
      unset($tableArray['buyer_sms_content_de']);
      unset($tableArray['buyer_sms_content_pl']);
      unset($tableArray['buyer_push_content']);
      unset($tableArray['buyer_push_content_de']);
      unset($tableArray['buyer_push_content_pl']);
      unset($tableArray['trader_subject']);
      unset($tableArray['trader_email_content']);
      unset($tableArray['trader_email_content_de']);
      unset($tableArray['trader_email_content_pl']);
      unset($tableArray['trader_sms_content']);
      unset($tableArray['trader_sms_content_de']);
      unset($tableArray['trader_sms_content_pl']);
      unset($tableArray['trader_push_content']);
      unset($tableArray['trader_push_content_de']);
      unset($tableArray['trader_push_content_pl']);
      unset($tableArray['whatsapp_content']);
      unset($tableArray['roles']);
      unset($tableArray['status']);
      unset($tableArray['buyer_status']);
      unset($tableArray['trader_status']);
      unset($tableArray['id']);

      $emailTemplate->update([
        'header_en' => $request->header_en,
        'header_pl' => $request->header_pl,
        'header_de' => $request->header_de,
        'footer_en' => $request->footer_en,
        'footer_pl' => $request->footer_pl,
        'footer_de' => $request->footer_de,
        'title' => $request->title,
        'subject' => $request->subject,
        'email_content' => $request->email_content,
        'email_content_de' => $request->email_content_de,
        'email_content_pl' => $request->email_content_pl,
        'sms_content' => $request->sms_content,
        'sms_content_de' => $request->sms_content_de,
        'sms_content_pl' => $request->sms_content_pl,
        'push_content_en' => $request->push_notification_content_en,
        'push_content_de' => $request->push_notification_content_de,
        'push_content_pl' => $request->push_notification_content_pl,
        'buyer_subject' => $request->buyer_subject,
        'buyer_email_content' => $request->buyer_email_content,
        'buyer_email_content_de' => $request->buyer_email_content_de,
        'buyer_email_content_pl' => $request->buyer_email_content_pl,
        'buyer_sms_content' => $request->buyer_sms_content,
        'buyer_sms_content_de' => $request->buyer_sms_content_de,
        'buyer_sms_content_pl' => $request->buyer_sms_content_pl,
        'buyer_push_content' => $request->buyer_push_content,
        'buyer_push_content_de' => $request->buyer_push_content_de,
        'buyer_push_content_pl' => $request->buyer_push_content_pl,
        'trader_subject' => $request->trader_subject,
        'trader_email_content' => $request->trader_email_content,
        'trader_email_content_de' => $request->trader_email_content_de,
        'trader_email_content_pl' => $request->trader_email_content_pl,
        'trader_sms_content' => $request->trader_sms_content,
        'trader_sms_content_de' => $request->trader_sms_content_de,
        'trader_sms_content_pl' => $request->trader_sms_content_pl,
        'trader_push_content' => $request->trader_push_content,
        'trader_push_content_de' => $request->trader_push_content_de,
        'trader_push_content_pl' => $request->trader_push_content_pl,
        'whatsapp_content' => '',
        'recipients' => implode(',',$request->roles),
        'roles_content' => json_encode($tableArray),
        'status' => $request->status,
        'buyer_status' => $request->buyer_status,
        'trader_status' => $request->trader_status,
        'push_sounds' => $request->push_notification_sound
      ]);

      $push= EmailTemplate::find($request->id);
      $push->push_sounds=$request->push_notification_sound;
      $push->save();
    
     return response()->json(['status' => 'success', 'message' => 'Template updated successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function header($id)
    {
      $emailTemplate = EmailTemplateHeaderFooter::where(['id' => $id])->first();
      if($emailTemplate)
      {
        $data = $emailTemplate;
        return view('backend.email-templates.header-footer',compact('data'));
      }
      else
      {
        $msg="Unfortunately this EmailTemplate Header Footer dose not exist!";
        return view('backend.email-templates.index',compact('msg'));
      } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function headerUpdate(Request $request)
    {
      $data = array(
        'header_en' => $request->header_en,
        'header_de' => $request->header_de,
        'header_pl' => $request->header_pl,
        'footer_en' => $request->footer_en,
        'footer_de' => $request->footer_de,
        'footer_pl' => $request->footer_pl,
        'status' => $request->status
      );
      EmailTemplateHeaderFooter::where('id', 1)->update($data);
      return response()->json(['status' => 'success', 'message' => 'Header/Footer updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
      $emailTemplate->delete();
      return response()->json(['success'=>'Template deleted successfully.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function recipients(Request $request)
    {
      $tableArray = $request->email;
      foreach($tableArray as $keys => $values)
      {
        $data = array();
        foreach($values as $key)
        {
          $data[] = $key;
        }
        EmailTemplate::where('id', $keys)->update(['recipients'=> implode(',', $data)]);
      }
      return response()->json(['status' => 'success', 'message' => 'Recipients list updated successfully!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function headerFooter(Request $request)
    {
      EmailTemplate::where('id', $request->id)->update(['global_header'=> $request->status]);
      return response()->json(['status' => 'success', 'message' => 'Header/Footer updated successfully!']);
    }
}
