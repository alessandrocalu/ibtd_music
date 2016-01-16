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
        $data['controller'] = 'grupos';
        $data['columns'] = " 'columns': [ { 'data':'id'}, { 'data':'nome'} ] ";
        $data['tipoTable'] = 'tree';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/grupos/index', $data);
        $this->load->view('telas/grupos/create_modal', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_scripts_table', $data);
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

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Novo Grupo';

        $this->form_validation->set_rules('nome', 'Nome', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('telas/grupos/create_modal', $data);
        }
        else
        {
            $this->grupo_model->set_grupo();
            $this->load->helper('url');
            redirect('grupos');
        }
    }

    public function lista_json(){
        $grupos = $this->grupo_model->get_grupo();

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");


        echo '{
                "data": [';
        $lista = "";
        foreach($grupos as $item_grupo) {

            // monta class inativa
            if($item_grupo["status"] == 0){
                $classInativa = 'class=\"inativo\"';
            }else{
                $classInativa = '';
            }


            $lista .= '{ "id": "' . $item_grupo["id"] . '",
                         "nome": "<span '.$classInativa.'>' . $item_grupo["nome"] . '</span>"},';
        }

        echo substr($lista, 0, -1);
        echo ']

            }';
    }


    public function edit_form($id = NULL){
        $data['grupo_item'] = $this->grupo_model->get_grupo($id);
        $this->load->view('telas/grupos/edit_form', $data);
    }


    public function add_json(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');

        if($this->form_validation->run() === FALSE){
            echo 'Preencha as informações do formulário corretamente!';
        }else{
            $dados = array(
                'nome' => $this->input->post('nome'),
                'status' => $this->input->post('status')
            );

            if($this->grupo_model->set_grupo()){
                echo 'OK';
            }else{
                echo 'Erro em banco de dados ao tentar gravar grupo, tende novamente!';
            }
        }
    }

    public function update_json(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');

        if($this->form_validation->run() === FALSE){
            echo 'Preencha as informações do formulário corretamente!';
        }else{
            $dados = array(
                'id' => $this->input->post('id'),
                'nome' => $this->input->post('nome'),
                'status' => $this->input->post('status')
            );

            if($this->grupo_model->set_grupo($dados['id'])){
                echo 'OK';
            }else{
                echo 'Erro em banco de dados ao tentar gravar grupo, tende novamente!';
            }
        }
    }
}