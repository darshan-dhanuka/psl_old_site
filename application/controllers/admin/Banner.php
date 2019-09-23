<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

	/**
	 * Constructor
	 */
    
    var $banner_website;
    var $banner_mobile;
	public function __construct()
    {
		parent::__construct ();
		$this->load->model(array('Banner_model'));

        if( ! $this->session->checkAdminLogin()) 
        { 
                redirect('/admin',true);
        }
	}	
	
	/**
	   Method: show homepage banner listing
	 */
	public function index()
	{
        $array = array();
        $data['banner_list'] = $this->Banner_model->getHomePageBanner($array);
        $this->template->load('admin/layout/admin_tpl','admin/banner/homepage_banner',$data);
	}

    /***    
    *   method to add homepage banner
    *****/

    public function addHomePageBanner()
    {
        if($this->input->server ('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules("banner_website","Banner Website",'callback_uploadBanner[banner_website]');

            $this->form_validation->set_rules("banner_mobile","Banner Mobile",'callback_uploadBanner[banner_mobile]');

            $this->form_validation->set_rules("banner_text","Banner Text",'required');
            $this->form_validation->set_rules("button_text","Button Text",'required');
            $this->form_validation->set_rules("button_url","Button Url",'required');
            $this->form_validation->set_rules("priority","Priority",'required|numeric|callback_isPositiveNumber['.$this->input->post("priority").']');
            if($this->form_validation->run() !== FALSE)
            {
                $banner_data['banner_website'] = $this->banner_website;
                $banner_data['banner_mobile'] = $this->banner_mobile;
                $banner_data['priority'] = $this->input->post('priority');
                $banner_data['banner_text'] = $this->input->post('banner_text');
                $banner_data['button_text'] = $this->input->post('button_text');
                $banner_data['button_url'] = $this->input->post('button_url');
                $banner_data['linux_added_on'] = time();
                $banner_data['linux_modified_on'] = time();
            
                if($this->Banner_model->saveHomepageBanner($banner_data))
                {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Banner added Successfully.</div>');
                    redirect('admin/banner');
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
        $this->template->load('admin/layout/admin_tpl','admin/banner/add_homepage_banner'); 
    }



    public function editHomePageBanner($banner_id=null)
    {
        if($this->input->server ('REQUEST_METHOD') === 'POST'){
           
            $this->form_validation->set_rules("banner_website","Banner Website",'callback_uploadBanner[banner_website]');

            $this->form_validation->set_rules("banner_mobile","Banner Mobile",'callback_uploadBanner[banner_mobile]');

            $this->form_validation->set_rules("banner_text","Banner Text",'required');
            $this->form_validation->set_rules("button_text","Button Text",'required');
            $this->form_validation->set_rules("button_url","Button Url",'required');
            $this->form_validation->set_rules("priority","Priority",'required|numeric|callback_isPositiveNumber['.$this->input->post("priority").']');
            if($this->form_validation->run() !== FALSE)
            {
                $filename_website = $this->banner_website;
                $filename_mobile = $this->banner_mobile;

                if(isset($filename_website) && $filename_website!='')
                {
                    $banner_data['banner_website'] = $filename_website;
                }
                if(isset($filename_mobile) && $filename_mobile!='')
                {
                   $banner_data['banner_mobile'] = $filename_mobile;
                }
                $banner_data['id'] = $this->input->post('banner_id');
                $banner_data['priority'] = $this->input->post('priority');
                $banner_data['banner_text'] = $this->input->post('banner_text');
                $banner_data['button_text'] = $this->input->post('button_text');
                $banner_data['button_url'] = $this->input->post('button_url');
                $activeBanner=$this->Banner_model->getActiveBannerCount();
                $bannerCount=sizeof($activeBanner);
                if($bannerCount>1)
                {
                $banner_data['status'] = 0;
                }
                else{
                	$banner_data['status'] = $this->input->post("status");
                }
                $banner_data['linux_modified_on'] = time();
                if($this->Banner_model->updateHomepageBanner($banner_data))
                {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Banner Updated Successfully.</div>');
                    redirect('admin/banner');
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
        $data['banner_data'] = $this->Banner_model->getBannerById($banner_id);
        $this->template->load('admin/layout/admin_tpl','admin/banner/edit_homepage_banner',$data); 
    }



    /****
    *   Method to activate and deactivate Homepage Banner
    *
    ******/
    public function updateBannerStatus()
    {
        $banner['status'] = $this->input->get('status');
        $banner['id'] = $this->input->get('banner_id');

        if(isset($banner['status']) && isset($banner['id']))
        {
            if($this->Banner_model->updateHomepageBanner($banner))
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Banner Updated Successfully.</div>');
                redirect('admin/banner');
            }
            else
            {
            	$activeBanner=$this->Banner_model->getActiveBannerCount();
            	$bannerCount=sizeof($activeBanner);
            	if($bannerCount>1)
            	{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
            	}
            	else{
            		$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Can not deactivate all banner .</div>');
            	}
            }
        }
        redirect('admin/banner');
    }

    public function deleteHomepageBanner()
    {
        $banner_id = $this->input->get('banner_id');
        if(isset($banner_id))
        {
            $result = $this->Banner_model->getBannerById($banner_id);
            if(!empty($result))
            {
                if($this->Banner_model->deleteHomepageBanner($banner_id))
                {
                    @unlink(BANNER_DATA_PATH.$result['banner_website']);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Banner Deleted Successfully.</div>');
                    redirect('admin/banner');
                }
                else
                {
                	$bannerCount=2;
                	$activebanner=$this->Banner_model->getActiveBannerCount();
                	$bannerCount=sizeof($activebanner);
                	if($bannerCount==1){
                		if($activebanner[0]['id']==$banner_id)
                		{
                			$bannerCount=0;
                		}
                		else{
                			$bannerCount=2;
                		}
                	}
                	if($bannerCount>1)
                	{
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try again.</div>');
                	}
                	else{
                		$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Can not delete all active banner.</div>');
                	}
                }
            }
        }
       // $this->session->set_flashdata('msg', 'Banner Could not be deleted Successfully');
        redirect('admin/banner');   
    }

    function uploadBanner($field,$banner)
    {
        
        $config = array(
                'file_name'=>$_FILES[$banner]['name'],
                'file_variable'=>$banner,
                'upload_path' => BANNER_IMAGE_UPLOAD_PATH,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'        => "2024KB"
            );

        if(isset($config['file_name']) && $config['file_name']!='')
        {
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload($config['file_variable']))
            {
                $this->form_validation->set_message('uploadBanner', "Kindly select a valid file");
                return false;
            }
            else
            {
                $file = $this->upload->data();
                $this->$banner = $file['file_name'];
                return true;
            }
        }
    }

    public function isPositiveNumber($field,$number)
    {
        if(is_numeric($number) && $number >= 0){
         return true; 
        }
        else{
            $this->form_validation->set_message('isPositiveNumber', "Kindly enter positive integer");
            return false;
        }
    }



    
}
