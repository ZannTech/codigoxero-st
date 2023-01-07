<?php

use Matrix\Decomposition\QR;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Service_Model extends Model
{
    var $id_usu = USUID;

    public function __construct()
    {
        parent::__construct();
    }
   
    public function new_file_bd($request)
    {
        $route = $request['route'];
        $type = $request['type'];
        $c = $this->db->prepare("INSERT INTO temp_doc (id, ruta, tipo) VALUES(null, ?, ?)");
        if ($c->execute(array($route, $type))) {
            $id = $this->db->lastInsertId();
            return $id;
        } else {
            response_function('Error', FUNCTION_RESPONSE_ERROR);
        }
    }

    public function new_file($request)
    {
        $lcroute = $request['route'];
        $srvroute = URL . $lcroute;
        $type = $request['type'];
        $size = $request['size'];
        $date = date("Y-m-d H:i:s");
        $c = $this->db->prepare("INSERT INTO T_FILES (id_file, id_customer, local_route,
        server_route, file_size, file_type, date_create)
        VALUES(null, ?, ?, ?, ?, ?, ?)");
        if ($c->execute(array($this->id_usu, $lcroute, $srvroute, $size, $type, $date))) {
            $id = $this->db->lastInsertId();
            return $id;
        } else {
            response_function('Error', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function delete_file($id)
    {
        $c = $this->db->query("DELETE FROM temp_doc WHERE id = {$id}");
        if ($c) {
            response_function('Archivo eliminado correctamente', FUNCTION_RESPONSE_SUCCESS);
        } else {
            response_function('Error', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function get_info_file($id)
    {
        $c = $this->db->query("SELECT * FROM temp_doc WHERE id = {$id}")->fetch(PDO::FETCH_OBJ);
        return $c;
    }
    public function get_info_file_msj($id)
    {
        $c = $this->db->query("SELECT * FROM T_FILES WHERE id_file = {$id} AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        return $c;
    }
    public function delete_file_msj($id)
    {
        $c = $this->db->query("DELETE FROM T_FILES WHERE id_file = {$id} AND id_customer = {$this->id_usu}");
        if ($c) {
            response_function('Archivo eliminado correctamente', FUNCTION_RESPONSE_SUCCESS);
        } else {
            response_function('Error', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function excel_import($request, $table)
    {
        if ($request) {
            $id_usu = Session::get('usuid');
            $user_create = Session::get('dni');
            $date_create = date('Y-m-d H:i:s');
            $id_tmp = $request['id_tmp'];
            $query = "";
            $with_errors = false;
            switch ($table) {
                case 'T_DISTRICTS':
                    $query = "INSERT INTO T_DISTRICTS (id_district, id_customer, dni,
                    description, user_create, date_create, user_update, date_update, flag_state)
                    VALUES (null, ?, null, ?, ?, ?, null, null, '01')";
                    $file = $this->db->query("SELECT * FROM temp_doc WHERE id = {$id_tmp}")->fetch(PDO::FETCH_OBJ);

                    if ($file) {
                        if ($file->tipo == 'xlsx' || $file->tipo == 'xls') {
                            $document = IOFactory::load($file->ruta);
                            $current_sheet = $document->getSheet(0);
                            $rows_total = $current_sheet->getHighestDataRow();
                            $letter_max = $current_sheet->getHighestColumn();
                            $num_letter = Coordinate::columnIndexFromString($letter_max);

                            for ($index_row = 2; $index_row <= $rows_total; $index_row++) {
                                $value = $current_sheet->getCellByColumnAndRow(1, $index_row);
                                if ($value != "") {
                                    $value = quitar_acentos($value);
                                    $exi = $this->db->query("SELECT COUNT(*) as c FROM T_DISTRICTS WHERE description LIKE '{$value}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                    if ($exi->c == 0) {
                                        $c = $this->db->prepare($query);
                                        $c->execute(array($id_usu, strtoupper($value), $user_create, $date_create));
                                    }
                                }
                            }
                            response_function('El archivo ha sido importado correctamente', FUNCTION_RESPONSE_SUCCESS);
                        } else {
                            if ($file->tipo == 'csv') {
                                $lines = file($file->ruta);
                                $i = 0;
                                $lmx = count($lines);
                                foreach ($lines as $line) {
                                    $count_records = count($lines);
                                    $count_records_added = ($count_records - 1);
                                    if ($i != 0) {
                                        $data = explode(",", $line);
                                        if (count($data) == 1) {
                                            $value = strtoupper($data[0]);
                                            $value = quitar_acentos($value);
                                            if ($value != "" && $value != "DISTRITOS") {
                                                $exi = $this->db->query("SELECT COUNT(*) as c FROM T_DISTRICTS WHERE description LIKE '{$value}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                                if ($exi->c == 0) {
                                                    $c = $this->db->prepare($query);
                                                    $c->execute(array($id_usu, $value, $user_create, $date_create));
                                                }
                                            }
                                        } else {
                                            response_function("Error, la plantilla no es válida, descarga la platilla desde la página de plantillas.", FUNCTION_RESPONSE_ERROR);
                                            break;
                                        }
                                    }
                                    $i++;
                                }
                                if ($i == $lmx) {
                                    // the foreach ended successfully
                                    response_function("Los datos han sido importados satisfactoriamente.", FUNCTION_RESPONSE_SUCCESS);
                                }
                            } else {
                                response_function("Archivo de importación no admitido");
                            }
                        }
                    } else {
                        response_function("Error, el archivo no existe, favor de volver a subirlo", FUNCTION_RESPONSE_ERROR);
                    }
                    break;
                case 'T_ZONES':
                    $query = "INSERT INTO T_ZONES (id_zone, id_customer, id_district, dni,
                    description, user_create, date_create, user_update, date_update, flag_state)
                    VALUES(null, ?, ?, null, ?, ?, ?, null, null, '01')";
                    $file = $this->db->query("SELECT * FROM temp_doc WHERE id = {$id_tmp}")->fetch(PDO::FETCH_OBJ);
                    if ($file) {
                        if ($file->tipo == 'xlsx' || $file->tipo == 'xls') {
                            $document = IOFactory::load($file->ruta);
                            $current_sheet = $document->getSheet(0);
                            $rows_total = $current_sheet->getHighestDataRow();
                            $letter_max = $current_sheet->getHighestColumn();
                            for ($index_row = 1; $index_row <= $rows_total; $index_row++) {
                                $distrito = $current_sheet->getCellByColumnAndRow(1, $index_row);
                                $nombre = $current_sheet->getCellByColumnAndRow(2, $index_row);
                                $distrito = quitar_acentos($distrito);
                                $nombre = quitar_acentos($nombre);
                                if (strtoupper($distrito) != "DISTRITO" && $nombre != "NOMBRE") {
                                    if ($distrito != "" && $nombre != "") {
                                        $district = $this->db->query("SELECT id_district FROM T_DISTRICTS WHERE description LIKE '{$distrito}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                        if ($district) {
                                            $exi = $this->db->query("SELECT COUNT(*) as c FROM T_ZONES WHERE description LIKE '{$nombre}' AND id_district LIKE '{$district->id_district}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
                                            if ($exi->c == 0) {
                                                $c = $this->db->prepare($query);
                                                $c->execute(array($id_usu, $district->id_district, $nombre, $user_create, $date_create));
                                            }
                                        } else {
                                            $with_errors = true;
                                        }
                                    }
                                }
                            }
                            $msj = $with_errors == true ? 'El archivo ha sido importado correctamente, pero hubo algunos errores.' : 'El archivo ha sido importado correctamente';
                            response_function($msj, FUNCTION_RESPONSE_SUCCESS);
                        } else {
                            if ($file->tipo == 'csv') {
                                $lines = file($file->ruta);
                                $i = 0;
                                $lmx = count($lines);
                                foreach ($lines as $line) {
                                    $count_records = count($lines);
                                    $count_records_added = ($count_records - 1);
                                    if ($i != 0) {
                                        $data = explode(";", $line);
                                        if (count($data) == 2) {
                                            $distrito = strtoupper($data[0]);
                                            $nombre = strtoupper($data[1]);
                                            $distrito = quitar_acentos($distrito);
                                            $nombre = quitar_acentos($nombre);
                                            if ($distrito != "" && $nombre != "") {
                                                $district = $this->db->query("SELECT id_district FROM T_DISTRICTS WHERE description LIKE '{$distrito}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                                if ($district) {
                                                    $exi = $this->db->query("SELECT COUNT(*) as c FROM T_ZONES WHERE description LIKE '{$nombre}' AND id_district LIKE '{$district->id_district}' AND id_customer = {$this->id_usu} ")->fetch(PDO::FETCH_OBJ);
                                                    if ($exi->c == 0) {
                                                        $c = $this->db->prepare($query);
                                                        $c->execute(array($id_usu, $district->id_district, strtoupper($nombre), $user_create, $date_create));
                                                    }
                                                } else {
                                                    $with_errors = true;
                                                }
                                            } else {
                                                $with_errors = true;
                                            }
                                        } else {
                                            response_function("Error, la plantilla no es válida, descarga la platilla desde la página de plantillas.", FUNCTION_RESPONSE_ERROR);
                                            break;
                                        }
                                    }
                                    $i++;
                                }
                                if ($i == $lmx) {
                                    $msj = $with_errors == true ? 'El archivo ha sido importado correctamente, pero hubo algunos errores.' : 'El archivo ha sido importado correctamente';
                                    // the foreach ended successfully
                                    response_function($msj, FUNCTION_RESPONSE_SUCCESS);
                                }
                            } else {
                                response_function("Archivo de importación no admitido");
                            }
                        }
                    } else {
                        response_function("Error, el archivo no existe, favor de volver a subirlo", FUNCTION_RESPONSE_ERROR);
                    }
                    break;
                case 'T_STREETS':
                    $query = "INSERT INTO T_STREETS (id_street, id_customer, id_zone, dni,
                    description, user_create, date_create, user_update, date_update, flag_state)
                    VALUES(null, ?, ?, null, ?, ?, ?, null, null, '01')";
                    $file = $this->db->query("SELECT * FROM temp_doc WHERE id = {$id_tmp}")->fetch(PDO::FETCH_OBJ);
                    if ($file) {
                        if ($file->tipo == 'xlsx' || $file->tipo == 'xls') {
                            $document = IOFactory::load($file->ruta);
                            $current_sheet = $document->getSheet(0);
                            $rows_total = $current_sheet->getHighestDataRow();
                            $letter_max = $current_sheet->getHighestColumn();
                            $num_letter = Coordinate::columnIndexFromString($letter_max);
                            for ($index_row = 1; $index_row <= $rows_total; $index_row++) {
                                $distrito = $current_sheet->getCellByColumnAndRow(1, $index_row);
                                $zona = $current_sheet->getCellByColumnAndRow(2, $index_row);
                                $nombre = $current_sheet->getCellByColumnAndRow(3, $index_row);
                                $distrito = quitar_acentos($distrito);
                                $zona = quitar_acentos($zona);
                                $nombre = quitar_acentos($nombre);
                                if ($distrito != "" && $zona != "" && $nombre != "") {
                                    if (strtoupper($distrito) != "DISTRITO" && strtoupper($zona) != "ZONA" && strtoupper($nombre) != "NOMBRE") {
                                        $ds = $this->db->query("SELECT id_district FROM T_DISTRICTS WHERE description LIKE '{$distrito}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                        if ($ds) {
                                            $id_d = $ds->id_district;
                                            $zs = $this->db->query("SELECT id_zone FROM T_ZONES WHERE description LIKE '{$zona}' AND id_district LIKE '{$id_d}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                            if ($zs) {
                                                $exist = $this->db->query("SELECT COUNT(*) as c FROM T_STREETS WHERE id_zone = {$zs->id_zone} AND description LIKE '{$nombre}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                                if ($exist->c == 0) {
                                                    $c = $this->db->prepare($query);
                                                    $c->execute(array($id_usu, $zs->id_zone, strtoupper($nombre), $user_create, $date_create));
                                                }
                                            } else {
                                                $with_errors = true;
                                            }
                                        } else {
                                            $with_errors = true;
                                        }
                                    }
                                }
                            }
                            $msj = $with_errors == true ? 'El archivo ha sido importado correctamente, pero hubo algunos errores.' : 'El archivo ha sido importado correctamente';
                            response_function($msj, FUNCTION_RESPONSE_SUCCESS);
                        } else {
                            if ($file->tipo == 'csv') {
                                $lines = file($file->ruta);
                                $i = 0;
                                $lmx = count($lines);
                                foreach ($lines as $line) {
                                    $count_records = count($lines);
                                    $count_records_added = ($count_records - 1);
                                    if ($i != 0) {
                                        $data = explode(";", $line);
                                        if (count($data) == 3) {
                                            $distrito = strtoupper($data[0]);
                                            $zona = strtoupper($data[1]);
                                            $nombre = strtoupper($data[2]);
                                            $distrito = quitar_acentos($distrito);
                                            $zona = quitar_acentos($zona);
                                            $nombre = quitar_acentos($nombre);
                                            if ($distrito != "" && $nombre != "" && $zona != '') {
                                                if (strtoupper($distrito) != "DISTRITO" && strtoupper($zona) != "ZONA" && strtoupper($nombre) != "NOMBRE") {
                                                    $ds = $this->db->query("SELECT id_district FROM T_DISTRICTS WHERE description LIKE '{$distrito}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                                    if ($ds) {
                                                        $id_d = $ds->id_district;
                                                        $zs = $this->db->query("SELECT id_zone FROM T_ZONES WHERE description LIKE '{$zona}' AND id_district LIKE '{$id_d}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                                        if ($zs) {
                                                            $exist = $this->db->query("SELECT COUNT(*) as c FROM T_STREETS WHERE id_zone = {$zs->id_zone} AND description LIKE '{$nombre}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
                                                            if ($exist->c == 0) {
                                                                $c = $this->db->prepare($query);
                                                                $c->execute(array($id_usu, $zs->id_zone, strtoupper($nombre), $user_create, $date_create));
                                                            }
                                                        } else {
                                                            $with_errors = true;
                                                        }
                                                    } else {
                                                        $with_errors = true;
                                                    }
                                                }
                                            } else {
                                                $with_errors = true;
                                            }
                                        } else {
                                            response_function("Error, la plantilla no es válida, descarga la platilla desde la página de plantillas.", FUNCTION_RESPONSE_ERROR);
                                            break;
                                        }
                                    }
                                    $i++;
                                }
                                if ($i == $lmx) {
                                    $msj = $with_errors == true ? 'El archivo ha sido importado correctamente, pero hubo algunos errores.' : 'El archivo ha sido importado correctamente';
                                    // the foreach ended successfully
                                    response_function($msj, FUNCTION_RESPONSE_SUCCESS);
                                }
                            } else {
                                response_function("Archivo de importación no admitido");
                            }
                        }
                    }
                    break;
            }
        }
    }
    public function get_zones_by_district($id)
    {
        $c = $this->db->query("SELECT * FROM T_ZONES WHERE id_district = {$id} AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        json_return($c);
    }
    public function get_streets_by_zone($id)
    {
        $c = $this->db->query("SELECT * FROM T_STREETS WHERE id_zone = {$id} AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        json_return($c);
    }
    public function crud_assign($req)
    {
        $id_coord = $req['id_coord'];
        $distrito = $req['distrito'];
        $id_zone = $req['zona'];
        $id_street = $req['manzana'];
        $type = $req['type'];
        $table = "";
        $flg_ = "";
        $delimiter = "";
        if ($type == "distrito") {
            $table = "T_DISTRICTS";
            $flg_ = "id_district";
            $delimiter = $distrito;
        }
        if ($type == "zona") {
            $table = "T_ZONES";
            $flg_ = "id_zone";
            $delimiter = $id_zone;
        }
        if ($type == "manzana") {
            $table = "T_STREETS";
            $delimiter = $id_street;
            $flg_ = "id_street";
        }
        $stmx = $this->db->query("UPDATE T_DISTRICTS SET dni = null WHERE dni = '{$id_coord}' AND id_customer = {$this->id_usu} ");
        $stm = "UPDATE " . $table . " SET dni = " . $id_coord . " WHERE " . $flg_ . " = " . $delimiter;
        $c  = $this->db->query($stm);
        if ($c) {
            response_function('Coordinador Asignado Correctamente', FUNCTION_RESPONSE_SUCCESS);
        } else {
            response_function('Error', FUNCTION_RESPONSE_ERROR);
        }
    }
    public function register_msj_rep($req)
    {
        $tlf = $req['tlf'];
        $nombre = $req['nombre'];
        $msj = "SE HA DADO LA BIENVENIDA AL USUARIO: " . $req['nombre'] . " CON EL NÚMERO: " . $tlf;
        $stm = "INSERT INTO T_REPORTS_WSP (id, id_customer, dni, 
        description, flag_state, user_create, date_create)
        VALUES(null, ?, ?, ?, '01', ?, ?)";
        $id_customer = Session::get('usuid');
        $date =  date("Y-m-d H:i:s");
        $user_create = Session::get('dni');
        $c = $this->db->prepare($stm);
        $is_sended = $c->execute(array($id_customer, $user_create, $msj, $user_create, $date));
    }
    public function get_credentials()
    {
        $c = $this->db->query("SELECT * FROM T_SETTING WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        if ($c) {
            $err = false;
            if ($c->url_logo != null) {
                Session::set('url_logo', $c->url_logo);
            } else {
                Session::set('url_logo', '');
                $err = true;
            }
            if ($c->app_name != null) {
                Session::set('app_name', $c->app_name);
            } else {
                Session::set('app_name', 'DEBUG SYS VOTOS');
                $err = true;
            }
            if ($c->token_twilio != null) {
                Session::set('token_twilio', $c->token_twilio);
            } else {
                Session::set('token_twilio', '');
                $err = true;
            }
            if ($c->ssid_twilio != null) {
                Session::set('ssid_twilio', $c->ssid_twilio);
            } else {
                Session::set('ssid_twilio', '');
                $err = true;
            }
            if ($c->mensaje_bienvenida != null) {
                Session::set('mensaje_bienvenida', $c->mensaje_bienvenida);
            } else {
                Session::set('mensaje_bienvenida', '');
                $err = true;
            }
            if ($c->wheather_key != null) {
                Session::set('wheather_key', $c->wheather_key);
            } else {
                Session::set('wheather_key', '');
                $err = true;
            }
            if ($c->number_wsp != null) {
                Session::set('number_wsp', $c->number_wsp);
            } else {
                Session::set('number_wsp', '');
                $err = true;
            }
            if ($c->number_sms != null) {
                Session::set('number_sms', $c->number_sms);
            } else {
                Session::set('number_sms', '');
                $err = true;
            }
            if ($c->messaging_service != null) {
                Session::set('messaging_service', $c->messaging_service);
            } else {
                Session::set('messaging_service', '');
                $err = true;
            }
            if ($c->instance_id != null) {
                Session::set('instance_id', $c->instance_id);
            } else {
                Session::set('instance_id', '');
            }

            if ($c->token_instance != null) {
                Session::set('token_instance', $c->token_instance);
            } else {
                Session::set('token_instance', '');
            }
            if ($c->default_message != null) {
                Session::set('default_message', $c->default_message);
            } else {
                Session::set('default_message', '');
            }
            if ($c->codigo_pais != null) {
                Session::set('codigo_pais', $c->codigo_pais);
            } else {
                Session::set('codigo_pais', '');
            }
            if ($err == true) {
                $msj = "Favor de actualizar la configuración del sistema<br/><br/>Faltan Parametros del Sistema.<br><br><a href='" . URL . "super/ajustes/' class='btn btn-primary col-12'><i class='mdi mdi-application-cog'></i> Configuración</a>";
                response_function($msj, FUNCTION_RESPONSE_ERROR);
            } else {
                response_function('', FUNCTION_RESPONSE_SUCCESS);
            }
        } else {
            $msj = "Favor de actualizar la configuración del sistema<br/><br/>Faltan Parametros del Sistema.<br><br><a href='" . URL . "super/ajustes/' class='btn btn-primary col-12'><i class='mdi mdi-application-cog'></i> Configuración</a>";
            response_function($msj, FUNCTION_RESPONSE_ERROR);
        }
    }
}
