<?php

class SecretarioModel extends CI_Model {

    public function obterTodosSecretario() {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->join('user', 'user.pessoa_idpessoa=pessoa.idpessoa');
        $this->db->join('secretario', 'secretario.user_iduser = user.iduser');
        return $this->db->get();
    }

    public function obterSecretarioId($idSecretario) {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->join('endereco', 'endereco.idendereco=pessoa.endereco_idendereco');
        $this->db->join('user', 'user.pessoa_idpessoa=pessoa.idpessoa');
        $this->db->join('secretario', 'secretario.user_iduser = user.iduser');
        $this->db->where(array("idsecretario" => $idSecretario));
        return $this->db->get();
    }

    public function salvarDados($secretario, $idSecretario = null) {

        $endereco = array(
            'logradouro' => $secretario['logradouro'],
            'numero' => $secretario['numero'],
            'bairro' => $secretario['bairro'],
            'cidade' => $secretario['cidade'],
            'cep' => $secretario['cep'],
        );

        $pessoa = array(
            'nome' => $secretario['nome'],
            'idade' => $secretario['idade'],
            'sexo' => $secretario['sexo'],
            'identidade' => $secretario['identidade'],
            'telefone' => $secretario['telefone'],
            'email' => $secretario['email'],
        );

        $user = array(
            'codigo' => $secretario['codigo'],
            'senha' => $secretario['senha'],
            'tipo' => $secretario['tipo'],
            'status' => $secretario['status'],
            'create_at' => $secretario['create_at']
        );

        $secretario = array(
//            'crm' => $secretario['crm'],
//            'especializacao' => $secretario['especializacao'],
        );

        if ($idSecretario == NULL) {

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
            $secretario['user_iduser'] = $iduser[0]->iduser;

            $this->db->insert('secretario', $secretario);
        } else {

            $secretarioAtual = $this->obterSecretarioId($idSecretario)->result();

//            $this->db->where('idmedico', $secretarioAtual[0]->idmedico);
//            $this->db->update('medico', $secretario);

            $this->db->where('iduser', $secretarioAtual[0]->iduser);
            $this->db->update('user', $user);

            $this->db->where('idpessoa', $secretarioAtual[0]->idpessoa);
            $this->db->update('pessoa', $pessoa);

            $this->db->where('idendereco', $secretarioAtual[0]->idendereco);
            $this->db->update('endereco', $endereco);
        }
    }

    public function excluirSecretario($idendereco) {
        $this->db->delete('endereco', array('idendereco' => $idendereco));
    }

}
