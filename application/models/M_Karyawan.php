<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Karyawan extends CI_Model
{

    public function save($data, $cek){
        $query = $this->db->select('*')
        ->from('tb_karyawan')
        ->where($cek)
        ->get();
        $result = $query->result_array();
        $count = count($result);
        if (empty($count)){
            $this->db->insert('tb_karyawan',$data);
        }
        else{
            $this->db->where($cek);
            $this->db->update('tb_karyawan',$data);
        } 
        return 1;
    }
    // AND (TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()))<=40
    public function getwhere_karyawan($id, $jadwal){
        return $this->db->query("SELECT tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_penjadwalan WHERE tb_penjadwalan.nip = tb_karyawan.nip AND id_jadwal=$jadwal) AS total 
        FROM tb_karyawan 
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
        WHERE tb_karyawan.institusi = '$id' AND tb_karyawan.pendidikan>=0");
    }

    public function getwhere_karyawan_unit($id, $jadwal){
        return $this->db->query("SELECT tb_karyawan.*, tb_assign_karyawan.id_jabatan, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_assign_karyawan WHERE tb_assign_karyawan.id_karyawan = tb_karyawan.nip AND id_jadwal=$jadwal) AS total 
        FROM tb_karyawan 
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
        LEFT JOIN tb_assign_karyawan ON tb_karyawan.nip = tb_assign_karyawan.id_karyawan
        WHERE tb_karyawan.institusi = '$id' AND tb_karyawan.pendidikan>=0");
    }

    public function getwhere_all_karyawan_unit($jadwal){
        return $this->db->query("SELECT tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_assign_karyawan WHERE tb_assign_karyawan.id_karyawan = tb_karyawan.nip AND id_jadwal=$jadwal) AS total 
        FROM tb_karyawan 
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
        WHERE tb_karyawan.pendidikan>=0");
    }

    public function get_allwhere_karyawan($jadwal){
        return $this->db->query("SELECT tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_penjadwalan WHERE tb_penjadwalan.nip = tb_karyawan.nip AND id_jadwal=$jadwal) AS total 
        FROM tb_karyawan 
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
        WHERE tb_karyawan.pendidikan>=0");
    }

    public function get_karyawan($jadwal){
        return $this->db->query("SELECT tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_penjadwalan WHERE tb_penjadwalan.nip = tb_karyawan.nip AND id_jadwal=$jadwal) AS total 
        FROM tb_karyawan
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id");
    }

    public function get_list_karyawan(){
        return $this->db->query("SELECT tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_penjadwalan WHERE tb_penjadwalan.nip = tb_karyawan.nip) AS total 
        FROM tb_karyawan
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id");
    }

    public function get_list_karyawan_unit($unit){
        return $this->db->query("SELECT tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
        (SELECT COUNT(*) FROM tb_penjadwalan WHERE tb_penjadwalan.nip = tb_karyawan.nip) AS total 
        FROM tb_karyawan
        INNER JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
        WHERE institusi = '$unit'");
    }

    public function get_simple_karyawan($unit){
        $query = $this->db->select('*')
        ->from('tb_karyawan')
        ->where($unit)
        ->get();
        return $query;
    }

    public function get_simple_list_karyawan($nomor, $q){
        $page = abs((int)$nomor);
        $first = $page*20-20;
        if (empty($q)){
            $query = $this->db->select('*')
            ->from('tb_karyawan')
            ->order_by('nip','asc')
            ->limit(20, $first)
            ->get();
            return $query;
        }
        else {
            $query = $this->db->select('*')
            ->from('tb_karyawan')
            ->like('nama', $q)
            ->or_like('nip', $q)
            ->order_by('nip','asc')
            ->limit(20, $first)
            ->get();
            return $query;
        }
    }

    public function get_simple_list_karyawan_unit($nomor, $q, $cond){
        $page = abs((int)$nomor);
        $first = $page*20-20;
        if (empty($q)){
            $query = $this->db->select('*')
            ->from('tb_karyawan')
            ->where($cond)
            ->order_by('nip','asc')
            ->limit(20, $first)
            ->get();
            return $query;
        }
        else {
            $query = $this->db->select('*')
            ->from('tb_karyawan')
            ->like('nama', $q)
            ->or_like('nip', $q)
            ->where($cond)
            ->order_by('nip','asc')
            ->limit(20, $first)
            ->get();
            return $query;
        }
    }

    public function delete_karyawan($data){
        $query = $this->db->delete('tb_karyawan',$data);
        return $query;
    }

    public function get_pendidikan(){
            $query = $this->db->select('*')
                    ->from('tb_pendidikan')
                    ->get();
                    return $query;
    }

    public function get_assign_karyawan($nomor, $q, $cond){
        $page = abs((int)$nomor);
        $first = $page*20-20;
        if (empty($q)){
            $query = $this->db->select('tb_assign_karyawan.id as id_assign, tb_assign_karyawan.ket as keterangan_assign, tb_assign_karyawan.id_jabatan, tb_karyawan.*, tb_jabatan.jabatan, tb_pendidikan.pendidikan, tb_fakultas.fakultas as unit_assign')
                    ->from('tb_assign_karyawan')
                    ->join('tb_karyawan','tb_assign_karyawan.id_karyawan=tb_karyawan.nip','inner')
                    ->join('tb_jabatan','tb_assign_karyawan.id_jabatan=tb_jabatan.id','inner')
                    ->join('tb_pendidikan','tb_karyawan.pendidikan=tb_pendidikan.id','left')
                    ->join('tb_fakultas','tb_fakultas.username=tb_assign_karyawan.id_unit','inner')
                    ->where($cond)
                    // ->where("TIMESTAMPDIFF (YEAR, tb_karyawan.tgl_lahir, CURDATE()) <", '50')
                    ->order_by('nip','asc')
                    ->limit(20, $first)
                    ->get();
                    return $query;
        }
        else {
            $query = $this->db->select('tb_assign_karyawan.id as id_assign, tb_assign_karyawan.ket as keterangan_assign, tb_assign_karyawan.id_jabatan, tb_karyawan.*, tb_jabatan.jabatan, tb_pendidikan.pendidikan, tb_fakultas.fakultas as unit_assign')
            ->from('tb_assign_karyawan')
            ->join('tb_karyawan','tb_assign_karyawan.id_karyawan=tb_karyawan.nip','inner')
            ->join('tb_jabatan','tb_assign_karyawan.id_jabatan=tb_jabatan.id','inner')
            ->join('tb_pendidikan','tb_karyawan.pendidikan=tb_pendidikan.id','left')
            ->join('tb_fakultas','tb_fakultas.username=tb_assign_karyawan.id_unit','inner')
            ->like('tb_karyawan.nip', $q)
            ->or_like('tb_karyawan.nama', $q)
            ->or_like('tb_jabatan.jabatan', $q)
            ->or_like('tb_fakultas.fakultas', $q)
            ->or_like('tb_pendidikan.pendidikan', $q)
            ->where($cond)
            // ->where("TIMESTAMPDIFF (YEAR, tb_karyawan.tgl_lahir, CURDATE()) <", '50')
            ->order_by('nip','asc')
            ->limit(20, $first)
            ->get();
            return $query;
        }
        
    }

    public function get_assign_karyawan_unit($nomor, $q, $cond, $jadwal){
        $where_au = ("tb_karyawan.institusi = '$cond' OR tb_assign_karyawan.id_unit = '$cond'");
        $where_ab = ("tb_assign_karyawan.id_jadwal = '$jadwal' OR tb_assign_karyawan.id_jadwal = ''");
        $page = abs((int)$nomor);
        $first = $page*20-20;
        if (empty($q)){
            $query = $this->db->select('tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) as "age"')
                    ->from('tb_karyawan')
                    ->join('tb_assign_karyawan',"tb_karyawan.nip=tb_assign_karyawan.id_karyawan AND tb_assign_karyawan.id_jadwal = '$jadwal' AND tb_assign_karyawan.id_unit = '$cond'",'left')
                    ->join('tb_pendidikan','tb_karyawan.pendidikan=tb_pendidikan.id','left')
                    ->where($where_au)
                    // ->where($where_au)
                    // ->where("DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),tb_karyawan.tgl_lahir)), '%Y')+0 <", 50)
                    ->order_by('nip','asc')
                    ->limit(20, $first)
                    ->get();
                    return $query;
        }
        else {
            $query = $this->db->select('tb_karyawan.*, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) as age')
            ->from('tb_karyawan')
            ->join('tb_assign_karyawan',"tb_karyawan.nip=tb_assign_karyawan.id_karyawan AND tb_assign_karyawan.id_jadwal = '$jadwal' AND tb_assign_karyawan.id_unit = '$cond'",'left')
            ->join('tb_pendidikan','tb_karyawan.pendidikan=tb_pendidikan.id','left')
            // ->where("DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),tb_karyawan.tgl_lahir)), '%Y')+0 <", 50)
            // ->where("(tb_karyawan.nip LIKE '%".$q."%' OR tb_karyawan.nama LIKE '%".$q."%' OR tb_pendidikan.pendidikan LIKE '%".$q."%')", NULL, FALSE)
            ->group_start()
            ->where($where_au)
            ->like('tb_karyawan.nip', $q)
            ->or_like('tb_karyawan.nama', $q)
            ->or_like('tb_pendidikan.pendidikan', $q)
            ->group_end()
            ->order_by('nip','asc')
            ->limit(20, $first)
            ->get();
            return $query;
        }
        
    }

    public function insert_karyawan($nip, $data){
        $query = $this->db->select('*')
        ->from('tb_karyawan')
        ->where($nip)
        ->get();
        $result = $query->result_array();
        $count = count($result);
        if (empty($count)){
            $this->db->insert('tb_karyawan',$data);
        }
        else{
            $this->db->where($nip);
            $this->db->update('tb_karyawan',$data);
        } 
    }

    public function update_karyawan($nip, $data){
        $this->db->where($nip);
        $this->db->update('tb_karyawan',$data);
    }

    public function get_pengajuan_karyawan($data){
        $query = $this->db->select('*')
        ->from('tb_pengajuan')
        ->where($data)
        ->get(); 
        return $query;
    }

    public function getwhere_karyawan_unit_new($nomor, $q, $id, $jadwal){
        $page = abs((int)$nomor);
        $first = $page*20-20;
        if (empty($q)){
            return $this->db->query("SELECT tb_karyawan.*, tb_assign_karyawan.id_jabatan, tb_pendidikan.pendidikan
            FROM tb_karyawan 
            LEFT JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
            LEFT JOIN tb_assign_karyawan ON tb_karyawan.nip = tb_assign_karyawan.id_karyawan AND tb_assign_karyawan.id_unit = '$id' AND tb_assign_karyawan.id_jadwal = $jadwal
            WHERE tb_karyawan.pendidikan>=0 
            -- AND (tb_karyawan.tgl_lahir ='0000-00-00' OR TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE())<50)
            AND (tb_assign_karyawan.id_unit = '$id' OR tb_karyawan.institusi = '$id')
            -- AND (tb_karyawan.nip LIKE '%$q%' OR tb_karyawan.nama LIKE '%$q%' OR tb_pendidikan.pendidikan LIKE '%$q%')
            LIMIT $first, 20");
        }
        else {
            return $this->db->query("SELECT tb_karyawan.*, tb_assign_karyawan.id_jabatan, tb_pendidikan.pendidikan, TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE()) AS umur,
            (SELECT COUNT(*) FROM tb_assign_karyawan WHERE tb_assign_karyawan.id_karyawan = tb_karyawan.nip AND id_jadwal=$jadwal) AS total 
            FROM tb_karyawan 
            LEFT JOIN tb_pendidikan ON tb_karyawan.pendidikan = tb_pendidikan.id
            LEFT JOIN tb_assign_karyawan ON tb_karyawan.nip = tb_assign_karyawan.id_karyawan AND tb_assign_karyawan.id_unit = '$id' AND tb_assign_karyawan.id_jadwal = $jadwal
            WHERE tb_karyawan.pendidikan>=0 
            -- AND (tb_karyawan.tgl_lahir ='0000-00-00' OR TIMESTAMPDIFF(YEAR, tb_karyawan.tgl_lahir, CURDATE())<50)
            AND (tb_assign_karyawan.id_unit = '$id' OR tb_karyawan.institusi = '$id')
            AND (tb_karyawan.nip LIKE '%$q%' OR tb_karyawan.nama LIKE '%$q%' OR tb_pendidikan.pendidikan LIKE '%$q%')
            LIMIT $first, 20");
        }
    }

    // public function get_last($id){
    //     $query = $this->db->select('*')
    //     ->from('tb_karyawan')
    //     ->like('nip', "$id")
    //     ->order_by('nip','desc')
    //     ->limit(1)
    //     ->get(); 
    //     return $query;
    // }
    
}