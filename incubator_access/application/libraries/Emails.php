<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emails {

    var $live_url = "";
    var $appName = "";

    public function __construct() {
        $this->CI = &get_instance();
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'hjph3hive';
        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['smtp_port'] = 10025;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->set_crlf("\r\n");
        $this->CI->email->set_newline("\r\n");
        $this->CI->load->helper('url');
        $this->live_url = $this->CI->config->item('live_base_url');
        $this->appName = $this->CI->config->item('appName');
        $this->supportEmail = $this->CI->config->item('supportEmail');
        $this->fromName = $this->CI->config->item('fromName');
    }

    public function sendMailDetails($to,$cc='',$bcc='',$subject,$msg){
        $this->CI->email->set_mailtype("html");
        $this->CI->email->from($this->supportEmail, $this->fromName);
        $this->CI->email->to($to);
        if (!empty($cc))
            $this->CI->email->cc($cc);
        if (!empty($bcc))
            $this->CI->email->bcc($bcc);
        $this->CI->email->subject($subject);
        $this->CI->email->message($this->mailFormat($msg));
        return $this->CI->email->send();
    }

    public function mailFormat($message) {
        $mainTemp = $this->mailFormatHTML();

        $mainTemp = str_replace("{appName}", $this->CI->config->item('appName'), $mainTemp);
        $mainTemp = str_replace("{{mainMailBody}}", $message, $mainTemp);
        return $mainTemp;
    }

    public function mailFormatHTML() {
        
        $mailFormat = '<!DOCTYPE html>
				<head >
				    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
				    <META NAME="referrer" CONTENT="no-referrer">
				    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
				    <title>{appName} Approve Party Request</title>
				    <style type="text/css">
				    body {
				        width: 100% !important;
				        -webkit-text-size-adjust: 100%;
				        -ms-text-size-adjust: 100%;
				        margin: 0;
				        padding: 0;
						
				    }
				    html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
				    a { color:#8fdb00!important; }
				    @media only screen and (max-device-width: 680px), only screen and (max-width: 680px) { 
				    *[class="table_width_100"] {
				        width: 96% !important;
				    }
				    *[class="border-right_mob"] {
				        border-right: 1px solid #dddddd;
				    }
				    *[class="mob_100"] {
				        width: 100% !important;
				    }
				    *[class="mob_center"] {
				        text-align: center !important;
				    }
				    *[class="mob_center_bl"] {
				        float: none !important;
				        display: block !important;
				        margin: 0px auto;
				    }   
				    .iage_footer a {
				        text-decoration: none;
				        color: #929ca8;
				    }
				    img.mob_display_none {
				        width: 0px !important;
				        height: 0px !important;
				        display: none !important;
				    }
				    img.mob_width_50 {
				        width: 40% !important;
				        height: auto !important;
				    }
				   
				    #outlook a {
				        padding: 0;
				    }
				    .notification .mail-table a{
				    	color:#8fdb00;
				    }



				    .body{ font-family:"Proxima Nova Regular", Helvetica, Arial, sans-serif; font-size:16px; color:#102429; line-height:24px; padding-top:20px; padding-bottom:25px; }
				      
				        #backgroundTable {
				            margin: 0;
				            padding: 0;
				            width: 100% !important;
				            line-height: 100% !important;
				        }

				        table {
				            border-collapse: collapse;
				            mso-table-lspace: 0pt;
				            mso-table-rspace: 0pt;
				            table-layout: fixed;
				        }

				        table table {
				            table-layout: auto;
				        }
				        /* End reset */

				        div.preheader {
				            display: none !important;
				        }

				        table td {
				            border-collapse: collapse;
				        }

				        #outertable {
				            width: 825px;
				        }

				        #footer_menu{
				            margin-left:38%;
				        }
				    }

				   </style>
				</head>
				<body>
				<div id="mailsub" class="notification" align="center">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width:125px;">    <tr>
				    <td align="center" style="padding-top: 41px;">
				        <table  border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
				        <tr style="">
				            <td  style="background: #2A2A2B;box-shadow: 0 8px 6px -6px black;">
				                <div style="height: 20px;"> </div>
				                <table width="90%" border="0" cellspacing="0" cellpadding="0" >
				                    <tr>
				                        <td width="5%" align="left">
				                            &nbsp;&nbsp;&nbsp;
				                        </td>
				                        <td align="left" style="position: relative; top: 10px; right: 35px;" >
				                        	<img src="' . base_url() . "images/logo.png" . '" alt="KPIT SPARKLE" style="height:25px">
				                        </td>
										<td align="right" style="position: relative; top: 10px; right: 35px;" >
				                        	<img src="' . base_url() . "images/kpitlogo.png" . '" alt="KPIT SPARKLE" style="height:50px">
				                        </td>
				                    </tr>
				                </table>
				            </td>
				        </tr>
				        <tr bgcolor="#2A2A2B">
				            <td>
				                <div style="height: 20px; border-bottom:5px solid #212121;margin-top: -14px;"> </div>
				            </td>
				        </tr>
				        <tr>
				            <td align="center" bgcolor="#2A2A2B" style="background: #2A2A2B;">
				                <table class="mail-table"  cellspacing="0" cellpadding="0">
				                    <tr><td height="18" bgcolor="#2A2A2B">&nbsp;</td></tr>
				                    <tr>
				                        <td width="9%" height="18" bgcolor="#2A2A2B">&nbsp;</td>
				                        <td class="body bd" bgcolor="#2A2A2B" style="color: #ffffff;">
				                            <multiline>
				                            {{mainMailBody}}
				                            </multiline><br>
				                            <multiline>
				                            <p>Best Regards,<br>
				                            The {appName}</p>
				                            </multiline>
				                        </td>
				                        <td width="9%" bgcolor="#2A2A2B">&nbsp;</td>
				                    </tr>
				                </table>     
				            </td>
				        </tr>
				        <tr bgcolor="#2A2A2B">
				            <td width="100%">
				                <div style="border-bottom:5px solid #212121;"></div>
				            </td>
				        </tr>';
