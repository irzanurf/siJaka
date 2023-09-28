<?php $this->load->view('tgl_indo') ?>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Unit</h4>
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
                                            <th>Username</th>
                                            <th>Unit</th>
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
                                        ?>
                                        <tr>
                                            <td><?= $v->username ?></td>
                                            <td><?= $v->fakultas ?></td>
                                            <td>
                                                <form style="display:inline-block;" method="post" action="<?= base_url('Admin/passakun');?>" data-toggle="tooltip" data-placement="bottom" title="Akun">
                                                <input type='hidden' name="id" value="<?= $v->username ?>">
                                                <button class="btn btn-primary" type="submit">
                                                <i class="la la-lock" style="color:white"></i>
                                                </button>
                                                </form>

                                                <form style="display:inline-block;" method="post" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?');" action="<?= base_url('Admin/delete_unit');?>">
                                                <input type='hidden' name="id" value="<?= $v->username ?>">
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
                                                    <div class="modal fade tambah-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Unit</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form role="form" method="post" action="<?= base_url('Admin/tambah_unit');?>" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <label>Username</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input name="username" class="form-control" value="" required=""><br>
                                                                    <label>Nama</label><label style="color:red; font-size:12px;"> (*Wajib diisi)</label>
                                                                    <input name="nama" class="form-control" value="" required="">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    