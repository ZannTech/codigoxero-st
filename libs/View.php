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
			require 'views/headerv2.php';
			require 'views/' . $name . '.php';
			require 'views/footer-v2.php';	
		}
	}

}