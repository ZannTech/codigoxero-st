<?php

class Profile_Model extends Model
{
    var $id_usu = USUID;
    public function __construct()
    {
        parent::__construct();
    }
    public function get_data()
    {
        return $this->db->query("SELECT * FROM T_CUSTOMERS WHERE id_customer = {$this->id_usu}")->fetch(PDO::FETCH_OBJ);
    }
    public function edit($data)
    {
        $password = $data['password'];
        $user = $data['user'];
        $description = $data['description'];
        $stm = $this->db->prepare("UPDATE T_CUSTOMERS description = ?, user = ? , password = ? WHERE id_customer = ?");
        if ($stm->execute(array($description, $user, password_hash($password, PASSWORD_BCRYPT), $this->id_usu))) {
            response_function("Perfil Actualizado Correctamente");
        }
    }
}
