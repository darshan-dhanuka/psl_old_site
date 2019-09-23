<?php

/*
	Dashboard model
*/

class Fantasy_model extends CI_Model
{
	
	public function addPlayerScore($arr)
	{
		if(sizeof($arr)){
			$this->db->insert('psl_fantasy_player_score',$arr);
		}
		
	}

	public function getFantasyUsersDetail($day)
	{
		$this->db->select('*,ps.id as id');
		$this->db->join('psl_fantasy_player_list pl', 'pl.id = ps.player_id', 'left');
		$query = $this->db->get_where('psl_fantasy_player_score ps',array('day'=>$day));
		return $query->result_array();
	}

	public function updateUserScore($id,$score_info)
	{
		if($this->db->update('psl_fantasy_player_score', $score_info, array('id' => $id)))
		{
			return true;
		}
		return false;
	}

	public function addPlayerList($arr)
	{
		if(sizeof($arr)){
			$this->db->insert('psl_fantasy_player_list',$arr);
		}
	}

	public function getFantasyUsersList($year)
	{
		$query = $this->db->get_where('psl_fantasy_player_list',array('year'=>$year,'status'=>1));
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	public function checkUniqueTeamName($team_name,$season=0)
	{
		$query = $this->db->get_where('psl_fantasy_team',array('team_name'=>trim($team_name),'season'=>$season));
		$result = $query->row_array();	
		if(!empty($result))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function saveFantasyTeam($team_data,$player_array,$update=false)
	{

		$this->db->trans_begin();
		if($update==false)
		{
			$this->db->insert('psl_fantasy_team',$team_data);
			$team_id = $this->db->insert_id();
		}
		else
		{
			$team_id = $team_data['team_id'];
			$this->db->delete('psl_fantasy_team_player', array('team_id' =>$team_id));
		}

		$team_player = array();
		foreach($player_array as $index=>$player_id)
		{
			$team_player[$index]['team_id'] = $team_id;
			$team_player[$index]['player_id'] = $player_id;
			$team_player[$index]['linux_added_on'] = time();
		}
		
		if($this->db->insert_batch('psl_fantasy_team_player',$team_player))
		{
			$this->db->trans_commit();
			return true;
		}
		else
		{
			$this->db->trans_rollback();
			return false;
		}

	}

	public function getFantasyLeaderboard($day = NULL,$season = NULL,$limit = NULL)
	{
		$limit_condition = '';
		if($limit != NULL){
			$limit_condition = 'Limit 20';
		}
		if($day == NULL){
			$query = $this->db->query('SELECT any_value(psl_users.user_name) as user_name,team.team_name, SUM( score.score ) as score FROM `psl_fantasy_team` team LEFT JOIN psl_users on psl_users.user_id=team.user_id LEFT JOIN psl_fantasy_team_player team_player ON team.id = team_player.team_id LEFT JOIN psl_fantasy_player_score score ON score.player_id = team_player.player_id where team.season='.$season.' GROUP BY team_name order by score desc '.$limit_condition);
		}else{
			$query = $this->db->query('SELECT any_value(psl_users.user_name) as user_name,team.team_name, SUM( score.score ) as score FROM `psl_fantasy_team` team LEFT JOIN psl_users on psl_users.user_id=team.user_id LEFT JOIN psl_fantasy_team_player team_player ON team.id = team_player.team_id LEFT JOIN psl_fantasy_player_score score ON score.player_id = team_player.player_id where score.day='.$day.' AND team.season='.$season.' GROUP BY team_name order by score desc '.$limit_condition);
		}
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	public function updatePlayerStatus($id,$status)
	{
		$this->db->update('psl_fantasy_player_list', $status, array('id' => $id));
		return $this->db->affected_rows() > 0;
	}

	public function checkOwnFantasyTeam($user_id=0,$season=0)
	{
		$query = $this->db->get_where('psl_fantasy_team',array('user_id'=>$user_id,'season'=>$season));
		$result = $query->row_array();	
		if(!empty($result))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function downloadLeaderboard($season){
		$query = $this->db->query('SELECT any_value(psl_users.user_name) as user_name, team.team_name,any_value(team.id) as id,any_value(team_player.team_id) as team_id, SUM( score.score ) AS score, score.day as day FROM `psl_fantasy_team` team LEFT JOIN psl_users ON psl_users.user_id = team.user_id LEFT JOIN psl_fantasy_team_player team_player ON team.id = team_player.team_id LEFT JOIN psl_fantasy_player_score score ON score.player_id = team_player.player_id WHERE team.season ='.$season.' GROUP BY team_name, DAY ORDER BY team_id');
		return $query->result_array();
	}
	
	public function getDays()
	{
		$query = $this->db->query("select distinct(day) from  psl_fantasy_player_score order by day");
		return $query->result_array();

	}
	public function getMyFantasyTeam($user_id,$season)
	{
		$sql = 'SELECT * FROM psl_fantasy_team_player pftp JOIN psl_fantasy_player_list as pfpl on pftp.player_id = pfpl.id WHERE team_id = (SELECT id FROM psl_fantasy_team WHERE user_id = '.$user_id.' AND season = '.$season.' )';

		$query = $this->db->query($sql);

		return $query->result_array();

	}

	public function getFantasyTeamName($user_id,$season=0)
	{
		$query = $this->db->get_where('psl_fantasy_team',array('user_id'=>$user_id,'season'=>$season));
		$result = $query->row_array();	
		return $result;
	}

	public function downloadFantasyTeam($season)
	{
		$this->db->select('psl_fantasy_team.user_id, user_name, psl_fantasy_team.team_name, player_name, category, FROM_UNIXTIME( psl_fantasy_team.linux_added_on ) AS created_on');
		$this->db->join('psl_fantasy_team', 'psl_fantasy_team.id = psl_fantasy_team_player.team_id', 'left');
		$this->db->join('psl_fantasy_player_list', 'psl_fantasy_player_list.id = psl_fantasy_team_player.player_id', 'left');
		$this->db->join('psl_users', 'psl_users.user_id = psl_fantasy_team.user_id', 'left');
		$query = $this->db->get_where('psl_fantasy_team_player',array('psl_fantasy_team.season'=>$season));
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return false;
	}

}
