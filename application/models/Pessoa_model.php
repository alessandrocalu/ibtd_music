<?php
class Pessoa_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_pessoa($id = FALSE, $nome = "", $email = "", $grupo = 0)
    {

        if ($id === FALSE) {
            if ($nome <> ''){
                $this->db->like("name", $nome);    
            }    

            if ($email <> ''){
                $this->db->like("email", $autor);    
            }     

            if ($grupo >  0)
            {
                $this->db->where('id_grupo', $grupo);
            }

        
            $this->db->order_by('nome asc');
            $query = $this->db->get('pessoa');

            return $query->result_array();
        }

        $query = $this->db->get_where('pessoa', array('id' => $id));
        return $query->row_array();
    }


    public function set_pessoa($id = FALSE)
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'id_grupo' => $this->input->post('id_grupo'),
            'status' => 1
        );

        if ($id != FALSE)
        {
            $this->db->where('id', $id);
            return $this->db->update('pessoa', $data);
        }
        else
        {
            return $this->db->insert('pessoa', $data);
        }
    }

}