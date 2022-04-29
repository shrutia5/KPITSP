<main>
<!-- <i class='bx bx-show'></i> -->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-5 p-0">
                <div class="logo-img">
                        <!-- <img src="<?php echo base_url();?>images/logo.png" alt=""/> -->
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
                            KPIT Sparkle<br><span id="log5">Forgot Password</span>
                        </h1>
                        <h1 data-aos="zoom-out" data-aos-delay="100">
                            2022-23
                        </h1>
                        <div class="isregister mt-5">
                        <p><span id="hide1">Don't have an account?</span> <a href="<?php echo base_url();?>/register">Register Now</a></p>
                        </div>
                    </div>
                    
                </section><!-- End Hero -->
            </div>
            <div class="col-md-7  register-right">
                <div class="header-register">
                    <div class="back">
                        <a href="<?php echo base_url();?>/login" class="process-section home" data-act="url" data-url="<?php echo base_url(); ?>"><i class="icofont-simple-left"></i>
                            <span class="home-link">Back to Login</span>
                        </a>
                    </div>
                </div>
                <form id="forgotpassword"  action="<?php echo base_url("/resetPasswordRequest");  ?>" class="center-data-section d-flex align-items-center" method="POST" autocomplete="off">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <h2>Forgot Password?</h2><br/>
                                <p><small></small></p>
                                <div class="row form-row ws-form-row m-0">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10 form-group">
                                                <label>Enter Registered Email Id</label>
                                                <input type="text" class="form-control" name="userEmail" id="userEmail" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 form-group">
                                                <input type="submit" name="saveuser" class="userNav eduDetails" href="#" data-act="section" data-url="eduDetails" id="saveuser" value="PROCEED"/>
                                            </div>
                                        </div>
                                        <?php
                                        $resetMsg = $this->session->userdata('resetMsg');
                                        if(!empty($resetMsg)){
                                            $this->session->unset_userdata('resetMsg');
                                            echo '<p class="error">Invalid link or link is expired. Please try again.</span> </p>';
                                        }
                                        ?>
                                        
                                        
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