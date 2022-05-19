<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div id="desktopView" class="row m-0">
            <div class="col-md-3 pt-4 helpful-section noFooter">
                <div class="div-cla" style="text-align: center; border-bottom: 1px solid #C8C8C8; margin-bottom: 2rem;">
                    <!-- <img src="" alt="no image" height="100px" width="100px"> -->
                        <div class="profile-img">
	                	 <!-- <form action="<?php echo base_url();?>/SetprofilePic" method="post" enctype="multipart/form-data" class="avatar"> -->
						    <div id="profilePic" class="mx-auto"
                            >
                            <?php 
                            //echo $userData->profilePic;exit;
                            if($userData->profilePic != ""){ ?> 
                                <img class="pro-img img-fluid" src="<?php echo base_url();?>uploads/profile_pic/<?php echo $userData->profilePic; ?>">
						       <?php } else{ ?>  
                                <img class="pro-img" src="<?php echo base_url();?>/uploads/profile_pic/no_profile.png" style="width: 53px;">
						       <?php } ?> 
                               <input type="file" name="slim[]" />
						    </div>
						    <!-- <a href="<?php //echo base_url();?>Slim"> -->
                            <!-- <button class="btn-success ml-5" type="submit">Upload now</button> -->
						    <!-- </a> -->
						    <!-- <i class="material-icons" style="">upload</i> -->
                            <!-- </form> -->
					        <!-- <button class="btn btn-link tab-btn-right" type="button" id="editProfileModalBtn">
                                <i class="material-icons" id="editIcon">edit</i>
					        </button> -->
                        </div>
                        <p style="font-family: Work Sans; font-style: normal; font-weight: 300; font-size: 36px;"><?php echo $userData->firstname .' '. $userData->lastName  ?></p>
                        <p style="font-family: Work Sans; font-style: normal; font-weight: 300; font-size: 16px; line-height: 19px;"><?php echo $userData->email ?></p>
                        <p style="font-family: Work Sans; font-style: normal; font-weight: 300; font-size: 16px; line-height: 19px;"><?php echo '+91 '. $userData->phoneNumber ?></p>
                    </div>
                    <!-- <h4>Helpful Resources</h4> -->
                    
               
                    <div class="row form-row ws-form-row m-0" style="display: block !important;">
                        <!-- <form id="updateresources" enctype="multipart/form-data" action="<?php echo base_url();?>updateResourcesProfile" method="POST"> -->
                        <form id="updateresources" class="updateresources" action="<?php echo base_url();?>updateResourcesProfile" method="post">
                            <input type="hidden" value="<?php echo $userData->userID ?>" name="userid" id="userid">
                            <div class="col-md-12 form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" placeholder="xyz@fb.com" value="<?php echo $userData->facebookUrl ?>" name="facebookUrl" id="facebookUrl">
                                <div class="validate"></div>
                            </div> 
                            <div class="col-md-12 form-group">
                                <label>Twitter ID</label>
                                <input type="text" class="form-control" value="<?php echo $userData->twitterUrl ?>" name="twitterUrl" placeholder="xyz@Twitter.com" id="twitterUrl">
                                <div class="validate"></div>
                            </div> 
                            <div class="col-md-12 form-group">
                                <label>Instagram ID</label>
                                <input type="text" class="form-control" value="<?php echo $userData->instagramUrl ?>" name="instagramUrl" placeholder="xyz@Instagram.com" id="instagramUrl">
                                <div class="validate"></div>
                            </div> 
                            <div class="col-md-12 form-group">
                                <label>LinkedIn ID</label>
                                <input type="text" class="form-control" value="<?php echo $userData->linkedInUrl ?>" name="linkedInUrl" placeholder="xyz@LinkedIn.com" id="linkedInUrl">
                                <div class="validate"></div>
                            </div> 
                            <div class="col-md-4 form-group">
                                <input type="submit" name="updatereso" class="updatereso userNav eduDetails" href="#" data-act="section" data-url="eduDetails" id="updatereso" value="UPDATE"/>
                            </div>
                        </form> 
                </div> 
                </form> 
            </div>
            <div class="col-md-9">
                <div class="full-left noFooter">
                    <ul class="nav nav-tabs nav-tabs-c" id="myTab" role="tablist">
                        <li class="nav-item nav1 mobileViewDetails">
                            <a class="nav-link" id="profileM-tab" data-toggle="tab" href="#ProfileDetailsM" role="tab" aria-controls="ProfileDetailsM" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="EducationalDetails-tab" data-toggle="tab" href="#EducationalDetails" role="tab" aria-controls="EducationalDetails" aria-selected="true">Educational Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ReferenceDetail-tab" data-toggle="tab" href="#ReferenceDetail" role="tab" aria-controls="ReferenceDetails" aria-selected="false">Reference Details</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="mobileViewDetails tab-pane fade show" id="ProfileDetailsM" role="tabpanel" aria-labelledby="ProfileDetailsM-tab">
                        <div class="tab-body">
                            <div class="div-cla" style="text-align: center; border-bottom: 1px solid #C8C8C8; margin-bottom: 2rem;">
                            <div id="profilePicMobile" class="mx-auto"
                            >
                            <?php 
                            //echo $userData->profilePic;exit;
                            if($userData->profilePic != ""){ ?> 
                                <img class="pro-img img-fluid" src="<?php echo base_url();?>uploads/profile_pic/<?php echo $userData->profilePic; ?>">
						       <?php } else{ ?>  
                                <img class="pro-img" src="<?php echo base_url();?>/uploads/profile_pic/no_profile.png" style="width: 53px;">
						       <?php } ?> 
                               <input type="file" name="slim[]" />
						    </div>
                                <p class="pro-p1" style="font-family: Work Sans; font-style: normal; font-weight: 300; font-size: 36px;"><?php echo $userData->firstname .' '. $userData->lastName  ?></p>
                                <p style="font-family: Work Sans; font-style: normal; font-weight: 300; font-size: 16px; line-height: 19px;"><?php echo $userData->email ?></p>
                                <p style="font-family: Work Sans; font-style: normal; font-weight: 300; font-size: 16px; line-height: 19px;"><?php echo '+91 '. $userData->phoneNumber ?></p>
                            </div>
                            <div class="row form-row ws-form-row m-0" style="display: block !important;">
                                <form id="updateresources" class="updateresources" action="<?php echo base_url();?>updateResourcesProfile" method="post">
                                    <input type="hidden" value="<?php echo $userData->userID ?>" name="userid" id="userid">
                                    <div class="col-md-12 form-group">
                                        <label>Facebook</label>
                                        <input type="text" class="form-control" placeholder="xyz@fb.com" value="<?php echo $userData->facebookUrl ?>" name="facebookUrl" id="facebookUrl">
                                        <div class="validate"></div>
                                    </div> 
                                    <div class="col-md-12 form-group">
                                        <label>Twitter ID</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->twitterUrl ?>" name="twitterUrl" placeholder="xyz@Twitter.com" id="twitterUrl">
                                        <div class="validate"></div>
                                    </div> 
                                    <div class="col-md-12 form-group">
                                        <label>Instagram ID</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->instagramUrl ?>" name="instagramUrl" placeholder="xyz@Instagram.com" id="instagramUrl">
                                        <div class="validate"></div>
                                    </div> 
                                    <div class="col-md-12 form-group">
                                        <label>LinkedIn ID</label>
                                        
                                        <input type="text" class="form-control" value="<?php echo $userData->linkedInUrl ?>" name="linkedInUrl" placeholder="xyz@LinkedIn.com" id="linkedInUrl">
                                        <div class="validate"></div>
                                    </div> 
                                    <div class="col-md-4 form-group">
                                        <input type="submit" name="updatereso" class="updatereso userNav eduDetails" href="#" data-act="section" data-url="eduDetails" id="updatereso" value="UPDATE"/>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                        <div class="tab-pane fade show active" id="EducationalDetails" role="tabpanel" aria-labelledby="EducationalDetails-tab">
                            <div class="tab-body">
                            <form id="updateEduProfile" class="updateEduProfile dask-updateEduProfile" action="<?php echo base_url();?>updateEducationalProfile" enctype="multipart/form-data" method="post">
                                <div class="row p-4">
                                    <input type="hidden" value="<?php echo $userData->userID ?>" name="userid" id="userid">
                                    <div class="col-md-4 form-group">
                                        <label>State*</label>
                                        <select class="form-control replaceState" data-action="<?php base_url();?>getCollege" id="state_id" name="state_id">
                                        <option value="" disabled selected>Select State</option>
                                        <?php foreach ($userState as $key => $ustate) {?>
                                            <option <?php if($ustate->state_id==$userData->state_id){echo "selected";} ?> value="<?php echo $ustate->state_id; ?>"><?php echo $ustate->state_name; ?></option>
                                       
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>College*</label>
                                        <select class="form-control replacecollege" data-action="<?php base_url(); ?>getCity" name="college" id="collegel">
                                            <?php
                                            $whereCollege=array("status ="=>"'active'","state_id="=>$userData->state_id);
                                            $msterclg=$this->CommonModel->GetMasterListDetails('college_id,college_name',"master_college",$whereCollege,'','',$join=array(),$other=array());
                                            //print_r($msterclg);exit;
                                            
                                            if($userData->college_id !="0"){
                                                $college_id = $userData->college_id;
                                            }else{
                                                $college_id = $userData->otherCollege;
                                            }
                                            if(!empty($msterclg))
                                            {
                                                foreach ($msterclg as $clg) {
                                                    $selected = '';
                                                    if($college_id==$clg->college_id){
                                                        $selected = 'selected';
                                                    }else{
                                                        $selected ="";
                                                    }
                                                    echo '<option value="'.$clg->college_id.'" '.$selected.'>'.$clg->college_name.'</option>';
                                                }
                                            }
                                            ?>
                                            <option <?php if($college_id ==0) { echo "selected ";} ?>value='other'>Other</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group otherClgList <?php if($userData->college_id !=0){ echo "hide"; } ?>">
                                        <label>Enter College Name*</label>
                                        <input type="text" class="form-control" name="otherCollege" id="otherCollege" placeholder="Enter your college name" value="<?php echo $userData->otherCollege; ?>">
                                    </div>
                                    <div class="col-md-4 form-group otherCityList <?php if($userData->college_id !=0){ echo "hide"; } ?>">
                                        <label>Enter College city*</label>
                                        <input type="text" class="form-control" name="otherCity" id="otherCity" placeholder="Enter your college city" value="<?php echo $userData->otherCity; ?>">
                                    </div>
                                    <div class="col-md-4 form-group clgcity <?php if($userData->college_id ==0){ echo "hide"; } ?>">
                                        <label>City*</label>
                                        <?php  //if(isset($userData) && !empty($userData)){ echo $userData->city_name; } ?>
                                        <input type="hidden" class="form-control" name="city" id="city" value="<?php if(isset($userData) && !empty($userData)){ if($userData->city_id != "0" && $userData->otherCity ==""){ echo $userData->city_name;}elseif($userData->city_id == "0" && $userData->otherCity !=""){ echo $userData->otherCity; } } ?>" placeholder="">
                                        <input type="text" class="form-control" id="cityList" name="cityList" value="<?php if(isset($userData) && !empty($userData)){ if($userData->city_id != "0" && $userData->otherCity ==""){ echo $userData->city_name;}elseif($userData->city_id == "0" && $userData->otherCity !=""){ echo $userData->otherCity; } } ?>" style="background: transparent;" readonly/>
                                        <div class="validate"></div>
                                    </div>
                                <!-- </div> -->
                                <!-- <div class="row p-4"> -->
                                    <div class="col-md-4 form-group">
                                        <label>Degree*</label>
                                        <select class="form-control" id="degree_id" name="degree_id">
                                        <option value="" disabled selected>Select Degree</option> 
                                        <?php foreach ($userDegree as $key => $udegree) {?>
                                            <option <?php if($udegree->degree_id ==$userData->degree_id){ echo "selected"; } ?> value="<?php echo $udegree->degree_id; ?>"><?php echo $udegree->degree_name; ?></option>
                                       
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Stream*</label>
                                        <select class="form-control" id="stream_id" name="stream_id">
                                        <option value="" disabled selected>Select Stream</option>
                                        <?php foreach ($userStream as $key => $ustream) {?>
                                            <option <?php if($ustream->stream_id==$userData->stream_id){ echo "selected";} ?> value="<?php echo $ustream->stream_id; ?>"><?php echo $ustream->stream_name; ?></option>
                                       
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Year of Completion*</label>
                                       
                                        <!-- <input type="text" class="form-control" name="yearofcom" id="yearofcom" value="<?php echo $userData->yearOfCompletion ?>"> -->
                                        <select name="yearofcom" class="form-control" id="dropdownYear" onchange="getProjectReportFunc()">
                                            <option selected value=" <?php echo $userData->yearOfCompletion;?> "></option>
                                        </select>
                                    </div>
                                </div>
                                    <input type="hidden" name="identityCard" id="identityCard" value="<?php echo $userData->identityCard;?>">
                                    </form>
                                    <div class="row p-4">
                                        <div class="col-md-12">
                                            <!-- <label>College Identity Card*</label> -->
                                            <!-- <input type="file" id="id_img" class="form-control" name="img"> -->
                                                <div class="cla-img">
                                                    <label>College Identity Card*</label>
                                                    
                                                    <div id="icard-file-holder" style="<?php if(empty($userData->identityCard)){ echo 'display:none'; }?>">
                                                        <a href="<?php echo base_url().'/uploads/student_icards/'.$userData->identityCard;?>" target="_blank" id="icard-file"><?php echo $userData->identityCard;?></a>
                                                        <span data-trlqansid="21" data-questionid="101" class="removeCardFiles">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </span>
                                                    </div>
                                                    
                                                    <p>Upload a scanned copy of your college/university identity card picture.</P>
                                                    <div class="" id="reg-icard">
                                                        <form id="frm-card-file" action="<?php echo base_url();?>student/register/uploadfile" method="POST" autocomplete="off" onsubmit="return false;">
                                                            <input type="file" name="cardfile" id="cardfile">
                                                        </form>
                                                    </div>
                                                    <p>Allowed formats are .png .jpeg and .pdf</p>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row p-4">
                                        <div class="col-md-4 form-group">
                                            <input type="button" name="saveuser" class="eduDetails dash-save" href="#" data-act="section" data-url="eduDetails" id="saveuser" onClick="" value="UPDATE"/>
                                        </div>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </div>

                          <div class="tab-pane fade" id="ReferenceDetail" role="tabpanel" aria-labelledby="ReferenceDetails-tab">
                            <div class="tab-body">
                            <form id="updateRefProfile" class="updateRefProfile" action="<?php echo base_url();?>updateReferenceProfile" method="post" autocomplete="off" onsubmit="return false;">
                            <h5>Please fill details of any two references from your college</h5>
                            <h5>Reference 1</h5>
                            <input type="hidden" value="<?php echo $userData->userID ?>" name="userid" id="userid">
                                <div class="row p-4">
                                    <div class="col-md-4 form-group">
                                        <label>First Name*</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->ref1FirstName ?>" maxlength="100" name="ref1_fname" id="ref1_fname">
                                       
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Last Name*</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->ref1LastName ?>" maxlength="100" name="ref1_lname" id="ref1_lname">
                                    </div>
                                    <div class="col-md-4 form-group email-txt1">
                                        <label>Email ID*</label>
                                        <input type="email" class="form-control" value="<?php echo $userData->ref1Email ?>"maxlength="100"  name="ref1_email" id="ref1_email">
                                    </div>
                                </div>
                                <div class="row p-4">
                                    <div class="col-md-4 form-group">
                                        <label>Personal Contact No.*</label>
                                        <input type="text" class="form-control"  pattern="[6789][0-9]{9}" title="Please Enter valid Mobile Number" value="<?php echo $userData->ref1ConcatNo ?>"  name="ref1_phone" id="ref1_phone">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Designation*</label>
                                        <!-- <input type="text" class="form-control" value="<?php echo $userData->ref1Designation ?>" name="ref1_designation" id="ref1_designation"> -->
                                        <select name="ref1_designation" id="ref1_designation">
                                            <option <?php if($userData->ref1Designation == "TPO"){ echo "selected"; } ?> value="TPO">TPO</option>
                                            <option <?php if($userData->ref1Designation == "Mentor"){ echo "selected"; } ?> value="Mentor">Mentor</option>
                                            <option <?php if($userData->ref1Designation == "Professor"){ echo "selected"; } ?> value="Professor">Professor</option>
                                            <option <?php if($userData->ref1Designation == "Principal"){ echo "selected"; } ?> value="Principal">Principal</option>
                                        </select>
                                    </div>
                                </div>
                                <h5>Reference 2</h5>
                                <div class="row p-4">
                                    <div class="col-md-4 form-group">
                                        <label>First Name*</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->ref2FirstName ?>" maxlength="100" name="ref2_fname" id="ref2_fname">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Last Name*</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->ref2LastName ?>" maxlength="100" name="ref2_lname" id="ref2_lname">
                                    </div>
                                    <div class="col-md-4 form-group email-txt1">
                                        <label>Email ID*</label>
                                        <input type="email" class="form-control" value="<?php echo $userData->ref2Email ?>" maxlength="100" name="ref2_email" id="ref2_email">
                                    </div>
                                </div>
                                <div class="row p-4">
                                    <div class="col-md-4 form-group">
                                        <label>Personal Contact No.*</label>
                                        <input type="text" class="form-control" value="<?php echo $userData->ref2ContactNo ?>" maxlength="100" name="ref2_phone"  pattern="[6789][0-9]{9}" title="Please Enter valid Mobile Number" id="ref2_phone">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Designation*</label>
                                        <!-- <input type="text" class="form-control" value="<?php echo $userData->ref2Designation ?>" name="ref2_designation" id="ref2_designation"> -->
                                        <select name="ref2_designation" id="ref2_designation">
                                            <option <?php if($userData->ref2Designation == "TPO"){ echo "selected"; } ?> value="TPO">TPO</option>
                                            <option <?php if($userData->ref2Designation == "Mentor"){ echo "selected"; } ?> value="Mentor">Mentor</option>
                                            <option <?php if($userData->ref2Designation == "Professor"){ echo "selected"; } ?> value="Professor">Professor</option>
                                            <option <?php if($userData->ref2Designation == "Principal"){ echo "selected"; } ?> value="Principal">Principal</option>
                                        </select>
                                    </div>
                                </div>
                                    </div>
                                    <div class="row p-4">
                                        <div class="col-md-4 form-group">
                                            <input type="submit" name="updaterefuser" class="userNav eduDetails" href="#" data-act="section" data-url="eduDetails" id="updaterefuser" value="UPDATE"/>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="tab-body">
                                <div class="row p-4">
                                        <div class="col-md-4 form-group">
                                            <label>Project Name*</label>
                                            <input type="text" class="form-control" name="" id="" placeholder="Enter Project Name">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Category*</label>
                                            <select class="form-control">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Sub-Category*</label>
                                            <input type="text" class="form-control" name="qAnswer" id="qAnswer" placeholder="Enter your email">
                                        </div>
                                    </div>
                                </div>
                        </div> -->
                        <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...  3</div> -->
                    </div>
                </div>
            </div>

        
    </div>
</main>