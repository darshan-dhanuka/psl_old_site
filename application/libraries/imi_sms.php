<?php
/**
 * 
 * Library - Account update ...
 * @author sanjay
 *
 **/
class CI_Imi_Sms
{
	/**
	 * Constructor
	 */
	public function __construct() 
	{
		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
	}
	
	/**
	 * method - to update user game account 
	 */
	function sendSms($sms_info)
	{
		$config_data = $this->CI->config->item('imi_otp');
		
		$rawdata = "{\"outboundSMSMessageRequest\":{".
		"\"address\":[\"tel:91".$sms_info['senderMobile']."\"],".
		"\"senderAddress\":\"tel:".$config_data['senderAddress']."\",".
		"\"outboundSMSTextMessage\":{\"message\":\"".$sms_info['message_content']."\"},".
		"\"clientCorrelator\":\"\",".
		"\"senderName\":\"\"}".
		"}";
		
		$ch = curl_init($config_data['url']);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','key: '.$config_data['key']));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $rawdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		curl_close($ch);
	}
}
?>