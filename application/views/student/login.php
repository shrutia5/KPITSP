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
                            KPIT Sparkle<br><span id="log5">Login</span>
                        </h1>
                        <h1 data-aos="zoom-out" data-aos-delay="100">
                            2022-23
                        </h1>
                        <div class="isregister mt-5">
                        <p><span id="hide1">Don't have an account?</span> <a href="<?php echo base_url();?>register">Register Now</a></p>
                        </div>
                        
                    </div>
                    
                </section><!-- End Hero -->
            </div>
            <div class="col-md-7  register-right">
                <div class="header-register">
                    <div class="back">
                        <a href="<?php echo base_url(); ?>" class="process-section home" data-act="url" data-url="<?php echo base_url(); ?>"><i class="icofont-simple-left"></i> <span class="home-link">Home</span></a>
                    </div>
                </div>
                <form id="login" action="<?php echo base_url();?>student/verifyuser" class="center-data-section d-md-flex align-items-center" method="POST" autocomplete="off">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-12 offset-md-2" id="login-form">
                                <h2>Welcome Back!</h2><br/>
                                <p><small></small></p>
                                <div class="row form-row ws-form-row m-0">
                                    <div class="col-md-12 col-12">
                                        <div class="row">
                                            <div class="col-md-10 col-12 form-group">
                                                <label>Email ID / Mobile*</label>
                                                <input type="text" class="form-control log-txt log-txt5" name="userEmail" id="userEmail" placeholder="Enter Email / Mobile Number">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 col-12 form-group show-pass">
                                               <p> <label>Password*</label>
                                                <input type="password" class="form-control log-txt log-txt5" name="userPass" id="password" placeholder="Enter password"/>
                                                <i class='bx bx-hide' id="togglePassword"></i>
                                               </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 col-12 form-group">
                                                <a href="<?php echo base_url()?>forgot-password" class="forgotLink">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 col-12 form-group">
                                                <button type="submit" name="loginSubmit" class="userNaveduDetails" data-act="section" id="loginSubmit">LOGIN</button>
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
    <script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bx-show');
});
</script>
</main>