<?php
check_session();
class Usuario extends Controller
{

	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		header('Location: ' . URL . 'usuario/tipos');
	}
	function mantenimiento()
	{
		$this->view->genres = $this->model->get_genres();
		$this->view->countries = $this->model->get_countries();
		$this->view->user_type = $this->model->get_type_users();
		$this->view->zones = $this->model->get_locations();
		$this->view->js = array("usuario/js/all_usuarios.js", 'usuario/js/all_maps.js');
		$this->view->render('usuario/all/all_usuarios', false);
	}
	function asignacion()
	{
		$this->view->coordinadores = $this->model->get_coordinadores_w_asgn();
		$this->view->zones = $this->model->get_locations();
		$this->view->js = array("usuario/js/all_asignacion.js");
		$this->view->render('usuario/all/all_asignacion', false);
	}
	function personas()
	{
		$this->view->js = array("usuario/js/all_personas.js");
		$this->view->render('usuario/all/all_personas', false);
	}
	function delete_user($dni)
	{
		$this->model->delete_user($dni);
	}
	function tipos()
	{
		$this->view->js = array("usuario/js/all_tipos.js");
		$this->view->render('usuario/all/all_tipos', false);
	}
	function get_users()
	{
		$this->model->get_users();
	}
	function crud_usuario($method)
	{
		switch ($method) {
			case 'add':
				$this->model->crud_usuario($_POST);
				break;
			case 'edit':
				$this->model->crud_usuario($_POST);
				break;
		}
	}
	function get_data_user($dni)
	{
		if ($_POST) {
			if ($dni == $_POST['dni']) {
				$this->model->get_data_user($_POST['dni']);
			}
		}
	}
	function get_tipos()
	{
		$this->model->get_tipos();
	}
	function get_persons()
	{
		$this->model->get_persons();
	}
	function metas()
	{
		$this->view->asignaciones = $this->model->get_assign_w_metas();
		$this->view->js = array("usuario/js/all_metas.js");
		$this->view->render('usuario/all/all_metas', false);
	}
	function get_metas()
	{
		$this->model->get_metas();
	}
	function meta_crud($method)
	{
		switch ($method) {
			case 'add':
				$this->model->meta_crud($_POST);
				break;
			case 'edit':
				$this->model->meta_crud($_POST);
				break;
		}
	}
	function terminar_meta()
	{
		$this->model->terminar_meta($_POST);
	}
	function super()
	{
		$this->view->js = array("usuario/js/all_metas.js");
		$this->view->render('usuario/all/all_metas', false);
	}
	function asignHandler($method = null)
	{
		switch (true):
			case $method == 'assign':
				$this->model->asign_work_zone($_POST);
				break;
		endswitch;
	}
	function get_data_asgn($type)
	{
		json_return($this->model->get_data_asgn($type));
	}
	function get_asignaciones()
	{
		$this->model->get_asignaciones();
	}
	function finish_assign($uid)
	{
		$this->model->finish_assign($uid);
	}
	function delete_assign($uid)
	{
		$this->model->delete_assign($uid);
	}
	function crud_meta_new()
	{
		$this->model->crud_meta_new($_POST);
	}
	function get_metas_new()
	{
		$this->model->get_metas_new();
	}
	function profile_edit()
	{
		$this->model->profile_edit($_POST);
	}
}
