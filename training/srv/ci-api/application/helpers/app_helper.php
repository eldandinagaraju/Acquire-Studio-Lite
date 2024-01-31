<?php

require(APPPATH . '/libraries/Encoding.php');
/**
 * returns the values from the key value pairs in associaitve arrays
 * @param $array an associative array which has key value pairs
 * @return arr  clean array without keys
 */

function arrayValues($arr){
    $result=array();
    foreach($arr as $value){
        array_push($result,array_values($value)[0]);
    }
    return $result;
}



function prepareRegularExpression($pwdConfigDetails) {
    $regExp = "";
    $regExp .= "/^";
    if ($pwdConfigDetails['regexp_contain_number'] == 1)
        $regExp .= "(?=.*?[0-9])";
    if ($pwdConfigDetails['regexp_contain_lowercase'] == 1)
        $regExp .= "(?=.*?[a-z])";
    if ($pwdConfigDetails['regexp_contain_uppercase'] == 1)
        $regExp .= "(?=.*?[A-Z])";
    if ($pwdConfigDetails['regexp_contain_non_alphanumeric'] == 1)
        $regExp .= "(?=.*?[#?!@$%^&_();:'<>~*+=|{}`.,])";
//    $regExp .= "[a-zA-Z]";
    $regExp .= ".{" . $pwdConfigDetails['character_min_length'] . "," . $pwdConfigDetails['character_max_length'] . "}";
    $regExp .= "$/";
    return $regExp;
}

function checkDates($date1, $date2){
    $startDate = date_create(date('Y-m-d', strtotime($date1)));
    $endDate = date_create(date('Y-m-d', strtotime($date2)));
    $currDate = date_create(date('Y-m-d'));
    if($startDate <= $currDate && $currDate <= $endDate){
        return true;
    }
    return false;
}

function setOutputJson($output = "") {
    $CI = & get_instance();
    $CI->output->set_header('Content-Type: application/json', TRUE);
    if (!empty($output)) {
        $output = (is_array($output)) ? json_encode($output) : (string) $output;
    }
    $CI->output->set_output($output);
}

// validations makes easy, presntly works only for required.
function requiredValidation($inputs = array()) {
    $instance = & get_instance();
    foreach ($inputs as $name) {
        $instance->form_validation->set_rules($name, humanize($name), 'required');
    }
}

/**
 * Check Voice Signature from Input json
 *
 * @param $input_json
 * @return boolean
 */
function check_voice_sign($ras_json) {
    try {

        $voice_signature = false;

        $ci = &get_instance();
        $ci->load->library('Questionslist');
        $questions_with_answers = $ci->questionslist->get_questions_with_answers($ras_json);
        //echo "<pre>";print_r( $questions_with_answers );exit;

        if (count($questions_with_answers) > 0) {
            foreach ($questions_with_answers as $qu) {
                if ($qu['question_id'] == "LT_customer_signature_type") {
                    if (array_key_exists('answer_json', $qu)) {
                        $answer_array = get_array_from_json($qu['answer_json']);
                        if (array_key_exists('id', $answer_array)) {
                            if (strtolower($answer_array['id']) == "voice") {
                                $voice_signature = true;
                            }
                        }
                    }
                }
            }
        }

        return $voice_signature;
    } catch (Exception $e) {
        $ci = &get_instance();
        $ci->exception_log->capture_expception($e);
    }
}


/**
 * Function to get risk asessments status
 * 
 * @param json $result_json
 * 
 * @return string $status
 */
function get_application_decision_status($result_json) {
    $status = "";
    if ($result_json != "")
        $results_array = get_array_from_json($result_json);

    if (!empty($results_array)) {
        $results_array['products'] = $results_array['products'][0];
        $allowable_conditions = array("accept", "refertounderwriter");
        $decision_string = (isset($results_array['products']) && isset($results_array['products']['ratings']) && isset($results_array['products']['ratings']['Global']) && isset($results_array['products']['ratings']['Global'][0]['decision'])) ? strtolower($results_array['products']['ratings']['Global'][0]['decision']) : "";
        if ($decision_string != "" && in_array($decision_string, $allowable_conditions)) {
            $accelerated_attribute = (isset($results_array['products']['ratings']['Global'][0]['attributes']) && isset($results_array['products']['ratings']['Global'][0]['attributes']['Accelerated'])) ? $results_array['products']['ratings']['Global'][0]['attributes']['Accelerated'] : false;
            if ($decision_string == "accept" && $accelerated_attribute)
                $status = " - Accelerated Offer";
            else if ($decision_string == "accept" && !$accelerated_attribute)
                $status = " - Full Underwriting";
            else
                $status = " - Refer to Underwriter";
        }
    }
    return $status;
}


/**
 * Check Wet Signature from Input json
 *
 * @param $input_json
 * @return boolean
 */
function check_wet_sign($ras_json) {
    try {

        $wet_signature = false;

        $ci = &get_instance();
        $ci->load->library('Questionslist');
        $questions_with_answers = $ci->questionslist->get_questions_with_answers($ras_json);
        //echo "<pre>";print_r( $questions_with_answers );exit;

        if (count($questions_with_answers) > 0) {
            foreach ($questions_with_answers as $qu) {
                if ($qu['question_id'] == "LT_customer_signature_type") {
                    if (array_key_exists('answer_json', $qu)) {
                        $answer_array = get_array_from_json($qu['answer_json']);
                        if (array_key_exists('id', $answer_array)) {
                            if (strtolower($answer_array['id']) == "wet") {
                                $wet_signature = true;
                            }
                        }
                    }
                }
            }
        }

        return $wet_signature;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Converts json data into array
 *
 * @param string $json_data
 * @return array $data_array 
 */
function get_array_from_json($json_data) {
    $data_array = array();

    if ($json_data != "") {
        $data_array = json_decode($json_data, TRUE);
    }

    return $data_array;
}



/**
 * Genereates random password string
 *
 * @param int $length length of the password
 *
 * @return string $result
 */
function generatePassword($length = 7) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= substr($chars, $index, 1);
    }

    return $result;
}

/**
 * Genereates random password string
 *
 * @param int $length length of the password
 *
 * @return string $result
 */
function generateRandomNumber($length = 7) {
    if(defined('HARD_CODE_OTP') && !empty(HARD_CODE_OTP)){
        return HARD_CODE_OTP;
    }
    $length = ( $length != "" ) ? $length : 7;
//echo 222;exit;
    $chars = '0123456789';
    $count = strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= substr($chars, $index, 1);
    }
//echo $result;exit;
    return $result;
}

// function humanize($str) 
// {
//  $str = trim(strtolower($str));
//  $str = preg_replace('/[^a-z0-9\s+]/', ' ', $str);
//  $str = preg_replace('/\s+/', ' ', $str);
//  $str = explode(' ', $str);
//  $str = array_map('ucwords', $str);
//  return implode(' ', $str);
// }


function renderWithLayout($contentArray, $layout = 'app') {
    if (!$layout) {
        die('$layout argument missing!');
    }
    $instance = & get_instance();
    $instance->load->view('layouts/' . $layout, $contentArray);
}

/**
 * gets multiple partials
 * @param  array $files
 * @return array
 */
function getPartials($files) {
    $instance = &get_instance();
    $partials = array();
    foreach ($files as $file => $path) {
        if (is_array($path)) {
            $info = $path;
            $partials[$file] = $instance->load->view($info['path'], $info['data'], true);
        } else {
            $partials[$file] = $instance->load->view($path, array(), true);
        }
    }
    return $partials;
}

function renderPartial($file, $data = array()) {
    $fParts = explode('/', $file);
    $lastPart = $fParts[count($fParts) - 1];
    $instance = &get_instance();
    $realFile = str_replace($lastPart, '_' . $lastPart, $file);
    $instance->load->view($realFile, $data);
}

function getVersion() {
    $allowedVersions = array('1', '2', '3', '2a', '2b');
    $instance = &get_instance();
    // setting the version of the app
    $version = $instance->input->get('v');
    $sessionVersion = $instance->session->userdata('version');

    // setting version as v1 if both are empty
    if (empty($version) && empty($sessionVersion)) {
        $instance->session->set_userdata('version', '2b');
    } else if (!empty($version)) {
        // setting version requested by user
        if (in_array($version, $allowedVersions)) {
            $v = $version;
        } else {
            $v = '1';
        }
        $instance->session->set_userdata('version', $version);
    }
    return $instance->session->userdata('version');
}

function versionedView($view, $mobile = false) {
    $v = getVersion();
    if ($mobile && isMobile()) {
        $parts = explode('/', $view);
        $view = str_replace($parts[count($parts) - 1], 'mobile/' . $parts[count($parts) - 1], $view);
    }
    if ($v == '1') {
        return $view;
    }
    return $view . '_v' . $v;
}

function mobileCompatibleView($view) {
    if (isMobile()) {
        $parts = explode('/', $view);
        $view = str_replace($parts[count($parts) - 1], 'mobile/' . $parts[count($parts) - 1], $view);
    }
    return $view;
}

/**
 * Function to get recdirectable screen after login
 * 
 * @return string
 */
function get_user_screen_based_on_permissions($user_id, $piller_id = "") {
    $CI = & get_instance();
    $CI->load->model('user');
    $pillar_permission_details = $CI->user->get_user_pillar_permission_details($user_id);
    if (isset($pillar_permission_details) && count($pillar_permission_details) > 0)
        $overview_permission_array = searchMultiArray($pillar_permission_details, 'pillar_id', 26);
    //If user has the permission for overview screen - Redirects to dashboard home page
    if (isset($overview_permission_array) && is_array($overview_permission_array) && count($overview_permission_array) > 0)
        return "dashboard/home";

    if (isset($pillar_permission_details) && count($pillar_permission_details) > 0) {
        $first_pillar_info = $pillar_permission_details[0];
        return $first_pillar_info['redirect_action'];
    }
    return "dashboard/home";
}

function sendEmail($to, $from, $subject, $message, $from_name = '') {
    // Always set content-type when sending HTML email
    /* $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // More headers
      $headers .= "From: <{$from}>" . "\r\n";
      // $headers .= 'Cc: myboss@example.com' . "\r\n";
      mail($to, $subject, $message, $headers); */
    $ci = & get_instance();
    $ci->load->library('email');
    $ci->email->set_newline("\r\n");
    if ($from_name != '') {
        $ci->email->from($from, $from_name);
    } else {
        $ci->email->from($from);
    }
    if (is_array($to)) {
        $to_emails = $to;
    } else {
        $to_emails = array("", $to);
    }
    $ci->email->to($to_emails);
    $ci->email->set_mailtype('html');
    $ci->email->subject($subject);
    $ci->email->message($message);
    if ($ci->email->send()) {
        $ci->email->clear(true);
        return true;
    } else {
        return false;
    }
}

function isMobile() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    if (stripos($userAgent, 'mobile') !== false) {
        return true;
    }
    return false;
}

function getPlanData($plan) {
    if ($plan == '$250,000' || $plan == '250000') {
        return array('plan_type' => 'Basic', 'plan_amount' => '250k', 'plan_amount_full' => '250,000', 'image' => 'bronze_image', 'image_name' => 'Fitbit Flex + Aria Scale', 'box_bg' => 'bronze_box_bg', 'color' => '#d34b5c', 'devices' => array('Fitbit Flex', 'Aria Scale'), 'device_images' => array('plan_fitbit_flex_m.png'));
    } elseif ($plan == '$500,000' || $plan == '500000') {
        return array('plan_type' => 'Pro', 'plan_amount' => '500k', 'plan_amount_full' => '500,000', 'image' => 'silver_image', 'image_name' => 'Fitbit Flex + Aria Scale', 'box_bg' => 'silver_box_bg', 'color' => '#e1a246', 'devices' => array('Fitbit Flex', 'Aria Scale'), 'device_images' => array('plan_fitbit_flex_m.png'));
    } elseif ($plan == '$750,000' || $plan == '750000') {
        return array('plan_type' => 'Premium', 'plan_amount' => '750k', 'plan_amount_full' => '750,000', 'image' => 'gold_image', 'image_name' => 'Fitbit ChargeHR + Aria Scale', 'box_bg' => 'gold_box_bg', 'color' => '#557ac1', 'devices' => array('Fitbit ChargeHR', 'Aria Scale'), 'device_images' => array('plan_fitbit_charge_m@1x.png'));
    } elseif ($plan == '$1,000,000' || $plan == '1000000') {
        return array('plan_type' => 'Ultimate', 'plan_amount' => '1m', 'plan_amount_full' => '1,000,000', 'image' => 'platinum_image', 'image_name' => 'Fitbit Surge + Aria Scale', 'box_bg' => 'platinum_box_bg', 'color' => '#bdd467', 'devices' => array('Fitbit Surge', 'Aria Scale'), 'device_images' => array('plan_fitbit_surge_m.png'));
    }
    return array('plan_type' => 'Basic', 'plan_amount' => '250k', 'plan_amount_full' => '250,000', 'image' => 'bronze_image', 'image_name' => 'Fitbit Flex + Aria Scale', 'box_bg' => 'bronze_box_bg', 'color' => '#d34b5c', 'devices' => array('Fitbit Flex', 'Aria Scale'), 'device_images' => array('plan_fitbit_flex_m.png'));
}

function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
         * Return array converted to object
         * Using __FUNCTION__ (Magic constant)
         * for recursive call
         */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}

/**
 * add user data
 * @param $array array
 * @param $keySearch string 
 * @return boolean key found or not  
 */
function findKey($array, $keySearch) {
    foreach ($array as $key => $item) {
        if ($key == $keySearch) {
            //echo 'yes, it exists';
            return true;
        } else {
            if (is_array($item) && findKey($item, $keySearch)) {
                return true;
            }
        }
    }

    return false;
}

/**
 * returns min and max date from array
 * @param $date1_timestamp string mindate timestamp
 * @param $date2_timestamp string maxdate timestamp
 * @return $months array list of all months between dates
 */
function get_months($date1_timestamp, $date2_timestamp) {
    $time1 = $date1_timestamp;
    $time2 = $date2_timestamp;

    $time1 = strtotime(date('Y-m', $time1) . '-01');
    $time2 = strtotime(date('Y-m', $time2) . '-01');

    $my = date('mY', $time2);

    $months[] = array('month_name_year' => date('M Y', $time1), 'timestamp' => $time1, 'month_num_year' => date('mY', $time1));

    while ($time1 < $time2) {
        $time1 = strtotime(date('Y-m-d', $time1) . ' +1 month');
        if (date('mY', $time1) != $my && ($time1 < $time2))
            $months[] = array('month_name_year' => date('M Y', $time1), 'timestamp' => $time1, 'month_num_year' => date('mY', $time1));
    }

    //$months[] = array(date('M Y', $time2),$time2,date('mY', $time2));
    $months[] = array('month_name_year' => date('M Y', $time2), 'timestamp' => $time2, 'month_num_year' => date('mY', $time2));
    $months = array_unique($months, SORT_REGULAR);
    //echo "<pre>";print_r($months);exit;
    //unset($months[0]);
    return $months;
}

/**
 * returns users savings in terms of months
 * @param $user_profile_data array
 * @param $user_savings array 
 * @return $result array which consists of all months premiums  
 */
function getUserMonthlyPremium($user_profile_data, $user_savings) {
    //echo "<pre>"; print_r($user_savings);
    $result = array();
    $all_months = array();
    $current_date_timestamp = strtotime(getCurrentTimeBasedOnTimezone());
    $user_created_date_timestamp = strtotime($user_profile_data->issue_date);
    //echo $current_date_timestamp;
    // echo $user_created_date_timestamp;exit;
    if ($user_created_date_timestamp < $current_date_timestamp) {
        $all_months = get_months($user_created_date_timestamp, $current_date_timestamp);
    }
    $user_monthly_savings = array();
    foreach ($user_savings as $key => $value) {
        $user_monthly_savings[mktime(0, 0, 0, $value['month'], 1, $value['year'])][] = $value;
    }
    //echo '<pre>';print_r($user_monthly_savings);exit;
    $i = 0;
    foreach ($all_months as $key => $value) {
        $flag = 0;
        foreach ($user_monthly_savings as $k => $v) {
            if ($value['timestamp'] == $k) {
                $flag++;
            }
        }
        if ($flag > 0) {
            $final_array[$i] = $value;
            $res = searchMultiArray($user_savings, 'discount_name', 'Steps Discount');
            if ($res != false && count($res) > 0) {
                $final_array[$i]['steps_goal_discount'] = $res['discount_percentage'];
            } else {
                $final_array[$i]['steps_goal_discount'] = 0;
            }
            $res = searchMultiArray($user_savings, 'discount_name', 'Weight Goal Discount');
            if ($res != false && count($res) > 0) {
                $final_array[$i]['weight_goal_discount'] = $res['discount_percentage'];
            } else {
                $final_array[$i]['weight_goal_discount'] = 0;
            }
            $res = searchMultiArray($user_savings, 'discount_name', 'Weight Maintenance Discount');
            if ($res != false && count($res) > 0) {
                $final_array[$i]['weight_maintenance_discount'] = $res['discount_percentage'];
            } else {
                $final_array[$i]['weight_maintenance_discount'] = 0;
            }

            $final_array[$i]['total_discount'] = $final_array[$i]['weight_goal_discount'] + $final_array[$i]['weight_maintenance_discount'] + $final_array[$i]['steps_goal_discount'];

            $final_array[$i]['premium'] = $user_monthly_savings[$value['timestamp']][0]['premium'];
            ;
        } else {
            $final_array[$i] = $value;
            $final_array[$i]['premium'] = $user_profile_data->initial_premium;
            $final_array[$i]['weight_goal_discount'] = 0;
            $final_array[$i]['weight_maintenance_discount'] = 0;
            $final_array[$i]['steps_goal_discount'] = 0;
            $final_array[$i]['total_discount'] = $final_array[$i]['weight_goal_discount'] + $final_array[$i]['weight_maintenance_discount'] + $final_array[$i]['steps_goal_discount'];
        }
        $i++;
    }
    //echo '<pre>';print_r($final_array);exit;
    return $final_array;
}

