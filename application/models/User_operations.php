<?php

    class User_operations extends CI_Model{
        function signup($form) {
            $res = $this->db->insert('users',$form);   
            if($res){
                return $res = 1;
            }
        }
        function login($form){
            $this->db->select('*');
            $this->db->from('users');
            $where = array('email'=> $form['email'], 'password'=>$form['password']);
            $this->db->where($where);
            $res = $this->db->get();
            if($res->num_rows()>0){
                return $res->row();
            }
        }
    }
?>