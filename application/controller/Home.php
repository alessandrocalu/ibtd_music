<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Produtos_model', 'produtos');
    }
    
/*******************************************************************************
 * PRODUTOS
 ******************************************************************************/        
    public function index(){
        
        $dados = array(
            'categorias' => $this->produtos->lista_categorias(),
            'cores' => $this->produtos->lista_cores(),
            'tamanho' => $this->produtos->lista_tamanho()
        );
                
        $this->load->view('inc/header_html');
        $this->load->view('inc/header');
        $this->load->view('telas/produtos_view');
        $this->load->view('inc/footer', $dados);
        $this->load->view('inc/footer_html');
    }
    
    // monta o arquivo JSON para carregamento na tabela
    public function produtos(){
        
        $produtos = $this->produtos->lista_produtos();
        
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        
        echo '{              
                "data": [';
                    $lista = "";
                    foreach($produtos as $ln):
                        
                        // monta class inativa
                        if($ln->status == 0){
                            $classInativa = 'class=\"inativo\"';
                            $linkDisabled = 'disabled';
                        }else{
                            $classInativa = '';
                            $linkDisabled = '';
                        }
                        
                        $lista .= '{
                                "id": "<span '.$classInativa.'>'.$ln->id.'</span>",
                                "nome": "<span '.$classInativa.'>'.$ln->nome.'</span>",
                                "acoes": "<a href=\"javascript:void()\" class=\"btn btn-sm btn-info\" title=\"Visualizar registro\" onclick=\"visualizar_produto('.$ln->id.')\"><i class=\"glyphicon glyphicon-eye-open\"></i></a> <a href=\"javascript:void()\" title=\"Editar\" class=\"btn btn-info btn-sm\" onclick=\"editar_produto('.$ln->id.')\" '.$linkDisabled.'><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"javascript:void()\" title=\"Excluir\" onclick=\"confirm_del_produto('.$ln->id.')\" class=\"btn btn-danger btn-sm\" '.$linkDisabled.'><i class=\"glyphicon glyphicon-trash\"></i></a>"
                              },';
                    endforeach;
                    
                    echo substr($lista, 0, -1);
        echo ']

            }';
        
    }     
    
    // visualiza registro de produto
    public function ver_produto(){
        $dados = array(
                    'produto' => $this->produtos->lista_produto_id($this->uri->segment(3)),
                    'tamanho' => $this->produtos->lista_tamanho(),
                    'cores' => $this->produtos->lista_cores()
            );
        $this->load->view('telas/visualiza_produto_view', $dados);
    }
    
    // adiciona produto
    public function add_produto(){
        $this->form_validation->set_rules('nome_produto', 'Nome do Produto', 'required|trim');                                
        
        if($this->form_validation->run() == FALSE){
            echo '<div class="alert alert-danger">Erro ao cadastrar produto.</div>';
        }else{
            $dados = array(
                        'nome' => $this->input->post('nome_produto'),
                        'descricao' => $this->input->post('descricao'),
                        'id_tamanho' => $this->input->post('tamanho'),
                        'id_cor' => $this->input->post('cor'),
                        'id_grupo' => $this->input->post('grupo_pai'),
                        'status' => 1,
                        'data_cadastro' => date('Y-m-d H:i:s')                        
                    );

            if($this->produtos->add_produtos($dados)){
                echo '<div class="alert alert-success">Produto cadastrado com sucesso!</div>';
            }else{
                echo '<div class="alert alert-danger">Erro ao cadastrar produto!!!</div>';
            }
        }
    }
    
    // carrega modal bootstrap para edição de produtos
    public function editar_produto(){
        $dados = array(
                    'produto' => $this->produtos->lista_produto_id($this->uri->segment(3)),
                    'cores' => $this->produtos->lista_cores(),
                    'tamanho' => $this->produtos->lista_tamanho()
                );
        
        $this->load->view('/telas/editar_produto_view', $dados);                
    }
    
    // realiza update dos dados enviados pelo formulário carregado acima
    public function update_produto(){
        $this->form_validation->set_rules('nome_produto', 'Nome do Produto', 'required|trim');                                
        
        if($this->form_validation->run() == TRUE){
                        
            $dados = array(
                'id' => $this->input->post('produto'),
                'nome' => $this->input->post('nome_produto'),
                'descricao' => $this->input->post('descricao'),
                'id_tamanho' => $this->input->post('tamanho'),
                'id_cor' => $this->input->post('cor'),
                'id_grupo' => $this->input->post('grupo_pai'),                                
            );
                        
            if($this->produtos->atualiza_produto($dados)){
                echo '<div class="alert alert-success">Produto atualizado com sucesso!!!</div>';
            }else{
                echo '<div class="alert alert-danger">Erro ao atualizar produto!!!</div>';
            }   
        }else{
            echo '<div class="alert alert-danger">Erro ao atualizar produto!</div>';
        }     
    }
    
    // carrega modal bootstrap para exclusão de produtos
    public function modal_exclusao_produto(){
        $dados = array(
                    'produto' => $this->produtos->lista_produto_id($this->uri->segment(3)),
                    'tamanho' => $this->produtos->lista_tamanho(),
                    'cores' => $this->produtos->lista_cores()
            );
        $this->load->view('telas/del_produto_view', $dados);
    }
    
    // desativa um produto, atualizando o status dele para o valor 0
    public function excluir_produto(){
        
        $dados = array(
            'id' => $this->uri->segment(3),
            'status' => 0
        );
        
        if($this->produtos->atualiza_produto($dados)){
            echo '<div class="alert alert-success">Produto desativado com sucesso!</div>';            
        }else{
            echo '<div class="alert alert-danger">Erro ao desativar produto.</div>';            
        }
    }
    
    // verifica duplicidade de nome de produto
    public function valida_nome(){        
        $produto = $this->input->post('nome_produto');        
        if($this->produtos->valida_nome($produto)){
            echo 'ok';
        }else{
            echo 'error';
        }        
    }
    
