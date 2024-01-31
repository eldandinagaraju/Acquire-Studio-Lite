<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

require ( APPPATH . '/libraries/REST_Controller.php' );

class v1 extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
    *
    * Method : GET
    * Description : Health check endpoint
    * @param 
    * @return 
    */

    function healthcheck_get() {
        $this->response( [
            'data' => [
                'status' => SUCCESS_OK,
                'message' => "I am healthy!"
            ]
        ], SUCCESS_OK );
    }

    // sample code example:
    function registerUser_post(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $password = md5($_POST['password']);
        $mobile = strip_tags($_POST['phone']);
        $role = strip_tags($_POST['role']);
        $userData = array(
            'UserName'=>$name,
            'EmailId' => $email,
            'Password' => $password,
            'PhoneNumber' => $mobile,
            'Role' => $role,

        );
        $count=$this->Loginregister_model->CheckEmail($userData);
        $isValid=$count[0]['count(UserId1)']>0; 
        if($isValid){
            $this->response("The given email already exists.");
        }
        else{
            $result =$this->Loginregister_model->InsertData($userData) ;
            if($result){
                $this->response(
                    "The user has been added successfully."
                );
            }
         } 
    }



}
