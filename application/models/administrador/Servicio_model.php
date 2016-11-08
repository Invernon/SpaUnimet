<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/// <summary> 
	/// Modelo de los Servicios, funciones similares al Modelo de agenda
	/// </summary> 

class Servicio_model extends CI_Model {
    
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
	
	/// <summary>	
	///Funcion para crear un servicio	
	/// </summary> 
	function crearServicio($data){ 
	
	if($data['equipo']==NULL){
		
		$data['equipo'] = FALSE ;
	}
	
	if($data['activo']==NULL){
		
		$data['activo'] = FALSE ;
	}
	
	$resultado = $this->db->insert('servicio',array('descripcion'=>$data['descripcion'],'duracion'=>$data['duracion'],
									'precio'=>$data['precio'],'tipo'=>$data['tipo'],'activo'=>$data['activo'],'equipo'=>$data['equipo']));
									
	   if($resultado == TRUE){
	       
	       echo "<script> alert('Registro completado !');
	       </script>";
	   }

	}
	
	/// <summary>	
	///Funcion para obtener una lista de servicios	
	/// </summary> 	
	function obtenerServicios(){
	    
	    $query = $this->db->get('servicio');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	}
	   
	/// <summary>	
	///Funcion para obtener un solo servicio	
	/// </summary> 
	function obtenerServicio($id){

	    //$this->db->where('id',$id);
	    $query = $this->db->from('servicio')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	
	/// <summary> 
	/// Funcion para obtener la duraccion del servicio
	function obtenerDuracion($id){

	    //$this->db->where('id',$id);
	    $query = $this->db->from('servicio')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	 
	    
	}
	/// </summary> 
	
	
	/// <summary> 
	/// Funcion que te permite actualizar un servicio
	/// </summary> 	
	function actualizarServicio($id,$data){
		
		if($data['equipo']==NULL){
		
		$data['equipo'] = FALSE ;
		}
	
		if($data['activo']==NULL){
			
			$data['activo'] = FALSE ;
		}
		
		$this->db->where('id',$id);
		$query = $this->db->update('servicio',array('descripcion'=>$data['descripcion'],'duracion'=>$data['duracion'],
									'precio'=>$data['precio'],'tipo'=>$data['tipo'],'activo'=>$data['activo'],'equipo'=>$data['equipo']));
									
		if($query == TRUE){
	       
	       echo "<script> alert('Registro Actualizado!');
	       
	       </script>";
	   }
	   else
	   {
	   	echo "<script> alert('NO SE COMPLETO');</script>" ;
	   }
		
	}
	
	/// <summary> 
	/// Funcion que elminina a un servicio
	/// </summary> 
	function eliminarServicio($id){
		
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