/**
 * returns users life time savings 
 * @param $user_profile_data array
 * @param $user_savings array 
 * @return $result array which consists of lifetime savings  
 */
function getUserLifetimeSavings($user_profile_data, $user_savings) {
    $return_array = array();
    //echo "<pre>";print_r($user_profile_data);exit;

    if (is_object($user_profile_data)) {
        $initial_premium_rate = $user_profile_data->initial_premium;
        $term_length = $user_profile_data->term_length;
    }
    $term_length = $term_length * 12;
    return $user_savings['lifetime_savings'] * $term_length;
}

function check_empty_values($assoc_array) {
    if (count($assoc_array) > 0) {
        foreach ($assoc_array as $key => $value) {
            if ($value == "")
                return true;
        }
        return false;
    }
}

function changeFitbitDateFormat($date) {
    $return_date_array = array();
    if ($date != "") {
        $date_array = explode("T", $date);
        $date = $date_array[0];
        $time = substr($date_array[1], 0, strlen($date_array[1]) - 4);
        $return_date_array = array('date' => $date, 'time' => $time);
    }
    return $return_date_array;
}

/**
 * getOS
 * @global type $user_agent
 * @return string
 */
function getOS() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];


    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/ubuntu/i' => 'Ubuntu',
        '/linux/i' => 'Linux',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
            break;
        }
    }

    return $os_platform;
}

/**
 * getBrowser
 * @global type $user_agent
 * @return string
 */
function getBrowser() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

function arrayToObject($var) {
    if (is_array($var)) {
        $object = new stdClass();
        foreach ($var as $key => $value) {
            $object->$key = $value;
        }
        return $object;
    } else {
        return $var;
    }
}

/**
 * returns users savings in terms of months
 * @param $user_data array
 * @param $normal_height_weight_array array
 * @param $user_savings array
 * @param $user_savings array 
 * @return $amount string savings amount  
 */
function getUserSavingsAmount($user_data, $normal_height_weight_array, $today_steps, $today_weight, $user_current_date) {
    $ci = & get_instance();
    //echo '<pre>';print_r($user_data);exit;
    $cheat['user_id'] = $user_data->id;
    $cheat['cheat_days'] = $ci->master->getCheatDaysByType(3001);
    $d = date_parse_from_format("Y-m-d", $user_current_date);
    $cheat['day'] = $d['day'];
    $cheat['month'] = $d['month'];
    $cheat['year'] = $d['year'];
    //echo "<pre>";print_r($cheat);exit;
    $cheatDays = $ci->user->getCheats($cheat);
    $previous_month = (date(m) - 1);
    //echo $previous_month;exit;
    //$cheatDays = $ci->session->userdata['userCheatDays'];
    //echo $cheatDays;exit;
    //echo '<pre>';print_r($ci->session->userdata);exit;
    $one_month_diff = date("Y-m-d", strtotime(date("Y-m-d", strtotime($ci->session->userdata['weight_last_reported_date'])) . "-1 month"));
    //echo $one_month_diff; exit;
    $user_id = $user_data->id;
    //echo $user_id;
    $weights_data = $ci->user->getMaxUserWeight($user_id, $previous_month);
    $last_month_max_weight = $weights_data[0]['weight'];
    //echo $user_current_date;
    //echo $today_weight;
    //echo '<pre>';print_r($weights_data);
    //echo $last_month_max_weight;exit;
    $initial_premium_rate = $user_data->initial_premium;

    //$weight_discount = $initial_premium_rate * (6 / 100);
    $weight_goal_discount = 0;
    $weight_maintenance_discount = 0;
    $steps_discount = 0;

    $steps_percentage = $ci->master->getDisPerByType(3001);
    $weights_percentage = $ci->master->getDisPerByType(3002);

    $weight_maintenance_percentage = $weights_percentage - 4;
    $weight_goal_percentage = $weights_percentage - $weight_maintenance_percentage;

    //echo '<pre>';print_r($weights_percentage);exit;

    $current_month = date('m');
    $current_year = date('Y');
    //echo $steps_discount;exit; 
    $number_of_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
    //echo $number_of_days;exit;
    $total_steps = ($number_of_days - 5) * 10000;
    //echo $cheatDays;exit;
    //echo $today_steps;exit;
    if ($cheatDays > 0) {
        $steps_discount = $initial_premium_rate * ($steps_percentage / 100);
        //echo $steps_discount;
        $each_step_cost = $steps_discount / $total_steps;
        //echo $each_step_cost;
        $steps_savings = $each_step_cost * $today_steps;
        //echo $steps_savings;exit;
    } else {
        $steps_discount = 0;
        $steps_savings = 0;
    }
    //echo $steps_savings;exit;
    //$user_data->height = str_ireplace('"', '\'', $user_data->height);
    //echo "<pre>";print_r($normal_height_weight_array);//exit;
    //replace double quote with single quote for height comparison
    /* if (count($normal_height_weight_array) > 0) {
      foreach ($normal_height_weight_array as $key => $subarray) {
      foreach ($subarray as $subkey => $subsubarray) {
      $normal_height_weight_array[$key][$subkey]['height'] = str_ireplace('"', '\'', $subsubarray['height']);
      }
      }
      } */
    //echo "<pre>";print_r($user_data);//exit;
    //weight savings calculation START

    $height_min_max = searchMultiArray($normal_height_weight_array, "height", $user_data->height);
    //echo "<pre>";print_r($last_month_max_weight);exit;
    //echo $today_weight;
    if ($today_weight <= $height_min_max['normal_end'] && $today_weight >= $height_min_max['normal_start']) {
        $weight_maintenance_discount = $initial_premium_rate * ($weight_maintenance_percentage / 100);
    }
    if ($last_month_max_weight <= $height_min_max['normal_end'] && $last_month_max_weight >= $height_min_max['normal_start']) {
        $weight_goal_discount = 0;
    } else {
        if ($today_weight <= $height_min_max['normal_end'] && $today_weight >= $height_min_max['normal_start']) {
            $weight_goal_discount = $initial_premium_rate * ($weight_goal_percentage / 100);
        } else {
            $weight_goal_discount = 0;
        }
    }
    $weight_discount = $weight_goal_discount + $weight_maintenance_discount;

    if ($user_data->weight < $height_min_max['normal_start'] && $today_weight > 0 && is_array($height_min_max) && count($height_min_max) > 0) {
        //echo 'hi';
        $weight_difference = $height_min_max['normal_start'] - $user_data->weight;
        $weight_change = $today_weight - $user_data->weight;
    } elseif ($user_data->weight > $height_min_max['normal_end'] && $today_weight > 0 && is_array($height_min_max) && count($height_min_max) > 0) {
        //echo 'hi1';
        $weight_difference = $user_data->weight - $height_min_max['normal_end'];
        $weight_change = $user_data->weight - $today_weight;
    } else {
        $weight_difference = 0;
        $weight_change = 0;
    }


    //echo $steps_discount;
    //echo $weight_maintenance_discount;
    //echo $weight_goal_discount;
    //exit;
    //echo $weight_difference." ".$weight_change;exit;
    $each_pount_cost = ($weight_difference > 0) ? ($weight_discount / $weight_difference) : 0;

    $weight_savings = $weight_change * $each_pount_cost;
    //echo $weight_savings;exit;

    if ($weight_savings > $weight_discount) {
        $weight_savings = $weight_discount;
    }

    //echo $weight_savings;
    //echo $weight_discount;
    //exit;
    //weight savings calculation END

    return array('steps_savings' => $steps_savings, 'weight_savings' => $weight_savings, 'steps_discount' => $steps_discount, 'weight_discount' => $weight_discount);
}

/**
 * returns formatted currency
 * @param $amount string
 * @return $return_amount string savings amount  
 */
function currencyFormat($amount) {
    $return_amount = "$0";

    if ($amount < 0.10) {
        $return_amount = round($amount * 100) . "&cent;";
    } else {
        $return_amount = "$" . number_format($amount, 2);
    }
    return $return_amount;
}

/**
 * returns todays_steps, weight and savings
 * @param $user_id int
 * @return $return_array array  
 */
function getDashboardLiveData($user_id, $user_current_date) {
    //echo $user_current_date;exit;
    $ci = & get_instance();

    //get user data
    $user_data = $ci->user->getUser(array('u.id' => $user_id));
    //echo "<pre>";print_r($user_data);exit;

    if ($user_current_date == null)
        $user_current_date = date("Y-m-d");
    //echo date("Y-m-d");
    //echo $user_current_date;exit;
    //get user today steps START
    $steps_data = $ci->user->getUserSteps(array('us.user_id' => $user_id, 'DATE_FORMAT(us.steps_date,"%Y-%m-%d")' => date("Y-m-d", strtotime($user_current_date))));
    $today_steps = 0;
    if (count($steps_data) > 0) {
        //echo "<pre>";print_r($steps_data);exit;
        $today_steps = $steps_data[0]['steps'];
    }
    //get user today steps end 
    //get user today weight START
    $weights_data = $ci->user->getUserWeights(array('uw.user_id' => $user_id, 'DATE_FORMAT(uw.weight_date,"%Y-%m-%d")<=' => date("Y-m-d", strtotime($user_current_date))));
    $today_weight = 0;
    if (count($weights_data) > 0) {
        //echo "<pre>";print_r($steps_data);exit;
        $today_weight = $weights_data[0]['weight'];
        $weight_last_reported_date = $weights_data[0]['weight_date'];
        $last_reported = date('F Y', strtotime($weight_last_reported_date));
    }
    //get user today weight end
    $ci->session->set_userdata('weight_last_reported_date', $weight_last_reported_date);
    $today_user_savings = "$0";
    //get height weight chart data START
    $height_weight_data = $ci->user->getHeightWeightChart();
    //get height weight chart data END

    $savings_array = getUserSavingsAmount($user_data, $height_weight_data, $today_steps, $today_weight, $user_current_date);

    $today_savings = $savings_array['steps_savings'] + $savings_array['weight_savings'];

    $estimated_savings = $savings_array['steps_discount'] + $savings_array['weight_discount'];
    //echo $estimated_savings;exit;
    return array('today_steps' => $today_steps,
        'today_weight' => $today_weight,
        'today_savings' => round($today_savings, 2),
        'estimated_savings' => round($estimated_savings, 2),
        'weight_last_reported_date' => $weight_last_reported_date);
}

/**
 * returns todays_steps, weight and savings
 * @param $user_id int
 * @return $return_array array  
 */
function getLiveData($user_id, $user_current_date) {

    $ci = & get_instance();
    $to_date = $user_current_date;
    //echo "<pre>";print_r($dates);exit;

    $time = strtotime($to_date);
    $month = date("m", $time);
    $year = date("Y", $time);
    $from_date = $year . "-" . $month . "-01"; //get month first date from user current date
    $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //echo $from_date;exit;

    $last_month_timestamp = strtotime($to_date . " -1 months");
    $last_month = date("m", $last_month_timestamp);
    $last_year = date("Y", $last_month_timestamp);
    $last_month_first_date = $last_year . "-" . $last_month . "-01";

    $today_steps = 0;
    $today_weight = 0;
    $today_savings = 0;
    $today_steps_savings = 0;
    $today_weight_savings = 0;
    $estimated_savings = 0;
    $weight_last_reported_date = "";
    $last_month_weight = 0;
    $last_month_weight_date = "";

    //get user data
    $user_data = $ci->user->getUser(array('u.id' => $user_id));
    //echo "<pre>";print_r($user_data);exit;
    $initial_premium_rate = $user_data->initial_premium;

    $cheat['cheat_days'] = $ci->master->getCheatDaysByType(3001);

    $steps_percentage = $ci->master->getDisPerByType(3001);
    $weights_percentage = $ci->master->getDisPerByType(3002);
    //echo $initial_premium_rate." ".$steps_percentage." ".$weights_percentage ;exit;

    $weight_maintenance_percentage = $weights_percentage - 4;
    $weight_goal_percentage = $weights_percentage - $weight_maintenance_percentage;


    //get steps of the user from current date to one month back
    $where_array = array();
    $where_in_array = array();
    $where_array = array(
        'user_id' => $user_id,
        'DATE_FORMAT(us.steps_date,"%Y-%m-%d") >= ' => $from_date,
        'DATE_FORMAT(us.steps_date,"%Y-%m-%d") <= ' => $to_date);
    $order_by_array = array("user_id" => "ASC", "steps_date" => "DESC");
    $steps = $ci->user->getUserSteps($where_array, $order_by_array, $where_in_array);
    //echo "<pre>Hi";print_r($steps);exit;

    $current_month_steps = 0;
    if (count($steps) > 0) {
        foreach ($steps as $st) {
            $steps_count = ( $st['steps'] > STEPS_LIMIT ) ? STEPS_LIMIT : $st['steps'];
            $current_month_steps = $current_month_steps + $steps_count;

            if (substr($st['steps_date'], 0, 10) == $to_date)
                $today_steps = $st['steps'];

            if (substr($st['steps_date'], 0, 10) == $from_date)
                break;
        }
    }

    $total_steps = ($number_of_days - $cheat['cheat_days']) * STEPS_LIMIT;
    $steps_discount = $initial_premium_rate * ($steps_percentage / 100);
    //echo $steps_discount;
    $each_step_cost = $steps_discount / $total_steps;
    //echo $each_step_cost;
    if ($each_step_cost > 0 && $current_month_steps > 0)
        $steps_savings = $each_step_cost * $current_month_steps;
    //echo $steps_savings;exit;

    if ($each_step_cost > 0 && $today_steps > 0)
        $today_steps_savings = $each_step_cost * $today_steps;

    //get height weight chart data START
    $height_weight_data = $ci->user->getHeightWeightChart();
    //get height weight chart data END
    //get weights of the user from current date to one month back
    $where_array = array();
    $where_in_array = array();
    $where_array = array(
        'user_id' => $user_id,
        'DATE_FORMAT(uw.weight_date,"%Y-%m-%d") >= ' => $last_month_first_date,
        'DATE_FORMAT(uw.weight_date,"%Y-%m-%d") <= ' => $to_date);
    $order_by_array = array("weight_date" => "DESC", "id" => "DESC");
    $weights = $ci->user->getUserWeights($where_array, $order_by_array, $where_in_array);
    //echo "<pre>1";print_r($weights);exit;

    if (count($weights) > 0) {
        foreach ($weights as $w) {
            if ($weight_last_reported_date == "" && $w['weight'] != "" && $w['weight'] > 0) {
                $today_weight = $w['weight'];
                $weight_last_reported_date = $w['weight_date'];
            }


            $weight_month_timestamp = strtotime($w['weight_date']);
            $weight_month = date("m", $weight_month_timestamp);
            $weight_year = date("Y", $weight_month_timestamp);


            if (( $last_month_weight == "" || $last_month_weight == 0 ) && $weight_month == $last_month && $weight_year == $last_year) {
                $last_month_weight = $w['weight'];
                $last_month_weight_date = $w['weight_date'];
            }
        }
    }

    $weight_goal_discount = $initial_premium_rate * ( $weight_goal_percentage / 100);
    $weight_maintenance_discount = $initial_premium_rate * ($weight_maintenance_percentage / 100);
    //echo "<pre>";print_r($height_weight_data);exit;
    $height_min_max = searchMultiArray($height_weight_data, "height", $user_data->height);

    $today_weight_maintenance_discount = 0;
    if ($today_weight <= $height_min_max['normal_end'] && $today_weight >= $height_min_max['normal_start']) {
        $today_weight_maintenance_discount = $initial_premium_rate * ($weight_maintenance_percentage / 100);
    }

    $weight_difference = 0;
    $weight_change = 0;

    //echo "<pre>";print_r($height_min_max);exit;
    //echo $last_month_weight;exit;
    if (is_array($height_min_max) && count($height_min_max) > 0) {
        if ($last_month_weight > 0) {
            if ($last_month_weight < $height_min_max['normal_start'] && $today_weight > 0 && $today_weight <= $height_min_max['normal_end']) {
                //echo 'hi';exit;
                $weight_difference = $height_min_max['normal_start'] - $last_month_weight;
                $weight_change = $today_weight - $last_month_weight;
            } elseif ($last_month_weight > $height_min_max['normal_end'] && $today_weight > 0 && $today_weight >= $height_min_max['normal_start']) {
                //echo 'hi1';exit;
                $weight_difference = $last_month_weight - $height_min_max['normal_end'];
                $weight_change = $last_month_weight - $today_weight;
            }
        } else {
            if ($user_data->weight < $height_min_max['normal_start'] && $today_weight > 0 && $today_weight <= $height_min_max['normal_end']) {
                //echo 'hi';exit;
                $weight_difference = $height_min_max['normal_start'] - $user_data->weight;
                $weight_change = $today_weight - $user_data->weight;
            } elseif ($user_data->weight > $height_min_max['normal_end'] && $today_weight > 0 && $today_weight >= $height_min_max['normal_start']) {
                //echo 'hi1';
                $weight_difference = $user_data->weight - $height_min_max['normal_end'];
                $weight_change = $user_data->weight - $today_weight;
            }
        }
    }

    //echo $weight_difference." ".$weight_change;exit;
    $each_pount_cost = ($weight_difference > 0) ? ($weight_goal_discount / $weight_difference) : 0;

    $weight_change = ( $weight_change > $weight_difference ) ? $weight_difference : $weight_change;
    $weight_change = ( $weight_change > 0 ) ? $weight_change : 0;

    $today_weight_savings = $weight_change * $each_pount_cost;
    //echo $weight_savings;exit;
    //echo $today_steps_savings." ".$today_weight_savings." ".$today_weight_maintenance_discount;exit;
    $today_savings = $today_steps_savings + $today_weight_savings + $today_weight_maintenance_discount;
    $estimated_savings = $steps_savings + $weight_goal_discount + $weight_maintenance_discount;

    $today_savings_msg = "Today Savings : <b>$ " . round($today_savings, 2) . "</b>";
    $savings_heading = " Estimated Savings ";


    if ($today_steps < 10000) {
        $steps_remaining = 10000 - $today_steps;
        $steps_msg = "Only <b>" . $steps_remaining . " steps</b> left today";
    } else {
        $steps_msg = "Total Steps are reached";
    }

    if (isset($weight_last_reported_date) && $weight_last_reported_date != "") {
        $weight_msg = "Last reported on <b>" . date("M jS Y", strtotime($weight_last_reported_date)) . "</b>";
    } else {
        $weight_msg = "Not yet reported.";
    }

    $today_weight = ( $today_weight > 0 && $today_weight != "" ) ? convertUnits($today_weight, 'lbs') : 0;

    return array('today_steps' => $today_steps,
        'today_weight' => $today_weight,
        'today_savings' => round($today_savings, 2),
        'estimated_savings' => round($estimated_savings, 2),
        'weight_last_reported_date' => $weight_last_reported_date,
        'savings_heading' => $savings_heading,
        'today_savings_msg' => $today_savings_msg,
        'steps_msg' => $steps_msg,
        'weight_msg' => $weight_msg
    );
}

