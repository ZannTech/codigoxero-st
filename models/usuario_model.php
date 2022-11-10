<?php
class Usuario_Model extends Model
{
	var $id_usu = USUID;

	public function __construct()
	{
		parent::__construct();
	}
	function get_type_users()
	{
		return $this->db->query("SELECT * FROM T_TYPEUSERS ")->fetchAll(PDO::FETCH_OBJ);
	}
	function get_countries()
	{
		return $this->db->query("SELECT * FROM T_COUNTRY")->fetchAll(PDO::FETCH_OBJ);
	}
	function get_genres()
	{
		return $this->db->query("SELECT id_sex, description FROM T_SEXS")->fetchAll(PDO::FETCH_OBJ);
	}
	function get_locations()
	{

		$c = $this->db->query("");
		$c->{'distritos'} = $this->db->query("SELECT * FROM T_DISTRICTS WHERE id_customer = {$this->id_usu}  ")->fetchAll(PDO::FETCH_OBJ);
		$c->{'zonas'} = $this->db->query("SELECT * FROM T_ZONES WHERE id_customer = {$this->id_usu}  ")->fetchAll(PDO::FETCH_OBJ);
		$c->{'manzanas'} = $this->db->query("SELECT * FROM T_STREETS WHERE id_customer = {$this->id_usu}  ")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c->distritos as $k => $d) {
			if ($d->dni != null) {
				$c->distritos[$k]->{'asociado'} = $this->db->query("SELECT CONCAT(first_name, ' ', last_name) as nombre FROM T_PERSONS WHERE dni = '{$d->dni}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			}
		}
		return $c;
	}
	function get_coordinadores()
	{


		$x = $this->db->query("SELECT dni FROM T_USERS WHERE id_typeuser = 4 AND id_customer = {$this->id_usu} ")->fetchAll(PDO::FETCH_OBJ);
		$c = $this->db->query("");
		foreach ($x as $k => $d) {
			$c[$k] = $this->db->query("SELECT * FROM T_PERSONS WHERE dni = '{$d->dni}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
	function get_users()
	{

		$c = $this->db->query("SELECT p.dni,UPPER(p.first_name) as first_name, UPPER(p.last_name) as last_name, p.email, p.date_create, p.flag_state
		FROM T_PERSONS as p WHERE p.id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'type_user'} = $this->db->query("SELECT tu.description as type FROM T_USERS as u
			INNER JOIN T_TYPEUSERS as tu ON u.id_typeuser = tu.id_typeuser
			WHERE dni = '{$d->dni}'")->fetch(PDO::FETCH_OBJ);
		}
		json_return($c);
	}
	function get_data_user($dni)
	{
		$c = $this->db->query("SELECT * FROM T_PERSONS WHERE dni = '{$dni}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
		$c->{'user'} = $this->db->query("SELECT * FROM T_USERS WHERE dni = '{$dni}'")->fetch(PDO::FETCH_OBJ);
		if ($c->{'user'}) {
			$c->{'meta'} = $this->db->query("SELECT cant_proposal FROM T_METAS WHERE id_meta = '{$c->id_meta}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
		} else {
			$c->{'meta'} = $this->db->query("");
		}
		json_return($c);
	}
	function crud_usuario($req)
	{
		$type_user = $req['type_user'];
		$dni = $req['dni'];
		$password = $req['password'];
		$first_name = $req['first_name'];
		$last_name = $req['last_name'];
		$date_of_birth = $req['date_of_birth'];
		$id_district = $req['id_district'];
		$id_zone = $req['id_zone'];
		$id_street = $req['id_street'];
		$id_genre = $req['id_genre'];
		$address = $req['address'];
		$telephone = $req['telephone'];
		$whatsapp = $req['social']['whatsapp'];
		$facebook = $req['social']['facebook'];
		$twitter = $req['social']['twitter'];
		$instagram = $req['social']['instagram'];
		$tiktok = $req['social']['tiktok'];
		$twitch = $req['social']['twitch'];
		$email = $req['email'];
		$long = $req['location']['long'];
		$lat = $req['location']['lat'];
		$user_id = $req['user_id'];
		$user_update = Session::get('dni');
		$id_customer = Session::get('usuid');
		$date = date('Y-m-d H:i:s');
		$stm = "";
		$stm1 = "";
		$wsp = "";
		$asign = null;
		$last_id = null;
		$id_asignado = $req['id_asignado'];
		$meta = $req['meta'];
		$type_assign = $req['type_assign'];
		$msj = $user_id == "" ? "Usuario Agregado" : "Usuario Actualizado";
		if ($user_id != "") {
			//edit
			if ($whatsapp == '1') {
				$wsp = $telephone;
			}
			$stm = "UPDATE T_PERSONS SET dni = '{$dni}',  id_district = {$id_district},
			id_zone = {$id_zone}, id_street = {$id_street},
			id_sexo = {$id_genre}, first_name = '{$first_name}',
			last_name = '{$last_name}', date_birth = '{$date_of_birth}',
			phone = '{$telephone}', direction = '{$address}', email = '{$email}',
			longitude = '{$long}', latitude = '{$lat}', whatsApp = '{$wsp}',
			link_facebook = '{$facebook}', link_twitter = '{$twitter}',
			link_instagram = '{$instagram}', link_tiktok = '{$tiktok}', link_twitch = '{$twitch}',
			user_update = '{$user_update}', date_update = '{$date}' WHERE dni = '{$user_id}'";
			$stm1 = "UPDATE T_USERS SET password = '{$password}', id_typeuser = {$type_user}, user_update = '{$user_update}', date_update = '{$date}'
			WHERE dni = '{$user_id}'";
		} else {
			if ($whatsapp == '1') {
				$wsp = $telephone;
			}
			$stm = "INSERT INTO T_PERSONS (dni, id_customer,
			id_district, id_zone, id_street, id_sexo, id_meta, first_name, last_name, date_birth, phone, photo,
			direction, email, longitude, latitude, whatsApp, link_facebook, link_twitter, link_instagram,
			link_tiktok, link_twitch, flag_state, user_create, date_create, user_update, date_update, id_asignacion)
			VALUES('{$dni}', {$id_customer}, {$id_district}, {$id_zone},
			 {$id_street}, {$id_genre}, null, '{$first_name}', '{$last_name}', '{$date_of_birth}', '{$telephone}',
			null, '{$address}', '{$email}', '{$long}', '{$lat}', '{$wsp}', '{$facebook}', '{$twitter}',
			'{$instagram}', '{$tiktok}', '{$twitch}', '01', '{$user_update}', '{$date}', null, null, null)";
			$stm1 = "INSERT INTO T_USERS (dni, id_customer, password, 
			id_typeuser, flag_state, user_create, date_create, user_update, date_update)
			VALUES('{$dni}', {$id_customer}, '{$password}', {$type_user}, '01', '{$user_update}', '{$date}', null, null)";
			if ($type_user == '4') {
				if ($meta != '' && $id_asignado != '' && $type_assign != '') {
					$sql1 = "INSERT INTO T_METAS (id_meta, id_customer, date_start, date_end, 
					cant_proposal, flag_state, user_create, date_create, user_update, date_update)
					VALUES(null, '{$this->id_usu}', '{$date}', null, '{$meta}', '01', '{$this->id_usu}', '{$date}', null, null)";
					$this->db->query($sql1);
					$id_meta_creada = $this->db->lastInsertId();
					$asignado = "INSERT INTO T_ASSIGN (id_asignacion,
					id_customer, id_usuario, id_meta, id_asignado, type, fecha_asignado, fecha_fin, estado)
					VALUES(null, '{$this->id_usu}', '{$dni}',  '{$id_meta_creada}', '{$id_asignado}', '{$type_assign}', '{$date}', null, '01')";
					$this->db->query($asignado);
				}
			}
		}
		$exi = $this->db->query("SELECT COUNT(*) as c FROM T_PERSONS WHERE dni = '{$dni}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
		if ($user_id != "" || $exi->c == 0) {
			$c = $this->db->prepare($stm);
			$sc = $this->db->prepare($stm1);
			if ($c->execute() && $sc->execute()) {
				response_function($msj, FUNCTION_RESPONSE_SUCCESS);
			} else {
				response_function("Error", FUNCTION_RESPONSE_ERROR);
			}
		} else {
			response_function('El DNI ya ha sido usado en otro usuario', FUNCTION_RESPONSE_ERROR);
		}
	}
	public function get_tipos()
	{
		$c = $this->db->query("SELECT * FROM T_TYPEUSERS")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k =>  $d) {
			$c[$k]->{'tx'} = $this->db->query("SELECT  SUM(CASE WHEN id_typeuser = {$d->id_typeuser} THEN 1 ELSE 0 END) AS c FROM T_USERS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		}
		json_return($c);
	}
	public function get_persons()
	{
		$c = $this->db->query("SELECT p.dni, p.id_district, p.id_zone, p.id_street, p.email,
		UPPER(CONCAT(p.first_name, ' ', p.last_name)) as nombre, p.longitude, p.latitude, p.date_create FROM T_PERSONS as p
		INNER JOIN  T_USERS as tu ON p.dni = tu.dni
		WHERE tu.id_typeuser <> 4 AND p.id_customer = {$this->id_usu} ")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'distrito'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = {$d->id_district} AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = {$d->id_zone} AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = {$d->id_street} AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'type_user'} = $this->db->query("SELECT tu.description as type FROM T_USERS as u
			INNER JOIN T_TYPEUSERS as tu ON u.id_typeuser = tu.id_typeuser
			 WHERE dni = '{$d->dni}' AND u.id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
		}
		json_return($c);
	}
	public function get_metas()
	{
		$c = $this->db->query("SELECT * FROM T_PERSONS WHERE id_meta IS NOT NULL AND id_customer = {$this->id_usu} ")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'meta'} = $this->db->query("SELECT * FROM T_METAS WHERE id_meta = {$d->id_meta} AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'district'} = $this->db->query("SELECT * FROM T_DISTRICTS WHERE dni = '{$d->dni}' AND id_customer = {$this->id_usu} LIMIT 1")->fetch(PDO::FETCH_OBJ);
			if ($c[$k]->{'district'}) {
				$c[$k]->{'persons'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORT_METAS WHERE id_meta = '{$d->id_meta}' AND id_district = {$c[$k]->{'district'}->id_district}")->fetch(PDO::FETCH_OBJ);
			}
		}
		json_return($c);
	}
	function get_coordinadores_without_meta()
	{
		$x = $this->db->query("SELECT dni FROM T_USERS WHERE id_typeuser = 4 AND id_customer = {$this->id_usu} ")->fetchAll(PDO::FETCH_OBJ);
		foreach ($x as $k => $d) {
			$c[$k] = $this->db->query("SELECT * FROM T_PERSONS WHERE dni = '{$d->dni}' AND id_meta IS NULL AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
	function meta_crud($req)
	{
		$dni = $req['id_coord'];
		$id_meta = $req['id'];
		$date = date('Y-m-d H:i:s');
		$user_update = Session::get('dni');
		$id_customer = Session::get('usuid');
		$meta = $req['meta'];
		$msj = $id_meta == '' ? 'Meta Agregada con Exito' : 'Meta Actualizada';
		$stm = "";
		if ($id_meta	!= '') {
			//edit
			$stm = "UPDATE T_METAS SET cant_proposal = '{$meta}' WHERE id_meta = '{$id_meta}' AND id_customer = {$this->id_usu} ";
		} else {
			// add
			$stm = "INSERT INTO T_METAS (id_meta, id_customer, date_start,
			 date_end, cant_proposal, flag_state, user_create, 
			 date_create, user_update, date_update)
			 VALUES(null, {$id_customer}, '{$date}', null, '{$meta}', '01', '{$user_update}', '{$date}', null, null)";
		}
		$c = $this->db->query($stm);
		if ($id_meta == '') {
			$id = $this->db->lastInsertId();
			$this->db->query("UPDATE T_PERSONS SET id_meta = '{$id}' WHERE dni = '{$dni}' AND id_customer = {$this->id_usu} ");
		}
		if ($c) {
			response_function($msj, FUNCTION_RESPONSE_SUCCESS);
		} else {
			response_function("Error", FUNCTION_RESPONSE_ERROR);
		}
	}
	public function terminar_meta($req)
	{
		$dni = $req['dni'];
		$id_meta = $req['id_meta'];
		$date = date('Y-m-d H:i:s');
		$c = $this->db->query("UPDATE T_METAS SET flag_state = '02', date_end = '{$date}' WHERE id_meta = '{$id_meta}' AND id_customer = {$this->id_usu} ");
		if ($c) {
			$x = $this->db->query("UPDATE T_PERSONS SET id_meta = null WHERE dni = '{$dni}' AND id_customer = {$this->id_usu} ");
			if ($x) {
				response_function("Meta terminada Correctamente.", FUNCTION_RESPONSE_SUCCESS);
			} else {
				response_function("Error", FUNCTION_RESPONSE_ERROR);
			}
		}
	}
	public function asign_work_zone($data)
	{
		$uid = $data['uid_coordinador'];
		$id_meta = null;
		$id_asignado = $data['id_asignado'];
		$tipo = $data['tipo'];
		$fecha_asg = date('Y-m-d H:i:s');
		$fecha_fin = null;
		$estado = 'a';
		$id_customer = Session::get('usuid');

		$stm = $this->db->prepare("INSERT INTO T_ASSIGN (id_asignacion, id_customer, id_usuario,
		 id_meta, id_asignado, type, fecha_asignado, fecha_fin, estado)
		 VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?)");
		$c = $stm->execute(array($id_customer, $uid, $id_meta, $id_asignado, $tipo, $fecha_asg, $fecha_fin, $estado));
		if ($c) {
			response_function("Usuario Asignado Correctamente.<br/>Para comenzar una meta favor de crear una meta para la asignación en el apartado de metas.", FUNCTION_RESPONSE_SUCCESS);
		} else {
			response_function("Error al asignar.", FUNCTION_RESPONSE_ERROR);
		}
	}
	public function get_coordinadores_w_asgn()
	{
		$users = $this->db->query("SELECT DISTINCT id_usuario FROM T_ASSIGN WHERE fecha_fin IS NULL AND id_customer = '{$this->id_usu}'")->fetchAll(PDO::FETCH_OBJ);
		if (count($users) > 0) {
			$fl = null;
			foreach ($users as $k => $d) {
				$fl .= "'{$d->id_usuario}'";
				$fl .= ",";
			}
			$fl = trim($fl, ',');
			$c = $this->db->query("SELECT p.dni, p.first_name, p.last_name FROM T_PERSONS as p INNER JOIN T_USERS as u ON p.dni = u.dni  WHERE p.id_customer = {$this->id_usu} AND u.id_typeuser = 4 AND p.dni NOT IN ({$fl})")->fetchAll(PDO::FETCH_OBJ);
			return $c;
		} else {
			$c = $this->db->query("SELECT p.dni, p.first_name, p.last_name FROM T_PERSONS as p INNER JOIN T_USERS as u ON p.dni = u.dni  WHERE p.id_customer = {$this->id_usu} AND u.id_typeuser = 4")->fetchAll(PDO::FETCH_OBJ);
			return $c;
		}
	}
	public function get_data_asgn($type)
	{
		$data_f = $this->db->query("SELECT id_asignado FROM T_ASSIGN WHERE fecha_fin IS NULL AND id_customer = '{$this->id_usu}'")->fetchAll(PDO::FETCH_OBJ);
		if (count($data_f) > 0) {
			$fl = null;
			foreach ($data_f as $k => $d) {
				$fl .= "'{$d->id_asignado}'";
				$fl .= ",";
			}
			$fl = trim($fl, ',');
			return $type == "ZONA" ? $this->db->query("SELECT id_zone as uid, description FROM T_ZONES WHERE id_customer  = {$this->id_usu} AND 
				id_zone NOT IN ({$fl})")->fetchAll(PDO::FETCH_OBJ) : $this->db->query("SELECT id_district as uid, description FROM 
				T_DISTRICTS WHERE id_customer  = {$this->id_usu} AND id_district NOT IN ({$fl})")->fetchAll(PDO::FETCH_OBJ);
		} else {
			return $type == "ZONA" ? $this->db->query("SELECT id_zone as uid, description FROM T_ZONES WHERE id_customer  = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ) :
				$this->db->query("SELECT id_district as uid, description FROM T_DISTRICTS WHERE id_customer  
			= {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
		}
	}
	public function get_asignaciones()
	{
		$c = $this->db->query("SELECT * FROM T_ASSIGN")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'detalle'} = $d->type == "DISTRITO" ? $this->db->query("SELECT * FROM T_DISTRICTS WHERE
			 id_district = {$d->id_asignado} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ) : $this->db->query("SELECT * FROM T_ZONES WHERE
			 id_zone = {$d->id_asignado} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'coordinador'} = $this->db->query("SELECT * FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'meta'} = !($d->id_meta)  ? null : $this->db->query("SELECT * FROM T_METAS WHERE id_meta = {$d->id_meta} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			if ($c[$k]->{'meta'} != null) {
				$c[$k]->{'personas'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORT_METAS WHERE id_meta = {$d->id_meta}")->fetch(PDO::FETCH_OBJ);
			}
		}
		json_return($c);
	}
	public function finish_assign($uid)
	{
		$date = date('Y-m-d H:i:s');
		$c = $this->db->query("UPDATE T_ASSIGN SET fecha_fin = '{$date}' WHERE id_asignacion = {$uid}");
		if ($c) {
			response_function("Asignacion finalizada", FUNCTION_RESPONSE_SUCCESS);
		} else {
			response_function("Error al terminar la asignación.", FUNCTION_RESPONSE_ERROR);
		}
	}
	public function delete_assign($uid)
	{
		$c = $this->db->query("DELETE FROM T_ASSIGN WHERE id_asignacion = {$uid}");
		if ($c) {
			response_function("Asignacion Borrada", FUNCTION_RESPONSE_SUCCESS);
		} else {
			response_function("Error al borrar la asignación.", FUNCTION_RESPONSE_ERROR);
		}
	}
	public function get_assign_w_metas()
	{
		$c = $this->db->query("SELECT * FROM T_ASSIGN WHERE id_meta IS NULL")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'detalle'} = $d->type == "DISTRITO" ? $this->db->query("SELECT * FROM T_DISTRICTS WHERE
			 id_district = {$d->id_asignado} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ) : $this->db->query("SELECT * FROM T_ZONES WHERE
			 id_zone = {$d->id_asignado} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'coordinador'} = $this->db->query("SELECT * FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		}
		return  $c;
	}
	public function crud_meta_new($req)
	{
		$id_assign = $req['id_assign'];
		$id_meta = $req['id'];
		$date = date('Y-m-d H:i:s');
		$user_update = Session::get('dni');
		$id_customer = Session::get('usuid');
		$meta = $req['meta'];
		$msj = $id_meta == '' ? 'Meta Agregada con Exito' : 'Meta Actualizada';
		$stm = "";

		if ($id_meta	!= '') {
			//edit
			$stm = "UPDATE T_METAS SET cant_proposal = '{$meta}' WHERE id_meta = '{$id_meta}' AND id_customer = {$this->id_usu} ";
		} else {
			// add
			$stm = "INSERT INTO T_METAS (id_meta, id_customer, date_start,
			 date_end, cant_proposal, flag_state, user_create, 
			 date_create, user_update, date_update)
			 VALUES(null, {$id_customer}, '{$date}', null, '{$meta}', '01', '{$user_update}', '{$date}', null, null)";
		}
		$c = $this->db->query($stm);
		if ($id_meta == '') {
			$id = $this->db->lastInsertId();
			$this->db->query("UPDATE T_ASSIGN SET id_meta = '{$id}' WHERE id_asignacion = '{$id_assign}' AND id_customer = {$this->id_usu} ");
		}
		if ($c) {
			response_function($msj, FUNCTION_RESPONSE_SUCCESS);
		} else {
			response_function("Error", FUNCTION_RESPONSE_ERROR);
		}
	}
	public function get_metas_new()
	{
		$c = $this->db->query("SELECT a.id_asignacion, a.id_customer, a.id_usuario, a.id_meta, a.id_asignado, 	a.type, a.fecha_asignado, a.fecha_fin, a.estado FROM T_ASSIGN as a INNER JOIN T_METAS as m ON a.id_meta = m.id_meta WHERE a.id_meta IS NOT NULL AND a.id_customer = {$this->id_usu} AND m.date_end IS NULL")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'meta'} = $this->db->query("SELECT * FROM T_METAS WHERE id_meta = {$d->id_meta} AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'encargado'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'detalle'} = $d->type == "DISTRITO" ? $this->db->query("SELECT description FROM T_DISTRICTS WHERE
			id_district = {$d->id_asignado}")->fetch(PDO::FETCH_OBJ) :
				$this->db->query("SELECT description FROM T_ZONES WHERE id_zone = {$d->id_asignado}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'report'} = $this->db->query("SELECT COUNT(*) as c FROM T_PERSONS WHERE id_asignacion = {$d->id_asignacion}")->fetch(PDO::FETCH_OBJ);
		}
		json_return($c);
	}
	public function profile_edit($data)
	{
		$name = $data['nombre'];
		$user = $data['usuario'];
		$prev_data = $this->db->query("SELECT password FROM T_CUSTOMERS where id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$pwd = $data['pwd'] == $prev_data->password ? $data['pwd'] : password_hash($data['pwd'], PASSWORD_BCRYPT);
		$c = $this->db->query("UPDATE T_CUSTOMERS SET description = '{$name}', user = '{$user}', password = '{$pwd}' WHERE id_customer = {$this->id_usu}");
		if ($c) {
			$user_data = $this->db->query("SELECT * FROM T_CUSTOMERS where id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			Session::set('usuid', $user_data->id_customer);
			Session::set('dni', $user_data->dni);
			Session::set('description', $user_data->description);
			Session::set('user', $user_data->user);
			response_function("Perfil Actualizado", FUNCTION_RESPONSE_SUCCESS);
		}
	}
	public function delete_user($dni)
	{
		try {
			$this->db->query("DELETE FROM T_PERSONS WHERE dni = '{$dni}' AND id_customer = {$this->id_usu}");
			$this->db->query("DELETE FROM T_USERS WHERE dni = '{$dni}' AND id_customer = {$this->id_usu}");

			$this->db->query("DELETE FROM T_ASSIGN WHERE id_usuario = '{$dni}' AND id_customer = {$this->id_usu}");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
