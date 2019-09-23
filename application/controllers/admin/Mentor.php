<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends CI_Controller {

	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct ();
		$this->load->model(array('Mentor_model','Team_model'));
		$this->load->library('pagination');
		$this->load->helper('url');
		if( ! $this->session->checkAdminLogin()) 
		{ 
		redirect('/admin',true);
		}
	}	
	public function index()
	{		
		$this->mlist();
	}

	/***********************************************
	** Function to display mentor list
	***********************************************/
	public function mlist()
	{
		// init params
        $params = array();
        $limit_per_page = 10;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_records = $this->Mentor_model->get_mentor_total();
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->Mentor_model->get_mentor_page_records($limit_per_page, $page*$limit_per_page);
            $config['base_url'] = base_url() . 'admin/mentor/mlist';
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
		$this->template->load('admin/layout/admin_tpl','admin/mentor/list',$params);
	}

	/***********************************************
	** Function to add new mentor
	***********************************************/
	public function addNew()
	{		
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$mentor_picture = $this->do_upload('mentor_picture');
			if(!$mentor_picture['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$mentor_picture['data'].'</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}
			$mentor_slider_picture = $this->do_upload('mentor_slider_picture');
			if(!$mentor_slider_picture['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$mentor_slider_picture['data'].'</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}
			$mentor_detail = array(
								'mentor_name' => $this->input->post('mentor_name'),
								'mentor_type' => $this->input->post('mentor_type'),
								'mentor_pic' => $mentor_picture['data']['file_name'],
								'mentor_slider_pic' => $mentor_slider_picture['data']['file_name'],
								'mentor_age' => $this->input->post('mentor_age'),
								'mentor_team_id' => $this->input->post('mentor_team_id'),
								'mentor_gpi' => $this->input->post('mentor_gpi'),
								'mentor_itm' => $this->input->post('mentor_itm'),
								'mentor_description' => $this->input->post('mentor_description'),
								'mentor_condition_text' => $this->input->post('mentor_condition_text'),
								'mentor_popup'=>$this->input->post('mentor_popup'),
								'mentor_status' => $this->input->post('mentor_status'),
								'author_name' => $this->session->userdata('uname'),
								'linux_added_on' => time(),
								'linux_modified_on' => time());
			if($this->Mentor_model->add_mentor($mentor_detail))
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Mentor added succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
		$data['teams'] = $this->Team_model->getTeamList();
		$data['form'] = 'add';		
		$this->template->load('admin/layout/admin_tpl','admin/mentor/add_edit',$data);
	}

	/***********************************************
	** Function to update mentor status
	***********************************************/
	public function updateStatus($status,$mentor_id)
	{
		$mentor_id = (int)trim($mentor_id);
		if($mentor_id <> '' && is_int($mentor_id))
		{
			$mentor = $this->Mentor_model->get_mentor($mentor_id);
			if($mentor)
			{
				$status = ($status == 'active')?1:0;
				if($this->Mentor_model->update_mentor($mentor_id, array('mentor_status' => $status, 'linux_modified_on' => time())))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Mentor status changed succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Mentor not updated successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Mentor information is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid mentor.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to delete mentor from system
	***********************************************/
	public function delete($mentor_id)
	{
		$mentor_id = (int)trim($mentor_id);
		if($mentor_id <> '' && is_int($mentor_id))
		{
			$mentor = $this->Mentor_model->get_mentor($mentor_id);
			if($mentor)
			{
				if($this->Mentor_model->delete_mentor($mentor_id))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Mentor deleted succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Mentor not deleted successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Mentor information is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid mentor.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to edit mentor information
	***********************************************/
	public function edit($mentor_id)
	{
		$mentor_id = (int)trim($mentor_id);
		$data['mentor'] = array();
		if($mentor_id <> '' && is_int($mentor_id))
		{
			$data['mentor'] = $this->Mentor_model->get_mentor($mentor_id);
			if($data['mentor'])
			{
				//Update edited content
				if($this->input->server ('REQUEST_METHOD') === 'POST')
				{
					$mentor_detail = array(
										'mentor_name' => $this->input->post('mentor_name'),
										'mentor_type' => $this->input->post('mentor_type'),										
										'mentor_age' => $this->input->post('mentor_age'),
										'mentor_team_id' => $this->input->post('mentor_team_id'),
										'mentor_gpi' => $this->input->post('mentor_gpi'),
										'mentor_itm' => $this->input->post('mentor_itm'),
										'mentor_description' => $this->input->post('mentor_description'),
										'mentor_condition_text' => $this->input->post('mentor_condition_text'),
										'mentor_status' => $this->input->post('mentor_status'),
										'mentor_popup'=>$this->input->post('mentor_popup'),
										'author_name' => $this->session->userdata('uname'),
										'linux_modified_on' => time());
					
					if(is_uploaded_file($_FILES['mentor_picture']['tmp_name']))
					{
						$mentor_picture = $this->do_upload('mentor_picture');
						if(!$mentor_picture['status'])
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$mentor_picture['data'].'</div>');
							$this->session->set_flashdata('post_data', $_POST);
							redirect($_SERVER['HTTP_REFERER']);
						}
						$mentor_detail['mentor_pic'] = $mentor_picture['data']['file_name'];
					}
					if(is_uploaded_file($_FILES['mentor_slider_picture']['tmp_name']))
					{
						$mentor_slider_picture = $this->do_upload('mentor_slider_picture');
						if(!$mentor_slider_picture['status'])
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> '.$mentor_slider_picture['data'].'</div>');
							$this->session->set_flashdata('post_data', $_POST);
							redirect($_SERVER['HTTP_REFERER']);
						}
						$mentor_detail['mentor_slider_pic'] = $mentor_slider_picture['data']['file_name'];
					}
				
					if($this->Mentor_model->update_mentor($this->input->post('mentor_id'),$mentor_detail))
					{
						$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Mentor updated succesfully.</div>');
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
					}
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Mentor information is not available.</div>');				
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid mentor.</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data['teams'] = $this->Team_model->getTeamList();
		$data['form'] = 'edit';
		$this->template->load('admin/layout/admin_tpl','admin/mentor/add_edit',$data);
	}

	/***********************************************
	** Function to upload files
	***********************************************/
	public function do_upload($field)
	{
			$config['upload_path']          = './images/mentor/';
			$config['allowed_types']        = 'jpg|png|jpeg';
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



}