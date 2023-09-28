<?php $this->load->view('tgl_indo') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Assign Petugas</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                      <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      </ul>
                  </div>
              </div>
              <div class="card-content collapse show">
              <div style="text-align: center">
                                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                                            <li class="nav-item col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <a class="nav-link active" href="#" role="tab" aria-controls="pills-penugasan" aria-selected="false">Penugasan</a>
                                            </li>
                                            <li class="nav-item col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <a class="nav-link" href="<?=base_url("unit/rekap?jadwal=$jadwal->id")?>" role="tab" aria-controls="pills-rekap" aria-selected="false">Rekap</a>
                                            </li>
                                        </ul>
                                    </div><br>
                
                  <div class="card-body">
                  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message'); $this->session->unset_userdata('message');}?>
                                    
                    
                      <div class="feather-icons overflow-hidden row">
                      <div class="table-responsive" style="padding-left: 10px; padding-right: 10px">
                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".tambah-data"><i class="la la-plus"></i> Tambah Petugas Eksternal</button>
                      <!-- <form style="display:inline-block;" method="post" action="<?= base_url('Unit/export');?>">
                        <input type="hidden" name="jadwal" class="form-control" value="<?=$jadwal->id?>" readonly>
                        <button type="Submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Export">
                        <i class="la la-download" style="color:white"></i> Export
                        </button>
                      </form>           -->
                      <div>
                                                <hr><form style="width: 100%;" method="GET" action="<?= base_url('Unit/assign_karyawan');?>">
                                                    <div class="input-group">
                                                        <input type="text" name="q" class="form-control" placeholder="Pencarian" aria-label="Search" aria-describedby="basic-addon2">
                                                        <input type="hidden" name="page" value="1">
                                                        <input type='hidden' name="jadwal" value="<?= $jadwal->id ?>">
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
                                            <th>Umur</th>
                                            <th>Golongan</th>
                                            <th>Jenis Pegawai</th>
                                            <th>Pendidikan</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                    $no = 0;
                                    foreach($karyawan as $v) {
                                        $no++;
                                        if (($v->tgl_lahir)==0 || ($v->tgl_lahir)=='0000-00-00'){
                                            $umur = "-";
                                            $tahun = "-";
                                        }
                                        else {
                                            $umur = hitung_umur($v->tgl_lahir);
                                            $tahun = tahun($v->tgl_lahir);
                                        }
                                        // if ($tahun >= 50){
                                        //     continue;
                                        // }
                                        ?>
                                        
                                        <script type="text/javascript"> 
                                            $(document).ready(function(){
                                                $("#jabatan<?=$no?>").change(function(){
                                                var jab = $("#jabatan<?=$no?>").val();
                                                var id = $("#nip<?=$no?>").val();
                                                var jadwal = $("#jadwal").val();
                                                console.log(id)
                                                console.log(jab)
                                                console.log(jadwal)
                                                if(id != ''){
                                                $.ajax({
                                                    url:"<?= base_url('unit/updateJabatan');?>",
                                                    method:"POST",
                                                    data:{id:id, jabatan:jab, jadwal:jadwal},
                                                    dataType: 'json',
                                                    success:function(data){
                                                        console.log("success")
                                                    }
                                                });
                                            }
                                                });
                                                });
                                        </script>
                                        <tr>
                                            <input type="hidden" id="nip<?=$no?>" value="<?=$v->nip?>">
                                            <input type="hidden" id="jadwal" value="<?=$jadwal->id?>">
                                            <td>
                                                <?=$v->nip?>
                                            </td>
                                            <td>
                                                <?=$v->nama?>
                                            </td>
                                            <td>
                                                <?=$umur?>
                                            </td>
                                            <td>
                                                <?=$v->golongan?>
                                            </td>
                                            <td>
                                                <?=$v->jenis_pekerjaan?>
                                            </td>
                                            <td>
                                                <?=$v->pendidikan?>
                                            </td>
                                            <td width="30%">
                                                <select class="form-control" id="jabatan<?=$no?>">
                                                <option value="0">-</option>
                                                    <?php
                                                    if(($v->jenis_pekerjaan)!="Eksternal"){
                                                        foreach ($jabatan as $j) {
                                                            ?>
                                                            <option value="<?php echo $j->id; ?>" <?php if($v->id_jabatan==$j->id) echo 'selected="selected"'; ?>><?php echo $j->jabatan; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    else{
                                                        foreach ($new_jabatan as $j) {
                                                            ?>
                                                            <option value="<?php echo $j->id; ?>" <?php if($v->id_jabatan==$j->id) echo 'selected="selected"'; ?>><?php echo $j->jabatan; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
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
                                                <form style="display:inline-block;" method="get" action="<?= base_url('Unit/assign_karyawan');?>">
                                                <input type='hidden' name="q" value="<?= $cari ?>">
                                                <input type='hidden' name="page" value="<?= $previous ?>">
                                                <input type='hidden' name="jadwal" value="<?= $jadwal->id ?>">
                                                <button type="Submit" class="btn btn-primary">
                                                <i class="la la-arrow-left"></i>
                                                </button>
                                                </form>
                                                <?php endif; ?>
                                                <button class="btn btn-primary" style="background:none; border:none"><span style="color: black; font-weight:bold"><?=$page?></span></button>
                                                <?php if ($next == 0): ?>
                                                    
                                                <?php else: 
                                                    $next = $page+1?>
                                                <form style="display:inline-block;" method="get" action="<?= base_url('Unit/assign_karyawan');?>">
                                                <input type='hidden' name="q" value="<?= $cari ?>">
                                                <input type='hidden' name="page" value="<?= $next ?>">
                                                <input type='hidden' name="jadwal" value="<?= $jadwal->id ?>">
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
<!-- modal tambah data -->
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
                                                    <script>
                                                        function checkJabatan(select) {
                                                        var jabatan =  document.getElementById('jabatan');
                                                        var otherJabatan = document.getElementById('otherJabatan');
                                                        if (select.options[select.selectedIndex].value == "Other") {
                                                            otherJabatan.style.display = 'block';
                                                            otherJabatan.setAttribute("name", "jabatan");
                                                            otherJabatan.setAttribute("required","");
                                                            jabatan.setAttribute("name", "");
                                                            jabatan.removeAttribute("required");
                                                        }
                                                        else {
                                                            otherJabatan.style.display = 'none';
                                                            otherJabatan.setAttribute("name", "");
                                                            otherJabatan.removeAttribute("required");
                                                            jabatan.setAttribute("name", "jabatan");
                                                            jabatan.setAttribute("required","");
                                                        }
                                                        }
                                                    </script>
                                                    <div class="modal fade tambah-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Assign Petugas Eksternal</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" autocomplete="off" method="post" action="<?= base_url('Unit/tambah_assign_karyawan');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <label>Jadwal</label>
                                                                    <input type="hidden" name="jadwal" class="form-control" value="<?=$jadwal->id?>" readonly>
                                                                    <input type="hidden" name="link" class="form-control" value="<?=$link?>" readonly>
                                                                    <input type="text" class="form-control" value="<?=$jadwal->keterangan?>" readonly><br>
                                                                    <label>Unit/Fakultas</label>
                                                                    <input name="unit" class="form-control" value="<?=$unit->fakultas?>" readonly/><br>
                                                                    <label>NIK</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input name="nik" class="form-control" required/><br>
                                                                    <label>Nama</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input name="nama" class="form-control" required/><br>
                                                                    <label>Tanggal Lahir</label>
                                                                    <input name="tgl_lahir" type="date" class="form-control"/><br>
                                                                    <label>Pendidikan</label>
                                                                    <select class="form-control" style="font-size: 1rem;" name="pendidikan">
                                                                            <option value="">Please Select</option>        
                                                                            <?php foreach($pendidikan as $p){ ?>
                                                                            <option value="<?= $p->id ?>"><?= $p->pendidikan ?></option>
                                                                            <?php } ?>
                                                                    </select><br>
                                                                    <div class="form-group">
                                                                        <label>Jabatan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                            <select class="form-control" id='jabatan' style="font-size: 1rem; line-height: 1.25;" name="jabatan" required>
                                                                                <option value="">Please Select</option>
                                                                                <?php
                                                                                    foreach ($new_jabatan as $j) {
                                                                                        ?>
                                                                                        <option value="<?php echo $j->id; ?>"><?php echo $j->jabatan; ?></option>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                    </div>
                                                                    <label>NPWP</label>
                                                                    <input name="npwp" class="form-control"/><br>
                                                                    <label>No. HP</label>
                                                                    <input name="no_hp" class="form-control"/><br>
                                                                    <label>Email</label>
                                                                    <input type="email" name="email" class="form-control"><br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menambahkan Petugas Eksternal?');" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                                                                          