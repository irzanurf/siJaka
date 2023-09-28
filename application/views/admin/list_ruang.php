<section>
<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header" style="background-color:#8D8C8C">
                    <h4 class="card-title" style="color: white;">Fakultas 1</h4>
                        
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
                    <div class="card-body">
                                        <div class="form-row">
                                                
                                                <div class="col-12 text-center">
                                                    <img width="80%" src="<?= base_url('assets/fakultas/undip.jpg') ?>"><br>
                                                    <h3 style="margin-top: 10px;">Semua Fakultas</h3><hr>
                                                    <form action="<?= base_url('admin/all_list_penjadwalan');?>">
                                                    <input type='hidden' name="jadwal" value="<?= $jadwal ?>">
                                                    <button type="Submit" class="btn btn-primary">Pilih
                                                    </button>
                                                    </form>
                                                </div>
                                                
                                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php for($i=0, $count = count($view);$i<$count;$i++) {
    ?>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header" style="<?php if($i % 4==0): echo 'background-color: #a940d5'; elseif($i % 4==1): echo 'background-color: #63d457'; elseif($i % 4==2): echo 'background-color: #1976d2'; else: echo 'background-color: #D63E6C'; endif; ?>">
                    <h4 class="card-title" style="color: white;">Fakultas <?= $i+2 ?></h4>
                        
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
                    <div class="card-body">
                                        <div class="form-row">
                                                
                                                <div class="col-12 text-center">
                                                    <img width="80%" src="<?= base_url('assets/fakultas/'.$view[$i]->image) ?>"><br>
                                                    <h3 style="margin-top: 10px;"><?= $view[$i]->fakultas ?></h3><hr>
                                                    <form method="get" action="<?= base_url('admin/list_penjadwalan');?>">
                                                    <input type='hidden' name="jadwal" value="<?= $jadwal ?>">
                                                    <input type='hidden' name="unit" value="<?= $view[$i]->id ?>">
                                                    <button type="Submit" class="btn btn-primary">Pilih
                                                    </button>
                                                    </form>
                                                </div>
                                                
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
        <!-- <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header" style="background-color:#8D8C8C">
                    <h4 class="card-title" style="color: white;">Other</h4>
                        
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
                    <div class="card-body">
                                        <div class="form-row">
                                                
                                                <div class="col-12 text-center">
                                                    <img width="80%" src="<?= base_url('assets/fakultas/other.jpg') ?>"><br>
                                                    <h3 style="margin-top: 10px;">Other</h3><hr>
                                                    <form action="<?= base_url('admin/list_penjadwalan');?>">
                                                    <input type='hidden' name="jadwal" value="<?= $jadwal ?>">
                                                    <input type='hidden' name="unit" value="14">
                                                    <button type="Submit" class="btn btn-primary">Pilih
                                                    </button>
                                                    </form>
                                                </div>
                                                
                                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</div>
</section>
                                                    