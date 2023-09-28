<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Ruang extends CI_Model
{
    public function get_fakultas(){
        $query = $this->db->select('*')
                ->from('tb_fakultas')
                ->order_by("fakultas","asc")
                ->get();
                return $query;
    }

    public function get_penjadwalan ($cek){
        $query = $this->db->select('tb_penjadwalan.*, tb_ruang.unit, tb_ruang.ruang, tb_karyawan.nip, tb_karyawan.nama')
                ->from('tb_penjadwalan')
                ->join('tb_ruang','tb_penjadwalan.id_ruang=tb_ruang.id','inner')
                ->join('tb_karyawan','tb_penjadwalan.nip=tb_karyawan.nip','inner')
                ->where($cek)
                ->get();
                return $query;
    }

    public function getwhere_ruang($data){
        $query = $this->db->select('*')
                ->from('tb_ruang')
                ->where($data)
                ->get();
                return $query;
    }

    public function get_id($data){
        $query = $this->db->select('*')
                ->from('tb_fakultas')
                ->where($data)
                ->get();
                return $query;
    }

    public function insert_ruang($data){
        $query = $this->db->select('*')
        ->from('tb_ruang')
        ->where($data)
        ->get();
        $result = $query->result_array();
        $count = count($result);
        if (empty($count)){
            $this->db->insert('tb_ruang',$data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        else{
            return $query->row()->id;
        } 
    }

    public function insert_unit($data, $cek){
        $query = $this->db->select('*')
        ->from('tb_fakultas')
        ->where($cek)
        ->get();
        $result = $query->result_array();
        $count = count($result);
        if (empty($count)){
            $this->db->insert('tb_fakultas',$data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data gagal ditambahkan, username telah digunakan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("admin/unit"));
        } 
    }

    public function delete_unit($data){
        $this->db->delete('tb_users',$data);
        $this->db->delete('tb_fakultas',$data);
    }
}