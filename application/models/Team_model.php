<?php

/*
	Team model
*/

class Team_model extends CI_Model {


	/**
	 * method to get the team List
	 */
	public function getTeamList($status="all")
	{
		if($status=="all")
		$this->db->where('status !=',2);
		else{
			$this->db->where('status =',$status);
			$this->db->order_by('team_name','asc');
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get('psl_team');
		return $query->result_array();
	}

	/**
	 * method to get the team List
	 */
	public function updateTeam($team_id,$team_info)
	{
		$this->db->update('psl_team', $team_info, array('id' => $team_id));
		 if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
	}

	 /**
     * method to check if the email_id exists in DB
     */
    public function saveTeam($team_info)
    {
        if($this->db->insert('psl_team', $team_info))
        	return true;
        else
        	return false;
    }
    public  function getAllRegion($region="all")
	{
		$this->db->select('*');
		if($region!="all")
		{
			$this->db->where('id',$region);
		}
		$query=$this->db->get('psl_region');
		return $query->result_array();
	}
	
	public function getTeamInfo($team='all')
	{
		$this->db->select("*");
		if($team=='all')
		{
			$query=$this->db->get('psl_team');
		}
		else
		{
			$query=$this->db->get_where('psl_team',array('id'=>$team));
		}
		if ($query->num_rows () > 0)
		{
			$data['data']= $query->result_array ();
			$data['status']=TRUE;
		}
		else{
			$data['data']= '';
			$data['status']=FALSE;
		}
		return $data;
	}
	
	public function getTeamOwnerMentorDetail($team="all")
	{
		$sql="select pt.id,pt.team_name,pt.team_logo,pt.meet_the_team,pt.region_id,pt.page_url,pm.mentor_id,pm.mentor_name,pm.mentor_status,pr.region_name from psl_team as pt left join (select mentor_id,mentor_name,mentor_status,mentor_team_id from psl_mentor where mentor_status=1 AND mentor_type='Mentor') as pm on pt.id = pm.mentor_team_id left join psl_region as pr on pr.id = pt.region_id where pt.status=1";
		$query=$this->db->query($sql);
		if ($query->num_rows () > 0)
			return $query->result_array ();
		else
			return false;
	}
	

	// function to get team id by url
	public function getTeamIdByUrl($url)
	{
		$this->db->select("id");
		$query=	$this->db->get_where("psl_team",array('page_url'=>$url,'status'=>'1'));
		if ($query->num_rows () > 0)
			return $query->row()->id;
			else
				return false;
	}

	public function getTeamMaster()
    {
        $query = $this->db->get_where('psl_team',array('status'=>1));
        $team_list = $query->result_array();
        $team_master = array();
        foreach($team_list as $row)
        {
            $team_master[$row['id']] = $row['team_name'];
        }
        return $team_master;
    }
    
    // function to get team id by url
    public function validateteamURL($url,$team_id=NULL)
    {
		$this->db->select ( "id" );
		if($team_id!=NULL)
		{
			$this->db->where('id!=',$team_id);
		}
		$query = $this->db->get_where ( "psl_team", array ('page_url' => $url,'status!=' => '2' ) );
		if ($query->num_rows () > 0)
			return $query->row ()->id;
		else
			return false;
	}
}