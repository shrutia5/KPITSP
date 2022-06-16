<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="row submit-hide  pt-3 m-0">
            <div class="d-flex">
                <div class="col-sm-2 col-2">
                    <a href="<?php echo base_url();?>student/dashboard"><i class="bx bxs-chevron-left bx-sm mobile-click" style="color:#C8C8C8;"></i></a>
                    <a href="<?php echo base_url();?>student/project"><i class="bx bxs-chevron-left bx-sm mobile-team" style="color:#C8C8C8;"></i></a>
                    <a href="<?php echo base_url();?>student/project"><i class="bx bxs-chevron-left bx-sm mobile-change" style="color:#C8C8C8;"></i></a>
                    
                </div>
                <div class="col-sm-7 col-7 text-center">
                    <h4 class="mobile-click" id="top-text1"><a href="<?php echo base_url();?>student/dashboard" class="text-white">Back to Dashboard</a></h4>
                    <h4 class="mobile-team"><span>My Team </span></h4>
                    <h4 class="mobile-change">Add New Member</h4>
                    <h4 class="add-member1">New Member</h4>
                </div>
                
                <div class="col-3 col-sm-3">
                    <?php if($projectd->userID == $userid && $projectd->projectStatus!="Reject" && $projectd->phaseTwoStatus!="Reject" && $projectd->phaseThreeStatus!="Reject") { ?>
                    <h4 class="mobile-team"><button class="btn2"><i class='bx bx-plus bx-sm'></i></button></h4>
                    <?php } ?>
                    
                    <i class="bx bxs-chat bx-sm mobile-click chat-box-head" style="color:#8FDB00;"></i>
                   
                    <i class="bx bx-group bx-sm mobile-click" style="color:#8FDB00;"></i>
                    
                </div>
                
            </div>
            <div class="col-sm-12 col-12 pt-2 p-0">
                <div class="alert alert-danger alert-danger-ws text-center mobile-click" role="alert">
                    <i class="bx bx-hourglass"></i> Last 20 days to submit your idea
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-9 full-width mobile-click">
                <div class="full-left noFooter mobile-full">
                    <div class="section-nav d-md-flex justify-content-between">
                        <div class="back">
                            <a href="<?php echo base_url();?>student/dashboard"><i class='bx bx-chevron-left'></i>
                            <span>Back to Dashboard</span></a>
                        </div>
                        <div class="status">
                            <span>Status:</span>
                            <?php
                            if($projectd->phaseTwoStatus != "Approved"){
                                if($projectd->projectStatus != "Approved"){
                                    $submissionSteps = $this->CommonModel->projectSubmissionSteps();
                                    $totSubmissionSteps = count($submissionSteps);
                                    
                                    if($projectd->currentStep > $totSubmissionSteps){
                                        
                                        if($projectd->currentStep==6 && $projectd->phaseOneDataSubmited==0){
                                            echo $submissionSteps[$totSubmissionSteps].' pending';
                                        }else{
                                            echo $submissionSteps[$totSubmissionSteps].' completed';
                                        }
                                        
                                    }else{
                                        if(isset($submissionSteps[$projectd->currentStep])){
                                            echo $submissionSteps[$projectd->currentStep].' pending';
                                        }
                                    }
                                }else{
                                    if(!empty($projectd->prototypeProgressVideo)){
                                        echo 'Prototype progress video submitted';
                                    }else{
                                        if(!empty($projectd->simulationReport)){
                                            echo 'Simulation report submitted';
                                        }else{
                                            if(!empty($projectd->valuePropositionCanvas)){
                                                echo 'Value proposition canvas submitted';
                                            }else{
                                                if(!empty($projectd->leanCanvas)){
                                                    echo 'Lean canvas submitted';
                                                }else{
                                                    $hasPrototypeDataSubmited = true;
                                                    if($projectd->patentFiled == 1 && (empty($projectd->patentStatus) || empty($projectd->patentApplicationNumber))){
                                                        //$hasPrototypeDataSubmited = false;
                                                    }
                                                    
                                                    if(!empty($projectd->technicalDescription) && !empty($projectd->keywords) && $hasPrototypeDataSubmited==true){
                                                        echo 'Text fields submitted';
                                                    }else{
                                                        echo 'Text fields pending';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }else{
                                if( $projectd->phaseThreeStatus == "50"){
                                    echo 'Idea in Grand Finale';
                                }else{
                                    echo 'Idea in Top 100';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-c" id="myTab" role="tablist">
                        <li class="nav-item nav-item1">
                            <a class="nav-link active link1" id="project-tab" data-toggle="tab" href="#projectdetail"
                                role="tab" aria-controls="project" aria-selected="true">Project Details</a>
                        </li>
                        <li class="nav-item nav-item1">
                            <a class="nav-link link1" id="trlquestion-tab" data-toggle="tab" href="#trlquestion" role="tab"
                                aria-controls="trlquestion" aria-selected="false">TRL Questions</a>
                        </li>
                        <li class="nav-item nav-item1">
                            <a class="nav-link link1" id="document-tab" data-toggle="tab" href="#document" role="tab"
                                aria-controls="document" aria-selected="false">Attachments</a>
                        </li>
                    </ul>
                    <div class="tab-content content-pro" id="myTabContent">
                        <div class="tab-pane fade show active" id="projectdetail" role="tabpanel"
                            aria-labelledby="project-tab">
                            <div class="tab-body">
                                <label>
                                    <?php echo $projectd->sparkleID?>
                                </label>
                                <h3 class="norma">
                                    <?php echo $projectd->projectName?>
                                </h3>
                                <br />

                                <?php if($projectd->userID == $userid && $projectd->projectStatus!="Reject" && $projectd->phaseTwoStatus!="Reject" && $projectd->phaseThreeStatus!="Reject") { ?><input
                                    class="mr-2" type="submit"
                                    onclick="location.href='<?php echo base_url();?>student/submit-idea'" name="save"
                                    id="save" value="Continue Editing" />
                                <?php } ?>
                                <!--<a href=""><i class="icofont-play-alt-2"></i>&nbsp;&nbsp;Play Prototype</a>-->
                                <div class="clearfix"></div>
                                <ul class="listque project-list-details">
                                    <li>
                                        <label>Category</label>
                                        <p>
                                            <?php echo $projectd->category_name?>
                                        </p>
                                    </li>
                                    <li>
                                        <label>Sub-Category</label>
                                        <p>
                                            <?php echo $projectd->sub_cat_name?>
                                        </p>
                                    </li>
                                   
                                    <?php
                                    $trlOptionsHtml = array();
                                    $trlQutionAns = array();
                                    if(!empty($trlquestionans)){

                                       
                                        foreach($trlquestionans as $key => $trlqans){
                                            $trlQutionAns[$trlqans->questionID] = $trlqans->qanswer;
                                            foreach($trlquestion as $key => $qe){
                                                if($qe->trlQuestionID == $trlqans->questionID && !empty($qe->ansGuide)){
                                                    $trlQutionAns[$trlqans->questionID."_guide"] = 'Guide : '.$qe->ansGuide.'';
                                                    break;
                                                }
                                                
                                            }
                                            
                                            
                                        }
                                    //    print "<pre>";
                                    //     print_r($trlquestion);
                                    //     print_r($trlQutionAns);
                                    //    exit;
                                    }
                              
                                    for($trLevels=1;$trLevels<5;$trLevels++){
                                        $i=1;
                                        $trlHtml = '';
                                       
                                        foreach($trlquestion as $key => $trlq){
                                           
                                                if($trlq->trlLevelID ==$trLevels){
                                                    $questionid=$trlq->trlQuestionID;
                                                    $anstype=$trlq->ansType;
                                                    
                                                if($anstype =='text'){
                                                    echo '<li>';
                                                     echo '<h6 class="question">'.$trlq->qName.'</h6>';
                                                    if(isset($trlQutionAns[$trlq->trlQuestionID])){
                                                        echo "<p style='padding-top: 0px;padding-left:23px;'>".$trlQutionAns[$trlq->trlQuestionID]."</p>";
                                                    }else{
                                                        echo "<p>Ans: Not Answered</p>";
                                                    }
                                                    if(isset($trlq->ansGuide) && !empty($trlq->ansGuide)){
                                                        echo '<p class="guide left"> Guide:'.$trlq->ansGuide.'</p>';
                                                    }
                                                    echo '</li>';
                                                    
                                                }else{
                                                    echo '</li>';
                                                    if($anstype =='option'){
                                                        $trlHtml .='<li><h6 class="question">Q. '.$i++.' '.$trlq->qName.'</h6>';
                                                        if(isset($trlQutionAns[$trlq->trlQuestionID])){
                                                            $trlHtml .= "<p style='padding-left:23px;'> Ans:".$trlQutionAns[$trlq->trlQuestionID]."</p>";
                                                        }else{
                                                            $trlHtml .= "<p style='padding-left:23px;' class='guide'>Ans: Not Answered</p>";
                                                        }
                                                        // conver json string to json object
                                                        if(isset($trlq->qoptions) && !empty($trlq->qoptions)){
                                                            $optionGide = json_decode($trlq->qoptions);
                                                            if(isset($trlQutionAns[$trlq->trlQuestionID]) && !empty($trlQutionAns[$trlq->trlQuestionID])){
                                                                foreach ($optionGide as $key => $qoption) {
                                                                    if(trim($qoption->optionName) == trim($trlQutionAns[$trlq->trlQuestionID])){
                                                                        
                                                                        if(isset($qoption->optGuide) && !empty($qoption->optGuide)){

                                                                            $trlHtml .= "<p class='guide' style='margin-top: -12px;'> Ans Guide: ".$qoption->optGuide."</p>";
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        $trlHtml .= "</li>";
                                                        
                                                        echo '</li>';
                                                        
                                                    }
                                                }
                                                
                                            }
                                            
                                        }
                                        
                                        $trlOptionsHtml[$trLevels] = $trlHtml;
                                    }
                                    ?>
                          

                                    <?php if(!empty($projectd->technicalDescription) && !empty($projectd->technicalDescription) && !empty($projectd->keywords)){ //if( $projectd->phaseTwoDataSubmited == '1'){ ?> 
                                    <li>
                                        <h6 class="question">Abstract</h6>
                                        <p>
                                            <?php echo $projectd->projectDiscription?>
                                        </p>
                                    </li>
                                    <li>
                                        <h6 class="question">Technical Description</h6>
                                        <p>
                                            <?php echo $projectd->technicalDescription?>
                                        </p>
                                    </li>
                                    <li>
                                    <h6 class="question">Keywords</h6>
                                        <p>
                                            <?php echo $projectd->keywords?>
                                        </p>
                                    </li>
                                    
                                    <li>
                                        
                                            <?php 
                                            if($projectd->patentFiled=='1'){
                                                if( $projectd->patentStatus =='Approved' || $projectd->patentStatus =='Rejected'||$projectd->patentStatus =='Decline'){
                                                     ?>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 class="question">Patent status</h6>
                                                            <p><?php echo $projectd->patentStatus; ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6 class="question">Application Number</h6>
                                                            <p><?php echo $projectd->patentApplicationNumber; ?></p>
                                                        </div>
                                                    </div>
                                               <?php }
                                                else{?>
                                                    <label>Patent status</label>
                                                    <p><?php echo $projectd->patentStatus; ?></p>
                                               <?php }
                                            }else{?>
                                                <label>Patent status</label>
                                                <p><?php echo "No"; ?></p>
                                                
                                          <?php  }?>
                                
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="trlquestion" role="tabpanel" aria-labelledby="trlquestion-tab">
                            <?php foreach($trlOptionsHtml as $trLevel=>$trlHtml){
                            ?>
                            <div class="leve1 questionDetails">
                                <h4 class="SectionTitle">TRL Level
                                    <?php echo $trLevel;?>
                            </h4>
                                <ul class="listque" style="padding-left:0px">
                                    <?php echo $trlHtml; ?>
                                </ul>
                            </div>
                            <?php }
                           ?>
                        </div>
                        <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                            <div class="leve4 questionDetails">
                                <span class="SectionTitle">
                                    <div class="leve4 questionDetails">

                                        <?php 
                                        $attachmentAvailable = false;
                                        ?>
                                        <span class="SectionTitle SectionTitle-trl4">TRL Level 4</span>
                                        <ul class="listque" style="padding-left:0px">
                                        <?php 
                                        if(!empty($trlquestionans)){
                                        $i=1;

                                            foreach($trlquestion as $key => $trlq){
                                                $questionText = "";
                                                if($trlq->trlLevelID =='4'){
                                                $questionid=$trlq->trlQuestionID; 
                                                //echo $questionid;
                                                $questionName=$trlq->qName; 
                                                $trlans = $trlq->ansType;
                                                
                                                if($trlans == 'file'){
                                                    echo "<li>";
                                                    echo "<h6 class='question'>".$i.". ".$questionName."</h6>";
                                                    $i++;
                                                }
                                                $anstype=$trlq->ansType;
                                                //echo $questionName;
                                                if($anstype =='file' && empty($trlquestionans->docName)){
                                                    echo '<p class="guide">Guide:'.$trlq->ansGuide.'</p>';
                                                } 
                                               
                                        ?>
                                        <?php
                                           
                                                foreach($trlquestionans as $key => $trlqans){
                                                    //echo $trlqans->qanswer;
                                                    $ansid = $trlqans->questionID;
                                                    //echo $ansid;
                                                    if($questionid==$ansid)
                                                    {
                                                        //echo $questionText;
                                                        if(!empty($trlqans->docName)){
                                                            $attachmentAvailable = true;  
                                                            ?>
                                                            <p style="padding-left:23px;">
                                                                <a target="_blank" href="<?php echo base_url()."/images/studentFiles/".$projectd->sparkleID."/".$trlqans->docName; ?>">
                                                                <?php echo $trlqans->docName; ?>
                                                                </a>
                                                            </p>
                                                        <?php
                                                        }
                                                          
                                                    }
                                                }
                                            
                                            }
                                            echo "</li>";
                                        }
                                        ?>
                                        </ul>
                                        <?php 
                                            if(!empty($projectd->leanCanvas)){
                                                $attachmentAvailable= true;
                                            ?> 
                                            
                                            <div class="ansDetails">
                                                <label for="">Lean Canvas</label>
                                                <p> <a  href="<?php echo base_url()?>images/studentFiles/<?php echo $projectd->sparkleID; ?>/<?php echo $projectd->leanCanvas; ?>" target="_blank" ><?php echo $projectd->leanCanvas?></a> </p>
                                            </div>
                                            <?php } 
                                                if(!empty($projectd->valuePropositionCanvas)){
                                                    $attachmentAvailable= true;
                                            ?>
                                            <div class="ansDetails">
                                                <label for="">Value Proposition Canvas</label>
                                                <p> <a href="<?php echo base_url()?>images/studentFiles/<?php echo $projectd->sparkleID; ?>/<?php echo $projectd->valuePropositionCanvas; ?>" target="_blank" ><?php echo $projectd->valuePropositionCanvas?></a> </p>
                                            </div>
                                            <?php }
                                                if(!empty($projectd->simulationReport)){
                                                    $attachmentAvailable= true;
                                            ?>
                                            <div class="ansDetails">
                                                <label for="">Simulation Report</label>
                                                <p> <a href="<?php echo base_url()?>images/studentFiles/<?php echo $projectd->sparkleID; ?>/<?php echo $projectd->simulationReport; ?>" target="_blank" ><?php echo $projectd->simulationReport?></a> </p>
                                            </div>
                                           <?php } 
                                            if(!empty($projectd->prototypeProgressVideo)){
                                                $attachmentAvailable= true;
                                           ?>
                                            <div class="ansDetails">
                                                <label for="">Prototype Progress Video</label>
                                                <p> <a href="<?php echo base_url()?>images/studentFiles/<?php echo $projectd->sparkleID; ?>/<?php echo $projectd->prototypeProgressVideo; ?>" target="_blank" ><?php echo $projectd->prototypeProgressVideo?></a> </p>
                                                <?php if(!empty($projectd->prototypeProgressVideo2)){
                                                    echo '<p> <a href="'.base_url().'images/studentFiles/'.$projectd->sparkleID.'/'.$projectd->prototypeProgressVideo2.'" target="_blank" >'.$projectd->prototypeProgressVideo2.'</a> </p>';
                                                }?>
                                                
                                            </div>
                                            <?php } }  ?>
                                      
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 detail-hide for-msg" style="padding-right: 30px;padding-top:18px;">
                <div class="row helpful-section1 noFooter1 team1">
                    <div class="my-team">
                        <div class="para1">
                            <div class="my-teamh team-mobile">
                                <span>Add New Member </span>
                                <p>(Max 4 member)</p>
                            </div><br>
                            <form id="memberDetail" action="<?php echo base_url();?>student/addMemberDetails"
                                method="post" onsubmit="return false">
                                <input type="hidden" class="form-control" name="projettid" id="projectid"
                                    placeholder="Enter projectid" value="<?php echo $projectd->projectID?>">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="lab-size lab-size1">Member Mobile Number*</label>
                                        <input type="text" class="form-control typeahead type-mobile" name="contact"
                                            id="contact" placeholder="Enter Mobile No." />
                                        <div class="contactNumber"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="lab-size lab-size2">Designation</label>
                                        <div class="form-check" style="font-size: 16px;">
                                            <input class="form-check-input" type="radio" name="member" id="teamMember"
                                                value="Team Member" checked>
                                            <label class="form-check-label member1" for="teamMember">
                                                Team Member
                                            </label>
                                        </div>
                                        <!-- <div class="form-check" style="font-size: 16px;">
                                            <input class="form-check-input" type="radio" name="member" id="mentor"
                                                value="Mentor">
                                            <label class="form-check-label member2" for="mentor">
                                                Mentor
                                            </label>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group" style="margin-top: 10px;">
                                        <input type="submit" name="loginSubmit" class="" data-act="section" onclick=""
                                            data-url="" id="sendinvitebtn" value="SEND INVITE" />
                                        <a href="#" class="btn1">&nbsp;&nbsp;CANCEL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="my-teamhide">
                            <div class="my-teamh">
                                <?php if($projectd->userID == $userid && $projectd->projectStatus!="Reject" && $projectd->phaseTwoStatus!="Reject" && $projectd->phaseThreeStatus!="Reject") { ?>
                                <span class="team-mobile">My Team </span><button class="btn2 team-mobile"><i class='bx bx-plus'></i></i></button>
                                <p id="add-max-four-members">(Max 4 member)</p>
                                <?php }
                            else echo "<span>Team Members</span>";
                            ?>
                            </div>
                            <!-- <div class="my-teamm">
                                <div class="row mentor">
                                    <div class="col-md-2 pro">
                                        <span> ST</span>
                                    </div>
                                    <div class="col-md-10">
                                            <span>S N Tripathi <a href=""><i class='bx bx-trash'></i></a> </span>
                                            <p>Mentor</p>
                                    </div>
                                </div>
                                <hr>
                            </div> -->
                            <tbody>
                                <tr>
                                    <div class="my-teaml">
                                        <div class="row">
                                            <!-- <div class="col-md-1"></div> -->
                                            <div class="col-md-12 col-12 name-icon">
                                                <span class="pro1">
                                                    <span style="text-transform: uppercase;">
                                                        <?php 
                                                        if(!empty($userp)){
                                                            $fname= $userp[0]->firstname;
                                                            $lname= $userp[0]->lastName;
                                                            
                                                            $fletter =  $fname[0];
                                                            $lletter = $lname[0];
                                                            echo $fletter.''.$lletter;
                                                        }else{
                                                        $fname= $this->session->userdata('name');
                                                        $lname= $this->session->userdata('lname');
                                                        
                                                        $fletter =  substr($fname, 0, 1);
                                                        $lletter = substr($lname, 0, 1);
                                                        echo $fletter.''.$lletter;
                                                        }
                                                ?>
                                                    </span>
                                                </span>
                                                <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                <span>
                                                    <?php echo ucwords($fname.'  '.$lname) ?>
                                                </span>
                                                
                                                <p>
                                                    <?php echo "Team Leader"; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php 
                                if(isset($memberdetails) && !empty($memberdetails)){
                                foreach($memberdetails as  $key => $mdetail) {
                                ?>
                                <tr>
                                    <div class="my-teaml">
                                        <div class="row">
                                            <!-- <div class="col-md-1"></div> -->
                                            <div class="col-md-12 col-12 name-icon">
                                                <span class="pro1">
                                                    <span style="text-transform: uppercase;">
                                                        <?php 
                                                $fname = $mdetail->firstname;
                                                $lname = $mdetail->lastName;
                                                $fletter = $fname[0];
                                                $lletter = $lname[0];
                                                echo $fletter.''.$lletter;
                                                ?>
                                                    </span>
                                                </span>
                                                <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                <span class="Uname">
                                                    <?php echo ucwords($mdetail->firstname.'  '.$mdetail->lastName) ?>
                                                </span>
                                                <?php if($projectd->userID == $userid && $projectd->projectStatus!="Reject" && $projectd->phaseTwoStatus!="Reject" && $projectd->phaseThreeStatus!="Reject") { ?>
                                                <?php if($projectd->userID == $userid) { ?>
                                                <a href="javascript:;" class="delemem" data-memID="<?php echo $mdetail->memID; ?>"
                                                   ><i class="bx bx-trash-alt"></i></a>
                                                <?php } } ?>
                                                <p>
                                                    <?php echo $mdetail->designation ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php 
                        }  } ?>
                            </tbody>
                        </div>
                        <div class="sendinvite">
                            <div class="inner-center">
                                <i class='bx bx-envelope bs-md msg-envelope'></i>
                                <p>Invitation Send Successfully!</p>
                                <input type="button" class="sent-b" value="Done">
                            </div>
                        </div>
                        <!-- <div class="sendinvite">
                            <div class="icon-box">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <div class="mess-send">
                            <p>Invitation Send Successfully!</p>
                            </div>
                            <div class="send-btn">
                                <input type="button" class="sent-b" value="Done">
                            </div>
                        </div>  -->

                        <!-- <button >Hide</button>
                        <button class="btn2">Show</button> -->
                    </div>
                </div>
                <div class="row helpful-section2 noFooter2 msg1 msg-inner">
                    <?php 
                    //$projectd->userID == $userid &&
                        if($projectd->projectStatus!="Reject" && $projectd->phaseTwoStatus!="Reject" && $projectd->phaseThreeStatus!="Reject"){
                        $this->load->view ('student/message'); 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<!--<div class="modal fade" id="deletemember" tabindex="-1" role="dialog" aria-labelledby="deletememberModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Remove Team Member?</p>
        <div class="modal-delbtn">
            <a href="">Cancel</a>
            <input type="button" class="removeMember" value="Delete">
        </div>
      </div>
    </div>
  </div>
</div>
                    -->
