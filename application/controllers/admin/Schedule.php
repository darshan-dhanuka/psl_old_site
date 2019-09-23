<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

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

	/***********************************************
	** Function to display cms list
	***********************************************/
	public function index()
	{
		redirect('/admin/schedule/online');
	}

	/***********************************************
	** Function to display cms list
	***********************************************/
	public function online()
	{
		// init params
        $params = array();
        $limit_per_page = 10;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_records = $this->Cms_model->get_onlineschedule_total();
     
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->Cms_model->get_onlineschedule_page_records($limit_per_page, $page*$limit_per_page);
                 
            $config['base_url'] = base_url() . 'admin/schedule/online';
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
		$this->template->load('admin/layout/admin_tpl','admin/online_schedule/list',$params);
	}

	/***********************************************
	** Function to add new cms
	***********************************************/
	public function onlineUpload()
	{		
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$online_schedule = $this->do_upload('online_schedule','csv');
			if(!$online_schedule['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>CSV Error!</strong> '.$online_schedule['data'].'</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$csv_content = array_map('str_getcsv', file('./images/'.$online_schedule['data']['file_name']));
            $i=0;
            foreach($csv_content as $val)
            {
                $i++;
                if($i == 1)continue;
                $onlineSchedule = array(
									'tourney_name' => trim($val[0]),
									'date' => trim($val[1]),
									'time' => trim($val[2]),
									'entry_criteria' => trim($val[3]),
									'winnings' => trim($val[4])
								);
                $this->Cms_model->addScheduleOnline($onlineSchedule);				
            }			
			
			if($i == count($csv_content))
			{
				unlink('./images/'.$online_schedule['data']['file_name']);
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> ('.($i-1).') Online schedule upload succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}		
		$data['form'] = 'add';		
		$this->template->load('admin/layout/admin_tpl','admin/online_schedule/add_edit',$data);
	}

	/***********************************************
	** Function to update cms status
	***********************************************/
	public function updateOnlineStatus($status,$id)
	{
		$id = (int)trim($id);
		if($id <> '' && is_int($id))
		{
			$cms = $this->Cms_model->get_scheduleOnline($id);
			if($cms)
			{				
				$status = ($status == 'done')?1:0;
				if($this->Cms_model->update_onlineTourney($id, array('status' => $status)))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Tourney status changed succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Tourney not updated successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Tourney information is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid Tourney.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to delete cms from system
	***********************************************/
	public function deleteOnline($online_id)
	{
		$online_id = (int)trim($online_id);
		if($online_id <> '' && is_int($online_id))
		{
			$tourney = $this->Cms_model->get_scheduleOnline($online_id);
			if($tourney)
			{
				if($this->Cms_model->delete_scheduleOnline($online_id))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Schedule tourney deleted succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong>  Schedule tourney not deleted successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong>  Schedule tourney is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid schedule tourney.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to edit cms information
	***********************************************/
	public function editOnline($online_id)
	{
		$online_id = (int)trim($online_id);
		$data['tourney'] = array();
		if($online_id <> '' && is_int($online_id))
		{
			$data['tourney'] = $this->Cms_model->get_scheduleOnline($online_id);
			if($data['tourney'])
			{
				//Update edited content
				if($this->input->server ('REQUEST_METHOD') === 'POST')
				{
					$tourney_detail = array(
									'tourney_name' =>$this->input->post('tourney_name'),
									'date' =>$this->input->post('date'),
                                  	'time' => $this->input->post('time'),
                                  	'entry_criteria' =>$this->input->post('entry_criteria'),
                                  	'winnings'=>$this->input->post('winnings')
									);

					if($this->Cms_model->update_onlineTourney($this->input->post('id'),$tourney_detail))
					{
						$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Online schedule updated succesfully.</div>');
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
					}					
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Online schedule is not available.</div>');				
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid Online schedule.</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}		
		$data['form'] = 'edit';
		$this->template->load('admin/layout/admin_tpl','admin/online_schedule/add_edit',$data);
	}

	/***********************************************
	** Function to display cms list
	***********************************************/
	public function live()
	{
		// init params
        $params = array();
        $limit_per_page = 10;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_records = $this->Cms_model->get_liveschedule_total();
     
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->Cms_model->get_liveschedule_page_records($limit_per_page, $page*$limit_per_page);
                 
            $config['base_url'] = base_url() . 'admin/schedule/live';
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
            $params["links"] = $this->pagination->create_links();
        }
		$this->template->load('admin/layout/admin_tpl','admin/live_schedule/list',$params);
	}

	/***********************************************
	** Function to add new cms
	***********************************************/
	public function liveUpload()
	{		
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			$live_schedule = $this->do_upload('live_schedule','csv');
			if(!$live_schedule['status'])
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>CSV Error!</strong> '.$live_schedule['data'].'</div>');
				$this->session->set_flashdata('post_data', $_POST);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$csv_content = array_map('str_getcsv', file('./images/'.$live_schedule['data']['file_name']));
            $i=0;
            foreach($csv_content as $val)
            {
                $i++;
                if($i == 1)continue;
                $onlineSchedule = array(
									'city' => trim($val[0]),
									'venue' => trim($val[1]),
									'tourney_name' => trim($val[2]),
									'date' => trim($val[3]),									
									'entry' => trim($val[4]),
									'winnings' => trim($val[5]),
									'created' => date('Y-m-d H:i:s')
								);
                $this->Cms_model->addScheduleLive($onlineSchedule);				
            }			
			
			if($i == count($csv_content))
			{
				unlink('./images/'.$live_schedule['data']['file_name']);
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> ('.($i-1).') Live schedule upload succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}		
		$data['form'] = 'add';		
		$this->template->load('admin/layout/admin_tpl','admin/live_schedule/add_edit',$data);
	}

	/***********************************************
	** Function to update cms status
	***********************************************/
	public function updateLiveStatus($status,$id)
	{
		$id = (int)trim($id);
		if($id <> '' && is_int($id))
		{
			$cms = $this->Cms_model->get_scheduleLive($id);
			if($cms)
			{				
				$status = ($status == 'done')?1:0;
				if($this->Cms_model->update_liveTourney($id, array('status' => $status)))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Tourney status changed succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Tourney not updated successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Tourney information is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid Tourney.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to delete cms from system
	***********************************************/
	public function deleteLive($live_id)
	{
		$live_id = (int)trim($live_id);
		if($live_id <> '' && is_int($live_id))
		{
			$tourney = $this->Cms_model->get_scheduleLive($live_id);
			if($tourney)
			{
				if($this->Cms_model->delete_scheduleLive($live_id))
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Live Schedule tourney deleted succesfully.</div>');
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Live Schedule tourney not deleted successfully.</div>');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Live Schedule tourney is not available.</div>');				
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid live schedule tourney.</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to edit cms information
	***********************************************/
	public function editLive($live_id)
	{
		$live_id = (int)trim($live_id);
		$data['tourney'] = array();
		if($live_id <> '' && is_int($live_id))
		{
			$data['tourney'] = $this->Cms_model->get_scheduleLive($live_id);
			if($data['tourney'])
			{
				//Update edited content
				if($this->input->server ('REQUEST_METHOD') === 'POST')
				{
					$tourney_detail = array(
									'tourney_name' =>$this->input->post('tourney_name'),
									'date' =>$this->input->post('date'),
                                  	'time' => $this->input->post('time'),
                                  	'city' => $this->input->post('city'),
                                  	'venue' => $this->input->post('venue'),
                                  	'entry' =>$this->input->post('entry;),
                                  	'winnings'=>$this->input->post('winnings')
									);

					if($this->Cms_model->update_liveTourney($this->input->post('id'),$tourney_detail))
					{
						$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Live schedule updated succesfully.</div>');
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Try Again.</div>');
					}					
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Live schedule is not available.</div>');				
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong> Invalid Live schedule.</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}		
		$data['form'] = 'edit';
		$this->template->load('admin/layout/admin_tpl','admin/live_schedule/add_edit',$data);
	}

	/***********************************************
	** Function to upload files
	***********************************************/
	public function do_upload($field, $type='')
	{
			if($type == '')
				$type = 'jpg|png';
			$config['upload_path']          = './images/';
			$config['allowed_types']        = $type;
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
	** Function to delete cms from system
	***********************************************/
	public function delete($schedule)
	{
		$schedule = trim(strtolower($schedule));
		
		if($schedule == 'live')
		{
			if($this->Cms_model->delete_scheduleLive())
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Live Completed tourney deleted succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong>  Live Completed tourney not deleted successfully.</div>');
			}
		}else if($schedule == 'online')
		{
			if($this->Cms_model->delete_scheduleOnline())
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Online Completed tourney deleted succesfully.</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Warning!</strong>  Online Completed tourney not deleted successfully.</div>');
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Invalid Schedule type.</div>');
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	/***********************************************
	** Function to delete cms from system
	***********************************************/
	public function export($schedule)
	{
		$schedule = trim(strtolower($schedule));
		
		if($schedule == 'live')
		{
			$exportContent = $this->Cms_model->get_scheduleLive();			
		}else if($schedule == 'online')
		{
			$exportContent = $this->Cms_model->get_scheduleOnline();
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Invalid Schedule type.</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		if($exportContent)
		{
			$output = fopen("php://output",'w') or die("Can't open php://output");
			$header = false;
			header("Content-Type:application/csv"); 
			header("Content-Disposition:attachment;filename=$schedule".date('-d-m-y_H:i').".csv"); 
			
			foreach($exportContent as $row) {				
				if(!$header)
				{
					$head = array();
					foreach($row as $col=>$val)
						array_push($head, $col);
					fputcsv($output, $head);
					$header = true;
				}
				$body = array();
				foreach($row as $col=>$val)
					array_push($body, $val);
				fputcsv($output, $body);
			}
			fclose($output) or die("Can't close php://output");
		}
	}

}
