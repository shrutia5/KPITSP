<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>KPIT sparkle | Student Dashboard</title>
    <meta content="Student Dashboard" name="description">
    <meta content="KPIT sparkle Student Dashboard" name="keywords">
    <!-- Favicons -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="http://localhost/kpit/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/icofont/icofont.min.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/remixicon/remixicon.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/venobox/venobox.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/aos/aos.css" rel="stylesheet">
    <link href="http://localhost/kpit/assets/alertifyjs/css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="http://localhost/kpit/assets/realTimeUpload/css/RealTimeUpload.css" />
    <!-- Template Main CSS File -->
    <link href="http://localhost/kpit/css/style.css" rel="stylesheet">
    <link href="http://localhost/kpit/css/student.css" rel="stylesheet">
    <link href="http://localhost/kpit/css/mobilechanges.css" rel="stylesheet">
    <script>
        var base_url = 'http://localhost/kpit/';
    </script>
    <link rel="stylesheet" href="http://localhost/kpit/assets/slim/css/slim.min.css">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 d-flex align-items-center">
                    <a href="http://localhost/kpit/" class="logo">
                        <img src="http://localhost/kpit/images/logo.png" alt="KPIT SPARKLE">
                    </a>
                    <div class="myprofile ml-auto d-lg-block ">
                        <span class="myaccount">

                            <div class="my-pro" id="menu">
                                <span> <span class="span-css"> S </span>
                                </span><span class="wename"> Welcome Shubham</span>
                                <i class='bx bxs-chevron-down' id="togglemenu"></i>

                            </div>
                            <div class="sub-myaccount">
                                <p><a href="http://localhost/kpit/student/dashboard"
                                        class="d-block dashboard0 make-active">My Dashboard</a></p>
                                <p><a href="http://localhost/kpit/student/myaccount"
                                        class="d-block myaccount0 make-active">My Profile</a></p>
                                <p><a href="http://localhost/kpit/" class="d-block kpit0 make-active">Helpful
                                        Resources</a></p>
                                <p><a href="http://localhost/kpit//logout"
                                        class="d-block logout0 make-active">Logout</a></p>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-12 p-0 d-block d-lg-none">
        <a href="https://sparkle.kpit.com/login" class="login-btn">Login</a>
        <a href="https://sparkle.kpit.com/registration/signup" class="register-btn">Register Now</a>
    </div> -->
    </header><!-- End Header -->

    <main id="portal">
        <div id="portal-space"></div>
        <div class="container-fluid p-0">
            <div class="row submit-hide  pt-3 m-0">
                <div class="d-flex">
                    <div class="col-sm-2 col-2">
                        <a href="http://localhost/kpit/student/project"><i class="bx bxs-chevron-left bx-sm"
                                style="color:#C8C8C8;"></i></a>

                    </div>
                    <div class="col-sm-7 col-7 text-center">
                        <h4 class="mobile-click" id="top-text1">Back to Dashboard</h4>
                        <h4 class="mobile-team"><span>My Team </span><button class="btn2"><i
                                    class='bx bx-plus-medical'></i></button></h4>
                        <h4 class="mobile-change">Add New Member</h4>
                        <h4 class="add-member1">New Member</h4>
                        <h4 class="mentor-msg">Message to Mentor <i class="bx bxs-chevron-down bx-sm"
                                style="color:#C8C8C8;"></i></h4>

                    </div>
                    <div class="col-3 col-sm-3">
                        <i class="bx bxs-chat bx-sm  mobile-click" style="color:#8FDB00;"></i>
                        <i class="bx bx-group bx-sm  mobile-click" style="color:#8FDB00;"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-12 pt-2 p-0">
                    <div class="alert alert-danger alert-danger-ws text-center mobile-click" role="alert">
                        <i class="bx bx-hourglass"></i> Last 20 days to submit your idea
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-9 full-width mobile-click">
                    <div class="full-left noFooter">
                        <div class="section-nav d-md-flex justify-content-between">
                            <div class="back">
                                <a href="http://localhost/kpit/student/dashboard"><i
                                        class='bx bx-chevron-left'></i> <span>Back to Dashboard</span></a>
                            </div>
                            <div class="status">
                                <span>Status:</span> Project Description pending
                            </div>
                        </div>
                        <ul class="nav nav-tabs nav-tabs-c" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="project-tab" data-toggle="tab" href="#projectdetail"
                                    role="tab" aria-controls="project" aria-selected="true">Project Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="trlquestion-tab" data-toggle="tab" href="#trlquestion"
                                    role="tab" aria-controls="trlquestion" aria-selected="false">TRL Questions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="document-tab" data-toggle="tab" href="#document" role="tab"
                                    aria-controls="document" aria-selected="false">Attachment</a>
                            </li>
                        </ul>
                        <div class="tab-content content-pro" id="myTabContent">
                            <div class="tab-pane fade show active" id="projectdetail" role="tabpanel"
                                aria-labelledby="project-tab">
                                <div class="tab-body">
                                    <label>SP21C00097</label>
                                    <h3 class="norma"></h3>
                                    <br />

                                    <input class="mr-2" type="submit"
                                        onclick="location.href='http://localhost/kpit//student/submit-idea'"
                                        name="save" id="save" value="Continue editing" />
                                    <!--<a href=""><i class="icofont-play-alt-2"></i>&nbsp;&nbsp;Play Prototype</a>-->
                                    <div class="clearfix"></div>
                                    <ul class="project-list-details">
                                        <li>
                                            <label>Category</label>
                                            <p></p>
                                        </li>
                                        <li>
                                            <label>Sub-Category</label>
                                            <p></p>
                                        </li>
                                        <li>
                                            <label>Problem statement</label>
                                            <p>
                                                <!-- Voltage variation of battery during full charge condition and reduced charge condition affects the motor performance, Each and every electric bike or vehicle having different rating of battery and it is challenge to charge any type of Electric Vehicle at charging station with minimum charging time -->
                                            </p>
                                        </li>
                                        <li>
                                            <label>Solution</label>
                                            <p>
                                                <!-- Designing a voltage stabilizer ( regulator ) which regulates battery voltage, Aerodynamic shape of battery for better cooling, Overall bike design according to cooling, comfort, speed etc. -->
                                            </p>
                                        </li>
                                        <li>
                                            <label>Innovation</label>
                                            <p>
                                            </p>
                                        </li>
                                        <li>
                                            <label>Abstract</label>
                                            <p></p>
                                        </li>
                                        <li>
                                            <label>Technical Description</label>
                                            <p></p>
                                        </li>
                                        <li>
                                            <label>Keywords</label>
                                            <p></p>
                                        </li>
                                        <li>
                                            <label>Patent Status</label>
                                            <p>No </p>
                                        </li>
                                        <li><span class="SectionTitle">TRL Level 1</span>
                                            <p><label>Q. 2 What is your problem statement?</label></p>
                                            <p>Ans: No Answer</p>
                                        </li>
                                        <li><span class="SectionTitle">TRL Level 2</span>
                                            <p><label>Q. 4 What is your unique solution?</label></p>
                                            <p>Ans: No Answer</p>
                                        </li>
                                        <li><span class="SectionTitle">TRL Level 3</span>
                                            <p><label>Q. 3 What is the Innovation/Disruption/Invention in your
                                                    solution?</label></p>
                                            <p>Ans: No Answer</p>
                                        </li>
                                        <li><span class="SectionTitle">TRL Level 4</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="trlquestion" role="tabpanel"
                                aria-labelledby="trlquestion-tab">
                                <div class="leve1 questionDetails">
                                    <span class="SectionTitle">TRL Level 1</span>
                                    <ol>Q. 1 What is the best way to describe your project?</ol>
                                    <ol class="ansDetails">
                                        <p>Ans: No Answer</p>
                                        <ol>
                                            <ol>Q. 3 Have you defined the problem statement as experienced by a user of
                                                the product, service and is it validated by an expert?</ol>
                                            <ol class="ansDetails">
                                                <p>Ans: No Answer</p>
                                                <ol>
                                                    <ol>Q. 4 Have you discussed and confirmed with possible customers
                                                        about potential impact of the problem?</ol>
                                                    <ol class="ansDetails">
                                                        <p>Ans: No Answer</p>
                                                        <ol>
                                                            <ol>Q. 5 Have you identified a customer for your product?
                                                            </ol>
                                                            <ol class="ansDetails">
                                                                <p>Ans: No Answer</p>
                                                                <ol>
                                                                    <ol>Q. 6 Are the technical solution outline and
                                                                        features identified for the solution?</ol>
                                                                    <ol class="ansDetails">
                                                                        <p>Ans: No Answer</p>
                                                                        <ol>
                                </div>
                                <div class="leve1 questionDetails">
                                    <span class="SectionTitle">TRL Level 2</span>
                                    <ol>Q. 1 Have you identified the features your product will have, after the customer
                                        interaction?</ol>
                                    <ol class="ansDetails">
                                        <p>Ans: No Answer</p>
                                        <ol>
                                            <ol>Q. 2 Have you identified the solution for your problem statement?</ol>
                                            <ol class="ansDetails">
                                                <p>Ans: No Answer</p>
                                                <ol>
                                                    <ol>Q. 3 What kind of prototype would you build as a solution?</ol>
                                                    <ol class="ansDetails">
                                                        <p>Ans: No Answer</p>
                                                        <ol>
                                                            <ol>Q. 5 How many research papers have you studied to
                                                                validate the solution?</ol>
                                                            <ol class="ansDetails">
                                                                <p>Ans: No Answer</p>
                                                                <ol>
                                                                    <ol>Q. 6 What would best describe the current stage
                                                                        of your system?</ol>
                                                                    <ol class="ansDetails">
                                                                        <p>Ans: No Answer</p>
                                                                        <ol>
                                                                            <ol>Q. 7 Have you identified the resources
                                                                                and the risks?</ol>
                                                                            <ol class="ansDetails">
                                                                                <p>Ans: No Answer</p>
                                                                                <ol>
                                                                                    <ol>Q. 8 What have you used for
                                                                                        virtual validation through
                                                                                        simulation to verify the
                                                                                        principles used?</ol>
                                                                                    <ol class="ansDetails">
                                                                                        <p>Ans: No Answer</p>
                                                                                        <ol>
                                </div>
                                <div class="leve1 questionDetails">
                                    <span class="SectionTitle">TRL Level 3</span>
                                    <ol>Q. 1 Do you have knowledge on limitations of currently available solutions for
                                        the problem statement?</ol>
                                    <ol class="ansDetails">
                                        <p>Ans: No Answer</p>
                                        <ol>
                                            <ol>Q. 2 Does your solution have an unfair advantage over competition?</ol>
                                            <ol class="ansDetails">
                                                <p>Ans: No Answer</p>
                                                <ol>
                                </div>
                                <div class="leve1 questionDetails">
                                    <span class="SectionTitle">TRL Level 4</span>
                                    <ol>Q. 1 Has the customer participated in the User Acceptance Testing?</ol>
                                    <ol class="ansDetails">
                                        <p>Ans: No Answer</p>
                                        <ol>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                                <div class="leve4 questionDetails">
                                    <span class="SectionTitle">
                                        <div class="leve4 questionDetails">

                                            <div class="row default-view no-border" style="background: #2A2A2B;">
                                                <div class="col-md-12">
                                                    <div class="default-view no-border d-md-flex align-items-center">
                                                        <div class="default-content">
                                                            <div class="fico">
                                                                <i class='bx bx-file-blank'></i>
                                                            </div>
                                                            <h3 class="mt-4" style="font-size: 24px;"> Attachment not
                                                                available</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 detail-hide for-msg" style="padding-right: 30px;padding-top:18px;">
                    <div class="row helpful-section1 noFooter1 team1">
                        <div class="my-team">
                            <div class="para1">
                                <div class="my-teamh team-mobile">
                                    <span>Add New Member </span>
                                    <p>(Maximum 4 memberss & 2 Mentors)</p>
                                </div><br>
                                <form id="memberDetail"
                                    action="http://localhost/kpit//student/addMemberDetails" method="post">
                                    <input type="hidden" class="form-control" name="projettid" id="projectid"
                                        placeholder="Enter projectid" value="97">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label class="lab-size lab-size1">Member Mobile Number*</label>
                                            <input type="text" class="form-control typeahead type-mobile" name="contact"
                                                id="contact" placeholder="Enter Mobile No." />
                                            <div class="contactNumber"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="lab-size lab-size2">Designation</label>
                                            <div class="form-check" style="font-size: 16px;">
                                                <input class="form-check-input" type="radio" name="member"
                                                    id="teamMember" value="Team Member" checked>
                                                <label class="form-check-label member1" for="teamMember">
                                                    Team Member
                                                </label>
                                            </div>
                                            <div class="form-check" style="font-size: 16px;">
                                                <input class="form-check-input" type="radio" name="member" id="mentor"
                                                    value="Mentor">
                                                <label class="form-check-label member2" for="mentor">
                                                    Mentor
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group" style="margin-top: 10px;">
                                            <input type="submit" name="loginSubmit" class="" data-act="section"
                                                onclick="" data-url="" id="sendinvitebtn" value="SEND INVITE" />
                                            <a href="#" class="btn1">&nbsp;&nbsp;CANCEL</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="my-teamhide">
                                <div class="my-teamh">
                                    <span class="team-mobile">My Team </span><button class="btn2 team-mobile"><i
                                            class='bx bx-plus-medical'></i></button>
                                    <p>(Maximum 4 memberss & 2 Mentors)</p>
                                </div>
                                <!-- <div class="my-teamm">
                                <div class="row mentor">
                                    <div class="col-md-2 pro">
                                        <span> ST</span>
                                    </div>
                                    <div class="col-md-10">
                                            <span>S N Tripathi <a href=""><i class='bx bx-trash'></i></a> </span>
                                            <p>Mentor</p>
                                    </div>
                                </div>
                                <hr>
                            </div> -->
                                <tbody>

                                    <tr>
                                        <div class="my-teaml">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <div class="col-md-12 col-12 name-icon">
                                                    <span class="pro1">
                                                        <span style="text-transform: uppercase;">sp</span>
                                                    </span>
                                                    <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                    <span> sayali pawar</span>
                                                    <span data-memID="32" class="removeMember"><i
                                                            class="bx bx-trash-alt"></i></span>
                                                    <p>Team Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="my-teaml">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <div class="col-md-12 col-12 name-icon">
                                                    <span class="pro1">
                                                        <span style="text-transform: uppercase;">SS</span>
                                                    </span>
                                                    <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                    <span> Shriya Sanas</span>
                                                    <span data-memID="33" class="removeMember"><i
                                                            class="bx bx-trash-alt"></i></span>
                                                    <p>Team Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="my-teaml">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <div class="col-md-12 col-12 name-icon">
                                                    <span class="pro1">
                                                        <span style="text-transform: uppercase;">AJ</span>
                                                    </span>
                                                    <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                    <span> Aarti Jawalkar</span>
                                                    <span data-memID="34" class="removeMember"><i
                                                            class="bx bx-trash-alt"></i></span>
                                                    <p>Team Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="my-teaml">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <div class="col-md-12 col-12 name-icon">
                                                    <span class="pro1">
                                                        <span style="text-transform: uppercase;">SP</span>
                                                    </span>
                                                    <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                    <span> Swaraj Patil</span>
                                                    <span data-memID="35" class="removeMember"><i
                                                            class="bx bx-trash-alt"></i></span>
                                                    <p>Team Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="my-teaml">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <div class="col-md-12 col-12 name-icon">
                                                    <span class="pro1">
                                                        <span style="text-transform: uppercase;">GB</span>
                                                    </span>
                                                    <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                    <span> Gaurav Bhor</span>
                                                    <span data-memID="36" class="removeMember"><i
                                                            class="bx bx-trash-alt"></i></span>
                                                    <p>Team Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="my-teaml">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <div class="col-md-12 col-12 name-icon">
                                                    <span class="pro1">
                                                        <span style="text-transform: uppercase;">KM</span>
                                                    </span>
                                                    <!--</div>
                                            <div class="col-md-10 col-10">-->
                                                    <span> Kiran Malave</span>
                                                    <span data-memID="37" class="removeMember"><i
                                                            class="bx bx-trash-alt"></i></span>
                                                    <p>Team Member</p>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            </div>
                            <div class="sendinvite">
                                <div class="inner-center">
                                    <i class='bx bx-envelope bs-md msg-envelope'></i>
                                    <p>Invitation Sent Successfully!</p>
                                    <input type="button" class="sent-b" value="Done">
                                </div>
                            </div>
                            <!-- <div class="sendinvite">
                            <div class="icon-box">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <div class="mess-send">
                            <p>Invitation Sent Successfully!</p>
                            </div>
                            <div class="send-btn">
                                <input type="button" class="sent-b" value="Done">
                            </div>
                        </div>  -->

                            <!-- <button >Hide</button>
                        <button class="btn2">Show</button> -->
                        </div>
                    </div>
                    <div class="row helpful-section1 noFooter1 msg1 msg-inner">
                        <div class="messageout">
                            <!-- 
                        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

                        <h4>A PHP Error was encountered</h4>

                        <p>Severity: Notice</p>
                        <p>Message:  Undefined variable: unreadCount</p>
                        <p>Filename: student/message.php</p>
                        <p>Line Number: 2</p>


                            <p>Backtrace:</p>
	
		   <p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/application/views/student/message.php<br />
			Line: 2<br />
			Function: _error_handler			</p>

		  <p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/application/views/student/project-details.php<br />
			Line: 407<br />
			Function: view			</p>

		  <p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/application/controllers/student/Idea.php<br />
			Line: 184<br />
			Function: view			</p>

		<p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/index.php<br />
			Line: 315<br />
			Function: require_once			</p>

		</div> -->
                            <div class="header messageOpen">

                                <!-- 
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Undefined variable: msgFrom</p>
<p>Filename: student/message.php</p>
<p>Line Number: 9</p>


	<p>Backtrace:</p>
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/application/views/student/message.php<br />
			Line: 9<br />
			Function: _error_handler			</p>

		
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/application/views/student/project-details.php<br />
			Line: 407<br />
			Function: view			</p>

		
	
		
	
		
	
		
			<p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/application/controllers/student/Idea.php<br />
			Line: 184<br />
			Function: view			</p>

		
	
		
	
		
			<p style="margin-left:10px">
			File: /home/mkviadmin/public_html/KPIT.webtrixsolutions.com/index.php<br />
			Line: 315<br />
			Function: require_once			</p>

		
	

