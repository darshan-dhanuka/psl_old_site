<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Constructor
	 */
	public function __construct()
    {
		parent::__construct ();
		$this->load->model('dashboard_model');
	}	
	
	/**
		login page
	 */
	public function index()
	{
		$data['error'] = '';

		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$uname = $this->input->post('username');
			$password = hash('sha256',$this->input->post('password'));
			
			$user_info = $this->dashboard_model->getAdminUsernameInfo($uname);

			if(!empty ($user_info))
			{
				if($user_info['password'] == $password)
				{

					$user_session_info  = array(
					        'uname'  => $user_info['uname'],
					        'email'     => $user_info['email'],
					        'logged_in' => TRUE
					);

					$this->session->set_userdata($user_session_info);

					redirect('admin/dashboard');
				}	
				else
					$data['error'] = 'Invalid Username/Password';	
			}
			else
			{	
				$data['error'] = 'Invalid Username/Password';
			}	
		}

		$this->load->view('admin/login',$data);
	}
}
