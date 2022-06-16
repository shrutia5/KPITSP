<div class="phaseonedisplay">
    <div class="phase-info all" id="p1-all">
    <?php  if(!empty($list)){ ?> 
        <div class="table-responsive">
            <!--Table-->
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <!--Table head-->
                <thead>
                    <tr>
                    <?php if($allrep == "state_wise") { ?>
                            <th>State Name</th>
                        <?php }elseif($allrep == "city_wise"){ ?>
                            <th>City Name</th>
                       <?php }elseif($allrep == "premier_wise"){ ?>
                            <th>College Name</th>
                       <?php }elseif($allrep == "branch_wise"){ ?>
                            <th>Branch Name</th>
                        <?php }elseif($allrep == "degree_wise"){ ?>
                            <th>Degree Name</th>
                        <?php }elseif($allrep == "year_of_com"){ ?>
                            <th>Year Of Completion</th>
                       <?php }elseif($allrep == "gender_wise"){ ?>
                            <th>Gender</th>
                        <?php }elseif($allrep == "top_100_clg"){ ?>
                            <th>Top 100 College Name</th>
                       <?php } ?>
                       
                        <th>Number Of Registration</th>
                        <th>Nunber of Idea submission</th>
                        <th>Nunber of Idea in phase 2</th>
                        <th>Nunber of Idea in top 100</th>
                        <th>Nunber of Idea in finale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($list)){
                    foreach ($list as $key => $pdetails) {
                        ?>
                    <tr>
                        <?php if($allrep == "state_wise") { ?>
                            <td><?php echo $pdetails->state_name;?></td>
                        <?php }elseif($allrep == "city_wise"){ ?>
                            <td><?php echo $pdetails->city_name;?></td>
                       <?php }elseif($allrep == "premier_wise"){ ?>
                            <td><?php echo $pdetails->college_name;?></td>
                        <?php }elseif($allrep == "branch_wise"){ ?>
                            <td><?php echo $pdetails->branch_name;?></td>
                       <?php }elseif($allrep == "degree_wise"){ ?>
                            <td><?php echo $pdetails->degree_name;?></td>
                        <?php }elseif($allrep == "year_of_com"){ ?>
                            <td><?php echo $pdetails->yearOfCompletion;?></td>
                        <?php }elseif($allrep == "gender_wise"){ ?>
                            <td><?php echo $pdetails->gender;?></td>
                        <?php }elseif($allrep == "top_100_clg"){ ?>
                            <td><?php echo $pdetails->college_name;?></td>
                       <?php } ?>
                       
                        <td><?php echo $pdetails->numberOfreg;?></td>
                        <td><?php echo $pdetails->numberOfidea;?></td>
                        <td><?php echo $pdetails->numberOfidea2;?></td>
                        <td><?php echo $pdetails->numberOfidea100;?></td>
                        <td><?php echo $pdetails->numberOfideafinal;?></td>
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
    <?php }  ?>

    <!--<canvas id="year" width="400" height="400"></canvas>-->
    </div>
    </div>
                    