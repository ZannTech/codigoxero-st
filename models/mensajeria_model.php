<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

class Mensajeria_Model extends Model
{
    public $id_usu = USUID;

    public function __construct()
    {
        parent::__construct();
    }
    public function get_plantils_v()
    {
        return $this->db->query("SELECT * FROM T_TEMPLATE_MSJ WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function get_distritos()
    {
        return $this->db->query("SELECT * FROM T_DISTRICTS WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
    }
    public function get_persons()
    {
        return $this->db->query("SELECT * FROM T_PERSONS WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
    }
    public function crud_plantilla($req)
    {
        $id = $req['id'];
        $body = $req['body'];
        $name = $req['name'];
        if ($id == '') {
            // add
            $stm = $this->db->prepare("INSERT INTO T_TEMPLATE_MSJ (id, id_customer, nombre, body, status, fecha_registro) VALUES (null, ?, ?, ?, ?, ?)");
            if ($stm->execute([$this->id_usu, $name, $body, "a", date('Y-m-d H:i:s')])) {
                response_function("Plantilla agregada correctamente", true);
            } else {
                response_function("Error", true);
            }
        } else {
            // edit
        }
    }
    public function delete($id)
    {
        $c = $this->db->query("DELETE FROM T_TEMPLATE_MSJ WHERE id = {$id}");
    }
    public function get_body($id)
    {
        $c = $this->db->query("SELECT body FROM T_TEMPLATE_MSJ WHERE id = {$id}")->fetch(PDO::FETCH_OBJ);
        json_return($c);
    }
    public function get_templates()
    {
        $c = $this->db->query("SELECT * FROM T_TEMPLATE_MSJ WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        json_return($c);
    }
    public function get_countries()
    {
        return $this->db->query('SELECT * FROM T_COUNTRY')->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_zonas()
    {
        return $this->db->query("SELECT * FROM T_ZONES WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_mensajes()
    {
        $c = $this->db->query("SELECT dni, description, flag_state, date_create FROM T_REPORTS_WSP WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c as $k => $d) {
            $c[$k]->{'cliente'} = $this->db->query("SELECT UPPER(CONCAT(whatsApp,' | ', first_name, ' ', last_name)) as nombre FROM T_PERSONS WHERE dni = '{$d->dni}' AND id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
        }
        json_return($c);
    }

    public function send_message($req)
    {
        $type = $req['type_send'];
        $delay = intval($req['delay']);

        $lada = $req['lada_phone'];
        $msx = intval($req['msx']);
        $enviados = 0;
        $current = 0;
        $err = 0;
        $msj_sends = 0;
        $media = $req['file'];

        $msj = $req['default'] == 1 ? MENSAJE_DEFAULT : $req['message'];
        $msj = $req['plantilla'] == '' ? $msj : $req['plantilla'];
        if ($req['input_contacts'] != '') {
            $id_tmp = $req['input_contacts'];
            $id_zone = $req['id_zone'];
            $file = $this->db->query("SELECT * FROM temp_doc WHERE id = {$id_tmp}")->fetch(PDO::FETCH_OBJ);
            if ($file->tipo === 'csv') {

                $id_customer = Session::get('usuid');
                $date = date('Y-m-d H:i:s');
                $user_create = Session::get('dni');
                $stm = "INSERT INTO T_REPORTS_WSP (id, id_customer, dni, 
                description, flag_state, user_create, date_create)
                VALUES(null, ?, ?, ?, '01', ?, ?)";
                $db_report = 'ENVÍO DEL SIGUIENTE MENSAJE: ' . $msj;
                if ($media) {
                    $db_report .= "\nADJUNTADO CON EL SIGUIENTE <a href='" . $media . "' target='_blank'>ARCHIVO</a>";
                }

                $lines = file($file->ruta);
                $i = 0;
                $lmx = count($lines);
                foreach ($lines as $line) {
                    $count_records = count($lines);
                    $count_records_added = ($count_records - 1);
                    $data = explode(',', $line);
                    if (count($data) == 2) {
                        $value = strtoupper($data[0]);
                        $name = strtoupper($data[1]);
                        $value = trim($value);
                        $value = str_replace('?', '', $value);

                        if ($value != '' && $value != 'NUMERO' && $name != 'NOMBRE' && $name != '' && $value != '?NUMERO' && $name != '?NOMBRE') {
                            $msj = str_replace('{{1}}', $name, $msj);
                            $rest = twilio_comm($msj, $type, $media ? $media : null, $value, $lada);
                            if ($rest != null) {
                                $desc = "Se envió mensaje a: $lada $value, con el mensaje: $msj";
                                $stm = $this->db->prepare('INSERT INTO T_REPORTS_WSP (id, id_customer, dni, 
                                description, flag_state, type, user_create, date_create) VALUES (null, ?, ?, ?, ?, ?, ?, ?)');
                                $stm->execute([$this->id_usu, null, $desc, '01', $type, $this->id_usu, date('Y-m-d H:i:s')]);
                                ++$enviados;
                            } else {
                                $stm = $this->db->prepare('INSERT INTO T_NUM_ERROR (id_customer, number) VALUES (?, ?)');
                                $stm->execute([$this->id_usu, $value]);
                                ++$err;
                            }
                            if ($current == $msx) {
                                $current = 0;
                                sleep($delay);
                            } else {
                                ++$current;
                            }
                        }
                    } else {
                        response_function('Error, la plantilla no es válida, descarga la platilla desde la página de plantillas.', FUNCTION_RESPONSE_ERROR);
                        break;
                    }
                }
                response_function("SE HAN ENVIADO $enviados MENSAJES CON $err NÚMEROS ERRONEOS ", FUNCTION_RESPONSE_SUCCESS);
            } else {
                $document = IOFactory::load($file->ruta);
                $current_sheet = $document->getSheet(0);
                $rows_total = $current_sheet->getHighestDataRow();
                $letter_max = $current_sheet->getHighestColumn();
                for ($index_row = 1; $index_row <= $rows_total; $index_row++) {
                    $numero = $current_sheet->getCellByColumnAndRow(1, $index_row);
                    $nombre = $current_sheet->getCellByColumnAndRow(2, $index_row);
                    $nombre = quitar_acentos($nombre);
                    $numero = str_replace(' ', '', $numero);
                    $numero = str_replace('?', '', $numero);

                    if (strtoupper($numero) != "NUMERO" && strtoupper($nombre) != "NOMBRE") {
                        if ($numero != "" && $nombre != "") {
                            $msj = str_replace('{{1}}', $nombre, $msj);
                            $rest = twilio_comm($msj, $type, $media ? $media : null, $numero, $lada);
                            if ($rest != null) {
                                $desc = "Se envió mensaje a: $lada $numero, con el mensaje: $msj";
                                $stm = $this->db->prepare('INSERT INTO T_REPORTS_WSP (id, id_customer, dni, 
                                description, flag_state, type, user_create, date_create) VALUES (null, ?, ?, ?, ?, ?, ?, ?)');
                                $stm->execute([$this->id_usu, null, $desc, '01', $type, $this->id_usu, date('Y-m-d H:i:s')]);
                                ++$enviados;
                            } else {
                                $stm = $this->db->prepare('INSERT INTO T_NUM_ERROR (id_customer, number) VALUES (?, ?)');
                                $stm->execute([$this->id_usu, $numero]);
                                ++$err;
                            }
                            if ($current == $msx) {
                                $current = 0;
                                sleep($delay);
                            } else {
                                ++$current;
                            }
                        } else {
                        }
                    }
                }
                response_function("SE HAN ENVIADO $enviados MENSAJES CON $err NÚMEROS ERRONEOS ", FUNCTION_RESPONSE_SUCCESS);
            }
        } else {

            $id_zone = $req['id_zone'];
            $table = $id_zone[0] == "D" ? "id_district" : "ID_ZONE";
            $id_zone = substr($id_zone, 2);
            $whatsApp = $this->db->query("SELECT dni, whatsApp, phone FROM T_PERSONS WHERE {$table} = {$id_zone} AND whatsApp <> '' AND whatsApp IS NOT NULL AND id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
            $msj_sends = 0;
            $id_customer = Session::get('usuid');
            $media = $req['file'];


            $stm = "INSERT INTO T_REPORTS_WSP (id, id_customer, dni, 
            description, flag_state, user_create, date_create)
            VALUES(null, ?, ?, ?, '01', ?, ?)";
            $db_report = 'ENVÍO DEL SIGUIENTE MENSAJE: ' . $msj;
            if ($whatsApp) {
                foreach ($whatsApp as $key => $d) {
                    $number = $type == 'msj' ? $d->whatsApp : $d->phone;
                    $rest = twilio_comm($msj, $type, $media ? $media : null, $d->whatsApp);
                    if ($rest != null) {
                        $desc = "Se envió mensaje a: $number,\n con el mensaje: $msj";
                        $stm = $this->db->prepare('INSERT INTO T_REPORTS_WSP (id, id_customer, dni, 
                        description, flag_state, type, user_create, date_create) VALUES (null, ?, ?, ?, ?, ?, ?, ?)');
                        $stm->execute([$this->id_usu, null, $desc, '01', $type, $this->id_usu, date('Y-m-d H:i:s')]);
                        ++$enviados;
                    } else {
                        $stm = $this->db->prepare('INSERT INTO T_NUM_ERROR (id_customer, number) VALUES (?, ?)');
                        echo $d->number;
                        $stm->execute([$this->id_usu, $d->number]);
                        ++$err;
                    }
                    if ($current == $msx) {
                        $current = 0;
                        sleep($delay);
                    } else {
                        ++$current;
                    }
                }
                response_function("SE HAN ENVIADO $enviados MENSAJES CON $err NÚMEROS ERRONEOS ", FUNCTION_RESPONSE_SUCCESS);
            } else {
                response_function('No hay ninguna persona con whatsApp en la zona seleccionada', FUNCTION_RESPONSE_ERROR);
            }
        }
    }

    public function get_files()
    {
        $c = $this->db->query("SELECT * FROM T_FILES WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        json_return($c);
    }

    public function get_files_cn()
    {
        // get files in the controller
        return $this->db->query("SELECT * FROM T_FILES WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
    }

    public function config_save($data)
    {
        $instance = $data['instance'];
        $token = $data['token'];
        $id_customer = $this->id_usu;
        $stm = $this->db->prepare('UPDATE T_SETTING SET instance_id = ? , token_instance = ? WHERE id_customer = ?');
        if ($stm->execute([$instance, $token, $id_customer])) {
            response_function('Configuración Actualizada', 1);
        }
    }

    public function get_errores()
    {
        $c = $this->db->query("SELECT * FROM T_NUM_ERROR WHERE id_customer = {$this->id_usu}")->fetchAll(PDO::FETCH_OBJ);
        json_return($c);
    }
    public function get_info_file($id)
    {
        json_return($this->db->query("SELECT * FROM T_FILES WHERE id_file = {$id}")->fetch(PDO::FETCH_OBJ));
    }
}
