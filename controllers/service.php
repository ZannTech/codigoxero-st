<?php

use Twilio\Rest\Client;

class Service extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
   
    function upload_file_msj()
    {
        if ($_FILES['file']) {
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            $name = str_replace('.' . $ext, '', $path);
            $dir_file = PATH_FILES . 'file' . '_' . time() . '.' . $ext;
            //The Twilio documentation on sending media over WhatsApp says that supported media includes images (JPEG, JPG, PNG) and audio files and PDF, with a maximum size of 5MB.
            // It looks like you're trying to send a video file, which is currently unsupported.
            $allowedfileExtensions = array('jpg', 'png', 'jpeg', 'png', 'pdf', 'mp3', 'mp4', 'xlsx', 'xls', 'docx');
            if ($file_size <= 5 * MB) {
                if (in_array($ext, $allowedfileExtensions)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $dir_file)) {
                        $id = $this->model->new_file(array(
                            "route" => $dir_file,
                            "type" => $ext,
                            "size" => $file_size
                        ));
                        response_function($id, FUNCTION_RESPONSE_SUCCESS);
                    } else {
                        response_function("Hubo un error al subir el archivo", FUNCTION_RESPONSE_ERROR);
                    }
                } else {
                    response_function("Extensión no permitida", FUNCTION_RESPONSE_ERROR);
                }
            } else {
                response_function("Tamaño de archivo excedido", FUNCTION_RESPONSE_ERROR);
            }
        }
    }
    function upload_logo()
    {
        if ($_FILES['file']) {
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            $name = str_replace('.' . $ext, '', $path);
            $dir_file = PATH_LOGO . md5($name) . '.' . $ext;
            //The Twilio documentation on sending media over WhatsApp says that supported media includes images (JPEG, JPG, PNG) and audio files and PDF, with a maximum size of 5MB.
            // It looks like you're trying to send a video file, which is currently unsupported.
            $allowedfileExtensions = array('jpg', 'png', 'jpeg');
            if ($file_size <= 2 * MB) {
                if (in_array($ext, $allowedfileExtensions)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $dir_file)) {
                        $id = $this->model->new_file_bd(array(
                            "route" => $dir_file,
                            "type" => $ext
                        ));
                        response_function($id, FUNCTION_RESPONSE_SUCCESS);
                    } else {
                        response_function("Hubo un error al subir el archivo", FUNCTION_RESPONSE_ERROR);
                    }
                } else {
                    response_function("Extensión no permitida", FUNCTION_RESPONSE_ERROR);
                }
            } else {
                response_function("Tamaño de archivo excedido", FUNCTION_RESPONSE_ERROR);
            }
        }
    }
    function delete_file_msj()
    {
        $id = $_POST['id_temp'];
        if ($id) {
            $file = $this->model->get_info_file_msj($id);
            if ($file) {
                if (unlink($file->local_route)) {
                    $this->model->delete_file_msj($id);
                } else {
                    response_function("Error al eliminar", FUNCTION_RESPONSE_ERROR);
                }
            }
        }
    }
    function upload_file()
    {
        if ($_FILES['file']) {
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            $dir_file = PATH_DOCS . "imp_tmp_" . time() . '.' . $ext;
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'xlsx', 'csv');
            if ($file_size <= 20 * MB) {
                if (in_array($ext, $allowedfileExtensions)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $dir_file)) {
                        $id = $this->model->new_file_bd(array(
                            "route" => $dir_file,
                            "type" => $ext
                        ));
                        response_function($id, FUNCTION_RESPONSE_SUCCESS);
                    } else {
                        response_function("Hubo un error al subir el archivo", FUNCTION_RESPONSE_ERROR);
                    }
                } else {
                    response_function("Extensión no permitida", FUNCTION_RESPONSE_ERROR);
                }
            } else {
                response_function("Tamaño de archivo excedido", FUNCTION_RESPONSE_ERROR);
            }
        }
    }
    function delete_file()
    {
        $id = $_POST['id_temp'];
        if ($id) {
            $file = $this->model->get_info_file($id);
            if ($file) {
                if (unlink($file->ruta)) {
                    $this->model->delete_file($id);
                } else {
                    response_function("Error al eliminar", FUNCTION_RESPONSE_ERROR);
                }
            }
        }
    }
    function change_credentials($type)
    {
        switch ($type) {
            case 'image':
                $file = $this->model->get_info_file($_POST['id_temp']);
                if ($file) {
                    Session::set('url_logo', $file->ruta);
                    response_function('', FUNCTION_RESPONSE_SUCCESS);
                }
                break;
        }
    }
    function excel_import($table = '')
    {
        $this->model->excel_import($_POST, $table);
    }
    function plantillas()
    {
        $this->view->js = array('service/plantillas/js/all_plantillas.js');
        $this->view->render('service/plantillas/index', false);
    }
    function send_bienvenida()
    {

        try {
            $nm = $_POST['tlf'];
            $nm = str_replace(' ', '', $nm);
            $cliente = $_POST['nombre'];
            $tipo = null;
            switch (true) {
                case $_POST['tipo'] == '1':
                    $tipo = 'SIMPATIZANTE';

                    break;
                case $_POST['tipo'] == '2':
                    $tipo = 'VOLUNTARIO FISICO';

                    break;
                case $_POST['tipo'] == '3':
                    $tipo = 'VOLUNTARIO VIRTUAL';

                    break;
                case $_POST['tipo'] == '4':
                    $tipo = 'COORDINADOR';

                    break;
            }
            $twilio = new Client(SSID, TOKEN);
            $message_to_send = MENSAJE_BIENVENIDA;
            $message_to_send = str_replace('{{1}}', $_POST['nombre'], $message_to_send);
            $message_to_send = str_replace('{{2}}', $tipo, $message_to_send);
            $message = $twilio->messages
                ->create(
                    "whatsapp:$nm", // to
                    [
                        "from" => "whatsapp:" . NUMBER_WSP,
                        "body" => $message_to_send,
                    ]
                );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function get_zones_by_district($id)
    {
        $this->model->get_zones_by_district($id);
    }
    function get_streets_by_zone($id)
    {
        $this->model->get_streets_by_zone($id);
    }
    function gestion_campo_assign()
    {
        $this->model->crud_assign($_POST);
    }
    function get_credentials()
    {
        $this->model->get_credentials();
    }
}
