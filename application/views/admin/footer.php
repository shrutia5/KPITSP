
  <!-- Vendor JS Files -->
  <?php $this->load->view("commonScripts");?>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url();?>js/student/common.js"></script>
  <script src="<?php echo base_url();?>js/student/submitIdea.js"></script>
  <script src="<?php echo base_url();?>js/main.js"></script>
  <script src="<?php echo base_url();?>js/messages.js"></script>
 <script>
   $(function(){
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});
});
 </script>
</body>

</html>