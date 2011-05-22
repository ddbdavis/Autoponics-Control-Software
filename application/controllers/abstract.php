<?php
/**
 * The Abstract_Controller provides methods that
 * will be repeatedly implemented in the rest of the controllers.
 */
class Abstract_Controller extends CI_Controller
{
    public $data = array();
    public $views = array();
    
    /* These methods to be overridden by child class */
    protected function handle_get() {}
    protected function handle_post() {}
  	
    public function __construct()
		{
				parent::__construct();
				$this->data['actions_menu'] = $this->load->view('actions_menu',null,true);
				$this->data['user_menu'] = $this->load->view('user_menu',null,true);
    }
		 
    public function _remap($method)
    {
    		/**
    		 * protocol-specific handling
    		 */
        try {
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST' :
                    $this->handle_post($method);
                break;
                case 'GET' :
                    $this->handle_get($method);
                break;
                default :
                    $this->output->set_status_header(HTTP_METHOD_NOT_ALLOWED);
                    throw new Request_Exception("The request method is not supported.");
                break;
            }
        } catch(Exception $e) {
            throw $e;
            //TODO Setup Authentication_Exception trap
        }
    }   
    
    public function add_view($view, $args=array())
    {
        array_push($this->views,array('view' => $view, 'args' => $args));
    } 
    
    public function auth_check()
    {
        if(false === $this->auth->is_authenticated()) {
            $this->redirect('login');
        }
    }
  
    public function redirect($route)
    {
        header('Location: /' . $route);
    }
    
    /**
     * This is the function that loads all the views, creating the entire
     * layout for the client.
     * The $views array is loaded in order of the array elements, and are
     * loaded after the header and before the footer.
     */
    public function view($views = array())
    {
        //load the html head
        $this->load->view('head');
        
        //load the header block
        $this->load->view('header',array('is_authenticated' => $this->auth->is_authenticated()));
        
        // load the body_top
        $this->load->view('body_top');
        
        //load the debug block
        if($this->config->item('debug'))
        {
            $args = array();
            $args['debug_array']['Auth'] = $this->auth->is_authenticated() ? 'true' : 'false';
            $args['debug_array']['User ID'] = $this->session->userdata('user_id');
            $args['debug_array']['Session ID'] = $this->session->userdata('session_id');
            
            $this->load->view('debug',$args);
        }
        
        //load all views passed into this function
        foreach($this->views as $view) {
            //add common data to all views
            $view['args']['data'] = $this->data;
            $this->load->view($view['view'],$view['args']);
        }
        
        // load the footer block
        $this->load->view('footer');
        
        // load the body_bottom
        $this->load->view('body_bottom');
    }  
}