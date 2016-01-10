<?php
class Propriedade_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_propriedade($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('tb_propriedade');
            return $query->result_array();
        }

        $query = $this->db->get_where('tb_propriedade', array('id' => $id));
        return $query->row_array();
    }


    public function set_propriedade()
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'tabela' => $this->input->post('tabela'),
            'id_estabelecimento' => 1
        );

        return $this->db->insert('tb_propriedade', $data);
    }

}