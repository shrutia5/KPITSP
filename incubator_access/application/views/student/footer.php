<div class="modal fade" id="incubateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>You have opted <span class="incubation-status"></span>to share your project data with our incubation partners.We consider this as the collective preference of your entire team.</p>
        <div class="modal-btn">
          <a href="" data-dismiss="modal">No</a>
          <input type="submit" data-dismiss="modal" class="yesTop100" value="Yes">
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("commonScripts");?>
  <script src="<?php echo base_url();?>js/student/common.js"></script>
  <script src="<?php echo base_url();?>js/student/submitIdea.js"></script>
 
 <script src="<?php echo base_url();?>js/register.js"></script>
 <script src="<?php echo base_url();?>js/main.js"></script>
 <script src="<?php echo base_url();?>js/messages.js"></script>
 <script>
   $(function(){
    $("#upload_link").on('click', function(e){
      e.preventDefault();
      $("#upload:hidden").trigger('click');
      });
      $("#upload_link_desktop").on('click', function(e){
          e.preventDefault();
          $("#upload_desktop:hidden").trigger('click');
      });
});
 </script>
</body>

</html>