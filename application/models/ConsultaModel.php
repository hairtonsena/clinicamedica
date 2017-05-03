<?php

class ConsultaModel extends CI_Model {

    public function obterTodosConsulta() {
        $this->db->select('idconsulta, pessoa_p.nome as paciente, pessoa_u.nome as medico, data, hora, queixa, consulta.status as status');
        $this->db->from('consulta');
        $this->db->join('paciente', 'paciente.idpaciente=consulta.paciente_idpaciente');
        $this->db->join('medico', 'medico.idmedico=consulta.medico_idmedico');
        $this->db->join('user', 'user.iduser=medico.user_iduser');
        $this->db->join('pessoa as pessoa_u', 'pessoa_u.idpessoa=user.pessoa_idpessoa');
        $this->db->join('pessoa as pessoa_p', 'pessoa_p.idpessoa=paciente.pessoa_idpessoa');
        return $this->db->get();
    }

    public function obterTodosConsultaMedico($idUser) {
        $this->db->select('idconsulta, pessoa_p.nome as paciente, pessoa_u.nome as medico, data, hora, queixa, consulta.status as status');
        $this->db->from('consulta');
        $this->db->join('paciente', 'paciente.idpaciente=consulta.paciente_idpaciente');
        $this->db->join('medico', 'medico.idmedico=consulta.medico_idmedico');
        $this->db->join('user', 'user.iduser=medico.user_iduser');
        $this->db->join('pessoa as pessoa_u', 'pessoa_u.idpessoa=user.pessoa_idpessoa');
        $this->db->join('pessoa as pessoa_p', 'pessoa_p.idpessoa=paciente.pessoa_idpessoa');
        $this->db->where(array('iduser'=>$idUser,'consulta.status '=>0));
        return $this->db->get();
    }
    
    public function obterTodosConsultaPaciente($idPaciente) {
        $this->db->select('idconsulta, pessoa_p.nome as paciente, pessoa_u.nome as medico, data, hora, queixa, consulta.status as status');
        $this->db->from('consulta');
        $this->db->join('paciente', 'paciente.idpaciente=consulta.paciente_idpaciente');
        $this->db->join('medico', 'medico.idmedico=consulta.medico_idmedico');
        $this->db->join('user', 'user.iduser=medico.user_iduser');
        $this->db->join('pessoa as pessoa_u', 'pessoa_u.idpessoa=user.pessoa_idpessoa');
        $this->db->join('pessoa as pessoa_p', 'pessoa_p.idpessoa=paciente.pessoa_idpessoa');
        $this->db->where(array('idpaciente'=>$idPaciente));
        return $this->db->get();
    }

    public function obterConsultaId($idConsulta) {
        $this->db->select('idconsulta, pessoa_p.nome as paciente, pessoa_u.nome as medico, data, hora, queixa, consulta.status as status, paciente_idpaciente, medico_idmedico, prontuario');
        $this->db->from('consulta');
        $this->db->join('paciente', 'paciente.idpaciente=consulta.paciente_idpaciente');
        $this->db->join('medico', 'medico.idmedico=consulta.medico_idmedico');
        $this->db->join('user', 'user.iduser=medico.user_iduser');
        $this->db->join('pessoa as pessoa_u', 'pessoa_u.idpessoa=user.pessoa_idpessoa');
        ;
        $this->db->join('pessoa as pessoa_p', 'pessoa_p.idpessoa=paciente.pessoa_idpessoa');
        $this->db->where(array("idconsulta" => $idConsulta));
        return $this->db->get();
    }

    public function salvarDados($consulta, $idconsulta = null) {

        $consulta = array(
            'paciente_idpaciente' => $consulta['paciente_idpaciente'],
            'medico_idmedico' => $consulta['medico_idmedico'],
            'data' => $consulta['data'],
            'hora' => $consulta['hora'],
            'queixa' => $consulta['queixa']
        );

        if ($idconsulta == NULL) {
            $this->db->insert('consulta', $consulta);
        } else {

            $this->db->where('idconsulta', $idconsulta);
            $this->db->update('consulta', $consulta);
        }
    }

    public function finalizarConsulta($consulta, $idconsulta = null) {

        $consulta = array(
            'prontuario' => $consulta['prontuario'],
            'status' => $consulta['status']
        );


        $this->db->where('idconsulta', $idconsulta);
        $this->db->update('consulta', $consulta);
    }

    public function excluirConsulta($idconsulta) {
        $this->db->delete('consulta', array('idconsulta' => $idconsulta));
    }

}