</div> -->
                                <!-- Message to Team Vertex -->
                                <!-- Message to  -->
                                <!-- fname -->
                                <!-- <span><i class='bx bxs-chevron-down'></i></span> -->
                                <!--  -->

                            </div>
                            <div class="body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-9 col-9">
                                            <div class="msg-body">
                                                <p>Hello Sir, I have created a video for demo purpose. Can you please
                                                    check and share your
                                                    feedback</p>
                                            </div>
                                            <p class="timing">Today, 2:29 pm</p>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <div class="msg-name">
                                                <p>PU</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 col-1">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2 col-2">
                                            <div class="msg-name">
                                                <p>PU</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-9">
                                            <div class="msg-body">
                                                <p>Ok, I will check & get back to you shortly.</p>
                                            </div>
                                            <p class="timing2">Today, 3:02 pm</p>
                                        </div>
                                        <div class="col-sm-1 col-1">

                                        </div>
                                    </div>


                                </div>
                                <ul class="messageConversation">

                                    <!--  -->
                                    <!-- <div class="default-msg d-flex align-items-center"><span>Start Conversion</span></div> -->
                                    <!--      -->
                                    <!-- <li class="receiver">
                <div class="d-flex">
                    <div class="icon-name"></div>
                    <div class="message">Hello Sir, I have created a video for demo purpose. Can you please check and share your feedback</div>
                </div>
                <span class="time">Today,2:29 pm</span>
            </li>
            <li class="sender">
                <div class="d-flex">
                    <div class="message">Hello Sir, I have created a video for demo purpose. Can you please check and share your feedback</div>
                    <div class="icon-name"></div>
                </div>
                <span class="time">Today,2:29 pm</span>

            </li>
            <li class="receiver">
                <div class="d-flex">
                    <div class="icon-name"></div>
                    <div class="message">Hello Sir, I have created a video for demo purpose. Can you please check and share your feedback</div>
                </div>
                <span class="time">Today,2:29 pm</span>
            </li>-->

                                </ul>
                                <div class="footer">
                                    <input type="hidden" name="senderId" id="senderId" value="43" />
                                    <input type="hidden" name="recId" id="recId" value="" />

                                    <div class="input-group msg-input">
                                        <i class='bx bx-smile bx-sm sme2'></i>
                                        <input id="messagetxt" type="text" class="form-control"
                                            placeholder="Write here..." name="messagetxt" value="">
                                        <div class="input-group-append">
                                            <button type="submit" name="sendMsg" id="sendMsg"
                                                class="sendMsg">Send</button>
                                        </div>
                                    </div>

                                    <!-- <i class='bx bx-smile'></i>
            <input id="messagetxt" type="text" placeholder="Write here..." name="messagetxt" value="" />
            <button type="submit" name="sendMsg" id="sendMsg" class="sendMsg">Send</button> -->
                                </div>
                            </div>
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $('#sendMsg').click(function () {

                                    var sendid = $('#senderId').val();
                                    var recid = $('#recId').val();
                                    var getmsg = $('#messagetxt').val().trim();
                                    if (getmsg != "") {
                                        $.ajax({
                                            type: "POST",
                                            url: base_url + "messages/" + sendid + "/" + recid,
                                            data: { "message": getmsg },
                                            datatype: 'JSON',
                                            beforeSend: function (request) {
                                                $("#saveuser").html("<span>Sending..</span>");
                                            },
                                            success: function (res) {
                                                res = JSON.parse(res);
                                                if (res.flag == "F")
                                                    alert(res.msg);

                                                if (res.flag == "S") {
                                                    var msg = '<li class="sender"><div class="d-flex"><div class="message">' + getmsg + '</div><div class="icon-name"></div></div><span class="time">Now</span></li>';
                                                    $(".messageConversation").append(msg);
                                                    $('#messagetxt').val("");
                                                    $(".messageout").find(".body").animate({ scrollTop: $(".messageout").find(".body").prop("scrollHeight") }, 1000);
                                                }
                                                setTimeout(function () {
                                                    $("#saveuser").html("Send");
                                                }, 3000);
                                            }
                                        });

                                    }

                                });
                                $('.messageOpen').click(function () {

                                    $(".messageout").find(".body").toggleClass("active");
                                    $(".messageout").find(".body").animate({ scrollTop: $(".messageout").find(".body").prop("scrollHeight") }, 1000);
                                    var sendid = $('#senderId').val();
                                    var recid = $('#recId').val();
                                    $.ajax({
                                        type: "POST",
                                        url: base_url + "readmessages/" + sendid + "/" + recid,
                                        datatype: 'JSON',
                                        beforeSend: function (request) {
                                            $("#saveuser").html("<span>Sending..</span>");
                                        },
                                        success: function (res) {
                                            res = JSON.parse(res);
                                            if (res.flag == "F")
                                                alert(res.msg);

                                            if (res.flag == "S") {
                                                $(".unreadCount").remove();
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".bx-group").on("click", function () {
                if ($('.msg1').css('display') == 'block' && $('.mobile-click').css('display') == 'none') {
                    $(".mobile-click").hide();
                } else {
                    $(".mobile-click").toggle();
                }
                $(".team1").toggle();
                $(".msg1").hide();
                $(".mobile-team").toggle();
                $(".add-member1").hide();

            });
            $(".bxs-chat").on("click", function () {
                if ($('.team1').css('display') == 'block' && $('.mobile-click').css('display') == 'none') {
                    $(".mobile-click").hide();
                } else {
                    $(".mobile-click").toggle();
                }
                $(".msg1").toggle();
                //$(".msg1").toggle();
                $(".team1").hide();
                $(".team-mobile").hide();
                $(".mentor-msg").toggle();
            });

            $(".bx-plus-medical").on("click", function () {
                $(".mobile-change").toggle();
                $(".mobile-team").hide();
            });
            $(".sendinvitebtn").on("click", function () {
                $(".add-member1").toggle();
                $(".mobile-change").hide();
                $(".mobile-team").hide();
            });
        });
    </script>



    <!-- Vendor JS Files -->
    <script src="http://localhost/kpit/assets/jquery/jquery.min.js"></script>
    <script src="http://localhost/kpit/assets/typeahead/typeahead.bundle.js"></script>
    <script src="http://localhost/kpit/assets/typeahead/typeahead.bundle.min.js"></script>
    <script src="http://localhost/kpit/assets/typeahead/typeahead.js"></script>
    <script src="http://localhost/kpit/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/kpit/assets/jquery.easing/jquery.easing.min.js"></script>
    <script src="http://localhost/kpit/assets/owl.carousel/owl.carousel.min.js"></script>
    <script src="http://localhost/kpit/assets/waypoints/jquery.waypoints.min.js"></script>
    <script src="http://localhost/kpit/assets/counterup/counterup.min.js"></script>
    <script src="http://localhost/kpit/assets/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="http://localhost/kpit/assets/jquery.validate/jquery.validate.js"></script>
    <script src="http://localhost/kpit/assets/realTimeUpload/js/RealTimeUpload.js"></script>
   <script src="http://localhost/kpit/assets/aos/aos.js"></script>
    <script src="http://localhost/kpit/assets/paroller/dist/jquery.paroller.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Template Main JS File -->
    <script src="http://localhost/kpit/assets/alertifyjs/alertify.min.js"></script>
    <script src="http://localhost/kpit/js/student/common.js"></script>
    <script src="http://localhost/kpit/js/student/submitIdea.js"></script>
    <script src="http://localhost/kpit/assets/slim/js/slim.kickstart.js" type="text/javascript"></script>
    <!-- <script src="assets/js/slim.kickstart.min.js"></script> -->
    <script src="http://localhost/kpit/js/main.js"></script>
    <script>
        $(function () {
            $("#upload_link").on('click', function (e) {
                e.preventDefault();
                $("#upload:hidden").trigger('click');
            });
        });
    </script>
</body>

</html>