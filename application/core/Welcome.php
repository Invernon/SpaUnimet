<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// <summary> 
/// Controlador Welcome
/// </summary>  
class Welcome extends CI_Controller {

	function __construct() {

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
    parent::__construct();
    
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('/login/Login_model');
	} 
	 
	public function index()
	{	
	    $this->load->helper('form');
		$this->load->helper('url');
		//$this->session->sess_destroy();
		$this->load->view('login/bienvenido');

	}

/// <summary> 
/// Funcion que comprueba si el login es Administrador, Manager o Usuario
/// </summary>
	public function login(){
	    
	    $this->load->helper('form');
	    
	    $this->form_validation->set_rules('user', 'Usuario', 'required|strtolower', array('required' => 'Introduzca un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Introduzca una %s.'));
		

		if($this->form_validation->run()){
    		
    	 $data = array (
				'usuario' => $this->input->post("user"),
				'password' => $this->input->post("password")
			);
			
				if( $this->Login_model->comprobarLogin($data) == TRUE ){
				    
				$comprobar = $this->Login_model->comprobarLogin($data);
				
				    if( ($comprobar['perfil']) == 'admin'){
					
					echo $comprobar['perfil'];
					$this->session->set_userdata($comprobar);
					
					//$this->session->set_tempdata($comprobar);
				
			        // print_r ( $this->session->all_userdata() );
			        
			        //$this->load->helper('url');
				    //redirect('administrador/');
				    
			        $this->load->helper('url');
		            $this->load->view('administrador/principal');
		               
			        }elseif( ($comprobar['perfil']) == 'manager'){
			        	
			        	
			        	$this->session->set_userdata($comprobar);
			        	//print_r ($this->session->userdata('perfil'));
			            //$this->load->helper('url');
		                //$this->load->view('manager/principal',$comprobar);
		                
		                
			            
			        }elseif(($comprobar['perfil']) == 'user'){
			        	
			        	$this->session->set_userdata($comprobar);
			            $this->load->helper('url');
		                $this->load->view('usuario/principal',$comprobar);
			        }
			        else{
			            //$this->load->helper('url');
				        //redirect('login/bienvenido','refresh');
				        //$this->load->view('login/bienvenido');
			        }
				}
    	
		 }else{
		 	
		       $this->load->view('login/bienvenido');
		 }
	    	
	}

}
