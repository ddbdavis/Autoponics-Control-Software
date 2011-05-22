<?php
require_once('abstract.php');
class Account extends Abstract_Controller
{
		public function __construct()
		{
				parent::__construct();
				//load the custom form validation library
        $this->load->library('form_validation');
  	}
	
		/**
		 * Remaps request based on its protocol
	   */
		public function _remap($method)
		{
    	parent::_remap($method);
    }
    
    protected function handle_get($method)
		{
        switch($method)
        {
	       case 'login':
	           $this->show_login();
	           break;
	       case 'logout':
	           $this->logout();
	           break;
        }
		}
		
		protected function handle_post($method)
		{
        switch($method)
        {
	       case 'login':
	           $this->login();
	           break;
        }
		}
    
    /** 
     * Performs check of user login credentials.
     * Logs in the user if the credentials are good.
     */
    private function login()
    {
        //get data from post
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        //do validation
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|email_exists');
        $this->form_validation->set_rules('password', 'password', 'required|password');

        //handle the outcome of the validation test
        if($this->form_validation->run() == false)
        {
            $this->show_login();
        }
        else
        {
            $this->load->model('user');
            $user = new User();
            $user->load_by_email($email);
            $user->authenticate();
            $this->show_dashboard();
        }
    }
    
    private function logout() {
        $this->auth->logout();
        $this->show_login();
    }
		
		public function show_dashboard()
    {
        $this->redirect('dashboard');
    }
    
    public function show_login()
    {
        $this->add_view('login');
        $this->view();
    }
}
