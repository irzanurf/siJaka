<?php $this->load->view('tgl_indo') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">List Pegawai</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                      <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      </ul>
                  </div>
              </div>
              <div class="card-content collapse show">
                  <div class="card-body">
                  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message'); $this->session->unset_userdata('message');}?>
                      <div class="feather-icons overflow-hidden row">
                      <div class="table-responsive" style="padding-left: 10px; padding-right: 10px">
                      
                      <button class="btn btn-success" type="button" data-toggle="modal" data-target="#import"><i class="la la-upload"></i> Import</button>
                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".tambah-data"><i class="la la-plus"></i> Tambah</button><hr>
                      <div>
                                                <form style="width: 100%;" method="GET" action="<?= base_url('Admin/karyawan');?>">
                                                    <div class="input-group">
                                                        <input type="text" name="q" class="form-control" placeholder="Pencarian" aria-label="Search" aria-describedby="basic-addon2">
                                                        <input type="hidden" name="page" value="1">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="la la-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>          
                      <table class="table table-bordered" style="text-align: left;" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Institusi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                    $no=0;
                                    foreach($view as $v) { 
                                        $no++;
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $v->nip ?>
                                            </td>
                                            <td>
                                                <?= $v->nama ?>
                                            </td>
                                            <td>
                                                <?= $v->institusi ?>
                                            </td>
                                            </td>
                                            <td>
                                                <form style="display:inline-block;" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".edit<?=$no?>">
                                                <i class="la la-edit" style="color:white"></i>
                                                </button>
                                                </form>

                                                <form style="display:inline-block;" method="post" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?');" action="<?= base_url('Admin/delete_karyawan');?>">
                                                <input type='hidden' name="nip" value="<?= $v->nip ?>">
                                                <button type="Submit" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="la la-trash" style="color:white"></i>
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
<!-- MODAL EDIT -->
                                                    <div class="modal fade edit<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Edit Karyawan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" method="post" autocomplete="off" action="<?= base_url('Admin/update_karyawan');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <label>NIP</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="nip" class="form-control" value="<?= $v->nip ?>" readonly><br>
                                                                    <label>Nama</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="nama" class="form-control" value="<?= $v->nama ?>" required=""><br>
                                                                    <label>Tanggal Lahir</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $v->tgl_lahir ?>" required=""><br>
                                                                    <label>Pendidikan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="pendidikan" required>
                                                                            <option value="">Please Select</option>        
                                                                            <?php
                                                                            foreach ($pendidikan as $p) {
                                                                                ?>
                                                                                <option value="<?php echo $p->id; ?>"<?php echo ($v->pendidikan==$p->id) ? "selected='selected'" : "" ?>><?php echo $p->pendidikan; ?> </option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select><br>
                                                                    <label>Jenis Pekerjaan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="jenis_pekerjaan" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="Dosen"<?php echo ($v->jenis_pekerjaan=="Dosen") ? "selected='selected'" : "" ?>>Dosen</option>
                                                                            <option value="Tendik"<?php echo ($v->jenis_pekerjaan=="Tendik") ? "selected='selected'" : "" ?>>Tendik</option>
                                                                    </select><br>
                                                                    <label>Golongan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="golongan" class="form-control" value="<?= $v->golongan ?>" required=""><br>
                                                                    <label>Institusi Asal</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" id="unit" style="font-size: 1rem;" name="unit" required>
                                                                            <option value="">Please Select</option>        
                                                                            <?php foreach($unit as $u){ ?>
                                                                            <option value="<?= $u->username ?>"<?php echo ($v->institusi==$u->username) ? "selected='selected'" : "" ?>><?= $u->fakultas ?></option>
                                                                            <?php } ?>
                                                                            <!-- <option value="Other">Yang lain...</option> -->
                                                                    </select><br>
                                                                    <label>NPWP</label>
                                                                    <input type="text" name="npwp" value="<?= $v->npwp ?>" class="form-control"><br>
                                                                    <label>Status Bekerja</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="status_bekerja" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="Aktif Bekerja"<?php echo ($v->status_bekerja=="Aktif Bekerja") ? "selected='selected'" : "" ?>>Aktif Bekerja</option>
                                                                            <option value="Dipekerjakan"<?php echo ($v->status_bekerja=="Dosen") ? "selected='selected'" : "" ?>>Dipekerjakan</option>
                                                                            <option value="Cuti"<?php echo ($v->status_bekerja=="Cuti") ? "selected='selected'" : "" ?>>Cuti</option>
                                                                            <option value="Ijin Belajar"<?php echo ($v->status_bekerja=="Ijin Belajar") ? "selected='selected'" : "" ?>>Ijin Belajar</option>
                                                                            <option value="Tugas Belajar DN"<?php echo ($v->status_bekerja=="Tugas Belajar DN") ? "selected='selected'" : "" ?>>Tugas Belajar DN</option>
                                                                            <option value="Tugas Belajar LN"<?php echo ($v->status_bekerja=="Tugas Belajar LN") ? "selected='selected'" : "" ?>>Tugas Belajar LN</option>
                                                                            <option value="Masa Persiapan Pensiun (MPP)"<?php echo ($v->status_bekerja=="Masa Persiapan Pensiun (MPP)") ? "selected='selected'" : "" ?>>Masa Persiapan Pensiun (MPP)</option>
                                                                            <option value="Diberhentikan Sementara Sebagai PNS"<?php echo ($v->status_bekerja=="Diberhentikan Sementara Sebagai PNS") ? "selected='selected'" : "" ?>>Diberhentikan Sementara Sebagai PNS</option>
                                                                            <option value="Non Aktif"<?php echo ($v->status_bekerja=="Non Aktif") ? "selected='selected'" : "" ?>>Non Aktif</option>
                                                                    </select><br>
                                                                    <label>Status Kepegawaian</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="status_kepegawaian" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="PNS"<?php echo ($v->status_kepegawaian=="PNS") ? "selected='selected'" : "" ?>>PNS</option>
                                                                            <option value="CPNS"<?php echo ($v->status_kepegawaian=="CPNS") ? "selected='selected'" : "" ?>>CPNS</option>
                                                                            <option value="PU"<?php echo ($v->status_kepegawaian=="PU") ? "selected='selected'" : "" ?>>PU</option>
                                                                            <option value="CPU"<?php echo ($v->status_kepegawaian=="CPU") ? "selected='selected'" : "" ?>>CPU</option>
                                                                            <option value="Kontrak"<?php echo ($v->status_kepegawaian=="Kontrak") ? "selected='selected'" : "" ?>>Kontrak</option>
                                                                            <option value="Kontrak Penghargaan"<?php echo ($v->status_kepegawaian=="Kontrak Penghargaan") ? "selected='selected'" : "" ?>>Kontrak Penghargaan</option>
                                                                            <option value="Kontrak NIDK"<?php echo ($v->status_kepegawaian=="Kontrak NIDK") ? "selected='selected'" : "" ?>>Kontrak NIDK</option>
                                                                            <option value="Tenaga Profesional"<?php echo ($v->status_kepegawaian=="Tenaga Profesional") ? "selected='selected'" : "" ?>>Tenaga Profesional</option>
                                                                            <option value="Tenaga Luar Biasa"<?php echo ($v->status_kepegawaian=="Tenaga Luar Biasa") ? "selected='selected'" : "" ?>>Tenaga Luar Biasa</option>
                                                                    </select><br>
                                                                    <label>No. HP (WA)</label>
                                                                    <input type="text" name="no_hp" value="<?= $v->no_hp ?>" class="form-control"><br>
                                                                    <label>Email</label>
                                                                    <input type="email" name="email" value="<?= $v->email ?>" class="form-control"><br>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                                        
                      </div>
                      <div class="row">
                                            <div style="text-align:center; width:100%; padding:0;">
                                                <?php if ($previous == 0): ?>

                                                <?php else: 
                                                    $previous = $page-1?>
                                                <form style="display:inline-block;" method="get" action="<?= base_url('admin/karyawan');?>">
                                                <input type='hidden' name="q" value="<?= $cari ?>">
                                                <input type='hidden' name="page" value="<?= $previous ?>">
                                                <button type="Submit" class="btn btn-primary">
                                                <i class="la la-arrow-left"></i>
                                                </button>
                                                </form>
                                                <?php endif; ?>
                                                <button class="btn btn-primary" style="background:none; border:none"><span style="color: black; font-weight:bold"><?=$page?></span></button>
                                                <?php if ($next == 0): ?>
                                                    
                                                <?php else: 
                                                    $next = $page+1?>
                                                <form style="display:inline-block;" method="get" action="<?= base_url('admin/karyawan');?>">
                                                <input type='hidden' name="q" value="<?= $cari ?>">
                                                <input type='hidden' name="page" value="<?= $next ?>">
                                                <button type="Submit" class="btn btn-primary">
                                                <i class="la la-arrow-right"></i>
                                                </button>
                                                </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>          

<!-- MODAL TAMBAH -->
                                                    <script>
                                                        function checkUnit(select) {
                                                        var unit =  document.getElementById('unit');
                                                        var otherUnit = document.getElementById('otherUnit');
                                                        if (select.options[select.selectedIndex].value == "Other") {
                                                            otherUnit.style.display = 'block';
                                                            otherUnit.setAttribute("name", "unit");
                                                            otherUnit.setAttribute("required","");
                                                            unit.setAttribute("name", "");
                                                            unit.removeAttribute("required");
                                                        }
                                                        else {
                                                            otherUnit.style.display = 'none';
                                                            otherUnit.setAttribute("name", "");
                                                            otherUnit.removeAttribute("required");
                                                            unit.setAttribute("name", "unit");
                                                            unit.setAttribute("required","");
                                                        }
                                                        }
                                                    </script>
                                                    <div class="modal fade tambah-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Pegawai</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" method="post" action="<?= base_url('Admin/insert_karyawan');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <label>NIP</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="nip" class="form-control" required=""><br>
                                                                    <label>Nama</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="nama" class="form-control" required=""><br>
                                                                    <label>Tanggal Lahir</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" name="tgl_lahir" class="form-control" required=""><br>
                                                                    <label>Pendidikan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="pendidikan" required>
                                                                            <option value="">Please Select</option>        
                                                                            <?php foreach($pendidikan as $p){ ?>
                                                                            <option value="<?= $p->id ?>"><?= $p->pendidikan ?></option>
                                                                            <?php } ?>
                                                                    </select><br>
                                                                    <label>Jenis Pekerjaan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="jenis_pekerjaan" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="Dosen">Dosen</option>
                                                                            <option value="Tendik">Tendik</option>
                                                                    </select><br>
                                                                    <label>Golongan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="golongan" class="form-control" required=""><br>
                                                                    <label>Institusi Asal</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select onchange="checkUnit(this)" class="form-control" id="unit" style="font-size: 1rem;" name="unit" required>
                                                                            <option value="">Please Select</option>        
                                                                            <?php foreach($unit as $u){ ?>
                                                                            <option value="<?= $u->username ?>"><?= $u->fakultas ?></option>
                                                                            <?php } ?>
                                                                            <!-- <option value="Other">Yang lain...</option> -->
                                                                    </select><br>
                                                                    <input class="form-control" name='' id='otherUnit' placeholder="Isi di sini" style="display: none"/><br>
                                                                    <label>NPWP</label>
                                                                    <input type="text" name="npwp" class="form-control"><br>
                                                                    <label>Status Bekerja</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="status_bekerja" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="Aktif Bekerja">Aktif Bekerja</option>
                                                                            <option value="Dipekerjakan">Dipekerjakan</option>
                                                                            <option value="Cuti">Cuti</option>
                                                                            <option value="Ijin Belajar">Ijin Belajar</option>
                                                                            <option value="Tugas Belajar DN">Tugas Belajar DN</option>
                                                                            <option value="Tugas Belajar LN">Tugas Belajar LN</option>
                                                                            <option value="Masa Persiapan Pensiun (MPP)">Masa Persiapan Pensiun (MPP)</option>
                                                                            <option value="Diberhentikan Sementara Sebagai PNS">Diberhentikan Sementara Sebagai PNS</option>
                                                                            <option value="Non Aktif">Non Aktif</option>
                                                                    </select><br>
                                                                    <label>Status Kepegawaian</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="status_kepegawaian" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="PNS">PNS</option>
                                                                            <option value="CPNS">CPNS</option>
                                                                            <option value="PU">PU</option>
                                                                            <option value="CPU">CPU</option>
                                                                            <option value="Kontrak">Kontrak</option>
                                                                            <option value="Kontrak Penghargaan">Kontrak Penghargaan</option>
                                                                            <option value="Kontrak NIDK">Kontrak NIDK</option>
                                                                            <option value="Tenaga Profesional">Tenaga Profesional</option>
                                                                            <option value="Tenaga Luar Biasa">Tenaga Luar Biasa</option>
                                                                    </select><br>
                                                                    <label>No. HP (WA)</label>
                                                                    <input type="text" name="no_hp" class="form-control"><br>
                                                                    <label>Email</label>
                                                                    <input type="email" name="email" class="form-control"><br>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Import -->
                                                    <div class="modal fade import" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title h4" id="myLargeModalLabel">Import Data Pegawai</h5>
                                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <form role="form" method="post" action="<?= base_url('admin/import');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <h4>Import File CSV</h4>
                                                                    <span style="color: red;">Sebelum mengupload file csv, mohon untuk disesuaikan dengan <a href="<?=base_url('assets/template/temp.xlsx')?>">format terlebih dahulu</a> (perhatikan kode pendidikan dan kode unit dalam template) kemudian save dengan format <b>.csv</b></span>
                                                                    <hr>
                                                                    <label>File Csv</label><br>
                                                                    <input type="file" accept=".csv" name="file"><br>
                                                                    <label style="color:red; font-size:12px;">.csv maks 8mb</label><br>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
<!-- <script type="text/javascript">
 
 var table;
  
 $(document).ready(function() {
  
     //datatables
     table = $('#dt').DataTable({ 
  
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [], //Initial no order.
  
         // Load data for the table's content from an Ajax source
         "ajax": {
             "url": "<?php echo site_url('Admin/pegawai_list')?>",
             "type": "POST"
         },
  
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
             "targets": [ 0 ], //first column / numbering column
             "orderable": false, //set not orderable
         },
         ],
  
     });
  
 });
 </script> -->