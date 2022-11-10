<?php
check_session();
class Profile extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->view->data = $this->model->get_data();
        $this->view->js = array("profile/js/all_edit.js");
        $this->view->render('profile/edit', false);
    }
}
