<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Constructor
	 */
    var $leaderborad_file;

	public function __construct()
    {
		parent::__construct ();
		$this->load->model(array('dashboard_model','user_model','email_model'));
        $this->acc_admin_name = $this->email_model->cp_acc_admin_name;
        $this->acc_admin_email = $this->email_model->cp_acc_admin_email;
        $this->acc_admin_passwd = $this->email_model->cp_acc_admin_passwd;
        if( ! $this->session->checkAdminLogin()) 
        { 
                redirect('/admin',true);
        }
	}	
	
	/***********************************************
	** Function to display dashboard
	***********************************************/
	public function index()
	{
        $this->template->load('admin/layout/admin_tpl','admin/dashboard');
	}

    /**
    login page
     */
    public function liveLeaderboard()
    {
        if($this->input->server ('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules("userfile","Leaderboard File",'callback_uploadLeaderBoard[userfile]');
            if($this->form_validation->run() !== FALSE)
            {
                $filename = $this->leaderborad_file;
                $csv_content = array_map('str_getcsv', file('schedule/'.$filename));
                $i=0;
                foreach($csv_content as $val)
                {
                    $i++;
                    if($i == 1)continue;
                    //print_r($val);
                    $size = trim($val[8]);
                    $position = trim($val[9]);
                    $buy_in = trim($val[10]);

                    $points = sqrt(($size/$position)*sqrt($buy_in));

                    $points = (float)sprintf("%.2f", $points);

                    $onlineSchedule = array(
                        'name' => strtolower(trim($val[1])),
                        'city' => trim($val[5]),
                        'venue' => trim($val[6]),
                        'tourney_name' => trim($val[4]),
                        'date' => trim($val[7]),
                        'field_size' => trim($val[8]),
                        'position' => trim($val[9]),
                        'buy_in' => trim($val[10]),
                        'points' => $points
                    );
                    //print_r($onlineSchedule);
                    $this->user_model->addLiveleaderboard($onlineSchedule);
                }
                unlink('schedule/'.$filename);
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Leaderboard uploaded successfully</div>');
                redirect('admin/dashboard/liveLeaderboard');
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong>Try Again</div>');
            }
        }
        $this->template->load('admin/layout/admin_tpl','admin/live_leaderboard');
    }


    public function manageUsers()
    {//print_r($_POST);die;
        $data['user_details'] = false;
        $data['states_list']= $this->config->item('states_list');
        if($this->input->server ('REQUEST_METHOD') === 'POST'){
            $data['state'] = $this->input->post('state');
            $data['user_details'] = $this->dashboard_model->getUsersDetailsByStatus();
        }        
        $this->template->load('admin/layout/admin_tpl','admin/manage_users', $data);
    }

    public function updateUserDocStatus()
    {
        $user_id = $_GET['user_id'];
        $status = $_GET['status'];
        $user_info = $this->user_model->getUserIdInfo($user_id);
        $subject = '';
        $mail_content = '';
        if($user_info ==$status)
        {
            echo 'ALREADY_DONE';
            exit;
        }

        $update_flag = $this->dashboard_model->updateUserDocStatus($status,$user_id);
        if(!$update_flag)
        {   
            echo 'SOMETHING_WENT_WRONG';
            exit;
        }

        if($status=='verified')
        {
            $subject = 'Thank you for verifying your records';
            $mail_content = '<p>Hi USERNAME,</p><p>&nbsp;</p><p>You are now one step closer in making to the league as your address proof is accepted. Stay tune to the website and Facebook page for more updates about the drafts and team selection.</p><p>&nbsp;</p><p>See you at the tables!</p><p>Team PSL</p>';
        }
        else
        {
            $subject = 'The Address Proof submitted does not match PSL records';
            $mail_content = '<p>Hi USERNAME,</p><p>&nbsp;</p><p>We regret to inform you that the address proof you have submitted does not match our records.&nbsp; It could be due to any of the following reasons.</p><ol start="1"><li class="m_5862722055665648080m_-6233690486169307160MsoListParagraph">Date of Birth does not match records and/or is under 21 years of age</li><li class="m_5862722055665648080m_-6233690486169307160MsoListParagraph">Address given on the ID card does not match the records</li><li class="m_5862722055665648080m_-6233690486169307160MsoListParagraph">The address proof submitted is unclear/hazy&nbsp;</li><li class="m_5862722055665648080m_-6233690486169307160MsoListParagraph">The address proof submitted is incomplete</li></ol><p>&nbsp;</p><p>In case, you want to understand the reason for rejection, please write to&nbsp;<a href="mailto:info@pokersportsleague.com" target="_blank">info@pokersportsleague.com</a>&nbsp;with your PSL username and subject line &lsquo;Proof Rejected&rsquo;. Someone from the customer care team will revert shortly.</p><p>&nbsp;</p><p>Regards,</p><p>Team PSL</p>';
        }
        $mail_content = str_replace('USERNAME',$user_info['user_name'],$mail_content);
        //config and load the Email library - call method of email_model class
        $this->email_model->configEmailLib($this->acc_admin_email, $this->acc_admin_passwd);
        $this->email_model->sendMail($this->acc_admin_name, $user_info['email'], $subject, $mail_content);
        
        echo 'SUCCESS';
        exit;
    }  




    function uploadLeaderBoard($field,$csv)
    {
        
        $config = array(
                'file_name'=>$_FILES[$csv]['name'],
                'file_variable'=>$csv,
                'upload_path' => 'schedule/',
                'allowed_types' => 'csv',
                'max_size'        => "2024KB"
            );
        if(isset($config['file_name']) && $config['file_name']!='')
        {
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload($config['file_variable']))
            {
                $this->form_validation->set_message('uploadLeaderBoard', "Kindly select a valid file");
                return false;
            }
            else
            {
                $file = $this->upload->data();
                $this->leaderborad_file = $file['file_name'];
                return true;
            }
        }
    }

    function downloadExcel(){
        $_POST['username'] = ($this->input->get('username') == '' || $this->input->get('username') =='undefined')?'':$this->input->get('username');
        $_POST['state'] = ($this->input->get('state')=='' || $this->input->get('state')=='undefined')?'':$this->input->get('state');
        $_POST['status'] = ($this->input->get('status') == '' || $this->input->get('status') =='undefined')?'':$this->input->get('status');
        $data['user_details'] = $this->dashboard_model->getUsersDetailsByStatus();
        //print_r($data['user_details']);die;
        $filename = 'userinfo'.date('Y-m-d H:i:s');
        header("Content-Type: application/xls");    
        header("Content-Disposition: attachment; filename=$filename.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
        $this->load->view('admin/excel_download',$data);
    }
}
