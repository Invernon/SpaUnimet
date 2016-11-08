<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    
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
	
	function crearUsuario($data){
	$resultado = $this->db->insert('usuario',array('nombre'=>$data['nombre'],'user'=>$data['user'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo'],'perfil'=>$data['perfil'],'password'=>$data['password']));
	   if($resultado == TRUE){
	       
	       echo "<script> alert('Registro completado !');
	       </script>";
	   }

	}
	
	function obtenerUsuarios(){
	    
	    $query = $this->db->get('usuario');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	}
	
	function obtenerUsuariosBusqueda($data){
		
			
		
	//	$query = $this->db->query('SELECT * FROM usuario Where $data['tipo'] Like '%$data['nombre']%' ');
	//  $query = $this->db->from('usuario')->where($data['tipo'],$data['tipo'])->like($data['nombre'])->get();
	//	$query = $this->db->select('*')->from('usuario')->where("$data['tipo'] LIKE '%$data['nombre']%'")->get();
	
		$query = $this->db->from('usuario')->like($data['tipo'], $data['nombre'], 'both')->get();    
	
	    if ($query-> num_rows() > 0) 
	    {
	       return $query->result_array();
		}
		else{
			return FALSE;
		}
	}
	   
	   
	function obtenerUsuario($id){
	    
	    $sql = "  select * from usuario where nombre like '%a%' ";
	    
	    //$this->db->where('id',$id);
	    $query = $this->db->from('usuario')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	
	function actualizarUsuario($id,$data){
		
		$datos=array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo']);
		
		$this->db->where('id',$id);
		$query = $this->db->update('usuario',array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo']));
		if($query == TRUE){
	       
	       echo "<script> alert('Registro Actualizado!');
	       </script>";
	   }
	   else
	   {
	   	echo "<script> alert('NO SE COMPLETO');</script>" ;
	   }
		
	}
	
	function eliminarUsuario($id){
		
		$this->db->delete('usuario',array('id'=>$id));
		$query = $this->db->from('usuario')->where('id',$id)->get();
		if($query==false){
			echo "<script> alert('Se ha eliminado el usuario.'); </script>";
		}
		else{ 
		echo "<script> alert('Se ha eliminado el usuario'); </script>";
		}
	}
}

?>