<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct ();

		$this->load->model ( array ('team_model','banner_model','mentor_model', 'cms_model' ) );
	}
	public function index()
	{

		$data ['mentor_detail'] = $this->memcached_library->get('home_mentor_detail');
		if (!$data ['mentor_detail'])
		{
			$data ['mentor_detail'] = $this->mentor_model->get_slider_mentor ();
			$this->memcached_library->add('home_mentor_detail', $data ['mentor_detail']);
		}

		$data ['banner'] = $this->memcached_library->get('home_banner');
		if (!$data['banner'])
		{
			$data['banner']=$this->banner_model->getHomePageBanner(array('status'=>1));
			$this->memcached_library->add('home_banner', $data ['banner']);
		}

		$data ['team_logo'] = $this->memcached_library->get('home_team_logo');
		if (!$data ['team_logo'])
		{
			$data ['team_logo'] = $this->team_model->getTeamList (1);
			$this->memcached_library->add('home_team_logo', $data ['team_logo']);
		}
		
		$home = $this->memcached_library->get('home_page_data');
		if (!$home)
		{
			$home = $this->cms_model->getHomeData();
			$this->memcached_library->add('home_page_data', $home);
		}
		
		$data['homeContent'] = array();
		if($home)
		foreach($home as $row)
		{
			$data['homeContent'][$row['key']] = $row['value'];
		}
		$this->load->view ( 'home', $data );
	}
}