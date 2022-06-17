<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title><?php
            if (isset($pageTitle)) {
                echo $pageTitle;
            } else {
                echo "kpit";
            }
            ?></title>
        <meta content="<?php
            if (isset($metaDescription)) {
                echo $metaDescription;
            }
            ?>" name="description">
        <meta content="<?php
              if (isset($metakeywords)) {
                  echo $metakeywords;
              }
            ?>" name="keywords">
        <!-- Favicons -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/icofont/icofont.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/remixicon/remixicon.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/venobox/venobox.css" rel="stylesheet">
        <link href="//vjs.zencdn.net/6.2/video-js.css" rel="stylesheet">
        <script src="//vjs.zencdn.net/6.2/video.js"></script>
        <link href="<?php echo base_url(); ?>assets/aos/aos.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/alertifyjs/css/alertify.min.css" rel="stylesheet">


        <!-- Template Main CSS File -->
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <!-- Meta Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s)
            {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '430599718403780');
            fbq('track', 'PageView');
        </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=430599718403780&ev=PageView&noscript=1"
                   /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- LinkedIn Pixel Code -->
    <script type="text/javascript"> _linkedin_partner_id = "4435793";
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(_linkedin_partner_id);
    </script><script type="text/javascript">
        (function (l) {
            if (!l) {
                window.lintrk = function (a, b) {
                    window.lintrk.q.push([a, b])
                };
                window.lintrk.q = []
            }
            var s = document.getElementsByTagName("script")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";
            b.async = true;
            b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
            s.parentNode.insertBefore(b, s);
        })(window.lintrk);
    </script> 
    <noscript> 
    <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=4435793&fmt=gif" /> 
    </noscript>
    <!-- LinkedIn Pixel Code End-->


</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 d-flex align-items-center">
                    <a href="<?php echo base_url(); ?>" class="logo">
                        <img src="<?php echo base_url(); ?>images/logo.png" alt="KPIT SPARKLE"></a>
                    <nav class="nav-menu d-none d-lg-block">
                        <ul>
                            <li <?php if ($this->uri->segment(1) == "about-us") { ?> class="active"<?php } ?>><a href="<?php echo base_url(); ?>about-us">about us</a></li>
                            <li <?php if ($this->uri->segment(1) == "i-innovate") { ?> class="active"<?php } ?>><a href="<?php echo base_url(); ?>i-innovate"><span class="lowca">i</span>-Innovate</a></li>
                            <!-- <li <?php if ($this->uri->segment(1) == "our-platforms") { ?> class="active drop-down"<?php } else { ?> class="drop-down"<?php } ?>><a href="<?php echo base_url(); ?>/our-platforms">Our Platforms</a>
                              <ul>
                                <li><a href="<?php echo base_url(); ?>/our-platforms">Innovate</a></li>
                                <li><a href="<?php echo base_url(); ?>">Icancrackit</a></li>
                              </ul>
                              </li> -->
                            <li <?php if ($this->uri->segment(1) == "blogs") { ?> class="active"<?php } ?>><a href="<?php echo base_url(); ?>blogs">Blogs</a></li>
                            <!-- <li><a href="<?php echo base_url(); ?>/news">News</a></li> -->
                            <li <?php if ($this->uri->segment(1) == "contactUs") { ?> class="active"<?php } ?>><a href="<?php echo base_url(); ?>contactUs">contact us</a></li>
                            <li <?php if ($this->uri->segment(1) == "helpful-resources") { ?> class="active"<?php } ?>><a href="<?php echo base_url(); ?>helpful-resources">Helpful resources</a></li>
                        </ul>
                    </nav><!-- .nav-menu -->

