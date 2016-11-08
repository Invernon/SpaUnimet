<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/// <summary> 
	/// Modelo de las Sesiones, funciones similares al Modelo de agenda
	/// </summary> 

class Sesion_model extends CI_Model {
    
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
	///Funcion para crear una sesion	
	/// </summary> 	
	function crearSesion($data){
	
	if($data['pagada']==NULL){
		
		$data['pagada'] = FALSE ;
		
	}else 	$data['pagada'] = TRUE;
	
	/*
	if($data['checkin']==NULL){
		
		$data['checkin'] = FALSE ;
	}
	if($data['ejecutada']==NULL){
		
		$data['ejecutada'] = FALSE ;
	} 
	
	
	if(strlen($data['idagenda']) == 0){
	$data['idagenda']= NULL; 
	
	}*/
	
	// Poner aqui metodo para buscar servicio por tipo y recibir id
	// luego insertar ese id abajo
	
	$resultado = $this->db->insert('sesion',array('pagada'=>$data['pagada'],
									'id_cliente'=>$data['idcliente'],'id_servicio'=>$data['idservicio'],
									'id_usuario'=>$data['idusuario']));
									
	   if($resultado == TRUE){
	       
	       echo "<script> alert('Sesión creada !');
	       </script>";
	   }

	}


