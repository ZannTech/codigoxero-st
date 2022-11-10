<?php
check_session();

use Twilio\Rest\Client;

class Mensajeria extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        header("Location: " . URL . 'mensajeria/app');
    }
    function plantillas()
    {
        $this->view->js = array('mensajeria/new/js/all_plantillas.js');
        $this->view->render('mensajeria/new/config/config_templates', false);
    }
    function delete($id)
    {
        $this->model->delete($id);
    }
    public function get_body($id)
    {
        $this->model->get_body($id);
    }
    function crud_plantilla()
    {
        $this->model->crud_plantilla($_POST);
    }
    function get_templates()
    {
        $this->model->get_templates();
    }
    function app($type = null)
    {
        $type == null ? internal_error() : '';
        !$type == "internal" || !$type == "external" ? internal_error() : '';
        $this->view->type = $type;
        $this->view->plantillas = $this->model->get_plantils_v();
        $this->view->countries = $this->model->get_countries();
        $this->view->distritos = $this->model->get_distritos();
        $this->view->files = $this->model->get_files_cn();
        $this->view->zonas = $this->model->get_zonas();
        $this->view->js = array('mensajeria/js/all_index.js');
        $this->view->render('mensajeria/index', false);
    }
    function errores()
    {
        $this->view->js = array('mensajeria/js/all_error.js');
        $this->view->render('mensajeria/all/all_error', false);
    }
    function config()
    {
        $this->view->js = array('mensajeria/js/all_config.js');
        $this->view->render('mensajeria/all/config', false);
    }
    function reporte()
    {
        $this->view->js = array('mensajeria/js/all_reportes.js');
        $this->view->render('mensajeria/all/all_reportes', false);
    }
    function test()
    {
        $this->view->js = array('mensajeria/js/all_test.js');
        $this->view->render('mensajeria/all/test', false);
    }
    function send_message()
    {
        $this->model->send_message($_POST);
    }
    function get_reports()
    {
        $this->model->get_report();
    }
    function get_distritos()
    {
    }
    function get_mensajes()
    {
        $this->model->get_mensajes();
    }
    function archivos()
    {
        $this->view->js = array('mensajeria/js/all_files.js');
        $this->view->render('mensajeria/all/all_files', false);
    }
    function get_files()
    {
        $this->model->get_files();
    }
    function config_save()
    {
        $this->model->config_save($_POST);
    }
    function get_errores()
    {
        $this->model->get_errores();
    }
    function get_info_file($id)
    {
        $this->model->get_info_file($id);
    }
    function call()
    {
        $number = $_POST['user'];
        $say = $_POST['text'];
        try {
            $twilio = new Client(SSID, TOKEN);
            $call = $twilio->calls
                ->create(
                    "$number", // to
                    "+18559283965", // from
                    [
                        "twiml" => "<Response><Say>$say</Say></Response>"
                    ]
                );
            if ($call) {
                response_function("Se llamó al " . $number  . " correctamente");
            } else {
                response_function("Error interno");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function create_call()
    {
        $this->view->persons = $this->model->get_persons();
        $this->view->js = array('mensajeria/js/calls.js');
        $this->view->render('mensajeria/calls', false);
    }
}
