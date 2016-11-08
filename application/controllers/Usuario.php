<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// <summary> 
/// Controlador de la clase Usuario
/// </summary>  

class Usuario extends Welcome {

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
   	$this->load->model('/administrador/Sesion_model');
	$this->load->model('/user/Agenda_model');

   }
	 
public function index()
	{	
		$this->load->view('usuario/principal');
	}

public function agenda()
	{	
		
		$this->load->view('usuario/agenda/agenda_header');
		$this->load->view('usuario/agenda/agenda');
	}

public function sesiones()
	{	
		$this->load->helper('url');
		$this->load->view('usuario/sesiones/sesiones');
	}
	
	public function ver_agenda() {
		
		$data['id'] = $this->uri->segment(3);
		$data['agenda'] = $this->Agenda_model->obtenerAgendas($data['id']);
		$this->load->helper('form');
		$this->load->view('usuario/agenda/agenda_header');
		$this->load->view('usuario/agenda/ver_agenda',$data);
		/// <summary> 
		/// Sirve para cargar las vistas del header de agenda y de ver agenda y 
		/// conseguir el ID y la Agenda que se va a ver
		/// </summary> 
		
	}
	
	
public function ver_agenda_dia(){
	
	$data['año'] = $this->uri->segment(3);
	$data['mes'] = $this->uri->segment(4);
	$data['dia'] = $this->uri->segment(5);
	
		$data['agenda'] = $this->Agenda_model->obtenerAgendas_dia($data['año'],$data['mes'],$data['dia']);
		$this->load->helper('form');
		$this->load->view('usuario/agenda/agenda_header');
		$this->load->view('usuario/agenda/ver_agenda_dia',$data);

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
		$prefs['next_prev_url'] = 'https://spaunimet-jinvernon.c9users.io/spaunimetci/usuario/calendario/';
		
		$data = array(
		'year' => $this->uri->segment(3),
		'month' => $this->uri->segment(4)
		);
		
		if ( $this->uri->segment(4) == NULL ){
	
			$data['dias'] = $this->Agenda_model->obtener_eventos_user( date('Y') , date('m') , 1 );
			
		}
		else{
			
			$data['dias'] = $this->Agenda_model->obtener_eventos_user( $this->uri->segment(3) , $this->uri->segment(4) , 1  );
			
		}
		

		$this->load->library('calendar', $prefs);
		
		$this->load->view('usuario/agenda/agenda_header');
		$this->load->view('usuario/agenda/calendario',$data);
}
/*------------------------ FIN CALENDARIO ------------------------------ */
	
	
	
    
}


