<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Unit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('M_Login');
        $current_user=$this->M_Login->is_role();
        //cek session dan level user
        // if($this->M_Login->is_role() != "2"){
        //     redirect("welcome/");
        // }
        $this->load->model('M_Akun');
        $this->load->model('M_Jadwal');
        $this->load->model('M_Ruang');
        $this->load->model('M_Karyawan');
        $this->load->model('M_Penjadwalan');
    }

    public function index(){
        $this->load->view('layout/header');
        $this->load->view('unit/dashboard');
        $this->load->view('layout/footer');
    }

    public function list_assign_karyawan(){
        $data['view'] = $this->M_Jadwal->get_jadwal()->result();
        $data['cek'] = "assign_karyawan";
        $this->load->view('layout/header');
        $this->load->view('unit/list_jadwal', $data);
        $this->load->view('layout/footer');
    }

    public function assign_karyawan(){
        $username = $this->session->userdata('username');
        $id_jadwal = $this->input->get('jadwal');
        $nomor = $this->input->get('page');
        $q = $this->input->get('q');
        

        if(empty($nomor))
        {
            $nomor=1;
        }
        $previous = (int)$nomor-1;
        $next = (int)$nomor+1;
        $cek = $this->M_Karyawan->getwhere_karyawan_unit_new($nomor, $q, $username, $id_jadwal)->result();
        
            $data['karyawan'] = $cek;
            //CEK PREVIOUS BUTTON
            if($previous==0){
                $data['previous']=0;
            }
            else{
                $previous_cek = $this->M_Karyawan->getwhere_karyawan_unit_new($previous, $q, $username, $id_jadwal)->result();
                if (empty($previous_cek)){
                    $data['previous']=0;
                }
                else{
                    $data['previous']=1;
                }
            }

            //CEK NEXT BUTTON
            $next_cek = $this->M_Karyawan->getwhere_karyawan_unit_new($next, $q, $username, $id_jadwal)->result();
            if (empty($next_cek)){
                $data['next']=0;
            }
            else{
                $data['next']=1;
            }
        // $foot['max'] = $this->M_Alumni->get_max_chart()->row();
        $data['cari']=$q;
        $data['page']=$nomor;
        // $cond = [
        //     "tb_assign_karyawan.id_unit"=>$username,
        //     "tb_assign_karyawan.id_jadwal"=>$id_jadwal
        // ];
        
        $data['jadwal'] = $this->M_Jadwal->getwhere_jadwal(array('id'=>"$id_jadwal"))->row();
        // $data['karyawan'] = $this->M_Karyawan->getwhere_karyawan_unit($username, $id_jadwal)->result();
        $data['jabatan'] = $this->M_Penjadwalan->get_jabatan()->result();
        $data['new_jabatan'] = $this->M_Penjadwalan->get_new_jabatan()->result();
        $data['unit'] = $this->M_Ruang->get_id(array("username"=>"$username"))->row();
        $data['pendidikan'] = $this->M_Karyawan->get_pendidikan()->result();
        $data['link'] = "unit/assign_karyawan?jadwal=$id_jadwal";
        $this->load->view('layout/header');
        $this->load->view('unit/list_assign', $data);
        $this->load->view('layout/footer');
    }

    public function tambah_assign_karyawan(){
        $username = $this->session->userdata('username');
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
        $cek = [
            "id_karyawan"=>"$nik",
            "id_jadwal"=>"$jadwal",
            "id_unit"=>"$username",
        ];
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
        $this->M_Penjadwalan->assign_karyawan($data, $data_karyawan, $link, $cek, $nik);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Karyawan berhasil diassignkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect(base_url("$link"));
    }

    public function list_pengajuan(){
        $data['view'] = $this->M_Jadwal->get_jadwal()->result();
        $data['cek'] = "pengajuan_karyawan";
        $this->load->view('layout/header');
        $this->load->view('unir/list_jadwal', $data);
        $this->load->view('layout/footer');
    }

    public function list_karyawan(){
        $fakultas=$this->M_Login->get_Fakultas();
        echo "$fakultas";
        $data['karyawan'] = $this->M_Karyawan->get_karyawan($fakultas);
    }

    public function updateJabatan()
    {
        $unit = $this->session->userdata('username');
        $id = $this->input->post('id');
        $jabatan = $this->input->post('jabatan');
        $jadwal = $this->input->post('jadwal');
        $cek = [
            "id_karyawan"=>"$id",
            "id_unit"=>"$unit",
            "id_jadwal"=>"$jadwal"
        ];
        $data=[
            "id_jabatan"=>$jabatan,
            "id_karyawan"=>"$id",
            "id_unit"=>"$unit",
            "id_jadwal"=>"$jadwal"
        ];
        if($jabatan!="0"){
            $this->M_Penjadwalan->assign_jabatan_karyawan($cek,$data);
        }
        else{
            $this->M_Penjadwalan->del_assign_jabatan_karyawan($cek);
        }
    }

    // public function tambah_karyawan(){
    //     $unit = $this->session->userdata('username');
    //     $nama=$this->input->post('nama');
    //     $jabaatan=$this->input->post('jabatan');
    //     $data=[
    //         $id_karyawan="ekt"
    //     ]
    // }

    public function export()
    {
        $username = $this->session->userdata('username');
        $jadwal = $this->input->post('jadwal');
        $jumlah = $this->M_Penjadwalan->get_max_unit($username)->result();
        $fileName = 'Penugasan';  
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cek = [
            "tb_assign_karyawan.id_jadwal"=>$jadwal,
            "tb_assign_karyawan.id_unit"=>$username,
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
        $sheet->setCellValue('B11', 'Nama Lengkap');
        $sheet->setCellValue('C11', 'NIP');
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
            $sheet->setCellValue('B'.$rows, $v->nama);
            $sheet->setCellValue('C'.$rows, $v->nip);
            $sheet->setCellValue('d'.$rows, $v->jabatan);
            $sheet->setCellValue('E'.$rows, $v->tgl_lahir);
            $sheet->setCellValue('F'.$rows, $v->golongan);
            $sheet->setCellValue('G'.$rows, $v->pendidikan);
            $sheet->setCellValue('H'.$rows, $v->npwp);
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

    public function karyawan(){
        // $data['view'] = $this->M_Karyawan->get_simple_list_karyawan()->result();
        $unit = $this->session->userdata('username');
        $nomor = $this->input->get('page');
        $q = $this->input->get('q');
        $cond = [
            "tb_karyawan.institusi"=>$unit
        ];
        if(empty($nomor))
        {
            $nomor=1;
        }
        $previous = (int)$nomor-1;
        $next = (int)$nomor+1;
        $cek = $this->M_Karyawan->get_simple_list_karyawan_unit($nomor, $q, $cond)->result();
        
            $data['view'] = $cek;
            //CEK PREVIOUS BUTTON
            if($previous==0){
                $data['previous']=0;
            }
            else{
                $previous_cek = $this->M_Karyawan->get_simple_list_karyawan_unit($previous, $q, $cond)->result();
                if (empty($previous_cek)){
                    $data['previous']=0;
                }
                else{
                    $data['previous']=1;
                }
            }

            //CEK NEXT BUTTON
            $next_cek = $this->M_Karyawan->get_simple_list_karyawan_unit($next, $q, $cond)->result();
            if (empty($next_cek)){
                $data['next']=0;
            }
            else{
                $data['next']=1;
            }
        // $foot['max'] = $this->M_Alumni->get_max_chart()->row();
        $data['cari']=$q;
        $data['page']=$nomor;
        $this->load->view('layout/header');
        $this->load->view('unit/karyawan', $data);
        $this->load->view('layout/footer');
    }

    public function rekap(){
        $jadwal = $this->input->get('jadwal');
        $unit = $this->session->userdata('username');
        $data['view'] = $this->M_Penjadwalan->get_max_unit($unit,$jadwal)->result();
        $data['jadwal'] = $jadwal;
        $this->load->view('layout/header');
        $this->load->view('unit/rekap', $data);
        $this->load->view('layout/footer');
    }

}