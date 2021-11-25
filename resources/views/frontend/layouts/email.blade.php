<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>@yield('title', Settings()->site_name)</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style type="text/css">
  * { -ms-text-size-adjust: 100%; -webkit-text-size-adjust: none; -webkit-text-resize: 100%; text-resize: 100%; }
  a { outline: none; color: #40aceb; text-decoration: underline; }
  a:hover { text-decoration: none !important; }
  .nav a:hover { text-decoration: underline !important; }
  .title a:hover { text-decoration: underline !important; }
  .title-2 a:hover { text-decoration: underline !important; }
  .btn:hover { opacity: 0.8; }
  .btn a:hover { text-decoration: none !important; }
  .btn { -webkit-transition: all 0.3s ease; -moz-transition: all 0.3s ease; -ms-transition: all 0.3s ease; transition: all 0.3s ease; }
  table td { border-collapse: collapse !important; }
  .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div { line-height: inherit; }
  @media only screen and (max-width:500px) {
    table[class="flexible"] { width: 100% !important; }
    table[class="center"] { float: none !important; margin: 0 auto !important; }
    *[class="hide"] { display: none !important; width: 0 !important; height: 0 !important; padding: 0 !important; font-size: 0 !important; line-height: 0 !important; }
    td[class="img-flex"] img { width: 100% !important; height: auto !important; }
    td[class="aligncenter"] { text-align: center !important; }
    th[class="flex"] { display: block !important; width: 100% !important; }
    td[class="wrapper"] { padding: 0 !important; }
    td[class="holder"] { padding: 30px 15px 20px !important; }
    td[class="nav"] { padding: 20px 0 0 !important; text-align: center !important; }
    td[class="h-auto"] { height: auto !important; }
    td[class="description"] { padding: 30px 20px !important; }
    td[class="i-120"] img { width: 120px !important; height: auto !important; }
    td[class="footer"] { padding: 5px 20px 20px !important; }
    td[class="footer"] td[class="aligncenter"] { line-height: 25px !important; padding: 20px 0 0 !important; }
    tr[class="table-holder"] { display: table !important; width: 100% !important; }
    th[class="thead"] { display: table-header-group !important; width: 100% !important; }
    th[class="tfoot"] { display: table-footer-group !important; width: 100% !important; }
  }
</style>
</head>
<body style="margin:0; padding:0;" bgcolor="#eaeced">
  <table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
    <!-- fix for gmail -->
    <tr>
      <td class="hide"><table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
        <tr>
          <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="wrapper" style="padding:0 10px;">

        <table data-module="module-2" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td data-bgcolor="bg-module" bgcolor="#eaeced"><table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
              <tr>
                <td class="img-flex"><table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td width="40%" class="logo" style="text-align: left;"><h1><a href="{{ url('/') }}"><img src="{{ url('img/email-logo.png') }}" alt="{{ Settings()->site_name }}" style="width: 150px; max-width: 150px; height: auto; display: block;"></a></h1></td>
                    <td width="60%" class="logo" style="text-align: right;" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;">
                      <a href="{{ url('/') }}" style="font:16px/25px Arial, Helvetica, sans-serif; color:#333;text-decoration:none;">Home</a> &nbsp; &nbsp;/&nbsp; &nbsp;
                      <a href="{{ url('/contact') }} " style="font:16px/25px Arial, Helvetica, sans-serif; color:#333;text-decoration:none;">Contact</a>
                    </td>
                  </tr>
                </table></td>
              </tr>

              <tr>
                <td class="img-flex"><img src="{{ url('img/email-headers/bg_1.jpg') }}" style="vertical-align:top;" width="600" height="auto" alt="" /></td>
              </tr>
              <tr>
                <td data-bgcolor="bg-block" class="holder" style="padding:40px;" bgcolor="#f9f9f9"><table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="left" style="font:24px/28px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 10px;">@yield('title', Settings()->site_name)</td>
                  </tr>
                  <tr><td style="height:0px; border-bottom:1px solid #d9d9d9"></td></tr>
                  <tr><td style="padding:10px 0 10px;"></td></tr>
                  <tr>
                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/25px Arial, Helvetica, sans-serif; color:#333; padding:0 0 23px;">
                      @yield('content')
                    </td>
                  </tr>
                  <tr>
                    <td valign="middle" class="bg_black footer email-section">
                      <table width="100%" style="font:14px/20px Arial, Helvetica, sans-serif; color:#333; font-weight:bold">
                          <tr><td colspan="2" style="height:0px; border-bottom:1px solid #d9d9d9;"></td></tr>
                          <tr><td colspan="2" style="padding:10px 0 10px;"></td></tr>
                          <tr>
                              <td valign="top">{!! Settings()->address !!}</td>
                              <td valign="top"><a href="tel:{{ Settings()->phone }}"><img src="{{ url('img/phone-icon.png') }}" style="vertical-align:top;" width="20" height="20" alt="Phone" /> {{ Settings()->phone }}</a><br /><a href="mailto:{{ Settings()->email }}"><img src="{{ url('img/email-icon.png') }}" style="vertical-align:top;" width="20" height="20" alt="Email" /> {{ Settings()->email }}</a></td>
                          </tr>
                      </table>
                    </td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="20"></td>
            </tr>
          </table>

          <table data-module="module-7" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td data-bgcolor="bg-module" bgcolor="#eaeced"><table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="footer" style="padding:0 0 10px;"><table width="100%" cellpadding="0" cellspacing="0">
                    <tr class="table-holder">
                      <th class="tfoot" width="400" align="left" style="vertical-align:top; padding:0;"> <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td data-color="text" data-link-color="link text color" data-link-style="text-decoration:underline; color:#797c82;" class="aligncenter" style="font:12px/16px Arial, Helvetica, sans-serif; color:#797c82; padding:0 0 10px;">Copyright © {{date('Y')}} <a style="color: #333;" href="{{ url('/') }}">{{ Settings()->site_name }}</a>. All rights Reserved.</td>
                        </tr>
                      </table>
                    </th>
                    <th class="thead" width="200" align="right" style="font:12px/16px Arial, Helvetica, sans-serif; color:#797c82; padding:0 0 10px;">
                      @php $url =  url('unsubscribe', @$uuid) ; @endphp 
                      <a href="{{ $url }}" style="color: #333;">Unsubscribe</a>
                    </th>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <!-- fix for gmail -->
      <tr>
        <td style="line-height:0;"><div style="display:none; white-space:nowrap; font:15px/1px courier;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
      </tr>
    </table>
  </body>
  </html>
