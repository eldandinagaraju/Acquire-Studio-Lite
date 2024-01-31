<?php

/**
 * Created by PhpStorm.
 * User: paulperli
 * Date: 4/24/17
 * Time: 10:30 AM
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once (APPPATH . '/core/Custom_exceptions.php');

class api_helper
{
    public $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model(array('user'));

    }

    function generateErrorMessage($status, $message)
    {
        $this->response(array(
            'errors' => array(
                array(
                    'status' => $status,
                    'detail' => $message
                )
            )
        ));
    }

    public function is_user_logged_in()
    {
        // Check mobile
        $headers = getallheaders();
        if(!empty($headers))
        {
            $user_access_token = $headers['access-token'];
            $result = $this->CI->user->getUserIDFromAccessToken($user_access_token);

            // Return user session data
            if($result) return $result;

            // Return invalid access token
            if($user_access_token) throw new NotLoggedInException("Invalid Access Token");
        }

        // Check the session
        $result = $this->CI->user->getCurrentUser();

        if(!$result)
        {
            throw new NotLoggedInException("Please login to Continue");
        }

        return $result;

    }

    public function get_request_params()
    {

        $request_params = array();
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            return $_GET;
        }

        if($_SERVER["CONTENT_TYPE"] === 'application/json')
        {
            $request_params = json_decode(file_get_contents('php://input'), TRUE);
        }

        else if ($_SERVER["CONTENT_TYPE"] === 'application/x-www-form-urlencoded')
        {
            parse_str(file_get_contents('php://input'), $request_params);
        }

        return $request_params;
    }
    public function check_ajax($input)
    {
        if ($input->is_ajax_request($input))
        {
            exit('No direct script access allowed');
        }
    }
}