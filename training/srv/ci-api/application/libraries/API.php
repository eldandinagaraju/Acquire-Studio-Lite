<?php

/**
 * API file
 *
 * This file contains stores that are retrieved from tango
 *
 * PHP version 7.0.15
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   API.php
 * @package    Library
 * @author     Vijay.ch <vijay.ch@sureify.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://local.consumer.com/rewards.php
 * @see        NetOther, Net_Sample::Net_Sample()
 * @createdAt  04/24/2017
 * @modifiedAt 04/26/2017
 */

/**
 * Class API
 *
 * This class contains a function of processApi to call rest api functions
 *
 * PHP version 7.0.15
 *
 * @category   API.php
 * @package    Library
 * @author     Vijay.ch <vijay.ch@sureify.com>
 * @version    Release: @package_version@
 * @link       http://local.consumer.com/rewards.php
 * @since      04/24/2017
 * @deprecated 04/26/2017
 */



class API {
    //echo 'api';//exit;

    public $apiUrl = API_URL;
    public $username = API_AUTH_ID;
    public $password = API_AUTH_PWD;
    public $curl;

    /**
     * Default options for curl.
     *
     * @var array
     */
    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'carrier',
        //CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_ENCODING => 'gzip'
    );

    /**
     * Constructor function
     * 
     * @return boolean
     */
    public function __construct() {
        date_default_timezone_set('UTC');
    }

    /**
     * Function to call REST API based on params
     * 
     * @param string $name     name of api
     * @param array  $headers  headers of API
     * @param string $method   method post or get
     * @param array  $postData post data
     * 
     * @return array $result
     */
    public function processApi($name, $headers, $method, $postData = array(), $isDirectApi = false, $sync = false, $isAuthrozied = false, $post_type = 'json') {
        $service_url = ($isDirectApi) ? $name : $this->apiUrl . "api/" . $name;
        if ($sync) {
            $service_url = $this->apiUrl . $name;
        }
        if(strpos(strtolower($service_url), 'email/send') == true || strpos(strtolower($service_url), 'chase/adminportal') == true){
            $headers[] = 'Authorization:Basic ' . base64_encode(APPLYANDBUYUNMAE . ':' . APPLYANDBUYPWORD);
        }
        else{
            if (!$isAuthrozied) {
                $headers[] = 'Authorization:Basic ' . base64_encode($this->username . ':' . $this->password);
            }
        }

        //echo '<pre>';print_r($headers);exit;
        if (is_array($postData)){
            if(isset($_SESSION['user_time_zone']))
            $postData['user_time_zone'] = $_SESSION['user_time_zone'];
        }
        $headers[] = "organization_id: " . ORGANIZATION_ID;
        $headers[] = "organization_access_token: " . ORGANIZATION_ACCESS_TOKEN;
        $this->curl = curl_init();
        $opts = self::$CURL_OPTS;
        curl_setopt_array($this->curl, $opts);
        //curl_setopt($this->curl, CURLOPT_PORT, 81);
        curl_setopt($this->curl, CURLOPT_URL, $service_url);
        
        if ($post_type == "json") {
            $postData = json_encode($postData);
        }
        switch ($method) {
            case 'post':
                curl_setopt($this->curl, CURLOPT_POST, true);
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postData);
                break;
            case 'put':
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($postData));
                break;
            case 'delete':
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
                break;
            // case 'gopost':
            //     curl_setopt($this->curl, CURLOPT_POST, true);
            //     curl_setopt($this->curl, CURLOPT_PORT, 1323);
            //     curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postData);
            //     break;
        }
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        $curl_response = curl_exec($this->curl);
        // echo "res";print_r($curl_response);
        if ($curl_response === false) {
            $info = curl_getinfo($this->curl);
            curl_close($this->curl);
            $error = var_export($info, true);
            if(isset($postData['email']) || isset($postData['password']) || isset($postData['current_password']) || isset($postData['new_password'])|| isset($postData['new_pwd'])){
                unset($postData['email']);//for security reasons removed
                unset($postData['password']);//for security reasons removed
                unset($postData['current_password']);//for security reasons removed
                unset($postData['new_password']);//for security reasons removed
                unset($postData['new_pwd']);//for security reasons removed
            }
            trigger_error('error occured during curl exec. Additioanl info: ' . $error.print_r($postData,true), E_USER_ERROR);
            //echo '<label>Oops! Something went wrong!</label></body></html>';
            //exit;
            die('Oops! Something went wrong!');
        }
        curl_close($this->curl);
        $result = (array) json_decode($curl_response, true);
        
        //trigger_error(print_r($result,true),E_USER_ERROR);
        
        return $result;
    }

    /**
     * Destructor function
     * 
     * @return boolean
     */
    public function __destruct() {
        
    }

}

?>
