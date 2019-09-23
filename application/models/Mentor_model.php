<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*	Mentor model
*/

class Mentor_model extends CI_Model
{
    function __construct() 
    {
      parent::__construct();
    }
 
    /***********************************************
	** Function to delete mentor from system
    ** Param: page limit, page offset
	***********************************************/
    public function get_mentor_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->join('psl_team pt','pm.mentor_team_id=pt.id','LEFT');
        $this->db->order_by('mentor_id','desc');
        $query = $this->db->get("psl_mentor pm");
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } 
        return false;
    }

    /***********************************************
	** Function to total row of mentor from system
	***********************************************/
    public function get_mentor_total() 
    {
        return $this->db->count_all("psl_mentor");
    }

    /***********************************************
	** Function to get mentor from DB by mentor id
    ** Param: Mentor id
	***********************************************/
    public function get_mentor($mentor_id ='') 
    {
        if($mentor_id<> '')
            $this->db->where('mentor_id', $mentor_id);
        
        $query = $this->db->get("psl_mentor"); 
        if ($query->num_rows() > 0) 
        {
            if($mentor_id<> '')
                return $query->row_array();
            else
                return $query->result();
        } 
        return false;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function update_mentor($mentor_id, $data) 
    {    
        $query = $this->db->update("psl_mentor", $data, array('mentor_id' => $mentor_id)); 
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to delete mentor from DB
    ** Param: Mentor id
	***********************************************/
    public function delete_mentor($mentor_id) 
    {
        $query = $this->db->delete("psl_mentor", array('mentor_id' => $mentor_id)); 
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to insert mentor into DB
    ** Param: Mentor id
	***********************************************/
    public function add_mentor($data) 
    {
        $query = $this->db->insert("psl_mentor", $data); 
        if ($this->db->insert_id()) 
        {
            return TRUE;
        } 
        return FALSE;
    }



    /***********************************************
	** Function to get teams from DB
	***********************************************/
    public function get_slider_mentor() 
    {
        $this->db->join('psl_team','psl_mentor.mentor_team_id = psl_team.id');
        $query = $this->db->get_where("psl_mentor", array('mentor_status' => 1, 'mentor_type' => 'mentor')); 
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } 
        return FALSE;
    }
    
    
    // 	function to get  team mentor information using team id
    public function getTeamMentor($team_id,$mentor){
    	$this->db->select("*");
    	$query=	$this->db->get_where("psl_mentor",array('mentor_team_id'=>$team_id,"mentor_type"=>$mentor,'mentor_status'=>1));
    	if ($query->num_rows () > 0)
    		return $query->result_array();
    		else
    			return false;
    }
}
