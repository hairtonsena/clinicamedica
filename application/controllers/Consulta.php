<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userLogado();
        $this->load->library('form_validation');
        $this->load->model('ConsultaModel');
        $this->load->model('PacienteModel');
        $this->load->model('MedicoModel');
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

        if ($verificar == FALSE) {
            redirect(base_url());
        }
    }

    private function create_forme() {
        $form = array(
            'paciente_idpaciente' => '',
            'medico_idmedico' => '',
            'data' => date('Y-m-d'),
            'hora' => date('H:i'),
            'queixa' => '',
        );

        return $form;
    }

    public function index() {
        $this->permissao(['ADMIN', 'MEDICO', 'SECRETARIO']);

        if ($this->session->userdata('userTipo') == 'MEDICO') {
            $consultas = $this->ConsultaModel->obterTodosConsultaMedico($this->session->userdata('userId'))->result();
        } else {
            $consultas = $this->ConsultaModel->obterTodosConsulta()->result();
        }

        $dadosView = array(
            'consultas' => $consultas,
        );
        $this->load->view('Consulta/index.php', $dadosView);
    }

    public function nova() {
        $this->permissao(['ADMIN', 'MEDICO', 'SECRETARIO']);

        $pacientes = $this->PacienteModel->obterTodosPacienteAtivos()->result();
        $medicos = $this->MedicoModel->obterTodosMedicoAtivos()->result();

        $form = $this->create_forme();

        if ($this->input->post('submit') == "abc") {

            $form = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('paciente_idpaciente', 'Paciente', 'required');
            $this->form_validation->set_rules('medico_idmedico', 'Médico', 'required|numeric');
            $this->form_validation->set_rules('data', 'Data', 'required');
            $this->form_validation->set_rules('hora', 'Hora', 'required');


            if ($this->form_validation->run()) {

                $this->messagemSecesso('Consulta Agendada com sucesso');

                $this->ConsultaModel->SalvarDados($form);

                redirect(base_url('consulta'));
            }
        }


        $dados_view = array(
            'form' => $form,
            'pacientes' => $pacientes,
            'medicos' => $medicos
        );
        $this->load->view('Consulta/novo', $dados_view);
    }

    public function alterar() {
        $this->permissao(['ADMIN', 'MEDICO']);

        $idConsulta = (int) strip_tags($this->uri->segment(3));

        $consulta = $this->ConsultaModel->obterConsultaId($idConsulta)->result();
        if (count($consulta) == 0) {
            $this->messagemErro('Consulta não foi encontrado');
            redirect(base_url('consulta'));
        }

        $pacientes = $this->PacienteModel->obterTodosPacienteAtivos()->result();
        $medicos = $this->MedicoModel->obterTodosMedicoAtivos()->result();

        $form = (array) $consulta[0];

        if ($this->input->post('submit') == "abc") {

            $form = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('medico_idmedico', 'Médico', 'required|numeric');
            $this->form_validation->set_rules('data', 'Data', 'required');
            $this->form_validation->set_rules('hora', 'Hora', 'required');


            if ($this->form_validation->run()) {

                $form['paciente_idpaciente'] = $consulta[0]->paciente_idpaciente;

                $this->messagemSecesso('Consulta alterado com sucesso');
                $this->ConsultaModel->SalvarDados($form, $idConsulta);

                redirect(base_url('consulta'));
            }
        }

        $form = (array) $consulta[0];

        $dados_view = array(
            'form' => $form,
            'pacientes' => $pacientes,
            'medicos' => $medicos
        );
        $this->load->view('Consulta/alterar', $dados_view);
    }

    public function finalizar() {
        $this->permissao(['ADMIN', 'MEDICO']);

        $idConsulta = (int) strip_tags($this->uri->segment(3));

        $consulta = $this->ConsultaModel->obterConsultaId($idConsulta)->result();
        if (count($consulta) == 0) {
            $this->messagemErro('Consulta não foi encontrado');
            redirect(base_url('consulta'));
        }


        $form = (array) $consulta[0];

        if ($this->input->post('submit') == "abc") {

            $form = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('prontuario', 'Porntuario', 'required|min_length[3]');


            if ($this->form_validation->run()) {

                $form['status'] = 1;

                $this->messagemSecesso('Consulta finalizada com sucesso');
                $this->ConsultaModel->finalizarConsulta($form, $idConsulta);

                redirect(base_url('consulta'));
            }
        }

        $form = (array) $consulta[0];

        $dados_view = array(
            'form' => $form,
        );
        $this->load->view('Consulta/finalizar', $dados_view);
    }

    public function excluir() {
        $this->permissao(['ADMIN', 'MEDICO']);

        $idConsulta = (int) strip_tags($this->uri->segment(3));

        $consulta = $this->ConsultaModel->obterConsultaId($idConsulta)->result();
        if (count($consulta) == 0) {
            $this->messagemErro('Consulta não encotrado');
            redirect(base_url('consulta'));
        }

        $this->ConsultaModel->excluirConsulta($consulta[0]->idconsulta);

        $this->messagemSecesso('Consulta excluida com sucesso');
        redirect(base_url('consulta'));
    }

    private function messagemSecesso($msg) {
        $this->session->set_flashdata('sucesso', $msg);
    }

    private function messagemErro($msg) {
        $this->session->set_flashdata('erro', $msg);
    }

}
