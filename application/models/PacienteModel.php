<?php

class PacienteModel extends CI_Model {

    public function obterTodosPaciente() {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->join('paciente', 'paciente.pessoa_idpessoa=pessoa.idpessoa');
        return $this->db->get();
    }

    public function obterPacienteId($idPaciente) {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->join('endereco', 'endereco.idendereco=pessoa.endereco_idendereco');
        $this->db->join('paciente', 'paciente.pessoa_idpessoa=pessoa.idpessoa');
        $this->db->where(array("idpaciente" => $idPaciente));
        return $this->db->get();
    }

    public function salvarDados($paciente, $idPaciente = null) {

        $endereco = array(
            'logradouro' => $paciente['logradouro'],
            'numero' => $paciente['numero'],
            'bairro' => $paciente['bairro'],
            'cidade' => $paciente['cidade'],
            'cep' => $paciente['cep'],
        );

        $pessoa = array(
            'nome' => $paciente['nome'],
            'idade' => $paciente['idade'],
            'sexo' => $paciente['sexo'],
            'identidade' => $paciente['identidade'],
            'telefone' => $paciente['telefone'],
            'email' => $paciente['email'],
        );


        $paciente = array(
            'status' => $paciente['status'],
            'fixa' => $paciente['fixa'],
            'data_entrada' => $paciente['data_entrada']
        );

        if ($idPaciente == NULL) {

            $this->db->insert('endereco', $endereco);
            $this->db->select('LAST_INSERT_ID() as idendereco');
            $idendereco = $this->db->get()->result();

            $pessoa['endereco_idendereco'] = $idendereco[0]->idendereco;


            $this->db->insert('pessoa', $pessoa);
            $this->db->select('LAST_INSERT_ID() as idpessoa');
            $idpessoa = $this->db->get()->result();
            $paciente['pessoa_idpessoa'] = $idpessoa[0]->idpessoa;

//
//            $this->db->insert('user', $user);
//            $this->db->select('LAST_INSERT_ID() as iduser ');
//            $iduser = $this->db->get()->result();
//            $paciente['user_iduser'] = $iduser[0]->iduser;

            $this->db->insert('paciente', $paciente);
        } else {

            $pacienteAtual = $this->obterPacienteId($idPaciente)->result();

            $this->db->where('idpessoa', $pacienteAtual[0]->idpessoa);
            $this->db->update('pessoa', $pessoa);

            $this->db->where('idendereco', $pacienteAtual[0]->idendereco);
            $this->db->update('endereco', $endereco);
            
            $this->db->where('idpaciente', $pacienteAtual[0]->idpaciente);
            $this->db->update('paciente', $paciente);
            
        }
    }

    public function excluirSecretario($idendereco) {
        $this->db->delete('endereco', array('idendereco' => $idendereco));
    }

}
