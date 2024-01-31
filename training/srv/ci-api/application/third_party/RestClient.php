<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * REST Class
 *
 * Make REST requests to RESTful services with simple syntax.
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Libraries
 * @author     Vijay Kumar Thodupunoori
 * @created    05/18/2016
 */

class RestClient
{

    public function callrestapi( $apipath='', $methodname, $params, $requesttype='POST', $headers = array(), $input_type = '' )
    {
        try {

            if( $input_type == "" && is_array($params))
            $params = http_build_query($params);
            //die();
            
            $url= $apipath.$methodname;
            
            if( $requesttype=='GET' && $params != "" ) {
                    $url.='?'.$params;
            }

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);

            if( count($headers) > 0 )
            {    
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
            }
                
            if($requesttype=='POST') {
                curl_setopt($curl, CURLOPT_POST, true);
            }
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 800);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            
            if($requesttype=='PUT') {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                $params_count = is_array($params) ? count($params) : 0 ;
                curl_setopt($curl, CURLOPT_POST, $params_count);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            }
            
            if($requesttype=='POST') {
                    $params_count = is_array($params) ? count($params) : 0 ;
                    curl_setopt($curl, CURLOPT_POST, $params_count);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            }

            //Execute the cURL request.
            $response = curl_exec($curl);

            //Get the resulting HTTP status code from the cURL handle.
            $request_info = curl_getinfo($curl);
            //echo "<pre>";print_r($response);exit;
            

            if(curl_errno($curl)){
                throw new Exception(curl_error($curl));
            }

            //log_message(error, json_encode(curl_getinfo($curl)));
            //log_message(error, curl_error($curl));
            //print_r($result);
            
            $return_array = array('error_code'=>'', 'error_message'=>'', 'response' => $response );  
            return $return_array;             
        }
        catch (Exception $e)
        {
            //array('status' => 404,'message' => )
            $return_array = array('error_code'=> $e->getCode() , 'error_message'=>$e->getMessage() , 'response' => '' );  
            //echo "<pre>";print_r($return_array);exit;
            return $return_array;
        }
        
    }

}     


