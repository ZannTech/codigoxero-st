<?php

class Super_model extends Model
{
    var $id_usu = USUID;
    public function __construct()
    {
        parent::__construct();
    }
    public function get_users()
    {
        $usuid = Session::get('usuid');
        $c = $this->db->query("SELECT * FROM T_CUSTOMERS WHERE id_customer <> {$usuid}")->fetchAll(PDO::FETCH_OBJ);
        json_return($c);
    }
    public function flag_update($id)
    {
        $c = $this->db->query("UPDATE T_CUSTOMERS SET flag_state = 
        CASE flag_state
        WHEN '01' THEN '02'
        WHEN '02' THEN '01' END 
        WHERE id_customer = {$id}
        ");
        if ($c) {
            response_function('Dato actualizado correctamente', FUNCTION_RESPONSE_SUCCESS);
        } else {
            response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function crud_super($req)
    {
        $user_ = trim(quitar_acentos($req['user']), ',');
        $id_customer = $req['id_user'];
        $description = trim(quitar_acentos($req['desc']), ',');
        $password = password_hash($req['pwd'], PASSWORD_BCRYPT);
        $estado = trim($req['user_state'], ',');
        $stm = '';
        $user = Session::get('dni');
        $date = date('Y-m-d H:i:s');
        $msj = $id_customer == '' ? 'Usuario Registrada Correctamente' : 'Usuario Actualizado Correctamente';
        if ($id_customer != '') {
            //edit            
            $stm = "UPDATE T_CUSTOMERS SET description = '{$description}', user = '{$user_}', password = '{$password}', date_update = '{$date}' WHERE id_customer = '{$id_customer}'";
        } else {
            $stm = "INSERT INTO T_CUSTOMERS (id_customer, dni, description, 
            user, password, user_create, date_create, id_update, date_update, flag_state)
            VALUES(null, '{$user}', '{$description}', '{$user_}', '{$password}', '{$user}', '{$date}', null, null, '{$estado}');
            ";
        }
        $exi = $this->db->query("SELECT COUNT(*) as c FROM T_CUSTOMERS WHERE description LIKE '{$description}' AND user LIKE '{$user}'")->fetch(PDO::FETCH_OBJ);
        if ($id_customer != '' || $exi->c == 0) {
            $c = $this->db->query($stm);
            if ($c) {
                response_function($msj, FUNCTION_RESPONSE_SUCCESS);
            } else {
                response_function(var_dump($c), FUNCTION_RESPONSE_ERROR);
            }
        } else {
            response_function('Este usuario ya existe ', FUNCTION_RESPONSE_ERROR);
        }
    }
    function get_countries()
    {
        return $this->db->query("SELECT * FROM T_COUNTRY")->fetchAll(PDO::FETCH_OBJ);
    }
    public function crud_credentials($req, $method)
    {
        $e = $this->db->query("SELECT * FROM T_SETTING WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        if (!$e) {
            // hacemos un insert con valores nulos solo para poder hacer update
            $x = $this->db->query("INSERT INTO T_SETTING (id_customer, url_logo, app_name, 
            token_twilio, ssid_twilio, mensaje_bienvenida, wheather_key, number_wsp, messaging_service) VALUES({$this->id_usu}, null, null, null, null, null, null, null, null)");
        }
        switch (true) {
            case ($method == 'api'):
                $token_twilio = $req['token_twilio'];
                $ssid_twilio = $req['ssid_twilio'];
                $wheather_key = $req['wheather_key'];
                $messaging_service = $req['messaging_service'];
                $c = $this->db->query("UPDATE T_SETTING SET token_twilio = '{$token_twilio}', ssid_twilio = '{$ssid_twilio}', wheather_key = '{$wheather_key}', messaging_service = '{$messaging_service}' WHERE id_customer = {$this->id_usu}");
                if ($c) {
                    response_function("Configuración de la API cambiada", FUNCTION_RESPONSE_SUCCESS);
                } else {
                    response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
                }
                break;
            case ($method == 'app'):
                $app_name = $req['app_name'];
                $mensaje_bienvenida = $req['mensaje_bienvenida'];
                $number_wsp = $req['number_wsp'];
                $number_sms = $req['number_sms'];
                $lada_phone = $req['lada_phone'];
                $mensaje_default = $req['mensaje_default'];
                $c = $this->db->query("UPDATE T_SETTING SET app_name = '{$app_name}', mensaje_bienvenida = '{$mensaje_bienvenida}', number_wsp = '{$number_wsp}', number_sms = '{$number_sms}', default_message = '{$mensaje_default}', codigo_pais = '{$lada_phone}' WHERE id_customer = {$this->id_usu}");
                if ($c) {

                    response_function("Configuración de la APP cambiada", FUNCTION_RESPONSE_SUCCESS);
                } else {
                    response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
                }
                break;
            case ($method == 'image'):
                $url_logo = $req['url_logo'];
                $c = $this->db->query("UPDATE T_SETTING SET url_logo = '{$url_logo}' WHERE id_customer = {$this->id_usu}");
                if ($c) {
                    response_function("Logo Cambiado", FUNCTION_RESPONSE_SUCCESS);
                } else {
                    response_function('Response inválido', FUNCTION_RESPONSE_ERROR);
                }
                break;
                $c = $this->db->query("SELECT * FROM T_SETTING")->fetch(PDO::FETCH_OBJ);
                $usuid = Session::get('usuid');
        }
    }
    public function get_info_file($id)
    {
        $c = $this->db->query("SELECT * FROM temp_doc WHERE id = {$id}")->fetch(PDO::FETCH_OBJ);
        return $c;
    }
}
