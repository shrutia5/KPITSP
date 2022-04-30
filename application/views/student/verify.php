<main>
<!-- <i class='bx bx-show'></i> -->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-5 p-0">
                <div class="logo-img">
                        <!-- <img src="<?php

use Mpdf\Tag\Em;

 echo base_url();?>images/logo.png" alt=""/> -->
                    <a href="<?php echo base_url();?>" class="logo">
                        <img src="<?php echo base_url();?>images/logo.png" alt="KPIT SPARKLE">
                    </a>
                </div>
                <section class="register register-banner d-md-flex align-items-center">
                    <div class="logo-r">    
                        <img src="<?php echo base_url();?>images/kpitlogo.png" alt="Mobility & Energy for the Future"/> 
                        <!-- <span>
                            <div class="text-img">
                            Mobility<br> & Energy <br>for the<br> Future
                            </div>
                        </span> -->
                        <h1 class="title mt-4" data-aos="zoom-out" data-aos-delay="100">
                            KPIT Sparkle<br><span id="log5">VERIFICATION</span>
                        </h1>
                        <h1 data-aos="zoom-out" data-aos-delay="100">
                            2022-23
                        </h1>
                        <!-- <div class="isregister mt-5">
                        <p><span id="hide1">Don't have an account?</span> <a href="<?php echo base_url();?>/register">Register Now</a></p>
                        </div> -->
                    </div>
                    
                </section><!-- End Hero -->
            </div>
            <div class="col-md-7  register-right">
                <div class="header-register">
                    <div class="back">
                        <a href="<?php echo base_url();?>login" class="process-section home" data-act="url" data-url="<?php echo base_url(); ?>"><i class="icofont-simple-left"></i>
                            <span class="home-link">Back to Login</span>
                        </a>
                    </div>
                </div>
                <form id="emailVereify"  action="<?php echo base_url();?>verifyuser" class="center-data-section d-flex align-items-center" method="POST" autocomplete="off" onsubmit="return false">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                
                                <p><small></small></p>
                                <div class="row form-row ws-form-row m-0">
                                    <div class="col-md-12 form-group">
                                    <p class="thankyoumsg">Thank you for registering with us.<br> We have sent an OTP to your registered email.<br> Kindly verify it</p>
                                        <!-- <label>Email*</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your register email">
                                        <div class="validate"></div> -->
                                    </div>
                                </div>
                                <div class="row form-row ws-form-row m-0">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10 form-group">
                                                <label>Email OTP*</label>
                                                <input type="text" class="form-control" name="email_otp" id="email_otp" placeholder="Enter your Email OTP" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6  form-group">
                                            <?php if(isset($userDetails) && !empty($userDetails)) { ?>
                                                <!-- <input type="submit" name="resend-otp" class="resend" id="resend-otp" value="Resend OTP"/> -->
                                                <input type="button" class="resend_otp" data-id="<?php echo $userDetails->userID; ?>" id="resend_otp" name="resend_otp" value="Resend Otp">
                                                <?php  } ?>
                                            </div>
                                            <div class="col-md-6  text-center form-group">
                                                <input type="submit" name="verify-otp" class="" id="verify-otp" value="VERIFY"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>