<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('user_model','email_model','team_model','qualifier_model', 'cms_model','owner_model','mentor_model'));
		$this->acc_admin_name = $this->email_model->cp_acc_admin_name;
		$this->acc_admin_email = $this->email_model->cp_acc_admin_email;
		$this->acc_admin_passwd = $this->email_model->cp_acc_admin_passwd;
		$this->response = '';
        $this->success  = TRUE;	

        $this->message = '';
        $this->subject = '';
        $this->playermessage = '';
        $this->playersubject = '';

        $this->filesize = true;
        $this->minentry = true;
        $this->fileupload = true;
        $this->file_name = '';
        $this->error_msg = '';
    }

	/**
	 * method to check if the Username is entered
	 */

	public function login()
	{
		$data['error'] = '';
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
	        if ($this->session->checkLogin() == TRUE) {
	            redirect('/');
	        }

            if(filter_var($this->input->post('username'), FILTER_VALIDATE_EMAIL))
                $user_info = $this->user_model->getUserEmailInfo($this->input->post('username'));
            else
                $user_info = $this->user_model->getUsernameInfo($this->input->post('username'));

            if( ! empty($user_info))
            {
                // check user sha512(password) entered and compare to db
                $userHashPassword = hash('sha256',$this->input->post('password'));

                if($userHashPassword == $user_info['password'])
                {
                    $session_userinfo = array('username' => $user_info['user_name'],
                        'user_id' => $user_info['user_id'],
                        'email' => $user_info['email'],
                        'status' => $user_info['status'],
                        'first_name' => $user_info['first_name']
                    );
                    $this->session->set_userdata ( $session_userinfo );
                    $userinfo = $this->user_model->getProPlayerInfo($user_info['user_id']);
                    // if($userinfo['status'] == 1)
                    //     redirect('/');
                    // else if(isset($_GET['redirect']) && $_GET['redirect'] =="schedule/live-qualifier")
                    //     redirect($_GET['redirect']);
                    // else    
                    //     redirect('/pro-player-registration');

                    if(isset($_GET['redirect']) && $_GET['redirect'] =="schedule/live-qualifier")
                        redirect($_GET['redirect']);
                    else if(isset($_GET['create_team']))
                    	redirect('/fantasy-poker/create-your-team');
                    else
                    	redirect('/my-account');
                }
                else
                   $data['error'] = 'The username or password you entered is Invalid.'; 
            }
            else
            	$data['error'] = 'The username or password you entered is Invalid.';
		}
		else if ($this->session->checkLogin() == TRUE) {
			redirect($_SERVER['HTTP_REFERER']);
		}
		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
			foreach($home as $row)
			{
				$data['homeContent'][$row['key']] = $row['value'];
			}
		$this->load->view('login',$data);
	}

    /**
     * method to check if the Username is entered
     */
    public function registration()
    {
        if (!empty($this->session->userdata('user_id'))) {
            redirect('/');
        }

        if ($this->input->server ('REQUEST_METHOD') === 'POST' && $this->input->post('verify')==  1){
            if($this->validateUserinfo()) {
                $otp = mt_rand(100000, 999999);
                $mobile = trim($this->input->post('mobile'));

                if ($this->user_model->getRequestMobileVerification($mobile))
                    $this->user_model->updateRequestMobileVerification(array('otp' => $otp), $mobile);
                else {
                    $verification_info = array('mobile' => $mobile, 'otp' => $otp);
                    $this->user_model->addRequestMobileVerification($verification_info);
                }

                $this->user_model->sendOtp($mobile,$otp);

                $user_info = array('user_name' => trim($this->input->post('username')),
                    'email' => trim($this->input->post('email')),
                    'password' => hash('sha256', trim($this->input->post('password'))),
                    'activation_code' => $activation_code,
                    'dob' => trim($this->input->post('dob')),
                    'gender' => trim($this->input->post('gender')),
                    'first_name' => trim($this->input->post('first_name')),
                    'last_name' => trim($this->input->post('last_name')),
                    'gender' => trim($this->input->post('gender')),
                    'city' => trim($this->input->post('city')),
                    'state' => trim($this->input->post('state')),
                    'address1' => trim($this->input->post('address1')),
                    'address2' => trim($this->input->post('address2')),
                    'mobile' => trim($this->input->post('mobile')),
                    'created' => date('Y-m-d H:i:s'),
                );
                $this->session->set_userdata($user_info);
                redirect('/otp-registration');
            }
        }
        $home = $this->cms_model->getHomeData();
        $data['homeContent'] = array();
        if($home)
        foreach($home as $row)
        {
            $data['homeContent'][$row['key']] = $row['value'];
        }
        $this->load->view('registration',$data);
    }

    public function otpRegistration()
    {
    	
        if ($this->input->server ('REQUEST_METHOD') === 'POST')
        {
            $user_info = $this->session->userdata($user_info);

            if(empty($user_info))
                redirect('/register');

            if($this->user_model->checkMobileOtp($user_info['mobile'],$this->input->post('otp'))) {
                $dob = date("Y-m-d", strtotime($user_info['dob']));
                $activation_code = $this->user_model->activationCode();
                $user_info = array('user_name' => trim($user_info['user_name']),
                    'email' => trim($user_info['email']),
                    'password' => trim($user_info['password']),
                    'activation_code' => $activation_code,
                    'dob' => $dob,
                    'gender' => trim($user_info['gender']),
                    'first_name' => trim($user_info['first_name']),
                    'last_name' => trim($user_info['last_name']),
                    'city' => trim($user_info['city']),
                    'state' => trim($user_info['state']),
                    'address1' => trim($user_info['address1']),
                    'address2' => trim($user_info['address2']),
                    'mobile' => trim($user_info['mobile']),
                    'created' => date('Y-m-d H:i:s'),
                );
                if ($this->user_model->userSignUp($user_info)) {
                    $user_info = $this->user_model->getUsernameInfo($user_info['user_name']);
                    // destroy user data session
                    $this->session->unset_userdata($user_info);
                    // update user mobile verfied
                    $this->user_model->updateRequestMobileVerification(array('verified' => 1,'user_id' => $user_info['user_id']), $user_info['mobile']);
                    $this->sendActivationLink($user_info, $activation_code);
                    redirect('/thankyou');
                }
            }
            else
                $data['msg'] = 'Please enter valid otp';
        }
        $home = $this->cms_model->getHomeData();
        $data['homeContent'] = array();
        if($home)
        foreach($home as $row)
        {
            $data['homeContent'][$row['key']] = $row['value'];
        }
        $this->load->view('otp_registration',$data);
    }

    public function resendOtp()
    {
        $user_info = $this->session->userdata($user_info);
        if(empty($user_info))
            redirect('/register');

        $otp = mt_rand(100000,999999);
        if($this->user_model->getRequestMobileVerification($user_info['mobile'])){
            $this->user_model->updateRequestMobileVerification(array('otp' => $otp), $user_info['mobile']);
        }
        else {
            $verification_info = array('mobile' => $user_info['mobile'], 'otp' => $otp);
            $this->user_model->addRequestMobileVerification($verification_info);
        }
        $this->user_model->sendOtp($user_info['mobile'],$otp);
        redirect('/otp-registration');
    }

	/**
	 * method to check if the Username is entered
	 */
	public function validateUserinfo()
	{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_requiredUsername|min_length[3]|max_length[20]|alpha_numeric|callback_checkUsername|callback_checkUsernameDigit');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_requiredEmail|valid_email|callback_checkEmailId');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_requiredPassword|min_length[8]|alpha_numeric');

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

			$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|callback_checkUserAge');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('address1', 'Address1', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('terms', 'Terms of Use', 'required');
			
			$this->form_validation->set_rules('mobile', 'Mobile','trim|required|min_length[10]|callback_checkMobileDigit|callback_checkMobileVerification');


			if ($this->form_validation->run() == FALSE)
				return FALSE;
			else
				return TRUE;
	}

    public function checkUserAge()
    {
    	$dob = $this->input->post('dob');
        $age = $dob?(date('Y') - date('Y',strtotime($dob))):0;
        if(trim($dob)=='')
    	{
    		$this->form_validation->set_message('checkUserAge', 'The Date of Birth field is required.');
            return FALSE;
    	}
        elseif($age <21)
        {
            $this->form_validation->set_message('checkUserAge', 'Age restriction of 21 yrs');
            return FALSE;
        }
        else
            return TRUE;
    }


	/**
	 * method to check if the Username is entered
	 */
	public function requiredUsername()
	{
		if(trim($this->input->post('username')) == 'Username')
		{
			$this->form_validation->set_message('requiredUsername', 'This field is required.');
			return FALSE;
		}
		else
			return TRUE;
	}

    /**
	 * method to check if the username entered is unique
	 */
    public function checkUsername()
    {
        if( ! $this->user_model->checkUsername(trim($this->input->post('username'))))
        {
            $this->form_validation->set_message('checkUsername', '%s  already registered');
            return FALSE;
        }
        else
            return TRUE;
    }

	/**
	 * method to check if the username entered only digit
	 */
	public function checkUsernameDigit()
	{
		$flag = ctype_digit(trim($this->input->post('username')));

		if($flag)
		{
			$this->form_validation->set_message('checkUsernameDigit', 'Please enter only alphanumeric characters.');
			return FALSE;
		}
		else
			return TRUE;
	}

	/**
	 * method to check if the Email is entered
	 */
	public function requiredEmail()
	{
		if(trim($this->input->post('email')) == 'Email')
		{
			$this->form_validation->set_message('requiredEmail', 'This field is required.');
			return FALSE;
		}
		else
			return TRUE;
	}

	/**
	 * method to check if the email id entered is unique
	 */
	public function checkEmailId()
	{
		$result = $this->user_model->checkEmailId(trim($this->input->post('email')));
		if($result == -1)
		{
			$this->form_validation->set_message('checkEmailId', '%s already registered');
			return FALSE;
		}
		else if($result == 1)
		{
			$this->form_validation->set_message('checkEmailId', '%s already exists. Please use FB login for this email.');
			return FALSE;
		}
		else if($result == 0)
			return TRUE;
	}

	/**
	 * method to check if the Password is entered
	 */
	public function requiredPassword()
	{
		if(trim($this->input->post('reg_password')) == 'Password')
		{
			$this->form_validation->set_message('requiredPassword', 'This field is required.');
			return FALSE;
		}
		else
			return TRUE;
	}

	/**
	 * method to check if the username entered only digit
	 */
	public function checkMobileDigit()
	{
		$flag = ctype_digit(trim($this->input->post('mobile')));

		if(!$flag)
		{
			$this->form_validation->set_message('checkMobileDigit', 'Please enter only numeric values.');
			return FALSE;
		}
		else
			return TRUE;
	}

    /**
     * method to check if the username entered only digit
     */
    public function checkMobileVerification()
    {
        $flag = $this->user_model->checkMobileVerifiedStatus(trim($this->input->post('mobile')));

        if($flag)
        {
            $this->form_validation->set_message('checkMobileVerification', 'This mobile associated to other user please enter other mobile .');
            return FALSE;
        }
        else
            return TRUE;
    }

	 /** method to check if the username entered only digit
	 */
	public function about()
	{
		$this->load->view('about');
	}

	/**
	 * method to check if the username entered only digit
	 */
	public function blog()
	{
		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
			foreach($home as $row)
			{
				$data['homeContent'][$row['key']] = $row['value'];
			}
		$this->load->view('comming-soon',$data);
	}

	/**
	 * method to check if the username entered only digit
	 */
	public function teams()
	{
		$res=NULL;
		$res=$this->team_model->getTeamOwnerMentorDetail();
			for($i=0;$i<sizeof($res);$i++)
			{
				$a=$this->owner_model->getTeamOwner($res[$i]['id']);
				if($a){
					$res[$i]['team_owner']=$a;
				}
			}
		$data['team_details']=$res;

		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
		foreach($home as $row)
		{
			$data['homeContent'][$row['key']] = $row['value'];
		}
		$this->load->view('team',$data);
	}
    public function delhi_panthers()
    {
        $this->load->view('delhi_panthers');
    }
    public function teamPage()
    {
    	
    	$url=$this->uri->segment(2);
    	$team_id=$this->team_model->getTeamIdByUrl($url);
    	if($team_id){
    		$home = $this->cms_model->getHomeData();
    		$data['homeContent'] = array();
    		if($home)
    			foreach($home as $row)
    			{
    				$data['homeContent'][$row['key']] = $row['value'];
    			}
	    	$data['team_details']=$this->team_model->getTeamInfo($team_id);
	    	$data['team_owner']=$this->owner_model->getTeamOwner($team_id);
	    	$data['team_mentor']=$this->mentor_model->getTeamMentor($team_id,'mentor');
	    	$data['team_pro']=$this->mentor_model->getTeamMentor($team_id,'pro');
	    	$data['team_wildcard']=$this->mentor_model->getTeamMentor($team_id,'Wildcard');
	   		$status="1";
	   		$cat_id="1";// for online qualifier
	   		$data['team_live_qualifier']=$this->qualifier_model->getQualifiers($status,$cat_id,$team_id);
	   		$status="1";
	   		$cat_id="2";// for live qualifier
	   		$data['team_online_qualifier']=$this->qualifier_model->getQualifiers($status,$cat_id,$team_id);
	   		$data['team_region']=$this->team_model->getAllRegion($data['team_details']['data'][0]['region_id']);
	        $this->load->view('team_tpl',$data);
    	}
    	else{
    		
    		show_404();
    	}
    }
	
	/**
	 * method to check if the username entered only digit
	 */
	public function leaderboard()
	{
        //$data['result'] = $this->user_model->getLiveLeaderboard();
		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
			foreach($home as $row)
			{
				$data['homeContent'][$row['key']] = $row['value'];
			}
		$this->load->view('leaderboard',$data);
	}
	
	public function onlineLeaderboard()
	{
		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
			foreach($home as $row)
			{
				$data['homeContent'][$row['key']] = $row['value'];
			}
		$this->load->view('online-leaderboard',$data);
	}

	public function liveLeaderboard()
	{
		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
			foreach($home as $row)
			{
				$data['homeContent'][$row['key']] = $row['value'];
			}
		$this->load->view('live-leaderboard',$data);
	}

	public function getMyAccountUpdateStatus()
	{
		if ($this->session->checkLogin() == FALSE)
		{
            echo "SESSION_ERR";
            exit;
		}

        $user_id = $this->session->userdata('user_id');
        $user_info = $this->user_model->getUserIdInfo($user_id);
        echo $user_info['is_modify'];
        exit;
	}

	public function my_account()
	{
        if ($this->session->checkLogin() == FALSE)
            redirect('/');

        $user_id = $this->session->userdata('user_id');
        $data['doc_type_arr'] = $this->user_model->getDocType();
        $user_info = $this->user_model->getUserDetailWithDoc($user_id);
        $data['user_info'] = $user_info;
        if($this->input->server ('REQUEST_METHOD') === 'POST' && $_POST['city'])
        {
        	
			$dob = date("Y-m-d", strtotime($_POST['dob']));

			if($dob=='1970-01-01' || $_POST['address1']=='' ||$_POST['city']==''||$_POST['state']=='')
				redirect('/my-account?msg=fail');

			$age = $dob?(date('Y') - date('Y',strtotime($dob))):0;
			if($age <21)
				redirect('/my-account?msg=age_err');

        	$user_info = array("dob"=>$dob,"address1"=>$_POST['address1'],"address2"=>$_POST['address2'],"city"=>$_POST['city'],"state"=>$_POST['state'],"is_modify"=>'1');
        	$this->user_model->updateUserInfo($user_info,$user_id);
        	redirect('/my-account?msg=succ');
    	}
    	else if($this->input->server ('REQUEST_METHOD') === 'POST' && $_POST['doc_type'])
		{
			if($_FILES['userfile']['name']== '' || $_POST['doc_type']=='')
			{
				$data['doc_err_msg'] = "Please select document type and file to upload.";
				$this->load->view('my-account',$data);
			}

        	if($_FILES['userfile']['size'] > 0)
	        {
	        	$ext = substr(strrchr($_FILES['userfile']['name'], "."), 1);
   				$file_name = 'doc'.'_'.time().'.'.$ext;
	            $config = array('file_name' => $file_name,
	                            'upload_path' => 'uploads/',
	                            'allowed_types' => 'pdf|jpg|jpeg|doc',
	                            'max_size'        => "2048KB"
	                           );
	            $this->load->library('upload', $config);
	            if(!$this->upload->do_upload())
	            {
	            	$response = $this->upload->display_errors();
	            	$response = str_replace('<p>','',$response);
            		$response = str_replace('</p>','',$response);
	            	$data['doc_err_msg'] =$response;         	
	            }
	            else
            	{
		           	$file_details = $this->upload->data();
		           	$this->user_model->updateUserInfo(array('doc_status'=>'pending'),$user_id);
		           	$this->user_model->insertUserDocInfo(array('user_id'=>$user_id,'doc_type_id'=>$_POST['doc_type'],'doc_path'=>$file_details['file_name']));

		           	$subject = 'Your Address Proof is under Review';
		            $mail_content = '<p>Hi USERNAME,</p>
									<p>&nbsp;</p>
									<p>Thank You for updating your information and sharing your address proof. We are currently reviewing your proof and will let you know if they match our records.</p>
									<p>&nbsp;</p>
									<p>See you at the tables!</p>
									<p>Team PSL</p>';

            		$mail_content = str_replace('USERNAME',$user_info['user_name'],$mail_content);
			        //config and load the Email library - call method of email_model class
			        $this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
			        $this->email_model->sendMail($this->acc_admin_name, $user_info['email'], $subject, $mail_content);
	                redirect('/my-account?msg=success');
                }
	        }
		}
		$this->load->view('my-account',$data);
	}

	public function getLiveLeaderboardJson()
	{
		$result = $this->user_model->getLiveLeaderboard($_POST['city']);
		$i =0;
		$arr = array();
		foreach($result as $name => $detail)
		{
			$i++;
			$detail['points'] = sprintf("%0.2f",$detail['points']);
			$detail['rank'] = $i;
			unset($detail['counter'], $detail['created']);
			$arr[] = $detail;
		}
		echo json_encode($arr);
	}

	

	/**
	 * method to check if the username entered only digit
	 */
	public function playerApplication()
	{
		$this->load->view('player-application');
	}


	/**
	 * method to check if the username entered only digit
	 */
	public function thankyou()
	{
		$this->load->view('thankyou');
	}

	function logout()
	{
	    $session_userinfo = array('username' => '',
	        'user_id' => '',
	        'email' => '',
	        'status' => '',
	        'first_name' => ''
	    );
	    $this->session->unset_userdata( $session_userinfo );
	    $this->session->sess_destroy();

	    print_r($session_userinfo);
	    redirect('/');
	}

	function prepareMailContent($user_info)
	{
        // prepare message for the user activation mail content
        $this->message = 'Hello '.$user_info['user_name'].',<br><br>';
        $this->message .= 'Thank you for submitting your application for Pro Player draft.<br><br>';
        $this->message .= 'Thanks,<br>';


        $this->message .= 'Poker Sports League Team<br><br>';

        //$this->message .= 'P.S. To make sure you don’t miss a single news/update from us in the future, please add (email address) to your address book today.<br>';

        $this->subject = 'Application for Pro Player under Review';

        $this->playermessage = 'A new user submit a form.<br>';

        $formvar = $_POST;
        foreach($formvar as $key=>$value)
        {
        	$formvar .= $key.'  :   '.$value."<br/>";
        }

        $this->playermessage .= 'USERNAME : '.$user_info['user_name'].' .<br>';
        $this->playermessage .= 'NAME : '.$user_info['first_name'].' .<br>';
        $this->playermessage .= 'MOBILE : '.$user_info['mobile'].' .<br>';
		$this->playermessage .= $formvar;


        $this->playersubject = 'Pro Application Form';
	}

	function sendMailProForm($user_info,$file_name)
	{
		//config and load the Email library - call method of email_model class
		$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);

		$this->email_model->sendMail($this->acc_admin_name, $user_info['email'], $this->subject, $this->message);

		$this->email_model->sendMail($this->acc_admin_name, 'backoffice@pokersportsleague.com', $this->playersubject, $this->playermessage,PRO_PLAYERFILE_PATH.$file_name);
	}

	function proPlayerFormSubmit($file = '')
	{
		$flag = 0;

		/*if($_FILES['userfile']['name'] == '' && ($file == '' || $file == NULL))
		{
			$this->fileupload = false;
			$this->file_name = $file;
			$this->error_msg = 'Please upload file';	
			return $flag;
		}*/	

		if($_POST[tourney_name_1] == '' || $_POST[tourney_name_2] == '' || $_POST[tourney_name_3] == '')
		{	
			$this->minentry = false;
			$this->file_name = $file;
			$this->error_msg = 'Please fill minimum three entries';
			return $flag;
		}	

		if($_FILES['userfile']['name'] != '')
		{	
			if($this->fileUpload())
			{
				$this->file_name = $_FILES['userfile']['name'];
				//$this->file_name = $file;	
				return 1;
			}	
			else
			{	
				$this->error_msg = $this->response;
				$this->filesize = false;
				$this->file_name = $file;
			}	
		}	
		else
		{	
			$this->file_name = $file;
			$pro_info = array('status' => 1);
			return 1;
		}
		return $flag;	
	}

	function proPlayerFormSave($file = '')
	{
		if($_FILES['userfile']['name'] != '')
		{	
			if($this->fileUpload())
			{	
				$this->file_name = $_FILES['userfile']['name'];
				$pro_info = array('status' => 0);
				return $pro_info;
			}	
			else
			{	
				$this->error_msg = $this->response;
				$this->filesize = false;
			}	
		}	
		else
			$this->file_name = $file;
	}

	/**
	 * method to check if the username entered only digit
	 */
	public function proPlayerRegistartion()
	{
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$data['msg'] = '';
			$var = serialize($_POST);

			$userinfo = $this->user_model->getProPlayerInfo($this->session->userdata('user_id'));

			$user_info = $this->user_model->getUserIdInfo($this->session->userdata('user_id'));	

			$message = $this->prepareMailContent($user_info);

			if($userinfo)
			{
				if($_POST['submit'] == 'submit')
				{
					$status = $this->proPlayerFormSubmit($userinfo['file']);

					$data['msg'] = $this->error_msg;

					$pro_info = array('tourney_data' => $var,'file'=> $this->file_name,'comments' => $_POST['comments'],'status' => $status);

					if($this->filesize && $this->minentry && $this->fileupload)
						$this->sendMailProForm($user_info,$this->file_name);
				}	
				if($_POST['save'] == 'save')
				{	
					$pro_info = $this->proPlayerFormSave($userinfo['file']);
					$data['msg'] = $this->error_msg;
					$pro_info = array('tourney_data' => $var,'file'=> $this->file_name,'comments' => $_POST['comments']);
					$data['msg'] = 'Your application has been saved to your account';
				}
				$this->user_model->updateProPlayerInfo($pro_info, $this->session->userdata('user_id'));

				if($this->filesize && $this->minentry && $this->fileupload)
					redirect('/pro-player-registration?msg=saved');
			}	
			else
			{
				if($_POST['submit'] == 'submit')
				{	
					$status = $this->proPlayerFormSubmit();
					$data['msg'] = $this->error_msg;
					$pro_info = array('tourney_data' => $var,'file'=> $this->file_name,'comments' => $_POST['comments'],'user_id' => $this->session->userdata('user_id'),'status' => $status);

					if($this->filesize && $this->minentry && $this->fileupload)
						$this->sendMailProForm($user_info,$this->file_name);
				}	
				if($_POST['save'] == 'save')
				{	
					$pro_info = $this->proPlayerFormSave();
					$data['msg'] = $this->error_msg;
					$pro_info = array('tourney_data' => $var,'file'=> $this->file_name,'comments' => $_POST['comments'],'user_id' => $this->session->userdata('user_id'));
					$data['msg'] = 'Your application has been saved to your account';
				}	

				$this->user_model->addProPlayerInfo($pro_info);

				if($this->filesize && $this->minentry && $this->fileupload)
					redirect('/pro-player-registration');
			}	
		}

		if ($this->session->checkLogin() == TRUE)
		{
			$userinfo = $this->user_model->getProPlayerInfo($this->session->userdata('user_id'));
			if($userinfo)
			{	
				$data['pro_user_info'] = unserialize($userinfo['tourney_data']);
				$data['pro_file'] = $userinfo['file'];
				$data['comments'] = $userinfo['comments'];
				$data['form_status'] = $userinfo['status'];
			}
			else
			{
				$data['pro_user_info'] = '';
				$data['form_status'] = '';
				$data['pro_file'] = '';
				$data['status'] = '';
			}
			//$this->load->view('pro-player-registration',$data);
			$this->load->view('pro-application',$data);
		}
		else
		{
			redirect('/login');
		}	
	}

	/**
	 * method to check if the username entered only digit
	 */
	public function sendActivationLink($signup_info, $activation_code)
	{
        $user_info = $this->user_model->getUsernameInfo($signup_info['user_name']);

        //create the activation link
        $activation_link = $this->config->item('base_url').'/user-activation?activation_code='.$activation_code.'&user_id='.$user_info['user_id'];

        // prepare message for the user activation mail content
        $message = 'Hello '.$signup_info['first_name'].',<br><br>';
        $message .= 'Welcome to the first Poker League in India! We are excited by the interest you have shown towards PSL and look forward to your participation in the events.<br><br>';
        $message .= 'Just one more step before your registration is complete. Please click the link below to verify your email id.<br><br>';

        $message .= $activation_link.'<br><br>';

        $message .= 'Lets make our favorite sport more popular!<br><br>';
        $message .= 'Poker Sports League Team<br><br>';

        //$message .= 'P.S. To make sure you don’t miss a single news/update from us in the future, please add (email address) to your address book today.<br>';

        $subject = 'Welcome to the League';

		//config and load the Email library - call method of email_model class
		$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);

		$this->email_model->sendMail($this->acc_admin_name, $user_info['email'], $subject, $message);
	}	

    /**
     * method to send user account activation link via email
     */
    public function userActivation()
    {
        $activation_code = $this->input->get("activation_code");
        $user_id = $this->input->get("user_id");

        if(isset($activation_code) && $activation_code != '') {
        	$success = $this->user_model->updateUserStatus($activation_code, 'active',$user_id);

        	if($success == 0)
        	{
        		$user_info = $this->user_model->getUserIdInfo($user_id);
                $session_userinfo = array('username' => $user_info['user_name'],
                    'user_id' => $user_info['user_id'],
                    'email' => $user_info['email'],
                    'status' => $user_info['status'],
                    'first_name' => $user_info['first_name']
                );
                $this->session->set_userdata ( $session_userinfo );

        		$data['msg'] = 'Congratulations your account has been activated.';
        	}	
        	else if($success == 1)
				$data['msg'] = "Your account has already been activated.";
			else if($success == -1)
				$data['msg'] = "Sorry, your account cannot be activated. Please mail to info@pokersportsleague.com for more information.";

        }

        $this->load->view('user-activation',$data);
    }

    function fileUpload()
    {
    	//echo $_FILES['userfile']['size'];die;
        if($_FILES['userfile']['size'] > 0)
        {
            $config = array('file_name' => $_FILES['userfile']['name'],
                            'upload_path' => 'player_form/',
                            'allowed_types' => 'zip',
                            'max_size'        => "20240KB"
                           );
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload())
            {
        		$this->success  = FALSE;
            	$this->response = $this->upload->display_errors();
            }
            else
            {
	           	$csv_file = $this->upload->data();
                return $csv_file['file_name'];
            }
        }
    }

	public function comingSoon()
	{
		$this->load->view('comming-soon');
	}    

    /**
	 * method to check if the Username is entered
	 */
	public function forgotPassword()
	{
		$data['error'] = '';
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$email = $this->input->post('email');
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$data['msg'] = 'Please enter a valid e-mail address.';
			}
		if(trim($email) <> '')
			{
				//get user info by email
				$user_info = $this->user_model->getUserEmailInfo($email);
				if( ! empty($user_info))
			{
					//get random password
					$pass = $this->user_model->getRandomPassword();
					$password = hash('sha256',$pass);
					$uname = $user_info['user_name'];
					//reset password in DB
					if($this->user_model->resetUserPassword($uname, $email, $password))
					{
						$this->db->last_query();
						$subject = 'Reset Your Password';
						$message = '<p>Dear '.$uname.',</p>
<p>&nbsp;</p>
<p>Your request for a new password has been received. Your password is reset to:&nbsp;<strong>'.$pass.'</strong></p>
<p>&nbsp;</p>
<p><strong>Thanks &amp; Regards,</strong></p>
<p><strong>Team pokersportsleague.com</strong></p>';	
						//config and load the Email library - call method of email_model class
						$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
						if($this->email_model->sendMail($this->acc_admin_name, $email, $subject, $message))
						{
							$data['msg'] = 'Success! We have sent a new password to '.$email.' an email with reset instructions. If the email does not arrive soon, check your spam folder.';
						}
					}
				}
				else
				{
					$data['msg'] = 'Please enter a valid e-mail address.';
				}
			}
			else
			{
				$data['msg'] = 'Please enter a valid e-mail address.';
			}
		}
		$home = $this->cms_model->getHomeData();
		$data['homeContent'] = array();
		if($home)
			foreach($home as $row)
			{
				$data['homeContent'][$row['key']] = $row['value'];
			}
		$this->load->view('forgot-password',$data);
	}

    public function preRegister()
    {
        if ($this->session->checkLogin() == FALSE) {
            $result['msg'] = 'Please login first';
            echo 0;
            exit;
        }
		$user_id = $this->session->userdata('user_id');
		$register_flag = $this->user_model->checkUserAlreadyRegister($this->input->post('tid'),$user_id);
		$tournament_details = $this->user_model->getTournamentDetailsById($this->input->post('tid'));
		$date = new DateTime($tournament_details['date']);
	    $tournament_time = strtotime($date->format('Y-m-d H:i:s'))- REGISTRATION_STOP_HRS*60*60;
		$current_time = time();
		if($this->input->post('type') == 'register')
		{	
	    	if($register_flag)
			{
				echo 2;
				exit;
			}
			
			$registered_users = $this->user_model->checkTotalRegisterUserById($this->input->post('tid'));
			if($registered_users['id'] >= $tournament_details['entry'])
			{
				echo 3;
				exit;
			}

			if($current_time > $tournament_time)
			{
				echo 5;
				exit;
			}
	  		$register_status = $this->user_model->registerUserInTournament($user_id,$this->input->post('tid'));
	  		if(!$register_status)
			{
				echo 4;
				exit;
			}
			
        	$email = $this->session->userdata('email');
        	$result['msg'] = $email;

        	// users email
        	$subject = 'Here is Your Entry Ticket';
        	$message = '<p>Hi '.$this->session->userdata('username').',</p>

			<p>Congratulations! You have pre-registered for '.$tournament_details['tourney_name'].' at '.$tournament_details['venue'].'.</p>

			<p>Please reach the venue one hour before the tournament starts and show this email during registration. </p>

			<p>Looking forward to your participation.</p>

			<p><strong>Thanks &amp; Regards,</strong></p>
			<p><strong>Team pokersportsleague.com</strong></p>';    
	        	//config and load the Email library - call method of email_model class
        	$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
        	$this->email_model->sendMail($this->acc_admin_name, $email, $subject, $message);

        	$user_info = $this->user_model->getUsernameInfo($this->session->userdata('username'));
        	//print_r($user_info);
        	// back office email
        	$subject = 'Pre-registration for Live Qualifier';
        	$message = '<p>Name &nbsp;'.$user_info['first_name'].'</p>';
        	$message .= '<p>PSL Username &nbsp;'.$user_info['user_name'].'</p>';
        	$message .= '<p>Email &nbsp;'.$user_info['email'].'</p>';
        	$message .= '<p>Mobile &nbsp;'.$user_info['mobile'].'</p>';
        	$message .= '<p>Tournament Name &nbsp;'.$tournament_details['tourney_name'].'</p>';
        	$message .= '<p>Venue &nbsp;'.$tournament_details['venue'].'</p>';

        	//config and load the Email library - call method of email_model class
        	$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
        	$this->email_model->sendMail($this->acc_admin_name, 'backoffice@pokersportsleague.com', $subject, $message);

        	echo 1;
        	exit;
    	}
	
		if(!$register_flag)
		{
			echo 6;
			exit;
		}

		$tournament_time = strtotime($date->format('Y-m-d H:i:s'))- REGISTRATION_STOP_HRS*60*60;
		$current_time = time();
		if($current_time > $tournament_time)
		{
			echo 7;
			exit;
		}
		$unregister_status = $this->user_model->deleteUserTournamentEntry($user_id,$this->input->post('tid'));
		if($unregister_status)
		{
			$email = $this->session->userdata('email');
        	//$result['msg'] = $email;

        	// users email
        	$subject = 'Unregister from Live Qualifier';
        	$message = '<p>Hi '.$this->session->userdata('username').',</p>

			<p>You have been unregistered from '.$tournament_details['tourney_name'].' at '.$tournament_details['venue'].'.</p>

			<p>Looking forward to your participation in other events.</p>

			<p><strong>Thanks &amp; Regards,</strong></p>
			<p><strong>Team pokersportsleague.com</strong></p>';    
	        	//config and load the Email library - call method of email_model class
        	$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
        	$this->email_model->sendMail($this->acc_admin_name, $email, $subject, $message);

        	$user_info = $this->user_model->getUsernameInfo($this->session->userdata('username'));
        	//print_r($user_info);
        	// back office email
        	$subject = 'Un-registration for Live Qualifier';
        	$message = '<p>Name &nbsp;'.$user_info['first_name'].'</p>';
        	$message .= '<p>PSL Username &nbsp;'.$user_info['user_name'].'</p>';
        	$message .= '<p>Email &nbsp;'.$user_info['email'].'</p>';
        	$message .= '<p>Mobile &nbsp;'.$user_info['mobile'].'</p>';
        	$message .= '<p>Tournament Name &nbsp;'.$tournament_details['tourney_name'].'</p>';
        	$message .= '<p>Venue &nbsp;'.$tournament_details['venue'].'</p>';

        	//config and load the Email library - call method of email_model class
        	$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
        	$this->email_model->sendMail($this->acc_admin_name, 'backoffice@pokersportsleague.com', $subject, $message);
			echo 8;
			exit;
		}

		echo 4;
		exit;
    }

    public function tournamentRegPlayersCron()
    {
    	$tournament_arr = $this->user_model->getthreeHoursLaterTournament();
    	if(empty($tournament_arr))
		{
			echo "No tournament Found";
			exit;
		}

		foreach($tournament_arr as $key =>$value)
		{
			$line = '<table style="border-collapse: collapse;" border="1" cellspacing = "5" cellpadding = "5"><tr><th>Sno.</th><th>User Name</th><th>Name</th><th>Email</th><th>Mobile</th><th>Gender</th><th>State</th><th>City</th></tr>';

			$user_list = $this->user_model->getTournamentRegPlayersWithName($value['id']);
			if(empty($user_list))
				$line .= '<tr><td colspan="5">No registartion for this tournament.</td></tr>';
			else
			{
				$i = 1;
				foreach($user_list as $row)
				{
					$line .= "<tr><td>".$i."</td><td>".$row['user_name']."</td><td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['email']."</td><td>".$row['mobile']."</td><td>".$row['gender']."</td><td>".$row['state']."</td><td>".$row['city']."</td></tr>";
					$i++;
				}
			}
			$line .= '</table>';
			$date=date_create($value['date']);
			$subject = "Registered players List : ".$value['tourney_name']." ".$value['city']." ".$value['venue']." ".date_format($date,"d M Y H:i:s");
			$this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
        	$this->email_model->sendMail($this->acc_admin_name, 'backoffice@pokersportsleague.com', $subject, $line);
		}
		echo "Cron run successfully.";
    }

    /**
     * method to change password
     */
    public function changePassword()
    {
        $data = '';
        if($this->input->server ('REQUEST_METHOD') === 'POST')
        {
            if($this->validateChangePassword())
            {
                $user_info = $this->user_model->getUsernameInfo($this->session->userdata('username'));
                $user_password = hash('sha256',$this->input->post('current_password')); 
                $userHashPassword = hash('sha256',$this->input->post('new_password'));
                if($user_password == $user_info['password']){
                    if($this->user_model->resetUserPassword($this->session->userdata('username'), $user_info['email'], $userHashPassword))
                    {
                        $data['msg'] = 'Password Changed Successfully';
                        redirect('change-password?msg=Password Changed Successfully#change_password');
                    }
                }else{
                    $data['msg'] = 'Current Password does not match';
                    redirect('change-password?msg=Current Password does not match#change_password',$data);
                }
            }
        }
        $this->load->view('change_password',$data);
    }

    function validateChangePassword(){
            $this->form_validation->set_rules('current_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[8]|alpha_numeric');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|callback_checkPassword');
            if ($this->form_validation->run() == FALSE)
                return FALSE;
            else
                return TRUE;
    }

    /**
     * method to check if the new password and confirm password matches
     */
    public function checkPassword()
    {
        if(!($this->input->post('new_password') == $this->input->post('confirm_password')))
        {
            $this->form_validation->set_message('checkPassword', 'New Password and confirm password does not match');
            return FALSE;
        }
        else
            return TRUE;
    }

}