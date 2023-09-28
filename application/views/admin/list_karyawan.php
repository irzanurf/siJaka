<?php $this->load->view('tgl_indo') ?>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">List Karyawan</h4>
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
                                <table class="table table-bordered" style="text-align: left;" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Identitas</th>
                                            <th>Informasi</th>
                                            <th>Detail</th>
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
                                        $tgl_lahir = tgl_indo($v->tgl_lahir);
                                        ?>
                                        <tr>
                                            <td width="1%" align="center"><?= $no++ ?></td>
                                            <td>
                                                <b>NIP</b><br>
                                                <?= $v->nip ?><br><br>
                                                <b>Nama</b><br>
                                                <?= $v->nama ?><br><br>
                                                <b>Umur</b><br>
                                                <?= $v->umur ?> tahun<br><br>
                                                <b>Tanggal Lahir</b><br>
                                                <?= $tgl_lahir ?>
                                            </td>
                                            <td>
                                                <b>Total Penjadwalan</b><br>
                                                <?= $v->total ?><br><br>
                                                <b>Institusi Asal</b><br>
                                                <?= $v->institusi ?><br><br>
                                                <b>No. Hp (WA)</b><br>
                                                <?= $v->no_hp ?><br><br>
                                                <b>Email</b><br>
                                                <?= $v->email ?>
                                            </td>
                                            <td>
                                                <b>Pendidikan</b><br>
                                                <?= $v->pendidikan ?><br><br>
                                                <b>Jenis Pekerjaan</b><br>
                                                <?= $v->jenis_pekerjaan ?><br><br>
                                                <b>Golongan</b><br>
                                                <?= $v->golongan ?><br><br>
                                                <b>NPWP</b><br>
                                                <?= $v->npwp ?><br><br>
                                            </td>
                                            <td width="1%">
                                                <form method="get" action="<?= base_url('admin/list_karyawan_penjadwalan') ?>" style="display:inline-block;" data-toggle="tooltip" data-placement="bottom" title="Penjadwalan">
                                                <input type="hidden" name="jadwal" value="<?= $jadwal ?>">
                                                <input type="hidden" name="nip" value="<?= $v->nip ?>">
                                                <input type="hidden" name="nama" value="<?= $v->nama ?>">
                                                <button class="btn btn-info" type="submit">
                                                <i class="la la-edit" style="color:white"></i> Penjadwalan
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