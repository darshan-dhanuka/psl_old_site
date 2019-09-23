<?php

/*
	Banner model
*/

class Qualifier_model extends CI_Model
{

    /**
     * method to get qulaifiers
     */
    public function getQualifiers($status,$cat_id=NULL,$team_id=NULL)
    {
       $this->db->select('pu.user_name as user_name,qualifier_image,category_id,pq.id as qualifier_id,pq.status as status,pc.category_name,pu.first_name as first_name,pu.last_name as last_name,');
       if($status=="2"){
       $this->db->where('pq.status !=',$status);
       }
       else {
       	$this->db->where('pq.status',$status);
       }
       if($cat_id!=NULL){
       	$this->db->where('pq.category_id ',$cat_id);
       }
       if($team_id!=NULL){
       	$this->db->where('pq.team_id',$team_id);
       }
       $this->db->from('psl_qualifier pq');
       $this->db->join('psl_users pu', 'pu.user_id = pq.user_id', 'left');
       $this->db->join('psl_player_category pc', 'pc.id = pq.category_id', 'left');
       $query = $this->db->get();
//        echo $this->db->last_query();die;
       if ($query->num_rows() > 0)
       {
       return $query->result_array();
       }
       else{
       	return false;
       }
    }

    /**
     * method to update qulaifiers
     */
    public function updateQualifier($qualifier_id,$update_details)
    {
        $this->db->update('psl_qualifier', $update_details, array('id' => $qualifier_id));
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

     /**
     * method to save qualifier
     */
    public function saveQualifier($data)
    {
        if ($this->db->insert('psl_qualifier', $data))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * method to get category list
     */
    public function getCategory()
    {
        $this->db->where('status',1);
        $query = $this->db->get('psl_player_category');
        return $query->result_array();
    }

    /**
     * method to get detail of qualifier
     */
    public function getQualifierDetails($qualifier_id)
    {
        $this->db->select('pq.*,pu.user_name as user_name,qualifier_image,category_id,pq.id as qualifier_id,pq.status as status');
        $this->db->where('id',$qualifier_id);
        $this->db->from('psl_qualifier as pq');
        $this->db->join('psl_users pu', 'pu.user_id = pq.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    /**
     * method to get qulaifierslist
     */
    public function getQualifierslist($status,$param)
    {
       $this->db->select('pu.user_name as user_name,qualifier_image,category_id,pq.id as qualifier_id,pq.status as status,pc.category_name');
       $this->db->where('pq.status !=',$status);
       $this->db->from('psl_qualifier pq');
       $this->db->join('psl_users pu', 'pu.user_id = pq.user_id', 'left');
       $this->db->join('psl_player_category pc', 'pc.id = pq.category_id', 'left');
       if(isset($param ['limit']))
        {
            $this->db->limit ( $param ['limit'], $param ['offset'] );
        }
        $this->db->order_by('pq.id','desc');
       $query = $this->db->get();
       //echo $this->db->last_query();die;
       return $query->result_array();
    }

    /**
     * method to get qulaifierslist
     */
    public function getQualifiersCount($status)
    {
       $this->db->select('count(*) as qualifier_count');
       $this->db->where('pq.status !=',$status);
       $this->db->from('psl_qualifier pq');
       $query = $this->db->get();
       $result = $query->row_array();
        return $result['qualifier_count'];
    }


}
