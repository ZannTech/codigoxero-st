<?php

use Twilio\Rest\Client;

/**
 * Render the resources that are added by the controller
 *
 * 
 * You can add more file types, but to use the function you need to use an array.
 * For example:
 * $this->view->css = array('directory/style.css');
 * either
 * $this->view->js = array('directory/app.js');

 *It should be noted that while you are calling this function you always have to comply with $this->view->css or $this->view-js
 * @access public
 * @param string $type type_file (js or css)
 * @param array $resources the array with all resources called in the controller
 */
function render_resources($type, $resources)
{

	if (is_array($resources)) {
		switch ($type) {
			case 'js':
				if (isset($resources)) {
					$m = version_factorize();
					foreach ($resources as $resource) {
						$x = $resource . ''  . $m;
						echo '<script type="text/javascript" src="' . URL . 'views/' . $x . '"></script>';
					}
				}
				break;
			case 'css':
				if (isset($resources)) {
					$m = version_factorize();
					foreach ($resources as $resource) {
						$x = $resource . ''  . $m;
						echo '<link rel="stylesheet" type="text/css" href="' . URL . 'views/' . $x . '">';
					}
				}
				break;
			default:

				break;
		}
	}
}
function version_factorize()
{
	$s = time();
	$v = "?" . md5($s) . "=" . time();
	return $v;
}
function response_function($text, $code = 1)
{
	if ($code == 1) {
		echo json_encode(array("msj" => $text, "status" => 'ok'));
	} else {
		echo json_encode(array("msj" => $text, "error" => "error in the controller.\nErr-type = " . $code));
	}
}
function check_post()
{
	if ($_POST) {
		return true;
	} else {
		return false;
	}
}
// function redirect_role($rol)
// {

// 	switch ($rol) {
// 		case 1:
// 			header("Location: " . URL . 'tablero/');
// 			break;
// 		case 2:
// 			header("Location: " . URL . 'tablero/');
// 			break;
// 		case 3:
// 			header("Location: " . URL . 'area/');
// 			break;
// 		case 4:
// 			header("Location: " . URL . 'cliente/');
// 		break;
// 	}
// }

function tiempo_transcurrido($fecha)
{
	if (empty($fecha)) {
		return "No hay fecha";
	}

	$intervalos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año");
	$duraciones = array("60", "60", "24", "7", "4.35", "12");

	$ahora = time();
	$Fecha_Unix = strtotime($fecha);

	if (empty($Fecha_Unix)) {
		return "Fecha incorracta";
	}
	if ($ahora > $Fecha_Unix) {
		$diferencia     = $ahora - $Fecha_Unix;
		$tiempo         = "Hace";
	} else {
		$diferencia     = $Fecha_Unix - $ahora;
		$tiempo         = "Dentro de";
	}
	for ($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones) - 1; $j++) {
		$diferencia /= $duraciones[$j];
	}

	$diferencia = round($diferencia);

	if ($diferencia != 1) {
		$intervalos[5] .= "e"; //MESES
		$intervalos[$j] .= "s";
	}

	return "$tiempo $diferencia $intervalos[$j]";
}
function json_return($c)
{
	$data = array("data" => $c);
	echo json_encode($data);
}

// function check_role($roles)
// {
// 	$v = Session::get('rol');
// 	if ($v != false) :
// 		if (is_array($roles)) {
// 			if (!in_array($v, $roles)) {
// 				redirect_role($v);
// 			}
// 		} else {
// 			return false;
// 		}
// 	else :
// 		header('Location:' . URL . 'err/danger');
// 	endif;
// }

