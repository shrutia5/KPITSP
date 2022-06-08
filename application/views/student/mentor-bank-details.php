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
                        <span>4</span> of 5 
                    </div>
                </div>
                <form id="mentorbankdetails" action="<?php echo base_url();?>student/personal-bank-details" class="center-data-section d-md-flex align-items-center" method="POST" autocomplete="off">
                    <div class="register-form process-section home mentor-bank-details">
                        <h2>Mentor Bank Details</h2>
                        <p class="details-p"><small>* All fields under personal details are mandatory.</small></p>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-6 form-group show-pass">
                                <p> <label>Savings Account Number*</label>
                                <input type="password" class="form-control log-txt log-txt5" name="accountnumber" id="accountnumber" placeholder="Enter your account number"/>
                                <i class='bx bx-hide' id="toggleAccountNumber"></i>
                                </p>
                            </div>
                            <div class="col-md-6 form-group show-pass">
                                <p> <label>Confirm Account Number*</label>
                                <input type="password" class="form-control log-txt log-txt5" name="accountnumber" id="accountnumber" placeholder="Confirm your account number"/>
                                </p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Bank Name*</label>
                                <input type="text" class="form-control" name="bankname" id="bankname" placeholder="Enter Bank name" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Branch Name*</label>
                                <input type="text" class="form-control" name="branchname" id="branchname" placeholder="Enter Branch name" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">IFSC Code*</label>
                                <input type="text" class="form-control" name="ifsccode" id="ifsccode" placeholder="Enter IFSC Code" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">PAN ID*</label>
                                <input type="text" class="form-control" name="panid" id="panid" placeholder="Enter PAN ID" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">AADHAR ID*</label>
                                <input type="text" class="form-control" name="aadharid" id="aadharid" placeholder="Enter Aadhar Card number" maxlength="100">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-12 col-12 form-group reg-show-pass">
                                <div class="cla-img">
                                    <label>Photo of Passbook/Statement for verification*</label>
                                    
                                    <!-- <div id="icard-file-holder" style="<?php if(empty($userData->identityCard)){ echo 'display:none'; }?>">
                                        <a href="<?php echo base_url().'/uploads/student_icards/'.$userData->identityCard;?>" target="_blank" id="icard-file"><?php echo $userData->identityCard;?></a>
                                        <span data-trlqansid="21" data-questionid="101" class="removeCardFiles">
                                            <i class="bx bx-trash-alt"></i>
                                        </span>
                                    </div> -->
                                    
                                    <p>Upload a scanned copy of your passbook/Statement for verfication.</P>
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
    <script>
    const toggleAccountNumber = document.querySelector('#toggleAccountNumber');
    const password = document.querySelector('#accountnumber');
    toggleAccountNumber.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bx-show');
    });
    </script>
</main>