/*******************************************************************************
 * GRUPOS DE PRODUTOS
 ******************************************************************************/ 
    // carrega tabela de categorias
    public function categorias(){
        $categorias = $this->produtos->lista_categorias();
        
        if(count($categorias) == 0){
            echo '<pre>Não há categorias cadastradas no sistema.</pre>';
        }else{
            echo '<table class="table table-hover table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Grupos</th>';                                                         
            echo '<th class="col_acoes">Ações</th>';                                             
            echo '</tr>';
            echo '</thead>';
           
            echo '<tbody>';
            foreach ($categorias as $ln):  
            
                // monta class inativa
                if($ln->status == 0){
                    $classInativa = 'class="inativo"';
                    $linkDisabled = 'disabled';
                }else{
                    $classInativa = '';
                    $linkDisabled = '';
                }

                echo '<tr>';
                echo '<td>';
                echo '<span id="update-'.$ln->id.'" data-cat="'.$ln->nome.'" '.$classInativa.'># '.$ln->nome.'</span> </td>';
                echo '<td><a '.$linkDisabled.' href="javascript:void()" title="Editar registro" onclick="editar_categoria('.$ln->id.')" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-edit"></i></a> ';
                echo '<a '.$linkDisabled.' href="javascript:void()" title="Excluir registro" onclick="confirm_del_grupo('.$ln->id.')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    if($ln->id > 0):
                        $esp = "&nbsp;&nbsp;";
                        $this->subcategoria($ln->id, $esp);                        
                    endif;                  
                        
                echo '</td>';            
                echo '</tr>';
            endforeach;
            echo '</tbody>';
                    
            echo '</table>';
        }
    }
    
    // função recursiva para carregamento de níveis infinitamente
    // $id => identificador da categoria pai
    // $esp => controlador de espaçamento entre os níveis, por padrão estou utilizando "&nbsp;"
    public function subcategoria($id, $esp){
        $subcat = $this->produtos->lista_subcategorias($id);
        
        if(count($subcat) > 0):            
            
            foreach($subcat as $ln): 
            
                // monta class inativa
                if($ln->status == 0){
                    $classInativa = 'class="inativo"';
                    $linkDisabled = 'disabled';
                }else{
                    $classInativa = '';
                    $linkDisabled = '';
                }
            
                echo '<tr>';
                echo '<td><span id="update-'.$ln->id.'" data-cat="'.$ln->nome.'" '.$classInativa.'>'.$esp.'&rdsh; '.$ln->nome.'</span></td>';
                echo '<td><a '.$linkDisabled.' href="javascript:void()" onclick="editar_categoria('.$ln->id.')" title="Editar" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-edit"></i></a> <a '.$linkDisabled.' href="#" title="Excluir" onclick="confirm_del_grupo('.$ln->id.')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a></td>';                        
                        $esp = "&nbsp;&nbsp;&nbsp;";
                        $this->subcategoria($ln->id, $esp);                                
                echo '</tr>';                                  
                
            endforeach;
            
        endif;        
    }
    
    // carrega select de categorias
    // $this->uri->segment(3) => identificador do grupo vinculado há um registro
    // $this->uri->segment(4) => parametro de ativação do combo (0-inativo, 1-ativo)
    public function select_categoria(){
        
        $categorias = $this->produtos->lista_categorias();

        if($this->uri->segment(4) == 1){
            $selectCombo = 'disabled';
        }else{
            $selectCombo = '';
        }
                        
        echo '<select id="grupo_pai" class="form-control" name="grupo_pai" '.$selectCombo.'>
                    <option value="0">Nenhum</option>';
                        if(count($categorias) > 0):
                            foreach($categorias as $cat):
                                
                                if($this->uri->segment(3) == $cat->id){
                                    $selectCat = 'selected';
                                }else{
                                    $selectCat = '';
                                }
                            
                                echo '<option value="'.$cat->id.'" '.$selectCat.'>'.$cat->nome.'</option>';
                                $this->select_subcategoria($cat->id, "&nbsp; - ", $this->uri->segment(3));
                            endforeach;
                        endif;                        
        echo '</select> ';
    }
    // função recursiva de auxilio ao select categoria, esta carrega as subcategorias
    // $id => identificador da categoria pai
    // $espacamento => controlador de espaçamento entre os níveis, por padrão estou utilizando "&nbsp;"
    // $select => carrega valor de uma categoria ou subcategoria já salva no BD para edição
    public function select_subcategoria($id, $espacamento, $select){
        
        $subcat = $this->produtos->lista_subcategorias($id);
        
        if(count($subcat) > 0):
            echo '<hr />';
            foreach($subcat as $ln):
                // verifica se algum valor esta salvo no BD
                if($select == $ln->id){
                    $selectSub = 'selected';
                }else{
                    $selectSub = '';
                }
                echo '<option value="'.$ln->id.'" '.$selectSub.'>'.$espacamento.$ln->nome.'</option>';
                $this->select_subcategoria($ln->id, "&nbsp;&nbsp; - ", $this->uri->segment(3));
            endforeach;
        endif;                        
    }
    // cadastro de nova categoria (grupo)
    public function add_categoria(){
        
        $this->form_validation->set_rules('nome_grupo', 'Nome da Cor', 'required|trim|is_unique[tb_grupo.nome]');                                
        
        if($this->form_validation->run() == FALSE){
            echo '<div class="alert alert-danger">Erro ao cadastrar grupo, Nome já esta cadastrada.</div>';
        }else{
            $dados = array(
                        'nome' => $this->input->post('nome_grupo'),
                        'id_grupo_pai' => $this->input->post('grupo_pai'),
                        'status' => 1
                    );

            if($this->produtos->add_categoria($dados)){
                echo '<div class="alert alert-success">Registro adicionado com sucesso!</div>';
            }else{
                echo '<div class="alert alert-danger">Erro ao cadastrar grupo.</div>';
            }
        }
    }
    // edição de nova categoria
    public function editar_categoria(){
        $this->form_validation->set_rules('nome_cat', 'Nome do Grupo', 'required|trim');                                
        
        if($this->form_validation->run() == TRUE){
                        
            $dados = array(
                'id' => $this->input->post('cat'),
                'nome' => $this->input->post('nome_cat')
            );
            
            
            if($this->produtos->atualiza_categoria($dados)){
                echo '<div class="alert alert-success">Registro atualizado com sucesso!</div>';
            }else{
                echo '<div class="alert alert-danger">Erro ao atualizar registro.</div>';    
            }   
        }          
    }
    
    // carrega modal bootstrap para exclusão de grupos
    public function modal_exclusao_grupo(){
        $dados = array('grupo' => $this->produtos->lista_categoria_id($this->uri->segment(3)));
        $this->load->view('telas/del_grupo_view', $dados);
    }
    
    // exclusão permanente de categoria
    public function excluir_categoria(){  
        
        $dados = array(
            'id' => $this->uri->segment(3),
            'status' => 0
        );
        
        if($this->produtos->atualiza_status_categoria($dados)){
            echo '<div class="alert alert-success">Registro desativado com sucesso!</div>';
        }else{
            echo '<div class="alert alert-danger">Erro ao desativar registro.</div>' . $this->uri->segment(3);
        }
    }
    
    
    
