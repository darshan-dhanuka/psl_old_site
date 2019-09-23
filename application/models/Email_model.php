<?php
/**
 * 
 * Model class for Email sending...
 * @author
 *
 **/
class Email_model extends CI_Model
{
    var $sender_email = '';

    //user account admin email info
    var $cp_acc_admin_name = 'PSL Admin';
    //var $cp_acc_admin_email = 'testone12332@gmail.com';
    //var $cp_acc_admin_passwd = '!test123456789';
	var $cp_acc_admin_email = 'no_reply@pokersportsleague.com';
    var $cp_acc_admin_passwd = 'Gauss?123';
    /**
	 * Constructor
	 */
    public function __construct()
    {
        parent::__construct();
    }

    /**	
	 * method to load the Email library with required config parameters
	 */
    public function configEmailLib($sender_email, $sender_passwd)
    {
        $this->sender_email = $sender_email;

        $config = array(
             'protocol' => "smtp",
             'smtp_host' => "ssl://smtp.gmail.com",
             'smtp_port' => "465",
             'smtp_user' => $sender_email,
             'smtp_pass' => $sender_passwd,
             'newline' => "\r\n",
             'mailtype' => "html",
             'charset' => "utf-8"
         );

         $this->load->library('email');
         $this->email->initialize($config);

    	/*$config = array(
    			'protocol' => "smtp",
    			'smtp_host' => "ssl://email-smtp.us-west-2.amazonaws.com",
    			'smtp_port' => "465",
    			'smtp_user' => 'AKIAIEH7Q423YYYZBKSA',
    			'smtp_pass' => 'AoywHkbzp3FbL/hnaEkp7ajOJ/JYws1puCIIbGsONKpU',
    			'newline' => "\r\n",
    			'mailtype' => "html",
    			'charset' => "utf-8"
    	);
    	
    	$this->load->library('email');
    	$this->email->initialize($config);
    	$this->email->clear(TRUE);*/
    }

    /**	
	 * method to send email
	 */
	public function sendMail($sender_name, $reciever_email, $subject, $message, $attachment='', $cc_email = '')
	{
// 		$this->email->from($this->sender_email, $sender_name);
// 		$this->email->to($reciever_email);
        
//         if($cc_email != '')
//             $this->email->cc($cc_email);
        
// 		$this->email->subject($subject);
// 		$this->email->message($message);

//         if(!empty($attachment))
//             $this->email->attach($attachment);
//         if($this->email->send())
//             return TRUE;
//         else
//             return FALSE;
			$this->email->from($this->sender_email, $sender_name);
			$this->email->to($reciever_email);
			if($cc_email != '')
			$this->email->cc($cc_email);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!empty($attachment))
				$this->email->attach($attachment);
		
			if($this->email->send()){
				return TRUE;
			}
			else{
				return FALSE;
			}
    }

}
?>