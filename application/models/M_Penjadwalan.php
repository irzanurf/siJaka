<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Penjadwalan extends CI_Model
{
    public function insert_penjadwalan($data_penjadwalan){
        $this->db->insert('tb_penjadwalan',$data_penjadwalan);
    }

    public function delete_penjadwalan($data){
        $query = $this->db->delete('tb_penjadwalan',$data);
        return $query;
    }

    public function get_jabatan()
    {
        $query = $this->db->select('*')
        ->from('tb_jabatan')
        ->get();
        return $query;
    }

    public function get_new_jabatan()
    {
        $query = $this->db->select('*')
        ->from('tb_jabatan')
        ->where('id >=','5')
        ->get();
        return $query;
    }

    public function assign_karyawan($data, $data_karyawan, $link, $cek, $nik){
        $query = $this->db->select('tb_assign_karyawan.*')
        ->from('tb_assign_karyawan')
        ->where($cek)
        ->get();
        $result = $query->result_array();
        $count = count($result);
        if (empty($count)){
            $query1 = $this->db->select('tb_karyawan.*')
            ->from('tb_karyawan')
            ->where("nip","$nik")
            ->get();
            $result1 = $query1->result_array();
            $count1 = count($result1);
            $this->db->insert('tb_assign_karyawan',$data);
                if (empty($count1)){
                    $this->db->insert('tb_karyawan',$data_karyawan);
                }
                else {
                    $this->db->where("nip","$nik");
                    $this->db->update('tb_karyawan',$data_karyawan);
                }
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect(base_url("$link"));
        } 
        
    }

    public function assign_jabatan_karyawan($cek, $data){
        $query = $this->db->select('*')
        ->from('tb_assign_karyawan')
        ->where($cek)
        ->get();
        $result = $query->result_array();
        $count = count($result);
        if (empty($count)){
            $this->db->insert('tb_assign_karyawan',$data);
        }
        else{
            $this->db->where($cek);
            $this->db->update('tb_assign_karyawan',$data);
        } 
    }

    public function update_jabatan($cek, $data){
        $this->db->where($cek);
        $this->db->update('tb_assign_karyawan',$data);
    }

    public function del_assign_jabatan_karyawan($cek){
        $query = $this->db->delete('tb_assign_karyawan',$cek);
        return $query;
    }

    public function get_max(){
        return $this->db->query("SELECT id_jabatan, tb_jabatan.jabatan, count(*) as jumlah
        FROM tb_assign_karyawan
        INNER JOIN tb_jabatan ON tb_assign_karyawan.id_jabatan = tb_jabatan.id
        INNER JOIN tb_karyawan ON tb_assign_karyawan.id_karyawan = tb_karyawan.nip
        WHERE id_jabatan is not null
        GROUP BY id_jabatan
        ORDER BY id_jabatan ASC");
    }

    public function get_max_unit($id_unit, $jadwal){
        return $this->db->query("SELECT id_jabatan, tb_jabatan.jabatan, count(*) as jumlah
        FROM tb_assign_karyawan
        INNER JOIN tb_jabatan ON tb_assign_karyawan.id_jabatan = tb_jabatan.id
        INNER JOIN tb_karyawan ON tb_assign_karyawan.id_karyawan = tb_karyawan.nip
        WHERE id_jabatan is not null
        AND tb_assign_karyawan.id_unit = '$id_unit' 
        AND tb_assign_karyawan.id_jadwal = '$jadwal'
        GROUP BY id_jabatan
        ORDER BY id_jabatan ASC");
    }

    public function get_penjadwalan($data){
        $query = $this->db->select('tb_assign_karyawan.id as id_assign, tb_karyawan.*, tb_jabatan.jabatan, tb_pendidikan.pendidikan, tb_fakultas.fakultas as unit_assign')
                ->from('tb_assign_karyawan')
                ->join('tb_karyawan','tb_assign_karyawan.id_karyawan=tb_karyawan.nip','inner')
                ->join('tb_jabatan','tb_assign_karyawan.id_jabatan=tb_jabatan.id','inner')
                ->join('tb_pendidikan','tb_karyawan.pendidikan=tb_pendidikan.id','left')
                ->join('tb_fakultas','tb_fakultas.username=tb_assign_karyawan.id_unit','inner')
                ->where($data)
                ->get();
                return $query;
    }
}