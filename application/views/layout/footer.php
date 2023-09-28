    <!-- BEGIN VENDOR JS-->
    <script src="<?= base_url('assets/main/vendors/js/vendors.min.js');?>" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?= base_url('assets/main/vendors/js/charts/chartist.min.js');?>" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?= base_url('assets/main/js/core/app-menu-lite.js');?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/main/js/core/app-lite.js');?>" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?= base_url('assets/main/js/scripts/pages/dashboard-lite.js');?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
  </body>
</html>

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
    } );
    
    </script>

    <script>
      $(document).ready(function() {
  $(".select2").select2({
    width: '100%',}
  );
});
    </script>
