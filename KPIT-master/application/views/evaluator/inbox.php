<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="eval-dash">
            <div class="row m-0">
                <div class="col-md-12"> 
                    <div class="eval-table">
                        <div class="eva-list">Innovate Selected Projects </div>
                        <!-- <div class="eva-mem">
                            <span> <span class="available-star"><i class='bx bx-star'></i></span> Available</span>
                            <span><span class="selection-star"><i class='bx bxs-star' ></i></span>My Selection</span>
                            <span><span class="locked-star"><i class='bx bxs-star' ></i></span>Locked</span>
                            <span><span class="evaluated-star"><i class='bx bxs-star' ></i></span>Evaluated</span>
                        </div> -->
                        <span class="search-icon"><i class='bx bx-search-alt-2'></i></span>
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sparkle ID</th>
                                    <th>Project Name</th>
                                    <th>Area of Innovation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade messageModal" id="selectionSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p><b>Project Selection</b></p>
        <p id="selection-msg"></p>
        <div class="modal-btn">
          <input type="button" data-dismiss="modal" value="Ok">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade messageModal" id="removeConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p></p>
        <p id="selection-msg">Are you sure want to remove this project?</p>
        <div class="modal-btn">
        <a href="" data-dismiss="modal">No</a>
          <input type="button" data-dismiss="modal" id="btnRemoveConfirm" value="Yes">
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    var getevallist = 1;
    self_list = 1;
</script>

