<style>
    #eva-headBar,#incu-headBar{
        display: none !important;
    }
</style>
<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <!-- <div class="header-register">
                <div class="back">
                    <a href="<?php echo base_url(); ?>jury/dashboard" class="process-section home" data-act="url" data-url="<?php echo base_url(); ?>jury/dashboard"><i class="icofont-simple-left"></i> <span class="home-link">Back</span></a>
                </div>
            </div> -->
            <div class="col-md-12 project">
                
                <div class="full-left noFooter">
                    <div class="section-nav d-flex justify-content-end">
                        <div class="status">
                            <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail == "incubator"){
                                $userID = $this->session->userdata('userId');
                                $whereCnd = array("projectID ="=>$projectd->projectID, "userID = "=>$userID);
                                $incubated = $this->CommonModel->GetMasterListDetails("userID",'project_incubation',$whereCnd,'','','','');
                                if(empty($incubated)){
                                ?>
                              <div class="incubateBtn">
                                    <button type="button" class="incubateSelect actionBtn" data-id="<?= $projectd->projectID ?>" data-value="Remove">Incubate</button>
                                </div>
                                <?php }else{  //echo  $projectd->projectID; ?>
                                    <div class="incubateBtn">
                                    <button type="button" class="incubateRemove actionBtn" data-id="<?= $projectd->projectID ?>" data-value="Select">Remove</button>
                                </div>
                                
                           <?php  }  } } ?>
                        </div>
                       
                    </div>
                    <?php //$submitedReview = true;
                     $showEvaluationPanel = false;
                     ?>
                    <ul class="nav nav-tabs nav-tabs-c" id="myTab" role="tablist">
                        <?php if(isset($projectDetail) && !empty($projectDetail)){
                                if($projectDetail =="jury"){ ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="jurysAction-tab" data-toggle="tab" href="#jurysAction" role="tab" aria-controls="jurysAction" aria-selected="true">Jury Action</a>
                                    </li>
                            <?php }
                        }?>
                         
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail =="incubator" || $projectDetail =="Mentor" || $projectDetail =="evaluator"){ echo 'active'; } } ?>" id="project-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="true">Project Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trlquestion-tab" data-toggle="tab" href="#trlq" role="tab" aria-controls="trlquestion" aria-selected="false">TRL Questions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="document-tab" data-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="false">Documents</a>
                        </li>
                        <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail =="incubator" || $projectDetail =="Mentor"){ ?>
                        <li class="nav-item">
                            <a class="nav-link" id="teamdetail-tab" data-toggle="tab" href="#teamdetail" role="tab" aria-controls="teamdetail" aria-selected="false">Team Details</a>
                        </li>
                        <?php  } } ?>
                        <?php
                        if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail =="evaluator"){
                                if(isset($_GET['page_reference']) && $_GET['page_reference'] == 'inbox'){
                                    //if(!empty($evaluationDetails) && $evaluationDetails[0]->status == 'pending'){ 
                                      
                                        ?>
                                        <li class="nav-item">
                                                <a class="nav-link" id="evaluatorsAction-tab" data-toggle="tab" href="#evaluatorsAction" role="tab" aria-controls="evaluatorsAction" aria-selected="true">Evaluator’s Action</a>
                                            </li>
                                        <?php
                                   // }
                                }
                            }
                        }
                        ?>
                    </ul>             
                    <div class="tab-content" id="myTabContent">
                        <!-- evaluator action tab -->
                    <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail =="evaluator"){ ?>
                        <div class="tab-pane fade" id="evaluatorsAction" role="tabpanel" aria-labelledby="evaluatorsAction-tab">
                            <div class="section-criteria">
                                <form id="evaluators-details" class="" method="POST" action="<?php echo base_url(); ?>evaluator/project-details/<?php echo $projectd->projectID;?>" onsubmit="return false;">
                                    <input type="hidden" name="projectID" value="<?php echo $projectd->projectID;?>">
                                    <div class="eva-head">
                                        <p>Scoring Criteria</p>
                                        <span>Note: All fields are mandatory</span>
                                    </div>
                                    <div class="eva-score">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Market Potential/ Business Case*</label>
                                                <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                                    <select name="business" id="business">
                                                        <option value="">Select</option>    
                                                        <option value="Satisfactory">Satisfactory</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Exceptional">Exceptional</option>
                                                    </select>
                                                <?php }else{ ?>
                                                    <p><?php echo $evaluationDetails[0]->marketPotential; ?></p>
                                               <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Product Readiness/ Simulation*</label>
                                                <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                                <select name="simulation" id="simulation">
                                                    <option value="">Select</option>    
                                                    <option value="Satisfactory">Satisfactory</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Exceptional">Exceptional</option>
                                                </select>
                                                <?php }else{ ?>
                                                    <p><?php echo $evaluationDetails[0]->productReadiness; ?></p>
                                               <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Invention/ Innovation*</label>
                                                <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                                <select name="innovation" id="innovation">
                                                    <option value="">Select</option>    
                                                    <option value="Satisfactory">Satisfactory</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Exceptional">Exceptional</option>
                                                </select>
                                                <?php }else{ ?>
                                                    <p><?php echo $evaluationDetails[0]->invention; ?></p>
                                               <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Technical Process*</label>
                                                <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                                <select name="technical" id="technical">
                                                    <option value="">Select</option>    
                                                    <option value="Satisfactory">Satisfactory</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Exceptional">Exceptional</option>
                                                </select>
                                                <?php }else{ ?>
                                                    <p><?php echo $evaluationDetails[0]->technicalProcess; ?></p>
                                               <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Impact on Environment/ Society*</label>
                                                <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                                <select name="environment" id="environment">
                                                    <option value="">Select</option>    
                                                    <option value="Satisfactory">Satisfactory</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Exceptional">Exceptional</option>
                                                </select>
                                                <?php }else{ ?>
                                                    <p><?php echo $evaluationDetails[0]->impactOnEnvironment; ?></p>
                                               <?php } ?>
                                            </div>
                                        </div>
                                   
                                        <div class="row score">
                                            <div class="col-md-12">
                                                <label>Reason for this score*</label>
                                                <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                                <textarea class="form-control" rows="4" name="scorereason" id="scorereason" placeholder="Explain the reason here...."></textarea>
                                                <?php }else{ ?>
                                                    <p><?php echo $evaluationDetails[0]->reasonForScore; ?></p>
                                               <?php } ?>
                                            </div>
                                        </div>
                                        <?php if($evaluationDetails[0]->status =="pending"){ ?>
                                        <div class="score-submit">
                                            <input type="submit" value="SUBMIT" id="btn-submit-evaluation">
                                        </div>
                                        <?php }?>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } } ?>
                        <!-- evaluator action tab ends-->
                        <!-- jury actin tab -->
                        <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail =="jury"){ ?>
                            <div class="tab-pane fade show active" id="jurysAction" role="tabpanel" aria-labelledby="jurysAction-tab">
                                <div class="jurySection">
                                    <div class="jury-con">
                                        <ol>
                                            <li>The team being evaluated is between TRL 3 and TRL 5. For this stage of product/service evolution depending on the project we request you to evaluate the project. Please consider the following criteria while putting your opinion:</li>
                                        </ol>
                                        <ul>
                                            <li>Does the team have information on the final cost outline and comparison with existing alternatives?</li>
                                            <li>Has the team preseneted a plan on how scalability can be reached using networks, partnerships, etc.?</li>
                                            <li>Is the idea stand alone, does it require a policy push? Can it create a social impact?</li>
                                            <li>How easily can the user-customer experience be integrated in the current system?</li>
                                            <li>Is the idea using a Technology/Process/Business model which is aligned with the next practice?</li>
                                            <li>Is the idea distinct in its area of application or it is an imitation?</li>
                                        </ul>
                                    </div>
                                    <div class="jury-action">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Yes" data-proid="<?php echo $projectd->projectID ?>" data-id="<?php echo $projectd->sparkleID?>" name="juryYestop50" id="juryYestop50" <?php if($projectd->juryAction == "Top 10"){ echo "checked"; } ?>>
                                            <label class="form-check-label" for="juryYestop50">
                                               Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" value="No" data-proid="<?php echo $projectd->projectID ?>" data-id="<?php echo $projectd->sparkleID?>" name="juryYestop50" id="juryNotop50">
                                            <label class="form-check-label" for="juryNotop50">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="jury-btn">
                                        <input type="submit" class="jury-btn-submit" value="SUBMIT" id="btn-submit-jury">
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                        <!-- jury action tab ends -->
                        <!-- project details tab -->
                        <div class="tab-pane fade <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if($projectDetail =="incubator" || $projectDetail =="Mentor" || $projectDetail =="evaluator" ){ echo 'active show'; }}?>" id="project" role="tabpanel" aria-labelledby="project-tab">
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
                                                    
                                                    $optionHtml ='<ol> Q '.$i.'. '. $trlq->qName.'</ol>';
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
                                    <?php 
                                            if($projectd->patentFiled=='1'){
                                                if( $projectd->patentStatus =='Approved' || $projectd->patentStatus =='Rejected'||$projectd->patentStatus =='Decline'){
                                                     ?>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Patent status</label>
                                                            <p><?php echo $projectd->patentStatus; ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Application Number</label>
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
                                </ul>
                            </div>
                        </div>
                        <!-- project details tab ends-->
                       <!-- trl question tab -->
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
                        <!-- trl question tab ends -->
                            <!-- document tab -->
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
                        <!-- document tab end -->
                        <!-- team member tab -->
                        <?php if(isset($projectDetail) && !empty($projectDetail)){
                            if(($projectDetail =="incubator") || ($projectDetail =="Mentor")){ ?>
                        <div class="tab-pane fade" id="teamdetail" role="tabpanel" aria-labelledby= "teamdetail-tab">
                            <ul class="teammember-list-details">
                                <li>
                                    
                                    <label>Team Lead Name</label>
                                    <p><?php echo ucfirst($userTeam[0]->firstname).'  '.ucfirst($userTeam[0]->lastName)?></p>
                                    <label>Contact Number</label>
                                    <p><?php echo $userTeam[0]->phoneNumber?></p>
                                    <label>Email ID</label>
                                    <p><?php echo $userTeam[0]->email?></p>
                                </li>
                                <?php if(!empty($memberdetails)){ 
                                    foreach($memberdetails as  $listdetail) { ?>
                                <li>
                                   
                                    <label>Team Member Name</label>
                                    <p><?php echo ucfirst($listdetail->firstname).'  '.ucfirst($listdetail->lastName) ?></p>
                                    <label>Contact Number</label>
                                    <p><?php echo $listdetail->phoneNumber?></p>
                                    <label>Email ID</label>
                                    <p><?php echo $listdetail->email?></p>
                                     
                                </li>
                                <?php } }  ?>  
                            </ul>
                        </div>
                        <?php } } ?>
                        <!-- team member tab end -->
                    </div>
                    </div>
                </div>
        </div>
    </div>
    <?php 
    if(isset($projectDetail) && !empty($projectDetail)){
        if($projectDetail =="evaluator"){
    $this->load->view ('student/message'); 
         }
         } ?>
  </main>

  <!-- Modal -->
<div class="modal fade" id="jurytop10" tabindex="-1" role="dialog" aria-labelledby="jurytop10Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p class="jurymodal-title">Add to top 10?</p>
        <p class="jurymodal-description"></p>
        <div class="jurytop10Btn">
            <a href="" data-dismiss="modal">NO</a>
            <input type="submit" class="sendinTop10" data-dismiss="modal" value="YES">
        </div>
      </div>
    </div>
  </div>
</div>
  