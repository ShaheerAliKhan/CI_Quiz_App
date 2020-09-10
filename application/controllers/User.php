<?php

    class User extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('User_operations');
        }
        function signup() {
            $this->load->view('signup');
            if($this->input->post()){
                $form = array(
                    'username'  =>  $this->input->post('username'),
                    'email'     =>  $this->input->post('email'),
                    'password'  =>  $this->input->post('password'),
                );
                $res = $this->User_operations->signup($form);
                if($res == 1){
                    redirect(base_url('index.php/user/login'));
                } 
            }
        }
        function login(){
            $this->load->view('login');
            if($this->input->post()){
                $form = array(
                    'email'     =>  $this->input->post('email'),
                    'password'  =>  $this->input->post('password')
                );
                $res = $this->User_operations->login($form);
                if(!empty($res)){
                    $this->session->set_userdata('id', $res->id);
                    $this->session->set_userdata('username', $res->username);
                    redirect(base_url('index.php/user/dashboard'));
                } else {
                    redirect(base_url('index.php/user/login'));
                }
            }
        }
        function dashboard(){
            $data['user_id'] = $this->session->userdata('id');
            $data['user_name'] = $this->session->userdata('username');
            $this->load->view('dashboard',$data);
        }
    }
?>