/*******************************************************************************
 * CORES
 ******************************************************************************/  
    // lista cores cadastradas no bd na modal
    public function cores(){
        
        $cores = $this->produtos->lista_cores();
        
        
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        
        echo '{
                "draw": 1,
                "recordsTotal": '.count($cores).',
                "recordsFiltered": '.count($cores).',
                "data": [';
                    $lista = "";
                    foreach($cores as $ln):
                        
                        // monta class inativa
                        if($ln->status == 0){
                            $classInativa = 'class=\"inativo\"';
                            $linkDisabled = 'disabled';
                        }else{
                            $classInativa = '';
                            $linkDisabled = '';
                        }
                        
                        $lista .= '{                                
                                "nome": "<span '.$classInativa.' id=\"updatecor-'.$ln->id.'\" data-cor=\"'.$ln->nome.'\">'.$ln->nome.'</span>",
                                "acoes": "<a href=\"#\" title=\"Editar registro\" onclick=\"editar_cor('.$ln->id.')\" class=\"btn btn-info\" '.$linkDisabled.'><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"#\" title=\"Excluir registro\" onclick=\"confirm_del_cor('.$ln->id.')\" class=\"btn btn-danger\" '.$linkDisabled.'><i class=\"glyphicon glyphicon-trash\"></i></a>"
                              },';
                    endforeach;
                    
                    echo substr($lista, 0, -1);
        echo ']

            }';
                
    }
    // cadastra nova cor
    public function add_cor(){
        
        $this->form_validation->set_rules('nome_cor', 'Nome da Cor', 'required|trim|is_unique[tb_cor.nome]');                                
        
        if($this->form_validation->run() == FALSE){
            echo '<div class="alert alert-danger">Erro ao cadastrar cor, essa cor já esta cadastrada.</div>';
        }else{
            $dados = array('nome' => $this->input->post('nome_cor'), 'status' => 1);

            if($this->produtos->add_cor($dados)){
                echo '<div class="alert alert-success">Registro adicionado com sucesso!</div>';
            }else{
                echo '<div class="alert alert-danger">Erro ao cadastrar cor.</div>';
            }
        }
    }
    // atualização de registro de cores
    public function editar_cor(){
        $this->form_validation->set_rules('nome_cor', 'Nome da Cor', 'required|trim');                                
        
        if($this->form_validation->run() == TRUE){
                        
            $dados = array(
                'id' => $this->input->post('cor'),
                'nome' => $this->input->post('nome_cor')
            );
            
            
            if($this->produtos->atualiza_cor($dados)){
                echo '<div class="alert alert-success">Registro atualizado com sucesso!</div>';
            }else{
                echo '<div class="alert alert-danger">Erro ao atualizar registro.</div>';    
            }   
        }          
    }
    
    
    // carrega modal bootstrap para exclusão de cores
    public function modal_exclusao_cor(){
        $dados = array('cor' => $this->produtos->lista_cor_id($this->uri->segment(3)));
        $this->load->view('telas/del_cor_view', $dados);
    }
    
    // exclusão permanente de cores
    public function excluir_cor(){        
        
        $dados = array(
            'id' => $this->uri->segment(3),
            'status' => 0    
        );
        
        if($this->produtos->atualiza_cor($dados)){
            echo '<div class="alert alert-success">Registro desativado com sucesso!</div>';
        }else{
            echo '<div class="alert alert-danger">Erro ao desativar cor.</div>';
        }
    }
    
    
}
