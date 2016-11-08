<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/// <summary> 
	/// Modelo de los Clientes, funciones similares al Modelo de agenda
	/// </summary> 
class Cliente_model extends CI_Model {
	

    
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
	/// Funcion que permite crear un cliente
	/// </summary>
	function crearCliente($data){
		
	$igual = $this->db->select('*')->from('cliente')->where('cedula',$data['cedula'])->get();
	
	if ($igual->num_rows()>0){
		echo "<script> alert('Cedula duplicada !');
	    </script>";
	    return (FALSE);
		}
		else{
			$resultado = $this->db->insert('cliente',array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'cedula'=>$data['cedula']));
				 if($resultado == TRUE){
	    			echo "<script> alert('Registro completado !');
	    				</script>";
	    			return(TRUE);
	       
					}
			}
	}
	
	
	/// <summary> 
	/// Funcion para obtener una lista de clientes
	function obtenerClientes(){
	    
	    $query = $this->db->get('cliente');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	}	
	/// </summary> 
	
	
	/// <summary>	
	///Funcion para obtener un solo cliente	
	function obtenerCliente($id){
	    
	    
	    
	    //$this->db->where('id',$id);
	    $query = $this->db->from('cliente')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	/// </summary> 
	
	/// <summary> 
	/// Funcion que te permite actualizar un cliente
	/// </summary> 
	function actualizarCliente($id,$data){
		
		$datos=array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'cedula'=>$data['cedula']);
		
		$this->db->where('id',$id);
		$query = $this->db->update('cliente',array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'cedula'=>$data['cedula']));
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
		/// Funcion que elminina a un cliente
		/// </summary> 
	function eliminarCliente($id){
		
		$this->db->delete('cliente',array('id'=>$id));
		$query = $this->db->from('cliente')->where('id',$id)->get();
		if($query==false){
			echo "<script> alert('Se ha eliminado el cliente.'); </script>";
		}
		else{ 
		echo "<script> alert('Se ha eliminado el cliente'); </script>";
		}
	}
	
	
	function obtenerClientesBusqueda($data){
		/// <summary> 
		/// Funcion para buscar los clientes con la barra de busqueda
		/// </summary> 
		
		$query = $this->db->from('cliente')->like($data['tipo'], $data['nombre'], 'both')->get();    
	
	    if ($query-> num_rows() > 0) 
	    {
	       return $query->result_array();
		}
		else{
			return FALSE;
		}
	}
		


	}
	
	/// <summary> 
	/// Fin del modelo
	/// </summary> 
	

?>