/**
 * returns user information in strucured format for sureify application process
 * @param $user_info array
 * @return $return_array array  
 */
function buildInsertArray($user_info) {
    //echo "<pre>";print_r($user_info);exit;
    $ci = & get_instance();
    $main_array = array();
    $main_array['personalinfo'] = array();
    $main_array['personalinfo']['full_name'] = $user_info['first_name'] . " " . $user_info['middle_name'] . " " . $user_info['last_name'];
    $main_array['personalinfo']['first_name'] = $user_info['first_name'];
    $main_array['personalinfo']['middle_name'] = (isset($user_info['middle_name']) && $user_info['middle_name'] != "") ? $user_info['middle_name'] : "";
    $main_array['personalinfo']['last_name'] = $user_info['last_name'];
    $dob = $user_info['user_year'] . "-" . $user_info['user_month'] . "-" . $user_info['user_day'];
    $main_array['personalinfo']['date_of_birth'] = date("Y-m-d", strtotime($dob));
    $main_array['personalinfo']['user_address_line1'] = $user_info['user_address_line1'];
    $main_array['personalinfo']['user_address_line2'] = $user_info['user_address_line2'];
    $main_array['personalinfo']['location'] = $user_info['user_city'];
    $main_array['personalinfo']['user_address_city'] = $user_info['user_city'];
    $main_array['personalinfo']['user_address_state'] = $user_info['user_state'];
    $main_array['personalinfo']['user_address_zipcode'] = $user_info['user_zipcode'];
    $main_array['personalinfo']['phone_number'] = $user_info['user_cell_no'];
    $main_array['personalinfo']['user_work_number'] = $user_info['user_work_no'];
    $main_array['personalinfo']['user_home_number'] = $user_info['user_home_no'];
    $main_array['personalinfo']['user_occupation'] = $user_info['user_occupation'];
    $main_array['personalinfo']['user_another_zip'] = $user_info['user_another_zipcode'];
    //$main_array['personalinfo']['smoke'] = 0;
    $main_array['personalinfo']['user_birth_country_or_state'] = isset($user_info['not_in_us']) ? $user_info['not_in_us'] : 0;
    if (isset($user_info["not_in_us"]) && $user_info["not_in_us"] == "7001") {
        $main_array['personalinfo']['user_birth_place'] = $user_info['user_birth_country'];
    } else {
        $main_array['personalinfo']['user_birth_place'] = $user_info['user_birth_state'];
    }
    //echo '<pre>';print_r($main_array);exit;

    $main_array['personalinfo']['gender'] = $user_info['user_sex'];
    if ($ci->uri->segment(3) != "") {
        $newSsn = explode("-", $user_info['user_ssn']);
        if ($newSsn[0] == "XXX") {
            $main_array['personalinfo']['ssn'] = $ci->session->userdata['userSecurityNumber'];
        } else {
            $main_array['personalinfo']['ssn'] = $user_info['user_ssn'];
        }
        $ci->session->unset_userdata('userSecurityNumber');
    } else {
        $main_array['personalinfo']['ssn'] = $user_info['user_ssn'];
    }


    $main_array['personalinfo']['driving_license'] = $user_info['user_dln'];
    $main_array['personalinfo']['user_dln_state'] = ($user_info['state_issued'] != '') ? $user_info['state_issued'] : 0;
    $main_array['personalinfo']['height'] = $user_info['user_height'];
    $main_array['personalinfo']['weight'] = $user_info['user_weight'];
    $main_array['beneficiaryinfo'] = array();

    for ($i = 0; $i < count($user_info['pri_ben_name']); $i++) {
        $main_array['beneficiaryinfo'][$i]['first_name'] = $user_info['pri_ben_name'][$i];
        $main_array['beneficiaryinfo'][$i]['type'] = '8001';
        $main_array['beneficiaryinfo'][$i]['relation'] = $user_info['pri_rel_name'][$i];
        $main_array['beneficiaryinfo'][$i]['percentage'] = $user_info['pri_rel_ins_percentage'][$i];
    }
    $j = 0;
    for ($i = count($user_info['pri_ben_name']); $i < (count($user_info['pri_ben_name']) + count($user_info['con_ben_name'])); $i++) {
        $main_array['beneficiaryinfo'][$i]['first_name'] = $user_info['con_ben_name'][$j];
        $main_array['beneficiaryinfo'][$i]['type'] = '8002';
        $main_array['beneficiaryinfo'][$i]['relation'] = $user_info['con_rel_name'][$j];
        $main_array['beneficiaryinfo'][$i]['percentage'] = $user_info['con_rel_ins_percentage'][$j];
        $j++;
    }

    $main_array['ownerinfo'] = array();
    $main_array['ownerinfo']['owner_type'] = isset($user_info['policy_manager']) ? $user_info['policy_manager'] : "";
    $main_array['ownerinfo']['person_status'] = isset($user_info['policy_manager_person']) ? $user_info['policy_manager_person'] : "";
    $main_array['ownerinfo']['join_owner_status'] = isset($user_info['joint_owner']) ? $user_info['joint_owner'] : "";
    $main_array['ownerinfo']['trust_name'] = $user_info['trust_name'];
    $main_array['ownerinfo']['trust_address_line1'] = $user_info['trust_address_line1'];
    $main_array['ownerinfo']['trust_address_line2'] = $user_info['trust_address_line2'];
    $main_array['ownerinfo']['trust_address_city'] = $user_info['trust_city'];
    $main_array['ownerinfo']['trust_address_state'] = ($user_info['trust_state'] != '') ? $user_info['trust_state'] : 0;
    $main_array['ownerinfo']['trust_address_zipcode'] = $user_info['trust_zipcode'];
    $main_array['ownerinfo']['person_name'] = $user_info['person_name'];
    $main_array['ownerinfo']['person_owner_relation'] = $user_info['person_relationship'];
    if ($ci->uri->segment(3) != "") {
        $newSsn = explode("-", $user_info['person_taxid']);
        if ($newSsn[0] == "XXX") {
            $main_array['ownerinfo']['person_owner_ssn'] = $ci->session->userdata['personTaxID'];
        } else {
            $main_array['ownerinfo']['person_owner_ssn'] = $user_info['person_taxid'];
        }
        $ci->session->unset_userdata('personTaxID');
    } else {
        $main_array['ownerinfo']['person_owner_ssn'] = $user_info['person_taxid'];
    }
    //$main_array['ownerinfo']['person_owner_ssn'] = $user_info['person_taxid'];
    $main_array['ownerinfo']['person_address_line1'] = $user_info['person_address_line1'];
    $main_array['ownerinfo']['person_address_line2'] = $user_info['person_address_line2'];
    $main_array['ownerinfo']['personaddress_city'] = $user_info['person_city'];
    $main_array['ownerinfo']['personaddress_state'] = ($user_info['person_state'] != '') ? $user_info['person_state'] : 0;
    $main_array['ownerinfo']['personaddress_zipcode'] = $user_info['person_zipcode'];
    $person_dob = $user_info['person_birthyear'] . "-" . $user_info['person_birthmonth'] . "-" . $user_info['person_birthday'];
    $main_array['ownerinfo']['person_dob'] = date("Y-m-d", strtotime($person_dob));

    $main_array['insuranceinfo'] = array();

    for ($i = 0; $i < count($user_info['insured_name']); $i++) {
        $main_array['insuranceinfo'][$i]['insurance_flag'] = isset($user_info['insurance_applied']) ? $user_info['insurance_applied'] : "";
        $main_array['insuranceinfo'][$i]['insured_name'] = $user_info['insured_name'][$i];
        $main_array['insuranceinfo'][$i]['company'] = $user_info['insured_company'][$i];
        $main_array['insuranceinfo'][$i]['amount'] = $user_info['insured_amount'][$i];
        $main_array['insuranceinfo'][$i]['policy_number'] = $user_info['insured_policy_number'][$i];
        $main_array['insuranceinfo'][$i]['insurance_pending'] = (isset($user_info['insured_policy_pending'][$i]) && $user_info['insured_policy_pending'][$i] != "") ? $user_info['insured_policy_pending'][$i] : "";
        $main_array['insuranceinfo'][$i]['policy_issued_year'] = (isset($user_info['insured_year'][$i]) && $user_info['insured_year'][$i] != "") ? $user_info['insured_year'][$i] : "";
        $main_array['insuranceinfo'][$i]['policy_purpose'] = $user_info['retirement'][$i];
    }

    //echo "<pre>"; print_r($main_array);exit;
    $main_array['medicalinfo'] = array();

    for ($i = 0; $i < count($user_info['diagnosis_name']); $i++) {
        $main_array['medicalinfo'][$i]['user_drug_dependency'] = isset($user_info['your_drug']) ? $user_info['your_drug'] : "";
        $main_array['medicalinfo'][$i]['user_diagnosis'] = $user_info['diagnosis_name'][$i];
        $date_array = explode("/", $user_info['diagnosis_date'][$i]);
        if (!empty($date_array) && isset($date_array[0]) && $date_array[1]) {
            $db = $date_array[1] . "-" . $date_array[0] . "-01";
            $date_dia = date("Y-m-d", strtotime($db));
        } else {
            $date_dia = "";
        }

        $main_array['medicalinfo'][$i]['date_of_diagnosed'] = $date_dia;
        $main_array['medicalinfo'][$i]['healthcare_provider'] = $user_info['provider'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_address_line1'] = $user_info['diagnosis_address_line1'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_address_line2'] = $user_info['diagnosis_address_line2'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_city'] = $user_info['diagnosis_city'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_state'] = $user_info['medical_state'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_zipcode'] = $user_info['diagnosis_zip'][$i];
        //$main_array['replacementinfo'][$i]['internal_revenue_code'] = $user_info['exchange'];
    }

    $main_array['replacementinfo'] = array();

    for ($i = 0; $i < count($user_info['company_name']); $i++) {
        $main_array['replacementinfo'][$i]['replacement_flag'] = isset($user_info['replacement']) ? $user_info['replacement'] : "";
        $main_array['replacementinfo'][$i]['replacement_company'] = $user_info['company_name'][$i];
        $main_array['replacementinfo'][$i]['replacement_policyno'] = $user_info['policy_name'][$i];
        /* if ($user_info['document_name'][$i] == "" && isset($user_info['documents'][$i]) && $user_info['documents'][$i] != "") {
          $main_array['replacementinfo'][$i]['document'] = $user_info['documents'][$i];
          } else if ($user_info['document_name'][$i] != "" && isset($user_info['documents'][$i]) && $user_info['documents'][$i] != "") {
          $main_array['replacementinfo'][$i]['document'] = $user_info['documents'][$i];
          } else {
          $main_array['replacementinfo'][$i]['document'] = $user_info['document_name'][$i];
          } */
        $main_array['replacementinfo'][$i]['internal_revenue_code'] = isset($user_info['exchange']) ? $user_info['exchange'] : "";
    }

    $main_array['payment_info'] = array();

    if ($user_info['payment_type'] == 1) {
        $main_array['payment_info']['payment_type'] = (isset($user_info['payment_type']) && $user_info['payment_type'] != "") ? $user_info['payment_type'] : "";
        $main_array['payment_info']['bank_name'] = (isset($user_info['bank_name']) && $user_info['bank_name'] != "") ? $user_info['bank_name'] : "";
        $main_array['payment_info']['bank_acno'] = (isset($user_info['bank_acno']) && $user_info['bank_acno'] != "") ? $user_info['bank_acno'] : "";
        $main_array['payment_info']['bank_routingno'] = (isset($user_info['bank_routingno']) && $user_info['bank_routingno'] != "") ? $user_info['bank_routingno'] : "";
        $main_array['payment_info']['bank_settlement'] = (isset($user_info['bank_settlement']) && $user_info['bank_settlement'] != "") ? $user_info['bank_settlement'] : 0;
        $main_array['payment_info']['bank_shortage'] = (isset($user_info['bank_shortage']) && $user_info['bank_shortage'] != "") ? $user_info['bank_shortage'] : "";
        $main_array['payment_info']['bank_requirement'] = (isset($user_info['bank_requirement']) && $user_info['bank_requirement'] != "") ? $user_info['bank_requirement'] : "";
    } else {
        $main_array['payment_info']['payment_type'] = (isset($user_info['payment_type']) && $user_info['payment_type'] != "") ? $user_info['payment_type'] : "";
        $main_array['payment_info']['card_number'] = (isset($user_info['credit_card_no']) && $user_info['credit_card_no'] != "") ? $user_info['credit_card_no'] : "";
        $main_array['payment_info']['expiration_date'] = (isset($user_info['exp_date']) && $user_info['exp_date'] != "") ? $user_info['exp_date'] : "";
        $main_array['payment_info']['cvv'] = (isset($user_info['card_cvv']) && $user_info['card_cvv'] != "") ? $user_info['card_cvv'] : "";
        $main_array['payment_info']['save_card'] = (isset($user_info['save_card']) && $user_info['save_card'] != "") ? $user_info['save_card'] : "";
    }
    return $main_array;
}

/**
 * returns user information in strucured format to confirm page for sureify application process
 * @param $user_info array
 * @return $return_array array  
 */
function buildSessionArray($user_info) {
    $main_array = array();
    if (count($user_info) > 0) {
        //User personal information
        $main_array['personalinfo'] = array();
        $main_array['personalinfo']['user_name'] = $user_info['personalinfo']->full_name;
        $main_array['personalinfo']['first_name'] = $user_info['personalinfo']->first_name;
        $main_array['personalinfo']['middle_name'] = $user_info['personalinfo']->middle_name;
        $main_array['personalinfo']['last_name'] = $user_info['personalinfo']->last_name;
        $dob = explode(" ", $user_info['personalinfo']->date_of_birth);
        $user_dob = explode("-", $dob[0]);
        $main_array['personalinfo']['user_year'] = $user_dob[0];
        $main_array['personalinfo']['user_month'] = $user_dob[1];
        $main_array['personalinfo']['user_day'] = $user_dob[2];
        $main_array['personalinfo']['user_address_line1'] = $user_info['personalinfo']->user_address_line1;
        $main_array['personalinfo']['user_address_line2'] = $user_info['personalinfo']->user_address_line2;
        $main_array['personalinfo']['user_city'] = $user_info['personalinfo']->user_address_city;
        $main_array['personalinfo']['user_state'] = $user_info['personalinfo']->user_address_state;
        $main_array['personalinfo']['user_zipcode'] = $user_info['personalinfo']->user_address_zipcode;
        $main_array['personalinfo']['user_cell_no'] = $user_info['personalinfo']->phone_number;
        $main_array['personalinfo']['user_work_no'] = $user_info['personalinfo']->user_work_number;
        $main_array['personalinfo']['user_home_no'] = $user_info['personalinfo']->user_home_number;
        $main_array['personalinfo']['user_occupation'] = $user_info['personalinfo']->user_occupation;
        $main_array['personalinfo']['user_birth_place'] = $user_info['personalinfo']->user_birth_place;
        $main_array['personalinfo']['user_sex'] = $user_info['personalinfo']->gender;
        $main_array['personalinfo']['user_ssn'] = $user_info['personalinfo']->ssn;
        $main_array['personalinfo']['user_dln'] = $user_info['personalinfo']->driving_license;
        $main_array['personalinfo']['state_issued'] = $user_info['personalinfo']->user_dln_state;
        $main_array['personalinfo']['user_another_zipcode'] = $user_info['personalinfo']->user_another_zip;
        $main_array['personalinfo']['not_in_us'] = $user_info['personalinfo']->user_birth_country_or_state;
        $main_array['personalinfo']['user_height'] = $user_info['personalinfo']->height;
        $main_array['personalinfo']['user_weight'] = $user_info['personalinfo']->weight;
        $main_array['personalinfo']['payment_type'] = $user_info['personalinfo']->payment_type;
        $main_array['personalinfo']['stripe_customer_id'] = $user_info['personalinfo']->stripe_customer_id;

        //User beneficiary information
        $main_array['beneficiaryinfo'] = array();
        $j = 0;
        $k = 0;

        foreach ($user_info['beneficiaryinfo'] as $key => $value) {
            if ($value->type == 8001) {
                $main_array['beneficiaryinfo'][$value->type][$j]['pri_ben_name'] = $value->first_name;
                $main_array['beneficiaryinfo'][$value->type][$j]['pri_rel_name'] = $value->relation;
                $main_array['beneficiaryinfo'][$value->type][$j]['pri_rel_ins_percentage'] = $value->percentage;
                $j++;
            } else {
                $main_array['beneficiaryinfo'][$value->type][$k]['con_ben_name'] = $value->first_name;
                $main_array['beneficiaryinfo'][$value->type][$k]['con_rel_name'] = $value->relation;
                $main_array['beneficiaryinfo'][$value->type][$k]['con_rel_ins_percentage'] = $value->percentage;
                $k++;
            }
        }

        //User ownership information
        $main_array['ownerinfo'] = array();
        $main_array['ownerinfo']['policy_manager'] = $user_info['ownerinfo']->owner_type;
        $main_array['ownerinfo']['policy_manager_person'] = $user_info['ownerinfo']->person_status;
        $main_array['ownerinfo']['joint_owner'] = $user_info['ownerinfo']->join_owner_status;
        $main_array['ownerinfo']['trust_name'] = $user_info['ownerinfo']->trust_name;
        $main_array['ownerinfo']['trust_address_line1'] = $user_info['ownerinfo']->trust_address_line1;
        $main_array['ownerinfo']['trust_address_line2'] = $user_info['ownerinfo']->trust_address_line2;
        $main_array['ownerinfo']['trust_city'] = $user_info['ownerinfo']->trust_address_city;
        $main_array['ownerinfo']['trust_state'] = $user_info['ownerinfo']->trust_address_state;
        $main_array['ownerinfo']['trust_zipcode'] = $user_info['ownerinfo']->trust_address_zipcode;
        $main_array['ownerinfo']['person_name'] = $user_info['ownerinfo']->person_name;
        $main_array['ownerinfo']['person_relationship'] = $user_info['ownerinfo']->person_owner_relation;
        $main_array['ownerinfo']['person_taxid'] = $user_info['ownerinfo']->person_owner_ssn;
        $main_array['ownerinfo']['person_address_line1'] = $user_info['ownerinfo']->person_address_line1;
        $main_array['ownerinfo']['person_address_line2'] = $user_info['ownerinfo']->person_address_line2;
        $main_array['ownerinfo']['person_city'] = $user_info['ownerinfo']->personaddress_city;
        $main_array['ownerinfo']['person_state'] = $user_info['ownerinfo']->personaddress_state;
        $main_array['ownerinfo']['person_zipcode'] = $user_info['ownerinfo']->personaddress_zipcode;
        $pdob = explode("-", $user_info['ownerinfo']->person_dob);
        $main_array['ownerinfo']['person_birthyear'] = $pdob[0];
        $main_array['ownerinfo']['person_birthmonth'] = $pdob[1];
        $main_array['ownerinfo']['person_birthday'] = $pdob[2];

        //User insurance information
        $main_array['insuranceinfo'] = array();

        foreach ($user_info['insuranceinfo'] as $key => $value) {
            $main_array['insuranceinfo'][$key]['insurance_applied'] = $value->insurance_flag;
            $main_array['insuranceinfo'][$key]['insured_name'] = $value->insured_name;
            $main_array['insuranceinfo'][$key]['insured_company'] = $value->company;
            $main_array['insuranceinfo'][$key]['insured_amount'] = $value->amount;
            $main_array['insuranceinfo'][$key]['insured_policy_number'] = $value->policy_number;
            $main_array['insuranceinfo'][$key]['insured_policy_pending'] = $value->insurance_pending;
            $main_array['insuranceinfo'][$key]['insured_year'] = $value->policy_issued_year;
            $main_array['insuranceinfo'][$key]['retirement'] = $value->policy_purpose;
        }

        //User medical infoatmation
        $main_array['medicalinfo'] = array();
        foreach ($user_info['medicalinfo'] as $key => $value) {
            $main_array['medicalinfo'][$key]['your_drug'] = $value->user_drug_dependency;
            $main_array['medicalinfo'][$key]['diagnosis_name'] = $value->user_diagnosis;
            $main_array['medicalinfo'][$key]['diagnosis_date'] = date("m/Y", strtotime($value->date_of_diagnosed));
            $main_array['medicalinfo'][$key]['provider'] = $value->healthcare_provider;
            $main_array['medicalinfo'][$key]['diagnosis_address_line1'] = $value->healthprovider_address_line1;
            $main_array['medicalinfo'][$key]['diagnosis_address_line2'] = $value->healthprovider_address_line2;
            $main_array['medicalinfo'][$key]['diagnosis_city'] = $value->healthprovider_city;
            $main_array['medicalinfo'][$key]['medical_state'] = $value->healthprovider_state;
            $main_array['medicalinfo'][$key]['diagnosis_zip'] = $value->healthprovider_zipcode;
        }

        //User replacement information
        $main_array['replacementinfo'] = array();

        foreach ($user_info['replacementinfo'] as $key => $value) {
            $main_array['replacementinfo'][$key]['replacement'] = $value->replacement_flag;
            $main_array['replacementinfo'][$key]['company_name'] = $value->replacement_company;
            $main_array['replacementinfo'][$key]['policy_name'] = $value->replacement_policyno;
            $main_array['replacementinfo'][$key]['documents'] = $value->document;
            $main_array['replacementinfo'][$key]['exchange'] = $value->internal_revenue_code;
        }

        //User spouse infoatmation
        $main_array['payment_info'] = array();
        if ($user_info['cardinfo']->payment_type == 1) {
            $main_array['payment_info']['payment_type'] = isset($user_info['cardinfo']->payment_type) ? $user_info['cardinfo']->payment_type : "";
            $main_array['payment_info']['bank_name'] = isset($user_info['cardinfo']->bank_name) ? $user_info['cardinfo']->bank_name : "";
            $main_array['payment_info']['bank_acno'] = isset($user_info['cardinfo']->bank_acno) ? $user_info['cardinfo']->bank_acno : "";
            $main_array['payment_info']['bank_routingno'] = isset($user_info['cardinfo']->bank_routingno) ? $user_info['cardinfo']->bank_routingno : "";
            $main_array['payment_info']['bank_settlement'] = isset($user_info['cardinfo']->bank_settlement) ? $user_info['cardinfo']->bank_settlement : 0;
            $main_array['payment_info']['bank_shortage'] = isset($user_info['cardinfo']->bank_shortage) ? $user_info['cardinfo']->bank_shortage : "";
            $main_array['payment_info']['bank_requirement'] = isset($user_info['cardinfo']->bank_requirement) ? $user_info['cardinfo']->bank_requirement : "";
        } else {
            $main_array['payment_info']['payment_type'] = isset($user_info['cardinfo']->payment_type) ? $user_info['cardinfo']->payment_type : "";
            $main_array['payment_info']['card_number'] = isset($user_info['cardinfo']->card_number) ? $user_info['cardinfo']->card_number : "";
            $main_array['payment_info']['expiration_date'] = isset($user_info['cardinfo']->expiration_date) ? $user_info['cardinfo']->expiration_date : "";
            $main_array['payment_info']['cvv'] = isset($user_info['cardinfo']->cvv) ? $user_info['cardinfo']->cvv : "";
            $main_array['payment_info']['save_card'] = isset($user_info['cardinfo']->save_card) ? $user_info['cardinfo']->save_card : "";
        }
    }
    //echo "<pre>"; print_r($main_array);exit;
    return $main_array;
}

/**
 * returns user information in strucured format for sureify insurance application process
 * @param $user_info array
 * @return $return_array array  
 */
function prepareInsertArray($user_info) {
    //echo "<pre>"; print_r($user_info);exit;
    $ci = & get_instance();
    $main_array = array();
    $main_array['personalinfo'] = array();
    $main_array['personalinfo']['first_name'] = $user_info['first_name'];
    $main_array['personalinfo']['middle_name'] = (isset($user_info['middle_name']) && $user_info['middle_name'] != "") ? $user_info['middle_name'] : "";
    $main_array['personalinfo']['last_name'] = $user_info['last_name'];
    $dob = $user_info['user_year'] . "-" . $user_info['user_month'] . "-" . $user_info['user_day'];
    $main_array['personalinfo']['user_date_of_birth'] = date("Y-m-d", strtotime($dob));
    $main_array['personalinfo']['user_address_line1'] = $user_info['user_address_line1'];
    $main_array['personalinfo']['user_address_line2'] = $user_info['user_address_line2'];
    $main_array['personalinfo']['user_address_city'] = $user_info['user_city'];
    $main_array['personalinfo']['user_address_state'] = $user_info['user_state'];
    $main_array['personalinfo']['user_address_zipcode'] = $user_info['user_zipcode'];
    $main_array['personalinfo']['user_phone_number'] = $user_info['user_cell_no'];
    $main_array['personalinfo']['user_work_number'] = $user_info['user_work_no'];
    $main_array['personalinfo']['user_home_number'] = $user_info['user_home_no'];
    $main_array['personalinfo']['user_occupation'] = $user_info['user_occupation'];
    $main_array['personalinfo']['user_another_zip'] = $user_info['user_another_zipcode'];
    $main_array['personalinfo']['user_birth_country_or_state'] = isset($user_info['not_in_us']) ? $user_info['not_in_us'] : "";
    if (isset($user_info["not_in_us"]) && $user_info["not_in_us"] == "7001") {
        $main_array['personalinfo']['user_birth_place'] = $user_info['user_birth_country'];
    } else {
        $main_array['personalinfo']['user_birth_place'] = $user_info['user_birth_state'];
    }

    $main_array['personalinfo']['gender'] = $user_info['user_sex'];
    $main_array['personalinfo']['user_ssn'] = $user_info['user_ssn'];
    $main_array['personalinfo']['user_dln'] = $user_info['user_dln'];
    $main_array['personalinfo']['user_dln_state'] = $user_info['state_issued'];
    $main_array['personalinfo']['user_id'] = $ci->session->userdata['current_userid'];
    $main_array['personalinfo']['user_session_id'] = $ci->session->userdata['current_user_sessionid'];
    $main_array['beneficiaryinfo'] = array();

    for ($i = 0; $i < count($user_info['pri_ben_name']); $i++) {
        $main_array['beneficiaryinfo'][$i]['beneficiary_name'] = $user_info['pri_ben_name'][$i];
        $main_array['beneficiaryinfo'][$i]['type'] = '8001';
        $main_array['beneficiaryinfo'][$i]['relation'] = $user_info['pri_rel_name'][$i];
        $main_array['beneficiaryinfo'][$i]['percentage'] = $user_info['pri_rel_ins_percentage'][$i];
        $main_array['beneficiaryinfo'][$i]['user_id'] = $ci->session->userdata['current_userid'];
        $main_array['beneficiaryinfo'][$i]['user_session_id'] = $ci->session->userdata['current_user_sessionid'];
    }
    $j = 0;
    for ($i = count($user_info['pri_ben_name']); $i < (count($user_info['pri_ben_name']) + count($user_info['con_ben_name'])); $i++) {
        $main_array['beneficiaryinfo'][$i]['beneficiary_name'] = $user_info['con_ben_name'][$j];
        $main_array['beneficiaryinfo'][$i]['type'] = '8002';
        $main_array['beneficiaryinfo'][$i]['relation'] = $user_info['con_rel_name'][$j];
        $main_array['beneficiaryinfo'][$i]['percentage'] = $user_info['con_rel_ins_percentage'][$j];
        $main_array['beneficiaryinfo'][$i]['user_id'] = $ci->session->userdata['current_userid'];
        $main_array['beneficiaryinfo'][$i]['user_session_id'] = $ci->session->userdata['current_user_sessionid'];
        $j++;
    }

    $main_array['ownerinfo'] = array();
    $main_array['ownerinfo']['owner_type'] = isset($user_info['policy_manager']) ? $user_info['policy_manager'] : "";
    $main_array['ownerinfo']['person_status'] = isset($user_info['policy_manager_person']) ? $user_info['policy_manager_person'] : "";
    $main_array['ownerinfo']['join_owner_status'] = isset($user_info['joint_owner']) ? $user_info['joint_owner'] : "";
    $main_array['ownerinfo']['trust_name'] = $user_info['trust_name'];
    $main_array['ownerinfo']['trust_address_line1'] = $user_info['trust_address_line1'];
    $main_array['ownerinfo']['trust_address_line2'] = $user_info['trust_address_line2'];
    $main_array['ownerinfo']['trust_address_city'] = $user_info['trust_city'];
    $main_array['ownerinfo']['trust_address_state'] = $user_info['trust_state'];
    $main_array['ownerinfo']['trust_address_zipcode'] = $user_info['trust_zipcode'];
    $main_array['ownerinfo']['person_name'] = $user_info['person_name'];
    $main_array['ownerinfo']['person_owner_relation'] = $user_info['person_relationship'];
    $main_array['ownerinfo']['person_owner_ssn'] = $user_info['person_taxid'];
    $main_array['ownerinfo']['person_address_line1'] = $user_info['person_address_line1'];
    $main_array['ownerinfo']['person_address_line2'] = $user_info['person_address_line2'];
    $main_array['ownerinfo']['personaddress_city'] = $user_info['person_city'];
    $main_array['ownerinfo']['personaddress_state'] = $user_info['person_state'];
    $main_array['ownerinfo']['personaddress_zipcode'] = $user_info['person_zipcode'];
    $person_dob = $user_info['person_birthyear'] . "-" . $user_info['person_birthmonth'] . "-" . $user_info['person_birthday'];
    $main_array['ownerinfo']['person_dob'] = date("Y-m-d", strtotime($person_dob));
    $main_array['ownerinfo']['user_id'] = $ci->session->userdata['current_userid'];
    $main_array['ownerinfo']['user_session_id'] = $ci->session->userdata['current_user_sessionid'];

    $main_array['insuranceinfo'] = array();

    for ($i = 0; $i < count($user_info['insured_name']); $i++) {
        $main_array['insuranceinfo'][$i]['insurance_flag'] = isset($user_info['insurance_applied']) ? $user_info['insurance_applied'] : "";
        $main_array['insuranceinfo'][$i]['insured_name'] = $user_info['insured_name'][$i];
        $main_array['insuranceinfo'][$i]['company'] = $user_info['insured_company'][$i];
        $main_array['insuranceinfo'][$i]['amount'] = $user_info['insured_amount'][$i];
        $main_array['insuranceinfo'][$i]['policy_number'] = $user_info['insured_policy_number'][$i];
        $main_array['insuranceinfo'][$i]['insurance_pending'] = isset($user_info['insured_policy_pending'][$i]) ? $user_info['insured_policy_pending'][$i] : "";
        $main_array['insuranceinfo'][$i]['policy_issued_year'] = $user_info['insured_year'][$i];
        $main_array['insuranceinfo'][$i]['policy_purpose'] = $user_info['retirement'][$i];
        $main_array['insuranceinfo'][$i]['user_id'] = $ci->session->userdata['current_userid'];
        $main_array['insuranceinfo'][$i]['user_session_id'] = $ci->session->userdata['current_user_sessionid'];
    }

    $main_array['replacementinfo'] = array();

    for ($i = 0; $i < count($user_info['company_name']); $i++) {
        $main_array['replacementinfo'][$i]['replacement_flag'] = isset($user_info['replacement']) ? $user_info['replacement'] : "";
        $main_array['replacementinfo'][$i]['replacement_company'] = $user_info['company_name'][$i];
        $main_array['replacementinfo'][$i]['replacement_policyno'] = $user_info['policy_name'][$i];
        //$main_array['replacementinfo'][$i]['document'] = $user_info['documents'][$i];
        //echo "<pre>"; print_r($_FILES);exit;
        if ($user_info['document_name'][$i] == "" && isset($user_info['documents'][$i]) && $user_info['documents'][$i] != "") {
            $main_array['replacementinfo'][$i]['document'] = $user_info['documents'][$i];
        } else if ($user_info['document_name'][$i] != "" && isset($user_info['documents'][$i]) && $user_info['documents'][$i] != "") {
            $main_array['replacementinfo'][$i]['document'] = $user_info['documents'][$i];
        } else {
            $main_array['replacementinfo'][$i]['document'] = $user_info['document_name'][$i];
        }
        $main_array['replacementinfo'][$i]['internal_revenue_code'] = isset($user_info['exchange']) ? $user_info['exchange'] : "";
        $main_array['replacementinfo'][$i]['user_id'] = $ci->session->userdata['current_userid'];
        $main_array['replacementinfo'][$i]['user_session_id'] = $ci->session->userdata['current_user_sessionid'];
    }
    //echo "<pre>"; print_r($main_array);exit;
    $main_array['medicalinfo'] = array();

    for ($i = 0; $i < count($user_info['diagnosis_name']); $i++) {
        $main_array['medicalinfo'][$i]['user_drug_dependency'] = isset($user_info['your_drug']) ? $user_info['your_drug'] : "";
        $main_array['medicalinfo'][$i]['user_diagnosis'] = $user_info['diagnosis_name'][$i];
        $date_array = explode("/", $user_info['diagnosis_date'][$i]);
        if (!empty($date_array) && isset($date_array[0]) && $date_array[1]) {
            $db = $date_array[1] . "-" . $date_array[0] . "-01";
            $date_dia = date("Y-m-d", strtotime($db));
        } else {
            $date_dia = "";
        }

        $main_array['medicalinfo'][$i]['date_of_diagnosed'] = $date_dia;
        $main_array['medicalinfo'][$i]['healthcare_provider'] = $user_info['provider'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_address_line1'] = $user_info['diagnosis_address_line1'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_address_line2'] = $user_info['diagnosis_address_line2'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_city'] = $user_info['diagnosis_city'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_state'] = $user_info['medical_state'][$i];
        $main_array['medicalinfo'][$i]['healthprovider_zipcode'] = $user_info['diagnosis_zip'][$i];
        //$main_array['replacementinfo'][$i]['internal_revenue_code'] = $user_info['exchange'];
        $main_array['medicalinfo'][$i]['user_id'] = $ci->session->userdata['current_userid'];
        $main_array['medicalinfo'][$i]['user_session_id'] = $ci->session->userdata['current_user_sessionid'];
    }
    $main_array['save_button'] = $user_info['save_button'];
    return $main_array;
}

/**
 * returns user information in strucured format
 * @param $user_info array
 * @return $return_array array  
 */
function prepareSessionData($user_info) {
    $main_array = array();
    if (count($user_info) > 0) {
        //User personal information
        $main_array['personalinfo'] = array();
        //$main_array['personalinfo']['user_name'] = $user_info['personalinfo']->full_name;
        $main_array['personalinfo']['first_name'] = $user_info['personalinfo']->first_name;
        $main_array['personalinfo']['middle_name'] = $user_info['personalinfo']->middle_name;
        $main_array['personalinfo']['last_name'] = $user_info['personalinfo']->last_name;
        $dob = explode(" ", $user_info['personalinfo']->user_date_of_birth);
        $user_dob = explode("-", $dob[0]);
        $main_array['personalinfo']['user_year'] = $user_dob[0];
        $main_array['personalinfo']['user_month'] = $user_dob[1];
        $main_array['personalinfo']['user_day'] = $user_dob[2];
        $main_array['personalinfo']['user_address_line1'] = $user_info['personalinfo']->user_address_line1;
        $main_array['personalinfo']['user_address_line2'] = $user_info['personalinfo']->user_address_line2;
        $main_array['personalinfo']['user_city'] = $user_info['personalinfo']->user_address_city;
        $main_array['personalinfo']['user_state'] = $user_info['personalinfo']->user_address_state;
        $main_array['personalinfo']['user_zipcode'] = $user_info['personalinfo']->user_address_zipcode;
        $main_array['personalinfo']['user_cell_no'] = $user_info['personalinfo']->user_phone_number;
        $main_array['personalinfo']['user_work_no'] = $user_info['personalinfo']->user_work_number;
        $main_array['personalinfo']['user_home_no'] = $user_info['personalinfo']->user_home_number;
        $main_array['personalinfo']['user_occupation'] = $user_info['personalinfo']->user_occupation;
        $main_array['personalinfo']['user_birth_place'] = $user_info['personalinfo']->user_birth_place;
        $main_array['personalinfo']['user_sex'] = $user_info['personalinfo']->gender;
        $main_array['personalinfo']['user_ssn'] = $user_info['personalinfo']->user_ssn;
        $main_array['personalinfo']['user_dln'] = $user_info['personalinfo']->user_dln;
        $main_array['personalinfo']['state_issued'] = $user_info['personalinfo']->user_dln_state;
        $main_array['personalinfo']['user_another_zipcode'] = $user_info['personalinfo']->user_another_zip;
        $main_array['personalinfo']['not_in_us'] = $user_info['personalinfo']->user_birth_country_or_state;

        //User beneficiary information
        $main_array['beneficiaryinfo'] = array();
        $j = 0;
        $k = 0;

        foreach ($user_info['beneficiaryinfo'] as $key => $value) {
            if ($value->type == 8001) {
                $main_array['beneficiaryinfo'][$value->type][$j]['pri_ben_name'] = $value->beneficiary_name;
                $main_array['beneficiaryinfo'][$value->type][$j]['pri_rel_name'] = $value->relation;
                $main_array['beneficiaryinfo'][$value->type][$j]['pri_rel_ins_percentage'] = $value->percentage;
                $j++;
            } else {
                $main_array['beneficiaryinfo'][$value->type][$k]['con_ben_name'] = $value->beneficiary_name;
                $main_array['beneficiaryinfo'][$value->type][$k]['con_rel_name'] = $value->relation;
                $main_array['beneficiaryinfo'][$value->type][$k]['con_rel_ins_percentage'] = $value->percentage;
                $k++;
            }
        }

        //User ownership information
        $main_array['ownerinfo'] = array();
        $main_array['ownerinfo']['policy_manager'] = $user_info['ownerinfo']->owner_type;
        $main_array['ownerinfo']['policy_manager_person'] = $user_info['ownerinfo']->person_status;
        $main_array['ownerinfo']['joint_owner'] = $user_info['ownerinfo']->join_owner_status;
        $main_array['ownerinfo']['trust_name'] = $user_info['ownerinfo']->trust_name;
        $main_array['ownerinfo']['trust_address_line1'] = $user_info['ownerinfo']->trust_address_line1;
        $main_array['ownerinfo']['trust_address_line2'] = $user_info['ownerinfo']->trust_address_line2;
        $main_array['ownerinfo']['trust_city'] = $user_info['ownerinfo']->trust_address_city;
        $main_array['ownerinfo']['trust_state'] = $user_info['ownerinfo']->trust_address_state;
        $main_array['ownerinfo']['trust_zipcode'] = $user_info['ownerinfo']->trust_address_zipcode;
        $main_array['ownerinfo']['person_name'] = $user_info['ownerinfo']->person_name;
        $main_array['ownerinfo']['person_relationship'] = $user_info['ownerinfo']->person_owner_relation;
        $main_array['ownerinfo']['person_taxid'] = $user_info['ownerinfo']->person_owner_ssn;
        $main_array['ownerinfo']['person_address_line1'] = $user_info['ownerinfo']->person_address_line1;
        $main_array['ownerinfo']['person_address_line2'] = $user_info['ownerinfo']->person_address_line2;
        $main_array['ownerinfo']['person_city'] = $user_info['ownerinfo']->personaddress_city;
        $main_array['ownerinfo']['person_state'] = $user_info['ownerinfo']->personaddress_state;
        $main_array['ownerinfo']['person_zipcode'] = $user_info['ownerinfo']->personaddress_zipcode;
        $pdob = explode("-", $user_info['ownerinfo']->person_dob);
        $main_array['ownerinfo']['person_birthyear'] = $pdob[0];
        $main_array['ownerinfo']['person_birthmonth'] = $pdob[1];
        $main_array['ownerinfo']['person_birthday'] = $pdob[2];

        //User insurance information
        $main_array['insuranceinfo'] = array();

        foreach ($user_info['insuranceinfo'] as $key => $value) {
            $main_array['insuranceinfo'][$key]['insurance_applied'] = $value->insurance_flag;
            $main_array['insuranceinfo'][$key]['insured_name'] = $value->insured_name;
            $main_array['insuranceinfo'][$key]['insured_company'] = $value->company;
            $main_array['insuranceinfo'][$key]['insured_amount'] = $value->amount;
            $main_array['insuranceinfo'][$key]['insured_policy_number'] = $value->policy_number;
            $main_array['insuranceinfo'][$key]['insured_policy_pending'] = $value->insurance_pending;
            $main_array['insuranceinfo'][$key]['insured_year'] = $value->policy_issued_year;
            $main_array['insuranceinfo'][$key]['retirement'] = $value->policy_purpose;
        }

        //User replacement information
        $main_array['replacementinfo'] = array();

        foreach ($user_info['replacementinfo'] as $key => $value) {
            $main_array['replacementinfo'][$key]['replacement'] = $value->replacement_flag;
            $main_array['replacementinfo'][$key]['company_name'] = $value->replacement_company;
            $main_array['replacementinfo'][$key]['policy_name'] = $value->replacement_policyno;
            $main_array['replacementinfo'][$key]['documents'] = $value->document;
            $main_array['replacementinfo'][$key]['exchange'] = $value->internal_revenue_code;
        }

        //User medical infoatmation
        $main_array['medicalinfo'] = array();
        foreach ($user_info['medicalinfo'] as $key => $value) {
            $main_array['medicalinfo'][$key]['your_drug'] = $value->user_drug_dependency;
            $main_array['medicalinfo'][$key]['diagnosis_name'] = $value->user_diagnosis;
            $main_array['medicalinfo'][$key]['diagnosis_date'] = date("m/Y", strtotime($value->date_of_diagnosed));
            $main_array['medicalinfo'][$key]['provider'] = $value->healthcare_provider;
            $main_array['medicalinfo'][$key]['diagnosis_address_line1'] = $value->healthprovider_address_line1;
            $main_array['medicalinfo'][$key]['diagnosis_address_line2'] = $value->healthprovider_address_line2;
            $main_array['medicalinfo'][$key]['diagnosis_city'] = $value->healthprovider_city;
            $main_array['medicalinfo'][$key]['medical_state'] = $value->healthprovider_state;
            $main_array['medicalinfo'][$key]['diagnosis_zip'] = $value->healthprovider_zipcode;
        }
    }
    //echo "<pre>"; print_r($main_array);exit;
    return $main_array;
}

function format_number($number, $type = "short") {
    // strip any commas 
    (int) $number = str_replace(',', '', $number);
    $sign_status = sign($number);
    // make sure it's a number...
    /* if (!is_numeric($number)) { 
      return FALSE;
      } */
    if ($sign_status < 0) {
        $number = $number * (-1);
    }
    $trillion = ($type == "short") ? "t" : "trillion";
    $billion = ($type == "short") ? "b" : "billion";
    $million = ($type == "short") ? "m" : "million";
    $thousand = ($type == "short") ? "k" : "thousand";

    // filter and format it 
    if ($number >= 1000000000000) {
        $number = number_format(($number / 1000000000000), 2);
        if ($sign_status < 0) {
            $number = $number * (-1);
        }
        return $number . $trillion;
    } else if ($number >= 1000000000) {
        $number = number_format(($number / 1000000000), 2);
        if ($sign_status < 0) {
            $number = $number * (-1);
        }
        return $number . $billion;
    } else if ($number >= 1000000) {
        $number = number_format(($number / 1000000), 1);
        if ($sign_status < 0) {
            $number = $number * (-1);
        }
        return $number . $million;
    } else if ($number >= 1000) {
        $number = number_format(($number / 1000), 2);
        if ($sign_status < 0) {
            $number = $number * (-1);
        }
        return number_format($number) . $thousand;
    }
    return $number;
}

function sign($n) {
    return ($n > 0) - ($n < 0);
}

/**
 * returns difference between two dates in days
 * @param date $start_date
 * @param date $end_date
 * @return int $days
 */
function getDiffBetweenDates($start_date, $end_date) {

    $diff = abs(strtotime($end_date) - strtotime($start_date));
    $days = floor(($diff) / (60 * 60 * 24));
    return $days;
}

/**
 * generate random alpha numeric string 
 * @param int $length
 * @return string $random_string
 */
function generate_random_string($length = 10) {

    $random_string = '';

    $alphabets = range('A', 'Z');
    $numbers = range('0', '9');
    //$additional_characters = array('_','.');
    $final_array = array_merge($alphabets, $numbers);


    while ($length--) {
        $key = array_rand($final_array);
        $random_string .= $final_array[$key];
    }

    return $random_string;
}

/**
 * returns converted value into units
 * @param float $input
 * @param string $unit
 * @return float $converted_value
 */
function convertUnits($input, $unit, $round = true) {

    $units_array = array('lbs' => '2.20462', 'kgs' => '0.453592');
    $converted_value = 0;
    $converted_value = $input * $units_array[$unit];
    if ($round) {
        $converted_value = round($converted_value);
    }
    return $converted_value;
}

/**
 * Sorts array by column
 * @param array $array pass by reference
 * @param string $column 
 * @param string $direction sort parameter
 */
function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
    $reference_array = array();

    foreach ($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }

    array_multisort($reference_array, $direction, $array);
}

