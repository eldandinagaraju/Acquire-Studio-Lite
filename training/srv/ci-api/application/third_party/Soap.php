<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SOAP Class
 *
 * Make SOAP requests 
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Libraries
 * @author     Vijay Kumar Thodupunoori
 * @created    05/18/2016
 */
class Soap {

    /**
     *  Takes XML string and returns a boolean result where valid XML returns true
     */
    function is_valid_xml($xml) {
        if (strpos($xml, "xmlns") == false) {
            return false;
        }
        libxml_use_internal_errors(true);

        $doc = new DOMDocument('1.0', 'utf-8');

        $doc->loadXML($xml);

        $errors = libxml_get_errors();

        return empty($errors);
    }

    public function getDataKey($API_response, $methodname) {
        $methodResult = $methodname . "Result";

        $return_data = "";

        if (isset($API_response)) {
            if (property_exists($API_response, $methodResult)) {
                $return_data = $API_response->$methodResult;
                if (property_exists($API_response->$methodResult, 'any')) {
                    $return_data = $API_response->$methodResult->any;
                }
            }
        }

        //echo "<pre>";print_r($return_data);exit;
        return $return_data;
    }

    public function makeSoapRequest($url = '', $methodname, $params) {
        try {
            $application_params_array = array();
            $application_params_array['GET'] = $_GET;
            $application_params_array['POST'] = $_POST;
            $application_params_json = json_encode($application_params_array);
            $input_params_json = json_encode($params);
            $outgoing_api_insert_data = array(
                "type_of_service" => 63002,
                "url" => $url,
                "application_params" => $application_params_json,
                "input_params" => $input_params_json
            );
            $response_array = array();

            $soapclient = new SoapClient($url);

            $response = $soapclient->$methodname($params);
            $data_key = $this->getDataKey($response, $methodname);

            $response_array = $data_key;

            if ($data_key != "") {
                if ($this->is_valid_xml($data_key)) {
                    $soap_xml = simplexml_load_string($data_key, 'SimpleXMLElement', LIBXML_NOCDATA);
                    $json = json_encode($soap_xml);
                    $response_array = json_decode($json, TRUE);
                }
            }
            $return_array = array('error_code' => '', 'error_message' => '', 'data' => $response_array);
            $outgoing_api_insert_data['response'] = json_encode($return_array);
            //store_outgoing_api_result($outgoing_api_insert_data);
            return $return_array;
        } catch (Exception $e) {
            $return_array = array('error_code' => $e->getCode(), 'error_message' => $e->getMessage(), 'data' => '');
            $outgoing_api_insert_data['response'] = json_encode($return_array);
            //store_outgoing_api_result($outgoing_api_insert_data);
            return $return_array;
        }
    }

}
