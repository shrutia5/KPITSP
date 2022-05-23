<main>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-5  p-0">
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
                            KPIT Sparkle<br><span id="log5">Registration</span>
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
                <form id="updatePassword" action="<?php echo base_url();?>updatePassword" class="center-data-section d-md-flex align-items-center" method="POST" autocomplete="off">
                <input type="hidden" value="<?php echo $userID ?>" name="userid"/>
                     <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-12 offset-md-2">
                                <h2>Forgot Password?</h2><br/>
                                <p><small></small></p>
                                <div class="row form-row ws-form-row m-0">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                            <div class="col-md-10 col-sm-12 col-12  form-group">
                                                <label>Email ID</label>
                                                <input type="text" class="form-control" name="userEmail" id="userEmail" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-10 col-sm-12 col-12 form-group">
                                                <label>Email OTP</label>
                                                <input type="text" class="form-control" name="userEmail" id="userEmail" placeholder="Enter OTP">
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-10 col-sm-12 col-12 form-group show-pass">
                                                <label> Password</label>
                                                <input type="password" class="form-control" pattern="^(?=.*[A-Za-z])(?=.*\d)[a-zA-Z0-9!@#$%\^&*)(+=._-]{8,}$" title="Password must contain: Minimum 8 characters atleast 1 Alphabet and 1 Number" name="userPass" id="password" placeholder="Enter password">
                                                <i class='bx bx-hide' id="togglePassword"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 col-sm-12 col-12 form-group show-pass">
                                                <label>Re-enter Password</label>
                                                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Re-Enter Password">
                                                <i class='bx bx-hide' id="togglecPassword"></i>
                                            </div>
                                        </div>
                                        <p>Note: <span style="font-size: 13px;">Password must contain both uppercase and lowercase characters (e.g., a-z and A-Z), at least one number (e.g., 0-9), one special character (e.g. @#$%)</span> </p>
                                        <div class="row">
                                            <div class="col-md-10 col-sm-12 col-12form-group">
                                                <input type="submit" name="saveuser" class="userNav eduDetails" href="#" data-act="section" data-url="eduDetails" id="saveuser" value="UPDATE & PROCEED"/>
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

const togglecPassword = document.querySelector('#togglecPassword');
const cpassword = document.querySelector('#cpassword');
togglecPassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const ctype = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    cpassword.setAttribute('type', ctype);
    // toggle the eye / eye slash icon
    this.classList.toggle('bx-show');
});
</script>
</main>