/**
 * Function to get current date based on timezone
 * @param string offset of user timezone
 * @return date current time based on user timezone
 */
function getCurrentTimeBasedOnTimezone($timezone_offset = "") {
    $ci = &get_instance();

    $offset = "";

    if ($ci->session->userdata('app_user_data')) {
        if (!empty($ci->session->userdata('app_user_data')->user_timezone)) {
            $offset = $ci->session->userdata('app_user_data')->user_timezone;
        }
    }

    if ($offset == null || $offset == "") {
        $offset = "-08:00";
    }

    if ($timezone_offset != "") {
        $offset = $timezone_offset;
    }

    $explode = explode(":", $offset);
    $timestamp = ((int) $explode[0] * 60 * 60) + ((int) $explode[1] * 60);
    return date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) + $timestamp));
}

/**
 * Function to get current date based on timezone
 * @param string offset of user timezone
 * @return date current time based on user timezone
 */
function getInputTimeBasedOnTimezone($date = "", $timezone_offset = "", $format = 'datetime') {
    if (strtotime(date("Y-m-d")) == strtotime($date))
        $date = date("Y-m-d H:i:s");
    $ci = &get_instance();
    if ($timezone_offset != "") {
        $offset = $timezone_offset;
    } else {
        $offset = "";
        if ($ci->session->userdata('app_user_data')) {
            if (!empty($ci->session->userdata('app_user_data')->user_timezone)) {
                $offset = $ci->session->userdata('app_user_data')->user_timezone;
            }
        }
        if ($offset == null || $offset == "") {
            $offset = "-08:00";
        }
    }
    $explode = explode(":", $offset);
    if ($explode[0] < 0)
        $timestamp = ((int) $explode[0] * 60 * 60) - ((int) $explode[1] * 60);
    else
        $timestamp = ((int) $explode[0] * 60 * 60) + ((int) $explode[1] * 60);
    $converted_date = date(DATE_FORMAT, strtotime($date) + $timestamp);
    if ($format == "date")
        $converted_date = date("Y-m-d", strtotime($date) + $timestamp);
    return $converted_date;
}

