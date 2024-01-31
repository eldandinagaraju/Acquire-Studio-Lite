<?php

/**
 * Check organization permission
 * 
 * @param array headers
 * 
 * 
 * @return boolean true false
 */
function checkOrganizationPermission($headers) {

        $instance = &get_instance();
        $allowed_controllers = array('typeform');
        $current_controller = $instance->router->fetch_class();
        
        if( in_array( $current_controller,$allowed_controllers ) )
        {
            return true;
        }

        if(count($headers) == 0){
            log_message('error', 'headers empty.');
            $instance->response(array('status' => false, 'error' => 'headers empty.'), 401);
        }
        $organization_id  = '';
        $organization_access_token = '';

        if( !(array_key_exists( 'organization_id',$headers )) ||  !(array_key_exists( 'organization_access_token',$headers ))){

            log_message('error', 'organization_id and organization_access_token parameters required.');
            $instance->response(array('status' => false, 'error' => 'organization_id and organization_access_token parameters required.'), 401);
        }
    
        $organization_id = $headers['organization_id'];
        $organization_access_token = $headers['organization_access_token'];



        if ( $organization_id == '' || $organization_access_token == '' ){
            log_message('error', 'organization_id and organization_access_token parameters are null.');
            $instance->response(array('status' => false, 'error' => 'organization_id and organization_access_token are not null.'), 401);
        }
        
        
        $organization_data = $instance->db->get_where('carriers', array('organization_id' => $organization_id, 'organization_access_token' => $organization_access_token, 'row_status' => 1))->row();
        

        if( count( $organization_data ) == 0 )
        {
         log_message('error', 'organization_id and organization_access_token parameters are null.');
            $instance->response(array('status' => false, 'error' => 'Invalid organization id or organization access token.'), 401);       
        }
        return true;
}
