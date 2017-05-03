<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controle
 *
 * @author hairton
 */
class Permissao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
    }

    private function credenciaUser($user) {
        $dados_login = array(
            "userId" => $user[0]->iduser,
            "userNome" => $user[0]->nome,
            "userTipo" => $user[0]->tipo,
            "userEmail" => $user[0]->email,
            "userLogado" => "sim",
        );
        
        $this->session->set_userdata($dados_login);
    }

    public function index() {
        if (($this->input->post('login') == 'entrar') && ($this->input->post('tokem') == $this->session->flashdata('tokem'))) {

            $form = $this->input->post(NULL, TRUE);

            $dados_login = array(
                'codigo' => $form['codigo'],
                'senha' => md5($form['senha'])
            );

            $user = $this->UserModel->obterUserLogin($dados_login)->result();

            if (count($user) == 1) {
                $this->credenciaUser($user);
                redirect(base_url());
            }else{
                $this->messagenErro('Usuario não encontrado');
                redirect(base_url('permissao'));
            }
        }

        $tokem = rand('10000', '99999');
        $this->session->set_flashdata("tokem", $tokem);

        $dados['tokem'] = $tokem;
        $this->load->view('Permissao/login.php', $dados);
    }
    
    public function logout(){
        $dados_logout = array(
            "userId",
            "userNome",
            "userTipo" ,
            "userEmail" ,
            "userLogado",
        );
        
        $this->session->unset_userdata($dados_logout);
        
        redirect(base_url('permissao'));
    }

        public function messagenErro($mensagem){
        $this->session->set_flashdata('ERRO',$mensagem);
    }
}
