<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct ();
		$this->load->model(array('Cms_model'));
		$this->load->library('pagination');
		$this->load->helper('url');
		if( ! $this->session->checkAdminLogin()) 
		{ 
		redirect('/admin',true);
		}
	}	

	public function index()
	{		
		$this->clist();
	}

	/***********************************************
	** Function to display cms list
	***********************************************/
	public function clist()
	{
		// init params
        $params = array();
        $limit_per_page = 10;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_records = $this->Cms_model->get_cmspage_total();
     
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->Cms_model->get_cmspage_page_records($limit_per_page, $page*$limit_per_page);
                 
            $config['base_url'] = base_url() . 'admin/cms/clist';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<div class="pagination">';
            $config['full_tag_close'] = '</div>';
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $params["links"] = $this->pagination->create_links();
        }
		$this->template->load('admin/layout/admin_tpl','admin/cms/list',$params);
	}

	/***********************************************
	** Function to add new cms
	***********************************************/
	public function addNew()
	{		
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$page_desktop_banner = $this->do_upload('page_desktop_banner');
			if(!$page_desktop_banner['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Desktop Banner Error!</strong> '.$page_desktop_banner['data'].'</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}			
			$page_mobile_banner = $this->do_upload('page_mobile_banner');
			if(!$page_mobile_banner['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Mobile Banner Error!</strong> '.$page_mobile_banner['data'].'</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}
						
			if($this->Cms_model->get_cmspage_by(array('page_name' => $this->input->post('page_name'))))
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Duplicate page name. Please choose another name to create page.</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}

			if($this->Cms_model->get_cmspage_by(array('page_url' => $this->input->post('page_url'))))
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Duplicate page url. Please choose another url to create page.</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}
			$cms_detail = array(
								'page_name' => $this->input->post('page_name'),
								'page_url' => $this->input->post('page_url'),
								'page_description' => $this->input->post('page_description'),
								'seo_title' => $this->input->post('seo_title'),
								'seo_meta' => $this->input->post('seo_meta'),
								'page_heading' => $this->input->post('page_heading'),
								'page_desktop_banner' => $page_desktop_banner['data']['file_name'],
								'page_mobile_banner' => $page_mobile_banner['data']['file_name'],
								'page_status' => $this->input->post('page_status'),
								'author_name' => $this->session->userdata('uname'),
								'linux_added_on' => time(),
								'linux_modified_on' => time());
			if($this->Cms_model->add_cmspage($cms_detail))
			{
				$this->createRoutes();				
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> cms added succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}		
		$data['form'] = 'add';		
		$this->template->load('admin/layout/admin_tpl','admin/cms/add_edit',$data);
	}

	/***********************************************
	** Function to update cms status
	***********************************************/
	public function updateStatus($status,$page_id)
	{
		$page_id = (int)trim($page_id);
		if($page_id <> '' && is_int($page_id))
		{
			$cms = $this->Cms_model->get_cmspage($page_id);
			if($cms)
			{				
				$status = ($status == 'active')?1:0;
				if($this->Cms_model->update_cmspage($page_id, array('page_status' => $status, 'linux_modified_on' => time())))
				{
					$this->createRoutes();
					$this->memcached_library->flush();
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> page status changed succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> page not updated successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> page information is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid page.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to delete cms from system
	***********************************************/
	public function delete($page_id)
	{
		$page_id = (int)trim($page_id);
		if($page_id <> '' && is_int($page_id))
		{
			$cms = $this->Cms_model->get_cmspage($page_id);
			if($cms)
			{
				if($this->Cms_model->delete_cmspage($page_id))
				{
					$this->createRoutes();
					$this->memcached_library->flush();
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> page deleted succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> page not deleted successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> page information is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid page.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to edit cms information
	***********************************************/
	public function edit($page_id)
	{
		$page_id = (int)trim($page_id);
		$data['cms'] = array();
		if($page_id <> '' && is_int($page_id))
		{
			$data['cms'] = $this->Cms_model->get_cmspage($page_id);
			if($data['cms'])
			{
				if($this->Cms_model->get_cmspage_by(array('page_id !=' =>$this->input->post('page_id'), 'page_name' => $this->input->post('page_name'))))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Duplicate page name. Please choose another name to create page.</div>');
					$this->session->set_flashdata('post_data', $_POST);
					redirect($_SERVER['HTTP_REFERER']);
				}

				if($this->Cms_model->get_cmspage_by(array('page_id !=' =>$this->input->post('page_id'), 'page_url' => $this->input->post('page_url'))))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Duplicate page url. Please choose another url to create page.</div>');
					$this->session->set_flashdata('post_data', $_POST);
					redirect($_SERVER['HTTP_REFERER']);
				}
				//Update edited content
				if($this->input->server ('REQUEST_METHOD') === 'POST')
				{
					$cms_detail = array(
									'page_name' => $this->input->post('page_name'),
									'page_url' => $this->input->post('page_url'),
									'page_description' => $this->input->post('page_description'),
									'seo_title' => $this->input->post('seo_title'),
									'seo_meta' => $this->input->post('seo_meta'),
									'page_heading' => $this->input->post('page_heading'),
									'page_status' => $this->input->post('page_status'),
									'author_name' => $this->session->userdata('uname'),
									'linux_added_on' => time());	

					if(is_uploaded_file($_FILES['page_desktop_banner']['tmp_name']))
					{
						$page_desktop_banner = $this->do_upload('page_desktop_banner');
						if(!$page_desktop_banner['status'])
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Desktop Banner Error!</strong> '.$page_desktop_banner['data'].'</div>');
							$this->session->set_flashdata('post_data', $_POST);
							redirect($_SERVER['HTTP_REFERER']);
						}
						$cms_detail['page_desktop_banner'] = $page_desktop_banner['data']['file_name'];
					}					
					if(is_uploaded_file($_FILES['page_mobile_banner']['tmp_name']))
					{
						$page_mobile_banner = $this->do_upload('page_mobile_banner');
						if(!$page_mobile_banner['status'])
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Mobile Banner Error!</strong> '.$page_mobile_banner['data'].'</div>');
							$this->session->set_flashdata('post_data', $_POST);
							redirect($_SERVER['HTTP_REFERER']);
						}
						$cms_detail['page_mobile_banner'] = $page_mobile_banner['data']['file_name'];
					}			

					if($this->Cms_model->update_cmspage($this->input->post('page_id'),$cms_detail))
					{
						$this->createRoutes();
						$this->memcached_library->flush();
						$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> page updated succesfully.</div>');
						redirect('/admin/cms');
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
					}
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> page information is not available.</div>');				
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid page.</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}		
		$data['form'] = 'edit';
		$this->template->load('admin/layout/admin_tpl','admin/cms/add_edit',$data);
	}

	/***********************************************
	** Function to upload files
	***********************************************/
	private function do_upload($field)
	{
			$config['upload_path']          = './images/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 2048;
			$config['remove_spaces']        = TRUE;
			$config['file_ext_tolower']     = TRUE;

			$this->load->library('upload');
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload($field))
			{
				 return array('status' => FALSE, 'data' => $this->upload->display_errors());
			}
			else
			{
				return array('status' => TRUE, 'data' => $this->upload->data());
			}
	}

	/***********************************************
	** Function to upload files
	***********************************************/
	public function uploadImage()
	{
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$upload_image = $this->do_upload('upload_image');
			if(!$upload_image['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$upload_image['data'].'</div>');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> File uploaded successfully</div>');
				$this->session->set_flashdata('img_url', base_url().'images/'.$upload_image['data']['file_name']);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}			
		$this->template->load('admin/layout/admin_tpl','admin/upload_image');
	}

	/***********************************************
	** Function to upload files
	***********************************************/
	private function createRoutes()
	{
		if(file_exists(BASEPATH.'../data/page_routes.php'))
		{
			$PageUrl = $this->Cms_model->getPageURL();
			if($PageUrl)
			{
				$url = '<?php';
				foreach ($PageUrl as $key) {
					$url .= "\r\n".'$route["'.$key->page_url.'"] = "cms_page/page/'.$key->page_name.'";';
				}
				$url .= "\r\n".'?>';
				file_put_contents(BASEPATH.'../data/page_routes.php', $url);
			}
		}
	}

	/***********************************************
	** Function to upload files
	***********************************************/
	public function manageHome()
	{
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$post_data = $this->input->post();
			$post_data = array_merge($post_data, $_FILES);
			foreach($post_data as $key=>$value)
			{
				$check_key = $this->Cms_model->getHomeData($key);
				if($check_key)
				{
					if($key == 'add')
						continue;
					if(isset($_FILES[$key]['tmp_name']) && $_FILES[$key]['tmp_name'] != '')
					{
						$file = $this->do_upload($key);
						$value = $file['data']['file_name'];
					}
					if(!is_array($value))
						$this->Cms_model->updateHome($key, $value);
				}else{
					if(isset($_FILES[$key]['tmp_name']) && $_FILES[$key]['tmp_name'] != '')
					{
						$file = $this->do_upload($key);
						$value = $file['data']['file_name'];
					}
					$this->Cms_model->addHome($key, $value);
				}
			}
			$this->memcached_library->flush();
			$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Home page Updated successfully</div>');
			redirect('/admin/cms/manageHome');
		}
		$home = $this->Cms_model->getHomeData();
		$data['homeInfo'] = array();
		if($home)
		foreach($home as $row)
		{
			$data['homeInfo'][$row['key']] = $row['value'];
		}
		$this->template->load('admin/layout/admin_tpl','admin/manage_home', $data);
	}

}
