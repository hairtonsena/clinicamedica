<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Secretario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userLogado();
        $this->load->library('form_validation');
        $this->load->model('SecretarioModel');
    }

    private function userLogado() {
        if ($this->session->userdata('userLogado') != 'sim') {
            redirect(base_url("permissao"));
        }
    }

    private function permissao($tipo) {
        if ($this->session->userdata('userTipo') != $tipo) {
            redirect(base_url());
        }
    }

    private function create_forme() {
        $form = array(
            'nome' => '',
            'idade' => '',
            'sexo' => '',
            'identidade' => '',
            'telefone' => '',
            'email' => '',
            'logradouro' => '',
            'numero' => '',
            'bairro' => '',
            'cidade' => '',
            'cep' => '',
//            'crm' => '',
//            'especializacao' => '',
            'codigo' => '',
            'senha' => ''
        );

        return $form;
    }

    public function index() {
        $this->permissao('ADMIN');

        $medicos = $this->SecretarioModel->obterTodosSecretario()->result();

        $dadosView = array(
            'secretarios' => $medicos
        );
        $this->load->view('Secretario/index.php', $dadosView);
    }

    public function novo() {
        $this->permissao('ADMIN');

        $form = $this->create_forme();

        if ($this->input->post('submit') == "abc") {

            $form = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('idade', 'Idade', 'required|numeric');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required');
            $this->form_validation->set_rules('identidade', 'Identidade', 'required|trim|min_length[5]');

            $this->form_validation->set_rules('telefone', 'Telefone', 'required|trim|min_length[9]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');


            $this->form_validation->set_rules('logradouro', 'Logradouro', 'required');
            $this->form_validation->set_rules('numero', 'Numero', 'required');
            $this->form_validation->set_rules('bairro', 'Bairro', 'required');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required');
            $this->form_validation->set_rules('cep', 'CEP', 'required');

            $this->form_validation->set_rules('codigo', 'Código', 'required');
            $this->form_validation->set_rules('senha', 'Senha', 'required');


            if ($this->form_validation->run()) {
                $form['senha'] = md5($form['senha']);
                $form['tipo'] = 'SECRETARIO';
                $form['status'] = TRUE;
                $form['create_at'] = date('Y-m-d H:i:s');

                $this->messagemSecesso('Secretario inserido com sucesso');
                $this->SecretarioModel->SalvarDados($form);

                redirect(base_url('secretario'));
            }
        }


        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Secretario/novo', $dados_view);
    }

    public function alterar() {
        $this->permissao('ADMIN');

        $idSecretario = (int) strip_tags($this->uri->segment(3));

        $secretario = $this->SecretarioModel->obterSecretarioId($idSecretario)->result();
        if (count($secretario) == 0) {
            $this->messagemErro('Secretario não foi encontrado');
            redirect(base_url('secretario'));
        }



        $form = (array) $secretario[0];

        if ($this->input->post('submit') == "abc") {

            $form = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('idade', 'Idade', 'required|numeric');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required');
            $this->form_validation->set_rules('identidade', 'Identidade', 'required|trim|min_length[5]');

            $this->form_validation->set_rules('telefone', 'Telefone', 'required|trim|min_length[9]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');


            $this->form_validation->set_rules('logradouro', 'Logradouro', 'required');
            $this->form_validation->set_rules('numero', 'Numero', 'required');
            $this->form_validation->set_rules('bairro', 'Bairro', 'required');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required');
            $this->form_validation->set_rules('cep', 'CEP', 'required');

//            $this->form_validation->set_rules('crm', 'CRM', 'required');
//            $this->form_validation->set_rules('especializacao', 'Especializacao', 'required');

            $this->form_validation->set_rules('codigo', 'Código', 'required');
            $this->form_validation->set_rules('senha', 'Senha', '');


            if ($this->form_validation->run()) {
                if($this->input->post('senha')!=""){
                    $form['senha'] = md5($form['senha']);
                }else{
                    $form['senha'] = $secretario->senha;
                }
                $form['tipo'] = $secretario[0]->tipo;
                $form['status'] = $secretario[0]->status;
                $form['create_at'] = $secretario[0]->create_at;

                
                $this->messagemSecesso('Secretario alterado com sucesso');
                $this->SecretarioModel->SalvarDados($form, $idSecretario);

                redirect(base_url('secretario'));
            }
        }

        $form = (array) $secretario[0];

        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Secretario/alterar', $dados_view);
    }

    public function excluir() {
        $this->permissao('ADMIN');

        $idSecretario = (int) strip_tags($this->uri->segment(3));

        $secretario = $this->SecretarioModel->obterSecretarioId($idSecretario)->result();
        if (count($secretario) == 0) {
            $this->messagemErro('Secretário não encotrado');
            redirect(base_url('secretario'));
        }
        
        $this->SecretarioModel->excluirSecretario($secretario[0]->idendereco);
        
        $this->messagemSecesso('Secretário excluido com sucesso');
        redirect(base_url('secretario'));
    }

    
    private function messagemSecesso($msg){
        $this->session->set_flashdata('sucesso',$msg);
    }
    private function messagemErro($msg){
        $this->session->set_flashdata('erro',$msg);
    }
}
