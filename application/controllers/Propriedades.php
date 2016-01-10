<?php
class Propriedades extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('propriedade_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['propriedades'] = $this->propriedade_model->get_propriedade();
        $data['title'] = 'Propriedades';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/propriedades/index', $data);
        $this->load->view('telas/propriedades/create', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_scripts_table', $data);
        $this->load->view('inc/footer_html');
    }

    public function view($id = NULL)
    {
        $data['propriedade_item'] = $this->propriedade_model->get_propriedade($id);

        if (empty($data['propriedade_item']))
        {
            show_404();
        }

        $data['title'] = 'Propriedade ('. $data['propriedade_item']['nome']. ')';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/propriedades/view', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_html');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Nova Propriedade';

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('tabela', 'Tabela', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('inc/header_html', $data);
            $this->load->view('inc/header', $data);
            $this->load->view('telas/propriedades/create', $data);
            $this->load->view('inc/footer_wrapper');
            $this->load->view('inc/footer_scripts');
            $this->load->view('inc/footer_html');

        }
        else
        {
            $this->propriedade_model->set_propriedade();
            $this->load->helper('url');
            redirect('propriedades');
        }
    }
}