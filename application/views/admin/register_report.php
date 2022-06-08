
<div class="phaseonedisplay">
                        <div class="phase-info all" id="p1-all">
                        <?php if(!empty($list)){ ?> 
                            <div class="table-responsive">
                                <!--Table-->
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Other City</th>
                                            <th>Gender</th>
                                            <th>College</th>
                                            <th>College is top 100</th>
                                            <th>College is permier</th>
                                            <th>Email Verified</th>
                                            <th>Idea submitted</th>
                                            <th>Idea in phase 2</th>
                                            <th>Idea in top 100</th>
                                            <th>Idea in Finale</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
                                    <!--Table body-->
                                    <tbody>
                                        <?php
                                        if(!empty($list)){
                                        foreach ($list as $key => $pdetails) {
                                            //$projectID =$pdetails->projectID;
                                            $userID= $pdetails->userID;
                                            ?>
                                        <tr>
                                            <td><?php echo $pdetails->firstname." ".$pdetails->lastName;?></td>
                                            <td><?php echo $pdetails->email;?></td>
                                            <td><?php echo $pdetails->phoneNumber;?></td>
                                            <td><?php echo $pdetails->country_id;?></td>
                                            <td><?php echo $pdetails->state_id;?></td>
                                            <td><?php echo $pdetails->city_id;?></td>
                                            <td><?php echo $pdetails->otherCity;?></td>
                                            <td><?php echo $pdetails->gender;?></td>
                                            <td><?php echo $pdetails->college_name;?></td>
                                            <td><?php if($pdetails->is_top_100 == "1") {echo "Yes";}else{echo "No";}?></td>
                                            <td><?php if($pdetails->is_premier == "1") {echo "Yes";}else{echo "No";}?></td>
                                            <td><?php echo $pdetails->verify_email;?></td>
                                            <td><?php if($pdetails->phaseOneDataSubmited == "1"){ echo "Yes";}?></td>
                                            <td><?php if($pdetails->phaseTwoDataSubmited == "1"){ echo "Yes";}?></td>
                                            <td><?php if($pdetails->phaseTwoStatus == "Approved" && $pdetails->currentPhase =="3"){ echo "Yes";}?></td>
                                            <td><?php if($pdetails->phaseThreeStatus == "50"){ echo "Yes";}?></td>
                                            
                                            
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
                    