function SpanishDate()
{

	$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

	echo $dias[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');
	//Salida: Viernes 24 de Febrero del 2012
}

function sanitize($text, $type)
{
	switch ($type) {
		case 'email':
			$string = filter_var($text, FILTER_SANITIZE_EMAIL);
			break;
		case 'text':
			$string = filter_var($text, FILTER_SANITIZE_STRING);
			break;
		case 'number':
			$string = filter_var($text, FILTER_SANITIZE_NUMBER_INT);
			break;
	}
	return trim($string);
}

function unidad($numuero)
{
	switch ($numuero) {
		case 9: {
				$numu = "NUEVE";
				break;
			}
		case 8: {
				$numu = "OCHO";
				break;
			}
		case 7: {
				$numu = "SIETE";
				break;
			}
		case 6: {
				$numu = "SEIS";
				break;
			}
		case 5: {
				$numu = "CINCO";
				break;
			}
		case 4: {
				$numu = "CUATRO";
				break;
			}
		case 3: {
				$numu = "TRES";
				break;
			}
		case 2: {
				$numu = "DOS";
				break;
			}
		case 1: {
				$numu = "UN";
				break;
			}
		case 0: {
				$numu = "";
				break;
			}
	}
	return $numu;
}

function decena($numdero)
{

	if ($numdero >= 90 && $numdero <= 99) {
		$numd = "NOVENTA ";
		if ($numdero > 90)
			$numd = $numd . "Y " . (unidad($numdero - 90));
	} else if ($numdero >= 80 && $numdero <= 89) {
		$numd = "OCHENTA ";
		if ($numdero > 80)
			$numd = $numd . "Y " . (unidad($numdero - 80));
	} else if ($numdero >= 70 && $numdero <= 79) {
		$numd = "SETENTA ";
		if ($numdero > 70)
			$numd = $numd . "Y " . (unidad($numdero - 70));
	} else if ($numdero >= 60 && $numdero <= 69) {
		$numd = "SESENTA ";
		if ($numdero > 60)
			$numd = $numd . "Y " . (unidad($numdero - 60));
	} else if ($numdero >= 50 && $numdero <= 59) {
		$numd = "CINCUENTA ";
		if ($numdero > 50)
			$numd = $numd . "Y " . (unidad($numdero - 50));
	} else if ($numdero >= 40 && $numdero <= 49) {
		$numd = "CUARENTA ";
		if ($numdero > 40)
			$numd = $numd . "Y " . (unidad($numdero - 40));
	} else if ($numdero >= 30 && $numdero <= 39) {
		$numd = "TREINTA ";
		if ($numdero > 30)
			$numd = $numd . "Y " . (unidad($numdero - 30));
	} else if ($numdero >= 20 && $numdero <= 29) {
		if ($numdero == 20)
			$numd = "VEINTE ";
		else
			$numd = "VEINTI" . (unidad($numdero - 20));
	} else if ($numdero >= 10 && $numdero <= 19) {
		switch ($numdero) {
			case 10: {
					$numd = "DIEZ ";
					break;
				}
			case 11: {
					$numd = "ONCE ";
					break;
				}
			case 12: {
					$numd = "DOCE ";
					break;
				}
			case 13: {
					$numd = "TRECE ";
					break;
				}
			case 14: {
					$numd = "CATORCE ";
					break;
				}
			case 15: {
					$numd = "QUINCE ";
					break;
				}
			case 16: {
					$numd = "DIECISEIS ";
					break;
				}
			case 17: {
					$numd = "DIECISIETE ";
					break;
				}
			case 18: {
					$numd = "DIECIOCHO ";
					break;
				}
			case 19: {
					$numd = "DIECINUEVE ";
					break;
				}
		}
	} else
		$numd = unidad($numdero);
	return $numd;
}

function centena($numc)
{
	if ($numc >= 100) {
		if ($numc >= 900 && $numc <= 999) {
			$numce = "NOVECIENTOS ";
			if ($numc > 900)
				$numce = $numce . (decena($numc - 900));
		} else if ($numc >= 800 && $numc <= 899) {
			$numce = "OCHOCIENTOS ";
			if ($numc > 800)
				$numce = $numce . (decena($numc - 800));
		} else if ($numc >= 700 && $numc <= 799) {
			$numce = "SETECIENTOS ";
			if ($numc > 700)
				$numce = $numce . (decena($numc - 700));
		} else if ($numc >= 600 && $numc <= 699) {
			$numce = "SEISCIENTOS ";
			if ($numc > 600)
				$numce = $numce . (decena($numc - 600));
		} else if ($numc >= 500 && $numc <= 599) {
			$numce = "QUINIENTOS ";
			if ($numc > 500)
				$numce = $numce . (decena($numc - 500));
		} else if ($numc >= 400 && $numc <= 499) {
			$numce = "CUATROCIENTOS ";
			if ($numc > 400)
				$numce = $numce . (decena($numc - 400));
		} else if ($numc >= 300 && $numc <= 399) {
			$numce = "TRESCIENTOS ";
			if ($numc > 300)
				$numce = $numce . (decena($numc - 300));
		} else if ($numc >= 200 && $numc <= 299) {
			$numce = "DOSCIENTOS ";
			if ($numc > 200)
				$numce = $numce . (decena($numc - 200));
		} else if ($numc >= 100 && $numc <= 199) {
			if ($numc == 100)
				$numce = "CIEN ";
			else
				$numce = "CIENTO " . (decena($numc - 100));
		}
	} else
		$numce = decena($numc);

	return $numce;
}

function miles($nummero)
{
	if ($nummero >= 1000 && $nummero < 2000) {
		$numm = "MIL " . (centena($nummero % 1000));
	}
	if ($nummero >= 2000 && $nummero < 10000) {
		$numm = unidad(Floor($nummero / 1000)) . " MIL " . (centena($nummero % 1000));
	}
	if ($nummero < 1000)
		$numm = centena($nummero);

	return $numm;
}

function decmiles($numdmero)
{
	if ($numdmero == 10000)
		$numde = "DIEZ MIL";
	if ($numdmero > 10000 && $numdmero < 20000) {
		$numde = decena(Floor($numdmero / 1000)) . "MIL " . (centena($numdmero % 1000));
	}
	if ($numdmero >= 20000 && $numdmero < 100000) {
		$numde = decena(Floor($numdmero / 1000)) . " MIL " . (miles($numdmero % 1000));
	}
	if ($numdmero < 10000)
		$numde = miles($numdmero);

	return $numde;
}

function cienmiles($numcmero)
{
	if ($numcmero == 100000)
		$num_letracm = "CIEN MIL";
	if ($numcmero >= 100000 && $numcmero < 1000000) {
		$num_letracm = centena(Floor($numcmero / 1000)) . " MIL " . (centena($numcmero % 1000));
	}
	if ($numcmero < 100000)
		$num_letracm = decmiles($numcmero);
	return $num_letracm;
}

function millon($nummiero)
{
	if ($nummiero >= 1000000 && $nummiero < 2000000) {
		$num_letramm = "UN MILLON " . (cienmiles($nummiero % 1000000));
	}
	if ($nummiero >= 2000000 && $nummiero < 10000000) {
		$num_letramm = unidad(Floor($nummiero / 1000000)) . " MILLONES " . (cienmiles($nummiero % 1000000));
	}
	if ($nummiero < 1000000)
		$num_letramm = cienmiles($nummiero);

	return $num_letramm;
}

function decmillon($numerodm)
{
	if ($numerodm == 10000000)
		$num_letradmm = "DIEZ MILLONES";
	if ($numerodm > 10000000 && $numerodm < 20000000) {
		$num_letradmm = decena(Floor($numerodm / 1000000)) . "MILLONES " . (cienmiles($numerodm % 1000000));
	}
	if ($numerodm >= 20000000 && $numerodm < 100000000) {
		$num_letradmm = decena(Floor($numerodm / 1000000)) . " MILLONES " . (millon($numerodm % 1000000));
	}
	if ($numerodm < 10000000)
		$num_letradmm = millon($numerodm);

	return $num_letradmm;
}

function cienmillon($numcmeros)
{
	if ($numcmeros == 100000000)
		$num_letracms = "CIEN MILLONES";
	if ($numcmeros >= 100000000 && $numcmeros < 1000000000) {
		$num_letracms = centena(Floor($numcmeros / 1000000)) . " MILLONES " . (millon($numcmeros % 1000000));
	}
	if ($numcmeros < 100000000)
		$num_letracms = decmillon($numcmeros);
	return $num_letracms;
}

function milmillon($nummierod)
{
	if ($nummierod >= 1000000000 && $nummierod < 2000000000) {
		$num_letrammd = "MIL " . (cienmillon($nummierod % 1000000000));
	}
	if ($nummierod >= 2000000000 && $nummierod < 10000000000) {
		$num_letrammd = unidad(Floor($nummierod / 1000000000)) . " MIL " . (cienmillon($nummierod % 1000000000));
	}
	if ($nummierod < 1000000000)
		$num_letrammd = cienmillon($nummierod);

	return $num_letrammd;
}


function convertir($numero)
{
	$numf = milmillon($numero);
	return $numf . " SOLES S/.";
}
function fechaEs($fecha)
{
	$fecha = substr($fecha, 0, 10);
	$numeroDia = date('d', strtotime($fecha));
	$dia = date('l', strtotime($fecha));
	$mes = date('F', strtotime($fecha));
	$anio = date('Y', strtotime($fecha));
	$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$nombredia = str_replace($dias_EN, $dias_ES, $dia);
	$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}
function quitar_acentos($cadena)
{
	$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
	$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';
	$cadena = utf8_decode($cadena);
	$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
	return utf8_encode($cadena);
}

// function utf8text1($text)
// {
// 	return strtoupper(iconv('UTF-8', 'windows-1252', $text));
// }
function utf8text($text)
{

	return strtoupper(quitar_acentos($text));
}



function human_filesize($bytes, $decimals = 2)
{
	$factor = floor((strlen($bytes) - 1) / 3);
	if ($factor > 0) $sz = 'KMGT';
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
}
function random_percent()
{
	echo '+' . rand(10 * 10, 100 * 10) / 10 . '%';
}
/**
 * Extract the name of page
 *
 * 
 * @access public
 * @param string $url the url 
 */
function dynamic_page_title($url)
{
	if ($url != '' || $url != null) {
		if (strtoupper($url) != 'LOGIN') {
			$string_l = substr($url, 0, strpos($url, '/', 0));
			$x_string = substr($url, strpos($url, '/', 0) + 1, strlen($url));
			$string_f = substr($x_string, 0, strpos($x_string, '/'));
			if ($string_f == 'index' || $string_f == '') {
				if ($x_string == '') {
					return strtoupper($string_l .  ' - '  . APP_NAME);
				} else {
					return strtoupper($string_l . ' ' . $x_string . ' - '  . APP_NAME);
				}
			} else {
				return strtoupper($string_l . ' ' . $string_f . ' - '  . APP_NAME);
			}
		} else {
			return 'LOGIN' . ' - ' . APP_NAME != '' ? ' SISTEMA' : APP_NAME;
		}
	} else {
		return 'LOGIN' . ' - ' . APP_NAME != '' ? ' SISTEMA' : APP_NAME;
	}
}
function dynamic_navigation($url)
{
	if ($url != '' || $url != null) {
		if (strtoupper($url) != 'LOGIN') {
			$string_l = substr($url, 0, strpos($url, '/', 0));
			$x_string = substr($url, strpos($url, '/', 0) + 1, strlen($url));
			$string_f = substr($x_string, 0, strpos($x_string, '/', 0));
			if ($string_f == 'index' || $string_f == '') {
				if ($x_string == '') {
					return '
				<div class="col-sm-6">
				<div class="breadcrumbs-area clearfix">
					<h4 class="page-title pull-left">Dashboard</h4>
					<ul class="breadcrumbs pull-left">
						<li><a href="' . URL . $string_l . '">' . ucfirst($string_l) . '</a></li>
						<li><span>Inicio</span></li>
					</ul>
				</div>
				</div>
				';
				} else {
					return '
				<div class="col-sm-6">
				<div class="breadcrumbs-area clearfix">
					<h4 class="page-title pull-left">Dashboard</h4>
					<ul class="breadcrumbs pull-left">
						<li><a href="' . URL . $string_l . '">' . ucfirst($string_l) . '</a></li>
						<li><span>' . ucfirst($x_string) . '</span></li>
					</ul>
				</div>
				</div>
				';
				}
			} else {
				return '
				<div class="col-sm-6">
				<div class="breadcrumbs-area clearfix">
					<h4 class="page-title pull-left">Dashboard</h4>
					<ul class="breadcrumbs pull-left">
						<li><a href="' . URL . $string_l . '">' . ucfirst($string_l) . '</a></li>
						<li><span>' . ucfirst($string_f) . '</span></li>
					</ul>
				</div>
			</div>
				';
			}
		} else {
			return 'LOGIN' . ' - ' . APP_NAME;
		}
	} else {
		return APP_NAME . ' - ' . 'LOGIN';
	}
}
function check_session()
{
	if (Session::get('loggedIn') == true) {
		return true;
	} else {
		header('Location: ' . URL);
	}
}

function eliminar_acentos($cadena)
{

	//Reemplazamos la A y a
	$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
	);

	//Reemplazamos la E y e
	$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena
	);

	//Reemplazamos la I y i
	$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena
	);

	//Reemplazamos la O y o
	$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena
	);

	//Reemplazamos la U y u
	$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena
	);

	//Reemplazamos la N, n, C y c
	$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
	);

	return $cadena;
}

