<main>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-md-5 p-0">
                <a href="<?php echo base_url(); ?>" class="logo-img">
                    <img src="<?php echo base_url(); ?>images/logo.png" alt="KPIT SPARKLE">
                </a> 
                <section class="register register-banner d-md-flex align-items-center">
                    <div class="logo-r">    
                        <img src="<?php echo base_url(); ?>images/kpitlogo.png" alt="Mobility & Energy for the Future"/>
                        <h1 class="title mt-4" data-aos="zoom-out" data-aos-delay="100">
                            KPIT Sparkle Registration
                        </h1>
                        <h1 data-aos="zoom-out" data-aos-delay="100">
                            2022-23
                        </h1>
                        <div class="isregister mt-5">
                            <p><span id="hide2">Already have an account?</span> <a href="<?php echo base_url(); ?>login">Login</a></p>
                        </div>
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
                        <span>1</span> of 2 
                    </div>
                </div>
                <form id="registerUser" action="<?php echo base_url(); ?>student/register" method="POST" autocomplete="off" onsubmit="return false;">
                    <div class="register-form process-section home personal-details">
                        <h2>Personal Details</h2><br/>
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
                                <label class="fb-icon">Whatsapp Contact Number*</label>
                                <div class="d-flex flex-row">
                                    <div class="col-md-3">
                                        <select class="form-control" name="countryCode" id="countryCode">
                                            <option value="101">91</option>
                                            <option value="82">49</option>
                                            <option value="217">66</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <input type="text"  class="form-control check-duplicate" name="contact" id="contact" placeholder="Enter number">
                                    </div></div>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group reg-show-pass">
                                <label class="fb-icon">Password*</label>
                                <input type="password" class="form-control mail-info" name="password" id="password" placeholder="********">
                                <i class="bx bx-hide" id="togglePassword"></i>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group reg-show-pass">
                                <label class="fb-icon">Confirm Password*</label>
                                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="********">
                                <i class="bx bx-hide" id="toggleCnfPassword"></i>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-4 form-group reg-show-pass">
                                <label class="fb-icon">Gender*</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Rather not specify</option>
                                </select>
                                <div class="validate"></div>
                            </div>
                        </div>
                        <p><small><b class="imp-note">Note
                                    :</b> Password must contain both uppercase and lowercase characters (e.g., a-z and A-Z), at least one number (e.g., 0-9), one special character (e.g. @#$%)</small></p>
                        <h2 class="mt-5">Social Media Details</h2>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Facebook</label>
                                <input type="text" class="form-control" name="faceboolUrl" id="faceboolUrl" placeholder="xyz@fb.com">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Twitter ID</label>
                                <input type="text" class="form-control" name="twitterUrl" id="twitterUrl" placeholder="xyz@insta.com">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Instagram</label>
                                <input type="text" class="form-control" name="instagramUrl" id="instagramUrl" placeholder="xyz@tw.com">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">LinkedIn</label>
                                <input type="text" class="form-control" name="linkedinUrl" id="linkedinUrl" placeholder="xyz@lD.com">
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-12 text-center form-group">
                                <input type="submit" name="saveuser" class="" data-act="section" data-url="eduDetails" value="Proceed"/>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="register-form eduDetails process-section">
                    <style>.hidden-rg-step2{opacity:0;}</style>
                    <h2>Educational Details</h2><br/>
                    <p class="details-p"><small>Fields mark with * are mandatory.</small></p>
                    <form id="registerUserEduDetails" action="<?php echo base_url(); ?>student/register" method="POST" autocomplete="off" onsubmit="return false">
                        <div class="row form-row ws-form-row m-0">
                            <div class="col-md-6 form-group">
                                <label>College State*</label>
                                <!-- <select class="form-control chnageState" data-action="<?php base_url(); ?>getCityList" name="state" id="state"> -->
                                <select class="form-control changeState" data-action="<?php base_url(); ?>getCollegelist" name="state" id="state">
                                    <option value="">Select state</option>
                                    <?php
                                    if (isset($userState) && !empty($userState)) {
                                        foreach ($userState as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value->state_id ?>"><?php echo $value->state_name; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                                <div class="validate"></div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Select College*</label>
                                <select class="form-control changecollege" data-action="<?php base_url(); ?>getCityList" name="college" id="collegeList">
                                    <option value="">Select college</option>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group otherClgList hide">
                                <label>Enter College Name*</label>
                                <input type="text" class="form-control" name="otherCollege" id="otherCollege" maxlength="200" placeholder="Enter your college name">
                            </div>
                            <div class="col-md-6 form-group otherCityList hide">
                                <label>Enter College city*</label>
                                <input type="text" class="form-control" name="otherCity" id="otherCity" maxlength="200" placeholder="Enter your college city">
                            </div>

                            <div class="col-md-6 form-group clgcity">
                                <label>City*</label>
                                <input type="hidden" class="form-control" name="city" id="city" placeholder="">
                                <input type="text" class="form-control" id="cityList" name="cityList" style="background: transparent;" readonly/>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Degree*</label>
                                <select class="form-control" data-action="<?php base_url(); ?>getCityList" name="degree" id="degree">
                                    <option value="">Select degree</option>
                                    <?php
                                    if (isset($userDegree) && !empty($userDegree)) {
                                        foreach ($userDegree as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value->degree_id ?>"><?php echo $value->degree_name; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Branch*</label>
                                <select class="form-control" data-action="<?php base_url(); ?>getCityList" name="branch" id="branch">
                                    <option value="">Select Branch</option>
                                    <?php
                                    if (isset($userBranch) && !empty($userBranch)) {
                                        foreach ($userBranch as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value->branch_id ?>"><?php echo $value->branch_name; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Stream</label>
                                <!-- <input type="text" class="form-control" name="stream" id="stream" placeholder="Confirm your Password"> -->
                                <select class="form-control" data-action="<?php base_url(); ?>getCityList" name="stream" id="stream">
                                    <option value="">Select stream</option>
                                    <?php
                                    if (isset($userStream) && !empty($userStream)) {
                                        foreach ($userStream as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value->stream_id ?>"><?php echo $value->stream_name; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fb-icon">Year of completion*</label>
                                <!-- <input type="text" class="form-control" name="YearOfCompletion" id="YearOfCompletion" placeholder="Select year"> -->
                                <select name="YearOfCompletion" class="form-control" id="dropYear" onchange="getProjectReportFunc()">
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <!-- <label class="fb-icon">Question*: 
                                <?php
                                $num1 = (rand(10, 100));
                                $num2 = (rand(10, 100));
                                echo $num1 . " + " . $num2;
                                $sum = $num1 + $num2;
                                // echo "-".$sum;
                                ?></label>
                                <input type="text" class="form-control" name="qAnswer" id="qAnswer" placeholder="Write answer"> -->
                                <!--                                <div class="g-recaptcha" data-sitekey="6LfF0oceAAAAACmG7bQzvw_VyK27Wq1ulIXY0pTo"></div>
                                                                <div class="validate"></div>-->
                            </div>
                        </div>
                        <input type="hidden" name="identityCard" id="identityCard">
                    </form>
                    <div class="row form-row ws-form-row m-0">
                        <div class="col-md-12 form-group">
                            <label class="fb-icon">College Identity Card*</label>
                            <p><small>Upload a scanned copy of your college/university identity card picture.</small></p>
                            <div id="icard-file-holder" style="display:none">
                                <a href="" target="_blank" id="icard-file"></a>
                                <span data-trlqansid="21" data-questionid="101" class="removeCardFiles">
                                    <i class="bx bx-trash-alt"></i>
                                </span>
                            </div>
                            <div class="" id="reg-icard" style="height: auto;"><!-- dropzone -->

                                <form id="frm-card-file" action="<?php echo base_url(); ?>student/register/uploadfile" method="POST" autocomplete="off" onsubmit="return false;">
                                    <input type="file" name="cardfile" id="cardfile">
                                </form>
                            </div>
                            <p>Allowed formats are .png .jpeg and .pdf</p>
                        </div>
                    </div>
                    <div class="row form-row ws-form-row m-0">
                        <div class="col-12 text-center form-group">
                            <input type="button" id="subbtn" name="save" id="save" value="Proceed"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bx-show');
    });

    const toggleCnfPassword = document.querySelector('#toggleCnfPassword');
    const cnfPassword = document.querySelector('#cpassword');
    toggleCnfPassword.addEventListener('click', function (e) {
        const type = cnfPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        cnfPassword.setAttribute('type', type);
        this.classList.toggle('bx-show');
    });
</script>