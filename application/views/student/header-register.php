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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/realTimeUpload/css/RealTimeUpload.css" />
  <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/student.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/mobilechanges.css" rel="stylesheet">

  <script>
    var base_url = '<?= base_url()?>';
  </script>
  
  </head>
<body>