<main id="portal">
    <div class="container-fluid p-0">
        <div id="portal-space "></div>
        <div class="row m-0">
            <div class="col-md-4 p-0">
            <!-- <section class="portal-left register-banner d-md-flex align-items-center"> -->
                <?php if (isset($adminData1) && !empty($adminData1) && $adminData1->phaseTwoStatus == "Approved") {
                    ?>
                    <section class="portal-left register-banner">
                        <div class="logo-r" style="padding-top: 100px;">    
                            <img src="<?php echo base_url(); ?>images/kpitlogo.png" alt="Mobility & Energy for the Future"/>
                            <h1 class="title mt-4" data-aos="zoom-out" data-aos-delay="100">
                                KPIT Sparkle
                            </h1>
                            <h1 data-aos="zoom-out" data-aos-delay="100">
                                2022-23

                            </h1>
                        </div>
                        <div class="incutop100" id="incubator-selection" style="padding-left: 20px;">
                            <?php if ($adminData1->phaseTwoStatus) { ?>
                                <div class="card" style="width: 25rem;">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <p class="incusparid"><?php echo $adminData1->sparkleID; ?></p>
                                            <p class="incusparproname"><?php echo $adminData1->projectName; ?></p>
                                        </div>
                                        <div class="card-text">
                                            <p>status : Idea in Top 100</p>
                                            <p class="impincu" style="color: #E53935;">IMPORTANT</p>
                                            <?php if ($adminData1->shareWithIncubator == '') { ?>
                                                <div class="incu-yestop100">
                                                    <span>Do you wish to share your data with incubation centers</span>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="yestop50" value="Yes" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="yestop50" value="No" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <span class="ayesTop100 hide<?php
                                            if ($adminData1->shareWithIncubator != '') {
                                                echo '-false';
                                            }
                                            ?>">You have opted <span class="incubation-status"><?php
                                          if ($adminData1->shareWithIncubator == 'No') {
                                              echo 'not ';
                                          }
                                          ?></span> to share your project data with our incubation partners.We consider this as the collective preference of your entire team.</span>
                                        </div>
                                    </div>
                                </div>
    <?php } ?>
                        </div>
                    </section><!-- End Hero -->
<?php } else { ?>
                    <section class="portal-left register-banner d-md-flex align-items-center">
                        <div class="logo-r" style="padding-top: 100px;">    
                            <img src="<?php echo base_url(); ?>images/kpitlogo.png" alt="Mobility & Energy for the Future"/>
                            <h1 class="title mt-4" data-aos="zoom-out" data-aos-delay="100">
                                KPIT Sparkle
                            </h1>
                            <h1 data-aos="zoom-out" data-aos-delay="100">
                                2022-23

                            </h1>
                        </div>
                    </section>
                <?php } ?>
            </div>
            <div class="col-md-8 portal-right">
                <!-- show this view if there no project default submit view-->
<?php if ((!isset($adminData1) || empty($adminData1)) && (!isset($teamProjects) || empty($teamProjects))) { ?>
                    <div class="row default-view no-border no-project" style="background: #2A2A2B;">
                        <div class="col-md-12">
                            <div class="default-view no-border d-md-flex align-items-center">
                                <div class="default-content">
                                    <div class="fico">
                                        <i class="icofont-folder"></i>
                                    </div>
                                    <!--                                    <div>
                                                                            <img style="max-width:100%" src="<?php echo base_url(); ?>images/designcycle.png" alt="Telegram Channel"/>
                                                                        </div>-->
                                    <h3 class="mt-4" id="project2">No Projects!</h3>
                                    <h3 class="mt-4" id="project1" style="font-size: 24px;">No Project added yet!</h3>
                                    <p class="light-color">Submit your innovative idea before<br/><?php echo date("d M Y", strtotime($infoSetting->submissionDate)); ?></p>
                                    <a href="<?php echo base_url(); ?>student/submit-idea"><input type="submit" name="save" id="save-idea" value="SUBMIT NOW"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>

                <!-- show this view if project submitted -->
<?php if ((isset($adminData1) && !empty($adminData1)) && (!isset($teamProjects) || empty($teamProjects))) { ?>
                    <div class="row default-view no-border">
                        <div class="default-view-my-project default-view-invited">
                            <div class="header">Submit your idea before <?php echo date("d M Y", strtotime($infoSetting->submissionDate)); ?></div>
                            <div class="row mt-5 ">
                                <div class="col-md-6 pro-tit1">
                                    <div class="pro-title pro7">
                                        <span class="small normal">Project Title</span>
                                        <h4 class="normal"><?php echo $adminData1->projectName ?></h4>
                                    </div>
                                    <div class="pro-team mt-4">
                                        <span class="small normal tt1">Team Members</span>
                                        <p class="light">
                                            <?php
                                            $tname = $this->session->userdata('name');
                                            echo ucfirst($tname);
                                            $teamMembers = $this->CommonModel->getProjectMembers($adminData1->projectID);
                                            if ($teamMembers != "-") {
                                                echo " , " . ucfirst($teamMembers);
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="pro-team mt-4">
                                        <span class="small normal">Category</span>
                                        <p class="light"><?php echo $adminData1->category_name ?></p>
                                    </div>
                                    <div class="pro-team mt-4">
                                        <span class="small normal">Sub-Category</span>
                                        <p class="light"><?php echo $adminData1->sub_cat_name ?></p>
                                    </div>
                                    <div class="pro-team mt-4">
                                        <span class="small normal">Sparkle ID</span>
                                        <p class="light"><?php echo $adminData1->sparkleID ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 pro-tit2">
                                    <div class="pro-status mt-4 mobile-background">
                                        <span class="small normal">Submission Status</span>
                                        <ul>
    <?php
    echo $this->CommonModel->getProjectSubmissionStatus($adminData1);
    ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 view3">
                                <?php
                                if ($adminData1->projectStatus != "Reject" && $adminData1->phaseTwoStatus != "Reject" && $adminData1->phaseThreeStatus != "Reject") {
                                    echo '<input class="mr-2" type="submit" onclick=\'location.href="' . base_url() . 'student/submit-idea"\' name="save" id="save" value="Continue Editing"/>';
                                }
                                ?>

                                <a href="<?php echo base_url(); ?>student/project">VIEW PROJECT</a>

                            </div>
                        </div>
                    </div>
<?php } ?>
<?php if ((!isset($adminData1) || empty($adminData1)) && (isset($teamProjects) && !empty($teamProjects))) { ?>
                    <!-- no project and team member on other project view -->
                    <div class="row green2">
                        <div class="col-md-6 green1">
                            <div class="default-view d-flex align-items-center">
                                <div class="default-content">
                                    <div class="fico">
                                        <i class="icofont-folder"></i>
                                    </div>
                                    <h3 class="mt-4" id="project2">No Projects!</h3>
                                    <h3 class="mt-4" id="project1">No Project added yet!</h3>
                                    <p class="light-color">Submit your innovative idea before<br/><?php echo date("d M Y", strtotime($infoSetting->submissionDate)); ?></p>
                                    <a href="<?php echo base_url(); ?>student/submit-idea"><input type="submit" name="save" id="save-idea" value="SUBMIT NOW"/></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 green-power1">
                            <div class="default-view-invited">
                                <div class="header head11"><?php echo ucfirst($teamProjects[0]->firstname); ?> has added you to his project.</div>
                                <div class="pro-title">
                                    <span class="small normal"><?php echo $teamProjects[0]->sparkleID; ?></span>
                                    <h4 class="normal"><?php echo $teamProjects[0]->projectName; ?></h4>
                                </div>
                                <div class="pro-team mt-4">
                                    <span class="small normal tt1">Team Members</span>
                                    <p class="light"><?php
                                        echo ucfirst($teamProjects[0]->firstname);
                                        $teamMembers = $this->CommonModel->getProjectMembers($teamProjects[0]->projectID);
                                        if ($teamMembers != "-") {
                                            echo " , " . ucfirst($teamMembers);
                                        }
                                        ?></p>
                                </div>
                                <div class="pro-status mt-4">
                                    <span class="small normal">Submission Status</span>
                                    <ul>
    <?php echo $this->CommonModel->getProjectSubmissionStatus($teamProjects[0]); ?>
                                    </ul>
                                </div>
                                <div class="mt-4 mobile-dashboard">
                                    <input class="mr-2" type="submit" onclick="location.href = '<?php echo base_url(); ?>student/project-details/<?php echo $teamProjects[0]->projectID; ?>'" name="save" id="save" value="View Project"/>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>
<?php if ((isset($adminData1) && !empty($adminData1)) && (isset($teamProjects) && !empty($teamProjects))) { ?>
                    <!-- added  project and team member on other project view -->
                    <div class="row">
                        <div class="col-md-6 green-power1">
                            <div class="default-view-my-project default-view-invited">
                                <div class="header head11">Submit your idea before <?php echo date("d M Y", strtotime($infoSetting->submissionDate)); ?></div>
                                <div class="pro-title">
                                    <span class="small normal"><?php echo $adminData1->sparkleID ?></span>
                                    <h4 class="normal"><?php echo $adminData1->projectName ?></h4>
                                </div>
                                <div class="pro-team mt-4">
                                    <span class="small normal tt1">Team Members</span>
                                    <p class="light"><?php
                                        echo $this->session->userdata('name');
                                        $teamMembers = $this->CommonModel->getProjectMembers($adminData1->projectID);
                                        if ($teamMembers != "-") {
                                            echo " , " . ucfirst($teamMembers);
                                        }
                                        ?></p>
                                </div>
                                <!--<div class="pro-team mt-4">
                                        <span class="small normal">Category</span>
                                        <p class="light"><?php echo $adminData1->category_name ?></p>
                                    </div>
                                    <div class="pro-team mt-4">
                                        <span class="small normal">Sub-Category</span>
                                        <p class="light"><?php echo $adminData1->sub_cat_name ?></p>
                                    </div>-->
                                <div class="pro-status no-bg mt-4">
                                    <span class="small normal">Submission Status</span>
                                    <ul>
    <?php
    echo $this->CommonModel->getProjectSubmissionStatus($adminData1);
    ?>
                                    </ul>
                                </div>
                                <div class="mt-4 mobile-dashboard">
                                    <?php
                                    if ($adminData1->projectStatus != "Reject" && $adminData1->phaseTwoStatus != "Reject" && $adminData1->phaseThreeStatus != "Reject") {
                                        echo '<input class="mr-2" type="submit" onclick=\'location.href="' . base_url() . 'student/submit-idea"\' name="save" id="save" value="Continue Editing"/>';
                                    }
                                    ?>
                                    <a href="<?php echo base_url(); ?>student/project">VIEW PROJECT</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 green-power1">
                            <div class="default-view-invited">
                                <div class="header head11"><?php echo $teamProjects[0]->firstname; ?> has added you to his project.</div>
                                <div class="pro-title">
                                    <span class="small normal"><?php echo $teamProjects[0]->sparkleID; ?></span>
                                    <h4 class="normal"><?php echo $teamProjects[0]->projectName; ?></h4>
                                </div>
                                <div class="pro-team mt-4">
                                    <span class="small normal tt1">Team Members</span>
                                    <p class="light"><?php
                                        echo $teamProjects[0]->firstname;
                                        $teamMembers = $this->CommonModel->getProjectMembers($teamProjects[0]->projectID);
                                        if ($teamMembers != "-") {
                                            echo " , " . $teamMembers;
                                        }
                                        ?></p>
                                </div>
                                <div class="pro-status mt-4">
                                    <span class="small normal">Submission Status</span>
                                    <ul>
    <?php echo $this->CommonModel->getProjectSubmissionStatus($teamProjects[0]); ?>
                                    </ul>
                                </div>
                                <div class="mt-4 mobile-dashboard">
                                    <input class="mr-2" type="submit" onclick="location.href = '<?php echo base_url(); ?>student/project-details/<?php echo $teamProjects[0]->projectID; ?>'" name="save" id="save" value="View Project"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <div class="row">
                    <?php
                    if (count($teamProjects) >= 2) {

                        foreach ($teamProjects as $key => $teamProject) {
                            if ($key == 0) {
                                continue;
                            }
                            ?>
                            <div class="col-md-6 mt-5 green-power3">
                                <div class="default-view-invited ">
                                    <div class="header head11"><?php echo ucfirst($teamProject->firstname); ?> has added you to his project.</div>
                                    <div class="pro-title">
                                        <span class="small normal"><?php echo $teamProject->sparkleID; ?></span>
                                        <h4 class="normal"><?php echo $teamProject->projectName; ?></h4>
                                    </div>
                                    <div class="pro-team mt-4">
                                        <span class="small normal tt1">Team Members</span>
                                        <p class="light"><?php
                                            echo ucfirst($teamProject->firstname);
                                            $teamMembers = $this->CommonModel->getProjectMembers($teamProject->projectID);
                                            if ($teamMembers != "-") {
                                                echo " , " . ucfirst($teamMembers);
                                            }
                                            ?></p>
                                    </div>
                                    <div class="pro-status no-bg mt-4">
                                        <span class="small normal">Submission Status</span>
                                        <ul>
        <?php echo $this->CommonModel->getProjectSubmissionStatus($teamProject); ?>
                                        </ul>
                                    </div>
                                    <div class="mt-4 mobile-dashboard">
                                        <input class="mr-2" type="submit" onclick="location.href = '<?php echo base_url(); ?>student/project-details/<?php echo $teamProject->projectID; ?>'" name="save" id="save" value="View Project"/>
                                    </div>
                                </div>
                            </div>

    <?php }
}
?>
                </div>
            </div>
        </div>
    </div>
</main>