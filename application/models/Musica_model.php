<?php
class Musica_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_musica($id = FALSE, $nome = "", $autor = "", $grupo = 0)
    {

        if ($id === FALSE) {
            if ($nome <> ''){
                $this->db->like("name", $nome);    
            }    

            if ($autor <> ''){
                $this->db->like("autor", $autor);    
            }     

            if ($grupo >  0)
            {
                $this->db->where('id_grupo', $grupo);
            }

        
            $this->db->order_by('nome asc');
            $query = $this->db->get('musica');

            return $query->result_array();
        }

        $query = $this->db->get_where('musica', array('id' => $id));
        return $query->row_array();
    }


    public function set_musica($id = FALSE)
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'autor' => $this->input->post('autor'),
            'palavras' => $this->input->post('palavras'),
            'id_grupo' => $this->input->post('id_grupo'),
            'link_letra' => $this->input->post('link_letra'),
            'link_video' => $this->input->post('link_video'),
            'link_cifra' => $this->input->post('link_cifra'),
            'link_datashow' => $this->input->post('link_datashow'),
            'id_grupo' => $this->input->post('id_grupo')
        );

        if ($id != FALSE)
        {
            $this->db->where('id', $id);
            return $this->db->update('musica', $data);
        }
        else
        {
            return $this->db->insert('musica', $data);
        }
    }

}