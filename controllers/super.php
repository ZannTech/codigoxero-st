<?php
check_session();
class Super extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		header('Location: ' . URL);
	}
	function gestion()
	{

		$this->view->js = array('super/js/all_super.js');
		$this->view->render("super/index");
	}
	function get_users()
	{
		$this->model->get_users();
	}
	function crud_super($method)
	{
		switch (true) {
			case $method == 'flag_update':
				$this->model->flag_update($_POST['id']);
				break;
			case $method != 'flag_delete':
				$this->model->crud_super($_POST);
				break;
		}
	}
	function change_imagen()
	{
		$file = $this->model->get_info_file($_POST['id_temp']);
		if ($file) {
			$url = $file->ruta;
			$this->model->crud_credentials(array(
				"url_logo" => $url
			), 'image');
		}
	}
	function crud_credentials($method)
	{
		$this->model->crud_credentials($_POST, $method);
	}
	function ajustes()
	{
		$this->view->countries = $this->model->get_countries();

		$this->view->js = array('super/js/all_settings.js');
		$this->view->render("super/settings");
	}
}
