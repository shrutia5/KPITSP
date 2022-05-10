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
                        <span>1</span> of 5 
                    </div>
                </div>
                <form id="mentordetails" action="<?php echo base_url();?>student/personal-details" class="center-data-section d-md-flex align-items-center" method="POST" autocomplete="off">
                    <div class="register-form process-section home personal-details">
                        <h2>Mentor Details*</h2>
                        <p class="details-p"><small>* All fields under personal details are mandatory.</small></p>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">First Name*</label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your name" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Last Name*</label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter your name" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Email Id*</label>
                                <input type="email"  class="form-control mail-info check-duplicate" name="email" id="email" placeholder="Enter your email id">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Contact Number*</label>
                                <input type="text"  class="form-control check-duplicate" name="contact" id="contact" placeholder="Enter number">
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