<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userLogado();
        $this->load->library('form_validation');
        $this->load->model('PacienteModel');
    }

    private function userLogado() {
        if ($this->session->userdata('userLogado') != 'sim') {
            redirect(base_url("permissao"));
        }
    }

    private function permissao($tipo) {
        $verificar = FALSE;
        for ($i = 0; $i < count($tipo); $i++) {
            if ($this->session->userdata('userTipo') == $tipo[$i]) {
                $verificar = TRUE;
               
                break;
            }
        }
        
        if($verificar==FALSE){
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
            'fixa' => '',
            'data_entrada' => '',
            'status' => '1',
        );

        return $form;
    }

    public function index() {
        $this->permissao(['ADMIN','MEDICO','SECRETARIO']);

        $pacientes = $this->PacienteModel->obterTodosPaciente()->result();

        $dadosView = array(
            'pacientes' => $pacientes
        );
        $this->load->view('Paciente/index.php', $dadosView);
    }

    public function novo() {
        $this->permissao(['ADMIN','MEDICO','SECRETARIO']);

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


            if ($this->form_validation->run()) {
                $form['data_entrada'] = date('Y-m-d H:i:s');

                if (!$this->input->post('status')) {
                    $form['status'] = 0;
                }

                $this->messagemSecesso('Paciente inserido com sucesso');
                $this->PacienteModel->SalvarDados($form);

                redirect(base_url('paciente'));
            }
        }


        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Paciente/novo', $dados_view);
    }

    public function alterar() {
        $this->permissao(['ADMIN','MEDICO']);

        $idPaciente = (int) strip_tags($this->uri->segment(3));

        $paciente = $this->PacienteModel->obterPacienteId($idPaciente)->result();
        if (count($paciente) == 0) {
            $this->messagemErro('Paciente não foi encontrado');
            redirect(base_url('paciente'));
        }



        $form = (array) $paciente[0];

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


            if ($this->form_validation->run()) {

                $form['data_entrada'] = $paciente[0]->data_entrada;

                $this->messagemSecesso('Paciente alterado com sucesso');
                $this->PacienteModel->SalvarDados($form, $idPaciente);

                redirect(base_url('paciente'));
            }
        }

        $form = (array) $paciente[0];

        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Paciente/alterar', $dados_view);
    }

    public function excluir() {
        $this->permissao(['ADMIN','MEDICO']);

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

    private function messagemSecesso($msg) {
        $this->session->set_flashdata('sucesso', $msg);
    }

    private function messagemErro($msg) {
        $this->session->set_flashdata('erro', $msg);
    }

}
