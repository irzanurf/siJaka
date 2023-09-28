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
                      <div>
                                                <form style="width: 100%;" method="GET" action="<?= base_url('Unit/karyawan');?>">
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
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jenis Pegawai</th>
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
                                            <td width="1%" align="center"><?= $no++ ?></td>
                                            <td>
                                                <?= $v->nip ?>
                                            </td>
                                            <td>
                                                <?= $v->nama ?>
                                            </td>
                                            <td>
                                                <?= $v->jenis_pekerjaan ?>
                                            </td>
                                            <td>
                                                <span style="color: #800000">Admin Permission</span>
                                            </td>
                                        </tr>
<!-- MODAL EDIT -->
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
                                                <form style="display:inline-block;" method="get" action="<?= base_url('Unit/karyawan');?>">
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
                                                <form style="display:inline-block;" method="get" action="<?= base_url('Unit/karyawan');?>">
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