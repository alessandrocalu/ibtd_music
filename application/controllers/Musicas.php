<?php
class Musicas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('musica_model');
        $this->load->model('grupo_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $musicas = $this->musica_model->get_musica();
        $grupos = $this->grupo_model->get_grupo();
        reset($musicas);
        foreach ($musicas as $key => $musica) {
            $grupo = $this->grupo_model->get_grupo($musica["id_grupo"]);
            $musicas[$key]["grupo"] = $grupo["nome"];
        }    
        

        $data['musicas'] = $musicas;
        $data['grupos'] = $grupos;
        $data['title'] = 'Músicas';
        $data['controller'] = 'musicas';
        $data['button_edit'] = 1;
        $data['columns'] = " 'columns': [ { 'data':'id'}, 
                                          { 'data':'nome'}, 
                                          { 'data':'palavras'},
                                          { 'data':'links'},
                                          { 'data':'grupo'} ] ";

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/musicas/index', $data);
        $this->load->view('telas/musicas/create_modal', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_scripts_table', $data);
        $this->load->view('inc/footer_html');
    }

    public function view($id = NULL)
    {
        $data['musica_item'] = $this->musica_model->get_musica($id);

        if (empty($data['musica_item']))
        {
            show_404();
        }

        $data['title'] = 'Música ('. $data['musica_item']['nome']. ')';

        $this->load->view('inc/header_html', $data);
        $this->load->view('inc/header', $data);
        $this->load->view('telas/musicas/view', $data);
        $this->load->view('inc/footer_wrapper');
        $this->load->view('inc/footer_scripts');
        $this->load->view('inc/footer_html');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Nova Música';

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('autor', 'Autor', 'required');
        $this->form_validation->set_rules('id_grupo', 'Grupo', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('telas/musicas/create_modal', $data);
        }
        else
        {
            $this->musica_model->set_musica();
            $this->load->helper('url');
            redirect('musicas');
        }
    }

    public function lista_json(){
        $musicas = $this->musica_model->get_musica();
        reset($musicas);
        foreach ($musicas as $key => $musica) {
            $grupo = $this->grupo_model->get_grupo($musica["id_grupo"]);
            $musicas[$key]["grupo"] = $grupo["nome"];
        }   

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");



        echo '{
                "data": [';
        $lista = "";
        foreach($musicas as $item_musica) {
            $links  = '<nobr>';
            $links .= '<button class=\"btn btn-info btn-circle\" type=\"button\" title=\"Ver Vídeo\" onclick=abrelocal(\"'.$item_musica["link_video"].'\")>';
            $links .= '<i class=\"fa fa-video-camera\"></i>';
            $links .= '</button>';
            $links .= '&nbsp;';
            $links .= '<button class=\"btn btn-info btn-circle\" type=\"button\" title=\"Ver Letra\" onclick=abrelocal(\"'.$item_musica["link_letra"].'\")>';
            $links .= '<i class=\"fa fa-info\"></i>';
            $links .= '</button>';
            $links .= '&nbsp;';
            $links .= '<button class=\"btn btn-info btn-circle\" type=\"button\" title=\"Ver Cifra\" onclick=abrelocal(\"'.$item_musica["link_cifra"].'\")>';
            $links .= '<i class=\"fa fa-music\"></i>';
            $links .= '</button>';
            $links .= '&nbsp;';
            $links .= '<button class=\"btn btn-info btn-circle\" type=\"button\" title=\"Ver DataShow\" onclick=abrelocal(\"'.$item_musica["link_datashow"].'\")>';
            $links .= '<i class=\"fa fa-laptop\"></i>';
            $links .= '</button>';
            $links .= '&nbsp;';
            $links .= '<button class=\"btn btn-info btn-circle\" type=\"button\" title=\"Editar\" onclick=edit_modal('.$item_musica["id"].')>';
            $links .= '<i class=\"fa fa-pencil\"></i>';
            $links .= '</button>';
            $links .= '</nobr>';
            
            $lista .= '{ "id": "' . $item_musica["id"] . '",
                         "nome": "' . $item_musica["nome"] . '",
                         "palavras": "' . $item_musica["palavras"] . '",
                         "links": "'.$links.'",
                         "grupo": "' . $item_musica["grupo"] . '"},';
//  "links": "<a href=\"'.$item_musica["link_video"].'\" class=\"fa fa-video-camera\" ></a>&nbsp;<a href=\"'.$item_musica["link_letra"].'\" class=\"fa fa-info\" ></a>&nbsp;<a href=\"'.$item_musica["link_cifra"].'\" class=\"fa fa-music\" ></a>",

        }

        echo substr($lista, 0, -1);
        echo ']

            }';
    }

    public function edit_form($id = NULL){
        $data['musica_item'] = $this->musica_model->get_musica($id);
        $data['grupos'] = $this->grupo_model->get_grupo();
        $this->load->view('telas/musicas/edit_form', $data);
    }

    public function add_json(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('autor', 'Autor', 'required');
        $this->form_validation->set_rules('id_grupo', 'Grupo', 'required');


        if($this->form_validation->run() === FALSE){
            echo 'Preencha as informações do formulário corretamente!';
        }else{
            if($this->musica_model->set_musica()){
                echo 'OK';
            }else{
                echo 'Erro em banco de dados ao tentar gravar música, tende novamente!';
            }
        }
    }

    public function update_json(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('autor', 'Autor', 'required');
        $this->form_validation->set_rules('id_grupo', 'Grupo', 'required');

        if($this->form_validation->run() === FALSE){
            echo 'Preencha as informações do formulário corretamente!';
        }else{
            $dados = array(
                'id' => $this->input->post('id')
            );

            if($this->musica_model->set_musica($dados['id'])){
                echo 'OK';
            }else{
                echo 'Erro em banco de dados ao tentar gravar música, tende novamente!';
            }
        }
    }
}