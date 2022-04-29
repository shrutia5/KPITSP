<?php
    $projectIDHtml = '';
    $currentPhase = $currentStep = 1;
    if(isset($projectdetails->projectID) && !empty($projectdetails->projectID)){
        $currentStep = $projectdetails->currentStep;
        $currentPhase = $projectdetails->currentPhase;
        $projectIDHtml ='<input type="hidden" name="projectID" value="'.$projectdetails->projectID.'">';
    } ?>
<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="row submit-hide m-0">
            <div class="d-flex">
                <div class="col-2 mt-3">
                    <a href="<?php echo base_url();?>student/dashboard"><i class="bx bxs-chevron-left bx-sm sub1"
                        style="color:#C8C8C8;"></i></a>
                    <i class="bx bxs-chevron-left bx-sm question-mark helpful-section" style="color:#C8C8C8;background:transparent"></i>
                </div>
                <div class="col-8 mt-3 text-center">
                    <h4 class="sub1">Idea Submission</h4>
                    <h4 id="help-hide">Helpful Resources</h4>
                </div>
                <div class="col-2 mt-3">
                   <i class="bx bx-question-mark sub1 question-mark" id="bx-question-mark" style="color:#8FDB00;border:1px solid #8FDB00;border-radius:20px;float:right;"></i>
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-9 col-12 trl-page">
                <div class="full-left">
                    <div class="section-tab d-flex justify-content-between">
                        <div class="tab-item active submission-tab" id="st-1">
                        <i class='bx bx-edit'></i> <span class="section-txt1">Project Details</span>
                        </div>
                        <div class="tab-item submission-tab" id="st-2">
                        <i class='bx bx-copy-alt' ></i> <span class="section-txt1">TRL Levels</span>
                        </div>
                        <div class="tab-item <?php if($currentPhase > 1){ echo 'submission-tab';}else{ echo "disabled";}?>" id="st-4"><i class='bx bx-copy-alt'></i> 
                            <span class="section-txt1">Phase 2</span>
                        </div>
                        <div class="tab-item submission-tab" id="st-3">
                        <i class='bx bx-paperclip'></i> <span class="section-txt1">Attachments</span>
                        </div>
                    </div>
                    <div class="row" style="margin: unset;">
                        <div class="alert alert-danger alert-danger-ws text-center" role="alert">
                            <?php
                                // $createDate = $projectdetails->createdDate;
                                $currentdate =  date("Y-m-d");
                                $submissionDate = $infoSetting->submissionDate;
                                
                                function dateDiff($currentdate, $submissionDate)
                                {
                                    $currentdate_ts = strtotime($currentdate);
                                    $submissionDate_ts = strtotime($submissionDate);
                                    $diff = $submissionDate_ts - $currentdate_ts;
                                    return round($diff / 86400);
                                }

                                $dateDiff = dateDiff($currentdate, $submissionDate);

                                //printf("Difference between in two dates : " . $dateDiff . " Days ");
                                //print "</br>";
                            ?>
                        <i class='bx bx-hourglass'></i> Last <?php echo $dateDiff; ?> days to submit your idea
                        </div>
                    </div>
                    <?php $secID=1; ?>
                    <section class="ideaSubmission activeSection section_<?php echo $secID;?>" data-tab="st-1">
                        <form class="" id="ideaform_<?php echo $secID++;?>" method="POST" action="<?php echo base_url(); ?>saveProject">
                            <?php if(!empty($projectIDHtml)) echo '<input type="hidden" id="projectID" name="projectID" value="'.$projectdetails->projectID.'">' ?>
                            <input type="hidden" id="currentStep" name="currentStep" value="<?php echo $currentStep;?>">
                            <input type="hidden" id="currentPhase" name="currentPhase" value="<?php echo $currentPhase;?>">
                            <div class="row p-4 field" >
                                <div class="col-12 bor-pro">
                                    <h4>Project Details</h4>
                                    <p class="sub-info"><small>Fields mark with * are mandatory.</small></p>
                                </div>
                            </div>
                            <div class="row p-4 field">
                                <div class="col-md-4 col-12 form-group name1">
                                    <label>Project Name*</label>
                                    <input type="text" class="form-control"  maxlength="255" name="projectName" id="projectName" value="<?php if(isset($projectdetails->projectName)){echo $projectdetails->projectName;} ?>" placeholder="Enter Project Name">
                                </div>
                                <div class="col-md-4 col-12 form-group name2">
                                    <label>Category*</label>
                                    <select class="form-control changeCategory" data-action="<?php base_url();?>getSubcategory" id="categoryName" name="categoryName">
                                        <option value="" disabled selected> --Select category-- </option>
                                        <?php 
                                        if(isset($userCategory)&& !empty($userCategory)){
                                            foreach ($userCategory as $key => $ucategory) {?>
                                            <option <?php if(isset($projectdetails->categoryID)&& !empty($projectdetails->categoryID)){ if($ucategory->category_id == $projectdetails->categoryID){echo "selected";} } ?> value="<?php echo $ucategory->category_id; ?>"><?php echo $ucategory->category_name; ?></option>
                                       
                                        <?php } }?>
                                    </select>
                                    <!-- <select class="form-control getsubcategory" data-action="<?php echo base_url()?>student/getSubCate" name="categoryName" id="categoryName">
                                    <option value="">--Select category--</option>
                                        <?php                                       
                                        if(isset($mstercat)&&!empty($mstercat))
                                        {
                                            foreach ($mstercat as $key => $cate) {
                                                    if(isset($projectdetails->categoryID)&& !empty($projectdetails->categoryID)){
                                                    ?>
                                                    <option <?php if($cate->category_id == $projectdetails->categoryID){ echo "selected";}?> value="<?php  echo $cate->category_id;?>"><?php echo $cate->category_name; ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?php  echo $cate->category_id;?>"><?php echo $cate->category_name; ?></option>
                                                   <?php }
                                            }
                                        }
                                        ?>
                                    </select> -->
                                </div>
                                <div class="col-md-4 col-12 form-group">
                                    <label id="sub-txt">Sub-Category*</label>
                                    <select class="form-control"  name="subCategory" id="subCategory">
                                        <?php if($projectdetails->categoryID != "")
                                        {
                                            $where_sub=array("status ="=>"'active'","category_id="=>$projectdetails->categoryID);
                                            $mstersubcat=$this->CommonModel->GetMasterListDetails('sub_cat_name,sub_cat_id',"master_sub_category",$where_sub,'','',$join=array(),$other=array());
                                            // print_r($mstercat);exit;
                                            if(!empty($mstersubcat)){
                                                foreach ($mstersubcat as $key => $subcat) {
                                                    $selected = '';
                                                    if($projectdetails->subCategoryID==$subcat->sub_cat_id){
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="'.$subcat->sub_cat_id.'" '.$selected.'>'.$subcat->sub_cat_name.'</option>';
                                                }
                                            }
                                        ?>
                                      <?php  }else{
                                        ?>
                                            <option value="">--Select Sub category--</option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <h4>Team Formation Guide</h4>
                            <p>Following members are required with respective expertise.</p>
                            <div id="expertise" name="expertise">
                            
                            <br>
                            <?php if(isset($projectdetails->categoryID) && $projectdetails->categoryID != "")
                                        {
                                            // var_dump($projectdetails->categoryID);
                                            $where_sub=array("status ="=>"'active'","category_id="=>$projectdetails->categoryID);
                                            //print_r($projectdetails->categoryID);exit;
                                            $expertise=$this->CommonModel->GetMasterListDetails("expertise","master_category",$where_sub);
                                            if(!empty($expertise)){
                                                
                                            // print_r($mstercat);exit;
                                            foreach($expertise[0] as $one){
                                            $exp = explode(",",$one);
                                            foreach($exp as $two){
                                                echo "<strong>".$two."</strong><br>";
                                            }
                                                // var_dump($one);
                                            }
                                            // var_dump($expertise);
                                            // var_dump($expertise[0]);
                                        }else{
                                            echo "Something something";
                                        }
                                            
                                        ?>
                                         <?php  }else{
                                        ?>
                                            
                                            <?php } ?>
                                          
                                      </div>
                                      
                                      <br>
                                          <br>
                            <div class="row p-4 field" id="field2" style="border-top: 1px solid #c8c8c8;">
                                <div class="col-md-12 col-12 form-group">
                                    <label>Project Description*</label>
                                    <textarea class="form-control" rows="9" name="projectDiscription" id="projectDiscription" placeholder="Explain the problem statement you are trying to solve. Minimum 250 Characters and Maximum 1000 characters"><?php if(isset($projectdetails->projectDiscription)){ echo $projectdetails->projectDiscription; }?></textarea>
                                </div>
                            </div>
                            <!-- <div class="row p-4 ">
                                <div class="col-md-12 col-12 form-group text-right">
                                <input data-action="<?php echo base_url()?>student/saveProject" type="button" name="nextButton" id="nextButton" value="Next">
                                </div>
                            </div> -->
                        </form>
                    </section>
                    <?php 
                        if(isset($trlQuestions)&&!empty($trlQuestions))
                        {
                            foreach ($trlQuestions as $key => $trlLevels) {
                                
                               
                            ?>
                            <section class="ideaSubmission section_<?php echo $secID;?>" data-tab="st-2">
                            <form class="trlforms" id="ideaform_<?php echo $secID++;?>" method="POST" action="<?php echo base_url(); ?>student/saveideaProject">
                                <?php echo $projectIDHtml; ?>
                                <ul class="listque field p-4" style="list-style: none;">
                                    <li class="form-group">
                                        <h4 class="section-title projectDetails"><?php echo $trlLevels->trl_name; ?></h4>
                                        <?php  if(isset($trlLevels->trl_description)&& !empty($trlLevels->trl_description))
                                                {
                                                    echo "<p>".$trlLevels->trl_description."</p>";
                                            } ?>
                                    </li>
                                    <?php
                                    $fileTypeQuetionsHtml = '<ul class="listque field p-4">';
                                    if(isset($trlQuestions)&&!empty($trlQuestions))
                                    {   $i=1;
                                        if(isset($trlLevels->questionList)&&!empty($trlLevels->questionList))
                                        {
                                            foreach ($trlLevels->questionList as $key => $qList) {
                                                $result = new stdClass(); // array("trlQAnsID"=>"","qanswer"=>"","fileType"=>"","docType"=>"","docName"=>"");
                                                $result->trlQAnsID="";
                                                $result->qanswer="";
                                                $result->fileType="";
                                                $result->docType="";
                                                $result->docName="";
                                                $result->questionID="";
                                                
                                                foreach ($trlDetails as $key1 => $value1) {
                                                    if($value1->questionID == $qList->trlQuestionID){
                                                     $result = $value1;
                                                     
                                                     break;
                                                    }
                                                 }    
                                                 //print_r($result);
                                                if($qList->ansType=="option")
                                                {?>
                                                    <li class="form-group radio-item" id="qdiv_<?php echo $qList->trlQuestionID; ?>">
                                                    <h6 class="question"><?=$i++?>. <?php echo $qList->qName; ?> 
                                                    <?php if($qList->isRequired=="Yes"){echo "*";} ?>
                                                </h6>
                                                    <p class="guide">
                                                        <?php 
                                                            if(!empty($qList->qGuide)){?>
                                                                Guide: <?php  echo $qList->qGuide; ?>
                                                           <?php }
                                                        ?>
                                                    </p>
                                                    <?php if(isset($qList->qoptions)&&!empty($qList->qoptions))
                                                    {
                                                        $options=json_decode($qList->qoptions);
                                                        usort($options, function($a, $b) {
                                                            return $a->sequence - $b->sequence;
                                                        });
                                                        $count2=1;
                                                        foreach ($options as $key => $opt) {?>
                                                            <div class="options">
                                                            <label class="ws-radio">
                                                            <input type="radio" required="" <?php if ($result->qanswer == $opt->optionName) { echo 'checked';}?>
                                                            name="trlQuestion_<?php echo $qList->trlQuestionID; ?>" id="<?php echo $opt->optGuide; ?>" name="fav_language" value="<?php echo $opt->optionName; ?>" onClick="onCheck(<?php echo $opt->optGuide; ?>)">
                                                            <span><?php echo $opt->optionName ?></span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                            </div>
                                                            
                                                        <?php 
                                                        }
                                                    }
                                                    ?>
                                                    </li>
                                                <?php
                                                }
                                                if($qList->ansType=="text")
                                                {?>
                                                    <li class="form-group" id="qdiv_<?php echo $qList->trlQuestionID; ?>">
                                                        <h6><?=$i++?>. <?php echo $qList->qName; ?><?php if($qList->isRequired=="Yes"){echo "*";} ?></h6>
                                                        <p class="guide">
                                                            <?php 
                                                                if(!empty($qList->qGuide)){ ?> 
                                                                 Guide: <?php  echo $qList->qGuide; ?>
                                                            <?php } ?>
                                                        </p>
                                                        <textarea placeholder="Start writing here..." <?php if($qList->isRequired=="Yes"){echo "required";} ?> class="form-control" name="trlQuestion_<?php echo $qList->trlQuestionID; ?>" id="" placeholder="Enter Project Name"><?php echo $result->qanswer;?></textarea>
                                                    </li>            
                                                <?php 
                                                }
                                                if($qList->ansType=="file")
                                                {
                                                    $isRequired = '';
                                                    $fileTypeQuetionsHtml .= '<li class="form-group" id="qdiv_'.$qList->trlQuestionID.'">';
                                                    $fileTypeQuetionsHtml .= '<h6>'.$qList->qName;
                                                    $fileRequired = '';
                                                    if($qList->isRequired=="Yes"){
                                                        $fileTypeQuetionsHtml .= '*';
                                                        $isRequired = 'required';
                                                        $fileRequired = 'file-required';
                                                    }
                                                    $fileTypeQuetionsHtml .= '</h6>';
                                                    if(!empty($qList->qGuide)){
                                                        $fileTypeQuetionsHtml .= '<p class="guide">Guide:'.$qList->qGuide.'</p>';
                                                    }
                                                    if(isset($projectdetails) && !empty($projectdetails)) {
                                                        
                                                        if (!empty($result->docName)) {

                                                        }
                                                    }
                                                    $fileTagClass = '';
                                                    $fileHtmlClass = 'hide';
                                                    if (!empty($result->docName)) {
                                                        $fileTagClass = 'hide';
                                                        $fileHtmlClass = '';
                                                    }
                                                    $fileTypeQuetionsHtml .= '<div class="file-input '.$fileTagClass.' '.$fileRequired.'"><input class="form-control loadfile" type="file" '.$isRequired.' name="trlQuestion_'.$qList->trlQuestionID.'" id="trlQuestion_'.$qList->trlQuestionID.'" data-fleSize="'.$qList->fileSize.'" data-uploadType="'.$qList->uploadType.'"></div>';
                                                    $fileTypeQuetionsHtml .= '<div class="tlfile_'.$qList->trlQuestionID.' '.$fileHtmlClass.'"><a href="'.$this->config->item("base_url").'/images/studentFiles/'.$projectdetails->sparkleID.'/'.$result->docName.'" target="_blank">'.$result->docName.'</a><span data-trlQAnsID="'.$result->trlQAnsID.'" data-questionID="'.$qList->trlQuestionID.'" class="removeTlFiles"><i class="bx bx-trash-alt" id="removelfile"></i></span></div>';
                                                    $fileTypeQuetionsHtml .= '</li>';
                                                ?>
                                            <?php 
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    </ul>
                                </form>
                            </section>
                            <?php
                            }

                        }

                        // Phase two
                        if($currentPhase > 1){
                    ?>
                    <section class="ideaSubmission section_<?php echo $secID;?>" style="display:none;" data-tab="st-4" >
                        <form class="trlforms frm-prototype" id="ideaform_<?php echo $secID++;?>" method="POST" action="<?php echo base_url(); ?>student/saveideaProject">
                        <?php if(isset($projectdetails->projectID) && !empty($projectdetails->projectID)){ ?>
                            <input type="hidden" id="projectID" name="projectID" value="<?php echo $projectdetails->projectID;?>">
                            <?php } ?>    
                            <div class="row p-4 field">
                                <div class="col-md-12 col-12 form-group">
                                    <h4>Prototype Details*</h4>
                                    <p>All these fields are mandatory</p>
                                </div>
                                <div class="col-md-12 col-12 form-group" id="attq_1">
                                    <h6>Technical Description*</h6>
                                    <textarea placeholder="Start writing here..." required="" class="form-control" name="technicalDescription" id="technicalDescription" autocomplete="off"><?php echo $projectdetails->technicalDescription;?></textarea>
                                </div>
                                <div class="col-md-12 col-12 form-group" id="attq_2">
                                    <h6>Keywords*</h6>
                                    <textarea placeholder="Start writing here..." required="" class="form-control" name="keywords" id="keywords" autocomplete="off"><?php echo $projectdetails->keywords;?></textarea>
                                </div>
                            </div>
                            <div class="row p-4 field">
                                <div class="col-md-4 col-12 form-group" id="attq_3">
                                    <h6>Patent filed?*</h6>
                                    <label class="ws-radio">
                                        <input type="radio" name="patentFiled" id="patentYes" value="1" <?php if($projectdetails->patentFiled==1) echo 'checked=""';?>>
                                        <span>Yes</span>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="ws-radio">
                                    <input type="radio" name="patentFiled" id="patentNo" value="0" <?php if($projectdetails->patentFiled==0) echo 'checked=""';?>>
                                        <span>No</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-12 form-group <?php if($projectdetails->patentFiled==0) echo 'hide';?> patent-dependent">
                                    <h6>Patent status*</h6>
                                    <select id="patentStatus" name="patentStatus">
                                        <option value="">Status</option>
                                        <option <?php if($projectdetails->patentStatus=='Approved') echo 'selected=""';?>>Approved</option>
                                        <option <?php if($projectdetails->patentStatus=='Rejected') echo 'selected=""';?>>Rejected</option>
                                        <option <?php if($projectdetails->patentStatus=='Decline') echo 'selected=""';?>>Decline</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12 form-group <?php if($projectdetails->patentFiled==0) echo 'hide';?> patent-dependent">
                                    <label>Patent Application Number*</label>
                                    <input type="text" class="form-control" name="patentApplicationNumber" id="patentApplicationNumber" value="<?php echo $projectdetails->patentApplicationNumber;?>" placeholder="Enter Patent Application Number" required="">
                                </div>
                            </div>
                            <?php
                            $leanCanvas = $projectdetails->leanCanvas;
                            $simulationReport = $projectdetails->simulationReport;
                            $prototypeProgressVideo = $projectdetails->prototypeProgressVideo;
                            $prototypeProgressVideo2 = $projectdetails->prototypeProgressVideo2;
                            $valuePropositionCanvas = $projectdetails->valuePropositionCanvas;
                            ?>
                        </form>
                    </section>
                    <?php

                    $fileTypeQuetionsHtml .= '';

                    //Lean Canvas
                    $sr_fileTagClass = '';
                    $sr_fileHtmlClass = 'hide';
                    if(!empty($leanCanvas)){
                        $sr_fileTagClass = 'hide';
                        $sr_fileHtmlClass = '';
                    }
                    $fileTypeQuetionsHtml .= '<li class="form-group" id="qdiv_leanCanvas">
                                            <h6>Lean Canvas*</h6>
                                            <div class="attfile_leanCanvas '.$sr_fileHtmlClass.'"> <a href='.$this->config->item("base_url")."/images/studentFiles/".$projectdetails->sparkleID."/".$leanCanvas.' target="_blank">'.$leanCanvas.'</a><span data-field="leanCanvas" class="removeAttFiles"><i class="bx bx-trash-alt"></i></span></div>
                                            <div class="file-input '.$sr_fileTagClass.' file-required"><input class="form-control loadfile" type="file" name="attachment_leanCanvas" id="attachment_leanCanvas" data-flesize="100000" data-uploadtype="pdf" required></div>
                                        </li>';
                    
                    
                    //Value Proposition Canvas
                    $sr_fileTagClass = '';
                    $sr_fileHtmlClass = 'hide';
                    if(!empty($valuePropositionCanvas)){
                        $sr_fileTagClass = 'hide';
                        $sr_fileHtmlClass = '';
                    }
                    $fileTypeQuetionsHtml .= '<li class="form-group" id="qdiv_valuePropositionCanvas">
                                            <h6>Value Proposition Canvas*</h6>
                                            <div class="attfile_valuePropositionCanvas '.$sr_fileHtmlClass.'"> <a href='.$this->config->item("base_url")."/images/studentFiles/".$projectdetails->sparkleID."/".$valuePropositionCanvas.' target="_blank">'.$valuePropositionCanvas.'</a><span data-field="valuePropositionCanvas" class="removeAttFiles"><i class="bx bx-trash-alt"></i></span></div>
                                            <div class="file-input '.$sr_fileTagClass.' file-required"><input class="form-control loadfile" type="file" name="attachment_valuePropositionCanvas" id="attachment_valuePropositionCanvas" data-flesize="100000" data-uploadtype="pdf" required></div>
                                        </li>';
                    
                    //Simulation Report
                    $sr_fileTagClass = '';
                    $sr_fileHtmlClass = 'hide';
                    if(!empty($simulationReport)){
                        $sr_fileTagClass = 'hide';
                        $sr_fileHtmlClass = '';
                    }
                    $fileTypeQuetionsHtml .= '<li class="form-group" id="qdiv_simulationReport">
                                            <h6>Simulation Report*</h6>
                                            <div class="attfile_simulationReport '.$sr_fileHtmlClass.'"> <a href='.$this->config->item("base_url")."/images/studentFiles/".$projectdetails->sparkleID."/".$simulationReport.' target="_blank">'.$simulationReport.'</a><span data-field="simulationReport" class="removeAttFiles"><i class="bx bx-trash-alt"></i></span></div>
                                            <div class="file-input '.$sr_fileTagClass.' file-required"><input class="form-control loadfile" type="file" name="attachment_simulationReport" id="attachment_simulationReport" data-flesize="100000" data-uploadtype="pdf" required></div>
                                        </li>';
                    
                    //Prototype Progress Video
                    $sr_fileTagClass = '';
                    $prototypeVideoTwo = 'hide';
                    $sr_fileHtmlClass = 'hide';
                    if(!empty($prototypeProgressVideo)){
                        $sr_fileTagClass = 'hide';
                        $sr_fileHtmlClass = '';
                        $prototypeVideoTwo = '';
                    }
                    $fileTypeQuetionsHtml .= '<li class="form-group" id="qdiv_prototypeProgressVideo">
                                            <h6>Prototype Progress Video*</h6>
                                            <div class="attfile_prototypeProgressVideo '.$sr_fileHtmlClass.'"> <a  href='.$this->config->item("base_url")."/images/studentFiles/".$projectdetails->sparkleID."/".$prototypeProgressVideo.' target="_blank">'.$prototypeProgressVideo.'</a><span data-field="prototypeProgressVideo" class="removeAttFiles"><i class="bx bx-trash-alt"></i></span></div>
                                            <div class="file-input '.$sr_fileTagClass.'"><input class="form-control loadfile" type="file" name="attachment_prototypeProgressVideo" id="attachment_prototypeProgressVideo" data-flesize="300000" data-uploadtype="mp4" required></div>
                                        </li>';
                    $sr_fileTagClass = '';
                    $sr_fileHtmlClass = 'hide';
                    if(!empty($prototypeProgressVideo2)){
                        $sr_fileTagClass = 'hide';
                        $sr_fileHtmlClass = '';
                        $prototypeVideoTwo = '';
                    }
                    $fileTypeQuetionsHtml .= '<li class="form-group '.$prototypeVideoTwo.'" id="qdiv_prototypeProgressVideo2">
                                            
                                            <div class="attfile_prototypeProgressVideo2'.$sr_fileHtmlClass.'"> <a  href='.$this->config->item("base_url")."/images/studentFiles/".$projectdetails->sparkleID."/".$prototypeProgressVideo2.' target="_blank">'.$prototypeProgressVideo2.'</a></div>
                                            <div class="file-input '.$sr_fileTagClass.' "><input class="form-control loadfile" type="file" name="attachment_prototypeProgressVideo2" id="attachment_prototypeProgressVideo2" data-flesize="300000" data-uploadtype="mp4"></div>
                                        ';
                    $fileTypeQuetionsHtml .= '</li></ul>';

                    }
                        if(!empty($fileTypeQuetionsHtml)){
                            if(isset($projectdetails->projectID) && !empty($projectdetails->projectID)){
                                $fileTypeQuetionsHtml .='<input type="hidden" id="projectID" name="projectID" value="'.$projectdetails->projectID.'">';
                            }
                            echo '<section class="ideaSubmission section_'.$secID.'" id="section_attachemt" data-tab="st-3"><form class="trlforms" id="ideaform_'.$secID++.'" method="POST" action="'.base_url().'student/saveideafiles">'.$fileTypeQuetionsHtml.'</form></section>';
                        }
                    ?>
                        <!-- <div class="col-md-12 form-group">
                        <input type="submit" >
                    </div> -->
                      
                </div>
            </div>
            <div class="col-md-3 col-12 pt-4 helpful-section">
                <h4  class="sub1">Helpful Resources</h4>
                <hr class="hr-helpful sub1">

                <div class="card-helpful">
                    <div class="card-body-helpful">
                         <ul class="ul-helpful">
                           <li>
                               <h5 class="h5-helpful">Idea submission</h5>
                                <p class="para-helpful">This video explains the new process of idea submission for KPIT Sparkle 2022</p>
                                <a class="link-helpful" href="https://www.youtube.com/watch?v=SQyeLY6Wldc">Watch Video</a>
                            </li>
                            <li>
                               <h5 class="h5-helpful">Sample idea form</h5>
                                <p class="para-helpful">Following are some of the sample idea submission forms of winners from past editions for your reference:</p>
                                <a class="link-helpful" href="https://sparkle.kpit.com/assets/2875Platinum.pdf">Read Now</a>
                            </li>
                            <li>
                               <h5 class="h5-helpful">Get to know about TRL levels</h5>
                                <p class="para-helpful">Get to know everything about a TRL and about the all the TRLs (1-4) in this single video</p>
                                <a class="link-helpful" href="https://youtu.be/OvE_fnAqi-k">Watch Video</a>
                            </li>
                            <li>
                               <h5 class="h5-helpful">Guide to create assured framework ppt Part 1 and 2</h5>
                                <p class="para-helpful">Get to know everything about ASSURED FRAMEWORK and how to create a presentation explaining your project adhering to the ASSURED FRAMEWORK in this video</p>
                                <a class="link-helpful" href="https://youtu.be/vxGOhD3U-J4">Part 1</a>
                                <p><a class="link-helpful" href="https://youtu.be/wDP6X2PDJAY">Part 2</a></p>
                            </li>
                        </ul>
                     </div>
                </div>
             <!-- <?php $this->load->view("student/helpfulResources");?> -->
            </div>
        </div>
    </div>
    <div class="footer-action fixed-bottom sub1">
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-9 col-12 d-flex justify-content-between">
            <input type="button" class="preNxtBtn" data-secID="1" name="prevbtn" id="prevbtn"  value="BACK">
            <input type="button" class="preNxtBtn" data-secID="1" name="nextbtn" id="nextbtn" value="NEXT"> 
            </div>
        </div>
    </div>
    </div>
    <div id="autosave-msg" class="align-items-center" style="cursor: pointer;
    position: fixed;
    bottom: 20px;
    left: 28%;
    font-weight: 400;
    background: rgb(255, 255, 255);
    padding: 4px 11px;
    z-index: 99999;
    color: rgb(0, 0, 0);
    border-radius: 3px;
    font-size: 13px;
    display: none;">KPIT Sparkle auto saves your work</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function onCheck(opt){
        // alert("hello world");
        var radio = document.getElementsByName("fav_language");
        var displayText = document.getElementById("display");
        console.log(opt.id);
        displayText.innerHTML = "Answer guide : "+opt.id;
        // alert(opt)
    }
</script>
<script>
$(document).ready(function(){
  $(".question-mark").on("click", function(){
    $(".trl-page").toggle();
    $(".helpful-section").toggle();
    $(".sub1").toggle();
    $("#help-hide").toggle();
    $("#helpful-hide").toggle();
    });
 });
</script>
