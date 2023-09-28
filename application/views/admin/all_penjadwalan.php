<?php $this->load->view('tgl_indo') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Penjadwalan</h4>
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
                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".tambah-data"><i class="la la-plus"></i> Tambah</button>
                                <table class="table table-bordered" style="text-align: left;" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Karyawan</th>
                                            <th>Lokasi</th>
                                            <th>Jadwal</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                    $no=1;
                                    foreach($view as $v) { 
                                        $tgl = tgl_indo($v->tgl);
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <b>NIP</b><br>
                                                <?= $v->nip ?><br><br>
                                                <b>Nama</b><br>
                                                <?= $v->nama ?>
                                            </td>
                                            <td>
                                                <b>Fakultas/Unit</b><br>
                                                <?= $v->unit ?><br><br>
                                                <b>Ruang</b><br>
                                                <?= $v->ruang ?>
                                            </td>
                                            <td>
                                                <b>Tanggal</b><br>
                                                <?= $tgl ?><br><br>
                                                <b>Waktu</b><br>
                                                <?= $v->time_mulai ?> - <?= $v->time_akhir ?>
                                            </td>
                                            <td>
                                                <b>Jabatan</b><br>
                                                <?=$v->jabatan?><br><br>
                                                <b>Keterangan</b><br>
                                                <?=$v->keterangan?>
                                            </td>
                                            <td>
                                                <form style="display:inline-block;" method="post" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?');" action="<?= base_url('Admin/delete_penjadwalan');?>">
                                                <input type='hidden' name="id" value="<?= $v->id ?>">
                                                <input type="hidden" name="link" class="form-control" value="<?=$link?>">
                                                <button type="Submit" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="la la-trash" style="color:white"></i>
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
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
                                                        function checkKaryawan(select) {
                                                        var karyawan =  document.getElementById('karyawan');
                                                        var otherKaryawan = document.getElementById('otherKaryawan');
                                                        if (select.options[select.selectedIndex].value == "Other") {
                                                            otherKaryawan.style.display = 'block';
                                                            otherKaryawan.setAttribute("name", "nip");
                                                            otherKaryawan.setAttribute("required","");
                                                            karyawan.setAttribute("name", "");
                                                            karyawan.removeAttribute("required");
                                                            $(document).ready(function() {
                                                            $(".select3").select2({
                                                                width: '100%'}
                                                            );
                                                            });
                                                        }
                                                        else {
                                                            otherKaryawan.style.display = 'none';
                                                            otherKaryawan.setAttribute("name", "");
                                                            otherKaryawan.removeAttribute("required");
                                                            karyawan.setAttribute("name", "nip");
                                                            karyawan.setAttribute("required","");
                                                            $(document).ready(function() {
                                                            $(".select3").select2('destroy');
                                                            });
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
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Penjadwalan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" autocomplete="off" method="post" action="<?= base_url('Admin/insert_penjadwalan');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <label>Jadwal</label>
                                                                    <input type="hidden" name="jadwal" class="form-control" value="<?=$jadwal->id?>" readonly>
                                                                    <input type="hidden" name="link" class="form-control" value="<?=$link?>" readonly>
                                                                    <input type="text" class="form-control" value="<?=$jadwal->keterangan?>" readonly><br>
                                                                    <label>Unit/Fakultas</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select onchange="checkUnit(this)" class="form-control" id="unit" style="font-size: 1rem;" name="unit" required>
                                                                            <option value="">Please Select</option>        
                                                                    <?php foreach($unit as $u){ ?>
                                                                            <option value="<?= $u->fakultas ?>"><?= $u->fakultas ?></option>
                                                                            <?php } ?>
                                                                            <option value="Other">Yang lain...</option>
                                                                    </select>
                                                                    <input class="form-control" name='' id='otherUnit' placeholder="Isi di sini" style="display: none"/><br>
                                                                    <label>Ruang</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="text" name="ruang" list="list-ruang" class="form-control" required><br>
                                                                        <datalist id="list-ruang">
                                                                        </datalist>
                                                                    <label>Karyawan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                        <select onchange="checkKaryawan(this)" class="select2" id='karyawan' style="font-size: 1rem; line-height: 1.25;" name="nip" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="Other">Yang lain...</option>
                                                                            <?php foreach($karyawan as $k){ ?>
                                                                            <option value="<?= $k->nip ?>">[<?= $k->total ?>] <?= $k->nama ?> (<?= $k->umur ?> - <?= $k->pendidikan ?> - <?= $k->institusi ?>)</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <select class="select3" id='otherKaryawan' style="font-size: 1rem; line-height: 1.25; display: none" name="">
                                                                            <option value="">Please Select</option>
                                                                            <?php foreach($all as $a){ ?>
                                                                            <option value="<?= $a->nip ?>">[<?= $a->total ?>] <?= $a->nama ?> (<?= $a->umur ?> - <?= $a->pendidikan ?> - <?= $a->institusi ?>)</option>
                                                                            <?php } ?>
                                                                        </select><br><br>
                                                                    <label>Jabatan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <select onchange="checkJabatan(this)" class="form-control" id="jabatan" style="font-size: 1rem;" name="jabatan" required>
                                                                            <option value="">Please Select</option>
                                                                            <option value="Penanggung Jawab Lokasi">Penanggung Jawab Lokasi</option>
                                                                            <option value="Wakil Penanggung Jawab Lokasi">Wakil Penanggung Jawab Lokasi</option>
                                                                            <option value="Pengawas">Pengawas</option>
                                                                            <option value="Cadwas">Cadwas</option>
                                                                            <option value="Teknisi Ruang">Teknisi Ruang</option>
                                                                            <option value="Petugas Listrik">Petugas Listrik</option>
                                                                            <option value="Petugas Tempat / Kebersihan">Petugas Tempat / Kebersihan</option>
                                                                            <option value="Petugas Keamanan">Petugas Keamanan</option>
                                                                            <option value="Petugas Termogun">Petugas Termogun</option>
                                                                            <option value="Petugas Parkir">Petugas Parkir</option>
                                                                            <option value="Other">Yang lain...</option>
                                                                    </select>
                                                                    <input class="form-control" name='' id='otherJabatan' placeholder="Isi di sini" style="display: none"/><br> 
                                                                    <label>Tanggal Pelaksanaan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" min="<?= $jadwal->tgl_mulai ?>" max="<?= $jadwal->tgl_akhir ?>" name="tgl" class="form-control" required><br>
                                                                    <label>Waktu</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <div class="input-group">
                                                                        <input type="time" class="form-control" name="time_mulai" required>
                                                                        <input type="text" style="text-align:center; border:none" name="nomor2" value="s / d" size="5" readonly>
                                                                        <input type="time" class="form-control" name="time_akhir" required>
                                                                    </div><br>
                                                                    <label>Keterangan</label>
                                                                    <input type="text" name="ket" class="form-control"><br>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script type="text/javascript"> 
                                                                                $(document).ready(function(){
                                                                                    $("#unit").change(function(){
                                                                                    $("#list-ruang").empty();
                                                                                    var unit = $("#unit").val();
                                                                                    if(unit != ''){
                                                                                    $.ajax({
                                                                                        url:"<?= base_url('admin/get_ruang');?>",
                                                                                        method:"POST",
                                                                                        data:{unit:unit},
                                                                                        dataType: 'json',
                                                                                        success:function(data){
                                                                                            var jum = (data["ruang"].length);
                                                                                            var i;
                                                                                            for (i = 0; i < jum; ++i) {
                                                                                                // do something with `substr[i]`
                                                                                                var hasil = data["ruang"][i]["ruang"];
                                                                                                $('#list-ruang').append($('<option>', { 
                                                                                                    value: hasil
                                                                                                }));
                                                                                            }
                                                                                        }
                                                                                    });
                                                                                }
                                                                                    });
                                                                                    });
                                                                            </script>  