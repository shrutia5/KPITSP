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
                        <span>2</span> of 5 
                    </div>
                </div>
                <form id="personaldetails" action="<?php echo base_url();?>student/travel-details" class="center-data-section d-md-flex align-items-center" method="POST" autocomplete="off">
                    <div class="register-form process-section home personal-details">
                        <h2>Personal Details*</h2>
                        <p class="details-p"><small>* All fields under personal details are mandatory.</small></p>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-6 form-group reg-show-pass">
                                <label class="fb-icon">Tshirt Size*</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Size</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group reg-show-pass">
                                <label class="fb-icon">Gender*</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select your Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Rather not specify</option>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Age*</label>
                                <input type="text"  class="form-control check-duplicate" name="age" id="age" placeholder="Enter your Age">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Team Name*</label>
                                <input type="text"  class="form-control check-duplicate" name="age" id="age" placeholder="Enter your Team name">
                                <div class="validate"></div>
                            </div>
                        </div><br/>

                        <h2>Covid Vaccination Status *</h2>
                        <p class="details-p"><small>* All fields under personal details are mandatory.</small></p>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-6 form-group reg-show-pass">
                            <label class="fb-icon">First Doses Done?*</label>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        <label class="ws-radio">
                                            <input type="radio" name="firstDoses" id="firstDosesYes" value="1" checked>
                                            <span>Yes</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="ws-radio">
                                        <input type="radio" name="firstDoses" id="firstDosesNo" value="0">
                                            <span>No</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group show-pass">
                                <label class="fb-icon">Date of First Dose*</label>
                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control check-duplicate" name="firstdosedate" id="firstdosedate" placeholder="Select Date">
                                <i class='bx bx-calendar' id=""></i>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group reg-show-pass">
                            <label class="fb-icon">Second Doses Done?*</label>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        <label class="ws-radio">
                                            <input type="radio" name="secondDoses" id="secondDosesYes" value="1" checked>
                                            <span>Yes</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <label class="ws-radio">
                                        <input type="radio" name="secondDoses" id="secondDosesNo" value="0">
                                            <span>No</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group show-pass">
                                <label class="fb-icon">Date of Second Dose*</label>
                                <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control check-duplicate" name="seconddosedate" id="seconddosedate" placeholder="Select Date">
                                <i class='bx bx-calendar' id=""></i>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group reg-show-pass">
                                <label class="fb-icon">Were you covid positive in the last 3 months?*</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Yes or No</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <div class="validate"></div>
                            </div>
                        </div>

                        <div class="row form-row ws-form-row m-0 mt-2">
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