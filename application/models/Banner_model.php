<?php

/*
	Banner model
*/

class Banner_model extends CI_Model
{

    /**
     * method to add homepage banner
     */
    public function saveHomepageBanner($data)
    {
        if ($this->db->insert('psl_homepage_banner', $data))
            return TRUE;
        else
            return FALSE;
    }

    /***
    * method to get banner listing
    **/
	/*condition array(status=> value);*/
    public function getHomePageBanner($condition=array())
    {
        $this->db->order_by('priority','asc');
        
        $query = $this->db->get_where('psl_homepage_banner',$condition);
        
        $banner_list = $query->result_array();
        return $banner_list;

    }

    /*****
    * update Banner
    ***/
    public function updateHomepageBanner($banner=array())
    {
    	
        if(!empty($banner))
        {
        	$bannerCount=2;
        	if($banner['status']!=1){
        	$activebanner=$this->getActiveBannerCount();
        	//var_dump( 	$activebanner);die;
        	$bannerCount=sizeof($activebanner);
        	if($banner['status'] == 0 && $bannerCount == 1 && $banner['id'] != $activebanner[0]['id']){
	        		$bannerCount=2;
	        	}
        	}
        	if($bannerCount>1)	{
        	
	            $banner['linux_modified_on'] = time();
	            if($this->db->update('psl_homepage_banner',$banner, array('id' => $banner['id'])))
	            {
	                return true;
	            }
        	}
        	else{
        		return false;
        	}
        	
        }
        return false;
    }

    public function deleteHomepageBanner($banner_id)
    {
    	$bannerCount=2;
    	$activebanner=$this->getActiveBannerCount();
    	$bannerCount=sizeof($activebanner);
    	if($bannerCount==1){
	    	if($activebanner[0]['id']==$banner_id)
	    	{
	    		$bannerCount=0;
	    	}
	    	else{
	    		$bannerCount=2;
	    	}
    	}
		if ($bannerCount > 1)
		{
			if ($this->db->delete ( 'psl_homepage_banner', array ('id ' => $banner_id ) ))
			{
				return true;
			}
		}
		return false;
	}

    public function getBannerById($banner_id=null)
    {
        $result =array();
        if($banner_id!=null)
        {
            $query = $this->db->get_where('psl_homepage_banner',array('id'=>$banner_id));
            $result = $query->row_array();
        }
        return $result;
    }
    
    public function getActiveBannerCount()
    {
    	$query=$this->db->get_where('psl_homepage_banner',array('status'=>'1'));
    	return $query->result_array();
    	
    }
}
