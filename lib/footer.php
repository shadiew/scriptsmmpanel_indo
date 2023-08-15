 <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by <a href="https://wa.me/6282221584446" target="_blank" class="fw-medium"><?php echo $config['web']['title'] ?></a>
                  </div>
                  
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?php echo $config['web']['base_url'] ?>/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>


    <!-- Main JS -->
    <script src="<?php echo $config['web']['base_url'] ?>/assets/js/main.js"></script>
    <!-- Page JS -->
    <script src="<?php echo $config['web']['base_url'] ?>/assets/js/dashboards-ecommerce.js"></script>
     <script src="<?php echo $config['web']['base_url'] ?>/assets/js/tables-datatables-basic.js"></script>
     <script>
    $(document).ready(function() {
      // Initialize DataTable
      $('#myDataTable').DataTable({
        // Add any additional configuration options here
      });
    });
  </script>
  </body>
</html>