/**
 * Function to get current date based on timezone
 * @param string offset of user timezone
 * @return date current time based on user timezone
 */
function getServerTimeBasedOnInputTimezone($date = "", $timezone_offset = "") {
    $ci = &get_instance();

    if ($timezone_offset != "") {
        $offset = $timezone_offset;
    } else {
        $offset = $ci->session->userdata('app_user_data')->user_timezone;
        if ($offset == null || $offset == "") {
            $offset = "-08:00";
        }
    }

    $explode = explode(":", $offset);

    if ($explode[0] < 0)
        $timestamp = -(((int) $explode[0] * 60 * 60) - ((int) $explode[1] * 60));
    else
        $timestamp = -(((int) $explode[0] * 60 * 60) + ((int) $explode[1] * 60));

    return date(DATE_FORMAT, (strtotime($date) + $timestamp));
}

/**
 * Function to get convert time to UTC based on timezone and date
 * @param $timezone_offset string offset of user timezone
 * @param $date string user current date time
 * @return $utc_date_time string converted UTC date time 
 */
function getConvertedUTCTime($date = "", $timezone_offset = "") {

    $ci = &get_instance();

    $offset = "-08:00";

    if ($timezone_offset != "") {
        $offset = $timezone_offset;
    }

    $explode = explode(":", $offset);

    if ($explode[0] < 0)
        $timestamp = (((int) $explode[0] * 60 * 60) - ((int) $explode[1] * 60));
    else
        $timestamp = (((int) $explode[0] * 60 * 60) + ((int) $explode[1] * 60));
    return date("Y-m-d H:i:s", (strtotime($date) - $timestamp));
}

