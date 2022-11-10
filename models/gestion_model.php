<?php

class Gestion_Model extends Model
{
    var $id_usu = USUID;
    public function __construct()
    {
        parent::__construct();
    }
    public function get_by_id($req){
        switch($req['get_info']){
            case 'T_ZONES':
                $id_district = $req['id'];
                $c = $this->db->query("SELECT * FROM T_ZONES WHERE id_district = {$id_district} AND flag_state = '01' AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
                json_return($c);
            break;
        }
    }
    public function get_distritos()
    {
        $c = $this->db->query("SELECT * FROM T_DISTRICTS WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        if ($c) {
            foreach ($c as $k => $d) {
                if($d->dni != ''){
                    $c[$k]->{'coord'} = $this->db->query("SELECT CONCAT(dni, ' - ',first_name, ' ', last_name) as nombre FROM T_PERSONS WHERE dni  = {$d->dni} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                }
                $c[$k]->{'customer'} = $this->db->query("SELECT description FROM T_CUSTOMERS WHERE id_customer  = {$d->id_customer}")->fetch(PDO::FETCH_OBJ);
            }
        }
        json_return($c);
    }
    public function get_zonas()
    {
        $c = $this->db->query("SELECT * FROM T_ZONES WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        if ($c) {
            foreach ($c as $k => $d) {
                if($d->dni != ''){
                    $c[$k]->{'coord'} = $this->db->query("SELECT CONCAT(dni, ' - ',first_name, ' ', last_name) as nombre FROM T_PERSONS WHERE dni  = {$d->dni}")->fetch(PDO::FETCH_OBJ);
                }
                $c[$k]->{'customer'} = $this->db->query("SELECT description FROM T_CUSTOMERS WHERE id_customer  = {$d->id_customer}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'district'} = $this->db->query("SELECT description FROM T_DISTRICTS WHERE id_district = {$d->id_district} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
            }
        }
        json_return($c);
    }

    // public function delete_zona(){
    //     $c = $this->db->query("UPDATE T_ZONES SET FLAG_STATE = '02' WHERE ID_CUSTOMER = '1' AND ID_ZONE = '1'")->fetchAll(PDO::FETCH_OBJ);
    //     json_return($c);
    // }

    public function get_manzanas()
    {
        $c = $this->db->query("SELECT * FROM T_STREETS WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        if ($c) {
            foreach ($c as $k => $d) {
                if($d->dni != ''){
                    $c[$k]->{'coord'} = $this->db->query("SELECT CONCAT(dni, ' - ',first_name, ' ', last_name) as nombre FROM T_PERSONS WHERE dni  = {$d->dni} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                }
                $c[$k]->{'zone'} = $this->db->query("SELECT id_zone,  id_district, description FROM T_ZONES WHERE id_zone = {$d->id_zone} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'district'} = $this->db->query("SELECT id_district, description FROM T_DISTRICTS WHERE id_district = {$c[$k]->{'zone'}->id_district} AND  id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);

            }
        }
        json_return($c);
    }
    // zannet update
    public function crud_district($req)
    {
        $name = trim(quitar_acentos($req['district_name']),',');
        $state = trim(quitar_acentos($req['district_state']), ',');
        $id_district = $req['id_district'];
        $id_customer = Session::get('usuid');
        
        $stm = '';
        $user = Session::get('dni');
        $date = date('Y-m-d H:i:s');
        $msj = $id_district == '' ? 'Distrito Registrado Correctamente' : 'Distrito Actualizado Correctamente';
        if ($id_district != '') {
            $stm = "UPDATE T_DISTRICTS SET description = '{$name}', id_customer = '{$id_customer}', flag_state = '{$state}', user_update = '{$user}', date_update = '{$date}' WHERE id_district = {$id_district}";
        } else {
            
            $stm = "INSERT INTO T_DISTRICTS
            (id_district, id_customer, dni, description, user_create, date_create, user_update, date_update, flag_state)
            VALUES(null, {$id_customer}, null, '{$name}', '{$user}', '{$date}', null, null, '{$state}')";
        }
        
        $exi = $this->db->query("SELECT COUNT(*) as c FROM T_DISTRICTS WHERE description LIKE '{$name}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        if($id_district != '' || $exi->c == 0){
            $c = $this->db->query($stm);
            if ($c) {
                response_function($msj, FUNCTION_RESPONSE_SUCCESS);
            } else {
                response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
            }
        }else{
            response_function('Este distrito ya existe', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function flag_update($tbl, $id, $identifier){
        $c = $this->db->query("UPDATE " . $tbl . " SET flag_state = 
        CASE flag_state
        WHEN '01' THEN '02'
        WHEN '02' THEN '01' END
        WHERE ". $identifier . " = {$id}");
        if ($c) {
            response_function('Dato actualizado correctamente', FUNCTION_RESPONSE_SUCCESS);
        } else {
            response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function all_distritos(){
        return $this->db->query("SELECT * FROM T_DISTRICTS WHERE flag_state = '01' AND  id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
    }
    public function crud_zone($req){
        $zone_name = trim(quitar_acentos($req['zone_name']),',');
        $zone_state = trim(quitar_acentos($req['zone_state']), ',');
        $zone_id = $req['zone_id'];
        $district_id = trim($req['id_district'],',');
        $id_customer = Session::get('usuid');
        $stm = '';
        $user = Session::get('dni');
        $date = date('Y-m-d H:i:s');
        $msj = $zone_id == '' ? 'Zona Registrada Correctamente' : 'Zona Actualizada Correctamente';
        if($zone_id != ""){
            $stm = "UPDATE T_ZONES SET id_district = '{$district_id}', 
            description = '{$zone_name}', flag_state = '{$zone_state}', user_update = '{$user}', date_update = '{$date}' WHERE id_zone = {$zone_id}";
        }else{
            $stm = "INSERT INTO T_ZONES (id_zone, id_customer, id_district, dni,
            description, user_create, date_create, user_update, date_update, flag_state) 
            VALUES(null, {$id_customer}, {$district_id}, null, '{$zone_name}', '{$user}', '{$date}', null, null, '{$zone_state}')";
        }
        $exi = $this->db->query("SELECT COUNT(*) as c FROM T_ZONES WHERE description LIKE '{$zone_name}' AND id_district LIKE '{$district_id}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        if($zone_id != '' || $exi->c == 0){
            $c = $this->db->query($stm);
            if ($c) {
                response_function($msj, FUNCTION_RESPONSE_SUCCESS);
            } else {
                response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
            }
        }else{
            response_function('Esta zona ya existe', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function crud_street($req){
        $street_name = trim(quitar_acentos($req['street_name']),',');
        $street_state = trim(quitar_acentos($req['street_state']), ',');
        $street_id = $req['street_id'];
        $zone_id = trim($req['zone_id'],',');
        $id_customer = Session::get('usuid');
        $stm = '';
        $user = Session::get('dni');
        $date = date('Y-m-d H:i:s');
        $msj = $street_id == '' ? 'Manzana Registrada Correctamente' : 'Manzana Actualizada Correctamente';
        if($street_id != ''){
            // edit
            $stm = "UPDATE  T_STREETS SET id_zone = {$zone_id}, 
            description = '{$street_name}', flag_state = '{$street_state}',
            user_update = '{$user}', date_update = '{$date}' WHERE id_street = {$street_id}";
        }else{
            // create
            $stm = "INSERT INTO T_STREETS (id_street, id_customer, id_zone, dni,
            description, user_create, date_create, user_update, date_update, flag_state)
            VALUES(null, {$id_customer}, {$zone_id}, null, '{$street_name}', '{$user}', '{$date}', null, null, '{$street_state}')";
        }
        $exi = $this->db->query("SELECT COUNT(*) as c FROM T_STREETS WHERE description LIKE '{$street_name}' AND id_zone LIKE '{$zone_id}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        if($street_id != '' || $exi->c == 0){
            $c = $this->db->query($stm);
            if ($c) {
                response_function($msj, FUNCTION_RESPONSE_SUCCESS);
            } else {
                response_function('Response inválido ' . $stm, FUNCTION_RESPONSE_ERROR);
            }
        }else{
            response_function('Esta manzana ya existe', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function delete_by_id($table, $id){
        $delimiter = '';
        switch ($table){
            case 'T_DISTRICTS':
                $delimiter = 'id_district';
            break;
            case 'T_ZONES':
                $delimiter = 'id_zone';
            break;
            case 'T_STREETS':
                $delimiter = 'id_street';
            break;
        }
        $c = $this->db->query("DELETE FROM {$table} WHERE {$delimiter} = {$id}");
        if ($c) {
            response_function("Dato eliminado correctamente", FUNCTION_RESPONSE_SUCCESS);
        } else {
            response_function('Datos protegidos, para eliminar requiere no tener datos enlazadoss', FUNCTION_RESPONSE_ERROR);
        }
    }
}