function return_image_ext($ext = '', $route_srv = '')
{

	switch (true) {
		case $ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg':
			return $route_srv;
			break;
		case $ext == 'xls' || $ext == 'xlsx' || $ext == 'csv':
			return IMG_PATH . 'icon/files_admin/xls_480px.png';
			break;
		case $ext == 'pdf':
			return IMG_PATH . 'icon/files_admin/pdf_480px.png';
			break;
		case $ext == 'apk':
			return IMG_PATH . 'icon/files_admin/apk_320px.png';
			break;
		case $ext == 'zip' || $ext == 'rar' || $ext == '7z':
			return IMG_PATH . 'icon/files_admin/archive.png';
			break;
		case $ext == 'doc' || $ext == 'docx':
			return IMG_PATH . 'icon/files_admin/word_480px.png';
			break;
		case $ext == 'mp3':
			return IMG_PATH . 'icon/files_admin/mp3_480px.png';
			break;
		case $ext == 'ogg':
			return IMG_PATH . 'icon/files_admin/ogg_480px.png';
			break;
		case $ext == 'avi':
			return IMG_PATH . 'icon/files_admin/avi_480px.png';
			break;
		case $ext == 'ppt' || $ext == 'pptx':
			return IMG_PATH . 'icon/files_admin/ppt_480px.png';
			break;
		case $ext == 'mp4' || $ext == 'avi':
			return IMG_PATH . 'icon/files_admin/video_file_480px.png';
			break;
		default:
			return IMG_PATH . 'icon/files_admin/file_480px.png';
			break;
	}
}

