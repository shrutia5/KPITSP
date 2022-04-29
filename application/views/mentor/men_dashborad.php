<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="mentor-dash">
            <div class="men-fina">
                <p>Innovate Finalists</p>
            </div>
            
            <!-- <div class="incuFinalist">
                <span>Innovate Finalists</span>
                <i class='bx bx-chevron-down'></i>
            </div> -->
            <div class="men-search">
            <span><i class='bx bx-search-alt-2' ></i></span>
            </div>
            
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
</main>

