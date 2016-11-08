<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// <summary> 
/// Controlador de la clase Manager
/// </summary>  
class Manager extends Welcome {

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
    $this->load->model('/manager/Usuario_model');
    $this->load->model('/manager/Especialistas_model');
    $this->load->model('/manager/Cliente_model');
    $this->load->model('/manager/Servicio_model');
    $this->load->library('session');
 	$this->load->model('/manager/Sesion_model');
	$this->load->model('/login/Login_model');
	$this->load->model('/manager/Agenda_model');
    
	} 
	 
public function index()
	{	
		$this->load->view('manager/principal');
	}


//--------------------INICIO AGENDA

/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  
public function agenda()
	{	
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de agenda
		/// </summary> 
		$this->load->view('manager/agenda/agenda_header');
		$this->load->view('manager/agenda/agenda');
		
	}		
	
	
/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  	
public function nueva_agenda()
	{	
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de nueva agenda
		/// </summary> 
		$this->load->view('manager/agenda/agenda_header');
		$this->load->view('manager/agenda/nueva_agenda');
	}	

/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  		
public function recibir_nueva_agenda()
	{
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de nueva agenda y 
		/// recive los datos del formulario que son enviados a la base de datos para crear la nueva agenda
		/// </summary> 
		
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('hora_inicio', 'Hora_inicio', 'required');
		$this->form_validation->set_rules('id_sesion', 'Id_sesion', 'required');
		
		if ($this->form_validation->run() == FALSE)
                {
                	echo "<script> alert('Todos los campos son obligatorios!');
	    			</script>";
	    			$this->load->view('manager/agenda/agenda_header');
					$this->load->view('manager/agenda/nueva_agenda');
	    			
	    			/* referencia
                	$this->load->view('manager/clientes/clientes_header');
                    $this->load->view('manager/clientes/nuevo_cliente');*/
                    
                }
        else
                {
         
         
            
    		$data['sesion'] = $this->Sesion_model->obtenerServicio($this->input->post("id_sesion"));//Obtenemos el id del servicio que corresponde con la sesion
            
        	$data['servicio'] = $this->Servicio_model->obtenerDuracion($data['sesion']->result()[0]->id_servicio);//Obtenemos la duracion del servicio 
            
        	$time = strtotime($this->input->post("hora_inicio"));//funcion de php que permite convertir un string en un dato tipo tiempo
        	 
        	$duracionservicio = "+".$data['servicio']->result()[0]->duracion. "minutes"; //string que se usa para sumarle la duracion al tiempo inicial
		
            $hora_finalizacion = date("H:i", strtotime( $duracionservicio, $time)); //hora de finalizacion que resulta de agregarle la duracion del servicio al tiempo inicial
            
            $data = array (
				'fecha' => $this->input->post("fecha"),
				'hora_inicio' => $this->input->post("hora_inicio"),
				'hora_finalizacion' => $hora_finalizacion,
				'id_sesion'=> $this->input->post("id_sesion"),
				'id_usuario'=> 7
				
			);
			
			if ( ($respuesta = $this->Agenda_model->crearAgenda($data)) == FALSE ) {
				
				$this->load->helper('url');
            	redirect('manager/agenda','refresh');
			}
			else
				$this->load->helper('url');
            	redirect('manager/agenda','refresh');
	       	}
	}
	
			
