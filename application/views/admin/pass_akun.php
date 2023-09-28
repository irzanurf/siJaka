<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0"></h3>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab"
                                        role="tab">Akun</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="col-8" style="float:none;margin:auto;">
                                    <?= form_open_multipart('Admin/changePass');?>
                                    
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" name="username" value="<?= $akun->username ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input class="form-control" name="nama" value="<?= $akun->fakultas ?>" disabled>
                                        </div>
                                    
                                        <h3>Ganti Password</h3>
                                        <input type="hidden" class="form-control" name="url" value="akunmhs">
                                        <div class="form-group"><label>Password Baru</label><input class="form-control" type="password" name="pass" id="txtPassword"  ></div>
                                        <div class="form-group"><label>Ulangi Password</label><input class="form-control" type="password" name="re" id="txtConfirmPassword"  ></div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="username" value="<?= $akun->username ?>">
                                        </div>
                                        <div class="form-group">
                                            <button id="btnSubmit" type="submit" class="btn btn-success" onclick="return Validate()">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function Validate() {
                    var password = document.getElementById("txtPassword").value;
                    var confirmPassword = document.getElementById("txtConfirmPassword").value;
                    if (password != confirmPassword) {
                        alert("Passwords do not match.");
                        return false;
                    }
                    return true;
                }
            </script>