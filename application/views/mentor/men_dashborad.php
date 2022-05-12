<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid text-white p-0 pt-1">
        <div class="mentor-dash">
            <div class="men-fina">
                <h4>Innovate Finalists</h4>
            </div>
            
            <!-- <div class="incuFinalist">
                <span>Innovate Finalists</span>
                <i class='bx bx-chevron-down'></i>
            </div> -->
            <div id="finalistsData_filter" class="dataTables_filter">
                <input type="search" class="form-control form-control-sm" placeholder="search here"
                            aria-controls="finalistsData"><i class='bx bx-search bx-md'></i>
            </div>
            
            <div class="table-responsive">
                <table id="mentorList" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sparkle ID</th>
                            <th>Project Name</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($finalists) && !empty($finalists)) {
                            foreach ($finalists as $key => $mentop50) { ?>
                        <tr>
                            <td> <a href="<?php echo base_url()?>mentor/projectDetails/<?php echo $mentop50->projectID; ?>" target="_blank"><?php echo $mentop50->sparkleID ?></a></td>
                            <td><?php echo $mentop50->projectName?></td>
                            <td><?php echo $mentop50->category_name; //echo $prodetails->sparkleID ?></td>
                            <td><?php echo $mentop50->sub_cat_name; //echo $prodetails->sparkleID ?></td>
                            <td><?php echo "action"; ?></td>
                        </tr>
                        <?php } }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

