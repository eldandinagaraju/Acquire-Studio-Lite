<?php
class Auth
{
    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->database();
    }

    public  function authenticateAdmin($id)
    {
        $this->ci->db->select('id');
        $this->ci->db->from('users');
        $this->ci->db->where(array('id=' => $id, 'rowStatus=' => 1, 'isAdmin=' => 1));
        $query = $this->ci->db->get();
        if ($query->num_rows() == 1) {
            return array(
                'status' => true,
                'message' => "Authorized request",
                'id' => $id,
                'isAdmin' => true
            );
        }
        return array(
            'status' => false,
            'message' => "Unauthorized request"
        );
    }

    /**
     * Authenticates the JWT token
     * @param $jwt string token generated during login 
     * 
     * @return array with id,isAdmin fields
     */
    public  function authenticate($jwt)
    {
        $decoded = JWT::decode($jwt, JWT_SECRET_KEY, array('HS256'));
        $id = $decoded->data->id;
        $isAdmin = $decoded->data->isAdmin;
        $this->ci->db->select('id');
        $this->ci->db->from('sessions');
        $this->ci->db->where(array('id=' => $id, 'rowStatus=' => 1));
        $query = $this->ci->db->get();
        if ($query->num_rows() == 1) {

            if ($decoded->exp < time()) {
                $this->ci->db->update('sessions', array('rowStatus' => 0), array('id' => $id));
                return array(
                    'status' => false,
                    'message' => "Token expired please login again."
                );
            }
            if ($isAdmin) {
                return ($this->authenticateAdmin($id));
            } else {
                return array(
                    'status' => true,
                    'message' => "Authorized request",
                    'id' => $id,
                    'isAdmin' => $isAdmin
                );
            }
        } else {
            return array(
                'status' => false,
                'message' => "Unauthorized request"
            );
        }
    }

    /**
     * Decodes the JWT token from header
     * 
     * @return string
     */
    public  function getToken()
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $tokenArr = explode(" ", $authHeader);
        return $tokenArr[1];
    }
}
