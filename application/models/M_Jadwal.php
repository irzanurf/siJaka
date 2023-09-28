<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jadwal extends CI_Model
{
    public function get_jadwal(){
        $query = $this->db->select('*')
                ->from('tb_jadwal')
                ->order_by('id', 'DESC')
                ->get();
                return $query;
    }

    public function getwhere_jadwal($data){
        $query = $this->db->select('*')
                ->from('tb_jadwal')
                ->where($data)
                ->get();
                return $query;
    }

    public function input_jadwal($data){
        $this->db->insert('tb_jadwal',$data);
    }

    public function update_jadwal($data, $id)
    {
        $this->db->where('id',$id);
        $this->db->update('tb_jadwal',$data);
    }

    public function delete_jadwal($data){
        $query = $this->db->delete('tb_jadwal',$data);
        return $query;
    }

}