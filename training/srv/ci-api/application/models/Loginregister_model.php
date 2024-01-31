<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

// require ( APPPATH . '/libraries/REST_Controller.php' );

class Loginregister_model extends CI_MODEL {
   

    function CheckEmail($data){
        $sql="SELECT count(UserId1) FROM UserProfile WHERE EmailId = ?";
        $count=$this->db->query($sql, $data['EmailId'])->result_array();
        return $count;
    }
    function InsertData($data){
        if ($this->db->insert("UserProfile", $data)) { 
            return true; 
         } 
        return false;
    }



}
?>