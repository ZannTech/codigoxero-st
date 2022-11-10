<?php
check_session();
class Principal extends Controller {
	function __construct() {
		parent::__construct();	
	}
	function index(){
		$this->view->dist_user = $this->model->get_users_district();
		$this->view->inf = $this->model->get_informe_prc();
		$this->view->coords = $this->model->get_coords();
		$this->view->report = $this->model->report_dashboard();
		$this->view->js = array('principal/js/all_principal.js');
        $this->view->render('principal/index', false);
    }
	function get_redes_report(){
		$this->model->get_redes_report();
	}
	function get_weather(){
		$this->model->get_weather();
	}
	function new_dashboard($f = null){
		$this->model->new_dashboard($f != null ? $_POST : null);
	}
	
}