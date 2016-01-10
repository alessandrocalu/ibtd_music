<?php
class Grupos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('grupo_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['grupos'] = $this->grupo_model->get_grupo();
        $data['title'] = 'Grupos';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/grupos/index', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_scripts_table');
        $this->load->view('inc/footer_html');

    }

    public function view($id = NULL)
    {
        $data['grupo_item'] = $this->grupo_model->get_grupo($id);

        if (empty($data['grupo_item']))
        {
            show_404();
        }

        $data['title'] = 'Grupo ('. $data['grupo_item']['nome']. ')';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/grupos/view', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_html');
    }
}