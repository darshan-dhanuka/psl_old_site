<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualifier extends CI_Controller {

	/**
	 * Constructor
	 */
	public function __construct()
    {
		parent::__construct ();
		$this->load->model(array('Qualifier_model','User_model','Team_model'));

        if( ! $this->session->checkAdminLogin()) 
        { 
                redirect('/admin',true);
        }
	}	
	/**
	 *	show qualifier listing
	 */
	public function index()
	{
		 /******* code for pagination ***/
        $param = array();
        $this->load->library ( 'pagination' );
        $config ['base_url'] = "?noofrecord=".QUALIFIER_PER_PAGE_LIMIT;
        $config ['total_rows'] = $this->Qualifier_model->getQualifiersCount(2);
        $config ['per_page'] = QUALIFIER_PER_PAGE_LIMIT;
        $config ['uri_segment'] = 4;
        $config ['page_query_string'] = TRUE;
        $page_number = ($this->input->get ( 'per_page' ) == '') ? 0 : $this->input->get ( 'per_page' );
        $this->pagination->initialize ( $config );
        $param ['limit'] = $config ['per_page'];
        $param ['offset'] = $page_number;

        /******* code for pagination ***/
		$data['qualifier_list'] = $this->Qualifier_model->getQualifierslist(2,$param);//2 represent the deleted status
		$this->template->load('admin/layout/admin_tpl','admin/qualifier/qualifier_list',$data);
	}

	/**
	 * update qualifier status
	 */
	public function updateQualifierStatus($qualifier_id,$status)
	{
		if($this->Qualifier_model->updateQualifier($qualifier_id,array('status'=>$status))){
			if($status != 2){
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Qualifier status changed succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Qualifier deleted succesfully.</div>');
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
		}
		redirect('admin/qualifier/index');
	}

	/**
		login page
	 */
	public function addQualifier()
	{
		$data['category_list'] = $this->Qualifier_model->getCategory();
		$data['team_list'] = $this->Team_model->getTeamList();
		//echo '<pre>';print_r($data['team_list']);die;
		if($this->input->server ('REQUEST_METHOD') === 'POST'){
			if($this->validateQualifier()){
				if($_FILES ['qualifier_image']['size']>0){
					$filename = $this->fileUpload ( 'qualifier_image', $_FILES ['qualifier_image'] );
					if($filename == false){
							$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$this->upload->display_errors().'</div>');
							$this->template->load('admin/layout/admin_tpl','admin/qualifier/add_qualifier',$data);
					}
				}
				$qualifier_data = array('user_id'=>$this->input->post('user_id'),'category_id'=>$this->input->post('category_id'),'team_id'=>$this->input->post('team_id'),'qualifier_image'=>$filename !=false?$filename:NULL,'linux_added_on'=>time(),'linux_modified_on'=>time());
				if($this->Qualifier_model->saveQualifier($qualifier_data)){
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Qualifier added succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
				}
			}
		}
		$data['form'] = 'add';
		$this->template->load('admin/layout/admin_tpl','admin/qualifier/add_qualifier',$data);
	}
	public function getUser($username,$category_id){
		if($category_id == '' || $category_id == 'undefined'){
			echo json_encode(array('status'=>true,'data'=>$response,'message'=>'Please select qualifier Category'));
		}else{
			$response = $this->User_model->getUsernameForQualifier($username,$category_id);
			if($response)
				echo json_encode(array('status'=>true,'data'=>$response,'message'=>'User Exist'));
			else
				echo json_encode(array('status'=>false,'message'=>'User not Exist'));
		}
		exit();
	}
	/**
	 * method to check qualifier validation
	 */
	public function validateQualifier($action = 'add')
	{
		if($action == 'add'){
			$this->form_validation->set_rules('user_name', 'User Name', 'required');
			$this->form_validation->set_rules('category_id', 'Category Id', 'required');
			$this->form_validation->set_rules('team_id', 'Team Id', 'required');
			$this->form_validation->set_rules('user_id', 'UserId', 'callback_userExist[user_id]');
		}else{
			$this->form_validation->set_rules('category_id', 'Category Id', 'required');
			$this->form_validation->set_rules('team_id', 'Team Id', 'required');
		}
			if ($this->form_validation->run() == FALSE)
				return FALSE;
			else
				return TRUE;
	}
	public function userExist($fieldvalue,$fieldname)
    {
        if($fieldvalue == '' || $fieldvalue == null)
        {
            $this->form_validation->set_message('userExist', "Please verify username!");
            return false;
        }
        else
        {
            return true;
        }
    }
    /**
     * method to uplaod file
     */
    public function fileUpload($file,$fileAttr)
    {
    	if($fileAttr['size'] > 0)
    	{
    		$config['upload_path'] = QUALIFIER_IMAGES_UPLOAD_PATH;
	  			$config['allowed_types'] = 'jpg|jpeg|png|PNG';
    			$config['max_size']    = '1000';
    			$ext = substr(strrchr($fileAttr['name'], "."), 1);
    			$config['file_name'] = time().'.'.$ext;
    			$config['overwrite'] = TRUE;
    			$this->load->library('upload');
    			$this->upload->initialize($config);
    			if ( ! $this->upload->do_upload($file))
    			{
    				$error = array('error' => $this->upload->display_errors());
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
    public function editQualifier($qualifier_id){    	
		if($this->input->server ('REQUEST_METHOD') === 'POST'){
			if($this->validateQualifier('edit')){
				$filename = false;
				if($_FILES ['qualifier_image']['size']>0){
					$filename = $this->fileUpload ( 'qualifier_image', $_FILES ['qualifier_image'] );
					if($filename == false){
							$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$this->upload->display_errors().'</div>');
							$this->template->load('admin/layout/admin_tpl','admin/qualifier/add_qualifier',$data);
					}else{
						@unlink(QUALIFIER_IMAGES_UPLOAD_PATH.$this->input->post('old_image_name'));
					}
				}
				$qualifier_data = array('category_id'=>$this->input->post('category_id'),'team_id'=>$this->input->post('team_id'),'linux_added_on'=>time(),'linux_modified_on'=>time());
				if($filename !=false){
					$qualifier_data['qualifier_image']= $filename;
				}
				if($this->Qualifier_model->updateQualifier($qualifier_id,$qualifier_data)){
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Qualifier updated succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
				}
			}
		}
		$data['category_list'] = $this->Qualifier_model->getCategory();
		$data['team_list'] = $this->Team_model->getTeamList();
		$data['qualifier_details'] = $this->Qualifier_model->getQualifierDetails($qualifier_id);
		$data['form'] = 'edit';
		$this->template->load('admin/layout/admin_tpl','admin/qualifier/add_qualifier',$data);
    }

}