function twilio_comm($message, $type = null, $media = null, $contact = null, $lada = null)
{
	if (is_null($contact)) {
		exit('Error');
	}
	if ($type == 'wsp') {
		if ($lada == '+52') {
			$lada = '+521';
		}
	}
	$contact = trim($contact);
	$contact = str_replace(' ', '', $contact);
	$numero = $lada == null ? $contact : $lada . $contact;
	$twilio = new Client(SSID, TOKEN);
	try {
		switch ($type) {
			case $type == 'sms':
				if ($media == null) {
					$message = $twilio->messages
						->create(
							$numero, // to
							[
								'from' => NUMBER_SMS,
								'body' => $message
							]
						);
					return $message;
				} else if ($media != null) {
					$message = $twilio->messages
						->create(
							$numero, // to
							[
								'from' => NUMBER_SMS,
								'body' => $message,
								'mediaUrl' => [$media]
							]
						);
					return $message;
				}
				break;
			case $type == 'wsp':
				if ($media == null) {
					$message = $twilio->messages
						->create(
							'whatsapp:' . str_replace(' ', '', $numero), // to
							[
								'from' => 'whatsapp:' . NUMBER_WSP,
								'body' => $message,
							]
						);
					return $message;
				} else {
					$message = $twilio->messages
						->create(
							'whatsapp:' . str_replace(' ', '', $numero), // to
							[
								'from' => 'whatsapp:' . NUMBER_WSP,
								'body' => $message,
								'MediaUrl' => $media,
							]
						);
					return $message;
				}
				break;
		}
	} catch (Exception $e) {
		return null;
	}
}


class TwilioType
{
	const MESSAGE = 0;
	const WHATSAPP = 1;
}

function internal_error()
{
	header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
	echo '<h1>Something went wrong!</h1>';
	exit;
}
