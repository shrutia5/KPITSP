<!-- Vendor JS Files -->
  <script src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/typeahead/typeahead.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>assets/chariot/chariot.js"></script>

  <?php 
  if(isset($infoGuidedData) && !empty($infoGuidedData)) {
    if($infoGuidedData[0]->std_dashboard == 'N' ) { 
      if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'dashboard') { ?>
        <script src="<?php echo base_url();?>assets/chariot/dashboard-guide-data.js"></script>
  <?php } } } ?>

  <?php 
  if(isset($infoGuidedData) && !empty($infoGuidedData)) {
    if($infoGuidedData[0]->std_submitidea == 'N' ) { 
      if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'submit-idea') { ?>
        <script src="<?php echo base_url();?>assets/chariot/submitidea-guide-data.js"></script>
  <?php } } } ?>

  <?php 
  if(isset($infoGuidedData) && !empty($infoGuidedData)) {
    if($infoGuidedData[0]->std_myaccount == 'N' ) { 
      if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'myaccount') { ?>
        <script src="<?php echo base_url();?>assets/chariot/profile-guide-data.js"></script>
  <?php } } } ?>

  <?php 
  if(isset($infoGuidedData) && !empty($infoGuidedData)) {
    if($infoGuidedData[0]->std_project == 'N' ) { 
      if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'project') { ?>
        <script src="<?php echo base_url();?>assets/chariot/project-guide-data.js"></script>
  <?php } } } ?>

  <script src="<?php echo base_url();?>assets/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url();?>assets/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url();?>assets/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url();?>assets/jquery.validate/jquery.validate.js"></script>
  <script src="<?php echo base_url();?>assets/realTimeUpload/js/RealTimeUpload.js"></script>
  <script src="<?php echo base_url();?>assets/aos/aos.js"></script>
  <script src="<?php echo base_url();?>assets/paroller/dist/jquery.paroller.min.js"></script> 
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Template Main JS File -->
  <script src="<?php echo base_url();?>assets/alertifyjs/alertify.min.js"></script>
  <script src="<?php echo base_url();?>js/validateRule.js"></script>
  <script src="<?php echo base_url();?>assets/slim/js/slim.jquery.min.js" type="text/javascript"></script> 
 <!-- <script src="<?php echo $this->config->item('live_base_url');?>assets/js/slim.kickstart.min.js"></script> -->