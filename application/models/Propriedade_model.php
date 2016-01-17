<?php
class Propriedade_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_propriedade($id = FALSE, $nome = "", $tabela = "")
    {

        if ($nome <> ''){
            if ($id === FALSE) {
                $query = $this->db->get_where('tb_propriedade', array('nome' => $nome, 'id_estabelecimento' => ID_ESTABELECIMENTO));
            }
            else
            {
                $query = $this->db->get_where('tb_propriedade', array('id !=' => $id, 'nome' => $nome, 'id_estabelecimento' => ID_ESTABELECIMENTO));
            }
            return $query->row_array();
        }


        if ($tabela <> '')
        {
            if ($id === FALSE) {
                $query = $this->db->get_where('tb_propriedade', array('tabela' => $tabela, 'id_estabelecimento' => ID_ESTABELECIMENTO ));
            }
            else
            {
                $query = $this->db->get_where('tb_propriedade', array('id !=' => $id, 'tabela' => $tabela, 'id_estabelecimento' => ID_ESTABELECIMENTO ));
            }
            return $query->row_array();
        }

        if ($id === FALSE) {
            $this->db->order_by('nome asc');
            $query = $this->db->get_where('tb_propriedade', array('id_estabelecimento' => ID_ESTABELECIMENTO ));

            return $query->result_array();
        }

        $query = $this->db->get_where('tb_propriedade', array('id' => $id, 'id_estabelecimento' => ID_ESTABELECIMENTO ));
        return $query->row_array();
    }


    public function set_propriedade($id = FALSE)
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'tabela' => $this->input->post('tabela'),
            'id_estabelecimento' => ID_ESTABELECIMENTO,
            'status' => $this->input->post('status')
        );

        if ($id != FALSE)
        {
            $this->db->where('id', $id);
            return $this->db->update('tb_propriedade', $data);
        }
        else
        {
            return $this->db->insert('tb_propriedade', $data);
        }
    }

}