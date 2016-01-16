<?php
class Grupo_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_grupo($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get_where('tb_grupo', array('id_estabelecimento' => ID_ESTABELECIMENTO ));
            return $query->result_array();
        }

        $query = $this->db->get_where('tb_grupo', array('id' => $id, 'id_estabelecimento' => ID_ESTABELECIMENTO));
        return $query->row_array();
    }

    public function set_grupo($id = FALSE)
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'id_estabelecimento' => ID_ESTABELECIMENTO,
            'status' => $this->input->post('status')
        );

        if ($id != FALSE)
        {
            $this->db->where('id', $id);
            return $this->db->update('tb_grupo', $data);
        }
        else
        {
            return $this->db->insert('tb_grupo', $data);
        }
    }
}