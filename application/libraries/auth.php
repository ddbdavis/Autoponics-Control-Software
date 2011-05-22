<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth
{
    public $CI;
    public $users_table = 'users';
    
    public function __construct()
    {
        $this->CI =& get_instance();
        if($this->is_authenticated() === false)
        {
            $this->reset_user_data();
        } 
    }   
    
    public function is_valid_user($email,$password)
    {
        $password = $this->hash($password);
        if($this->CI->db->get_where(
      			$this->users_table,array(
        				'email' => $email,
        				'password' => $password
        		))->num_rows() == 1)
        {
            return true;
        }
        
        return false;
    }
    
    public function authenticate($user)
    {
        //destroy old session
        $this->CI->session->sess_destroy();
			
        //create a brand new session
        $this->CI->session->sess_create();
        
        // update user's last login date
        $this->CI->db->simple_query('UPDATE ' . $this->users_table  . ' SET last_login = NOW() WHERE email = ' . $user->email);
        
				//Set session data
				$user_data['user_id'] = $user->id;
				$user_data['authenticated'] = true;
				$this->CI->session->set_userdata($user_data);
		}
				
    public function logout() 
    {
        //reset user data
        $this->reset_user_data();
        
        //destroy the session
        $this->CI->session->sess_destroy();
    }
    
    public function is_authenticated()
    {
        return (boolean) $this->CI->session->userdata('authenticated');
    }
    
    private function reset_user_data()
    {
        $this->CI->session->unset_userdata('user_id');
        $this->CI->session->unset_userdata('authenticated');
        $user_data['user_id'] = 0;
				$user_data['authenticated'] = false;
        $this->CI->session->set_userdata($user_data);
    }
    
    private function hash($password)
    {
        $hash = md5($password . md5($password));
        return $hash;
    }
}
