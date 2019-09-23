<?php

/*
	Dashboard model
*/

class User_model extends CI_Model
{


    /**
     * method to check if the username exists in DB
     */
    public function checkUsername($username)
    {
        if (!$username) {
            return true;
        }
        $query = $this->db->get_where('psl_users', array('user_name' => $username), 1);
        return ($query->num_rows() == 0);
    }

    /**
     * method to check if the email_id exists in DB
     */
    public function checkEmailId($email)
    {
        $query = $this->db->get_where('psl_users', array('email' => $email, 'status !=' => 'deleted'));

        $result = $query->row_array();
        if (!empty($result)) {
            if ($result['status'] == 'facebook')
                return 1;     //fb user
            else
                return -1;    //email exists
        } else
            return 0;         //email does not exist
    }


    /**
     * method to check if the email_id exists in DB
     */
    public function userSignUp($user_info)
    {
        $this->db->insert('psl_users', $user_info);
        return true;
    }

    /**
     * method to get the user info by email address
     */
    public function getUserEmailInfo($email)
    {
        $query = $this->db->get_where('psl_users', array('email' => $email));
        $user_info = $query->row_array();
        return $user_info;
    }

    public function getUsernameInfo($username)
    {
        if (!$username)
            return array();
        $query = $this->db->get_where('psl_users', array('user_name' => $username));
        return $query->row_array();
    }


    /**
     * method to get the user info by username
     */
    public function getUsernameForQualifier($username,$category_id)
    {
        if (!$username && !$category_id)
            return array();
        if($category_id==1 or $category_id==2)
        {
            if($category_id == 2){
                $query = $this->db->get_where('psl_users', array('user_name' => $username));
            }
            if($category_id == 1){
                $this->db->select('pu.user_id');
                $this->db->from('psl_users pu');
                $this->db->where('pu.user_name', $username);
                $this->db->join('psl_tournament_reg_players pt', 'pt.user_id = pu.user_id');
                $this->db->group_by('pt.user_id');
                $query = $this->db->get();
                //echo $this->db->last_query();die;
            }                       
        	return $query->row_array();
        }else{
            return array();
        }
        
    }

    /**
     * method to get the user info by user_id
     */
    public function getUserIdInfo($user_id)
    {
        $query = $this->db->get_where('psl_users', array('user_id' => $user_id));
        $user_info = $query->row_array();
        return $user_info;
    }

    /**
     * method to get the user info by user_id
     */
    public function checkMobile($mobile)
    {
        $query = $this->db->get_where('psl_users', array('mobile' => $mobile));
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }


    /**
     * method to check if the email_id exists in DB
     */
    public function addProPlayerInfo($user_info)
    {
        $this->db->insert('psl_pro_player', $user_info);
        return true;
    }

