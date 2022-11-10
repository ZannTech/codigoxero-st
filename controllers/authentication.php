<?php
class Authentication extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        header('Location:' . URL);
    }
    function auth_login()
    {
        if ($_POST) {
            $this->model->auth_login($_POST);
        } else {
            response_function('The controller isnt connected with the browser', -10);
        }
    }
    function logout()
    {
        if ($_POST) {
            sleep(0.5);
            Session::destroy();
        } else {
            response_function('The controller isnt connected with the browser', -10);
        }
    }
}
