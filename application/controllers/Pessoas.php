<?php
class Pessoas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pessoa_model');
        $this->load->model('grupo_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $pessoas = $this->pessoa_model->get_pessoa();
        reset($pessoas);
        foreach ($pessoas as $key => $pessoa) {
            $grupo = $this->grupo_model->get_grupo($pessoa["id_grupo"]); 
            $pessoas[$key]["grupo"] = $grupo["nome"];
        }    

        $data['pessoas'] = $pessoas;
        $data['title'] = 'Pessoas';
        $data['controller'] = 'pessoas';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/pessoas/index', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_scripts_table_nomodal', $data);
        $this->load->view('inc/footer_html');
    }

    public function view($id = NULL)
    {
        $data['pessoa_item'] = $this->pessoa_model->get_pessoa($id);
        $data['controller'] = 'pessoas';    

        if (empty($data['pessoa_item']))
        {
            show_404();
        }

        $data['title'] = 'Pessoa ('. $data['pessoa_item']['nome']. ')';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/musicas/view', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_scripts_form', $data);
        $this->load->view('inc/footer_html');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Nova Pessoa';
        $data['controller'] = 'pessoas';

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('id_grupo', 'Grupo', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            if ($this->input->post('acao') == 'gravar'){
                $data['mensagem'] = 'Preencha os dados corretamente!';
            }   

            $data['grupos'] = $this->grupo_model->get_grupo();

            $this->load->view('inc/header_html', $data);
            $this->load->view('inc/header', $data);
            $this->load->view('telas/pessoas/create', $data);
            $this->load->view('inc/footer_wrapper');
            $this->load->view('inc/footer_scripts');
            $this->load->view('inc/footer_scripts_form', $data);
            $this->load->view('inc/footer_html');
        }
        else
        {
            $this->pessoa_model->set_pessoa();
            $this->load->helper('url');
            redirect('pessoas');
        }
    }
   

    public function edit($id = NULL){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar Pessoa';
        $data['controller'] = 'pessoas';

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('id_grupo', 'Grupo', 'required');
        if ($this->form_validation->run() === FALSE)
        {
            if ($this->input->post('acao') == 'gravar'){
                $data['mensagem'] = 'Preencha os dados corretamente!';
            }    
            $data['pessoa_item'] = $this->musica_model->get_musica($id);
            $data['grupos'] = $this->grupo_model->get_grupo();

            $this->load->view('inc/header_html', $data);
            $this->load->view('inc/header', $data);
            $this->load->view('telas/pessoas/edit', $data);
            $this->load->view('inc/footer_wrapper');
            $this->load->view('inc/footer_scripts');
            $this->load->view('inc/footer_scripts_form', $data);
            $this->load->view('inc/footer_html');
        }
        else
        {
            $dados = array(
                'id' => $this->input->post('id')
            );
            $this->pessoa_model->set_pessoa($dados['id']);
        }    

    }

}