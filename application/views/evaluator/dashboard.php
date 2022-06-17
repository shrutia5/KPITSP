<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="eval-dash">
            <div class="row m-0">
                <div class="col-md-3 col-12 p-0"> 
                    <div class="eva-cate-head">
                        <p>Select Category</p>
                    </div>   
                    <div class="eva-cate">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                            <?php 
                                         foreach ($categoryList as $key => $category){?>
                                <div class="panel-heading eva-category headingOne" role="tab" id="heading<?php echo $category->category_id ?>">
                                    <h4 class="panel-title eva-category-list">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $category->category_id ?>" aria-expanded="true" aria-controls="collapseOne" class="collapsed"><i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i>
                                        
                                            <?php echo $category->category_name; ?>
                                        <!-- Energy -->
                                        </a>
                                    </h4>

                                </div>
                                        
                                <div id="collapse<?php echo $category->category_id ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="subCategoryBody">
                                          <?php 
                                            if(isset($category->subCategoryList) && !empty($category->subCategoryList)){
                                              foreach ($category->subCategoryList as $key => $subCategory){?>
                                                    <label class="eva-cat"><p><?php echo $subCategory->sub_cat_name;?></p>
                                                    <input type="checkbox" id="evasubcat-<?php echo $subCategory->sub_cat_id;?>" name="vehicle1" value="<?php echo $subCategory->sub_cat_id;?>" class="ch-filter">
                                                    <span class="checkmark"></span>
                                                </label>
                                          <?php } } else{
                                            echo "-";
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i>
                                    Mobality
                                    </a>
                                    </h4>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</div>
                                </div>
                            </div> -->
                        </div>
                    </div>   
                </div>
                <div class="col-md-9 col-12"> 
                    <div class="eval-table">
                        <div class="eva-list">Innovate List </div>
                        <div class="eva-mem">
                            <span class="stars"><span class="available-star"><i class='bx bx-star'></i></span>Available</span>
                            <span class="stars"><span class="selection-star"><i class='bx bxs-star' ></i></span>My Selection</span>
                            <span class="stars"><span class="locked-star"><i class='bx bxs-star' ></i></span>Locked</span>
                            <span class="stars"><span class="evaluated-star"><i class='bx bxs-star' ></i></span>Evaluated</span>
                        </div>
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
        <p><b id="confirm-title">Project Removal</b></p>
        <p id="remove-msg"></p>
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
    var self_list = 0;
</script>

