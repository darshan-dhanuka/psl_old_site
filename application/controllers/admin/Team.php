<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	/**
	 * Constructor
	 */
	public function __construct()
    {
		parent::__construct ();
		$this->load->model(array('Team_model'));

        if( ! $this->session->checkAdminLogin()) 
        { 
                redirect('/admin',true);
        }
	}	
	
	/**
	 * method to show team listing page
	 */
	public function index()
	{
        $data['list'] = $this->Team_model->getTeamList();
		$this->template->load('admin/layout/admin_tpl','admin/team/list',$data);
	}

    /**
     * method to update status of team
     */
    public function updateStatus($team_id,$status)
    {
        $this->Team_model->updateTeam($team_id,array('status'=>($status==0)?1:0));
        $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Team updated Successfully.</div>');
        redirect('/admin/team');
    }

    /**
     * method to update status of team to 2 (Deleted)
     */
    public function delete($team_id)
    {
        $this->Team_model->updateTeam($team_id,array('status'=>2));
        $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Team Deleted Successfully.</div>');
        redirect('/admin/team');
    }

    /**
     * method to add team
     */
    public function addTeam()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST'){
            if($this->validateTeam()){
            	if($this->validateteamURL($this->input->post('page_url'))){
					$team ['team_name'] = $this->input->post ( 'team_name' );
					$team ['team_website_banner'] = $this->fileUpload ( 'team_website_banner', $_FILES ['team_website_banner'] );
					$team ['team_logo'] = $this->fileUpload ( 'team_logo', $_FILES ['team_logo'] );
					$team ['team_mobile_banner'] = $this->fileUpload ( 'team_mobile_banner', $_FILES ['team_mobile_banner'] );
					$team ['region_id'] = $this->input->post ( 'region' );
					$team ['page_url'] = $this->input->post ( 'page_url' );
					$team ['seo_title'] = $this->input->post ( 'seo_title' );
					$team ['seo_meta'] = $this->input->post ( 'seo_keyword' );
					$team ['homepageLogo'] = $this->input->post ( 'homepageLogo' );
					$team ['meet_the_team'] = $this->input->post ( 'meet_the_team' );
					$team ['linux_added_on'] = time ();
					$res = $this->Team_model->saveTeam ( $team );
					if ($res)
					{
						$this->session->set_flashdata ( 'msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Team added Successfully.</div>' );
						redirect ( 'admin/team' );
					}
					else
					{
						$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>' );
					}
				}else{
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Team Url is duplicate.</div>' );
				}
            }
        }
        $data['form'] = 'add';	
        $data['zone']=$this->Team_model->getAllRegion();
        $this->template->load('admin/layout/admin_tpl','admin/team/add',$data);
    }

    /**
     * method to uplaod file
     */
    public function fileUpload($file,$fileAttr)
    {
    	
    	if($fileAttr['size'] > 0)
    	{
    		$config['upload_path'] = TEAM_IMAGES_UPLOAD_PATH;
	  			$config['allowed_types'] = 'jpg|jpeg|png|PNG';
    			$config['max_size']    = '1000';
    			$config['file_name'] = $fileAttr['name'];
    			$config['overwrite'] = TRUE;
    			$this->load->library('upload');
    			$this->upload->initialize($config);
    			if ( ! $this->upload->do_upload($file))
    			{
    				$error = array('error' => $this->upload->display_errors());
    				echo $this->upload->display_errors();//this->session->set_userdata(array('imguploaderror'=>$this->upload->display_errors()));
    				return false;
    			}else
    			{
    				$data = $this->upload->data();
    				return $data['file_name'];
    			}
    	   }
    	   else{
    	   	echo "no file to upload or invalid file size";
    	   	return false;
    	   }
    }

    public function validateTeam(){
    	
    		
            $this->form_validation->set_rules('team_name', 'Team Name', 'required');
            if (empty($_FILES['team_website_banner']['name']))
                $this->form_validation->set_rules('team_website_banner', 'Team Banner', 'required');
            if (empty($_FILES['team_mobile_banner']['name']))
                	$this->form_validation->set_rules('team_mobile_banner', 'Team Banner', 'required');
            if (empty($_FILES['team_logo']['name']))
            $this->form_validation->set_rules('team_logo', 'Team Logo', 'required');
            if ($this->form_validation->run() == FALSE)
                return FALSE;
            else
                return TRUE;
    }
    
    public function validateteamURL($url,$team_id=NULL)
    {
    	$res = $this->Team_model->validateteamURL ( $url,$team_id );
		if ($res)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
    
    public function editTeam()
    {
		$teamId = $this->input->get( 'team_id' );
		if ($this->input->server ( 'REQUEST_METHOD' ) === 'POST')
		{
			if($this->validateteamURL($this->input->post('page_url'),$teamId)){
				$team ['team_name'] = $this->input->post ( 'team_name' );
				if($_FILES ['team_website_banner']['size']>0)
				$team ['team_website_banner'] = $this->fileUpload ( 'team_website_banner', $_FILES ['team_website_banner'] );
				if($_FILES ['team_logo']['size']>0)
				$team ['team_logo'] = $this->fileUpload ( 'team_logo', $_FILES ['team_logo'] );
				if($_FILES ['team_mobile_banner']['size']>0)
				$team ['team_mobile_banner'] = $this->fileUpload ( 'team_mobile_banner', $_FILES ['team_mobile_banner'] );
				$team ['region_id'] = $this->input->post ( 'region' );
				$team ['linux_modified_on'] = time ();
				$team['page_url']=$this->input->post('page_url');
				$team['seo_title']=$this->input->post('seo_title');
				$team['seo_meta']=$this->input->post('seo_keyword');
				$team ['homepageLogo'] = $this->input->post ( 'homepageLogo' );
				$team ['meet_the_team'] = $this->input->post ( 'meet_the_team' );
				$team['status']=0;
				$res = $this->Team_model->updateTeam ($teamId,$team );
				if ($res)
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Team updated Successfully.</div>');
                    redirect('admin/team');
				}
				else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
				}
			}
			else{
				$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Team Url is duplicate.</div>' );
			}
		}
		$data['form'] = 'edit';	
		$teamDetails = $this->Team_model->getTeamInfo ( $teamId );
		$data['teamDetails']=$teamDetails['data'];
		$data ['zone'] = $this->Team_model->getAllRegion ();
		$this->template->load('admin/layout/admin_tpl','admin/team/add',$data);
	}

}
