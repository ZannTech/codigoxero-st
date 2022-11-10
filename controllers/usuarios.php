<?php
check_session();
class Usuarios extends Controller {

	function __construct() {
		parent::__construct();
	}

	function tipos(){
		$this->view->js = array('usuarios/js/all_tipoUsuarios.js');
		$this->view->render('usuarios/tipos', false);
	}
	
	function crud_tipos($method){
		switch($method){
			case 'get':
				$this->model->get_distritos();
			break;
		}
	}

	function crud_distritos($method){
		switch($method){
			case 'get':
				$this->model->get_distritos();
			break; 			
		}
	}
	
}