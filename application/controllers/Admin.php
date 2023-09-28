<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('M_Login');
        $current_user=$this->M_Login->is_role();
        //cek session dan level user
        if($this->M_Login->is_role() != "1"){
            redirect("welcome/");
        }
        $this->load->helper('file');
        $this->load->model('M_Akun');
        $this->load->model('M_Jadwal');
        $this->load->model('M_Ruang');
        $this->load->model('M_Karyawan');
        $this->load->model('M_Penjadwalan');
    }

    public function index(){
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/dashboard');
        $this->load->view('layout/footer');
    }

    public function jadwal(){
        $data['jadwal']=$this->M_Jadwal->get_jadwal()->result();
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/jadwal',$data);
        $this->load->view('layout/footer');
    }

    public function add_jadwal(){
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $keterangan = $this->input->post('keterangan');
        $data = [
            'tgl_mulai'=>$tgl_mulai,
            'tgl_akhir'=>$tgl_akhir,
            'keterangan'=>$keterangan,
        ];
        $this->M_Jadwal->input_jadwal($data);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url('admin/jadwal'));
    }

    public function update_jadwal(){
        $id = $this->input->post('id');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $keterangan = $this->input->post('keterangan');
        $data = [
            'tgl_mulai'=>$tgl_mulai,
            'tgl_akhir'=>$tgl_akhir,
            'keterangan'=>$keterangan,
        ];
        $this->M_Jadwal->update_jadwal($data,$id);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil diperbaruhi</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url('admin/jadwal'));
    }

    public function delete_jadwal(){
        $id = $this->input->post('id');
        $this->M_Jadwal->delete_jadwal(array("id"=>$id));
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url('admin/jadwal'));
    }

    public function list_jadwal_unit(){
        $data['view'] = $this->M_Jadwal->get_jadwal()->result();
        $data['cek'] = "list_ruang";
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_jadwal', $data);
        $this->load->view('layout/footer');
    }

    public function list_ruang(){
        $data['jadwal'] = $this->input->get('jadwal');
        $data['view'] = $this->M_Ruang->get_fakultas()->result();
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_ruang', $data);
        $this->load->view('layout/footer');
    }

    public function all_list_penjadwalan(){
        $jadwal = $this->input->get('jadwal');
        if (empty($jadwal)){
            redirect(base_url('admin/list_ruang'));
        };
        $data['id_jadwal'] = $jadwal;
        $data['jadwal'] = $this->M_Jadwal->getwhere_jadwal(array('id'=>"$jadwal"))->row();
        $data['karyawan'] = $this->M_Karyawan->get_allwhere_karyawan($jadwal)->result();
        $data['all'] = $this->M_Karyawan->get_karyawan($jadwal)->result();
        $cek = [
            'tb_penjadwalan.id_jadwal'=>$jadwal,
        ];
        $data['unit'] = $this->M_Ruang->get_fakultas()->result();
        $data['view'] = $this->M_Ruang->get_penjadwalan($cek)->result();
        $data['link'] = "admin/all_list_penjadwalan?jadwal=$jadwal";
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/all_penjadwalan', $data);
        $this->load->view('layout/footer');
    }

    public function list_penjadwalan(){
        $jadwal = $this->input->get('jadwal');
        if (empty($jadwal)){
            redirect(base_url('admin/list_ruang'));
        };
        $unit = $this->input->get('unit');
        if (empty($unit)){
            redirect(base_url('admin/all_list_penjadwalan'));
        };
        $fakultas = $this->M_Ruang->get_id(array('id'=>"$unit"))->row()->fakultas;
        $data['id_jadwal'] = $jadwal;
        $data['id_unit'] = $unit;
        $data['fakultas'] = $fakultas;
        $data['jadwal'] = $this->M_Jadwal->getwhere_jadwal(array('id'=>"$jadwal"))->row();
        $data['karyawan'] = $this->M_Karyawan->getwhere_karyawan($fakultas, $jadwal)->result();
        $data['all'] = $this->M_Karyawan->get_karyawan($jadwal)->result();
        $cek = [
            'tb_penjadwalan.id_jadwal'=>$jadwal,
            'tb_ruang.unit'=>$fakultas,
        ];
        $data['ruang'] = $this->M_Ruang->getwhere_ruang(array('unit'=>"$fakultas"))->result();
        $data['view'] = $this->M_Ruang->get_penjadwalan($cek)->result();
        $data['link'] = "admin/list_penjadwalan?jadwal=$jadwal&unit=$unit";
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/penjadwalan', $data);
        $this->load->view('layout/footer');
    }

    public function insert_penjadwalan(){
        $link = $this->input->post('link');
        $unit = $this->input->post('unit');
        $ruang = $this->input->post('ruang');
        $jadwal = $this->input->post('jadwal');
        $nip = $this->input->post('nip');
        $tgl = $this->input->post('tgl');
        $time_mulai = $this->input->post('time_mulai');
        $time_akhir = $this->input->post('time_akhir');
        $jabatan = $this->input->post('jabatan');
        $ket = $this->input->post('ket');
        $data_ruang = [
            'unit'=>"$unit",
            'ruang'=>"$ruang"
        ];
        $id_ruang = $this->M_Ruang->insert_ruang($data_ruang);
        $data_penjadwalan = [
            'nip'=>"$nip",
            'id_jadwal'=>"$jadwal",
            'id_ruang'=>"$id_ruang",
            'jabatan'=>"$jabatan",
            'tgl'=>"$tgl",
            'time_mulai'=>"$time_mulai",
            'time_akhir'=>"$time_akhir",
            'keterangan'=>"$ket"
        ];
        $this->M_Penjadwalan->insert_penjadwalan($data_penjadwalan);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));
    }

    public function delete_penjadwalan(){
        $link = $this->input->post('link');
        $id = $this->input->post('id');
        $this->M_Penjadwalan->delete_penjadwalan(array("id"=>$id));
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));
    }

    public function list_jadwal_karyawan(){
        $data['view'] = $this->M_Jadwal->get_jadwal()->result();
        $data['cek'] = "list_karyawan";
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_jadwal', $data);
        $this->load->view('layout/footer');
    }

    public function list_karyawan(){
        $data['jadwal'] = $this->input->get('jadwal');
        if (empty($data['jadwal'])){
            redirect(base_url('admin/list_jadwal_karyawan'));
        };
        $data['view'] = $this->M_Karyawan->get_list_karyawan()->result();
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_karyawan', $data);
        $this->load->view('layout/footer');
    }

    public function list_karyawan_penjadwalan(){
        $jadwal = $this->input->get('jadwal');
        if (empty($jadwal)){
            redirect(base_url('admin/list_jadwal_karyawan'));
        };
        $nip = $this->input->get('nip');
        if (empty($nip)){
            redirect(base_url("admin/list_karyawan?jadwal=$jadwal"));
        };
        $nama = $this->input->get('nama');
        if (empty($nama)){
            redirect(base_url("admin/list_karyawan?jadwal=$jadwal"));
        };
        $data['nama'] = $nama;
        $data['nip'] = $nip;
        $data['jadwal'] = $this->M_Jadwal->getwhere_jadwal(array('id'=>"$jadwal"))->row();
        $cek = [
            'tb_penjadwalan.id_jadwal'=>$jadwal,
            'tb_karyawan.nip'=>$nip,
        ];
        $data['view'] = $this->M_Ruang->get_penjadwalan($cek)->result();
        $data['unit'] = $this->M_Ruang->get_fakultas()->result();
        $data['link'] = "admin/list_karyawan_penjadwalan?jadwal=$jadwal&nip=$nip&nama=$nama";
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_karyawan_penjadwalan', $data);
        $this->load->view('layout/footer');
    }

    public function get_ruang(){
        $fakultas = $this->input->post('unit');
        $data['ruang'] = $this->M_Ruang->getwhere_ruang(array('unit'=>"$fakultas"))->result();
        echo json_encode($data);
    }

    public function karyawan(){
        // $data['view'] = $this->M_Karyawan->get_simple_list_karyawan()->result();
        $data['unit'] = $this->M_Ruang->get_fakultas()->result();
        $data['pendidikan'] = $this->M_Karyawan->get_pendidikan()->result();
        $head['sidebar'] = "admin";
        $nomor = $this->input->get('page');
        $q = $this->input->get('q');
        

        if(empty($nomor))
        {
            $nomor=1;
        }
        $previous = (int)$nomor-1;
        $next = (int)$nomor+1;
        $cek = $this->M_Karyawan->get_simple_list_karyawan($nomor, $q)->result();
        
            $data['view'] = $cek;
            //CEK PREVIOUS BUTTON
            if($previous==0){
                $data['previous']=0;
            }
            else{
                $previous_cek = $this->M_Karyawan->get_simple_list_karyawan($previous, $q)->result();
                if (empty($previous_cek)){
                    $data['previous']=0;
                }
                else{
                    $data['previous']=1;
                }
            }

            //CEK NEXT BUTTON
            $next_cek = $this->M_Karyawan->get_simple_list_karyawan($next, $q)->result();
            if (empty($next_cek)){
                $data['next']=0;
            }
            else{
                $data['next']=1;
            }
        // $foot['max'] = $this->M_Alumni->get_max_chart()->row();
        $data['cari']=$q;
        $data['page']=$nomor;
        $this->load->view('layout/header', $head);
        $this->load->view('admin/karyawan', $data);
        $this->load->view('layout/footer');
    }

    public function delete_karyawan(){
        $nip = $this->input->post('nip');
        $this->M_Karyawan->delete_karyawan(array("nip"=>$nip));
        $this->M_Penjadwalan->delete_penjadwalan(array("nip"=>$nip));
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url('admin/karyawan'));
    }

    public function insert_karyawan(){
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $unit = $this->input->post('unit');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $pendidikan = $this->input->post('pendidikan');
        $jenis_pekerjaan = $this->input->post('jenis_pekerjaan');
        $golongan = $this->input->post('golongan');
        $npwp = $this->input->post('npwp');
        $no_hp = $this->input->post('no_hp');
        $email = $this->input->post('email');
        $status_bekerja = $this->input->post('status_bekerja');
        $status_kepegawaian = $this->input->post('status_kepegawaian');
        $data = [
            'nip'=>"$nip",
            'nama'=>"$nama",
            'tgl_lahir'=>"$tgl_lahir",
            'pendidikan'=>"$pendidikan",
            'jenis_pekerjaan'=>"$jenis_pekerjaan",
            'golongan'=>"$golongan",
            'institusi'=>"$unit",
            'npwp'=>"$npwp",
            'no_hp'=>"$no_hp",
            'email'=>"$email",
            'status_bekerja'=>"$status_bekerja",
            'status_kepegawaian'=>"$status_kepegawaian"
        ];
        $this->M_Karyawan->insert_karyawan(array('nip'=>"$nip"),$data);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("admin/karyawan"));
    }

    public function update_karyawan(){
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $unit = $this->input->post('unit');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $pendidikan = $this->input->post('pendidikan');
        $jenis_pekerjaan = $this->input->post('jenis_pekerjaan');
        $golongan = $this->input->post('golongan');
        $npwp = $this->input->post('npwp');
        $no_hp = $this->input->post('no_hp');
        $email = $this->input->post('email');
        $data = [
            'nip'=>"$nip",
            'nama'=>"$nama",
            'tgl_lahir'=>"$tgl_lahir",
            'pendidikan'=>"$pendidikan",
            'jenis_pekerjaan'=>"$jenis_pekerjaan",
            'golongan'=>"$golongan",
            'institusi'=>"$unit",
            'npwp'=>"$npwp",
            'no_hp'=>"$no_hp",
            'email'=>"$email"
        ];
        $this->M_Karyawan->update_karyawan(array('nip'=>"$nip"),$data);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("admin/karyawan"));
    }

    public function list_assign_karyawan(){
        $data['view'] = $this->M_Jadwal->get_jadwal()->result();
        $data['cek'] = "assign_karyawan";
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_jadwal', $data);
        $this->load->view('layout/footer');
    }

    public function assign_karyawan(){
        $id_jadwal = $this->input->get('jadwal');
        $cond = [
            "tb_assign_karyawan.id_jadwal"=>$id_jadwal
        ];
        $nomor = $this->input->get('page');
        $q = $this->input->get('q');
        

        if(empty($nomor))
        {
            $nomor=1;
        }
        $previous = (int)$nomor-1;
        $next = (int)$nomor+1;
        $cek = $this->M_Karyawan->get_assign_karyawan($nomor, $q, $cond)->result();
        
            $data['view'] = $cek;
            //CEK PREVIOUS BUTTON
            if($previous==0){
                $data['previous']=0;
            }
            else{
                $previous_cek = $this->M_Karyawan->get_assign_karyawan($previous, $q, $cond)->result();
                if (empty($previous_cek)){
                    $data['previous']=0;
                }
                else{
                    $data['previous']=1;
                }
            }

            //CEK NEXT BUTTON
            $next_cek = $this->M_Karyawan->get_assign_karyawan($next, $q, $cond)->result();
            if (empty($next_cek)){
                $data['next']=0;
            }
            else{
                $data['next']=1;
            }
        // $foot['max'] = $this->M_Alumni->get_max_chart()->row();
        $data['cari']=$q;
        $data['page']=$nomor;
        $data['jadwal'] = $this->M_Jadwal->getwhere_jadwal(array('id'=>"$id_jadwal"))->row();
        $data['karyawan'] = $this->M_Karyawan->getwhere_all_karyawan_unit($id_jadwal)->result();
        $data['jabatan'] = $this->M_Penjadwalan->get_jabatan()->result();
        $data['new_jabatan'] = $this->M_Penjadwalan->get_new_jabatan()->result();
        // $data['view'] = $this->M_Karyawan->get_assign_karyawan($cond)->result();
        $data['unit'] = $this->M_Ruang->get_fakultas()->result();
        $data['link'] = "admin/assign_karyawan?jadwal=$id_jadwal";
        $data['pendidikan'] = $this->M_Karyawan->get_pendidikan()->result();
        $head['sidebar'] = "admin";
        $this->load->view('layout/header',$head);
        $this->load->view('admin/list_assign', $data);
        $this->load->view('layout/footer');
    }

    public function update_jabatan(){
        $id = $this->input->post('id');
        $jabatan = $this->input->post('jabatan');
        $link = $this->input->post('link');
        $cek = [
            "id"=>"$id"
        ];
        $data = [
            "id_jabatan"=>"$jabatan"
        ];
        $this->M_Penjadwalan->update_jabatan($cek, $data);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Jabatan berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));

    }

    public function tambah_assign_karyawan(){
        $unit = $this->input->post('unit');
        $jadwal = $this->input->post('jadwal');
        $link = $this->input->post('link');
        $karyawan = $this->input->post('karyawan');
        $jabatan = $this->input->post('jabatan');
        $link = $this->input->post('link');
        $ket = $this->input->post('ket');
        $cek = [
            "id_karyawan"=>"$karyawan",
            "id_jadwal"=>"$jadwal",
            "id_unit"=>"$unit",
        ];
        $data = [
            "id_karyawan"=>"$karyawan",
            "id_jadwal"=>"$jadwal",
            "id_unit"=>"$unit",
            "id_jabatan"=>"$jabatan",
            "ket"=>"$ket",
        ];
        $this->M_Penjadwalan->assign_karyawan($cek, $data, $link);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Karyawan berhasil diassignkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));
    }

    public function unit (){
        $data['view'] = $this->M_Ruang->get_fakultas()->result();
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/list_unit', $data);
        $this->load->view('layout/footer');
    }

    public function tambah_unit(){
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $password = md5($username);
        $cek = [
            "username"=>"$username",
        ];
        $unit = [
            "username"=>"$username",
            "fakultas"=>"$nama",
        ];
        $user = [
            "username"=>"$username",
            "password"=>"$password",
            "role"=>"2",
        ];
        $this->M_Ruang->insert_unit($unit, $cek);
        $this->M_Akun->insert_akun($user, $username);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("admin/unit"));
    }

    public function import() {
        $this->load->library('Csvimport');
        //Check file is uploaded in tmp folder
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            //validate whether uploaded file is a csv file
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileArr = explode('.', $_FILES['file']['name']);
            $ext = end($fileArr);
            if (($ext == 'csv') && in_array($mime, $csvMimes)) {
                $file = $_FILES['file']['tmp_name'];
                $csvData = $this->csvimport->get_array($file);
                
                        $first = array_key_first($csvData[0]);
                        
                        foreach ($csvData as $row) {
                            // $date = $row["$first"];
                            $tgl_lahir = date('Y-m-d', strtotime($row["TGL LAHIR"])); 
                            // if(($row['PENDIDIKAN'])=="SD" || ($row['PENDIDIKAN'])=="MI" || ($row['PENDIDIKAN'])=="Paket A"){
                            //     $pend = "1";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="SMP" || ($row['PENDIDIKAN'])=="MTS" || ($row['PENDIDIKAN'])=="Paket B"){
                            //     $pend = "2";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="SMA" || ($row['PENDIDIKAN'])=="SMK" || ($row['PENDIDIKAN'])=="MA" || ($row['PENDIDIKAN'])=="Paket C"){
                            //     $pend = "3";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="D1"){
                            //     $pend = "4";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="D2"){
                            //     $pend = "5";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="D3"){
                            //     $pend = "6";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="D4" || ($row['PENDIDIKAN'])=="S1" || ($row['PENDIDIKAN'])=="S1 Profesi"){
                            //     $pend = "7";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="Sp-1"){
                            //     $pend = "8";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="Sp-2"){
                            //     $pend = "9";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="S2" || ($row['PENDIDIKAN'])=="S2 Terapan"){
                            //     $pend = "10";
                            // }
                            // elseif(($row['PENDIDIKAN'])=="S3"){
                            //     $pend = "11";
                            // }
                            // else{
                            //     $pend = "3";
                            // }
                            // if() 
                            
                            $data = array(
                                "nama" => $row["NAMA LENGKAP"],
                                "nip" => $row['NIP'],
                                "golongan" => $row['GOLONGAN'],
                                "tgl_lahir" => $tgl_lahir,
                                "npwp" => $row['NPWP'],
                                "status_bekerja" => $row['STATUS BEKERJA'],
                                "jenis_pekerjaan" => $row['JENIS PEG'],
                                "status_kepegawaian" => $row['STATUS KEPEGAWAIAN'],
                                "pendidikan" => $row['PENDIDIKAN'],
                                "institusi" => $row['UNIT ES'],
                                "email" => $row['EMAIL'],
                                "no_hp" => $row['NO. HP'],
                            );
                            $cek = [
                                "nip" => $row['NIP'],
                            ];
                            $save = $this->M_Karyawan->save($data, $cek);
                        }
                        if ($save==1){
                            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Data berhasil ter-import</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
                            redirect("admin/karyawan"); 
                        }
                        else {
                            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <b><i class="fa fa-exclamation-circle"></i> ERROR</b> Format template tidak sesuai
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
                            redirect("admin/karyawan"); 
                        }
                    
                }
            
        } else {
            // $this->session->set_flashdata("error_msg", "Please select a CSV file to upload.");
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <b><i class="fa fa-exclamation-circle"></i> ERROR</b> Silahkan pilih CSV file terlebih dahulu
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>');;
            redirect("admin/"); 
        }
    }

    public function export()
    {
        $jadwal = $this->input->post('jadwal');
        $jumlah = $this->M_Penjadwalan->get_max()->result();
        $fileName = 'Penugasan';  
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cek = [
            "tb_assign_karyawan.id_jadwal"=>$jadwal,
        ];
        $v = $this->M_Penjadwalan->get_penjadwalan($cek)->result();
        // $sheet->setCellValue('A1', 'List Penugasan Karyawan');
        // $sheet->setCellValue('A2', date('Y-m-d'));
        
        $rows = 3;
        foreach($jumlah as $j){
            $sheet->setCellValue('A'.$rows, $j->jabatan);
            $sheet->setCellValue('B'.$rows, $j->jumlah);
            $rows++;
        }
        $sheet->setCellValue('A11', 'No');
        $sheet->setCellValue('B11', 'NIP');
        $sheet->setCellValue('C11', 'Nama Lengkap');
        $sheet->setCellValue('D11', 'Jabatan');
        $sheet->setCellValue('E11', 'Tgl Lahir');
        $sheet->setCellValue('F11', 'Golongan');
        $sheet->setCellValue('G11', 'Pendidikan');
        $sheet->setCellValue('H11', 'NPWP');
        $sheet->setCellValue('I11', 'Unit Kerja');
        $sheet->setCellValue('J11', 'Status Bekerja');
        $sheet->setCellValue('K11', 'Jenis Pegawai');
        $sheet->setCellValue('L11', 'Status Kepegawaian');
        
        $no = 1;
        $rows = 12;

        foreach($v as $v){
            $sheet->setCellValue('A'.$rows, $no++);
            $sheet->setCellValue('B'.$rows, "'"."$v->nip");
            $sheet->setCellValue('C'.$rows, $v->nama);
            $sheet->setCellValue('d'.$rows, $v->jabatan);
            $sheet->setCellValue('E'.$rows, $v->tgl_lahir);
            $sheet->setCellValue('F'.$rows, $v->golongan);
            $sheet->setCellValue('G'.$rows, $v->pendidikan);
            $sheet->setCellValue('H'.$rows, "'"."$v->npwp");
            $sheet->setCellValue('I'.$rows, $v->unit_assign);
            $sheet->setCellValue('J'.$rows, $v->status_bekerja);
            $sheet->setCellValue('K'.$rows, $v->jenis_pekerjaan);
            $sheet->setCellValue('L'.$rows, $v->status_kepegawaian);

            $rows++;
            
        }

        $writer = new Xlsx($spreadsheet);
        // $filename = 'laporan-siswa';
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

    }

    public function tambah_assign_petugas(){
        $username = $this->input->post('unit');
        $jadwal = $this->input->post('jadwal');
        $link = $this->input->post('link');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $link = $this->input->post('link');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $npwp = $this->input->post('npwp');
        $no_hp = $this->input->post('no_hp');
        $email = $this->input->post('email');
        $pendidikan = $this->input->post('pendidikan');
        $nik = $this->input->post('nik');
        $data = [
            "id_karyawan"=>"$nik",
            "id_jadwal"=>"$jadwal",
            "id_unit"=>"$username",
            "id_jabatan"=>"$jabatan",
            // "ket"=>"$ket",
        ];
        $data_karyawan=[
            "nip"=>"$nik",
            "jenis_pekerjaan"=>"Eksternal",
            "tgl_lahir"=>"$tgl_lahir",
            "nama"=>"$nama",
            "npwp"=>"$npwp",
            "golongan"=>"eks",
            "no_hp"=>"$no_hp",
            "email"=>"$email",
            "institusi"=>"$username",
            "pendidikan"=>"$pendidikan",
            "status_bekerja"=>"eks",
            "status_kepegawaian"=>"eks",
        ];
        $this->M_Penjadwalan->assign_karyawan($data, $data_karyawan, $nik, $link);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Karyawan berhasil diassignkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));
    }

    public function delete_unit(){
        $username = $this->input->post('id');
        $this->M_Ruang->delete_unit(array("username"=>$username));
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url('admin/unit'));
    }

    public function passakun()
    {
        $username = $this->input->post('id');
        $data['akun']= $this->M_Akun->getwhere_unit(array('username'=>"$username"))->row();
        $head['sidebar'] = "admin";
        $this->load->view('layout/header', $head);
        $this->load->view('admin/pass_akun', $data);
        $this->load->view("layout/footer");
    }

    public function changePass()
    {
        $username = $this->input->post('username',true);
        $pass = $this->input->post('pass',true);
        $password = [
            'password'=>MD5($pass),
        ];
        $this->M_Akun->changePass($username, $password);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Data berhasil diubah</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
        redirect("Admin/unit"); 
    }

    public function delete_penugasan(){
        $id = $this->input->post('id');
        $link = $this->input->post('link');
        $this->M_Penjadwalan->del_assign_jabatan_karyawan(array("id"=>"$id"));
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));
    }

    public function rekap(){
        $head['sidebar'] = "admin";
        $jadwal = $this->input->get('jadwal');
        $unit = $this->M_Ruang->get_fakultas()->result();
        $temp = [];
        for($i=0, $count = count($unit);$i<$count;$i++){
            $unit_name = $unit[$i]->fakultas;
            $id_unit = $unit[$i]->username;
            $jumlah = $this->M_Penjadwalan->get_max_unit($id_unit, $jadwal)->result();
            $cek = [
                "unit"=>"$unit_name",
                "dat"=>$jumlah
            ];
            array_push($temp, $cek);
        };
        // print_r($temp);
        $data['view'] = $temp;
        $data['jadwal'] = $jadwal;
        $this->load->view('layout/header', $head);
        $this->load->view('admin/rekap', $data);
        $this->load->view('layout/footer');
    }

    // public function pegawai_list()
    // {
    //     $list = $this->emp->get_datatables();
    //     $data = array();
    //     foreach ($list as $l) {
    //         $row = array();
    //         $row[] = $l->nip;
    //         $row[] = $l->nama;
    //         $row[] = $l->institusi;
    //         $row[] = "<form style='display:inline-block;' data-toggle='tooltip' data-placement='bottom' title='Edit'>
    //         <button class='btn btn-primary' type='button' data-toggle='modal' data-target='.edit$l->nip'>
    //         <i class='la la-edit' style='color:white'></i>
    //         </button>
    //         </form>".
            
    //         "<form style='display:inline-block;' method='post' onclick='return confirm('Apakah Anda Yakin Ingin Menghapus?');' action=".base_url('Admin/delete_karyawan').">
    //         <input type='hidden' name='nip' value='$l->nip'>
    //         <button type='Submit' class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Hapus'>
    //         <i class='la la-trash' style='color:white'></i>
    //         </button>
    //         </form>";
 
    //         $data[] = $row;
    //     }
 
    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->emp->count_all(),
    //         "recordsFiltered" => $this->emp->count_filtered(),
    //         "data" => $data,
    //             );
    //     //output to json format
    //     echo json_encode($output);
    // }

}