/**
 * Function to setup text based on point amount
 * @param point amount
 * @return point or points
 */
function set_points_text($point_amount) {
    if ($point_amount <= 1) {
        return 'point';
    } else {
        return 'points';
    }
}

/**
 * Funtion to prepare a week array for quotes graph
 * @param array $data
 * @return array result
 */
function prepareWeeksArray($data) {
    $result_array = array();

    if (count($data) < 4) {
        $current_week = date('W');
        for ($i = 3, $j = 0; $i >= 0; $i--, $j++) {
            $week_array[$j] = $current_week - $i;
        }
        for ($i = 0; $i < count($week_array); $i++) {
            $week = 0;
            for ($j = 0; $j < count($data); $j++) {
                if ($week_array[$i] == $data[$j]['week']) {
                    $result_array[$i]['cnt'] = $data[$j]['cnt'];
                    $result_array[$i]['week'] = "week" . ($i + 1);
                    $week = 1;
                }
            }
            if ($week == 0) {
                $result_array[$i]['cnt'] = 0;
                $result_array[$i]['week'] = "week" . ($i + 1);
            }
        }
    } else {
        for ($j = 0; $j < count($data); $j++) {
            $result_array[$j]['cnt'] = $data[$j]['cnt'];
            $result_array[$j]['week'] = "week" . ($j + 1);
        }
    }
    return $result_array;
}

/**
 * Funtion to prepare a month array for quotes graph
 * @param array $data
 * @return array result
 */
function prepareMonthArray($data) {
    $result_array = array();

    $months_array = array(0 => "Jan", 1 => "Feb", 2 => "Mar", 3 => "Apr", 4 => "May", 5 => "Jun", 6 => "Jul", 7 => "Aug", 8 => "Sep", 9 => "Oct", 10 => "Nov", 11 => "Dec");
    for ($i = 0; $i < date('m'); $i++) {
        $month = 0;
        for ($j = 0; $j < count($data); $j++) {
            if ($months_array[$i] == $data[$j]['month']) {
                $result_array[$i]['cnt'] = $data[$j]['cnt'];
                $result_array[$i]['month'] = $data[$j]['month'];
                $month = 1;
            }
        }
        if ($month == 0) {
            $result_array[$i]['cnt'] = 0;
            $result_array[$i]['month'] = $months_array[$i];
        }
    }
    return $result_array;
}

/**
 * Funtion to prepare a month array for quotes graph
 * @param array $data
 * @return array result
 */
function prepareYearArray($data) {
    $result_array = array();

    if (count($data) < 4) {
        $current_year = date('Y');
        for ($i = 3, $j = 0; $i >= 0; $i--, $j++) {
            $year_array[$j] = $current_year - $i;
        }
        for ($i = 0; $i < count($year_array); $i++) {
            $year = 0;
            for ($j = 0; $j < count($data); $j++) {
                if ($year_array[$i] == $data[$j]['year']) {
                    $result_array[$i]['cnt'] = $data[$j]['cnt'];
                    $result_array[$i]['year'] = $data[$j]['year'];
                    $year = 1;
                }
            }
            if ($year == 0) {
                $result_array[$i]['cnt'] = 0;
                $result_array[$i]['year'] = $year_array[$i];
            }
        }
    } else {
        for ($j = 0; $j < count($data); $j++) {
            $result_array[$j]['cnt'] = $data[$j]['cnt'];
            $result_array[$j]['year'] = $data[$j]['year'];
        }
    }
    return $result_array;
}

/**
 * Remove and replace non printable characters in a string
 *
 * @param string $string input string
 * @param replacement $replacement replacement when non printable character found
 *
 * @return string $string output string without non printable characters 
 */
function removeNonPrintableCharacters($string, $replacement = "") {
    $string = preg_replace('/[\x00-\x1F\x80-\xFF]/', $replacement, $string);
    return $string;
}

/**
 * 
 *
 * @param string 
 *
 * @return unique string 
 */
function getUniqueId($email) {
    //echo 'hi';exit;
    //echo $email;exit;

    $time = strtotime(date("d.m.Y h:i:s"));
    $string = md5($email) . $time;

    return $string;
}

/**
 * 
 *
 * @param string 
 *
 * @return unique string 
 */
function getHeightinInches($height) {
    $height_array = explode("'", $height);
    $height_array[1] = (int) rtrim($height_array[1], '"');
    //echo $height_array[1];exit;

    $height_in_inches = ($height_array[0] * 12) + $height_array[1];
    //echo '<pre>';print_r($height_in_inches);exit;


    return $height_in_inches;
}

function sec2hms($sec, $padHours = false) {

    // do the hours first: there are 3600 seconds in an hour, so if we divide
    // the total number of seconds by 3600 and throw away the remainder, we're
    // left with the number of hours in those seconds
    $hours = intval(intval($sec) / 3600);

    // start our return string with the hours (with a leading 0 if asked for)
    if ($padHours) {
        $hms = str_pad($hours, 2, "0", STR_PAD_LEFT) . ":";
    } else {
        $hms = $hours;
    }

    // dividing the total seconds by 60 will give us the number of minutes
    // in total, but we're interested in *minutes past the hour* and to get
    // this, we have to divide by 60 again and then use the remainder
    //$minutes = intval(($sec / 60) % 60);
    // add minutes to $hms (with a leading 0 if needed)
    //$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":";
    // seconds past the minute are found by dividing the total number of seconds
    // by 60 and using the remainder
    //$seconds = intval($sec % 60);
    // add seconds to $hms (with a leading 0 if needed)
    //$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
    // done!
    return $hms;
}

/**
 * Returns Password hash of a string
 *
 * @param string $string 
 *
 * @return unique string $hash hashed value of string 
 */
function getPasswordHash($string) {
    $hash = password_hash($string, PASSWORD_DEFAULT);
    return $hash;
}

/**
 * Method to verify password 
 *
 * @param string $password_string
 * @param string $hash_value 
 *
 * @return boolean $value holds true or false based on password verification 
 */
function verifyPassword($password_string, $hash_value) {
    $value = false;


    if (password_verify($password_string, $hash_value)) {
        //echo 'hi';exit;
        $value = true;
    } else {
        //echo 'hi1';exit;
        $value = false;
    }

    return $value;
}

/**
 * Method : GET
 * Facebook connect notification
 * @return result array
 */
function getChallengeNotification($user_data, $challenge_details, $notification_trigger_id) {
    //echo '<pre>';print_r($user_data);exit;

    $ci = &get_instance();
    //echo 'hi';
    //echo '<pre>';print_r($challenge_details);exit;

    if (isset($user_data->user_session_id) && $user_data->user_session_id != '') {
        $user_session_id = $user_data->user_session_id;
        //echo $user_session_id;
    } else {
        $user_access_token = $user_data->access_token;

        $user_session_id = $ci->user->getUserSessionFromAccessToken($user_access_token);
    }
    //echo $user_session_id;exit;

    $where_array2 = array(
        'user_id' => $user_data->user_id,
        'row_status' => 1
    );
    $regIds = $ci->user->getUserDeviceToken($push_notification, $where_array2);
    //echo $this->db->last_query();
    //echo '<pre>';print_r($challenge_details);exit;
    foreach ($regIds as $key => $res) {
        if ($res['os'] == 'iOS') {
            $iosdeviceTokens[] = $res["device_token"];
        }
        if ($res['os'] == 'Android') {
            $android_device_tokens[] = $res['device_token'];
        }
    }
    $notificationFactory = new NotificationFactory();
    $android = $notificationFactory->getMobile("Android");
    $ios = $notificationFactory->getMobile("ios");
    $gcmRegIds = $iosdeviceTokens;
    $androidRegIds = $android_device_tokens;


    date_default_timezone_set(TIME_ZONE);
    $current_date = date("Y-m-d h:i:s");






    //echo 'hi';exit;
    $notifications = getNotificationTriggers();

    //echo '<pre>';print_r($notifications);exit;
    $trigger_messages = array();
    foreach ($notifications as $key => $value) {
        $trigger_messages[$value['id']] = $value;
    }
    $registration_notifications = $trigger_messages[$notification_trigger_id];
    $message_rand_key = array_rand($registration_notifications['messages'], 1);
    $message_array = $registration_notifications['messages'][$message_rand_key];
    //echo '<pre>';print_r($message_array);exit;


    $notification_message = str_replace("<" . $message_array['replace_keyword'] . ">", $challenge_details['challenge_name'], $message_array['message']);
    //echo $notification_message;exit;

    if ($notification_trigger_id == 38) {
        //echo 'hi';exit;
        $complete_msg = array(
            'message' => $notification_message,
            'content-available' => "true",
            'challenge_id' => $challenge_details['challenge_id'],
            'page_number' => 2
        );
        $message = array("message" => $notification_message, "challenge_id" => $challenge_details['challenge_id'], "page_number" => 2);
        $schedule_result = $ci->user_steps->updateUserChallengeSchedule($challenge_details['ucid']);
        //echo $schedule_result;exit;
    } else if ($notification_trigger_id == 39) {

        if ($challenge_details['challenge_percentage'] >= 100) {
            $challenge_percentage = 100;
            $insert_point_data = array(
                "carrier_id" => $user_data->carrier_id,
                "user_id" => $user_data->user_id,
                "activity" => 15004,
                "points" => $challenge_details['points'],
                "points_date" => date('Y-m-d H:i:s'),
                "user_session_id" => $user_session_id,
                "created_time" => date('Y-m-d H:i:s'),
            );
            //echo '<pre'
            $res = $ci->user->saveChallengePoints($insert_point_data);
        } else {
            $challenge_percentage = $challenge_details['challenge_percentage'];
        }

        $complete_msg = array(
            'message' => $notification_message,
            'content-available' => "true",
            'challenge_id' => $challenge_details['challenge_id'],
            'page_number' => 2,
            'points' => $challenge_details['points'],
            'status' => $challenge_details['status'],
            'challenge_percentage' => $challenge_percentage,
            'challenge_name' => $challenge_details['challenge_name'],
            'challenge_start_day' => $challenge_details['challenge_start_day']
        );
        $message = array("message" => $notification_message, "challenge_id" => $challenge_details['challenge_id'], "points" => $challenge_details['points'], "status" => $challenge_details['status'], 'page_number' => 2, 'challenge_percentage' => $challenge_percentage, 'challenge_name' => $challenge_details['challenge_name'], 'challenge_start_day' => $challenge_details['challenge_start_day']);
    }

    $android_notified = $android->sendPushNotification($androidRegIds, $complete_msg);

    $notified = $ios->sendPushNotification($gcmRegIds, $message);
    //echo $android_notified;
    //echo $notified;exit;


    $insert_notifications[] = array(
        'notification_trigger_id' => $message_array['notification_trigger_id'],
        'notification_message_id' => $message_array['id'],
        'user_id' => $user_data->user_id,
        'notification_date' => date("Y-m-d"),
        'sent_status' => 1,
        'notification_type' => 0,
        'message' => $notification_message,
        'user_session_id' => $user_session_id,
        'created_time' => date("Y-m-d"),
        'carrier_id' => $user_data->carrier_id
    );
    $insert_challenge_notifications[] = array(
        'notification_trigger_id' => $message_array['notification_trigger_id'],
        'notification_message_id' => $message_array['id'],
        'challenge_id' => $challenge_details['challenge_id'],
        'user_id' => $user_data->user_id,
        'sent_status' => 0,
        'notification_date' => date("Y-m-d"),
        'message' => $notification_message,
        'user_session_id' => $user_session_id,
        'created_time' => date("Y-m-d"),
        'carrier_id' => $user_data->carrier_id
    );


    $insert_status = $ci->notification->insertUserNotifications($insert_notifications);
    $insert_challenge_status = $ci->notification->insertChallengeNotifications($insert_challenge_notifications);

    //echo '<pre>';print($schedule_result);exit;
    //echo $this->db->last_query();exit;

    $response_data = array('message' => $notification_message);
    //echo '<pre>';print_r($response_data);exit;
}

/**
 * Convert seconds to hours
 * @param int seconds
 * @return int hours
 */
function convertSecondsToHours($seconds_value) {
    if ($seconds_value != 0 && $seconds_value != "") {
        return number_format($seconds_value / 3600, 1);
    } else {
        return '0';
    }
}

/**
 * Convert numbers to numberformat
 * @param int number
 * @return int 1k etc.,
 */
function restyle_numbers($input) {
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if ($input_count != '0') {
        if ($input_count == '1') {
            return substr($input, 0, -4) . 'K';
        } else if ($input_count == '2') {
            return substr($input, 0, -8) . 'M';
        } else if ($input_count == '3') {
            return substr($input, 0, -12) . 'B';
        } else if ($input_count == '4') {
            return substr($input, 0, -16) . 'T';
        } else {
            return;
        }
    } else {
        return $input;
    }
}

/**
 * Function to convert Feets inches to meters
 *
 * @param string $input
 * @return float $output
 */
function convertFeetsToMeters($input) {
    $output = "";
    if ($input != "") {
        $input = explode("'", $input);
        if (count($input) == 2) {
            $input[1] = preg_replace("/[^0-9]/", "", $input[1]);
            //echo "<pre>";print_r($input);exit;
            $inches = $input[0] * 12 + $input[1];
            //echo $inches;exit;
            $meters = ($inches * 0.0254);
            $output = $meters;
            //echo $output;exit;
        }
    }
    return $output;
}

/**
 * Convert meters to miles
 * @param float value
 * @return float result
 */
function convertMetresToMiles($value) {
    return $value / 1609;
}

/**
 * insert or update array
 * @param int flag
 * @return insert or update array
 */
function insert_update_array($flag = '') {
    $ci = &get_instance();
    $session_data = $ci->session->userdata['carrier_session'];

//echo '<pre>';print_r($session_data);exit;

    if ($flag == 0) {
        $insert_or_update_array = array(
            'user_session_id' => $session_data['user_session_id'],
            'created_time' => date('Y-m-d h:i:s')
        );
    } else {
        $insert_or_update_array = array(
            'user_session_id' => $session_data['user_session_id']
        );
    }

    return $insert_or_update_array;
}

