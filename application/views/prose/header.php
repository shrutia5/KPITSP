<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php if(isset($pageTitle)){echo  $pageTitle;}else{ echo "kpit"; }  ?></title>
  <meta content="<?php if(isset($metaDescription)){echo  $metaDescription;}  ?>" name="description">
  <meta content="<?php if(isset($metakeywords)){echo  $metakeywords;}  ?>" name="keywords">
  <!-- Favicons -->
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/aos/aos.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/alertifyjs/css/alertify.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/student.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/admin.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/adminmobile.css" rel="stylesheet">
  <script>
    var base_url = '<?= base_url()?>';
  </script>
  <link rel="stylesheet" href="<?php  echo base_url();?>assets/slim/css/slim.min.css">
  </head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid p-0">
      <div class="row justify-content-center">
        <div class="col-xl-12 d-flex align-items-center">
          <a href="<?php echo base_url();?>" class="logo">
            <img src="<?php echo base_url();?>images/logo.png" alt="KPIT SPARKLE">
          </a>
          <nav class="nav-menu nav-menu-admin d-none d-lg-block" id="eva-headBar" style="margin:0 auto;height:100%;">
            <ul style="height:100%;">
              <!-- <li <?php if(isset($menuName) &&!empty($menuName)){ if($menuName =="dashboard"){ echo 'class="active"'; } }?> ><a  href="<?php echo base_url();?>prose/dashboard">Home</a></li> -->
              <li <?php if(isset($menuName) &&!empty($menuName)){ if($menuName =="reports"){ echo 'class="active"'; } }?>><a href="<?php echo base_url();?>prose/reports">Reports</a></li>
            </ul>
          </nav><!-- .nav-menu -->
        <div class="myprofile ml-auto d-lg-block ">
        <!-- <span class="myaccount" style="width: 150px;"><?php echo "Welcome Pragati";?> </span> -->
        <?php if($this->session->userdata('userId'))
          { ?>
            <!-- <span class="myaccount">
              <div class="initials"> 
              <?php $firstl= $this->session->userdata('name');
                          $firstoflast= $this->session->userdata('lname');
                                      $letter= $firstl[0].$firstoflast[0];
                                      //echo $letter;
                                      ?>  
              <span><?php echo $letter; ?></span>
            <?php echo "Welcome ". ' '.$this->session->userdata('name');?></div>
           <div class="sub-myaccount"> -->
           <!-- <p><a href="<?php echo base_url()?>student/dashboard" class="d-block">My Dashboard <hr></a></p>
            <p><a href="<?php echo base_url()?>student/myaccount" class="d-block">Profile <hr></a></p>
            <p><a href="<?php echo base_url()?>" class="d-block">Helpful Resources <hr></a></p> -->
            <!-- <p><a href="<?php echo base_url()?>/logout" class="d-block">Logout</a></p>
           </div>
          </span> -->

          <span class="myaccount">
            <div class="my-pro" id="menu">
              <span>
                <?php $firstl= $this->session->userdata('name');
                      $firstoflast= $this->session->userdata('lname');
                      $letter= $firstl[0];
                      $profile_img= $this->session->userdata('proImg'); 
                ?>
                <span class="span-css"> <?php echo $letter;?> </span> 
              </span> 
              <div class="hidename">
                <?php echo "Welcome ". ' '.$this->session->userdata('name');?>
              </div>
              <i class='bx bxs-chevron-down' id="togglemenu"></i>
            </div>
            <!-- <i class='bx bxs-chevron-down' id="togglemenu"></i> -->
            <div class="sub-myaccount" style="padding: 10px 98px;">
              <!-- <p><a href="<?php echo base_url()?>student/dashboard" class="d-block dashboard0 make-active">My Dashboard <hr></a></p>
              <p><a href="<?php echo base_url()?>student/myaccount" class="d-block myaccount0 make-active">My Profile <hr></a></p>
              <p><a href="<?php echo base_url()?>" class="d-block kpit0 make-active">Helpful Resources <hr></a></p> -->
              <p><a href="<?php echo base_url()?>/prose/reports" class="d-block dashboard0 make-active">Dashboard</a></p>
              <p><a href="<?php echo base_url()?>/logout" class="d-block logout0 make-active">Logout</a></p>
            </div>
          </span>
          <?php }else {?>
            <div class="pr-2"><a href="<?php echo base_url();?>/login" class="loginSignUp">Login</a></div> |
            <div class="pl-2"><a href="<?php echo base_url();?>/register" class="loginSignUp">Sign Up</a></div>
          <?php } ?>
        </div>
    </div>
    </div>
    </div>
    <!-- <div class="col-xl-12 p-0 d-block d-lg-none">
        <a href="https://localhost/sparkle-2023/login" class="login-btn">Login</a>
        <a href="https://localhost/sparkle-2023/registration/signup" class="register-btn">Register Now</a>
    </div> -->
</header><!-- End Header -->

