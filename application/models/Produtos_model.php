<?php
class Produtos_Model extends CI_Model{
    
/*******************************************************************************
 * PRODUTOS
 ******************************************************************************/ 
    // lista todos os produtos
    public function lista_produtos(){
        $this->db->order_by('id', 'desc');
        return $this->db->get('tb_produto')->result();
    }
    // lista produto especifico por ID
    // $id => identificador do produto
    public function lista_produto_id($id){
        $this->db->where('id', $id);
        return $this->db->get('tb_produto')->row(0);
    }
    // realiza insert de um novo registro de produto
    // $dados => vetor de dados de produtos para inserção
    public function add_produtos($dados = null){
        if($dados != null):
            return $this->db->insert('tb_produto', $dados);
        endif;
    }
    // atualização de registro de produto
    // $dados => vetor de dados de produtos para update
    // ATENÇÃO! por padrão ele sempre atualiza data de atualização
    public function atualiza_produto($dados = array()){
        if(isset($dados['nome'])):
            $this->db->set('nome', $dados['nome']);
        endif;
        
        if(isset($dados['descricao'])):
            $this->db->set('descricao', $dados['descricao']);
        endif;
        
        if(isset($dados['id_tamanho'])):
            $this->db->set('id_tamanho', $dados['id_tamanho']);
        endif;
        
        if(isset($dados['id_cor'])):
            $this->db->set('id_cor', $dados['id_cor']);
        endif;
        
        if(isset($dados['id_grupo'])):
            $this->db->set('id_grupo', $dados['id_grupo']);
        endif;
        
        if(isset($dados['status'])):
            $this->db->set('status', $dados['status']);
        endif;
        
        $this->db->set('data_atualizacao', date('Y-m-d H:i:s'));
        $this->db->where('id', $dados['id']);
        $this->db->update('tb_produto');
        return $this->db->affected_rows();
    }
    
    public function valida_nome($nome){       
        $this->db->where('nome', $nome);
        $query = $this->db->get('tb_produto');
        
            if($query->num_rows() == 0){
                return true;
            }else{
                return false;
            }
    }




/*******************************************************************************
 * GRUPOS DE PRODUTOS
 ******************************************************************************/    
    // lista categorias
    // ATENÇÃO! Lista somente categorias "PAI"
    public function lista_categorias(){
        $this->db->order_by('nome', 'asc');
        $this->db->where('id_grupo_pai', 0);
        //$this->db->where('status', '1');
        return $this->db->get('tb_grupo')->result();
    }
    
    public function lista_categoria_id($id){
        $this->db->where('id', $id);
        return $this->db->get('tb_grupo')->row(0);
    }
    
    // lista subcategorias
    // $id => Identificador da categoria pai
    // ATENÇÃO! Lista somente categorias "FILHAS"
    public function lista_subcategorias($id){
        $this->db->where('id_grupo_pai', $id);
        //$this->db->where('status', '1');
        $this->db->order_by('nome', 'asc');
        return $this->db->get('tb_grupo')->result();        
    }
    // adiciona regsitro de nova categoria
    // $dados => vetor de dados para inserção no BD
    public function add_categoria($dados = null){
        if($dados != null):
            return $this->db->insert('tb_grupo', $dados);
        endif;
    }
    // atualiza regsitro de uma categoria
    // $dados => vetor de dados para update no BD
    public function atualiza_categoria($ln = array()){
        if(isset($ln['nome'])):
            $this->db->set('nome', $ln['nome']);
        endif;
        
        if(isset($ln['status'])):
            $this->db->set('status', $ln['status']);            
        endif;
        
        $this->db->where('id', $ln['id']);
        $this->db->update('tb_grupo');
        return $this->db->affected_rows();
    }
    
    public function atualiza_status_categoria($ln = array()){
       
        // atualiza registro do grupo pai
        $this->db->set('status', $ln['status']);
        $this->db->where('id_grupo_pai', $ln['id']);
        $this->db->update('tb_grupo');
        
            // verifica a partir de 3º nível se há filhos
            $this->db->where('id_grupo_pai', $ln['id']);
            $this->db->where('status', '1');
            $linha = $this->db->get('tb_grupo')->result();
        
                foreach($linha as $ln):
                    $this->db->set('status', 0);
                    $this->db->where('id_grupo_pai', $ln['id']);
                    $this->db->update('tb_grupo');
                endforeach;
            
        
        // atualiza registro do grupo pai
        $this->db->set('status', $ln['status']);
        $this->db->where('id', $ln['id']);
        $this->db->update('tb_grupo');
        return $this->db->affected_rows();
    }

    // exclusão de regsitro de uma categoria
    // Parametro identificador é coletado no 3º segmento da URL
    // ATENÇÃO! O sistema verifica se o registro possui dependencias
    //          caso possua as mesmas são deletadas
    public function excluir_categoria(){
        // exclui dependencias
        $this->db->where('id_grupo_pai', $this->uri->segment(3));
        $this->db->delete('tb_grupo');
        // exclui principal
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('tb_grupo');
        return $this->db->affected_rows();
    }
/*******************************************************************************
 * CORES
 ******************************************************************************/ 
    // lista todas as cores
    public function lista_cores(){
        $this->db->order_by('nome', 'asc');
        return $this->db->get('tb_cor')->result();
    }
    
    // lista cor por id
    public function lista_cor_id($id){
        $this->db->where('id', $id);
        return $this->db->get('tb_cor')->row(0);
    }
    
    // cadastro de uma nova cor
    // $dados => vetor de dados para inserção de registro
    public function add_cor($dados = null){
        if($dados != null){
            return $this->db->insert('tb_cor', $dados);
        }
    }
    // atuazliação de uma cor
    // $ln => vetor de dados para atualização do registro
    public function atualiza_cor($ln = array()){
        if(isset($ln['nome'])):
            $this->db->set('nome', $ln['nome']);
        endif;
        
        if(isset($ln['status'])):
            $this->db->set('status', $ln['status']);
        endif;
        
        $this->db->where('id', $ln['id']);
        $this->db->update('tb_cor');
        return $this->db->affected_rows();
    }
    // exclusão permanente de uma cor
    // Parametro identificador é coletado no 3º segmento da URL
    public function excluir_cor(){
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('tb_cor');
        return $this->db->affected_rows();
    }
    
/*******************************************************************************
 * TAMANHO
 ******************************************************************************/    
    // lista tamanhos para cadastro de produtos
    public function lista_tamanho(){
        $this->db->order_by('id', 'asc');
        return $this->db->get('tb_tamanho')->result();
    }
    
}