<?php if ($this->session->userdata('userId')) {
    ?>
                        <div class="myprofile ml-auto d-none d-lg-block ">
                            <span class="myaccount">

                                <div class="my-pro" id="menu">
                                    <span><?php
    $firstl = $this->session->userdata('name');
    $firstoflast = $this->session->userdata('lname');
    $usertype = $this->session->userdata('usertype');
    //$letter= $firstl[0].$firstoflast[0];
    //echo $letter;exit;
    $letter = $firstl[0];
    $profile_img = $this->session->userdata('proImg');
    //echo $profile_img;
    if (empty($profile_img)) {
        ?>
                                            <span class="span-css"> <?php echo $letter; ?> </span> 
                                <?php } elseif (!empty($profile_img)) {
                                    ?>

                                            <img class="pro-img img-fluid" src="<?php echo base_url(); ?>uploads/profile_pic/<?php echo $profile_img; ?>">
        <?php
    } else {
        echo "no";
    }
    ?>
                                    </span> <span class="wename"> <?php echo "Welcome " . ' ' . $this->session->userdata('name'); ?></span>
                                    <i class='bx bxs-chevron-down' id="togglemenu"></i>                      
                                </div>


    <?php if ($usertype == "User") { ?>
                                    <div class="sub-myaccount" style="display: none;">
                                        <p><a href="<?php echo base_url() ?>student/dashboard" class="d-block dashboard0 make-active">My Dashboard</a></p>
                                        <p><a href="<?php echo base_url() ?>student/myaccount" class="d-block myaccount0 make-active">My Profile</a></p>
                                        <p><a href="<?php echo base_url() ?>helpful-resources" class="d-block kpit0 make-active">Helpful Resources</a></p>
                                        <p><a href="<?php echo base_url() ?>logout" class="d-block logout0 make-active">Logout</a></p>
                                    </div>
                                <?php } elseif ($usertype == "Incubator") { ?>
                                    <div class="sub-myaccount" style="display: none;">
                                        <p><a href="<?php echo base_url() ?>incubator/dashboard" class="d-block dashboard0 make-active">My Dashboard</a></p>
                                        <p><a href="<?php echo base_url() ?>/logout" class="d-block logout0 make-active">Logout</a></p>
                                    </div>
                                <?php } elseif ($usertype == "Evaluator") { ?>
                                    <div class="sub-myaccount" style="display: none;">
                                        <p><a href="<?php echo base_url() ?>evaluator/dashboard" class="d-block dashboard0 make-active">My Dashboard</a></p>
                                        <p><a href="<?php echo base_url() ?>logout" class="d-block logout0 make-active">Logout</a></p>
                                    </div>
    <?php } elseif ($usertype == "Mentor") { ?>
                                    <div class="sub-myaccount" style="display: none;">
                                        <p><a href="<?php echo base_url() ?>mentor/dashboard" class="d-block dashboard0 make-active">My Dashboard</a></p>
                                        <p><a href="<?php echo base_url() ?>logout" class="d-block logout0 make-active">Logout</a></p>
                                    </div>
    <?php } elseif ($usertype == "Jury") { ?>
                                    <div class="sub-myaccount" style="display: none;">
                                        <p><a href="<?php echo base_url() ?>jury/dashboard" class="d-block dashboard0 make-active">My Dashboard</a></p>
                                        <p><a href="<?php echo base_url() ?>logout" class="d-block logout0 make-active">Logout</a></p>
                                    </div>
    <?php } elseif ($usertype == "Admin") { ?>
                                    <div class="sub-myaccount" style="display: none;">
                                        <p><a href="<?php echo base_url() ?>admin/dashboard" class="d-block dashboard0 make-active">My Dashboard</a></p>
                                        <p><a href="<?php echo base_url() ?>logout" class="d-block logout0 make-active">Logout</a></p>
                                    </div>
    <?php } ?>
                            </span>
                        </div>
        <?php } else { ?>
                        <div class="ml-auto d-none d-lg-block ">
                            <a href="<?php echo base_url() ?>login" class="login-btn">Login</a>
                            <a href="<?php echo base_url() ?>register" class="register-btn">Register Now</a>
                        </div>
<?php } ?>

                </div>
            </div>
        </div>
<?php if ($this->session->userdata('userId')) { ?>
            <div class="col-xl-12 p-0 d-block d-lg-none">
                <a href="<?php echo base_url() ?>student/dashboard" class="d-block login-btn make-active">My Dashboard</a>
                <a href="<?php echo base_url() ?>student/myaccount" class="d-block register-btn make-active">My Profile</a>
            </div>
<?php } else { ?>
            <div class="col-xl-12 p-0 d-block d-lg-none">
                <a href="<?php echo base_url() ?>login" class="login-btn">Login</a>
                <a href="<?php echo base_url() ?>register" class="register-btn">Register Now</a>
            </div>
<?php } ?>
    </header><!-- End Header -->
    <main id="main">
