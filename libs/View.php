<?php

class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			require 'views/header-v3.php';
			require 'views/' . $name . '.php';
			require 'views/footer-v3.php';	
		}
	}

}