/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  	
public function ver_agenda() {
		
		$data['id'] = $this->uri->segment(3);
		$data['agenda'] = $this->Agenda_model->obtenerAgendas($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/agenda/agenda_header');
		$this->load->view('manager/agenda/ver_agenda',$data);
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de ver agenda y 
		/// conseguir el ID y la Agenda que se va a ver
		/// </summary> 
		
	}		


/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  		
public function lista_agendas()
{
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de lista agenda y 
		/// permite cargar las agendas
		/// </summary> 
		
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['agenda'] = $this->Agenda_model->obtenerAgenda();
		
			
		}
		else{
			$data['agenda'] = $this->Agenda_model->obtenerAgendas($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/agenda/agenda_header');
        $this->load->view('manager/agenda/lista_agendas',$data);
}	



public function lista_agendasNoEjecutadas()
{
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de lista agenda y 
		/// permite cargar las agendas
		/// </summary> 
		
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['agenda'] = $this->Agenda_model->obtenerAgendaNoEjecutadas();
		
			
		}
		else{
			$data['agenda'] = $this->Agenda_model->obtenerAgendas($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/agenda/agenda_header');
        $this->load->view('manager/agenda/lista_agendasNoEjecutadas',$data);
}	






/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  	
public function actualizar_agenda(){
		
		/// <summary> 
		/// Sirve para actualizar los datos de una agenda, recibe los parametros y los actualiza. 
		/// Una vez actualizados los redirije a lista agendas
		/// </summary> 
		$data = array (
				'fecha' => $this->input->post("fecha"),
				'hora_inicio' => $this->input->post("hora_inicio"),
				'hora_finalizacion' => $this->input->post("hora_finalizacion")
			
		);
		$this->Agenda_model->actualizarAgenda($data['id'] = $this->uri->segment(3),$data);
		$this->load->helper('url');
        redirect('manager/lista_agendas','refresh');
	
}


/// <summary> 
/// Funcion perteneciente a agenda
/// </summary>  	
public function editar_agenda() {
		
		$data['id'] = $this->uri->segment(3);
		$data['agenda'] = $this->Agenda_model->obtenerAgendas($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/agenda/agenda_header');
		$this->load->view('manager/agenda/editar_agenda',$data);
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de editar agenda y 
		/// conseguir el ID y la Agenda que se va a modificar
		/// </summary> 
		
	}	
	


/////////////FIN AGENDA


//--------------Inicio Clientes

/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 
public function clientes()
	{	
		/// <summary> 
		/// Sirve para cargar las vistas del header de clientes y de clientes 
		/// </summary> 
		$this->load->view('manager/clientes/clientes_header');
		$this->load->view('manager/clientes/clientes');
	}

/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 	
public function nuevo_cliente()
	{	
		
		/// <summary> 
		/// Sirve para cargar las vistas del header de clientes y de nuevo cliente
		/// </summary> 
		$this->load->view('manager/clientes/clientes_header');
		$this->load->view('manager/clientes/nuevo_cliente');
	}	

/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 
public function recibir_nuevo_cliente(){
		
/// <summary> 
/// Sirve para cargar las vistas del header de clientes y de nuevo cliente y 
/// recive los datos del formulario que son enviados a la base de datos para crear la nueva cliente
/// </summary> 	

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
		$this->form_validation->set_rules('cedula', 'Cedula', 'required');
	
	
		if ($this->form_validation->run() == FALSE)
                {
                	echo "<script> alert('Todos los campos son obligatorios!');
	    			</script>";
                	$this->load->view('manager/clientes/clientes_header');
                    $this->load->view('manager/clientes/nuevo_cliente');
                }
        else
                 {
                	
            $data = array (
				'nombre' => $this->input->post("nombre"),
				'apellido' => $this->input->post("apellido"),
				'telefono' => $this->input->post("telefono"),
				'cedula' => $this->input->post("cedula"),
			);
			
			if ( ($respuesta = $this->Cliente_model->crearCliente($data)) == FALSE ) {
				
				$this->load->helper('url');
            	redirect('manager/nuevo_cliente','refresh');
			}
			else
				$this->load->helper('url');
            	redirect('manager/lista_clientes','refresh');
	       	}
	}

/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 	
public function lista_clientes()
{
/// <summary> 
/// Sirve para cargar las vistas del header de clientes y de lista clientes y 
/// permite cargar los clientes
/// </summary> 		

		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['cliente'] = $this->Cliente_model->obtenerClientes();
		}
		else{
			$data['cliente'] = $this->Cliente_model->obtenerClientes($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/clientes/clientes_header');
        $this->load->view('manager/clientes/lista_clientes',$data);
}


/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 
public function editar_cliente() {
	
/// <summary> 
/// Sirve para cargar las vistas del header de clientes y de editar cliente y 
/// setea los parametros adquiridos en clientes
/// </summary> 	
		$data['id'] = $this->uri->segment(3);
		$data['cliente'] = $this->Cliente_model->obtenerCliente($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/clientes/clientes_header');
		$this->load->view('manager/clientes/editar_cliente',$data);
	}


/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 	
public function ver_cliente() {
	
/// <summary> 
/// Sirve para cargar las vistas del header de clientes y de ver cliente y 
/// buscando con los parametros otorgados
/// </summary> 		
		$data['id'] = $this->uri->segment(3);
		$data['cliente'] = $this->Cliente_model->obtenerCliente($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/clientes/clientes_header');
		$this->load->view('manager/clientes/ver_cliente',$data);
	}


/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 
public function actualizar_cliente(){

/// <summary> 
/// dados los parametros en editar cliente los actualiza en el cliente respectivo
///tambien recarga lista clientes
/// </summary> 				
		$data = array (
				'nombre' => $this->input->post("nombre"),
				'apellido' => $this->input->post("apellido"),
				'telefono' => $this->input->post("telefono"),
				'cedula' => $this->input->post("cedula")
		);
		$this->Cliente_model->actualizarCliente($data['id'] = $this->uri->segment(3),$data);
		$this->load->helper('url');
        redirect('manager/lista_clientes','refresh');
}


/// <summary> 
/// Funcion perteneciente a clientes
/// </summary> 
public function busqueda_cliente() {
		
/// <summary> 
/// Sirve para cargar las vistas del header de clientes y de busqueda nombre y 
/// permite buscar un cliente por su nombre 
/// </summary> 		
		$data = array (
				'nombre' => $this->input->post("nombre"),
				'tipo' => $this->input->post("perfil")
		);
		
		$usuario['usuario'] = $this->Cliente_model->obtenerClientesBusqueda($data);
		
			if($usuario['usuario'] == FALSE){
				
				$this->load->helper('url');
        		$this->load->view('manager/clientes/clientes_header');
				$this->load->view('manager/clientes/busqueda_nombreNO');
				
			}
			else{
					$this->load->helper('form');
			        $this->load->view('manager/clientes/clientes_header');
					$this->load->view('manager/clientes/busqueda_nombre',$usuario);
				
			}
	}
	



//--------------Fin Clientes





//--------------Inicio Especialistas

/// <summary> 
/// Funcion perteneciente a especialistas
/// </summary> 
public function especialistas()
	{	
		
/// <summary> 
/// Sirve para cargar las vistas del header de especialistas y de especialistas
/// </summary> 	
		$this->load->view('manager/especialistas/especialistas_header');
		$this->load->view('manager/especialistas/especialistas');
	}

/// <summary> 
/// Funcion perteneciente a especialistas
/// </summary> 
public function lista_especialistas(){
	
/// <summary> 
/// Sirve para cargar las vistas del header de especialistas y de lista especialistas y 
/// permite cargar los especialistas
/// </summary> 		
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['especialista'] = $this->Especialistas_model->obtenerEspecialistas();
		}
		else{
			$data['especialista'] = $this->Especialistas_model->obtenerEspecialistas($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/especialistas/especialistas_header');
        $this->load->view('manager/especialistas/lista_especialistas',$data);
}

/// <summary> 
/// Funcion perteneciente a especialistas
/// </summary> 	
public function ver_especialista() {
	
/// <summary> 
/// Sirve para cargar las vistas del header de especialistas y de ver especialista y 
/// buscando con los parametros otorgados
/// </summary>	
		$data['id'] = $this->uri->segment(3);
		$data['especialista'] = $this->Especialistas_model->obtenerEspecialista($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/especialistas/especialistas_header');
		$this->load->view('manager/especialistas/ver_especialista',$data);
	}


	
	
//------------------Fin especialista	
	
	
	
	
//------------------INICIO SERVICIOS		
	
/// <summary> 
/// Funcion perteneciente a servicios
/// </summary> 
public function servicios()
	{	
/// <summary> 
/// Sirve para cargar las vistas del header de servicios y de servicios 
/// </summary>	
		$this->load->view('manager/servicios/servicios_header');
		$this->load->view('manager/servicios/servicios');
	}


/// <summary> 
/// Funcion perteneciente a servicios
/// </summary> 	
public function lista_servicios(){
	
/// <summary> 
/// Sirve para cargar las vistas del header de servicios y de lista servicios y 
/// permite cargar los servicios
/// </summary> 		
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['servicio'] = $this->Servicio_model->obtenerServicios();
		}
		else{
			$data['servicio'] = $this->Servicio_model->obtenerServicios($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/servicios/servicios_header');
        $this->load->view('manager/servicios/lista_servicios',$data);
}

/// <summary> 
/// Funcion perteneciente a servicios
/// </summary> 
public function editar_servicio() {
	
/// <summary> 
/// Sirve para cargar las vistas del header de servicios y de editar servicio y 
/// setea los parametros adquiridos en servicio
/// </summary> 			
		$data['id'] = $this->uri->segment(3);
		$data['servicio'] = $this->Servicio_model->obtenerServicio($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/servicios/servicios_header');
        $this->load->view('manager/servicios/editar_servicio',$data);
	}
	
/// <summary> 
/// Funcion perteneciente a servicios
/// </summary> 	
public function actualizar_servicio(){
/// <summary> 
/// dados los parametros en editar servicio los actualiza en el servicio respectivo
///tambien recarga lista servicio
/// </summary>		
		$data = array (
				'descripcion' => $this->input->post("descripcion"),
				'duracion' => $this->input->post("duracion"),
				'precio' => $this->input->post("precio"),
				'tipo' => $this->input->post("tipo"),
				'activo' => $this->input->post("activo"),
				'equipo' => $this->input->post("equipo")
			);
		$this->Servicio_model->actualizarServicio($data['id'] = $this->uri->segment(3),$data);
		$this->load->helper('url');
        redirect('manager/lista_servicios','refresh');
	
}

/// <summary> 
/// Funcion perteneciente a servicios
/// </summary> 
public function ver_servicio() {
	
/// <summary> 
/// Sirve para cargar las vistas del header de servicios y de ver servicio y 
/// buscando con los parametros otorgados
/// </summary>		
		$data['id'] = $this->uri->segment(3);
		$data['servicio'] = $this->Servicio_model->obtenerServicio($data['id']);
		
		if( ($data['servicio']->result()[0]->activo)=='t'){
			
				$data['servicio']->result()[0]->activo = 'Activo';
		}
		elseif( ($data['servicio']->result()[0]->activo)=='f'){
			
				$data['servicio']->result()[0]->activo = 'Inactivo';
		}
		
		if( ($data['servicio']->result()[0]->equipo)=='t'){
			
				$data['servicio']->result()[0]->equipo = 'Si usa';
		}
		elseif( ($data['servicio']->result()[0]->equipo)=='f'){
			
				$data['servicio']->result()[0]->equipo = 'No usa';
		}
		
		$this->load->helper('form');
		$this->load->view('manager/servicios/servicios_header');
		$this->load->view('manager/servicios/ver_servicio',$data);
	}



//------------------FIN SERVICIOS	



//------------------INICIO SESIONES	

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function sesiones()
	{	
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de sesiones
/// </summary>
		$this->load->view('manager/sesiones/sesiones_header');
		$this->load->view('manager/sesiones/sesiones');
	}
	
/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function nueva_sesion() {
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de nueva sesion y
/// carga el formulario que se usara para crear una sesion
/// </summary>

		//poner metodo para obtener la lista de servicios y colocarlos en un array
		$data['servicio'] = $this->Servicio_model->obtenerServicios();
		$data['cliente'] = $this->Cliente_model->obtenerClientes();
		$data['especialista'] = $this->Sesion_model->obtenerUsuario_Especialista();
	
		
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
		$this->load->view('manager/sesiones/nueva_sesion',$data);
		
	}

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 	
public function recibir_nueva_sesion(){
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de nueva sesion
/// y crea el formulario que se usara para la nueva sesion
/// </summary>	
		$this->form_validation->set_rules('idcliente', 'Idcliente', 'required');
		$this->form_validation->set_rules('idusuario', 'Idusuario', 'required');
		$this->form_validation->set_rules('idservicio', 'Precio', 'required');
		//$this->form_validation->set_rules('idagenda', 'Idagenda', 'required');
		
	
		if ($this->form_validation->run() == FALSE)
                {
                	echo "<script> alert('Todos los campos son obligatorios!');
	    			</script>";
                	$this->load->view('manager/sesiones/sesiones_header');
					$this->load->view('manager/sesiones/nueva_sesion');
                }
        else
                {
            //Buscamos los ID, a partir de los values seleccionados.     
            
            $descripcion = $this->input->post("idservicio");     	
            $idservicio= $this->Sesion_model->obtenerServicioID($descripcion); 
            
            $cliente = $this->input->post("idcliente");     	
            $idcliente= $this->Sesion_model->obtenerClienteID($cliente); 
            
            $especialista = $this->input->post("idusuario");     	
            $idusuario= $this->Sesion_model->obtenerUsuario_EspecialistaID($especialista); 
            
            // FIN CAMBIO DE VARIABLES A ID_XXX;    	
            
            
            $cedula = $this->input->post("idcliente");
            $idcliente = $this->Sesion_model->obtenerClienteID($cedula);
                 	
                	
            $data = array (
				//'checkin' => $this->input->post("checkin"),
				//'checkin' => $this->input->post("checkin"),
				//'idcliente' => $this->input->post("idcliente"),
				//'idservicio' => $this->input->post("idservicio"),
				//'idagenda' => $this->input->post("idagenda"),
				'pagada' => $this->input->post("pagada"),
				'idcliente' => $idcliente,
				'idusuario' => $idusuario,
				'idservicio' => $idservicio,
				
				'ejecutada' => NULL
			);
			
			$this->Sesion_model->crearSesion($data);
				$this->load->helper('url');
            	redirect('manager/sesiones','refresh');
	       	}
}	

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function lista_sesiones(){

/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de lista sesiones y 
/// permite cargar las sesiones
/// </summary> 		

		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['sesion'] = $this->Sesion_model->obtenerSesion();
		}
		else{
			$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['segmento']);
		}
		
		//echo $this->Sesion_model->usuarioID($data['sesion']->result_array()[0]->id_usuario) ;
		
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
        $this->load->view('manager/sesiones/lista_sesiones',$data);
}

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function editar_sesion() {
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de editar sesion y 
/// setea los parametros adquiridos en sesiones
/// </summary> 		
		$data['id'] = $this->uri->segment(3);
		$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['id']);
		$data['servicio'] = $this->Servicio_model->obtenerServicios();
		$data['usuario'] = $this->Sesion_model->usuarioID($data['sesion']->result()[0]->id_usuario);
		$data['cliente'] = $this->Sesion_model->clienteID($data['sesion']->result()[0]->id_cliente);
		
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
		$this->load->view('manager/sesiones/editar_sesion',$data);
	}
	
/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 	
public function ver_sesion() {
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de ver sesion y 
/// buscando con los parametros otorgados
/// </summary>		
		$data['id'] = $this->uri->segment(3);
		$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['id']);
		//echo ('ESTE ES EL ID DEL USUARIO'.$data['sesion']->result()[0]->id_usuario);
		$data['usuario'] = $this->Sesion_model->usuarioID($data['sesion']->result()[0]->id_usuario);
		$data['cliente'] = $this->Sesion_model->clienteID($data['sesion']->result()[0]->id_cliente);
		$data['servicio'] = $this->Sesion_model->servicioID($data['sesion']->result()[0]->id_servicio);
 
		if( ($data['sesion']->result()[0]->checkin)=='t'){
			
				$data['sesion']->result()[0]->checkin = 'Check In - Verificado';
		}
		elseif( ($data['sesion']->result()[0]->checkin)=='f'){
			
				$data['sesion']->result()[0]->checkin = 'Check In - No Verificado';
		}
		
		if( ($data['sesion']->result()[0]->pagada)=='t'){
			
				$data['sesion']->result()[0]->pagada = 'Pagada';
		}
		elseif( ($data['sesion']->result()[0]->pagada)=='f'){
			
				$data['sesion']->result()[0]->pagada = 'No Pagada';
		}
		
		if( ($data['sesion']->result()[0]->ejecutada)=='t'){
			
				$data['sesion']->result()[0]->ejecutada = 'Ejecutada';
		}
		elseif( ($data['sesion']->result()[0]->ejecutada)=='f'){
			
				$data['sesion']->result()[0]->ejecutada = 'No Ejecutada';
		}
		
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
		$this->load->view('manager/sesiones/ver_sesion',$data);
	}
	
/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function actualizar_sesion(){
/// <summary> 
/// dados los parametros en editar sesion los actualiza en la sesion respectiva
///tambien recarga lista sesiones
/// </summary>		
		$data = array (
				'checkin' => $this->input->post("checkin"),
				'pagada' => $this->input->post("pagada"),
				'idcliente' => $this->input->post("idcliente"),
				'idusuario' => $this->input->post("idusuario"),
				'idservicio' => $this->input->post("idservicio"),
				'ejecutada' => $this->input->post("ejecutada")
		);
		$this->Sesion_model->actualizarSesion($data['id'] = $this->uri->segment(3),$data);
		$this->load->helper('url');
        redirect('manager/lista_sesiones','refresh');
	
}

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 	
public function eliminar_sesion() {
/// <summary> 
/// Sirve para eliminar una sesion dado los parametros otrogados y recarga la lista sesiones
/// </summary>		
		$data['id'] = $this->uri->segment(3);
		$this->Sesion_model->eliminarSesion($data['id']);
		$this->load->helper('url');
        redirect('manager/lista_sesiones','refresh');
	}	
	
	
	
	
	
/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function sesiones_ejecutadas(){

/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de sesiones ejecutadas 
/// </summary> 			
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['sesion'] = $this->Sesion_model->obtenerSesionEjecutada();
		}
		else{
			$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['segmento']);
		}
		
	//	echo $this->Sesion_model->usuarioID($data['sesion']->result_array()[0]->id_usuario) ;
	//	$data['usuario'] = $this->Sesion_model->usuarioID($data['sesion'].id_usuario);
	//	$data['cliente'] = $this->Sesion_model->clienteID($data['sesion']->result()[0]->id_cliente);
		
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
        $this->load->view('manager/sesiones/sesiones_ejecutadas',$data);
}

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function sesiones_sinagenda(){
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de sesiones sin agenda 
/// </summary> 			
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['sesion'] = $this->Sesion_model->obtenerSesionSinAgendar();
		}
		else{
			$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
        $this->load->view('manager/sesiones/sesiones_sinagenda',$data);
}

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function sesiones_ejecutadaspagadas(){
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de sesiones pagadas 
/// </summary> 			
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['sesion'] = $this->Sesion_model->obtenerSesionEjecutadaPagada();
		}
		else{
			$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
        $this->load->view('manager/sesiones/sesiones_ejecutadaspagadas',$data);
}
	

//------------------FIN SESIONES



	
//------------------INICIO AGENDAR		

/// <summary> 
/// Funcion perteneciente a sesiones
/// </summary> 
public function agendar_sesion(){
/// <summary> 
/// Sirve para cargar las vistas del header de sesiones y de agendado 
/// y permite agendar la sesion
/// </summary> 		
	$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['sesion'] = $this->Sesion_model->obtenerSesion();
		}
		else{
			$data['sesion'] = $this->Sesion_model->obtenerSesiones($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/sesiones/sesiones_header');
        $this->load->view('manager/sesiones/agendar_sesion',$data);

}	
	
	
	
//------------------FIN AGENDAR		
	
	
//--------INICIO USUARIOS	
	

/// <summary> 
/// Funcion perteneciente a usuarios
/// </summary> 
public function usuarios()
	{
	/// <summary> 
	/// Sirve para cargar las vistas del header de usuarios y de usuarios 
	/// </summary>	
		$this->load->view('manager/usuarios/usuarios_header');
		$this->load->view('manager/usuarios/usuarios');
	}
	
/// <summary> 
/// Funcion perteneciente a usuarios
/// </summary> 
public function ver_usuario() {
/// <summary> 
/// Sirve para cargar las vistas del header de usuarios y de ver usuario y 
/// buscando con los parametros otorgados
/// </summary>		
		$data['id'] = $this->uri->segment(3);
		$data['usuario'] = $this->Usuario_model->obtenerUsuario($data['id']);
		$this->load->helper('form');
		$this->load->view('manager/usuarios/usuarios_header');
		$this->load->view('manager/usuarios/ver_usuario',$data);
	}
	
/// <summary> 
/// Funcion perteneciente a usuarios
/// </summary> 
public function busqueda_nombre() {
/// <summary> 
/// Sirve para cargar las vistas del header de usuarios y de busqueda nombre y 
/// permite buscar un usuario por su nombre 
/// </summary>
		
		$data = array (
				'nombre' => $this->input->post("nombre"),
				'tipo' => $this->input->post("perfil")
		);
		
		$usuario['usuario'] = $this->Usuario_model->obtenerUsuariosBusqueda($data);
		
			if($usuario['usuario'] == FALSE){
				
				$this->load->helper('url');
        		$this->load->view('manager/usuarios/usuarios_header');
				$this->load->view('manager/usuarios/busqueda_nombreNO');
				
			}
			else{
					$this->load->helper('form');
			        $this->load->view('manager/usuarios/usuarios_header');
					$this->load->view('manager/usuarios/busqueda_nombre',$usuario);
				
			}
	}

/// <summary> 
/// Funcion perteneciente a usuarios
/// </summary> 	
public function lista_usuarios(){
/// <summary> 
/// Sirve para cargar las vistas del header de usuarios y de lista usuarios y 
/// permite cargar los usuarios
/// </summary> 		
		$data['segmento'] = $this->uri->segment(3);
		
		if(!$data['segmento']){
			$data['usuario'] = $this->Usuario_model->obtenerUsuarios();
		}
		else{
			$data['usuario'] = $this->Usuario_model->obtenerUsuarios($data['segmento']);
		}
		$this->load->helper('form');
		$this->load->view('manager/usuarios/usuarios_header');
        $this->load->view('manager/usuarios/lista_usuarios',$data);
}
	
	
	
	
//--------FIN USUARIOS		
	
//------------Calendario INICIO	
	
/// <summary> 
/// Funcion perteneciente a agenda 
/// </summary> 
public function ver_agenda_dia(){
/// <summary> 
/// Permite ver el dia en el calendario
/// </summary> 
	
	$data['año'] = $this->uri->segment(3);
	$data['mes'] = $this->uri->segment(4);
	$data['dia'] = $this->uri->segment(5);
	
		$data['agenda'] = $this->Agenda_model->obtenerAgendas_dia($data['año'],$data['mes'],$data['dia']);
		$this->load->helper('form');
		$this->load->view('administrador/agenda/agenda_header');
		$this->load->view('administrador/agenda/ver_agenda_dia',$data);

}	
	
	
/// <summary> 
/// Funcion perteneciente a agenda 
/// </summary> 
public function calendario(){
	
	
	/// <summary> 
	/// Permite trabajar con el calendario  
	// Tambien sirve para cargar las vistas del header de agenda y de calendario 
	/// </summary> 
	/*$prefs = array(
        'start_day'    => 'lunes',
        'month_type'   => 'long',
        'day_type'     => 'abr'

	); */
	
	
	$prefs['template'] = '
		{table_open}<table cellpadding="5" cellspacing="5">{/table_open}

		{heading_row_start}<tr>{/heading_row_start}

		{heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
		{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
		{heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
		
		{heading_row_end}</tr>{/heading_row_end}
		
		//Deciding where to week row start
		{week_row_start}<tr class="week_name" >{/week_row_start}
		
		//Deciding  week day cell and  week days
		{week_day_cell}<td >{week_day}</td>{/week_day_cell}
		//week row end
		{week_row_end}</tr>{/week_row_end}
		
		{cal_row_start}<tr>{/cal_row_start}
		{cal_cell_start}<td>{/cal_cell_start}
		
		{cal_cell_content}<a href="{content}" style="background:yellow;">{day}</a>{/cal_cell_content}
		{cal_cell_content_today}<div class="highlight"> <a href="{content}">{day}</a> </div>{/cal_cell_content_today}
		
		{cal_cell_no_content}{day}{/cal_cell_no_content}
		{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
		
		{cal_cell_blank}&nbsp;{/cal_cell_blank}
		
		
		{cal_cell_end}</td>{/cal_cell_end}
		{cal_row_end}</tr>{/cal_row_end}
		{table_close}</table>{/table_close}
		';
		
		$prefs['day_type'] = 'short';
		$prefs['show_next_prev'] = true;
		$prefs['next_prev_url'] = 'https://spaunimet-jinvernon.c9users.io/spaunimetci/manager/calendario/';
		
		$data = array(
		'year' => $this->uri->segment(3),
		'month' => $this->uri->segment(4)
		);
		
		if ( $this->uri->segment(4) == NULL ){
	
			$data['dias'] = $this->Agenda_model->obtener_eventos( date('Y') , date('m') );
			
		}
		else{
			
			$data['dias'] = $this->Agenda_model->obtener_eventos( $this->uri->segment(3) , $this->uri->segment(4) );
			
		}
		
		
		//$eventos = $this->Agenda_model->obtener_evento($this->uri->segment(3),$this->uri->segment(4));
		//$query = $this->db->select('*')->from('agenda')->like('fecha', "$year-$month", 'after')->get(); 
		// $query = $this->db->from('usuario')->like($data['tipo'], $data['nombre'], 'both')->get();
		//$query = $this->db->select('*')->from('agenda')->where(fecha::text like '$año-$mes')->get(); 
	
		$this->load->library('calendar', $prefs);
		
		$this->load->view('manager/agenda/agenda_header');
		$this->load->view('manager/agenda/calendario',$data);
}
/*------------------------ FIN CALENDARIO ------------------------------ */

	
	
	
	
	
	
}