    /**
     * method to check if the email_id exists in DB
     */
    public function getProPlayerInfo($user_id)
    {
        $query = $this->db->get_where('psl_pro_player', array('user_id' => $user_id));
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    /**
     * method to update an existing page in DB
     */
    public function updateProPlayerInfo($user_info, $user_id)
    {
        if ($this->db->update('psl_pro_player', $user_info, array('user_id' => $user_id)))
            return true;
        else
            return false;
    }

    /**
     * method to return activation code
     */
    public function activationCode()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * method to update the user status in DB
     */
    public function updateUserStatus($activation_code, $status, $user_id)
    {
        $user_info = $this->getUserActCodeInfo($activation_code, $user_id);
        if (!empty($user_info)) {
            if ($user_info['status'] == 'inactive') {
                $userupdate = array('status' => $status);
                if ($this->db->update('psl_users', $userupdate, array('user_name' => $user_info['user_name'])))
                    return 0;                       //success
                else
                    return -1;                      //failed
            } else if ($user_info['status'] == 'active') {
                return 1;                           //already activated
            } else {
                return -1;                          //status is not active/inactive, cannot be activated
            }
        } else
            return -1;                              //user doesn't not exist, cannot be activated
    }

    /**
     * method to get the user info by user activation_code
     */
    public function getUserActCodeInfo($activation_code, $user_id)
    {
        $query = $this->db->get_where('psl_users', array('activation_code' => $activation_code, 'user_id' => $user_id));
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return true;
    }

    /**
     * method to generate random password (forgot password request)
     */
    public function getRandomPassword()
    {
        return base_convert(mt_rand(0x19A100, 0x39AA3FF), 10, 36);
    }

    /**
     * method to reset the user password in DB
     */
    public function resetUserPassword($username, $email, $password)
    {
        if ($this->db->update('psl_users', array('password' => $password), array('user_name' => $username, 'email' => $email))) {
            return TRUE;
        } else
            return FALSE;
    }

    /**
     * method to sent zipdial request
     */
    public function addRequestMobileVerification($response)
    {
        if ($this->db->insert('psl_mobile_verification', $response))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * method to get all details of user transaction of mobile verification by user_id
     */
    public function getRequestMobileVerification($mobile)
    {
        $query = $this->db->get_where('psl_mobile_verification', array('mobile' => (string)$mobile));

        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    /**
     * method to get all details of user transaction of mobile verification by verified id
     */
    public function updateRequestMobileVerification($params, $mobile)
    {
        if ($this->db->update('psl_mobile_verification', $params, array('mobile' => (string)$mobile)))
            return true;
        else
            return false;
    }

    /**
     * method to get all details of user transaction of mobile verification by user_id
     */
    public function checkMobileOtp($mobile, $otp)
    {
        $query = $this->db->get_where('psl_mobile_verification', array('mobile' => $mobile, 'otp' => $otp));

        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    function sendOtp($mobile, $otp_code)
    {
        $sms_info = array('senderMobile' => $mobile,
            'message_content' => $otp_code . " is your pokersportsleague.com OTP. Please enter the same to complete your mobile verification."
        );

        $config_data = $this->config->item('imi_otp');

        $rawdata = "{\"outboundSMSMessageRequest\":{" .
            "\"address\":[\"tel:91" . $sms_info['senderMobile'] . "\"]," .
            "\"senderAddress\":\"tel:" . $config_data['senderAddress'] . "\"," .
            "\"outboundSMSTextMessage\":{\"message\":\"" . $sms_info['message_content'] . "\"}," .
            "\"clientCorrelator\":\"\"," .
            "\"senderName\":\"\"}" .
            "}";

        $ch = curl_init($config_data['url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'key: ' . $config_data['key']));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $rawdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        return $otp_code;
    }

    /**
     * method to get all details of user transaction of mobile verification by user_id
     */
    public function checkMobileVerifiedStatus($mobile)
    {
        $query = $this->db->get_where('psl_mobile_verification', array('mobile' => (string)$mobile,'verified' => '1' ));

        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    /**
     * method to sent zipdial request
     */
    public function addScheduleOnline($data)
    {
        if ($this->db->insert('psl_schedule_online', $data))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * method to sent zipdial request
     */
    public function addLiveOnline($data)
    {
        if ($this->db->insert('psl_schedule_live', $data))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * method to get all details of user transaction of mobile verification by user_id
     */
    public function getScheduleOnline()
    {
        $query = $this->db->get_where('psl_schedule_online', array('status' => 0));
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }
    /**
     * method to get all details of user transaction of mobile verification by user_id
     */
    public function getScheduleLive()
    {
        $query = $this->db->get_where('psl_schedule_live', array('status' => 0));

        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    public function getRegisteredTournamentByUserId($user_id)
    {
        $this->db->select('tournament_id');
        $query = $this->db->get_where('psl_tournament_reg_players',array('user_id'=>$user_id));
        return $query->result_array();
    }

    public function getScheduleLiveByTotalRegistration()
    {
        $query = $this->db->query("Select *,(select count(id) from psl_tournament_reg_players ptrp where ptrp.tournament_id=psl.id group by tournament_id) as ids  from psl_schedule_live psl where psl.status=0 order by id");
            return $query->result_array();
    }
    /**
     * method to sent zipdial request
     */
    public function addLiveleaderboard($data)
    {
        if ($this->db->insert('psl_live_leaderboard', $data))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * method to get all details of user transaction of mobile verification by user_id
     */
    public function getLiveLeaderboard($city)
    {
        // $sql = "SELECT name, SUM(points) as points,city FROM psl_live_leaderboard";
        // if($city != 'all')
        // {
        //     $sql .= " where city='".$city."'";
        // }
        // $sql .= " GROUP BY name,city HAVING COUNT(name) <= 6 order by points DESC";
        // $query = $this->db->query($sql);
        if($city != 'all'){
            $this->db->where('city', $city);
        }
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('psl_live_leaderboard');
        $result = $query->result_array();
        $users = array();

        function sortByPoints($a, $b)
        {
            if ($a['points'] < $b['points']) {
                return 1;
            } else if ($a['points'] > $b['points']) {
                return -1;
            }
            // If points are equal, give priority to creation time
            return (strtotime($a['created']) > strtotime($b['created']) ? 1 : -1);
        }

        foreach($result as $row)
        {
            if(!isset($users[$row['name']]))
            {
                $users[$row['name']] = array(
                    'name' => $row['name'],  
                    'counter' => 0, 
                    'city' => $row['city'] , 
                    'points' => 0 , 
                    'created' => $row['created']
                );
            }
            $users[$row['name']]['counter']++;
            if($users[$row['name']]['counter'] < 7)
                $users[$row['name']]['points'] += $row['points']; 
        }
        uasort($users, 'sortByPoints');
        return $users;
    }

    public function checkUserAlreadyRegister($tournament_id,$user_id)
    {
        $query = $this->db->get_where('psl_tournament_reg_players', array('tournament_id' => $tournament_id,'user_id'=>$user_id));
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function checkTotalRegisterUserById($tournament_id)
    {
        $query = $this->db->query("SELECT count(distinct id) as id FROM `psl_tournament_reg_players` WHERE tournament_id='".$tournament_id."'");
        return $query->row_array();
    }

    public function registerUserInTournament($user_id,$tournament_id)
    {
        $user_info =  array('user_id' =>$user_id,
                            'tournament_id'=>$tournament_id,
                            'status'=>'active',
                            'added_on'=> date('Y-m-d h:i:s')
                         ); 
        if ($this->db->insert('psl_tournament_reg_players',$user_info))
            return TRUE;
        else
            return FALSE;
    }

	public function getTournamentDetailsById($tournament_id)
	{
		$query = $this->db->get_where('psl_schedule_live', array('id' => $tournament_id));
        	return $query->row_array();
	}


    function updateLiveSchedule($id)
    {
        return $this->db->update('psl_schedule_live', array('status' => 1), array('id' => $id));
    }

    function updateOnlineSchedule($id)
    {
        return $this->db->update('psl_schedule_online', array('status' => 1), array('id' => $id));
    }

    public function deleteUserTournamentEntry($user_id,$id)
    {
        return $this->db->delete('psl_tournament_reg_players', array('user_id' => $user_id,'tournament_id'=>$id));
    }

    public function getthreeHoursLaterTournament()
    {
        $before_time = time()+ REGISTRATION_STOP_HRS*55*60;
        $after_time = time()+ REGISTRATION_STOP_HRS*65*60;
        $query = $this->db->query("SELECT * FROM `psl_schedule_live` WHERE UNIX_TIMESTAMP(date) > '".$before_time."' and UNIX_TIMESTAMP(date) < '".$after_time."'");
        return $query->result_array();
    }

    

    public function getTournamentRegPlayersWithName($id)
    {
        $query = $this->db->query("SELECT psl.*,pu.user_name,pu.first_name,pu.last_name,pu.gender,pu.state,pu.city,pu.email,pu.mobile FROM psl_tournament_reg_players psl left join psl_users pu on pu.user_id = psl.user_id WHERE psl.tournament_id = '".$id."'");
        return $query->result_array();
    }

    public function updateUserInfo($user_info,$user_id)
    {
        return $this->db->update('psl_users', $user_info, array('user_id' => $user_id));
    }

    public function getDocType()
    {
        $this->db->select('*');
        $query = $this->db->get('psl_verification_docs');
        return $query->result_array();
    }

    public function insertUserDocInfo($user_doc_info)
    {
        if($this->db->insert('psl_users_doc',$user_doc_info))
            return TRUE;
        else
            return FALSE;
    }

    public function getUserDetailWithDoc($user_id)
    {
        $sql = "select pu.user_id,pu.user_name,pu.email,pu.mobile,pu.is_modify,pu.first_name,pu.last_name,pu.gender,pu.dob,pu.address1,pu.address2,pu.city,pu.state,pu.doc_status,pud.doc_path,pvd.doc_name from psl_users pu
        left join psl_users_doc pud on pud.user_id=pu.user_id
        left join psl_verification_docs pvd on pvd.id=pud.doc_type_id where pu.user_id='".$user_id."'";
        $query = $this->db->query($sql);
        return $query->row_array();  
    }
}
