<?php
/**
 * This class extends the core CI_Form_validation library, allowing us to
 * implement our own methods for form validation.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed.');

class MY_Form_validation extends CI_Form_validation
{
		var $CI;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->CI =& get_instance();
    }

		public function email_exists($str)
    {
        if($this->CI->db->get_where('users',array('email' => $str))->num_rows() > 0)
        {
            return true;
        }
        
        return false;
    }
    
    public function password($str)
    {
        $email = $this->CI->input->post('email');
        if($this->CI->auth->is_valid_user($email,$str))
        {
            return true;
        }   
        
        return false;
    }
}
