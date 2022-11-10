<?php

class Authentication_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function auth_login($req)
    {
        $user = sanitize($req['user'], STRING);
        $pwd = sanitize($req['password'], STRING);
        if (!empty($user) && !empty($pwd)) {
            $stm = $this->db->prepare("SELECT id_customer,password, flag_state FROM T_CUSTOMERS WHERE user = :user");
            $stm->bindParam(':user', $user, PDO::PARAM_STR);
            $stm->execute();
            $c = $stm->fetch(PDO::FETCH_OBJ);

            if ($c) {
                if ($c->flag_state == '01') {
                    if (password_verify($pwd, $c->password)) {
                        $user_data = $this->db->query("SELECT id_customer, dni, 
                        description, user, id_update, date_update 
                        FROM T_CUSTOMERS WHERE id_customer = {$c->id_customer}")->fetch(PDO::FETCH_OBJ);
                        Session::set('loggedIn', true);
                        Session::set('usuid', $user_data->id_customer);
                        Session::set('dni', $user_data->dni);
                        Session::set('description', $user_data->description);
                        Session::set('user', $user_data->user);
                        Session::set('id_update', $user_data->id_update);
                        Session::set('date_update', $user_data->date_update);
                        $c = $this->db->query("SELECT * FROM T_SETTING WHERE id_customer = {$user_data->id_customer}")->fetch(PDO::FETCH_OBJ);
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
                                $err = true;
                            }

                            if ($c->token_instance != null) {
                                Session::set('token_instance', $c->token_instance);
                            } else {
                                Session::set('token_instance', '');
                                $err = true;
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
                        }
                        response_function("Bienvenido de nuevo " . strtolower($user_data->description), FUNCTION_RESPONSE_SUCCESS);
                    } else {
                        response_function('Usuario o contraseña inválidos.', FUNCTION_RESPONSE_ERROR);
                    }
                } else {
                    response_function('La cuenta ingresada está deshabilitada, contáctate con el administrador', FUNCTION_RESPONSE_ERROR);
                }
            } else {
                response_function('Usuario o contraseña inválidos.', FUNCTION_RESPONSE_ERROR);
            }
        } else {
            response_function('Datos ingresados no válidos.', FUNCTION_RESPONSE_ERROR);
        }
    }
}
