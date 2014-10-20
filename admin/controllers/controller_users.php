<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_users
 *
 * @author rooter
 */
class controller_users extends Controller {
    public function __construct() {
        parent::__construct();
        $this->model = new model_users();
    }
    
    public function index_action(&$data=array(), &$vParams = array()) {
        $data['title'] = "Учётные записи пользователей";
        $data['data'] = $this->model->GetUsersList();
        $data['pagination'] = Pagination::navigation("admin.php?component={$vParams["component"]}&action={$vParams["action"]}&page=");
        $this->view->GetTemplate("users/show_elements.phtml","main.phtml", $data);
    }
}
