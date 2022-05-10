<main>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-5 p-0">
                <div class="logo-img">
                        <!-- <img src="<?php echo base_url();?>images/logo.png" alt=""/> -->
                    <a href="<?php echo base_url();?>" class="logo">
                        <img src="<?php echo base_url();?>images/logo.png" alt="KPIT SPARKLE">
                    </a>
                 </div>
                <section class="register register-banner d-md-flex align-items-center ">
                    <div class="logo-r">    
                        <img src="<?php echo base_url();?>images/kpitlogo.png" alt="Mobility & Energy for the Future"/> 
                        <!-- <span>
                            <div class="text-img">
                            Mobility<br> & Energy <br>for the<br> Future
                            </div>
                        </span> -->
                        <h1 class="title mt-4" data-aos="zoom-out" data-aos-delay="100">
                            KPIT Sparkle<br><span id="log5">Finalist</span>
                        </h1>
                        <h1 data-aos="zoom-out" data-aos-delay="100">
                            2022-23
                        </h1>
                        <!-- <div class="isregister mt-5">
                        <p><span id="hide1">Don't have an account?</span> <a href="<?php echo base_url();?>register">Register Now</a></p>
                        </div> -->
                        
                    </div>
                    
                </section><!-- End Hero -->
            </div>
            <div class="col-md-7 register-right">
                <div class="header-register">
                    <div class="back">
                        <a class="userNav process-section home" data-act="url" data-url="<?php echo base_url(); ?>"><i class="icofont-simple-left"></i> <span class="home-link">Home</span></a>
                        <a class="userNav process-section eduDetails" href="#" data-act="section" data-url="home"><i class="icofont-simple-left"></i> Back</a>
                    </div>
                    <div class="count">
                        <span>3</span> of 5 
                    </div>
                </div>
                <form id="traveldetails" action="<?php echo base_url();?>student/mentor-bank-details" class="center-data-section d-md-flex align-items-center" method="POST" autocomplete="off">
                    <div class="register-form process-section home travel-details">
                        <h2>Travel Details*</h2>
                        <p class="details-p"><small>* All fields under personal details are mandatory.</small></p>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-12 form-group reg-show-pass">
                            <label class="fb-icon">Are you and your team members and mentor willing to travel to Pune for Physical Grand Finale?</label>
                                <div class="row mt-2">
                                    <div class="col-2">
                                        <label class="ws-radio">
                                            <input type="radio" name="secondDoses" id="secondDosesYes" value="1" checked>
                                            <span>Yes</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-2">
                                        <label class="ws-radio">
                                        <input type="radio" name="secondDoses" id="secondDosesNo" value="0">
                                            <span>No</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group show-pass">
                                <label class="fb-icon">Date of arrival in Pune*</label>
                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control check-duplicate" name="arrivaldate" id="arrivaldate" placeholder="Select Date">
                                <i class='bx bx-calendar' id=""></i>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group show-pass">
                                <label class="fb-icon">Date of departure from Pune*</label>
                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control check-duplicate" name="departuredate" id="departuredate" placeholder="Select Date">
                                <i class='bx bx-calendar' id=""></i>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Total Number of people who will travel*</label>
                                <input type="text" pattern="\d*" class="form-control check-duplicate" name="numberofpeople" id="numberofpeople" placeholder="Enter number of people">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-12 col-12 form-group reg-show-pass">
                                <div class="cla-img">
                                    <label>Attach Travel Bills</label>
                                    
                                    <!-- <div id="icard-file-holder" style="<?php if(empty($userData->identityCard)){ echo 'display:none'; }?>">
                                        <a href="<?php echo base_url().'/uploads/student_icards/'.$userData->identityCard;?>" target="_blank" id="icard-file"><?php echo $userData->identityCard;?></a>
                                        <span data-trlqansid="21" data-questionid="101" class="removeCardFiles">
                                            <i class="bx bx-trash-alt"></i>
                                        </span>
                                    </div> -->
                                    
                                    <p>Upload a scanned copy of your travel bills.</P>
                                    <div class="" id="reg-icard">
                                        <form id="frm-card-file" action="<?php echo base_url();?>student/Finalist/uploadfile" method="POST" autocomplete="off" onsubmit="return false;">
                                            <input type="file" name="cardfile" id="cardfile">
                                        </form>
                                    </div>
                                    <p>Allowed formats are .png .jpeg and .pdf</p>
                                </div>
                            </div>
                        </div>

                        <div class="row form-row ws-form-row m-0">
                            <div class="col-12 text-center form-group">
                                <input type="submit" name="saveuser" class="" data-act="section" data-url="eduDetails" value="Proceed"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>