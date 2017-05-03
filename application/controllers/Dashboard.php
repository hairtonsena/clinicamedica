<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userLogado();
    }

  private function userLogado() {
        if ($this->session->userdata('userLogado') != 'sim') {
            redirect(base_url("permissao"));
        }
    }
    
    private function permissao($tipo){
        if($this->session->userdata('userTipo')!= $tipo){
            redirect(base_url());
        }
    }

    public function index() {

        $this->load->view('Dashboard/index.php');
    }

}
