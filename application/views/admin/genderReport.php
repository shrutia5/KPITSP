<div class="phaseonedisplay">
    <div class="phase-info all" id="p1-all">
    <?php  if(!empty($list)){ ?> 
        <div class="table-responsive">
            <!--Table-->
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <!--Table head-->
                <thead>
                    <tr>
                        <th>Gender</th>
                        <th>Number Of Registrations</th>
                        <th>Number of Idea submission</th>
                        <th>Number of Ideas in phase 2</th>
                        <th>Number of Ideas in top 100</th>
                        <th>Number of Ideas in finale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($list)){
                        $dataMale[] = $list[0]->numberOfreg;
                        $dataMale[] = $list[0]->numberOfidea;
                        $dataMale[] = $list[0]->numberOfidea2;
                        $dataMale[] = $list[0]->numberOfidea100;
                        $dataMale[] = $list[0]->numberOfideafinal;
                        
                        $dataFemale[] = $list[1]->numberOfreg;
                        $dataFemale[] = $list[1]->numberOfidea;
                        $dataFemale[] = $list[1]->numberOfidea2;
                        $dataFemale[] = $list[1]->numberOfidea100;
                        $dataFemale[] = $list[1]->numberOfideafinal;

                        $dataOther[] = $list[2]->numberOfreg;
                        $dataOther[] = $list[2]->numberOfidea;
                        $dataOther[] = $list[2]->numberOfidea2;
                        $dataOther[] = $list[2]->numberOfidea100;
                        $dataOther[] = $list[2]->numberOfideafinal;
                        
                    foreach ($list as $key => $pdetails) {
                        
                        ?>
                    <tr>
                         <td><?php echo $pdetails->gender;?></td>
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
    <script>
        var dataMale = <?php echo "[".implode(",",$dataMale)."]";?>;
        var dataFemale = <?php echo "[".implode(",",$dataFemale)."]";?>;
        var dataOther = <?php echo "[".implode(",",$dataOther)."]";?>;
        var dataLabel = <?php echo '["Number Of Registration","Nunber of Idea submission","Nunber of Idea in phase 2","Nunber of Idea in top 100","Nunber of Idea in finale"]';?>;
        
    </script> 
    <div class="row">
        <div class="col-md-4">
            <canvas id="gender" width="300" height="400"></canvas>
        </div>
    </div>
    </div>
    </div>
                    