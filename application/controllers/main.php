<?php
require_once('abstract.php');
class Main extends Abstract_Controller
{
		function __construct()
		{
				parent::__construct();
		}

		function home()
		{
        if($this->auth->is_authenticated())
        { // show the user dashboard
            $this->dashboard();
        }
        else
        { // show the default page
            $this->add_view('index');
            $this->view();
        }
		}
	
		function dashboard()
		{
      	//perform auth check
	    	$this->auth_check();
	    
        //setup and load views
        $this->add_view('dashboard', array('is_authenticated' => $this->auth->is_authenticated()));
        $this->view();
		}
	
		protected function handle_get($method)
		{
        switch($method)
        {
						case 'files':
	          		$this->files();
	           		break;
	       		case 'index':
	       		default:
	          		$this->home();
	          		break;
	       		case 'login':
	          		$this->showLogin();
	           		break;
	       		case 'logout':
	          		$this->doLogout();
	           		break;
        }
		}
	
    protected function handle_post()
    {
    	//
    }
}
