<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

    /**
     * Constructor
     */
    
    var $owner_image;
    public function __construct()
    {
        parent::__construct ();
        $this->load->model(array('Owner_model','Team_model'));

        if( ! $this->session->checkAdminLogin()) 
        { 
                redirect('/admin',true);
        }
    }   
    
    /**
       Method: show team owner listing
    **/

    public function index()
    {

        /******* code for pagination ***/
        $param = array();
        $this->load->library ( 'pagination' );
        $config ['base_url'] = "?noofrecord=".OWNER_PER_PAGE_LIMIT;
        $config ['total_rows'] = $this->Owner_model->getOwnerCount($param);
        $config ['per_page'] = OWNER_PER_PAGE_LIMIT;
        $config ['uri_segment'] = 4;
        $config ['page_query_string'] = TRUE;
        $page_number = ($this->input->get ( 'per_page' ) == '') ? 0 : $this->input->get ( 'per_page' );
        $this->pagination->initialize ( $config );
        $param ['limit'] = $config ['per_page'];
        $param ['offset'] = $page_number;

        /******* code for pagination ***/
        
        $data['owner_list'] = $this->Owner_model->getOwnerList($param);
        $data['team_master'] = $this->Team_model->getTeamMaster();

        $this->template->load('admin/layout/admin_tpl','admin/owner/owner_listing',$data);
    }

    
    public function addTeamOwner()
    {
        if($this->input->server ('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules("owner_image","Owner Image",'callback_uploadOwner[owner_image]');

            $this->form_validation->set_rules("name","Owner Name",'required');
            //$this->form_validation->set_rules("company_name","Company Name",'required');
            $this->form_validation->set_rules("team_id","Team",'required');
            if($this->form_validation->run() !== FALSE)
            {
                $owner_data['owner_image'] = $this->owner_image;
                $owner_data['name'] = $this->input->post('name');
                $owner_data['company_name'] = $this->input->post('company_name');
                $owner_data['team_id'] = $this->input->post('team_id');
                $owner_data['linux_added_on'] = time();
                $owner_data['linux_modified_on'] = time();
             
                if($this->Owner_model->saveTeamOwner($owner_data))
                {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Owner added Successfully.</div>');
                    redirect('admin/owner?msg=success');
                }
                else
                {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
                }
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
            }
        }

        $data['team_master'] = $this->Team_model->getTeamMaster();
        $this->template->load('admin/layout/admin_tpl','admin/owner/add_owner',$data);  
    }



    public function editTeamOwner($owner_id=null)
    {
        if($this->input->server ('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules("owner_image","Owner Image",'callback_uploadOwner[owner_image]');
            $this->form_validation->set_rules("name","Owner Name",'required');
            //$this->form_validation->set_rules("company_name","Company Name",'required');
            $this->form_validation->set_rules("team_id","Team",'required');
           
            if($this->form_validation->run() !== FALSE)
            {
                if(isset($this->owner_image) && $this->owner_image!='')
                {
                    $owner_data['owner_image'] = $this->owner_image;
                }
                $owner_data['name'] = $this->input->post('name');
                $owner_data['id'] = $this->input->post('owner_id');
                $owner_data['company_name'] = $this->input->post('company_name');
                $owner_data['team_id'] = $this->input->post('team_id');
                $owner_data['status'] = 0;

                if($this->Owner_model->updateTeamOwner($owner_data))
                {
                    $this->session->set_flashdata('msg', 'Owner Updated Successfully');
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Owner updated Successfully.</div>');
                    redirect('admin/owner?msg=success');
                }
                else
                {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
                }
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
            }
        }
        $data['owner_data'] = $this->Owner_model->getOwnerById($owner_id);
        $data['team_master'] = $this->Team_model->getTeamMaster();
        $this->template->load('admin/layout/admin_tpl','admin/owner/edit_owner',$data);
    }



    /****
    *   Method to activate and deactivate Team owner
    *
    ******/
    public function updateOwnerStatus()
    {
        $owner['status'] = $this->input->get('status');
        $owner['id'] = $this->input->get('owner_id');

        if(isset($owner['status']) && isset($owner['id']))
        {
            if($this->Owner_model->updateTeamOwner($owner))
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Owner updated Successfully.</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        redirect('admin/owner?msg=failure');
    }

    public function deleteTeamOwner()
    {
        $owner_id = $this->input->get('owner_id');
        if(isset($owner_id))
        {
            $result = $this->Owner_model->getOwnerById($owner_id);
            if(!empty($result))
            {
                if($this->Owner_model->deleteTeamOwner($owner_id))
                {
                    @unlink(OWNER_IMAGE_PATH.$result['banner_website']);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Owner Deleted Successfully.</div>');
                    redirect('admin/owner?msg=success');
                }
                else
                {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
                }
            }
        }
        redirect('admin/owner?msg=failure');   
    }



    function uploadOwner($field,$file)
    {
        
        $config = array(
                'file_name'=>$_FILES[$file]['name'],
                'file_variable'=>$file,
                'upload_path' => OWNER_IMAGE_UPLOAD_PATH,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'        => "2024KB"
            );

        if(isset($config['file_name']) && $config['file_name']!='')
        {
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload($config['file_variable']))
            {
                $this->form_validation->set_message('uploadOwner', "Kindly select a valid image");
                return false;
            }
            else
            {
                $uploaded_file = $this->upload->data();
                $this->$file = $uploaded_file['file_name'];
                return true;
            }
        }
    }



    
}
