<?php
if(Session::get('loggedIn')){
	header('Location: '.  URL . 'principal/');
}
class Login extends Controller {
	function __construct() {
		parent::__construct();	
	}
	function index() 
	{	
		$this->view->js = array('login/js/app_login.js');
		$this->view->render('login/index', false);
	}
}