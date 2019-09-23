<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Library to load files in specific template view...
 * @author svt
 *
 **/

class Databaseloader {

    public function __construct() {
        $this->load();
    }

    /*
     * Load the databases and ignore the old ordinary CI loader which only allows one
     */
    public function load() {
        $CI =& get_instance();

        $CI->db = $CI->load->database('default', TRUE);
    }
}
/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */
?>