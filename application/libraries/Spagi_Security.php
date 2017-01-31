<?php
/**
 * Description of Spagi_Security
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
class Spagi_Security {
    
    protected $CI;
    public $user;
    public $token='';
    public $encryption_key = '';
    public $session_expire = 0;
    public $base_url = '';
    
    public function __construct() 
    {
        $this->CI = & get_instance();
        $this->CI->load->library('Spagi_Session');
        $this->CI->load->library('encryption');
        
        //Initializes encription
        $this->encryption_key = hex2bin($this->CI->config->item('encryption_key'));
        $this->CI->encryption->initialize(
            array(
                'driver' =>'openssl',
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $this->encryption_key
            )                
        );

        $this->session_expire = $this->CI->config->item('sess_expiration');
        $this->base_url = $this->CI->config->item('base_url');
    }
    
    public function secure($format="html") 
    {
        //Traditional login
        //TODO: Add suport for auth0
        $error = FALSE;
        
        $this->user = $this->CI->spagi_session->get('user');
        if(!$this->user) {
            $error_message = $this->CI->spagi_i18n->_('__global__ No user');
            $error = TRUE;
        }
        if(!$this->validate_token()) {
            $error_message = $this->CI->spagi_i18n->_('__global__ Session Expired');
            $error = TRUE;
        }
        
        if($error) {
            if($format==='rest') {
                $this->CI->jsonresponse->respond(null,403);
            } else if($format==='json') {
                $this->CI->jsonresponse->respond(
                    array(
                        'result'=>'error',
                        'message'=>$error_message
                    ),
                    403
                );
            } else {
                $this->CI->load->helper('url');
                redirect('/login/index', 'refresh');                
            }
        }
    }
    
    public function login() 
    {
        $username = $this->CI->input->post('email');
        $password = $this->CI->input->post('password');
        
        if(!$username) {
            $this->CI->jsonresponse->respond(
                array(
                    'result'=>'error',
                    'message'=>$this->CI->spagi_i18n->_('__global__ No username')
                )
            );
        }
        
        if(!$password) {
            $this->CI->jsonresponse->respond(
                array(
                    'result'=>'error',
                    'message'=>$this->CI->spagi_i18n->_('__global__ No password')
                )
            );
        }
        
        $this->CI->load->model('User_users_model');
        $result = $this->CI->User_users_model->validate_login($username,$password);
        if($result) {
            $user = $result[0];
            if(md5($password) != $user->password) {
                $this->CI->jsonresponse->respond(
                    array(
                        'result'=>'error',
                        'message'=>$this->CI->spagi_i18n->_('__global__ Wrong email or password!')
                    )
                );
            }
            
            if($user->active == 0) {
                $this->CI->jsonresponse->respond(
                    array(
                        'result'=>'error',
                        'message'=>$this->CI->spagi_i18n->_('__global__ Account inactive!')
                    )
                );
            }
            
            if($user->deleted > 0) {
                $this->CI->jsonresponse->respond(
                    array(
                        'result'=>'error',
                        'message'=>$this->CI->spagi_i18n->_('__global__ Account deleted!')
                    )
                );
            }
            
            $this->user = $user;
            $this->assign_security();
            $this->CI->spagi_session->set('user',$this->user);
            $this->CI->jsonresponse->respond(
                array(
                    'result'=>'ok',
                    'message'=>'/app/dashboard',
                    'token'=>$this->token
                )
            );
        }
        
        $this->CI->jsonresponse->respond(
            array(
                'result'=>'error',
                'message'=>$this->CI->spagi_i18n->_('__global__ Account not found!'),
            )
        );
    }
    
    public function assign_security() 
    {
        $currnetTimestamp = new DateTime();
        //var_dump($this->user);die;
        $this->user->last_login = $currnetTimestamp->format('Y-m-d H:i:s');
        $this->user->last_operation = $currnetTimestamp->format('Y-m-d H:i:s');
        $this->CI->User_users_model->update($this->user);
        $this->user->password = '';
        $this->make_token();
    }
    
    public function make_token() 
    {
        $token_data = array(
            'email'=>$this->user->email,
            'first_name'=>$this->user->first_name,
            'surename'=>$this->user->surename,
            'created_date'=>$this->user->created_date,
            'last_operation'=>$this->user->last_operation,
        );
        
        $json_data = json_encode($token_data);
        $this->token = $this->CI->encryption->encrypt($json_data);
        $this->CI->spagi_session->set('token',$this->token);
        $this->CI->input->set_cookie( array(
            'name' => 'token',
            'value' => $this->token,
            'expire' => $this->session_expire,
            'domain' => $this->base_url,
            'path' => '/'
            )
        );
    }
    
    public function validate_token() 
    {
        return true;
        //TODO: See later
        $cookie = $this->CI->input->cookie('token');
        if(!$cookie) {
            return false;
        }
        
        $token = $cookie['value'];
        $session_token = $this->CI->spagi_session->get('token');
        if($session_token != $token) {
            return false;
        }
        return true;
    }
}
