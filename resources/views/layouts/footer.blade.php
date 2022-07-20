        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-center">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Moba @<?php echo date("Y"); ?></span>
          </div>
        </footer>
        </div>
      <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   
    <script src="<?php echo URL::to('assets\js\vendor.bundle.base.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo URL::to('assets\js\select2.min.js'); ?>"></script> 
    
    <script src="<?php echo URL::to('assets\js\select2.js'); ?>"></script> 
    
    <script src="<?php echo URL::to('assets\js\off-canvas.js'); ?>"></script>
    <script src="<?php echo URL::to('assets\js\hoverable-collapse.js'); ?>"></script>
    <script src="<?php echo URL::to('assets\js\misc.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo URL::to('assets\js\todolist.js'); ?>"></script>
    <script src="<?php echo URL::to('assets\js\dashboard.js'); ?>"></script>
    <script src="<?php echo URL::to('assets\js\toastr.min.js'); ?>"></script>
    <script src="<?php echo URL::to('assets\js\jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo URL::to('assets\js\sweetalert2.min.js'); ?>"></script> 
    <script src="<?php echo URL::to('assets\js\sweetalert2.min.js'); ?>"></script> 
      
     {!! Toastr::message() !!}
  </body>
</html>