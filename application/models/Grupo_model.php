<?php
class Grupo_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_grupo($id = FALSE, $id_grupo_pai = FALSE)
    {
        if ($id === FALSE) {
            $this->db->order_by('id_grupo_pai asc, nome asc');

            if ($id_grupo_pai === FALSE) {
                $query = $this->db->get('grupo');
            }
            else
            {
                $query = $this->db->get_where('grupo', array('id_grupo_pai' => $id_grupo_pai));
            }
            return $query->result_array();
        }


        $query = $this->db->get_where('grupo', array('id' => $id));
        return $query->row_array();
    }

    public function set_grupo($id = FALSE)
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'id_grupo_pai' => $this->input->post('id_grupo_pai'),
            'status' => $this->input->post('status')
        );

        if ($id != FALSE)
        {
            $this->db->where('id', $id);
            return $this->db->update('grupo', $data);
        }
        else
        {
            return $this->db->insert('grupo', $data);
        }
    }
}