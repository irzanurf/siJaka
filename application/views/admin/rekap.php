<?php $this->load->view('tgl_indo') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<section id="line-awesome-icons">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Rekap</h4>
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
                                                <a class="nav-link" href="<?=base_url("Admin/assign_karyawan?jadwal=$jadwal")?>" role="tab" aria-controls="pills-penugasan" aria-selected="false">Penugasan</a>
                                            </li>
                                            <li class="nav-item col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <a class="nav-link active" href="#" role="tab" aria-controls="pills-rekap" aria-selected="false">Rekap</a>
                                            </li>
                                        </ul>
                                    </div><br>
                
                  <div class="card-body">
                  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message'); $this->session->unset_userdata('message');}?>
                                    
                    
                      <div class="feather-icons overflow-hidden row">
                      <?php for($i=0, $count = count($view);$i<$count;$i++) {
    ?>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header" style="<?php if($i % 4==0): echo 'background-color: #a940d5'; elseif($i % 4==1): echo 'background-color: #63d457'; elseif($i % 4==2): echo 'background-color: #1976d2'; else: echo 'background-color: #D63E6C'; endif; ?>">
                    <h4 class="card-title" style="color: white;"><?= $view[$i]['unit'] ?></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3" style="color: white;"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus" style="color: white;"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw" style="color: white;"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize" style="color: white;"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body" style="background-color: #f1f1f1 ;"> 
                                        <div class="form-row">
                                                
                                                <div class="col-12 text-center">
                                                    <?php foreach($view[$i]['dat'] as $dat) { ?>
                                                    <h3><?= $dat->jabatan ?> = <?= $dat->jumlah ?></h3><br>
                                                    <?php } ?>
                                                </div>
                                                
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>         

                                                    
                                                                                                          