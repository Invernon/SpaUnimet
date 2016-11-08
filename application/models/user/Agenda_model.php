<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/// <summary> 
	/// Modelo de las Agendas
	/// </summary> 
    
class Agenda_model extends CI_Model {
	

    
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
	
	function crearAgenda($data){ 
	/// <summary>
	/// Funcion que permite crear una agenda
	$resultado = $this->db->insert('agenda',array('fecha'=>$data['fecha'], 'hora_inicio'=>$data['hora_inicio'],  
									'hora_finalizacion'=>$data['hora_finalizacion'], 'id_usuario'=>$data['id_usuario'],
									'id_sesion'=>$data['id_sesion']
									));
	
	   if($resultado == TRUE){
	       
	       
	       $agenda = $this->db->select('*')->from('agenda')->get();
	       $row = $agenda->last_row();
	       $intento = $this->db->select('id_sesion')->from('agenda')->where('id',($row->id))->get()->last_row();
	       
	       //print_r ($intento);
	       $this->db->where('id',($intento->id_sesion));
		   $query = $this->db->update('sesion',array('id_agenda'=>($row->id)));
		
	     	       echo "<script> alert('Registro de agenda completado !');
	       </script>";
	       
	       
	   }
	/// </summary>
	}
	function obtenerAgendas_dia($año,$mes,$dia){
		
		$fecha = $año.'-'.$mes.'-'.$dia;
		
		$this->db->select('agenda.id as id, agenda.hora_inicio as hora_inicio , agenda.hora_finalizacion as hora_finalizacion, 
							agenda.fecha as fecha , agenda.id_usuario as id_usuario , usuario.nombre as nombre , usuario.apellido as apellido');
		$this->db->from('agenda');
		
		$this->db->join('sesion', 'sesion.id = agenda.id_sesion');
		$this->db->join('usuario','usuario.id=sesion.id_usuario');
		$this->db->where('fecha =',$fecha);
		$query= $this->db->get();
		
		if($query-> num_rows() > 0) return $query->result_array();
	}
	
	function obtenerAgenda(){
		
	/// <summary>
		
		$query1 =('Select agenda.id as id, agenda.hora_inicio as hora_inicio, agenda.hora_finalizacion as hora_finalizacion, 
					agenda.fecha as fecha , agenda.id_usuario as id_usuario, usuario.nombre as nombre , usuario.apellido as apellido
					From agenda, sesion, usuario
					Where agenda.id_sesion = sesion.id and usuario.id = sesion.id_usuario');
	
		$query = $this->db->query($query1);
	    //$query = $this->db->get('agenda');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	// Funcion para obtener una agenda    
	/// </summary> 
	}
	   
	function obtenerAgendas($id){
  
	/// <summary> 
	/// Funcion que te permite obtener una lista de agendas
	/// </summary> 
	    //$this->db->where('id',$id);
	    //$query = $this->db->from('agenda')->where('id',$id)->get();
	    
	    $this->db->select('agenda.hora_inicio , agenda.hora_finalizacion, agenda.fecha , agenda.id_usuario ,
	    usuario.nombre as nombre , usuario.apellido as apellido');
		$this->db->from('agenda');
		$this->db->join('sesion', 'sesion.id = agenda.id_sesion');
		$this->db->join('usuario','usuario.id=sesion.id_usuario');
		$query = $this->db->get();
	    
	    
	    if($query-> num_rows() > 0){
	        
	       return $query;
	   }
	    else return false ;
	    
	}
	
	function obtenerAgendaNoEjecutadas(){
		
	/// <summary>
		
		$query1 =('Select agenda.id as id, agenda.hora_inicio as hora_inicio, agenda.hora_finalizacion as hora_finalizacion, 
					agenda.fecha as fecha , agenda.id_usuario as id_usuario, usuario.nombre as nombre , usuario.apellido as apellido
					From agenda, sesion, usuario
					Where (agenda.id_sesion = sesion.id and usuario.id = sesion.id_usuario) AND sesion.ejecutada = TRUE');
	
		//$this->db->select('*');
		//$this->db->from('agenda');
		//$this->db->join('sesion', 'sesion.id = agenda.id_sesion');
		//$this->db->join('usuario','usuario.id = sesion.id_usuario');
		//$this->db->where('sesion.ejecutada',FALSE);
		$query = $this->db->query($query1);
	    //$query = $this->db->get('agenda');
	    if($query-> num_rows() > 0) return $query->result_array();
	    else return false ;
	// Funcion para obtener una agenda    
	/// </summary> 
	}
	
	

	
	function actualizarAgenda($id,$data){
		
		//$datos=array('fecha'=>$data['fecha'],'hora_inicio'=>$data['hora_inicio'],'hora_finalizacion'=>$data['hora_finalizacion']);
		
		/// <summary> 
		/// Funcion que permite actualizar agendas
		/// </summary> 
		
		$this->db->where('id',$id);
		$query = $this->db->update('agenda',array('fecha'=>$data['fecha'],'hora_inicio'=>$data['hora_inicio'],'hora_finalizacion'=>$data['hora_finalizacion']));
		if($query == TRUE){
	       
	       echo "<script> alert('Agenda Actualizada!');
	       </script>";
	   }
	   else
	   {
	   	echo "<script> alert('NO SE COMPLETO');</script>" ;
	   }
		
	}

	
	function eliminarEspecialista($id){
		
		/// <summary> 
		/// Funcion que elminina a un especialista
		/// </summary> 
		
		$this->db->delete('especialista',array('id'=>$id));
		$query = $this->db->from('especialista')->where('id',$id)->get();
		if($query==false){
			echo "<script> alert('Se ha eliminado el especialista.'); </script>";
		}
		else{ 
		echo "<script> alert('Se ha eliminado el especialista'); </script>";
		}
	}
	
	///<summary>
	/// Obteniendo los dias que se tengan agendados
	///</summary>
	function obtener_eventos($año,$mes){
		
		if($mes == 1 || $mes == 3 || $mes == 5 || $mes == 7 || $mes == 8 || $mes == 10 || $mes == 12 ){
			$dia = 31 ; 
		}else $dia = 30 ; 
		
		$inicio_mes = $año.'-'.$mes.'-1';
		$fin_mes = $año.'-'.$mes.'-'.$dia;
		
		$this->db->where('fecha >=',$inicio_mes);
		$this->db->where('fecha <=',$fin_mes);
		$query= $this->db->get('agenda');
		
		//print_r ( $query-> num_rows() );
		
		
		
		$fechas = array();
		$i=0;
		foreach ($query->result() as $row)
				{
				$string =	$row->fecha ;
				$timestamp = strtotime($string);
				$ver = array('administrador','ver_agenda_dia', $año ,$mes ,date("d", $timestamp) );
				$fechas[date("d", $timestamp)] = site_url($ver) ;
				
				}
				
	return($fechas);
		
	}	
	
	function obtener_eventos_user($año,$mes,$id){
		
		if($mes == 1 || $mes == 3 || $mes == 5 || $mes == 7 || $mes == 8 || $mes == 10 || $mes == 12 ){
			$dia = 31 ; 
		}else $dia = 30 ; 
		
		$inicio_mes = $año.'-'.$mes.'-1';
		$fin_mes = $año.'-'.$mes.'-'.$dia;
		
		$this->db->where('fecha >=',$inicio_mes);
		$this->db->where('fecha <=',$fin_mes);
		$query= $this->db->get('agenda');
		
		//print_r ( $query-> num_rows() );
		
		
		
		$fechas = array();
		$i=0;
		foreach ($query->result() as $row)
				{
				$string =	$row->fecha ;
				$timestamp = strtotime($string);
				$ver = array('usuario','ver_agenda_dia', $año ,$mes ,date("d", $timestamp) );
				$fechas[date("d", $timestamp)] = site_url($ver) ;
				
				}
				
	return($fechas);
		
	}
	
}

?>