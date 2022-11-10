<?php

class Err extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->view->css = array('err/css/style.css');
		$this->view->render('err/inc/header', true);
		$this->view->render('err/index', true);
		$this->view->render('err/inc/footer', true);

	}

	function danger() {
		$this->view->css = array('err/css/style.css');
		$this->view->render('err/inc/header', true);
		$this->view->render('err/danger', true);
		$this->view->render('err/inc/footer', true);
	}

}