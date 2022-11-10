<?php
check_session();
class Informe extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		header("Location: " . URL . 'informe/reporte');
	}
	function reporte()
	{
		$this->view->js = array('informe/js/all_informe.js');
		$this->view->render('informe/index', false);
	}
	function test()
	{
		$this->view->render('informe/all/all_new', true);
	}
	function mapa()
	{
		$this->view->coords = $this->model->get_coords();
		$this->view->js = array('informe/js/all_mapa.js');
		$this->view->render('informe/all/all_mapa', false);
	}
	function campo()
	{
		$this->view->inf = $this->model->get_progreso_campo();
		$this->view->js = array('informe/js/all_campo.js');
		$this->view->render('informe/all/all_progreso', false);
	}
	function menu()
	{
		$this->view->js = array('informe/js/all_menu.js');
		$this->view->render('informe/all/all_menu', false);
	}
	function informe()
	{
		$this->view->distritos = $this->model->getDistrito();
		$this->view->js = array('informe/js/all_informe.js');
		$this->view->render('informe/all/all_plantilla', false);
	}
	function generar($id_distrito, $ifecha, $ffecha)
	{
		if ($id_distrito != '' && $ifecha != '' && $ffecha != '') {
			$data = $this->model->generar_informe(array(
				"fechaInicio" => $ifecha,
				"fechaFin" => $ffecha,
				"id_district" => $id_distrito
			));
			if ($data) {
				$this->view->data = $data;
				$this->view->render('informe/all/all_informe', true);
			} else {
				header("Location: " .  URL);
			}
		} else {
			header("Location: " .  URL);
		}
	}
	function spInforme()
	{
		if ($_POST) {
			$this->model->sp_InformeUsuarioxDistrito($_POST);
		}
	}
	function psgen()
	{
		$jx = $this->model->reporte_detallado($_POST);
		if (count($jx->coordinadores) > 0) {
			json_return($jx);
		} else {
			response_function("No se han encontrado ningun dato en esta fecha", FUNCTION_RESPONSE_ERROR);
		}
	}
	function general($ifecha, $ffecha)
	{
		$data = $this->model->reporte_detallado(array(
			"fechaInicio" => $ifecha,
			"fechaFin" => $ffecha,
		));
		if (count($data->coordinadores) > 0) {
			$this->view->data = $data;
			$this->view->render('informe/all/all_general', true);
		}
	}
}
