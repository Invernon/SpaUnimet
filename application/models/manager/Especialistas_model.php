<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/// <summary> 
	/// Modelo de los Especialistas, funciones similares al Modelo de agenda
	/// </summary> 

class Especialistas_model extends CI_Model {
    
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
	
	function crearEspecialista($data){
	$resultado = $this->db->insert('especialista',array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo']));
	   if($resultado == TRUE){
	       
	       echo "<script> alert('Registro de especialista completado !');
	       </script>";
	   }

	}
	
	function obtenerEspecialistas(){
	    
	    $query = $this->db->get('especialista');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	}
	   
	function obtenerEspecialista($id){
  
	    //$this->db->where('id',$id);
	    $query = $this->db->from('especialista')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	
	function actualizarEspecialista($id,$data){
		
		$datos=array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo']);
		
		$this->db->where('id',$id);
		$query = $this->db->update('especialista',array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo']));
		if($query == TRUE){
	       
	       echo "<script> alert('Especialista Actualizado!');
	       </script>";
	   }
	   else
	   {
	   	echo "<script> alert('NO SE COMPLETO');</script>" ;
	   }
		
	}
	
	function eliminarEspecialista($id){
		
		$this->db->delete('especialista',array('id'=>$id));
		$query = $this->db->from('especialista')->where('id',$id)->get();
		if($query==false){
			echo "<script> alert('Se ha eliminado el especialista.'); </script>";
		}
		else{ 
		echo "<script> alert('Se ha eliminado el especialista'); </script>";
		}
	}
}

?>