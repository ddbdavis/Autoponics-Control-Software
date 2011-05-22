<?php
class User extends CI_Model
{

    public $id          	 = 0;
    public $email          = '';
    public $name_first     = ''; 
    public $name_last      = '';
    public $created_at     = 0;
    public $modified_at    = 0;
    
    protected $_table      = 'users';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function authenticate()
    {
        $this->auth->authenticate($this);
    }
    
    public function load($id)
    {
        return $this->db->get_where($this->_table, array('id' => $id))->result();
    }
    
    public function load_by_email($email)
    {
        $result = $this->db->get_where($this->_table, array('email' => $email))->result();
        $user_record = $result[0];
        
        foreach($user_record as $key=>$value)
        {
            if (isset($this->$key))
            {
                $this->$key = $value;
            }
        }
    }
    
    private function _is_valid($email,$password)
    {
        return $this->db->get_where($this->_table, array('email' => $email))->get();
    }
    
}
