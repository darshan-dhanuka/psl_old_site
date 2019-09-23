<?php

/*
	Dashboard model
*/

class Cms_model extends CI_Model {


    function __construct() 
    {
      parent::__construct();
    }
 
    /***********************************************
	** Function to delete mentor from system
    ** Param: page limit, page offset
	***********************************************/
    public function get_cmspage_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('page_id','desc');
        $query = $this->db->get("psl_cms");
 
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } 
        return false;
    }

    /***********************************************
	** Function to total row of mentor from system
	***********************************************/
    public function get_cmspage_total() 
    {
        return $this->db->count_all("psl_cms");
    }

    /***********************************************
	** Function to get mentor from DB by mentor id
    ** Param: Mentor id
	***********************************************/
    public function get_cmspage($page_id) 
    {
        $query = $this->db->get_where("psl_cms", array('page_id' => $page_id)); 
        if ($query->num_rows() > 0) 
        {
            return $query->row_array();
        } 
        return false;
    }

    /***********************************************
	** Function to get mentor from DB by mentor id
    ** Param: Mentor id
	***********************************************/
    public function get_cmspage_by($data) 
    {
        $query = $this->db->get_where("psl_cms", $data); 
        if ($query->num_rows() > 0) 
        {
            return $query->row_array();
        } 
        return false;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function update_cmspage($page_id, $data) 
    {    
        $query = $this->db->update("psl_cms", $data, array('page_id' => $page_id));
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
    public function delete_cmspage($page_id) 
    {
        $query = $this->db->delete("psl_cms", array('page_id' => $page_id)); 
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
    public function add_cmspage($data) 
    {
        $query = $this->db->insert("psl_cms", $data); 
        if ($this->db->insert_id()) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to insert mentor into DB
    ** Param: Mentor id
	***********************************************/
    public function getPageURL() 
    {
        $this->db->select('page_name, page_url');
        $query = $this->db->get_where("psl_cms", array('page_status' => 1)); 
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } 
        return false;
    }

    /***********************************************
	** Function to get  online schedule from system
    ** Param: page limit, page offset
	***********************************************/
    public function get_onlineschedule_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("psl_schedule_online");
 
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } 
        return false;
    }

    /***********************************************
	** Function to total row of online schedule from system
	***********************************************/
    public function get_onlineschedule_total() 
    {
        return $this->db->count_all("psl_schedule_online");
    }

    public function addScheduleOnline($data)
    {
        $query = $this->db->insert('psl_schedule_online', $data);
        if ($this->db->insert_id()) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    public function get_scheduleOnline($id ='')
    {
        if($id <> '')
            $this->db->where('id', $id);
        $query = $this->db->get('psl_schedule_online');
        if ($query->num_rows() > 0)
        {
            if($id <> '')
                return $query->row_array();
            else
                return $query->result_array();
        }            
        else
            return false;
    }

    /***********************************************
	** Function to delete mentor from DB
    ** Param: Mentor id
	***********************************************/
    public function delete_scheduleOnline($id = '') 
    {
        if($id <> '')
            $this->db->where('id', $id);
        else
            $this->db->where('status', 1);
        $query = $this->db->delete("psl_schedule_online"); 
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function update_onlineTourney($id, $data) 
    {   
        $query = $this->db->update("psl_schedule_online", $data, array('id' => $id));
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to get  live schedule from system
    ** Param: page limit, page offset
	***********************************************/
    public function get_liveschedule_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('id','desc');
        $query = $this->db->get("psl_schedule_live");
 
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } 
        return false;
    }

    /***********************************************
	** Function to total row of live schedule from system
	***********************************************/
    public function get_liveschedule_total() 
    {
        return $this->db->count_all("psl_schedule_live");
    }

    public function addScheduleLive($data)
    {
        $query = $this->db->insert('psl_schedule_live', $data);
        if ($this->db->insert_id()) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    public function get_scheduleLive($id ='')
    {
        if($id <> '')
            $this->db->where('id', $id);
        $query = $this->db->get('psl_schedule_live');
        if ($query->num_rows() > 0)
        {
            if($id <> '')
                return $query->row_array();
            else
                return $query->result_array();
        }            
        else
            return false;
    }

    /***********************************************
	** Function to delete mentor from DB
    ** Param: Mentor id
	***********************************************/
    public function delete_scheduleLive($id = '') 
    {
        if($id <> '')
            $this->db->where('id', $id);
        else
            $this->db->where('status', 1);
        $query = $this->db->delete("psl_schedule_live"); 
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function update_liveTourney($id, $data) 
    {   
        $query = $this->db->update("psl_schedule_live", $data, array('id' => $id));
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function getHomeData($key='') 
    {   
        if($key <> '')
            $this->db->where('key', $key);
        $query = $this->db->get("psl_home");
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function updateHome($key, $value) 
    {
        $this->db->update("psl_home", array('value' => $value), array('key' => $key));
        if ($this->db->affected_rows() > 0) 
        {
            return TRUE;
        } 
        return FALSE;
    }

    /***********************************************
	** Function to update mentor info into DB
    ** Param: Mentor id, update data array
	***********************************************/
    public function addHome($key, $value) 
    { 
        $this->db->insert("psl_home", array('key' => $key, 'value' => $value, 'linux_modified_on' => time()));
        if ($this->db->insert_id()) 
        {
            return TRUE;
        } 
        return FALSE;
    }

}