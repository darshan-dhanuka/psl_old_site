<?php

/*
	Dashboard model
*/

class Dashboard_model extends CI_Model {


	/**
	 * method to get the user info by user_id
	 */
	public function getAdminUsernameInfo($username)
	{
		$query = $this->db->get_where('admin_users', array('uname' => $username));
		$user_info = $query->row_array();
		return $user_info;
	}

	public function getTournamentDetailsById($id)
	{
		$query = $this->db->get_where('psl_schedule_live', array('id' => $id));
		return $query->row_array();
	}

	public function updateTournamentDetailsById($tournanment_info,$id)
	{
		if ($this->db->update('psl_schedule_live', $tournanment_info, array('id' => $id)))
            return true;
        else
            return false;
	}

	public function getOnlineTournamentDetailsById($id)
	{
		$query = $this->db->get_where('psl_schedule_online', array('id' => $id));
		return $query->row_array();
	}

	public function updateOnlineTournamentDetailsById($tournanment_info,$id)
	{
		if ($this->db->update('psl_schedule_online', $tournanment_info, array('id' => $id)))
            return true;
        else
            return false;
	}

	public function getUsersDetailsByStatus()
	{
		$sql = "select pu.user_id,pu.user_name,pu.email,pu.mobile,pu.first_name,pu.last_name,pu.gender,pu.dob,pu.address1,pu.address2,pu.city,pu.state,pu.doc_status,pud.doc_path,pvd.doc_name from psl_users pu
		left join psl_users_doc pud on pud.user_id=pu.user_id
		left join psl_verification_docs pvd on pvd.id=pud.doc_type_id where 1";

		if(trim($_POST['username'])!='')
			$sql .= " and pu.user_name='".$_POST['username']."'";

		if(trim($_POST['state'])!='')
			$sql .= " and pu.state='".$_POST['state']."'";

		if(trim($_POST['status'])!='')
			$sql .= " and pu.doc_status='".$_POST['status']."'";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
    	    return $query->result_array();	
    	else
    		return false;
	}

	public function updateUserDocStatus($status,$user_id)
	{
		if ($this->db->update('psl_users',array('doc_status'=>$status), array('user_id' => $user_id)))
            return true;
        else
            return false;
	}
}