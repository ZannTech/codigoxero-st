<?php

class Principal_Model extends Model
{
	var $id_usu = USUID;

	public function __construct()
	{
		parent::__construct();
	}
	public function dashboard()
	{
	}
	public function get_redes_report()
	{
		$c = $this->db->query("");
		$c->{'whatsapp'} = $this->db->query("SELECT  SUM(CASE WHEN whatsApp <> '' AND whatsApp IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'facebook'} = $this->db->query("SELECT  SUM(CASE WHEN link_facebook <> '' AND link_facebook IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'twitter'} = $this->db->query("SELECT  SUM(CASE WHEN link_twitter <> '' AND link_twitter IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'instagram'} = $this->db->query("SELECT  SUM(CASE WHEN link_instagram <> '' AND link_instagram IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'tiktok'} = $this->db->query("SELECT  SUM(CASE WHEN link_tiktok <> '' AND link_tiktok IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'twitch'} = $this->db->query("SELECT  SUM(CASE WHEN link_twitch <> '' AND link_twitch IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		json_return($c);
	}
	public function report_dashboard()
	{
		$c = $this->db->query("");
		$c->{'personas_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'wsp_env'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORTS_WSP WHERE id_customer = {$this->id_usu} AND type = 'wsp' ")->fetch(PDO::FETCH_OBJ);
		$c->{'sms_env'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORTS_WSP WHERE id_customer = {$this->id_usu} AND type = 'sms' ")->fetch(PDO::FETCH_OBJ);
		$c->{'district_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_DISTRICTS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'zones_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_ZONES WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		$c->{'streets_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_STREETS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		return $c;
	}
	public function get_informe_prc()
	{
		$c = $this->db->query("SELECT * FROM v_dist_coord WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'reg'} = $this->db->query("SELECT SUM(CASE WHEN id_meta = '{$d->id_meta}' THEN 1 ELSE 0 END) AS reg_c FROM T_REPORT_METAS")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
	public function get_weather()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.weatherapi.com/v1/current.json?key=' . WHEATHER_KEY . '&q=Peru&aqi=no',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		curl_close($curl);

		echo $response;
	}
	public function get_coords()
	{
		$c = $this->db->query("SELECT p.dni, p.id_district, p.id_zone, p.id_street, p.email,
		UPPER(CONCAT(p.first_name, ' ', p.last_name)) as nombre, p.longitude, p.latitude, p.date_create FROM T_PERSONS as p
		INNER JOIN  T_USERS as tu ON p.dni = tu.dni
		WHERE p.id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$c[$k]->{'distrito'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = {$d->id_district} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = {$d->id_zone} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = {$d->id_street} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c[$k]->{'type_user'} = $this->db->query("SELECT tu.description as type FROM T_USERS as u
    INNER JOIN T_TYPEUSERS as tu ON u.id_typeuser = tu.id_typeuser
     WHERE dni = '{$d->dni}' AND  u.id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
	public function get_users_district()
	{
		$c = $this->db->query("SELECT * FROM T_DISTRICTS WHERE flag_state = '01' AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c as $k => $d) {
			$distrito = $d->id_district;
			if ($d->dni != null) {
				$c[$k]->{'coordinador'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->dni}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			}
			$c[$k]->{'total_zonas'} = $this->db->query("SELECT COUNT(*) as c FROM T_ZONES WHERE id_district = '{$d->id_district}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$zones = $this->db->query("SELECT id_zone FROM T_ZONES WHERE id_district = '{$d->id_district}' AND id_customer = {$this->id_usu} ")->fetchAll(PDO::FETCH_OBJ);
			$streets = 0;
			foreach ($zones as $k => $d) {
				$x = $this->db->query("SELECT COUNT(*) as c FROM T_STREETS WHERE id_zone = '{$d->id_zone}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
				$streets += $x->c;
			}
			$c[$k]->{'total_manzanas'} = $streets;
			$c[$k]->{'total_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_PERSONS WHERE id_district = '{$distrito}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
	public function new_dashboard($data = null)
	{
		if ($data == null) {
			$ifecha = date('Y-m-' . '01',);
			$ffecha = date('Y-m-d H:i:s', strtotime(date('Y-m-d') . ' +1 Month'));
		} else {
			$ifecha = date('Y-m-d H:i:s', strtotime($data['ifecha']));
			$ffecha = date('Y-m-d H:i:s', strtotime($data['ffecha']));
		}
		$c = $this->db->query("SELECT user FROM T_CUSTOMERS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		// contador de datos
		$c->{'wsp'} = $this->db->query("SELECT SUM(CASE WHEN whatsApp <> '' AND whatsApp IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}' )")->fetch(PDO::FETCH_OBJ);
		$c->{'fb'} = $this->db->query("SELECT SUM(CASE WHEN link_facebook <> '' AND link_facebook IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}'    )")->fetch(PDO::FETCH_OBJ);
		$c->{'twitter'} = $this->db->query("SELECT SUM(CASE WHEN link_twitter <> '' AND link_twitter IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}' )")->fetch(PDO::FETCH_OBJ);
		$c->{'ig'} = $this->db->query("SELECT  SUM(CASE WHEN link_instagram <> '' AND link_instagram IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}' )")->fetch(PDO::FETCH_OBJ);
		$c->{'tiktok'} = $this->db->query("SELECT  SUM(CASE WHEN link_tiktok <> '' AND link_tiktok IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}'   )")->fetch(PDO::FETCH_OBJ);
		$c->{'twitch'} = $this->db->query("SELECT  SUM(CASE WHEN link_twitch <> '' AND link_twitch IS NOT NULL THEN 1 ELSE 0 END) AS cantidad FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}'   )")->fetch(PDO::FETCH_OBJ);
		$c->{'persons_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}')")->fetch(PDO::FETCH_OBJ);
		$c->{'wsp_env'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORTS_WSP WHERE id_customer = {$this->id_usu} AND type = 'wsp' ")->fetch(PDO::FETCH_OBJ);
		$c->{'sms_env'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORTS_WSP WHERE id_customer = {$this->id_usu} AND type = 'sms' ")->fetch(PDO::FETCH_OBJ);
		$c->{'district_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_DISTRICTS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}')")->fetch(PDO::FETCH_OBJ);
		$c->{'zones_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_ZONES WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}')")->fetch(PDO::FETCH_OBJ);
		$c->{'streets_reg'} = $this->db->query("SELECT COUNT(*) as c FROM T_STREETS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}')")->fetch(PDO::FETCH_OBJ);
		$c->{'asignaciones'} = $this->db->query("SELECT * FROM T_ASSIGN WHERE id_customer = {$this->id_usu} AND (fecha_asignado >= '{$ifecha}' AND fecha_asignado  <= '{$ffecha}')")->fetchAll(PDO::FETCH_OBJ);
		$c->{'persons'} = $this->db->query("SELECT * FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}')")->fetchAll(PDO::FETCH_OBJ);
		$c->{'zonas_graph'} = $this->db->query("SELECT id_district, description FROM T_DISTRICTS WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
		foreach ($c->zonas_graph as $k => $d) {
			$c->{'zonas_graph'}[$k]->{'count'} = $this->db->query("SELECT COUNT(*) as c FROM T_PERSONS WHERE id_customer = {$this->id_usu} AND id_district = {$d->id_district} AND (date_create >= '{$ifecha}' AND date_create  <= '{$ffecha}')")->fetch(PDO::FETCH_OBJ);
		}
		foreach ($c->{'persons'} as $k => $d) {
			$c->{'persons'}[$k]->{'distrito'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = {$d->id_district} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c->{'persons'}[$k]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = {$d->id_zone} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c->{'persons'}[$k]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = {$d->id_street} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
			$c->{'persons'}[$k]->{'type_user'} = $this->db->query("SELECT tu.description as type FROM T_USERS as u
   	 INNER JOIN T_TYPEUSERS as tu ON u.id_typeuser = tu.id_typeuser
     WHERE dni = '{$d->dni}' AND  u.id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
		}
		$c->{'metas'} = $this->db->query("SELECT * FROM T_METAS WHERE date_end IS NULL AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);;
		foreach ($c->{'metas'} as $k => $d) {
			$c->{'metas'}[$k]->{'asignacion'} = $this->db->query("SELECT * FROM T_ASSIGN WHERE id_meta = '{$d->id_meta}'")->fetch(PDO::FETCH_OBJ);

			$c->{'metas'}[$k]->{'reporte'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORT_METAS WHERE id_meta = '{$d->id_meta}'")->fetch(PDO::FETCH_OBJ);

			if ($c->{'metas'}[$k]->{'asignacion'} != null) {
				$id_usu = $c->{'metas'}[$k]->{'asignacion'}->id_usuario;
				$c->{'metas'}[$k]->{'coordinador'} = $this->db->query("SELECT first_name, last_name FROM T_PERSONS WHERE dni = '{$id_usu}'")->fetch(PDO::FETCH_OBJ);
			} else {
				$c->{'metas'}[$k]->{'coordinador'} = null;
			}

			if ($c->{'metas'}[$k]->{'asignacion'} != null) {
				$c->{'metas'}[$k]->{'detalle'} = $c->{'metas'}[$k]->{'asignacion'}->type == "DISTRITO" ?
					$this->db->query("SELECT * FROM T_DISTRICTS 
			WHERE id_district = {$c->{'metas'}[$k]->{'asignacion'}->id_asignado} ")->fetch(PDO::FETCH_OBJ) :
					$this->db->query("SELECT * FROM T_ZONES
			WHERE id_zone = {$c->{'metas'}[$k]->{'asignacion'}->id_asignado} ")->fetch(PDO::FETCH_OBJ);
			} else {
				$c->{'metas'}[$k]->{'detalle'} = null;
			}
		}
		foreach ($c->{'asignaciones'} as $k => $d) {
			$c->{'asignaciones'}[$k]->{'meta'} = $d->id_meta == '' ? null :
				$this->db->query("SELECT * FROM T_METAS WHERE id_meta = {$d->id_meta}")->fetch(PDO::FETCH_OBJ);
			$c->{'asignaciones'}[$k]->{'detalle'} = $d->type == "DISTRITO" ?
				$this->db->query("SELECT * FROM T_DISTRICTS 
			WHERE id_district = {$d->id_asignado} ")->fetch(PDO::FETCH_OBJ) :
				$this->db->query("SELECT * FROM T_ZONES
			WHERE id_zone = {$d->id_asignado} ")->fetch(PDO::FETCH_OBJ);
			if ($c->{'asignaciones'}[$k]->{'meta'}) {
				$c->{'asignaciones'}[$k]->{'p_c'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORT_METAS WHERE id_meta = {$d->id_meta}")->fetch(PDO::FETCH_OBJ);
				$c->{'asignaciones'}[$k]->{'coordinador'} = $this->db->query("SELECT first_name, last_name FROM T_PERSONS WHERE dni = {$d->id_usuario}")->fetch(PDO::FETCH_OBJ);

				$reporte = $this->db->query("SELECT dni_person FROM T_REPORT_METAS WHERE id_meta = {$d->id_meta}")->fetchAll(PDO::FETCH_OBJ);
				if (count($reporte) > 0) {
					foreach ($reporte as $x => $v) {
						$c->{'asignaciones'}[$k]->{'personas'}[$x] = $this->db->query("SELECT first_name, last_name FROM T_PERSONS WHERE dni = '{$v->dni_person}'")->fetch(PDO::FETCH_OBJ);
					}
				} else {
					$c->{'asignaciones'}[$k]->{'personas'} = 0;
				}
			}
		}
		json_return($c);
	}
}
