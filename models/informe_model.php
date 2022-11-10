<?php

class Informe_Model extends Model
{
    var $id_usu = USUID;
    public function __construct()
    {
        parent::__construct();
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
     WHERE dni = '{$d->dni}' AND u.id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
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

    public function getDistrito()
    {
        $id_customer = Session::get('usuid');
        return $this->db->query("SELECT * FROM T_DISTRICTS WHERE id_customer = {$id_customer}")->fetchAll(PDO::FETCH_OBJ);
    }
    public function generar_informe($req)
    {
        $ifecha = date('Y-m-d H:i:s', strtotime($req['fechaInicio']));
        $ffecha = date('Y-m-d H:i:s', strtotime($req['fechaFin']));
        $id_district = $req['id_district'];
        $ifecha = date('Y-m-d H:i:s', strtotime($req['fechaInicio']));
        $ffecha = date('Y-m-d H:i:s', strtotime($req['fechaFin']));
        $id_district = $req['id_district'];
        $c = $this->db->query("SELECT * FROM T_ASSIGN WHERE id_asignado = {$id_district} AND type = 'DISTRITO' AND id_meta IS NOT NULL  AND (fecha_asignado >= '{$ifecha}' AND fecha_asignado <= '{$ffecha}')")->fetchAll(PDO::FETCH_OBJ);
        if ($c) {
            foreach ($c as $k => $d) {
                $c[$k]->{'distrito'} = $this->db->query("SELECT dni, description FROM T_DISTRICTS WHERE id_district = {$id_district} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'coordinador'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'meta'} = $this->db->query("SELECT * FROM T_METAS WHERE id_meta = '{$d->id_meta}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'encargado'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'registrados'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre, date_create, photo, whatsApp, email, id_district, id_zone, id_street FROM T_PERSONS WHERE id_asignacion = '{$d->id_asignacion}' AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
                foreach($c[$k]->{'registrados'} as $l => $v){
                    $c[$k]->{'registrados'}[$l]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = {$v->id_zone} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                    $c[$k]->{'registrados'}[$l]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = {$v->id_street} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                }
            }
            return $c;
        } else {
            response_function("No se encontraron datos entre ese intervalo de fechas", FUNCTION_RESPONSE_ERROR);
        }
       
    }
    public function sp_InformeUsuarioxDistrito($req)
    {
        $ifecha = date('Y-m-d H:i:s', strtotime($req['fechaInicio']));
        $ffecha = date('Y-m-d H:i:s', strtotime($req['fechaFin']));
        $id_district = $req['id_district'];
        $c = $this->db->query("SELECT * FROM T_ASSIGN WHERE id_asignado = {$id_district} AND type = 'DISTRITO' AND id_meta IS NOT NULL  AND (fecha_asignado >= '{$ifecha}' AND fecha_asignado <= '{$ffecha}')")->fetchAll(PDO::FETCH_OBJ);
        if ($c) {
            foreach ($c as $k => $d) {
                $c[$k]->{'distrito'} = $this->db->query("SELECT dni, description FROM T_DISTRICTS WHERE id_district = {$id_district} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'coordinador'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'meta'} = $this->db->query("SELECT * FROM T_METAS WHERE id_meta = '{$d->id_meta}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'encargado'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->id_usuario}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'registrados'} = $this->db->query("SELECT UPPER(CONCAT(first_name, ' ', last_name)) as nombre, date_create, photo, whatsApp, email, id_district, id_zone, id_street FROM T_PERSONS WHERE id_asignacion = '{$d->id_asignacion}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            }
            json_return($c);
        } else {
            response_function("No se encontraron datos entre ese intervalo de fechas", FUNCTION_RESPONSE_ERROR);
        }
    }
    public function reporte_detallado($req)
    {
        $usuid = Session::get('usuid');
        $ifecha = date('Y-m-d H:i:s', strtotime($req['fechaInicio']));
        $ffecha = date('Y-m-d H:i:s', strtotime($req['fechaFin']));
        $c = $this->db->query("SELECT * FROM T_CUSTOMERS WHERE id_customer = '{$usuid}'")->fetch(PDO::FETCH_OBJ);
        $c->{'distritos'} = $this->db->query("SELECT * FROM T_DISTRICTS WHERE (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->distritos as $k => $d) {
            $c->distritos[$k]->{'count'} = $this->db->query("SELECT SUM(CASE WHEN id_district = '{$d->id_district}' THEN 1 ELSE 0 END) AS reg_c FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
        $c->{'zonas'} = $this->db->query("SELECT * FROM T_ZONES WHERE  (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->zonas as $k => $d) {
            $c->zonas[$k]->{'count'} = $this->db->query("SELECT SUM(CASE WHEN id_zone = '{$d->id_zone}' THEN 1 ELSE 0 END) AS reg_c FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
        $c->{'manzanas'} = $this->db->query("SELECT * FROM T_STREETS WHERE  (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->manzanas as $k => $d) {
            $c->manzanas[$k]->{'count'} = $this->db->query("SELECT SUM(CASE WHEN id_street = '{$d->id_street}' THEN 1 ELSE 0 END) AS reg_c FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
        $simp = $this->db->query("SELECT * FROM T_USERS  WHERE  (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND id_typeuser = 1 AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        $coord = $this->db->query("SELECT * FROM T_USERS  WHERE  (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND id_typeuser = 4 AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        $vol = $this->db->query("SELECT * FROM T_USERS  WHERE  (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND (id_typeuser = 2 OR id_typeuser = 3) AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        foreach ($simp as $k => $d) {
            $c->{'simpatizantes'}[$k] = $this->db->query("SELECT * FROM T_PERSONS WHERE  dni = '{$d->dni}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            $c->simpatizantes[$k]->{'distrito'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = '{$c->simpatizantes[$k]->id_district}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            $c->simpatizantes[$k]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = '{$c->simpatizantes[$k]->id_zone}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            $c->simpatizantes[$k]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = '{$c->simpatizantes[$k]->id_street}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
        foreach ($coord as $k => $d) {
            $c->{'coordinadores'}[$k] = $this->db->query("SELECT * FROM T_PERSONS WHERE  dni = '{$d->dni}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            if($c->{'coordinadores'}[$k]){
                $c->coordinadores[$k]->{'distrito'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = '{$c->coordinadores[$k]->id_district}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c->coordinadores[$k]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = '{$c->coordinadores[$k]->id_zone}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c->coordinadores[$k]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = '{$c->coordinadores[$k]->id_street}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            }
        }
        foreach ($vol as $k => $d) {
            $c->{'voluntarios'}[$k] = $this->db->query("SELECT * FROM T_PERSONS WHERE  dni = '{$d->dni}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            $c->voluntarios[$k]->{'distrito'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = '{$c->voluntarios[$k]->id_district}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            $c->voluntarios[$k]->{'zona'} = $this->db->query("SELECT description FROM T_ZONES WHERE id_zone = '{$c->voluntarios[$k]->id_zone}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            $c->voluntarios[$k]->{'manzana'} = $this->db->query("SELECT description FROM T_STREETS WHERE id_street = '{$c->voluntarios[$k]->id_street}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
        $c->{'wsp'} = $this->db->query("SELECT * FROM T_REPORTS_WSP WHERE  (date_create >= '{$ifecha}' AND date_create <= '{$ffecha}') AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        return $c;
    }
    public function get_progreso_campo(){
		$c = $this->db->query("SELECT * FROM T_METAS WHERE date_end IS NULL AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);;
		foreach ($c as $k => $d) {
			$c[$k]->{'asignacion'} = $this->db->query("SELECT * FROM T_ASSIGN WHERE id_meta = '{$d->id_meta}'")->fetch(PDO::FETCH_OBJ);
			
			$c[$k]->{'reporte'} = $this->db->query("SELECT COUNT(*) as c FROM T_REPORT_METAS WHERE id_meta = '{$d->id_meta}'")->fetch(PDO::FETCH_OBJ);
			
			if($c[$k]->{'asignacion'} != null){
				$id_usu = $c[$k]->{'asignacion'}->id_usuario;
				$c[$k]->{'coordinador'} = $this->db->query("SELECT first_name, last_name FROM T_PERSONS WHERE dni = '{$id_usu}'")->fetch(PDO::FETCH_OBJ);
			}else{
				$c[$k]->{'coordinador'} = null;
			}

			if ($c[$k]->{'asignacion'} != null) {
				$c[$k]->{'detalle'} = $c[$k]->{'asignacion'}->type == "DISTRITO" ?
					$this->db->query("SELECT * FROM T_DISTRICTS 
			WHERE id_district = {$c[$k]->{'asignacion'}->id_asignado} ")->fetch(PDO::FETCH_OBJ) :
					$this->db->query("SELECT * FROM T_ZONES
			WHERE id_zone = {$c[$k]->{'asignacion'}->id_asignado} ")->fetch(PDO::FETCH_OBJ);
			} else {
				$c[$k]->{'detalle'} = null;
			}
		}
		return $c;
	}
}
