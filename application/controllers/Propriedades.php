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
        $data['controller'] = 'propriedades';
        $data['columns'] = " 'columns': [ { 'data':'id'}, { 'data':'nome'}, { 'data':'tabela'} ] ";

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/propriedades/index', $data);
        $this->load->view('telas/propriedades/create_modal', $data);
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
            $this->load->view('telas/propriedades/create_modal', $data);
        }
        else
        {
            $this->propriedade_model->set_propriedade();
            $this->load->helper('url');
            redirect('propriedades');
        }
    }

    public function lista_json(){
        $propriedades = $this->propriedade_model->get_propriedade();

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");



        echo '{
                "data": [';
        $lista = "";
        foreach($propriedades as $item_propriedade) {

            // monta class inativa
            if($item_propriedade["status"] == 0){
                $classInativa = 'class=\"inativo\"';
            }else{
                $classInativa = '';
            }


            $lista .= '{ "id": "' . $item_propriedade["id"] . '",
                         "nome": "<span '.$classInativa.'>' . $item_propriedade["nome"] . '</span>",
                         "tabela": "<span '.$classInativa.'>' . $item_propriedade["tabela"] . '</span>"},';
        }

        echo substr($lista, 0, -1);
        echo ']

            }';
    }

    public function edit_form($id = NULL){
        $data['propriedade_item'] = $this->propriedade_model->get_propriedade($id);
        $this->load->view('telas/propriedades/edit_form', $data);
    }

    public function add_json(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('tabela', 'Tabela', 'required');

        if($this->form_validation->run() === FALSE){
            echo 'Preencha as informações do formulário corretamente!';
        }else{
            $dados = array(
                'nome' => $this->input->post('nome'),
                'tabela' => $this->input->post('tabela'),
                'status' => $this->input->post('status')
            );

            //Verifica nome repetido
            $nome = $this->input->post('nome');
            $lista_nome = $this->propriedade_model->get_propriedade(false,$nome);
            //Verifica tabela repetido
            $tabela = $this->input->post('tabela');
            $lista_tabela = $this->propriedade_model->get_propriedade(false,'',$tabela);

            //Verifica nome repetido
            if (count($lista_nome) > 0) {
                echo 'Já existe propriedade com este nome!';
            }
            //Verifica tabela repetido
            elseif (count($lista_tabela) > 0) {
                echo 'Já existe propriedade com esta tabela!';
            }
            //Verifica se Tabela exist
            elseif (!$this->propriedade_model->db->table_exists($dados['tabela'])) {
                echo 'Tabela inexistente!';
            }
            elseif($this->propriedade_model->set_propriedade()){
                echo 'OK';
            }else{
                echo 'Erro em banco de dados ao tentar gravar propriedade, tende novamente!';
            }
        }
    }

    public function update_json(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('tabela', 'Tabela', 'required');

        if($this->form_validation->run() === FALSE){
            echo 'Preencha as informações do formulário corretamente!';
        }else{
            $dados = array(
                'id' => $this->input->post('id'),
                'nome' => $this->input->post('nome'),
                'tabela' => $this->input->post('tabela'),
                'status' => $this->input->post('status')
            );

            //Verifica nome repetido
            $id = $this->input->post('id');
            $nome = $this->input->post('nome');
            $lista_nome = $this->propriedade_model->get_propriedade($id,$nome);
            //Verifica tabela repetido
            $tabela = $this->input->post('tabela');
            $lista_tabela = $this->propriedade_model->get_propriedade($id,'',$tabela);

            //Verifica nome repetido
            if (count($lista_nome) > 0) {
                echo 'Já existe propriedade com este nome!';
            }
            //Verifica tabela repetido
            elseif (count($lista_tabela) > 0) {
                echo 'Já existe propriedade com esta tabela!';
            }
            //Verifica se Tabela exist
            elseif (!$this->propriedade_model->db->table_exists($dados['tabela'])) {
                echo 'Tabela inexistente!';
            }
            elseif($this->propriedade_model->set_propriedade($dados['id'])){
                echo 'OK';
            }else{
                echo 'Erro em banco de dados ao tentar gravar propriedade, tende novamente!';
            }
        }
    }
}