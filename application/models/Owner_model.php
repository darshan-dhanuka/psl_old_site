<?php

/*
    Banner model
*/

class Owner_model extends CI_Model
{

    /**
     * method to add homepage banner
     */
    public function saveTeamOwner($data)
    {
        //echo '<pre>';print_r($data);die;
        if ($this->db->insert('psl_team_owner', $data))
            return TRUE;
        else
            return FALSE;
    }

    /***
    * method to get banner listing
    **/

    public function getOwnerList($param=array())
    {
        $this->db->select ( 'psl_team_owner.*');
        if(isset($param ['limit']))
        {
            $this->db->limit ( $param ['limit'], $param ['offset'] );
        }
        $this->db->order_by('id','desc');
        $query = $this->db->get('psl_team_owner');
        $owner_list = $query->result_array();
        return $owner_list;
    }

    /*****
    * update Banner
    ***/
    public function updateTeamOwner($owner=array())
    {
        if(!empty($owner))
        {
            $owner['linux_modified_on'] = time();
            if($this->db->update('psl_team_owner',$owner, array('id' => $owner['id'])))
            {
                return true;
            }
        }
        return false;
    }

    public function deleteTeamOwner($owner_id=null)
    {
        if($this->db->delete('psl_team_owner', array('id ' => $owner_id)))
        {
            return true;
        }
        return false;
    }

    public function getOwnerById($owner_id=null)
    {
        $result =array();
        if($owner_id!=null)
        {
            $query = $this->db->get_where('psl_team_owner',array('id'=>$owner_id));
            $result = $query->row_array();
        }
        return $result;
    }

    public function getOwnerCount($param = array())
    {
        $this->db->select('count(*) as owner_count');
        $query = $this->db->get('psl_team_owner');
        $result = $query->row_array();
        return $result['owner_count'];
    }
    
    // 	function to get  team owner information using team id
    public function getTeamOwner($team_id)
    {
    	$this->db->select("*");
    	$query=	$this->db->get_where("psl_team_owner",array('team_id'=>$team_id,'status'=>1));
    	if ($query->num_rows () > 0)
    		return $query->result_array ();
    		else
    			return false;
    }
}
