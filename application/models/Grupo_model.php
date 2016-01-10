<?php
class Grupo_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_grupo($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('tb_grupo');
            return $query->result_array();
        }

        $query = $this->db->get_where('tb_grupo', array('id' => $id));
        return $query->row_array();
    }
}