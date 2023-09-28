<?php $this->load->view('tgl_indo') ?>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Jadwal</h4>
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
                                            <th>Keterangan</th>
                                            <th>Periode</th>
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
                                    foreach($jadwal as $v) { 
                                        $tgl_mulai = tgl_indo($v->tgl_mulai);
                                        $tgl_akhir = tgl_indo($v->tgl_akhir);
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $v->keterangan ?></td>
                                            <td><?= $tgl_mulai ?> - <?= $tgl_akhir ?></td>
                                            <td>
                                                <form style="display:inline-block;" data-toggle="tooltip" data-placement="bottom" title="Edit Jadwal">
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".edit<?=$v->id?>">
                                                <i class="la la-edit" style="color:white"></i>
                                                </button>
                                                </form>

                                                <form style="display:inline-block;" method="post" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?');" action="<?= base_url('Admin/delete_jadwal');?>">
                                                <input type='hidden' name="id" value="<?= $v->id ?>">
                                                <button type="Submit" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Jadwal">
                                                <i class="la la-trash" style="color:white"></i>
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- MODAL EDIT -->
                                                    <div class="modal fade edit<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Edit Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" method="post" action="<?= base_url('Admin/update_jadwal');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <input type="hidden" name="id" value="<?=$v->id?>">
                                                                    <h2>Periode Jadwal</h2>
                                                                    <label>Tanggal Mulai</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" name="tgl_mulai" class="form-control" value="<?=$v->tgl_mulai?>" required=""><br>
                                                                    <label>Tanggal Akhir</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" name="tgl_akhir" class="form-control" value="<?=$v->tgl_akhir?>" required="">
                                                                    <hr>
                                                                    <h2>Keterangan Jadwal</h2>
                                                                    <label>Keterangan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input name="keterangan" class="form-control" value="<?=$v->keterangan?>" required="">
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
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- modal tambah data -->
                                                    <div class="modal fade tambah-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Jadwal</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" method="post" action="<?= base_url('Admin/add_jadwal');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <h2>Periode Jadwal</h2>
                                                                    <label>Tanggal Mulai</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" name="tgl_mulai" class="form-control" value="" required=""><br>
                                                                    <label>Tanggal Akhir</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input type="date" name="tgl_akhir" class="form-control" value="" required="">
                                                                    <hr>
                                                                    <h2>Keterangan Jadwal</h2>
                                                                    <label>Keterangan</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input name="keterangan" class="form-control" value="" required="">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    