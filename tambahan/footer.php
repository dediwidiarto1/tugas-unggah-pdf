<!-- jQuery -->
    <script src="modul/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="modul/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->

    <!-- NProgress -->
    <script src="modul/vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="modul/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="modul/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="modul/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    

    <!-- Custom Theme Scripts -->
    <script src="modul/build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });
        $('#datatable-responsive').DataTable();
        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->