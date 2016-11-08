<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/// <summary> 
/// Modelo del Login
/// </summary>  
class Login_model extends CI_Model {
    
    function __construct() {

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
    parent::__construct();
    $this->load->database();
    
	}

/*
public function existeLogin($data) 
    {
        
        // Query to check whether username already exist or not
        $condition = "usuario =" . "'" . $data['usuario'] . "'";
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
*/

/*
public function datosUser(){
    
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('user',$data['usuario']);
        $this->db->where('password',$data['password']);
        $this->db->limit(1);
        $query = $this->db->get();
        
    
}*/


/// <summary> 
/// Funcion para determinar si existe la persona 
/// </summary>  
function comprobarLogin($data){


        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('user',$data['usuario']);
        $this->db->where('password',$data['password']);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) 
        {   
                $this->db->select('*');
                $this->db->from('usuario');
                $this->db->where('user', $data['usuario']);
                $consulta = $this->db->get();
                $resultado = $consulta->result();

                $perfil = $consulta->result()[0]->perfil;
               
                $usuario = array( 
                    'nombre' => $consulta->result()[0]->nombre,
                    'apellido' => $consulta->result()[0]->apellido,
                    'perfil' => $consulta->result()[0]->perfil
                );
                
                if( $consulta->result()[0]->perfil == 'admin' || $consulta->result()[0]->perfil == 'manager' || $consulta->result()[0]->perfil == 'user' ) {
                    
                    return  $usuario;
                }
                
        }
        else 
                {
                    echo "<script> alert('Datos no validos');
        	       </script>";
	       
        	        $this->load->helper('url');
                    redirect('/','refresh');
        	        return 0 ;
                }

        }




public function comprobar_sesion_adm($data){
    
        if ( (isset($_SESSION['perfil'])) == false )
		{	
			echo "<script> alert('USTED NO ESTA LOGEADO');
	    	</script>";	
	    	
			$this->load->view('login/bienvenido');
		}
		else{
			if( ($_SESSION['perfil'])  == 'admin' ) $this->load->view($data.'/principal');
			else {
				echo "<script> alert('Area Restringida');
	    		</script>";	
	    		$this->load->view('login/bienvenido');
	    		
	    		//if($_SESSION['perfil'] =='user') {
	    		//	$usuario = 'usuario';
	    		//	$this->load->view($usuario.'/bienvenido');
				//}else $this->load->view($_SESSION['perfil'].'/bienvenido');
			}
		}
}






/*
public function comprobar_adm(){
    
        if ( (isset($_SESSION['perfil'])) == false )
		{	
			echo "<script> alert('USTED NO ESTA LOGEADO');
	    	</script>";	
	    	
			$this->load->view('login/bienvenido');
			
			return FALSE;
		}
		else{
			if( ($_SESSION['perfil'])  != 'admin' ) 
			{
				echo "<script> alert('Area Restringida');
	    		</script>";	
	    		$this->load->view('login/bienvenido');
	    		
	    		return FALSE;
	    		
	    		//if($_SESSION['perfil'] =='user') {
	    		//	$usuario = 'usuario';
	    		//	$this->load->view($usuario.'/bienvenido');
				//}else $this->load->view($_SESSION['perfil'].'/bienvenido');
			}
			else return TRUE;
		}
    
}*/

    
}