/**
 * FUnction to send an email to reset link
 * @param type $random_pwd
 * @param type $user_email
 * @return string
 */
function sendForgotPasswordLink($random_pwd, $user_details, $expiry_time, $user_type) {
    $ci = &get_instance();
    $ci->data['random_pwd'] = $random_pwd;
    $ci->data['expiry_time'] = $expiry_time;
    $ci->data['user_type'] = $user_type;
    $ci->load->helper('triggers_helper');
    $ci->load->model('notification');

    if ($ci->data['user_type'] != '2004') {
        $content = $ci->load->view('users/forgotpassword_email', $ci->data, true);
        $result = sendEmailUsingAWS(
                $user_details['email'], FROM_EMAIL, PASSWORD_RESET_EMAIL_SUBJECT, $content, APP_NAME
        );
    } else {
        $where_array = array(
            "row_status" => 1,
            "notification_trigger_id" => 151
        );
        $notificationMessages = array_shift($ci->notification->getNotificationMessages($where_array));
        if (count($notificationMessages) == 0) {
            return "failed";
        }
        $content = replacePredefinedTags($user_details, $notificationMessages['body']);
        $subject = $notificationMessages['subject'];
        $result = sendEmailUsingAWS(
                $user_details['email'], FROM_EMAIL, $subject, $content, APP_NAME, array(), "C"
        );
    }
    if ($result) {
        return "success";
    } else {
        return "failed";
    }
}

/**
 * Generate error response
 * @param string $status
 * @param string $message message
 * @return array $return_array
 */
function generateErrorResponse($status, $message) {

    $instance = &get_instance();

    $instance->response(array(
        'errors' => array(
            array(
                'status' => $status,
                'detail' => $message
            )
        )
    ));
    exit;
}

/**
 * Function to get current date based on timezone
 * @param string offset of user timezone
 * @return date current time based on user timezone
 */
function getConvertedDateTimeBasedOnTimezone($date = "", $timezone_offset = "") {
    $ci = &get_instance();


    if ($timezone_offset != "") {
        $offset = $timezone_offset;
    } else {
        $offset = $ci->session->userdata('app_user_data')->user_timezone;
        if ($offset == null || $offset == "") {
            $offset = "-08:00";
        }
    }
    $explode = explode(":", $offset);
    if ($explode[0] < 0)
        $timestamp = ((int) $explode[0] * 60 * 60) - ((int) $explode[1] * 60);
    else
        $timestamp = ((int) $explode[0] * 60 * 60) + ((int) $explode[1] * 60);

    return date(DATE_FORMAT, strtotime($date) - $timestamp);
}

/**
 * Function to get current date based on timezone
 * @param string offset of user timezone
 * @return date current time based on user timezone
 */
function getUtfData($result) {
    array_walk_recursive($result, function (&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = Encoding::toUTF8($item);
            //$item = utf8_encode($item);
        }
    });

    return $result;
}

/**
 * Function to prepare user completions array
 * 
 * @param array $user_challenges
 * @param array $user_completions
 * 
 * @return array $return_array
 */
function prepareUserCompletionsArray($challenges_goals, $user_challenges, $user_completions) {
    $return_array = array();
    foreach ($challenges_goals as $ch_key => $ch_value):
        $challenge_type = "current_challenges";
        if (date("Y-m-d", strtotime($ch_value['info']['end_time'])) < date("Y-m-d")) {
            $challenge_type = "past_challenges";
        } else if (date("Y-m-d", strtotime($ch_value['info']['start_time'])) > date("Y-m-d")) {
            $challenge_type = "future_challenges";
        }
        $join_status = searchMultiArray($user_challenges, 'challenge_id', $ch_value['info']['id']);
        if (!empty($join_status) && $join_status['challenge_type'] == 51002 && date("Y-m-d", strtotime($join_status['goal_start_time'])) > date("Y-m-d")) {
            $challenge_type = "future_challenges";
        }
        $temp = array();
        $return_array[$challenge_type][$ch_value['info']['id']]['data']['challenge_id'] = $ch_value['info']['id'];
        $return_array[$challenge_type][$ch_value['info']['id']]['data']['name'] = $ch_value['info']['name'];
        $return_array[$challenge_type][$ch_value['info']['id']]['data']['challenge_type'] = $ch_value['info']['challenge_type'];
        $return_array[$challenge_type][$ch_value['info']['id']]['data']['start_time'] = $ch_value['info']['start_time'];
        $return_array[$challenge_type][$ch_value['info']['id']]['data']['end_time'] = $ch_value['info']['end_time'];
        if (!empty($join_status) && $challenge_type == "future_challenges") {
            $return_array[$challenge_type][$ch_value['info']['id']]['data']['status'] = $join_status['status'];
        }

        $return_array[$challenge_type][$ch_value['info']['id']]['data']['join_status'] = (!empty($join_status) ? 1 : 0);
        foreach ($ch_value['goal_per_week'] as $goal_key => $goal_value):
            $temp[$goal_key]['week'] = $goal_value['week'];
            $temp[$goal_key]['goal_start_time'] = $goal_value['start_time'];
            $temp[$goal_key]['goal_end_time'] = $goal_value['end_time'];
            if ($ch_value['info']['challenge_type'] == "personal_record") {
                $temp[$goal_key]['goal_start_time'] = $join_status['goal_start_time'];
                $temp[$goal_key]['goal_end_time'] = $join_status['goal_end_time'];
            }
            $temp[$goal_key]['status'] = "";
            $temp[$goal_key]['score'] = "";
            foreach ($user_completions as $comp_key => $comp_value):
                if ($comp_value['challenge_id'] == $ch_value['info']['id'] && $comp_value['week'] == $goal_value['week']) {
                    $temp[$goal_key]['week'] = $comp_value['week'];
                    $temp[$goal_key]['status'] = $comp_value['status'];
                    $temp[$goal_key]['score'] = number_format($comp_value['user_activity']) . "/" . number_format($comp_value['target']);
                }
            endforeach;
        endforeach;
        $return_array[$challenge_type][$ch_value['info']['id']]['weeks_data'] = $temp;
    endforeach;
    return $return_array;
}

/**
 * returns most recent date in array of dates
 * @param $dates array
 * @return $most_recent_date string 
 */
function getMaxDateFromArray($dates) {
    $mostRecent = 0;
    foreach ($dates as $date) {
        $curDate = strtotime($date);
        if ($curDate > $mostRecent) {
            $mostRecent = $curDate;
        }
    }

    $most_recent_date = "";
    if ($mostRecent > 0) {
        $most_recent_date = date("Y-m-d H:i:s", $mostRecent);
    }
    return $most_recent_date;
}

/**
 * Function to eleminate smart quotes
 * 
 * @param string $string
 * 
 * @return string $string
 */
function convert_smart_quotes($string) {
    $search = [// www.fileformat.info/info/unicode/<NUM>/ <NUM> = 2018
        "\xC2\xAB", // « (U+00AB) in UTF-8
        "\xC2\xBB", // » (U+00BB) in UTF-8
        "\xE2\x80\x98", // ‘ (U+2018) in UTF-8
        "\xE2\x80\x99", // ’ (U+2019) in UTF-8
        "\xE2\x80\x9A", // ‚ (U+201A) in UTF-8
        "\xE2\x80\x9B", // ‛ (U+201B) in UTF-8
        "\xE2\x80\x9C", // “ (U+201C) in UTF-8
        "\xE2\x80\x9D", // ” (U+201D) in UTF-8
        "\xE2\x80\x9E", // „ (U+201E) in UTF-8
        "\xE2\x80\x9F", // ‟ (U+201F) in UTF-8
        "\xE2\x80\xB9", // ‹ (U+2039) in UTF-8
        "\xE2\x80\xBA", // › (U+203A) in UTF-8
        "\xE2\x80\x93", // – (U+2013) in UTF-8
        "\xE2\x80\x94", // — (U+2014) in UTF-8
        "\xE2\x84\xA2",
        "\xC2\xA9",
        "\xC2\xAE",
        "\xE2\x80\xA6"  // … (U+2026) in UTF-8
    ];

    $replacements = [
        "<<",
        ">>",
        "'",
        "'",
        "'",
        "'",
        '"',
        '"',
        '"',
        '"',
        "<",
        ">",
        "-",
        "-",
        "™",
        "©",
        "®",
        "..."
    ];

    return str_replace($search, $replacements, $string);
}

/**
 * This method returns week number of year from date
 * 
 * @param datetime $datetime 
 * @return $week_number 
 */
function getWeekNumberFromDateTime($datetime) {
    $week_number = "";

    if ($datetime != "") {
        $datetime_array = explode(" ", $datetime);
        $date = explode("-", $datetime_array[0]);
        $time = explode(":", $datetime_array[1]);
        $date_mk_time = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
        $week_number = (int) date('W', $date_mk_time);
    }

    return $week_number;
}

/**
 * This method returns all valid date formats
 *  
 * @return $date_formats returns date formats
 */
function getValidDateTimeFormats() {
    $date_formats = array('Y-m-d H:i:s', 'Y-m-d G:i:s', 'Y-m-d g:i:s A', 'Y-m-d h:i:s A', 'Y-m-d g:i:s a', 'Y-m-d h:i:s a');
    return $date_formats;
}

/**
 * Function to prepare activity feed data by event date
 * 
 * @param array $activity_feed
 * 
 * @return array $result_array
 */
function prepare_activity_feed_by_event_date($activity_feed, $type = 0, $activity_colors) {
    $result_array = array();
    if (count($activity_feed) > 0) {
        $i = 0;
        foreach ($activity_feed as $key => $value):
            $headers_data = unserialize($value['headers_json_data']);
            $json_data = (array) json_decode($value['json_data']);
            $date_key = date("l, F j, Y", strtotime($value['event_date']));
            $result_array[$date_key][$i]['user_active_session_id'] = $value['user_active_session_id'];
            $result_array[$date_key][$i]['event_name'] = ucwords(str_replace("_", " ", $value['event_name']));
            $result_array[$date_key][$i]['event_date'] = date("l, F j, Y", strtotime($value['event_date']));
            $result_array[$date_key][$i]['time_of_event'] = date("h:i A", strtotime($value['time_of_event']));
            $result_array[$date_key][$i]['event_color'] = $activity_colors[$value['event_name']];
            $result_array[$date_key][$i]['info']['OS version'] = (isset($json_data['os_version']) && $json_data['os_version'] != "") ? $json_data['os_version'] : "Not found";
            $result_array[$date_key][$i]['info']['App version'] = (isset($json_data['app_version']) && $json_data['app_version'] != "") ? $json_data['app_version'] : "Not found";
            $result_array[$date_key][$i]['info']['IP address'] = (isset($json_data['ip_address']) && $json_data['ip_address'] != "") ? $json_data['ip_address'] : "Not found";
            $result_array[$date_key][$i]['info']['Device brand'] = (isset($headers_data['device_brand']) && $headers_data['device_brand'] != "") ? $headers_data['device_brand'] : "Not found";
            $result_array[$date_key][$i]['info']['Device model'] = (isset($headers_data['device_modal']) && $headers_data['device_modal'] != "") ? $headers_data['device_modal'] : "Not found";
            $result_array[$date_key][$i]['info']['Carrier'] = (isset($headers_data['carrier']) && $headers_data['carrier'] != "") ? $headers_data['carrier'] : "Not found";
            $result_array[$date_key][$i]['info']['Manufacturer'] = (isset($headers_data['manufacturer']) && $headers_data['manufacturer'] != "") ? $headers_data['manufacturer'] : "Not found";
            $result_array[$date_key][$i]['info']['Screen height'] = (isset($headers_data['screen_height']) && $headers_data['screen_height'] != "") ? $headers_data['screen_height'] : "Not found";
            $result_array[$date_key][$i]['info']['Screen width'] = (isset($headers_data['screen_width']) && $headers_data['screen_width'] != "") ? $headers_data['screen_width'] : "Not found";
            $result_array[$date_key] = array_values($result_array[$date_key]);
            $i++;
        endforeach;
    }
    return $result_array;
}

function replaceKeywords($replace_keywords, $string) {
    $string = str_replace(array_keys($replace_keywords), $replace_keywords, $string);
    return $string;
}

/**
 * Function to list all the months between two dates
 * 
 * @param type $start_date
 * @param type $end_date
 * 
 * @retutn array $result_array
 */
function prepareAllMonthsBetweenTwoDates($start_date, $end_date) {
    $result_array = array();
    $start = (new DateTime($start_date . "-01"))->modify('first day of this month');
    $end = (new DateTime($end_date . "-01"))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);

    foreach ($period as $key => $dt) {
        $result_array[$key]['month_year'] = $dt->format('M-y');
    }
    return $result_array;
}

/**
 * Function to prepare data month wise
 * 
 * @param array $month_year_data
 * @param array $data
 * 
 * @return array $return_array
 */
function prepareDataByMonth($month_year_data, $data) {
    $return_array = array();
    foreach ($month_year_data as $key => $value):
        $return_value = searchMultiArray($data, 'month_year', $value['month_year']);
        if ($return_value != false && count($return_value) > 0) {
            $return_array['keys'][$key] = $value['month_year'];
            $return_array['values'][$key] = (int) $return_value['count_of_users'];
        } else {
            $return_array['keys'][$key] = $value['month_year'];
            $return_array['values'][$key] = 0;
        }
    endforeach;
    return $return_array;
}

/**
 * Function to prepare screen views data array
 * 
 * @param array $data
 * 
 * @return array $return_array
 */
function prepare_screen_views_data_array($data, $flag) {
    $return_array = array(
        "keys" => array(),
        "values" => array(),
        "event_names" => $data
    );
    if (count($data) > 0) {
        foreach ($data as $data_key => $data_value):
            $screen_name = ucwords(str_replace("_", " ", $data_value['event_name']));
            $return_array['keys'][] = $screen_name;
            $return_array['values'][] = (int) $data_value['event_count'];
            if ($flag == 1 && $data_key == 9) {
                break;
            }
        endforeach;
    }
    return $return_array;
}

/**
 * Function to prepare screen views data array
 * 
 * @param array $data
 * 
 * @return array $return_array
 */
function prepare_page_views_data_array($data, $flag) {
    $return_array = array(
        "keys" => array(),
        "values" => array(),
        "event_names" => $data
    );
    if (count($data) > 0) {
        foreach ($data as $data_key => $data_value):
            $screen_name = ucwords(str_replace("_", " ", $data_value['article_name']));
            $return_array['keys'][] = $screen_name;
            //$return_array['values'][] = (int) $data_value['article_count'];
            $return_array['values'][$data_key]['y'] = (int) $data_value['article_count'];
            $return_array['values'][$data_key]['article_id'] = (int) $data_value['article_id'];
            if ($flag == 1 && $data_key == 9) {
                break;
            }
        endforeach;
    }
    return $return_array;
}

/**
 * @param : $status, $message
 * @return
 * Generates error message for a API call
 */
function generateAPIErrorMessage($status, $message) {
    $instance = &get_instance();
    $instance->response(array(
        'errors' => array(
            array(
                'status' => $status,
                'detail' => $message
            )
        )
    ));
}

/**
 * Function to prepare CMS data array
 * 
 * @param array $data
 * 
 * @return array $return_array
 */
function prepare_cms_html_data($data, $headers) {
    $css_link = '';
    if (!isset($headers["is_web"])) {
        $css_link="https://".getenv('AWS_MOBILE_BUCKET').".s3.amazonaws.com/assets/fonts/fonts.min.css"; 
        if (trim(strtolower(getenv('CLIENT'))) == "principal") {
            $css_link = "https://www.principalcdn.com/css/horizon/v2/horizon.min.css";
        }
        $result = "<!DOCTYPE html><html><head><meta charset='UTF-8'><title></title><link href='" . $css_link . "' rel='stylesheet' media='all'></head><body style='background-color:transparent;padding-top:15px;text-align: justify;'><div class='container'>" . $data . "</div></body></html>";
    } else {
        $result = $data;
    }
    return $result;
}

//convert ms word single and double quotes to normal quotes
function convert_data_table_smart_quotes($string) {
    $search = array(chr(145),
        chr(146),
        chr(147),
        chr(148),
        chr(151));

    $replace = array("'",
        "'",
        '"',
        '"',
        '-');

    return str_replace($search, $replace, $string);
}

/**
 * Function to prepare the array for signature status
 * 
 * @param array $signature_status_array
 * 
 * @return array $result_array
 */