//                $mailFormat .= '<tr class="bd" style="font-family:Arial, Helvetica, sans-serif;font-size:13px">
//
//				            <td bgcolor="#ffffff">
//				            
//				            <table class="bd1" style="border-collapse: collapse;">
//
//				            <tr bgcolor="#2A2A2B">
//				                <td width="9%" height="18" bgcolor="#2A2A2B">&nbsp;</td>
//				            <td>
//				                <div style="height: 10px; line-height: 80px; font-size: 10px;"> </div>
//                                                ';
        
//        $mailFormat .= "<span align='right' style='float: right;'>
//                            <a href='https://www.facebook.com/KPITSparkle/' target='_blank'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADtSURBVHgB7ZS9CoJQGIY/RVDIhEgxqCmb6w6cuoOm7qD2LkNorL0LaK+tra1aGpqlJGqwBjWxOCcMjwR61KGhdzkf5+fh/X44zPgATyhQLBSswoEcUGo9q8B+IYJtvZ/W2w70jGM24GpShc1cIvZuFpfNoX3iCBhfCoAXAyirj4zAiBNJ9aE/NTE0rtRNiQKRq28wKmBaMUmDvTQUXD9U/NAlqp3c9HCsaB7ow8vnfmINza1ApIvk3lkwdwKOpZpPnOVOWaLtcnd0xityhIYaSdZc0AdXHCstjw7Y6Dh4jaaNOhzux/X7n8MfmF8vSa5GVyy1AHYAAAAASUVORK5CYII=' style='height:15px; padding: 15px;'></a>
//                            <a href='https://twitter.com/KPITSparkle' target='_blank'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAGxSURBVHgBrVW9T8JQEL/WhiJfaoQQA4YgiyQG3Egc3NTFRVzFuPoHsOsMu3EzYYfFyTqZYKITuDDBogQJGgkpQomC7y6BUGkLKL+kfa/v3v3e3buPcn6/vwczBA8zhoAv0doFpTme2xNuQeSoDt5wm/YXsxZ4TC1BoyqQTJHngEOXo4kK3CZdJNDD2tYn7J9VR9YHOuziro5XgXe4v+jEaLICONfD9um75jrq4FMrmuhQflhwknqGSOxjRMkTahkehug056B0bwEBTUZ2V6BDgkisDsFdGV7yZshlHPBWFGESSEknjdz6hq/nZGSHzGU94KFGFioyD5dRH8150daFnXjNMCDj3B3WJZcxbZD4r8Ar64OCIrGU+Q/K+Xk1IUZHSrA8fBVgWqBOQbKpCRGi/ZuFCKZGQbKrvgeEpayVsn1a6x5Si9qEGJx0fAUKN7ZJ+Wj/b6guDUnvLpap8DcPGrpEmHe4TyvVBGdAgQ7rEjh6Q20I7smURnpAN6/P3ayCTJpyAcmwfrHcjIBW5TILkEs7DFsd1+/YaJWHdR0Xs9Q+VBlYy5i45SczTAJu1r+AHxm7qJan+rvZAAAAAElFTkSuQmCC' alt='KPIT SPARKLE' style='height:15px; padding: 15px;'></a>
//                            <a href='https://www.instagram.com/kpitsparkle/' target='_blank'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHpSURBVHgBnVQ9TwJBFHxcCBhAPqIEE2xQGxqlM7Gwg8YKehNben4A1tj7AzCxw8oGOhM1dFjRII0aJWCUDw0gQXce3HmavfPOSa64u93Z2Zn3niMWi33SHPHUgOLJPoU3xuT2Tukv3N8sUL3io3p5UfvmAKE/MqG9fIvC62Ne1Ll10ehNMSXDgdGtIe9pi/Xn+Qj1Ws4Z4UHxjhdUCmFqXnvIDuLJAe1mn5nsNBslBdeEwovjJVtkazvvBCH+lQ+qHIVZaTzVF4TCM9ULe8r6LATEzSsPc0Ctc1X4UCv55ZvmIWENAK9qZ34OoXoSEgkQNS+9/K/TdM0I8SILAL4k0j0+GQdiDTYkcx2+HixCECpGA4XcvumMUKYMZNViSDxB7Tvet/dfxfPCavXlokJaG4l0l3pPzh9k36RBzS8ZpIS4kllI8Ev11RIhYNYp8MsI0j/wZ1moNAI8xhrLhDAbV4L5v4FvqL9aKSAllKaMWkMHIFGoqZd9bAFUz+o2YOixk+tH4hfqrN1wUyLTZWIA6aLfZWSoQSY084tHk8WWjG4O+UBF9Qs9+V/AFi41waVAAVQmc22eFnYBITy+RCOASxuwmcKjCGLC5A9CupUBq4bUbogBe6gbsJp00U5QadQFeiBMtZ/1Pn8BNqD3xm1XKUsAAAAASUVORK5CYII=' alt='KPIT SPARKLE' style='height:15px; padding: 15px;'></a>
//                            <a href='https://www.youtube.com/watch?v=hldT98WSSZ' target='_blank'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAEiSURBVHgBzZQ/a8JAGMafHKGWNmYpkpa2Q9opk90KXUs6dSkdC36Kdu/uB3D1C6i72RycxcFMugmKDmr8j6h5TxQHEyO8g78hOcjlx+XJc6eYprkCIwLMsAtVutwnJ7DsIRLPc8S0pXxA99j18uBLs5HAbLhZy6ClyrHrxNEoX0F5/zFWn/9tcJD7u4OwbA9ckEvotwtw8ZCcQmwzC8JJJ2ROURG6Eb5C19GQTT2ilLk5KiZX5NpUCjryfuhuUQudd1IPqR5UmTAih/Py1cdrqhfYzZ1w0FYRliOV3v7t4ljWBLlU2XgjeNJ3uoWokEt06xfgwvNbIGrFOLggl0Ln4dPbGNaHJwPf7hwaB5V+/2/TuON/pevLmtXLjRCMnP8BuwaboWCCIL/ruAAAAABJRU5ErkJggg==' alt='KPIT SPARKLE' style='height:15px; padding: 15px;'></a>
//                            </span>";
//        $mailFormat .= '<div style="height: 50px; line-height: 80px; font-size: 10px;"> </div>
//				            </td>
//				                <td width="9%" height="18" bgcolor="#2A2A2B">&nbsp;</td>
//				            </tr>  
//							    
//				        </table>
//				    </td>
//				    </tr>
//				    <tr>
//				        <td>
//				            <div style="height: 50px; line-height: 80px; font-size: 10px;"> </div> 
//				        </td>
//				    </tr>
//				</table>
//				<!--[if gte mso 10]>
//				</td></tr>';
        $mailFormat .= '</table>
				</td></tr>
				</table>
				</div> 
				</body>
				</html>';
        return $mailFormat;
    }

}
