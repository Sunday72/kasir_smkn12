</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-body text-center">
        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
        <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
        <button type="button" class="btn btn-secondary px-4 mr-2" data-bs-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-primary px-4">Keluar</a>
      </div>
    </div>
  </div>
  <!-- end Modal Exit -->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
  <script src="assets/vendor/jquery-2.2.4.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/vendor/plugins.js"></script>
  <script src="assets/vendor/scripts.js"></script>
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
  <script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
  <script src="assets/js/sidebar.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable();
    });
    $('#cart').dataTable({
      searching: false,
      paging: false,
      info: false
    });
  </script>
  </body>

  </html>