function prepare_signature_status_array($signature_status_array = array()) {
    $result_array = array();
    if (count($signature_status_array) > 0) {
        foreach ($signature_status_array as $sign_key => $sign_val):
            $result_array[$sign_val['sequence_type']][$sign_val['signature_type']] = $sign_val['signature_status'];
        endforeach;
    }
    return $result_array;
}

function prepare_vantis_signature_status_array($signature_status_array = array()) {
    $result_array = array();
    if (count($signature_status_array) > 0) {
        $i = 0;
        foreach ($signature_status_array as $sign_key => $sign_val):
            $result_array[$sign_val['sequence_type']][$i]['user_type'] = $sign_val['signature_type'];
            $result_array[$sign_val['sequence_type']][$i]['signature_status'] = $sign_val['signature_status'];
            $result_array[$sign_val['sequence_type']][$i]['signature_user_type'] = $sign_val['signature_user_type'];
            $i++;
        endforeach;
    }
    return $result_array;
}


function formatPhoneNumber($phoneNumber) {
   // echo $phoneNumber;exit;
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 10) {
        //echo 22;exit;
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree . '-' . $lastFour;
    }


    return $phoneNumber;
}

function unformatPhoneNumber($phoneNumber) {
   if($phoneNumber != '' && strlen($phoneNumber) > 9){
      $phoneNumber =  str_replace(array("(", ")", "-", "_", " ", "+"), "", $phoneNumber);
      $phoneNumber = substr($phoneNumber, -10);
   }
   return $phoneNumber;
}

function hoursToSeconds($time) {
    //echo $time;exit;
    $str_time = $time;
    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
    $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
    return $time_seconds;
}

function buildTree(array $elements, $parentId = 0) {
    $branch = array();
    foreach ($elements as $element) {
        if ($element['subpillar_id'] == $parentId) {
            $children = buildTree($elements, $element['permission_id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[$element["pillar_name"]][] = $element;
        }
    }
    return $branch;
}

function buildTreeHTML($tree) {
    $html = "<ul>";
    foreach ($tree as $key => $res):
        $html .= '<li>' . $key;
        $nestedHtml = buildTreeNestedHTML($res, $key);
        $html .= $nestedHtml;
        $html .= "</li>";
    endforeach;
    $html .= "</ul>";
    return $html;
}

function aes_encrypt($input) {
    return encryption($input, 'e');
}

function aes_decrypt($input) {
    return encryption($input, 'd');
}

function encryption($input, $action) {
    $key = ENCRYPT_SALT;
    // $iv = '11979ce01cb1dac2667bfe1c7a540f36';

    $output = false;
    $encrypt_method = "AES-256-ECB";

    if ($action == 'e') {
        $output = openssl_encrypt($input, $encrypt_method, $key, 1);
    } else if ($action == 'd') {
        $output = openssl_decrypt($input, $encrypt_method, $key, 1);
    }

    return $output;
}

function buildTreeNestedHTML($res, $key) {
    $html = '<ul>';
    foreach ($res as $val):
        $jsTree = ($val['checked'] == 1)? 'data-jstree={"opened":true,"selected":true}':'';
        $html .= '<li id="'.$val["permission_id"].'" '.$jsTree.'>' . $val["permission_name"];
        if (isset($val["children"])) {
            $html .= buildTreeNestedHTML($val["children"][$key], $key);
        }
        $html .= "</li>";
    endforeach;
    $html .= '</ul>';
    return $html;
}

function upsertMonitaringCrons($cronId, $lastUpdated) {
    $ci = &get_instance();
    $ci->load->model('settings_master');
    $ci->settings_master->upsertMonitaringCrons($cronId, $lastUpdated);
}

function fetchTagIdByUserInfo($user_info){
    $tag_id = 0;
    if(count($user_info) > 0){
        $user_info = (array) $user_info;
        if(($user_info['invitation_type'] == 1 || $user_info['invitation_type'] == 2) && $user_info['group_type'] != 180002){
            $tag_id = 1;
        }else if(($user_info['invitation_type'] == 3 || $user_info['invitation_type'] == 4) && $user_info['group_type'] != 180002){
            $tag_id = 3;
        }elseif($user_info['invitation_type'] == 5 && $user_info['group_type'] != 180002){
            $tag_id = 5;
        }else if($user_info['invitation_type'] == 6 && $user_info['group_type'] != 180002){
            $tag_id = 6;
        }if($user_info['group_type'] == 180002){
            $tag_id = 7;
        }
    }
    return $tag_id;
}

function connectRedis($db='1')
{
    $db = getenv('REDIS_DB');
    $redisClient = new Redis();
    $redisClient -> connect(getenv('REDIS_HOST'), 6379);
    $redisClient -> auth(getenv('REDIS_PASSWORD'));
    $redisClient ->select(getenv('REDIS_DB'));
    return $redisClient;
}



/**
 * Function to get agent role id
 * @return int $agent_role_id
 */
function getAgentRoleID($instance) {
    
    $agent_role_id =19;
    if (defined('AGENT_ROLE_ID') && AGENT_ROLE_ID != ''){
        $agent_role_id = AGENT_ROLE_ID;
    }

    $all_roles = $instance->roles->getRolesList();
    //echo '<pre>';print_r($all_roles);exit;
    if (count($all_roles) > 0) {
        foreach ($all_roles as $role_key => $role_value):
            if (strtolower(trim($role_value)) == "lifetime - agent" || strtolower(trim($role_value)) == "agent")  {
                $agent_role_id = $role_key;
                break;
            }
        endforeach;
    }

    //echo $agent_role_id;exit;
    return $agent_role_id;
}

/**
 * Function to get agency information
 * @param array $agency_name
 * @return array $agency_info
 */
function getAgencyInformation($agency_name, $instance) {
    $where_array = array("trim(name)" => $agency_name, "row_status" => 1);
    $agency_info = $instance->agency->get_all_agencies($where_array);
    if (count($agency_info) > 0)
        $agency_info = array_shift($agency_info);
    return $agency_info;
}

/**
 * Function to get state information based on abbrevation
 * @param string $abbrevation
 * @param array $instance Instance object
 */
function getStateInformation($abbrevation, $instance) {
    $where_cond = array(
        "trim(abbrevation)" => trim($abbrevation)
    );
    $state_info = $instance->user->getStatesList($where_cond);
    $state_info = array_shift($state_info);
    return $state_info;
}

/**
 * Function to save agent information
 * @param object $consumer_object
 * @param object $instance
 * @return int
 */
function saveAgencyInformation($consumer_object, $instance) {
    $consumer_object->State = is_array($consumer_object->State) ? (isset($consumer_object->State[0]) ? $consumer_object->State[0] : "CA") : $consumer_object->State;
    $state_abv = strlen($consumer_object->State) > 2 ? $consumer_object->Zip : $consumer_object->State;
    $state_info = getStateInformation($state_abv, $instance);
    $insert_data = array(
        "name" => $consumer_object->AgencyName,
        "street_address1" => is_array($consumer_object->Address) ? (isset($consumer_object->Address[0]) ? $consumer_object->Address[0] : "Address") : $consumer_object->Address,
        "city" => is_array($consumer_object->City) ? (isset($consumer_object->City[0]) ? $consumer_object->City[0] : "City") : $consumer_object->City,
        "zipcode" => is_array($consumer_object->Zip) ? (isset($consumer_object->Zip[0]) ? $consumer_object->Zip[0] : "11111") : $consumer_object->Zip,
        "state_id" => $state_info['id'],
        "created_time" => date("Y-m-d H:i:s")
    );
    return $instance->agency->saveAgency($insert_data);
}

/**
 * Function to check and create if agent doesn't exists in our database
 * @param string $agent_number
 * @param array $saml_data
 * @return array $user_data
 */
function checkAndCreateAgentIfNotExists($agent_number, $saml_data) {
    //echo '<pre>';print_r($saml_data['samlUserdata']['VLAgentNum'][0]);exit;
    $instance = &get_instance();
    $instance->load->model(array('user', 'users', 'roles', 'agency'));
    $agent_number = trim($agent_number);
    //$encrypted_agent_number = $instance->users->getEncryptedCode($agent_number);
    $where_cond = array("convert(AES_DECRYPT(agent_code, '" . ENCRYPT_SALT . "') USING utf8) = " => $agent_number, "row_status" => 1, "user_type" => 2001, "status" => 1001);
    $user_data = $instance->user->getUserInformation($where_cond);

    if (empty($user_data)) {
        //Retreiving the aget role id
        $agent_role_id = getAgentRoleID($instance);
        $agent_list_json = get_agent_list_from_quote_api($agent_number);
        $consumer_result = json_decode($agent_list_json);
        $agency_id = 0;
        if (!empty($consumer_result) && isset($consumer_result->Producer)) {
            $consumer_producer_result = $consumer_result->Producer;
            if (isset($consumer_producer_result->AgentNumber)) {
                $api_agency_name = trim($consumer_producer_result->AgencyName);
                $agency_info = getAgencyInformation($api_agency_name, $instance);
                if (empty($agency_info))
                    $agency_id = saveAgencyInformation($consumer_producer_result, $instance);
                else
                    $agency_id = $agency_info['id'];
            } else {
                foreach ($consumer_producer_result as $key => $value):
                    if (trim($value->AgentNumber) == $agent_number) {
                        $api_agency_name = trim($value->AgencyName);
                        $agency_info = getAgencyInformation($api_agency_name, $instance);
                        if (empty($agency_info))
                            $agency_id = saveAgencyInformation($value, $instance);
                        else
                            $agency_id = $agency_info['id'];
                        break;
                    }
                endforeach;
            }
        }
        else{
            log_message("Error", "Call 9 is failed in checkAndCreateAgentIfNotExists() for agent number: ".$agent_number);
        }
        if ($agency_id == 0) {
            $sub_string_agent_code = substr($agent_number, 0, NO_OF_DIGITS_AGENTCODE);
            $where_cond = array(
                "row_status" => 1,
                "convert(LEFT(AES_DECRYPT(agent_code, '" . ENCRYPT_SALT . "'), " . NO_OF_DIGITS_AGENTCODE . ") USING utf8) like '%" . $sub_string_agent_code . "%'" => NULL
            );
            $user_info = $instance->user->getUserInformation($where_cond);
            if (!empty($user_info))
                $agency_id = $user_info['agency_id'];
            else
                $agency_id = 1;
        }
        $call_8_json = get_agent_list_from_quote_api($agent_number, "call_8");
        $postdata = array(
            'email' => ((isset($saml_data['samlUserdata']['Email'][0]) && $saml_data['samlUserdata']['Email'][0] != '') ? $saml_data['samlUserdata']['Email'][0] : ''),
            'first_name' => ((isset($saml_data['samlUserdata']['FirstName'][0]) && $saml_data['samlUserdata']['FirstName'][0] != '') ? $saml_data['samlUserdata']['FirstName'][0] : ''),
            'last_name' => ((isset($saml_data['samlUserdata']['LastName'][0]) && $saml_data['samlUserdata']['LastName'][0] != '') ? $saml_data['samlUserdata']['LastName'][0] : ''),
            'agent_code' => trim($saml_data['samlUserdata']['VLAgentNum'][0]),
            "phone_number" => "",
            "agent_json_data" => $call_8_json,
            "gender" => 6001,
            "agency_id" => $agency_id,
            'is_agency_admin' => 0,
            'role_id' => $agent_role_id,
            'carrier_id' => 1,
            'created_time' => date("Y-m-d H:i:s"),
            'user_session_id' => 1
        );
        //echo '<pre>';print_r($postdata);exit;
        $user_id = $instance->user->saveAgentInformation($postdata);
        log_message("Error", "Created from vantis");
        $where_cond = array(
            "id" => $user_id,
            "row_status" => 1
        );
        $user_data = $instance->user->getUserInformation($where_cond);
        //echo $instance->db->last_query();exit;
    }
    else{
        $postdata = array(
            'email' => ((isset($saml_data['samlUserdata']['Email'][0]) && $saml_data['samlUserdata']['Email'][0] != '') ? $saml_data['samlUserdata']['Email'][0] : ''),
            'first_name' => ((isset($saml_data['samlUserdata']['FirstName'][0]) && $saml_data['samlUserdata']['FirstName'][0] != '') ? $saml_data['samlUserdata']['FirstName'][0] : ''),
            'last_name' => ((isset($saml_data['samlUserdata']['LastName'][0]) && $saml_data['samlUserdata']['LastName'][0] != '') ? $saml_data['samlUserdata']['LastName'][0] : ''),
            'agent_code' => trim($saml_data['samlUserdata']['VLAgentNum'][0]),
            'modified_time' => date("Y-m-d H:i:s")
        );
        //echo '<pre>';print_r($postdata);exit;
        $user_id = $instance->user->saveAgentInformation($postdata);
        log_message("Error", "Updated from vantis");
    }
    return $user_data;
}

/**
 * Function to check and create agents if not exists
 * @param array $agent_number
 */
function checkAndCreateAgentsIfNotExists($agent_number) {
    $instance = &get_instance();
    $instance->load->model(array('user', 'users', 'roles', 'agency'));
    $agent_list_json = get_agent_list_from_quote_api($agent_number);
    $consumer_result = json_decode($agent_list_json);
    $consumer_producer_result = $consumer_result->Producer;
    $agent_role_id = getAgentRoleID($instance);
    foreach ($consumer_producer_result as $key => $value):
        if (!empty($value) && isset($value->AgentNumber)) {
            $api_agency_name = trim($value->AgencyName);
            $agency_info = getAgencyInformation($api_agency_name, $instance);
            if (empty($agency_info))
                $agency_id = saveAgencyInformation($value, $instance);
            else
                $agency_id = $agency_info['id'];

            
            $agent_number = trim($agent_number);
            //$encrypted_agent_number = $instance->users->getEncryptedCode($agent_number);
            $where_cond = array("convert(AES_DECRYPT(agent_code, '" . ENCRYPT_SALT . "') USING utf8) = " => $agent_number, "row_status" => 1, "user_type" => 2001, "status" => 1001);
            $user_data = $instance->user->getUserInformation($where_cond);
            $call_8_json = get_agent_list_from_quote_api(trim($value->AgentNumber), "call_8");
            if (empty($user_data)) {
                $postdata = array(
                    'email' => $value->Email,
                    'first_name' => $value->FirstName,
                    'last_name' => $value->LastName,
                    'agent_code' => trim($value->AgentNumber),
                    "phone_number" => is_array($value->Phone1) ? (isset($value->Phone1[0]) ? $value->Phone1[0] : "") : $value->Phone1,
                    "agent_json_data" => $call_8_json,
                    "gender" => 6001,
                    "agency_id" => $agency_id,
                    'is_agency_admin' => 0,
                    'role_id' => $agent_role_id,
                    'carrier_id' => 1,
                    'created_time' => date("Y-m-d H:i:s"),
                    'user_session_id' => 1,
                );
                $instance->user->saveAgentInformation($postdata);
                log_message("Error", "Created from vantis creating multiple agents.");
            }
        }
    endforeach;
    return true;
}


function get_agent_list_from_quote_api($agent_code, $quote_api = "call_9") {
    $agent_response_data = "";

    try {
        $CI = &get_instance();
        $CI->load->library('vantis/Quote_api');

        //add Required params to call API
        $params['s_GUID'] = QUOTE_GUID;
        $params['sProducerID'] = $agent_code;
        if ($quote_api == "call_9")
            $response_array = $CI->quote_api->getQuotesCall9($params);
        else
            $response_array = $CI->quote_api->getQuotesCall8($params);

        if (array_key_exists('data', $response_array)) {
            $agent_response_data = get_json_from_array($response_array['data']);
        }
    } catch (Exception $e) {
        log_message(ERROR, "Some thing went wrong with Quote9 API.");
    }

    return $agent_response_data;
}

/**
 * Converts array data into json
 *
 * @param string $data_array
 * @return array $json_data 
 */
function get_json_from_array($data_array) {
    $json_data = json_encode(array());

    if (is_array($data_array)) {
        if (count($data_array) > 0) {
            $json_data = json_encode($data_array, TRUE);
        }
    }

    return $json_data;
}

function updatePolicyAddress($where_array, $edit_data) {
    $CI = &get_instance();
    $CI->load->model('policies');

    $policyDetails = $CI->policies->getPoliciesv2ByConditions($where_array, array());
    foreach($policyDetails as $x => $val) {
       
        $where_array1["id"] = $val["policy_id"];
        $where_array1["carrier_id"] = $where_array["u.carrier_id"];
        $where_array1["row_status"] = 1;
        $where_array1["user_id"] = $where_array["u.id"];
        $CI->policies->updateInsuredAddressJSONNew($where_array1, $edit_data);

    }
    return true;
}
