<?php

class Tipo_Model extends Model
{
    var $id_usu = USUID;
	public function __construct()
	{
		parent::__construct();
	}
    
    public function get_tipos(){
        $c = $this->db->query("SELECT * FROM T_TYPEUSERS")->fetchAll(PDO::FETCH_OBJ);
        if($c){
            foreach($c as $k => $d){
                $c[$k]->{'customer'} = $this->db->query("SELECT description FROM T_CUSTOMERS WHERE id_customer  = {$d->id_customer}")->fetch(PDO::FETCH_OBJ);
            }
        }
        json_return($c);
    }

    public function get_distritos(){
        $c = $this->db->query("SELECT * FROM T_DISTRICTS")->fetchAll(PDO::FETCH_OBJ);
        if($c){
            foreach($c as $k => $d){
                $c[$k]->{'customer'} = $this->db->query("SELECT description FROM T_CUSTOMERS WHERE id_customer  = {$d->id_customer}")->fetch(PDO::FETCH_OBJ);
            }
        }
        json_return($c);
    }
}