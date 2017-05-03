<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userLogado();
        $this->load->library('form_validation');
        $this->load->model('MedicoModel');
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
            'crm' => '',
            'especializacao' => '',
            'codigo' => '',
            'senha' => ''
        );

        return $form;
    }

    public function index() {
        $this->permissao('ADMIN');

        $medicos = $this->MedicoModel->obterTodosMedico()->result();

        $dadosView = array(
            'medicos' => $medicos
        );
        $this->load->view('Medico/index.php', $dadosView);
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

            $this->form_validation->set_rules('crm', 'CRM', 'required');
            $this->form_validation->set_rules('especializacao', 'Especializacao', 'required');

            $this->form_validation->set_rules('codigo', 'Código', 'required');
            $this->form_validation->set_rules('senha', 'Senha', 'required');


            if ($this->form_validation->run()) {
                $form['senha'] = md5($form['senha']);
                $form['tipo'] = 'MEDICO';
                $form['status'] = TRUE;
                $form['create_at'] = date('Y-m-d H:i:s');

                $this->messagemSecesso('Médico inserido com sucesso');
                $this->MedicoModel->SalvarDados($form);

                redirect(base_url('medico'));
            }
        }


        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Medico/novo', $dados_view);
    }

    public function alterar() {
        $this->permissao('ADMIN');

        $idMedico = (int) strip_tags($this->uri->segment(3));

        $medico = $this->MedicoModel->obterMedicoId($idMedico)->result();
        if (count($medico) == 0) {
            $this->messagemErro('Medico não foi encontrado');
            redirect(base_url('medico'));
        }



        $form = (array) $medico[0];

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

            $this->form_validation->set_rules('crm', 'CRM', 'required');
            $this->form_validation->set_rules('especializacao', 'Especializacao', 'required');

            $this->form_validation->set_rules('codigo', 'Código', 'required');
            $this->form_validation->set_rules('senha', 'Senha', '');


            if ($this->form_validation->run()) {
                if($this->input->post('senha')!=""){
                    $form['senha'] = md5($form['senha']);
                }else{
                    $form['senha'] = $medico->senha;
                }
                $form['tipo'] = $medico[0]->tipo;
                $form['status'] = $medico[0]->status;
                $form['create_at'] = $medico[0]->create_at;

                
                $this->messagemSecesso('Médico alterado com sucesso');
                $this->MedicoModel->SalvarDados($form, $idMedico);

                redirect(base_url('medico'));
            }
        }

        $form = (array) $medico[0];

        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Medico/alterar', $dados_view);
    }

    public function excluir() {
        $this->permissao('ADMIN');

        $idMedico = (int) strip_tags($this->uri->segment(3));

        $medico = $this->MedicoModel->obterMedicoId($idMedico)->result();
        if (count($medico) == 0) {
            $this->messagemErro('Médico não encotrado');
            redirect(base_url('medico'));
        }
        
        $this->MedicoModel->excluirMedico($medico[0]->idendereco);
        
        $this->messagemSecesso('Médico excluido com sucesso');
        redirect(base_url('medico'));
    }

    
    private function messagemSecesso($msg){
        $this->session->set_flashdata('sucesso',$msg);
    }
    private function messagemErro($msg){
        $this->session->set_flashdata('erro',$msg);
    }
}
