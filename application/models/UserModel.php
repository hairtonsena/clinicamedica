<?php

class UserModel extends CI_Model {
    
    public function obterUserLogin($dados){
        $this->db->join('pessoa','pessoa.idpessoa = user.pessoa_idpessoa');
        return $this->db->get_where('user',$dados);
    }
}
