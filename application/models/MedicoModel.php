<?php

class MedicoModel extends CI_Model {

    public function obterTodosMedico() {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->join('user', 'user.pessoa_idpessoa=pessoa.idpessoa');
        $this->db->join('medico', 'medico.user_iduser = user.iduser');
        return $this->db->get();
    }

    public function obterMedicoId($idMedico) {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->join('endereco', 'endereco.idendereco=pessoa.endereco_idendereco');
        $this->db->join('user', 'user.pessoa_idpessoa=pessoa.idpessoa');
        $this->db->join('medico', 'medico.user_iduser = user.iduser');
        $this->db->where(array("idmedico" => $idMedico));
        return $this->db->get();
    }

    public function salvarDados($medico, $idMedico = null) {

        $endereco = array(
            'logradouro' => $medico['logradouro'],
            'numero' => $medico['numero'],
            'bairro' => $medico['bairro'],
            'cidade' => $medico['cidade'],
            'cep' => $medico['cep'],
        );

        $pessoa = array(
            'nome' => $medico['nome'],
            'idade' => $medico['idade'],
            'sexo' => $medico['sexo'],
            'identidade' => $medico['identidade'],
            'telefone' => $medico['telefone'],
            'email' => $medico['email'],
        );

        $user = array(
            'codigo' => $medico['codigo'],
            'senha' => $medico['senha'],
            'tipo' => $medico['tipo'],
            'status' => $medico['status'],
            'create_at' => $medico['create_at']
        );

        $medico = array(
            'crm' => $medico['crm'],
            'especializacao' => $medico['especializacao'],
        );

        if ($idMedico == NULL) {

            $this->db->insert('endereco', $endereco);
            $this->db->select('LAST_INSERT_ID() as idendereco');
            $idendereco = $this->db->get()->result();

            $pessoa['endereco_idendereco'] = $idendereco[0]->idendereco;


            $this->db->insert('pessoa', $pessoa);
            $this->db->select('LAST_INSERT_ID() as idpessoa');
            $idpessoa = $this->db->get()->result();
            $user['pessoa_idpessoa'] = $idpessoa[0]->idpessoa;


            $this->db->insert('user', $user);
            $this->db->select('LAST_INSERT_ID() as iduser ');
            $iduser = $this->db->get()->result();
            $medico['user_iduser'] = $iduser[0]->iduser;

            $this->db->insert('medico', $medico);
        } else {

            $medicoAtual = $this->obterMedicoId($idMedico)->result();

            $this->db->where('idmedico', $medicoAtual[0]->idmedico);
            $this->db->update('medico', $medico);

            $this->db->where('iduser', $medicoAtual[0]->iduser);
            $this->db->update('user', $user);

            $this->db->where('idpessoa', $medicoAtual[0]->idpessoa);
            $this->db->update('pessoa', $pessoa);

            $this->db->where('idendereco', $medicoAtual[0]->idendereco);
            $this->db->update('endereco', $endereco);
        }
    }

    public function excluirMedico($idendereco) {
        $this->db->delete('endereco', array('idendereco' => $idendereco));
    }

}
