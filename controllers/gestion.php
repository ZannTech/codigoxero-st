<?php
check_session();
class Gestion extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		header('Location: ' . URL . 'gestion/menu');
	}
	function menu(){
		$this->view->js = array('gestion/js/all_menu.js');
		$this->view->render('gestion/index', false);
	}
	function distritos(){
		$this->view->js = array('gestion/js/all_distritos.js', 'gestion/js/all_gestion.js');
		$this->view->render('gestion/distritos', false);
	}
	function manzanas(){
		$this->view->distritos = $this->model->all_distritos();
		$this->view->js = array('gestion/js/all_manzanas.js', 'gestion/js/all_gestion.js');
		$this->view->render('gestion/manzanas', false);
	}
	function zonas(){
		$this->view->distritos = $this->model->all_distritos();
		$this->view->js = array('gestion/js/all_zonas.js', 'gestion/js/all_gestion.js');
		$this->view->render('gestion/zonas', false);
	}
	function get_by_id(){
		if($_POST){
			$this->model->get_by_id($_POST);
		}
	}
	function crud_distritos($method){
		switch($method){
			case 'get':
				$this->model->get_distritos();
			break;
            case 'add': 
                $this->model->crud_district($_POST);
            break;	
			case 'edit':
				$this->model->crud_district($_POST);
			break;
			case 'flag_update':
				$this->model->flag_update('T_DISTRICTS', $_POST['id'], 'id_district');
			break;
		}
	}
	
	function crud_zonas($method){
		switch($method){
			case
			 'get':
				$this->model->get_zonas();
			break; 			
			case 'add':
				$this->model->crud_zone($_POST);
			break; 		
			case 'edit':
				$this->model->crud_zone($_POST);
			break; 			
			case 'flag_update':
				$this->model->flag_update('T_ZONES', $_POST['id'], 'id_zone');
			break;			
		}
	}

	function crud_manzanas($method){
		switch($method){
			case 'get':
				$this->model->get_manzanas();
			break;	
			case 'add':
				$this->model->crud_street($_POST);
			break; 		
			case 'edit':
				$this->model->crud_street($_POST);
			break; 			
			case 'flag_update':
				$this->model->flag_update('T_STREETS', $_POST['id'], 'id_street');
			break;		
		}
	}
	function delete_data($table){
		if($_POST){
			$this->model->delete_by_id($table, $_POST['id']);	
		}else{
			echo 'Nothing see here';
		}
	}

}