	/// <summary>	
	///Funcion para obtener una sesion	
	/// </summary> 	
	function obtenerSesion(){
		
		$query1 = ('select sesion.id, sesion.checkin, sesion.pagada, sesion.id_servicio, sesion.id_usuario, sesion.id_agenda, sesion.ejecutada, usuario.nombre,
					usuario.apellido, servicio.descripcion , cliente.nombre as nombre_cliente , cliente.apellido as apellido_cliente from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on sesion.id_servicio = servicio.id
					Inner Join cliente
					on sesion.id_cliente = cliente.id'); //QUERY PARA OBTENER TODO DE UNA VEZ.
		$query = $this->db->query($query1);
		
		
	    //$query = $this->db->get('sesion');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	    
	    
	}
	
	/// <summary> 
	/// Funcion para obtener una sesion que este agendada
	/// </summary> 
	function obtenerSesion_agendar(){
		
		$query1 = ('select sesion.id, sesion.checkin, sesion.pagada, sesion.id_servicio, sesion.id_usuario, sesion.id_agenda, sesion.ejecutada, usuario.nombre,
					usuario.apellido, servicio.descripcion , cliente.nombre as nombre_cliente , cliente.apellido as apellido_cliente from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on sesion.id_servicio = servicio.id
					Inner Join cliente
					on sesion.id_cliente = cliente.id
					where sesion.id_agenda is NULL'); //QUERY PARA OBTENER TODO DE UNA VEZ.
		$query = $this->db->query($query1);
		
		
	    //$query = $this->db->get('sesion');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	    
	    
	}
	
	/// <summary>	
	///Funcion para obtener una  sesion
	/// </summary>
	function obtenerSesiones($id){

	    //$this->db->where('id',$id);
	    $query = $this->db->from('sesion')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	
	
	/// <summary> 
	//Obtener sesiones ejecutadas
	//Lista de todas las sesiones ejecutadas sin pagar
	function obtenerSesionEjecutada(){

		$query1 = ('select sesion.id, sesion.checkin, sesion.pagada, sesion.id_servicio, sesion.id_usuario, sesion.id_agenda, sesion.ejecutada, usuario.nombre,
					usuario.apellido, servicio.descripcion from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on sesion.id_servicio = servicio.id
					where (sesion.pagada = FALSE) AND (sesion.ejecutada = TRUE)  ' ); //QUERY PARA OBTENER TODO DE UNA VEZ.
		$query = $this->db->query($query1);
		
		//$array = $array = array('pagada' => FALSE, 'ejecutada' => TRUE);
	    //$query = $this->db->from('sesion')->where($array)->get();
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	    
	    
	    
	}
	/// </summary> 
	
	
	/// <summary> 
	///Una sesion ejecutada sin pagar
	function obtenerSesionesEjecutadas($id){

	    //$this->db->where('id',$id);
	    $query = $this->db->from('sesion')->where('id',$id)->get();
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	/// </summary> 
	
	
	
	/// <summary> 
	//Obtener sesiones ejecutadas
	//Lista de todas las sesiones ejecutadas sin pagar
	function obtenerSesionRetrasada(){
		
		$fechadia = date('Y-m-d');
		/*		$query1 = ('select * from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on servicio.id_servicio = usuario.id
					where agenda.fecha < '.$fechadia );	 //QUERY PARA OBTENER TODO DE UNA VEZ.
				
		
	
		
		function get_promo() {
    $today = date('Y-m-d');
    $query = $this->db->query(
        "SELECT FROM tbl_event WHERE event_id = {$id} AND event_startdate <= '{$today}'
        AND event_enddate >= '{$today}'");
    return $query;
}
		
		
		*/
		
		$fechadia = date('Y-m-d');
		/*$query3 = (' select sesion.id as id, sesion.checkin as checkin, sesion.pagada as pagada, 
							sesion.id_servicio as id_servicio, sesion.id_usuario as id_usuario,
							sesion.id_agenda as agenda, sesion.ejecutada as ejecutada, usuario.nombre as nombre,
					usuario.apellido as apellido, servicio.descripcion as descripcion 
					from sesion Inner JOIN usuario on
					usuario.id = sesion.id_usuario
					INNER JOIN servicio on
					servicio.id = sesion.id_servicio'); */
		//$this->db->from('sesion');
		//$this->db->join('usuario', 'usuario.id = sesion.id_usuario');
		//$this->db->join('servicio', 'servicio.id = sesion.id_servicio');
		
		$query1 = ('select sesion.id, sesion.checkin, sesion.pagada, sesion.id_servicio, sesion.id_usuario, sesion.id_agenda, sesion.ejecutada, usuario.nombre,
					usuario.apellido, servicio.descripcion from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on sesion.id_servicio = servicio.id
					Inner Join agenda on
					agenda.id_sesion = sesion.id
					where fecha <= '.$fechadia ); //QUERY PARA OBTENER TODO DE UNA VEZ.
		$query = $this->db->query($query1);
		
		//$this->db->query($query3);
		//$this->db->where('fecha <',$fechadia);
		//$this->db->where('fecha <=',$fin_mes);
		//$query= $this->db->get();
		
					
			//$query=$this->db->query($query1);
			//$this->db->where('fecha <',$fechadia);
			
		
		//$array = $array = array('pagada' => FALSE, 'ejecutada' => TRUE);
	    //$query = $this->db->from('sesion')->where($array)->get();
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	    
	    
	    
	}
	/// </summary> 
	
	/// <summary> 
	/// Funcion para obtener una sesion sin agendar
	/// </summary> 
	function obtenerSesionSinAgendar(){
		
		
	    //$array = $array = array('id_agenda' => NULL);
	    //$query = $this->db->from('sesion')->where($array)->get();
	    
	    $query1 = ('select sesion.id, sesion.checkin, sesion.pagada, sesion.id_servicio, sesion.id_usuario, sesion.id_agenda, sesion.ejecutada, usuario.nombre,
					usuario.apellido, servicio.descripcion from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on sesion.id_servicio = servicio.id
					where (sesion.id_agenda is NULL) ' ); //QUERY PARA OBTENER TODO DE UNA VEZ.
		$query = $this->db->query($query1);
		
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	    
	}
	
	
	/// <summary> 
	/// Funcion para obtener una sesion ejecutada y pagada
	/// </summary>
	function obtenerSesionEjecutadaPagada(){
		
		
	    //$array = $array = array('pagada' => TRUE, 'ejecutada' => TRUE);
	    //$query = $this->db->from('sesion')->where($array)->get();
	    
	    $query1 = ('select sesion.id, sesion.checkin, sesion.pagada, sesion.id_servicio, sesion.id_usuario, sesion.id_agenda, sesion.ejecutada, usuario.nombre,
					usuario.apellido, servicio.descripcion from sesion 
					Inner JOIN usuario
					on sesion.id_usuario = usuario.id
					Inner Join servicio
					on sesion.id_servicio = servicio.id
					where (sesion.pagada = TRUE) AND (sesion.ejecutada = TRUE)  ' ); //QUERY PARA OBTENER TODO DE UNA VEZ.
					
		$query = $this->db->query($query1);
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	    
	}
	
	
	//_____________________________
	
	
	
	/// <summary> 
	/// Funcion para obtener un usuario que sea especialista
	/// </summary>
	function obtenerUsuario_Especialista(){
		
		$user = 'user';
		
		$query = $this->db->from('usuario')->where('perfil',$user)->get();
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
		
	}
	
	
	
	/// <summary> 
	/// Funcion para obtener el ID del servicio por la descripcion
	/// </summary>
	function obtenerServicioID($descripcion){

	    $query = $this->db->get('servicio');
	    
	    if($query-> num_rows() > 0){
	        $row = $query->row($descripcion);
		if (isset($row))
			{
        	return $row->id;
			} 
	   }
	    else return false ;
	}
	
	
	/// <summary> 
	/// Funcion para obtener id de servicio por el id de la sesion
	/// </summary>
	function obtenerServicio($id_sesion){

	    $query = $this->db->from('sesion')->where('id',$id_sesion)->get();
	    
	    		if($query-> num_rows() > 0){
				return $query;
				}
	    
	   
	}
	
	
	/// <summary> 
	/// Funcion para obtener id de un usuario
	/// </summary>
	function usuarioID($id){
	
	$query = $this->db->from('usuario')->where('id',$id)->get();

			if($query-> num_rows() > 0){
				return $query;
				}
	
	}
	
	/// <summary> 
	/// Funcion para obtener id de un cliente
	/// </summary>
	function clienteID($id){
		
	$query = $this->db->from('cliente')->where('id',$id)->get();
			if($query-> num_rows() > 0){
				return $query;
				}	
		
	}
	
	
	/// <summary> 
	/// Funcion para obtener id de un servicio
	/// </summary>
	function servicioID($id){
		
		$query = $this->db->from('servicio')->where('id',$id)->get();
		if($query-> num_rows() > 0)
			{
			return $query;
			// SI SE MANDA A RETORNAR SOLO $QUERY , SE PUEDE UTILIZAR LOS ELEMENTOS DEL QUERY 
			// COMO usuarioID($data['sesion']->result()[0]->id_usuario POR EJEMPLO. 
			}
	
	}
	
	/// <summary> 
	/// Funcion para buscar y obtener id de un usuario
	/// </summary>
	function obtenerClienteID($cedula){

    $query = $this->db->get('cliente');
    if($query-> num_rows() > 0){
	    	
        $row = $query->row($cedula);

		if (isset($row))
		{
        	return $row->id;
		}
  
	    }else return false ;
	    
	}
	
	/// <summary> 
	/// Funcion para obtener un Especialista por su ID
	/// </summary>
	function obtenerUsuario_EspecialistaID($id){
	
	//$query = $this->db->from('sesion')->where('id',$id)->get();
	
		$user = 'user';
	    $query = $this->db->from('usuario')->where('perfil',$user)->get();
	    if($query-> num_rows() > 0){
	    	
	    	$row = $query->row($id);
	    	
	     if (isset($row))
			{
				//echo ('ESTE ES EL ID'.' '.$row->id.'-     ');
        	return $row->id; }
		}
	    else return false ;
	    
	}
	
	/// <summary> 
	/// Funcion para actualizar Sesion
	/// </summary>
	function actualizarSesion($id,$data){
		
		if($data['checkin']==NULL){
		
		$data['checkin'] = FALSE ;
		
		}else 	$data['checkin'] = TRUE;
			
		if($data['pagada']==NULL){
			
			$data['pagada'] = FALSE ;
			
		}else 	$data['pagada'] = TRUE;
		
		if($data['ejecutada']==NULL){
			
			$data['ejecutada'] = FALSE ;
			
		}else 	$data['ejecutada'] = TRUE;
		
		
		$this->db->where('id',$id);
		$query = $this->db->update('sesion',array( 'checkin'=>$data['checkin'],'pagada'=>$data['pagada'],'ejecutada'=>$data['ejecutada']));
									
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
	/// Funcion para eliminar Sesion
	/// </summary>
	function eliminarSesion($id){
		
		$query1 = $this->db->from('agenda')->where('id_sesion',$id)->get(); //QUERY PARA OBTENER TODO DE UNA VEZ.
					
		if ( ($query1->num_rows() ) == 0 )
		{
		
		$query = $this->db->delete('sesion',array('id'=>$id));
	
		if($query==false){
			echo "<script> alert('No se ha eliminado la sesion'); </script>";
		}
			else{ 
			echo "<script> alert('Se ha eliminado la sesion'); </script>";
			}
		}else
		echo "<script> alert('No se puede eliminar la sesion, ya tiene una agenda asignada'); </script>";
	}
	
}

?>