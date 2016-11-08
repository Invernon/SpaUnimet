<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/// <summary> 
	/// Modelo de los Usuarios, funciones similares al Modelo de agenda
	/// </summary> 
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
	

	/// <summary>	
	///Funcion para crear un usuario	
	/// </summary> 		
	function crearUsuario($data){
		
		//query para verificar si el usuario ya existe
		$query = $this->db->from('usuario')->where('user',$data['user'])->get();
	    
	    if($query-> num_rows() > 0){
	        echo "<script> alert('El usuario ya existe!');
	       </script>";
		}
	    else{
	    	
	    	if(($data['perfil']) =='user'){
		
				$resultado1 = $this->db->insert('especialista',array('nombre'=>$data['nombre'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo']));
		
				$resultado2 = $this->db->insert('usuario',array('nombre'=>$data['nombre'],'user'=>$data['user'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo'],'perfil'=>$data['perfil'],'password'=>$data['password']));
			
				if($resultado1 && $resultado2 == TRUE){
	       
	    		 echo "<script> alert('Registro completado !');
	    			 </script>";
				  }
			}
			else 
				{
					$resultado = $this->db->insert('usuario',array('nombre'=>$data['nombre'],'user'=>$data['user'],'apellido'=>$data['apellido'],'telefono'=>$data['telefono'],'correo'=>$data['correo'],'perfil'=>$data['perfil'],'password'=>$data['password']));
						if($resultado == TRUE){
	    						 echo "<script> alert('Registro completado !');
	    							 </script>";
						  }
				}	
	    	
	    }
		
		
	//fin crearUsuario($data)
	}
	
	/// <summary>	
	///Funcion para obtener una lista de usuarios	
	/// </summary> 	
	function obtenerUsuarios(){
	    
	    $query = $this->db->get('usuario');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	}
	
	
	/// <summary> 
	/// Funcion para obtener los Usuarios por la barra de busqueda
	/// </summary> 
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
	   
	/// <summary> 
	/// Funcion para buscar y obtener un usuario por su ID
	/// </summary>    
	function obtenerUsuario($id){
	    
	    $sql = "  select * from usuario where nombre like '%a%' ";
	    
	    //$this->db->where('id',$id);
	    $query = $this->db->from('usuario')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	
	
	/// <summary> 
	/// Funcion que te permite actualizar un usuario
	/// </summary> 	
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
	
	
	/// <summary> 
	/// Funcion que te permite eliminar un usuario
	/// </summary> 		
	function eliminarUsuario($id){
		

		$query1 = $this->db->from('sesion')->where('id_usuario',$id)->get(); //QUERY PARA OBTENER TODO DE UNA VEZ.
					
		if ( ($query1->num_rows() ) == 0 )
		{
			$this->db->delete('usuario',array('id'=>$id));
			$query = $this->db->from('usuario')->where('id',$id)->get();
			
			if($query==false){
			echo "<script> alert('No se ha podido eliminar el usuario.'); </script>";
			}
			else{ 
			echo "<script> alert('Se ha eliminado el usuario'); </script>";
			}
		}else {
		
			echo "<script> alert('No se puede eliminar el usuario, tiene eventos en proceso'); </script>";
			
		}
		
	}
}

?>