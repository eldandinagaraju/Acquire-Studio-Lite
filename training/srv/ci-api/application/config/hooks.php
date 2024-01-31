<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
/*
$hook['post_controller'] = array(
'class' => 'Auth_module',
'function' => 'index',
'filename' => 'App_auth.php',
'filepath' => 'controllers',
'params' => ''
);

$hook['display_override'] = array(
  'class' => 'DisplayHook',
  'function' => 'captureOutput',
  'filename' => 'DisplayHook.php',
  'filepath' => 'hooks'
);
 * */
$hook['pre_controller'] = array(
    'class' => 'Redirect_page',
    'function' => 'set_redirect_url_session',
    'filename' => 'redirect_page.php',
    'filepath' => 'controllers',
    'params' => ''
);

$hook['post_controller_constructor'] = array(
    'class' => 'Set_DB_Debug',
    'function' => 'set_db_debug',
    'filename' => 'Set_DB_Debug.php',
    'filepath' => 'controllers',
    'params' => ''
);


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */