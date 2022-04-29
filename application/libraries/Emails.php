<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Emails
	{
		var $live_url="";
		var $appName="";
		public function __construct(){
		
			//parent::__construct();
			$this->CI = &get_instance();
			$this->CI->load->library('email');
			//$this->CI->load->library('textlocal');
			$this->CI->load->helper('url');
			$this->live_url = $this->CI->config->item('live_base_url');
			$this->appName = $this->CI->config->item('appName');
			$this->supportEmail = $this->CI->config->item('supportEmail');
			$this->fromName = $this->CI->config->item('fromName');
		}
		public function sendMailDetails($to,$cc='',$bcc='',$subject,$msg){

			
			$this->CI->email->set_mailtype("html");
			$this->CI->email->from($this->supportEmail,$this->fromName);
			$this->CI->email->to($to);
			
			if(!empty($cc))
			$this->CI->email->cc($cc);

			if(!empty($bcc))
			$this->CI->email->bcc($bcc);

			$this->CI->email->subject($subject);
			$this->CI->email->message($this->mailFormat($msg));
			return $this->CI->email->send();
			
		}
	public function mailFormat($message)
	{
		$mainTemp = $this->mailFormatHTML();
		
		$mainTemp = str_replace("{appName}",$this->CI->config->item('appName'),$mainTemp);
		$mainTemp = str_replace("{{mainMailBody}}",$message,$mainTemp);
		return $mainTemp;
		
	}
	public function mailFormatHTML()
	{
		return $mailFormat='<!DOCTYPE html>
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
				                        	<img src="'.base_url()."images/logo.png".'" alt="KPIT SPARKLE" style="height:25px">
				                        </td>
										<td align="right" style="position: relative; top: 10px; right: 35px;" >
				                        	<img src="'.base_url()."images/kpitlogo.png".'" alt="KPIT SPARKLE" style="height:50px">
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
				        <tr bgcolor="##2A2A2B">
				            <td width="100%">
				                <div style="border-bottom:5px solid #212121;"> </div>
				            </td>
				        </tr>
				        <tr class="bd" style="font-family:Arial, Helvetica, sans-serif;font-size:13px">

				            <td bgcolor="#ffffff">
				            
				            <table class="bd1" style="border-collapse: collapse;">

				            <tr bgcolor="#2A2A2B">
				                <td width="9%" height="18" bgcolor="#2A2A2B">&nbsp;</td>
				            <td>
				                <span style="text-align:center;display:block;text-decoration:none; color:#fff !important;line-height:18px;margin-top: 17px;">DO NOT REPLY TO THIS MESSAGE. If you`ve received this message in error, please ignore. For support, please use the Contact Us on the website for more information.</span>
				                <div style="height: 10px; line-height: 80px; font-size: 10px;"> </div> 
				                <span  style="font-size: 13px;">
				                   <a href="" style="text-align:center;display:block;text-decoration:none;color:#fff !important;margin-top: 10px;"> www.{appName}.com. Copyright &copy; 2018 {appName}.com All rights reserved</a><br><br><br>
								   <span align="left">KPITSparkle2021@kpit.com</span>
								   <span align="right" style="float: right;">
								   		<img src="'.base_url()."images/Facebook.png".'" alt="KPIT SPARKLE" style="height:15px; padding: 15px;">
										<img src="'.base_url()."images/Twitter.png".'" alt="KPIT SPARKLE" style="height:15px; padding: 15px;">
										<img src="'.base_url()."images/Instagram.png".'" alt="KPIT SPARKLE" style="height:15px; padding: 15px;">
										<img src="'.base_url()."images/Youtube.png".'" alt="KPIT SPARKLE" style="height:15px; padding: 15px;">
									</span>
				                   <div style="height: 50px; line-height: 80px; font-size: 10px;"> </div> 
				                </span>
								<div>
								</div>
				            </td>
				                <td width="9%" height="18" bgcolor="#2A2A2B">&nbsp;</td>
				            </tr>  
							    
				        </table>
				    </td>
				    </tr>
				    <tr>
				        <td>
				            <div style="height: 50px; line-height: 80px; font-size: 10px;"> </div> 
				        </td>
				    </tr>
				</table>
				<!--[if gte mso 10]>
				</td></tr>
				</table>
				<![endif]-->
				</td></tr>
				</table>
				</div> 
				</body>
				</html>';
	}
		
		
	}
	