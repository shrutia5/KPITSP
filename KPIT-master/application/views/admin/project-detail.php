<main id="portal">
    <input type="hidden" id="projectid" value="<?php echo $projectd->projectID?>">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-12 project">
                <div class="full-left noFooter">
                    <div class="section-nav d-flex justify-content-between">
                        <!-- <div class="back">
                            <a href="<?php echo base_url()?>/admin/dashboard"> <span><i class='bx bx-chevron-left'></i></span> Back to Dashboard</a>
                        </div> -->
                        <!-- <div class="status">
                            <span>Status:</span> TRL 2 - Solution is pending
                        </div> -->
                    </div>
                    <ul class="nav nav-tabs nav-tabs-c" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="project-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="true">Project Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trlquestion-tab" data-toggle="tab" href="#trlq" role="tab" aria-controls="trlquestion" aria-selected="false">TRL Questions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="document-tab" data-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="false">Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="teamdetail-tab" data-toggle="tab" href="#teamdetail" role="tab" aria-controls="teamdetail" aria-selected="false">Team Details</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="project" role="tabpanel" aria-labelledby="project-tab">
                            <div class="tab-body">
                                <label><?php echo $projectd->sparkleID?></label>
                                <h3 class="norma"><?php echo $projectd->projectName?></h3>
                                <!--<br/>
                               <a href="#"><i class="icofont-play-alt-2"></i>&nbsp;&nbsp;Play Prototype</a>-->
                                <div class="clearfix"></div>
                                <ul class="project-list-details">
                                    <li>
                                        <label>Category</label>
                                        <p><?php echo $projectd->category_name?></p>
                                    </li>
                                    <li>
                                        <label>Sub-Category</label>
                                        <p><?php echo $projectd->sub_cat_name?></p>
                                    </li>
                                   
                                    <?php
                                    $attachmentHtml = "";
                                    $trlOptionsHtml = array();
                                    
                                    if(!empty($trlqueans)){
                                        $trlLevel = 0;
                                        
                                        foreach($trlqueans as $key => $trlqans){
                                            $trlQutionAns[$trlqans->questionID] = '<p>Ans: '.$trlqans->qanswer.'</p> ';
                                        }
                                        $i = 1;
                                        foreach($trlquestion as $key => $trlq){
                                            
                                            if($trlLevel !=$trlq->trlLevelID){
                                                $trlLevel = $trlq->trlLevelID;
                                                $trlOptionsHtml[$trlq->trlLevelID] = "";
                                                $i = 1;
                                            }

                                            $questionid=$trlq->trlQuestionID;
                                            $anstype=$trlq->ansType;
                                            if($anstype =="text"){
                                                echo '<li><label>'.$trlq->qName.'</label>';
                                                if(isset($trlQutionAns[$trlq->trlQuestionID])){
                                                    echo '<p>'.$trlQutionAns[$trlq->trlQuestionID].'</p>';
                                                }else{
                                                    echo '<p>Ans: No Answer</p>';
                                                }

                                                echo '</li>';
                                            }
                                            else{
                                                
                                                if($anstype == "option"){
                                                    
                                                    $optionHtml = '<ol>'.$trlq->qName.'</ol>';
                                                    if(isset($trlQutionAns[$trlq->trlQuestionID])){
                                                        $optionHtml .= $trlQutionAns[$trlq->trlQuestionID];
                                                    }else{
                                                        $optionHtml .= '<p>No Answer</p>';
                                                    }
                                                    $trlOptionsHtml[$trlq->trlLevelID] .= $optionHtml;
                                                    $i++;
                                                }else{
                                                    foreach($trlqueans as $key => $trlqans){
                                                        if($questionid==$trlqans->questionID){
                                                            $attachmentHtml .= '<ol>'.$trlq->qName.'</ol><p><a href="'.base_url().'/images/studentFiles/'.$projectd->sparkleID.'/'.$trlqans->docName.'" target="_blank">'.$trlqans->docName.'</a></p>';
                                                        }
                                                    }
                                                    
                                                }
                                            }
                                            ?>
                                        
                                        <?php 
                                        }
                                    }else{
                                        echo "<br> No Question";
                                    }
                                    ?>
                                    <li>
                                        <label>Abstract</label>
                                        <p><?php echo $projectd->projectDiscription?></p>
                                    </li>
                                    <li>
                                        <label>Technical Description</label>
                                        <p><?php echo $projectd->technicalDescription; ?></p>
                                    </li>
                                    <li>
                                        <label>Keywords</label>
                                        <p><?php echo $projectd->keywords; ?></p>
                                    </li>
                                    <li>
                                        <label>Patent Status</label>
                                        <p>
                                            <?php 
                                            if($projectd->patentFiled=='1'){
                                                echo $projectd->patentStatus;
                                            }else{
                                                echo "No";
                                            }?>
                                        </p>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="trlq" role="tabpanel" aria-labelledby= "trlquestion-tab">
                            <div class="tab-body">
                                <?php
                                
                                foreach($trlOptionsHtml as $trlLevel=>$trlLevelHtml){
                                    echo '<div class="leve'.$trlLevel.' questionDetails"><span class="SectionTitle">TRL Level '.$trlLevel.'</span>'.$trlLevelHtml.'</div>';
                                }
                                ?>
                           </div>
                           <div class="que_border"></div>
                        </div>
                        <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby= "document-tab">
                            <div class="tab-body leve4 questionDetails">
                                <?php 
                                if(!empty($attachmentHtml)){
                                if(!empty($attachmentHtml)){ ?>
                                <span class="SectionTitle">Phase-I</span>
                                <?php 
                                echo $attachmentHtml; 
                                }else{
                                    echo "no img";
                                }
                                    
                                if(!empty($projectd->leanCanvas) || !empty($projectd->simulationReport)|| !empty($projectd->valuePropositionCanvas)||!empty($projectd->prototypeProgressVideo)){
                                    echo '<span class="SectionTitle">Phase-II</span>';
                                }
                                if($projectd->leanCanvas!=""){
                                    echo '<p>Lean Canvas <br/><a href="'.base_url().'/images/studentFiles/'.$projectd->sparkleID.'/'.$projectd->leanCanvas.'" target="_blank">'.$projectd->leanCanvas.'</a></p>';
                                }
                                if($projectd->simulationReport!=""){
                                    echo '<p>Simulation Report <br/><a href="'.base_url().'/images/studentFiles/'.$projectd->sparkleID.'/'.$projectd->simulationReport.'" target="_blank">'.$projectd->simulationReport.'</a></p>';
                                }
                                if($projectd->valuePropositionCanvas!=""){
                                    echo '<p>Value Proposition Canvas <br/><a href="'.base_url().'/images/studentFiles/'.$projectd->sparkleID.'/'.$projectd->valuePropositionCanvas.'" target="_blank">'.$projectd->valuePropositionCanvas.'</a></p>';
                                }
                                if($projectd->prototypeProgressVideo!=""){
                                    echo '<p>Prototype Progress Video <br/><a href="'.base_url().'/images/studentFiles/'.$projectd->sparkleID.'/'.$projectd->prototypeProgressVideo.'" target="_blank">'.$projectd->prototypeProgressVideo.'</a>';
                                    if($projectd->prototypeProgressVideo2!=""){
                                        echo '<br/><a href="'.base_url().'/images/studentFiles/'.$projectd->sparkleID.'/'.$projectd->prototypeProgressVideo2.'" target="_blank">'.$projectd->prototypeProgressVideo2.'</a>';
                                    }
                                    echo '</p>';
                                }
                            }
                            else{ ?> 
                                <div class="row default-view no-border" style="background: #2A2A2B;">
                                                <div class="col-md-12">
                                                    <div class="default-view no-border d-md-flex align-items-center">
                                                        <div class="default-content">
                                                            <div class="fico">
                                                                <i class='bx bx-file-blank'></i>
                                                            </div>
                                                        <h3 class="mt-4" style="font-size: 24px;"> Attachment not
                                                            available</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                           <?php }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="teamdetail" role="tabpanel" aria-labelledby= "teamdetail-tab">
                            <ul class="teammember-list-details">
                                <?php if(isset($userTeam) && !empty($userTeam)){ ?>
                                <li>
                                    <label>Team Lead Name</label>
                                    <p><?php echo ucfirst($userTeam[0]->firstname).'  '.ucfirst($userTeam[0]->lastName)?></p>
                                    <label>Contact Number</label>
                                    <p><?php echo $userTeam[0]->phoneNumber?></p>
                                    <label>Email ID</label>
                                    <p><?php echo $userTeam[0]->email?></p>
                                </li>
                                <?php } ?>
                                <?php if(!empty($memberdetails) && isset($memberdetails)){ ?>
                                <li>
                                    <?php 
                                    foreach($memberdetails as  $listdetail) { ?>
                                    <label>Team Member Name</label>
                                    <p><?php echo ucfirst($listdetail->firstname).'  '.ucfirst($listdetail->lastName) ?></p>
                                    <label>Contact Number</label>
                                    <p><?php echo $listdetail->phoneNumber?></p>
                                    <label>Email ID</label>
                                    <p><?php echo $listdetail->email?></p>
                                    <?php }  ?> 
                                </li>
                                <?php }  ?>  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3 pt-4" style="padding-right: 30px;">
                <div class="row helpful-section1 noFooter1">
                <div class="my-team">
                    <div class="my-teamh">
                        <span>Team Members </span>
                    </div>
                            <tbody>
                             <?php 
                           if(!empty($memberdetails)){
                            foreach($memberdetails as  $mdetail) { ?> 
                            <tr>
                                <div class="my-teaml">   
                                    <div class="row">
                                       
                                            <div class="col-md-2 pro1">
                                                <span style="text-transform: uppercase;"><?php 
                                                $fname = $mdetail->firstname;
                                                $lname = $mdetail->lastName;
                                                $fletter = $fname[0];
                                                $lletter = $lname[0];
                                                echo $fletter.''.$lletter;
                                                ?></span>
                                            </div>
                                            <div class="col-md-10">
                                                    <span> <?php echo $mdetail->firstname.'  '.$mdetail->lastName ?></span>
                                                    <p><?php echo $mdetail->designation ?></p>
                                            </div>
                                    </div>
                                </div>
                            </tr>
                            <?php } }else{
                                echo "it does hot have team member";
                            }?>
                            </tbody>
                </div>
            </div>
            <div class="row helpful-section1 noFooter1">
            <?php  //$this->load->view ('student/message');  ?>
            </div>
        </div> -->
    </div>
    <?php  $this->load->view ('student/message');  ?>
  </main>
 