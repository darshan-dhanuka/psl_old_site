<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fantasy extends CI_Controller {

	/**
	 * Constructor
	 */
	public function __construct()
    {
		parent::__construct ();
		$this->load->model(array('Fantasy_model','Mentor_model','Qualifier_model'));

        if( ! $this->session->checkAdminLogin()) 
        { 
                redirect('/admin',true);
        }
	}	
	/**
	 * method to show team listing page
	 */
	public function index()
	{
		$data=array();
		$invalidUser=NULL;
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{
			if ($_FILES ['userfile'] ['size'] > 0)
			{
				$day = $this->input->post ( 'day' );
				if ($day == - 1)
				{
					echo "Please select day";
				}
				else
				{
					$year=date('Y');
					$player_list = $this->Fantasy_model->getFantasyUsersList( $year);
					$category_list = $this->config->item ( 'player_category' );
					$player_array = array ();
					$k = 0;
					foreach ( $player_list as $playername )
					{
						$player_array [$k] = $playername ['player_name'];
						$k ++;
					}
					$filename = $this->fileUpload ( 'userfile', $_FILES ['userfile'] );
					$csv_path = FANTASY_SCORE_FILE . $filename;
					$p_Text = file_get_contents ( $csv_path );
					$lines = explode ( "\n", $p_Text );
					$i = 0;
					$j = 0;
					foreach ( $lines as $line )
					{
						$i ++;
						if ($line != '')
						{
							// skip empty lines
							if ($i == 1)
							{
								continue;
							}
							$elements = explode ( ',', $line );
							if (in_array ( $elements [1], $player_array ) && in_array ( strtolower(trim($elements [2])), $category_list ))
							{
								echo $elements [0];
								$arr = array ('player_id' => $elements [0],'score' => $elements [3],'day' => $day );
								$this->Fantasy_model->addPlayerScore ( $arr );
							}
							else
							{
								$invalidUser [$j] = $elements [1];
								$j ++;
							}
						}
					} // for loop
					
					if($invalidUser==NULL )
					{
						$data['upload_success'] = true;
					}
				} // end of else condtion
				
			} // if condition
			
		} // post req
		$data ['invalidUser'] = $invalidUser;
		$this->template->load ( 'admin/layout/admin_tpl', 'admin/fantasy/upload_fantasy_user_score', $data );
	}
	
	
	
	public function fileUpload($file,$fileAttr)
	{
		if($fileAttr['size'] > 0)
		{
			$config['upload_path'] = FANTASY_SCORE_FILE;
			$config['allowed_types'] = 'csv';
			$config['max_size']    = '1000';
			$ext = substr(strrchr($fileAttr['name'], "."), 1);
			$config['file_name'] = time().'.'.$ext;
			$config['overwrite'] = TRUE;
			$this->load->library('upload');
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload($file))
			{
				$error = array('error' => $this->upload->display_errors());
				return false;
			}else
			{
				$data = $this->upload->data();
				return $data['file_name'];
			}
		}
		else{
			echo "no file to upload or invalid file size";
			return false;
		}
	}

	public function downloadUser(){
		$current_year = date('Y');
		$player_list = $this->Fantasy_model->getFantasyUsersList($current_year);
        header('Content-Type: application/csv');   
        header("Content-Disposition: attachment; filename=playerinfo.csv");  
        header("Pragma: no-cache"); 

        $content = 'Player Id,Player Name,Category,Score'."\n";
        foreach ($player_list as $list) {
        	$content .= $list['id'].','.$list['player_name'].','.$list['category']."\n";
        }
        echo $content;
	}

	public function manageFantasyUsers($day=1)
    {
        $day = ($this->input->get('day'))?$this->input->get('day'):1;
        $data['user_details'] = $this->Fantasy_model->getFantasyUsersDetail($day);
        $this->template->load('admin/layout/admin_tpl','admin/fantasy/fantasy_users', $data);
    }

    public function updateUserScore($id=null,$score=null)
    {
        $score_info['id'] = $id;
        $score_info['score'] = $score;
        if($this->Fantasy_model->updateUserScore($id,$score_info))
        {
            echo json_encode(array('status'=>'true'));exit;
        }
        else
        {
            echo json_encode(array('status'=>'false'));exit;
        }
    }

    public function uploadPlayerList(){
    	$data=array();
		if($this->input->server ('REQUEST_METHOD') === 'POST')
		{

			if ($_FILES ['userfile'] ['size'] > 0)
			{

					$filename = $this->fileUpload ( 'userfile', $_FILES ['userfile'] );
					$csv_path = FANTASY_SCORE_FILE . $filename;
					$p_Text = file_get_contents ( $csv_path );
					$lines = explode ( "\n", $p_Text );
					// $day=$this->input->post('day');
					$i = 0;
					$j = 0;
					foreach ( $lines as $line )
					{
						$i ++;
						if ($line != '')
						{
							// skip empty lines
							if ($i == 1)
							{
								continue;
							}
							$elements = explode ( ',', $line );
							if($elements [0] && $elements [1] && $elements [2]){
								$arr = array ('player_name' => $elements [0],'category' => $elements [1],'team_name' => $elements [2],'season' => $this->config->item('season'),'year' => date("Y") );
								$this->Fantasy_model->addPlayerList ( $arr );

							}else{
								$data['invalid_data'][]=$i-1;
							}
						}
					}
					if(empty($data['invalid_data'])){
						$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> File Uploaded successfully.</div>');
					}
			} // if condition
		} // post req
		$this->template->load ( 'admin/layout/admin_tpl', 'admin/fantasy/upload_fantasy_player', $data );
    }

    public function playerList(){
    	$current_year = date('Y');
    	$data['player_list'] = $this->Fantasy_model->getFantasyUsersList($current_year);
    	$this->template->load ( 'admin/layout/admin_tpl', 'admin/fantasy/fantasy_player_list', $data );
    }


    public function updatePlayerStatus($id=null,$status=null)
    {
        if($this->Fantasy_model->updatePlayerStatus($id,array('status'=>($status == 1)?0:1)))
        {
            echo json_encode(array('status'=>'true'));
        }
        else
        {
            echo json_encode(array('status'=>'false'));
        }
        exit;
    }

    public function downloadLeaderboard(){
    	$season = $this->config->item('season');
    	$team_score = $this->Fantasy_model->downloadLeaderboard($season);
    	$team_details= array();
        foreach($team_score as $team_data){
        	if(!isset($team_details[$team_data['id']]['total_score'])){
        		$team_details[$team_data['id']]['total_score'] = 0;
        	}
        	$team_details[$team_data['id']]['day_'.$team_data['day']] = $team_data['score'];
        	$team_details[$team_data['id']]['team_name'] = $team_data['team_name'];
        	$team_details[$team_data['id']]['user_name'] = $team_data['user_name'];
        	$team_details[$team_data['id']]['total_score'] += $team_data['score'];
        }
    	header('Content-Type: application/csv');   
        header("Content-Disposition: attachment; filename=fantasy_leaderboard.csv");  
        header("Pragma: no-cache"); 
        $content = 'User name,Team Name,Day 1,Day 2,Day 3,Day 4,Day 5,Cumulative score'."\n";
        foreach ($team_details as $list) {
        		$list['day_1'] = (!isset($list['day_1']))?0:$list['day_1'];
        		$list['day_2'] = (!isset($list['day_2']))?0:$list['day_2'];
        		$list['day_3'] = (!isset($list['day_3']))?0:$list['day_3'];
        		$list['day_4'] = (!isset($list['day_4']))?0:$list['day_4'];
        		$list['day_5'] = (!isset($list['day_5']))?0:$list['day_5'];

        	$content .= $list['user_name'].','.$list['team_name'].','.$list['day_1'].','.$list['day_2'].','.$list['day_3'].','.$list['day_4'].','.$list['day_5'].','.$list['total_score']."\n";
        }
        echo $content;
    }



    public function downloadFantasyTeam(){
    	$season = $this->config->item('season');
    	$fantasy_team = $this->Fantasy_model->downloadFantasyTeam($season);

    	header('Content-Type: application/csv');   
        header("Content-Disposition: attachment; filename=fantasy_team.csv");  
        header("Pragma: no-cache");
        if($fantasy_team){
	        $content = 'User Id,User Name,Team Name,Player Name,Category,Created On'."\n";
	        foreach ($fantasy_team as $team) {
	        	$content .= $team['user_id'].','.$team['user_name'].','.$team['team_name'].','.$team['player_name'].','.$team['category'].','.$team['created_on']."\n";
	        }
	    }else{
	    	$content = 'No data found'."\n";
	    }
        echo $content;
    }
}