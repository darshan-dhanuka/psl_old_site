<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_page extends CI_Controller {

	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct ();
		$this->load->model(array('cms_model', 'user_model'));
	}	

	/***********************************************
	** Function to display cms list
	***********************************************/
	public function page($value)
	{
		if($value)
		{
			$data['pageinfo'] = $this->memcached_library->get('psl_'.$value);
			if (!$data['pageinfo'])
			{
				$data['pageinfo'] = $this->cms_model->get_cmspage_by(array('page_name' => $value, 'page_status' => 1));
				$this->memcached_library->add('psl_'.$value, $data['pageinfo']);
			}
			if($data['pageinfo'])
			{
				$home = $this->cms_model->getHomeData();
				$data['homeContent'] = array();
				if($home)
				foreach($home as $row)
				{
					$data['homeContent'][$row['key']] = $row['value'];
				}
				$data['live_qualifier'] = false;
				$data['online_qualifier'] = false;
				$serverURI=$this->uri->uri_string();
				if($serverURI == 'schedule/live-qualifier')
				{
					$tournament_info = $this->user_model->getScheduleLiveByTotalRegistration();
					if($this->session->checkLogin() != FALSE)
					{
						$user_info = $this->user_model->getRegisteredTournamentByUserId($this->session->userdata('user_id'));
						$tournament_id_arr = array();
						foreach($user_info as $key=>$value)
						{
							array_push($tournament_id_arr,$value['tournament_id']);
						}
						
						foreach($tournament_info as $key=>$val)
						{
							if(in_array($val['id'],$tournament_id_arr))
								$val['is_reg'] = 1;
							else
								$val['is_reg'] = 0;	
							$tournament_info[$key] = $val;
						}
					}
					else
					{
						foreach($tournament_info as $key=>$val)
						{
							$val['is_reg'] = 0;
							$tournament_info[$key] = $val;
						}
					}
					$data['live_qualifier'] = $tournament_info;
				}

				if($serverURI == 'schedule/online-qualifier')
				{
					$data['online_qualifier'] = $this->user_model->getScheduleOnline();
				}
				$this->load->view ('cms_tpl', $data );	
			}else{
				show_404();
			}						
		}else{
			show_404();
		}
	}

}
