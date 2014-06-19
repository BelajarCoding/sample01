<?php

class Usermodel extends CI_Model
{
    function insert_data_user($data)
    {
        $this->db->insert('user',$data);
    }

    function get_user_by_id($id)
    {
        $this->db->where('user_id',$id);
        return $this->db->get('user');
    }

    function update_data_user($data,$id)
    {
        $this->db->where('user_id',$id);
        $this->db->update('user',$data);
    }

    function delete_user($id)
    {
        $this->db->where('user_id',$id);
        $this->db->delete('user');
    }
}

// simpan pada lokasi : application/models/usermodel.php
