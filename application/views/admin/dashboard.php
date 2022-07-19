<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="row m-0 admin-height">
            <div class="col-md-9 mobile-changes1">
                <div class="helpful-section noFooter ad-select">
                    <div class="pha-select" style="display:inline-block;z-index: 10;">            
                    <!--<div class="pha-select position-absolute" style="z-index: 10;">-->
                                <!-- <label for="">All</label> -->
                                <span>Innovate :</span>
                                <!-- $('.posi-select').toggle('display-none'); -->
                                <a onclick="$('.posi-select').toggle('display-none');">
                                    <span class="changephase-text">Phase 1</span><i class='bx bx-chevron-down'></i>
                                <div class="posi-select display-none">
                                    <form action="">
                                        <input type="radio" id="phase1" name="innovate" value="Phase 1">
                                        <label for="pase1">Innovate:Phase 1</label><br>
                                        <input type="radio" id="phase2" name="innovate" value="Phase 2">
                                        <label for="phase3">Innovate:Phase 2</label><br>
                                        <input type="radio" id="phase3" name="innovate" value="Phase 3">
                                        <label for="phase3">Innovate:Phase 3</label><br>
                                        <input type="radio" id="finalists" name="innovate" value="Finalists">
                                        <label for="finalists">Finalists</label><br>
                                    </form>
                                </div>
                                </a>
                            </div>
                            <div class="pha-cla" style="display:inline-block;z-index: 10;">
                                <!-- <label for="">All</label> -->
                                <a onclick="$('.posi-content').toggle('display-none');"> <span class="change-text">All</span><i class='bx bx-chevron-down'></i>
                                <div class="posi-content display-none">
                                   
                                        <input type="radio" id="all" name="phaseOne" value="All">
                                        <label for="all">All</label><br>
                                        <input type="radio" id="approved" name="phaseOne" value="Approved">
                                        <label for="approved">Approved</label><br>
                                        <input type="radio" id="rejected" name="phaseOne"value="Rejected">
                                        <label for="rejected">Rejected</label><br>
                                        <input type="radio" id="hold" name="phaseOne" value="Hold">
                                        <label for="hold">Hold</label>
                                   
                                </div>
                                </a>
                            </div>

                            <div class="phatwo-cla position-absolute" style="z-index: 10;">
                                <!-- <label for="">All</label> -->
                                <a onclick="$('.phatwo-content').toggle('display-none');"> <span class="change-text">All</span><i class='bx bx-chevron-down'></i>
                                <div class="phatwo-content display-none">
                                   
                                        <input type="radio" name="phasethree" id="phasetwoall" value="All">
                                        <label for="all">All</label><br>
                                        <input type="radio" name="phasethree" id="phasetwoapproved" value="Approved">
                                        <label for="approved">Approved</label><br>
                                        <input type="radio" name="phasethree" id="phasetworejected" value="Rejected">
                                        <label for="rejected">Rejected</label><br>
                                        <input type="radio" name="phasethree" id="phasetwohold" value="Hold">
                                        <label for="hold">Hold</label>
                                   
                                </div>
                                </a>
                            </div>

                            <div class="phasetwo-cla position-absolute" style="z-index: 10;">
                                <!-- <label for="">All</label> -->
                                <a onclick="$('.phasetwo-content').toggle('display-none');"> <span class="changerank-text"> All</span><i class='bx bx-chevron-down'></i>
                                <div class="phasetwo-content display-none">
                                        <input type="radio" id="phasethall" name="phasetwo"  value="All">
                                        <label for="all">All</label><br>
                                        <input type="radio" id="top" name="phasetwo"  value="Top 50">
                                        <label for="top">Top 50</label><br>
                                        <input type="radio" id="bottom" name="phasetwo" value="Bottom 50">
                                        <label for="bottom">Bottom 50</label><br>
                                        <input type="radio" id="hundred" name="phasetwo" value="200">
                                        <label for="hundred">200</label><br>
                                </div>
                                </a>
                            </div>

                            <div class="finalists-cla position-absolute" style="z-index: 10;">
                                <!-- <label for="">All</label> -->
                                <a onclick="$('.finalists-content').toggle('display-none');">
                                <div class="finalists-content display-none">
                                   
                                        <!-- <input type="radio" id="top" name="phasetwo" id="top" value="Top 100">
                                        <label for="top">Top 100</label><br>
                                        <input type="radio" id="hundred" name="phasetwo" id="hundred" value="Approved">
                                        <label for="hundred">100-200</label><br>
                                        <input type="radio" id="bottom" name="phasetwo" id="bottom" value="Bottom">
                                        <label for="bottom">Bottom</label><br> -->
                                </div>
                                </a>
                            </div>
                            
                        <!-- <div class="col-md-3">
                            <span><i class='bx bx-search-alt'></i></span>
                            <input type="search" id="form" class="form-control" placeholder="Search"/>
                        </div> -->
                    <div class="phaseonedisplay">
                        <div class="phase-info all" id="p1-all">
                        <?php if(!empty($adminData)){ ?> 
                            <div class="table-responsive">
                                <!--Table-->
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
                                    <!--Table body-->
                                    <tbody>
                                        <?php
                                        if(!empty($adminData)){
                                        foreach ($adminData as $key => $pdetails) {
                                            $projectID =$pdetails->projectID;
                                            $userID= $pdetails->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td ><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $pdetails->projectID ?>" target="_blank"><?php echo $pdetails->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $pdetails->projectName ?></td>
                                            <td width="200px"><?php echo $pdetails->category_name ?></td>
                                            <td width="200px"><?php echo $pdetails->sub_cat_name ?></td>
                                            <td width="100px">
                                                <a href="" data-projectID="<?php echo $pdetails->projectID;?>" class="approveProject"><i class='bx bx-check'></i></a>
                                                <a href="" data-projectID="<?php echo $pdetails->projectID;?>" class="rejectProject"><i class='bx bx-x'></i></a>
                                                <a href="" data-projectID="<?php echo $pdetails->projectID;?>" class="holdProject"><i class='bx bx-pause'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                       <?php } ?>
                        </div>
                        
                        <div class="phase-info approved" id="approved">
                            <?php  if(!empty($approvestatus)){  ?>
                            <div class="table-responsive">
                                <!--Table-->
                                <table id="approvetable" class="table table-striped table-bordered" style="width:100%">
                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
                                    <!--Table body-->
                                    <tbody>
                                        <?php
                                        if(!empty($approvestatus)){
                                        foreach ($approvestatus as $key => $approve) {
                                            $projectID =$pdetails->projectID;
                                            $userID= $pdetails->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $pdetails->projectID ?>" target="_blank"><?php echo $pdetails->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $pdetails->projectName ?></td>
                                            <td width="200px"><?php echo $pdetails->category_name ?></td>
                                            <td width="200px"><?php echo $pdetails->sub_cat_name ?></td>
                                            <td width="100px">
                                                
                                                <a href="" data-projectID="<?php echo $pdetails->projectID;?>" class="rejectProject"><i class='bx bx-x'></i></a>
                                                <a href="" data-projectID="<?php echo $pdetails->projectID;?>" class="holdProject"><i class='bx bx-pause'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                       <?php } ?>
                        </div>
                        <div class="phase-info rejected" id="rejected">
                            <?php if(!empty($rejectstatus)){ ?>
                            <div class="table-responsive">
                                <!--Table-->
                                <table id="rejecttable" class="table table-striped table-bordered" style="width:100%">
                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
                                    <!--Table body-->
                                    <tbody>
                                        <?php
                                        if(!empty($rejectstatus)){
                                        foreach ($rejectstatus as $key => $reject) {
                                            $projectID =$reject->projectID;
                                            $userID= $reject->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $reject->projectID ?>" target="_blank"><?php echo $reject->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $reject->projectName ?></td>
                                            <td width="200px"><?php echo $reject->category_name ?></td>
                                            <td width="200px"><?php echo $reject->sub_cat_name ?></td>
                                            <td width="100px">
                                                <a href="" data-projectID="<?php echo $reject->projectID;?>" class="approveProject"><i class='bx bx-check'></i></a>
                                                <a href="" data-projectID="<?php echo $reject->projectID;?>" class="holdProject"><i class='bx bx-pause'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                       <?php } ?>
                        </div>
                        <div class="phase-info hold" id="hold">
                            <?php if(!empty($holdstatus)){ ?>
                            <div class="table-responsive">
                                <!--Table-->
                                <table id="holdtable" class="table table-striped table-bordered" style="width:100%">
                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
                                    <!--Table body-->
                                    <tbody>
                                        <?php
                                        if(!empty($holdstatus)){
                                        foreach ($holdstatus as $key => $hold) {
                                            $projectID =$hold->projectID;
                                            $userID= $hold->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $hold->projectID ?>" target="_blank"><?php echo $hold->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $hold->projectName ?></td>
                                            <td width="200px"><?php echo $hold->category_name ?></td>
                                            <td width="200px"><?php echo $hold->sub_cat_name ?></td>
                                            <td width="100px">
                                                <a href="" data-projectID="<?php echo $hold->projectID;?>" class="approveProject"><i class='bx bx-check'></i></a>
                                                <a href="" data-projectID="<?php echo $hold->projectID;?>" class="rejectProject"><i class='bx bx-x'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                       <?php } ?>
                        </div>
                    </div>
                    <div class="phasetwodisplay">
                        <div class="phase-info phasetwoall" id="p2-all">
                        <?php if(!empty($phasetwoall)){ ?>
                            <div class="table-responsive">
                              
                                <table id="phasetwoexample" class="table table-striped table-bordered" style="width:100%">
                                  
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top 1</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php
                                        if(!empty($phasetwoall)){
                                        foreach ($phasetwoall as $key => $phasetwoall) {
                                            $projectID =$phasetwoall->projectID;
                                            $userID= $phasetwoall->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $phasetwoall->projectID ?>" target="_blank"><?php echo $phasetwoall->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $phasetwoall->projectName ?></td>
                                            <td width="200px"><?php echo $phasetwoall->category_name ?></td>
                                            <td width="200px"><?php echo $phasetwoall->sub_cat_name ?></td>
                                            <td width="100px">
                                                <a href="" data-projectID="<?php echo $phasetwoall->projectID;?>" class="phase2approveProject"><i class='bx bx-check'></i></a>
                                                <a href="" data-projectID="<?php echo $phasetwoall->projectID;?>" class="phase2rejectProject"><i class='bx bx-x'></i></a>
                                                <a href="" data-projectID="<?php echo $phasetwoall->projectID;?>" class="phase2holdProject"><i class='bx bx-pause'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                  
                                </table>
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                       
                        <div class="phase-info phasetwoapproved" id="phasetwoapproved">
                            <?php if(!empty($phasetwoapprovestatus)){ ?>
                            <div class="table-responsive">
                                <table id="phasetwoapprovetable" class="table table-striped table-bordered" style="width:100%">
                                  
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php
                                        if(!empty($phasetwoapprovestatus)){
                                        foreach ($phasetwoapprovestatus as $key => $phasetwoapprove) {
                                            $projectID =$phasetwoapprove->projectID;
                                            $userID= $phasetwoapprove->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $phasetwoapprove->projectID ?>" target="_blank"><?php echo $phasetwoapprove->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $phasetwoapprove->projectName ?></td>
                                            <td width="200px"><?php echo $phasetwoapprove->category_name ?></td>
                                            <td width="200px"><?php echo $phasetwoapprove->sub_cat_name ?></td>
                                            <td width="100px">
                                                
                                                <a href="" data-projectID="<?php echo $phasetwoapprove->projectID;?>" class="phase2rejectProject"><i class='bx bx-x'></i></a>
                                                <a href="" data-projectID="<?php echo $phasetwoapprove->projectID;?>" class="phase2holdProject"><i class='bx bx-pause'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                   
                                </table>
                                
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                        
                        <div class="phase-info phasetworejected" id="phasetworejected">
                            <?php if(!empty($phasetworejecttatus)){ ?>
                            <div class="table-responsive">
                               
                                <table id="phasetworejecttable" class="table table-striped table-bordered" style="width:100%">
                                   
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        if(!empty($phasetworejecttatus)){
                                        foreach ($phasetworejecttatus as $key => $phase2reject) {
                                            $projectID =$phase2reject->projectID;
                                            $userID= $phase2reject->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $phase2reject->projectID ?>" target="_blank"><?php echo $phase2reject->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $phase2reject->projectName ?></td>
                                            <td width="200px"><?php echo $phase2reject->category_name ?></td>
                                            <td width="200px"><?php echo $phase2reject->sub_cat_name ?></td>
                                            <td width="100px">
                                                <a href="" data-projectID="<?php echo $phase2reject->projectID;?>" class="phase2approveProject"><i class='bx bx-check'></i></a>
                                                <a href="" data-projectID="<?php echo $phase2reject->projectID;?>" class="phase2holdProject"><i class='bx bx-pause'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                   
                                </table>
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                        <div class="phase-info phasetwohold" id="phasetwohold">
                            <?php if(!empty($phasetwoholdstatus)){ ?>
                            <div class="table-responsive">
                              
                                <table id="phasetwoholdtable" class="table table-striped table-bordered" style="width:100%">
                                   
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        if(!empty($phasetwoholdstatus)){
                                        foreach ($phasetwoholdstatus as $key => $phase2hold) {
                                            $projectID =$phase2hold->projectID;
                                            $userID= $phase2hold->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $phase2hold->projectID ?>" target="_blank"><?php echo $phase2hold->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $phase2hold->projectName ?></td>
                                            <td width="200px"><?php echo $phase2hold->category_name ?></td>
                                            <td width="200px"><?php echo $phase2hold->sub_cat_name ?></td>
                                            <td width="100px">
                                                <a href="" data-projectID="<?php echo $phase2hold->projectID;?>" class="phase2approveProject"><i class='bx bx-check'></i></a>
                                                <a href="" data-projectID="<?php echo $phase2hold->projectID;?>" class="phase2rejectProject"><i class='bx bx-x'></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>  
                        </div>
                    </div>      
                    <div class="phasethreedisply">
                        <div class="phase-info top100" id="top100">
                            <?php if(!empty($phasethreeall)){ ?>
                            <div class="table-responsive">
                                <!-- <table id="top100table" class="table table-striped table-bordered" style="width:100%">
                                    
                                    <thead>
                                        <tr>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        if(!empty($phasethreeall)){
                                        foreach ($phasethreeall as $key => $phase3all) {
                                            $projectID =$phase3all->projectID;
                                            $userID= $phase3all->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>/admin/project-detail/<?php echo  $phase3all->projectID ?>"><?php echo $phase3all->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $phase3all->projectName ?></td>
                                            <td width="200px"><?php echo $phase3all->category_name ?></td>
                                            <td width="200px"><?php echo $phase3all->sub_cat_name ?></td>
                                            <td width="200px">
                                                
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $phase3all->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $phase3all->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <input type="radio" id="bottom" name="phasetwo" data-projectID="<?php echo $phase3all->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table> -->
                                <table id="top100table" class="table table-striped table-bordered" style="width:100%">
                                    
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>MP</th>
                                            <th>N</th>
                                            <th>PC</th>
                                            <th>TK</th>
                                            <th>SL</th>
                                            <th>Evals</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        if(!empty($phasethreeall)){
                                        foreach ($phasethreeall as $key => $phasethreeal) {
                                            $projectID =$phasethreeal->projectID;
                                            $userID= $phasethreeal->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $phasethreeal->projectID ?>" target="_blank"><?php echo $phasethreeal->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $phasethreeal->projectName ?></td>
                                            <td><?php echo $phasethreeal->marketPotential; ?></td>
                                            <td><?php echo $phasethreeal->productReadiness; ?></td>
                                            <td><?php echo $phasethreeal->invention; ?></td>
                                            <td><?php echo $phasethreeal->technicalProcess; ?></td>
                                            <td><?php echo $phasethreeal->impactOnEnvironment; ?></td>
                                            <td><?php echo $phasethreeal->numberOfEvals; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td width="200px">
                                                
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $phasethreeal->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">Top 50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $phasethreeal->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <input type="radio" id="bottom" name="phasetwo" data-projectID="<?php echo $phasethreeal->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>
                            <?php }else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                        <div class="phase-info fifty" id="fifty">
                            <?php if(!empty($fiftystatus)){ ?>
                            <div class="table-responsive">
                                <!-- <table id="fiftytable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php
                                            if(!empty($fiftystatus)){
                                        foreach ($fiftystatus as $key => $topfifty) {
                                            $projectID =$topfifty->projectID;
                                            $userID= $topfifty->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>/admin/project-detail/<?php echo  $topfifty->projectID ?>"><?php echo $topfifty->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $topfifty->projectName ?></td>
                                            <td width="200px"><?php echo $topfifty->category_name ?></td>
                                            <td width="200px"><?php echo $topfifty->sub_cat_name ?></td>
                                            <td width="200px">
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $topfifty->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $topfifty->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $topfifty->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table> -->
                                <table id="fiftytable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>MP</th>
                                            <th>N</th>
                                            <th>PC</th>
                                            <th>TK</th>
                                            <th>SL</th>
                                            <th>Evals</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php
                                            if(!empty($fiftystatus)){
                                        foreach ($fiftystatus as $key => $topfifty) {
                                            $projectID =$topfifty->projectID;
                                            $userID= $topfifty->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $topfifty->projectID ?>" target="_blank"><?php echo $topfifty->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $topfifty->projectName ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td width="200px">
                                                <!-- <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $topfifty->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">Top 50</label> -->
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $topfifty->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $topfifty->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                        <div class="phase-info betweenhun-two" id="betweenhun-two">
                            <?php if(!empty($huntwostatus)){ ?>
                            <div class="table-responsive">
                                <!-- <table id="betweenhun" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($huntwostatus)){
                                        foreach ($huntwostatus as $key => $betweenhuntwo) {
                                            $projectID =$betweenhuntwo->projectID;
                                            $userID= $betweenhuntwo->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>/admin/project-detail/<?php echo  $betweenhuntwo->projectID ?>"><?php echo $betweenhuntwo->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $betweenhuntwo->projectName ?></td>
                                            <td width="200px"><?php echo $betweenhuntwo->category_name ?></td>
                                            <td width="200px"><?php echo $betweenhuntwo->sub_cat_name ?></td>
                                            <td width="200px">
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $betweenhuntwo->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $betweenhuntwo->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $betweenhuntwo->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table> -->
                                <table id="betweenhun" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>MP</th>
                                            <th>N</th>
                                            <th>PC</th>
                                            <th>TK</th>
                                            <th>SL</th>
                                            <th>Evals</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($huntwostatus)){
                                        foreach ($huntwostatus as $key => $betweenhuntwo) {
                                            $projectID =$betweenhuntwo->projectID;
                                            $userID= $betweenhuntwo->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $betweenhuntwo->projectID ?>" target="_blank"><?php echo $betweenhuntwo->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $betweenhuntwo->projectName ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td width="200px">
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $betweenhuntwo->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">Top 50</label>
                                                <!-- <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $betweenhuntwo->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label> -->
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $betweenhuntwo->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                        <div class="phase-info bottom" id="bottom">
                            
                            <?php
                            //print_r($bottomstatus); exit;
                            if(!empty($bottomstatus)){ ?>
                            <div class="table-responsive">
                                <!-- <table id="bottom50" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($bottomstatus)){
                                        foreach ($bottomstatus as $key => $bottom) {
                                            $projectID =$bottom->projectID;
                                            $userID= $bottom->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>/admin/project-detail/<?php echo  $bottom->projectID ?>"><?php echo $bottom->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $bottom->projectName ?></td>
                                            <td width="200px"><?php echo $bottom->category_name ?></td>
                                            <td width="200px"><?php echo $bottom->sub_cat_name ?></td>
                                            <td width="200px">
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table> -->
                                <table id="bottom50" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Premier</th>
                                            <th>Top</th>
                                            <th>Sparkle ID</th>
                                            <th>Project Name</th>
                                            <th>MP</th>
                                            <th>N</th>
                                            <th>PC</th>
                                            <th>TK</th>
                                            <th>SL</th>
                                            <th>Evals</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($bottomstatus)){
                                        foreach ($bottomstatus as $key => $bottom) {
                                            // echo "bottom 200 data";
                                            // print_r($bottom);exit;
                                            $projectID =$bottom->projectID;
                                            $userID= $bottom->userID;
                                            ?>
                                        <tr>
                                            <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                            <td><a href="<?php echo base_url()?>admin/project-detail/<?php echo  $bottom->projectID ?>" target="_blank"><?php echo $bottom->sparkleID ?></a></td>
                                            <td width="200px"><?php echo $bottom->projectName; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td><?php echo "1"; ?></td>
                                            <td width="200px">
                                                <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="fiftyProject" value="50">
                                                <label for="">50</label>
                                                <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                                <label for="">Bottom 50</label>
                                                <!-- <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="twohunProject" value="200">
                                                <label for="">200</label> -->
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                        </div>
                        
                    </div>            
                    <div class="phase-info finalistsdisplay">
                        <?php if(!empty($finalists)){ ?>
                        <div class="table-responsive">
                            <!--Table-->
                            <table id="finalistsData" class="table table-striped table-bordered" style="width:100%">
                                <!--Table head-->
                                <thead>
                                    <tr>
                                        <th>Premier</th>
                                        <th>Top</th>
                                        <th>Sparkle ID</th>
                                        <th>Project Name</th>
                                        <th>Team</th>
                                        <!-- <th>Category</th>
                                        <th>Sub-Category</th> -->
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <!--Table head-->
                                <!--Table body-->
                                <tbody>
                                    <?php 
                                    if(!empty($finalists)){
                                    foreach ($finalists as $key => $bottom) {
                                        $projectID =$bottom->projectID;
                                        $userID= $bottom->userID;
                                        ?>
                                    <tr>
                                        <td><?php if(isset($pdetails->is_premier) && $pdetails->is_premier ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                        <td><?php if(isset($pdetails->is_top_100) && $pdetails->is_top_100 ==1){ echo "<i class='ic-apl bx bxs-bank'></i>";}; ?></td>
                                        <td><a href="<?php echo base_url()?>/admin/project-detail/<?php echo  $bottom->projectID ?>" target="_blank"><?php echo $bottom->sparkleID ?></a></td>
                                        <td width="200px"><?php echo $bottom->projectName ?></td>
                                        <td></td>
                                        <!-- <td width="200px"><?php echo $bottom->category_name ?></td> -->
                                        <!-- <td width="200px"><?php echo $bottom->sub_cat_name ?></td> -->
                                        <!-- <td width="200px">
                                            <input type="radio" id="top100" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="fiftyProject" value="50">
                                            <label for="">50</label>
                                            <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="bottomfiftyProject" value="Bottom 50">
                                            <label for="">Bottom 50</label>
                                            <input type="radio" id="hun-two" name="phasetwo" data-projectID="<?php echo $bottom->projectID;?>" class="twohunProject" value="200">
                                            <label for="">200</label>
                                        </td> -->
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                                <!--Table body-->
                            </table>
                            <!--Table-->
                        </div>
                        <?php }else{ ?>
                            <div class="default-view no-border d-flex align-items-center">
                            <div class="default-content">
                                <div class="table-icon">
                                <i class='bx bx-file-blank'></i>
                                </div>
                                <h3 class="mt-4"> Table is empty!</h3>
                                <p class="light-color">No data available in table</p>
                            </div>
                        </div>
                          <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mobile-col-3">
                <div class="row form-row ws-form-row m-0" style="display: block !important;">
                    <div class="full-left noFooter">
                        <p style="font-size: 18px;">Useful Links</p>
                        <hr class="admin-link">
                        <p style="font-size: 16px;" class="p1">View Evaluation progress <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                        <hr class="admin-link">
                        <p style="font-size: 16px;" class="p1">View Incubation progress <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                        <hr class="admin-link">
                        <p style="font-size: 16px;" class="p1">Schedule Webinars <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                        <hr class="admin-link">
                        <p style="font-size: 16px;" class="p1">Reports <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                    </div>
                </div>
                <div class="row form-row ws-form-row m-0 voat-star" style="display: block !important;">
                    <div class="full-left noFooter">
                        <p style="font-size: 18px;">Voting Stats</p>
                        <hr class="admin-link">
                        <div class="row">
                            <div class="col-md-7">Project Name</div>
                            <div class="col-md-5">Count</div>
                        </div>
                        <hr class="admin-link">
                        <div class="voat-star-scroll">
                            <div class="row">
                                <div class="col-md-7"><a href="">Design with EV and thermal management with automobile</a></div>
                                <div class="col-md-5">21,000</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Eco-Generator</a></div>
                                <div class="col-md-5">16,573</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Geo Green</a></div>
                                <div class="col-md-5">12,260</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Save Electricity</a></div>
                                <div class="col-md-5">10,192</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Save water</a></div>
                                <div class="col-md-5">6,061</div>
                            </div>
                            <hr class="admin-link">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reasonModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="rejectAction" value="rejectProject">
        <textarea placeholder="Start writing here..."  class="form-control" id="textReason" required>Ok</textarea>
        <p class='error hide' id="rejection-error">Please provide some reason</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="rejectConfirm" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>