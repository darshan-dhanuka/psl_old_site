<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fantasy extends CI_Controller {
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct ();
		$this->load->model(array('Fantasy_model','mentor_model','Qualifier_model','banner_model','team_model','cms_model'));
		
		
	}
	/**
	 * method to show team listing page
	 */
	public function index()
	{
		$data = array();
		$user_id = ($this->session->userdata('user_id'))?$this->session->userdata('user_id'):0;
		$season = ($this->config->item('season'))?$this->config->item('season'):0;
		if($this->Fantasy_model->checkOwnFantasyTeam($user_id,$season))
		{
			$data['owns_team'] = 1;
		}
		$data['deadline_status'] = false;
		if($this->checkFantasyDeadline())
		{
			$data['deadline_status']=true;
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
		$this->load->view('fantasy',$data);
	}

	public function createFantasyTeam()
	{
		$user_id = ($this->session->userdata('user_id'))?$this->session->userdata('user_id'):0;
		$season = ($this->config->item('season'))?$this->config->item('season'):0;
		if($this->Fantasy_model->checkOwnFantasyTeam($user_id,$season) || !$this->checkFantasyDeadline())
		{
			redirect('/fantasy');
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
		$current_year = date('Y');
		$players_list = $this->Fantasy_model->getFantasyUsersList($current_year);
		foreach($players_list as $player){
			if(trim(strtolower($player['category'])) == 'mentor'){
				$data['mentor_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'pro'){
				$data['pro_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'live qualifier'){
				$data['live_qualifier_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'online qualifier'){
				$data['online_qualifier_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'wildcard'){
				$data['wildcard_list'][] = $player;
			}
		}
		//print_r($data['mentor_list']);die;
		$data['homeContent']['seo_title']='Create Your Fantasy Poker Team at Pokersportsleague.com, Create Team to Win';
		$data['homeContent']['seo_meta']=' <meta name="description" content="Create your favourite fantasy poker team at Pokersportsleague.com. Based on your intelligence you can create a team to win real cash at Pokersportsleague.">
  <meta name="keywords" content="Create fantasy poker team, fantasy poker to win real money, online fantasy poker"> ';
		$this->template->load('template/fantasy_tpl','create_fantasy_team', $data);
	}


	public function previewFantasyTeam()
	{
		$user_id = ($this->session->userdata('user_id'))?$this->session->userdata('user_id'):0;
		$season = ($this->config->item('season'))?$this->config->item('season'):0;
		if(!$this->Fantasy_model->checkOwnFantasyTeam($user_id,$season))
		{
			redirect('/fantasy');
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
		$current_year = date('Y');
		$players_list = $this->Fantasy_model->getFantasyUsersList($current_year);
		foreach($players_list as $player){
			if(trim(strtolower($player['category'])) == 'mentor'){
				$data['mentor_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'pro'){
				$data['pro_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'live qualifier'){
				$data['live_qualifier_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'online qualifier'){
				$data['online_qualifier_list'][] = $player;
			}else if(trim(strtolower($player['category'])) == 'wildcard'){
				$data['wildcard_list'][] = $player;
			}
		}

		$team_data = $this->Fantasy_model->getMyFantasyTeam($user_id,$season);
		$team_detail = array();
		$w = $o = $l = $p = $m = 0;
		$mentor = $pro = $lq =$oq = $wildcard = '';
		foreach($team_data as $team_player)
		{
			if(trim(strtolower($team_player['category']))=='wildcard')
			{
				$team_detail['wildcard'][$w] = $team_player;
				$wildcard .= ($wildcard)?','.$team_player['player_id']:$team_player['player_id'];
				$w++;
			}
			if(trim(strtolower($team_player['category']))=='online qualifier')
			{
				$team_detail['online_qualifier'][$o] = $team_player;
				$oq .= ($oq)?','.$team_player['player_id']:$team_player['player_id'];
				$o++;
			}
			if(trim(strtolower($team_player['category']))=='live qualifier')
			{
				$team_detail['live_qualifier'][$l] = $team_player;
				$lq .= ($lq)?','.$team_player['player_id']:$team_player['player_id'];
				$l++;
			}
			if(trim(strtolower($team_player['category']))=='pro')
			{
				$team_detail['pro'][$p] = $team_player;
				$pro .= ($pro)?','.$team_player['player_id']:$team_player['player_id'];
				$p++;
			}
			if(trim(strtolower($team_player['category']))=='mentor')
			{
				$team_detail['mentor'][$m] = $team_player;
				$mentor .= ($mentor)?','.$team_player['player_id']:$team_player['player_id'];
			}
		}
		//echo '<pre>';print_r($team_detail);die; 
		$team_name = $this->Fantasy_model->getFantasyTeamName($user_id,$season);
		$data['team_detail'] = $team_detail;
		$data['team_name'] = $team_name['team_name'];
		$data['mentor_data']= $mentor;
		$data['pro_data'] = $pro;
		$data['lq_data'] = $lq;
		$data['oq_data'] = $oq;
		$data['wildcard_data']=$wildcard;
		$data['deadline_status'] = false;

		if($this->checkFantasyDeadline())
		{
			$data['deadline_status']=true;
		}
		$data['homeContent']['seo_title']='Team Preview of Your Fantasy Poker Team at Pokersportsleague.com';
		$data['homeContent']['seo_meta']=' <meta name="description" content="Team Preview of your Fantasy Poker Team at Pokersportsleague.com, know the details of your created team.">
  <meta name="keywords" content="Preview of Fantasy poker team, fantasy poker to win money, online fantasy poker"> ';
		$this->template->load('template/fantasy_tpl','preview_fantasy_team', $data);
	}



	public function saveFantasyTeam($update=false)
	{
		$mentor = $this->input->post('mentor');
		$pro = $this->input->post('pro');
		$live_qualifier = $this->input->post('live_qualifier');
		$online_qualifier = $this->input->post('online_qualifier');
		$wildcard = $this->input->post('wildcard');
		$team_name = ($update==false)?$this->input->post('team_name'):'default';
		$user_id = ($this->session->userdata('user_id'))?$this->session->userdata('user_id'):0;
		$error = '';
		$response = array();
		if(count($mentor)<1 || count($pro)<2 || count($live_qualifier)<2 || count($online_qualifier)<3 || count($wildcard)<2 || trim($team_name)=='' || $user_id==0)
		{
			$response = array('status'=>false,'msg'=>'Invalid data posted');
		}
		else 
		{
			if($this->checkFantasyDeadline())
			{
				$season = $this->config->item('season');
				if($update==false)
				{
					if(!$this->Fantasy_model->checkUniqueTeamName($team_name,$season))
					{
						$response = array('status'=>false,'msg'=>'Team Name already exist');
						echo json_encode($response);die;
					}
					$team_data['user_id'] = $user_id;
					$team_data['team_name'] = $team_name;
					$team_data['season'] = $this->config->item('season');
					$team_data['linux_added_on'] = time();
				}
				else
				{
					$team_detail = $this->Fantasy_model->getFantasyTeamName($user_id,$season);
					$team_data['team_id'] = $team_detail['id'];
				}
				$player_array = array_merge($mentor,$pro,$live_qualifier,$online_qualifier,$wildcard);
				$player_array_unique = array_unique($player_array);
				if($this->Fantasy_model->saveFantasyTeam($team_data,$player_array,$update)  && $player_array==$player_array_unique)
				{
					$response = array('status'=>true,'msg'=>'Team Created Successfully');
				}
			}
			else
			{
				$response = array('status'=>false,'msg'=>'Deadline exceed');			
			}
		}
		if(empty($response))
		{
			$response = array('status'=>false,'msg'=>'Something went wrong');	
		}
		echo json_encode($response);die;
	}


	public function udpateFantasyTeam()
	{
		$mentor = $this->input->post('mentor');
		$pro = $this->input->post('pro');
		$live_qualifier = $this->input->post('live_qualifier');
		$online_qualifier = $this->input->post('online_qualifier');
		$wildcard = $this->input->post('wildcard');
		$team_name = $this->input->post('team_name');
		$user_id = ($this->session->userdata('user_id'))?$this->session->userdata('user_id'):0;
		$error = '';
		$response = array();
		if(count($mentor)<1 || count($pro)<2 || count($live_qualifier)<2 || count($online_qualifier)<3 || count($wildcard)<2 || trim($team_name)=='' || $user_id==0)
		{
			$response = array('status'=>false,'msg'=>'Invalid data posted');
		}
		else 
		{
			$season = $this->config->item('season');
			if($this->Fantasy_model->checkUniqueTeamName($team_name,$season))
			{
				$team_data['user_id'] = $user_id;
				$team_data['team_name'] = $team_name;
				$team_data['season'] = $this->config->item('season');
				$team_data['linux_added_on'] = time();

				$player_array = array_merge($mentor,$pro,$live_qualifier,$online_qualifier,$wildcard);

				if($this->Fantasy_model->saveFantasyTeam($team_data,$player_array))
				{
					$response = array('status'=>true,'msg'=>'Team Created Successfully');
				}
			}
			else
			{
				$response = array('status'=>false,'msg'=>'Team Name already exist');
			}
		}
		if(empty($response))
		{
			$response = array('status'=>false,'msg'=>'Something went wrong');	
		}
		echo json_encode($response);die;
	}

	public function dayWiseLeaderboard()
	{
		if ($this->input->post ( "days" ))
		{
			$day = $this->input->post ( "days" );
			$data ['selected'] = $day;
		}
		else
		{
			$data ['selected'] = "1";
			$day = 1;
		}
		$season = ($this->config->item ( 'season' )) ? $this->config->item ( 'season' ) : 0;
		$limit = 20;
		$data ['leaderboard_data'] = $this->Fantasy_model->getFantasyLeaderboard ( $day, $season );
		$data ['days'] = $this->Fantasy_model->getDays ();

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

		$this->load->view ( 'day-leaderboard', $data );
	}

	public function cumulativeLeaderboard(){
		$season=$this->config->item('season');
		$data['leader_data'] = $this->Fantasy_model->getFantasyLeaderboard(NULL,$season);

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
		$this->load->view('cumulative-leaderboard',$data);
	}

	public function checkFantasyDeadLine()
	{
		$deadline = $this->config->item('fantasy_deadline');
		if(time() <= strtotime($deadline))
		{
			return true;
		}
		return false;
	}
}
?>