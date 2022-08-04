<!-- ======= Hero Section ======= -->
<!-- <section class="section-bg" style="padding: 5px 0px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <img style="max-width:100%" src="<?php echo base_url(); ?>images/qrcode.png" alt="Telegram Channel"/>
            </div>
            <div class="col-md-9 p-3">
                <div class="d-flex align-items-center" style="height:300px;">
                    <div>
                        <h2 class="section_secondary_title text-center mb-5">WE NOW HAVE A TELEGRAM CHANNEL!</h2>
                        <h5 class="text-center">To stay updated on the latest news on the platform, please join this <a href="https://t.me/kpitsparkle" target="_blank">https://t.me/kpitsparkle</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- End Hero -->
<section id="hero" class="d-flex align-items-center">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-xl-12 home-silder">
                <img src="<?php echo base_url(); ?>images/logo-silder.png" alt="Mobility & Energy for the Future"/>
                <h1>
                    <span data-aos="zoom-out" data-aos-delay="100">Inspire.</span>
                    <span data-aos="zoom-out" data-aos-delay="1000">Innovate.</span>
                    <span data-aos="zoom-out" data-aos-delay="2000">Thrive.</span>
                </h1>
                <br/>
                <a href="about-us" data-aos="zoom-out" data-aos-delay="2500">KNOW MORE <i class="icofont-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="services section-bg">
    <div class="container" data-aos="fade-up">
        <h2 class="section_secondary_title text-center">Glimpse of the past</h2>
        <div class="row pt-5">
            <div class="col-md-12 pl-0"> <!-- platforms home-crack -->
                <div class="bs-example">
                    <!-- Button HTML (to Trigger Modal) -->
                    <a href="#myModal" class="play-video"  data-toggle="modal">
                        <img src="<?php echo base_url() ?>images/thumbnail.png" alt="">
                    </a>
                    <!-- Modal HTML -->
                </div>    
            </div>
        </div>
    </div>
</section>
<section class="statstics section-bg">
    <div class="container" data-aos="fade-up">
        <h2 class="section_secondary_title text-center mb-5">Crunching Numbers The Right Way</h2>
        <h3 class="secondary_sub_title text-center"> Presence - 28 States & 5 Union Territories</h3>
        <div class="row pt-5">
            <div class="col-md-4 col-6">
                <div class="count-box text-center">
                    <span class="countData"><span data-toggle="counter-up">12000</span>+</span>
                    <p>Ideas Received/Nurtured</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="count-box text-center">
                    <span class="countData"><span data-toggle="counter-up">2000</span>+</span>
                    <p>Colleges associated</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="count-box text-center">
                    <span class="countData">1 Lakh+</span>
                    <p>Innovators Registered</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="count-box text-center">
                    <span class="countData" data-toggle="counter-up">15</span>
                    <p>Projects Incubated</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="count-box text-center">
                    <span class="countData" data-toggle="counter-up">07</span>
                    <p>Number of Editions</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="count-box text-center">
                    <span class="countData" data-toggle="counter-up">03</span>
                    <p>Market-Ready Ideas</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="winnerData" data-paroller-factor="0.3" data-paroller-factor-xs="0.1" data-paroller-type="background" data-paroller-direction="horizontal">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-5">
                <div class="count-box text-left">
                    <h2 class="section_secondary_title bold mb-1">18th FICCI 2020 Award winner</h2>
                    <p class="info-award">KPIT won the ‘FICCI Corporate Social Responsibility Award’ for incubating path-breaking innovations by young entrepreneurs from across the country. KPIT won the award in the category of ‘Exemplary Innovation (irrespective of the turnover of the company)’</p>
                    <!--<a href="#" class="knowMore" data-aos="zoom-out" data-aos-delay="300">KNOW MORE <i class="icofont-long-arrow-right"></i></a>-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======= Clients Section ======= -->
<section id="clients" class="section-bg light clients">
    <div class="container-fluid" data-aos="zoom-in">
        <div class="row justify-content-center">
            <h2 class="section_secondary_title  dark text-center mb-5">Our Partners</h2>
            <div class="col-xl-12">

                <div class="owl-carousel clients-carousel">
                    <?php
                    if (isset($patnerList) && !empty($patnerList)) {
                        $catID = "";
                        foreach ($patnerList as $value) {
                            if (($catID != $value->categoryID || empty($catID)) && $value->categoryName != '') {
                                $catID = $value->categoryID;
                                ?>
                                <div class="item catname">
                                    <span><?php echo $value->categoryName ?></span>
                                </div>    
                            <?php } ?>
                            <div class="item">
                                <?php if ($value->link != null || !empty($value->link)) { ?>
                                    <a href="<?php echo $value->link; ?>" target="_blank">
                                    <?php } ?>
                                    <img data-id="<?php echo $value->categoryID; ?>" src="<?php echo base_url(); ?>/images/clients/<?php echo $value->clientImage; ?>" alt="">
                                    <?php if ($value->link != null || !empty($value->link)) { ?></a><?php } ?>
                            </div>
                            <?php
                        }
                    }
                    ?>

                        <!--<img src="<?php echo base_url(); ?>/images/ourpartners/AICTE.png" alt="">
                        <img src="<?php echo base_url(); ?>/images/ourpartners/ARAI.png" alt="">
                        <img src="<?php echo base_url(); ?>/images/ourpartners/DST.png" alt="">
                        <img src="<?php echo base_url(); ?>/images/ourpartners/Mathworks.png" alt="">
                        <img src="<?php echo base_url(); ?>/images/ourpartners/TRIZ.png" alt="">-->

                </div>
            </div>
        </div>
    </div>
</section>
<section class="socialmedia section section-bg" style="display:none;">
    <div class="container" data-aos="fade-up">
        <h2 class="section_secondary_title text-center mb-5">Social Media</h2>
        <div class="ws-cards card-columns">
            <?php
            if (isset($mediaList) && !empty($mediaList)) {
                foreach ($mediaList as $value) {
                    ?>
                    <div class="card">
                        <a target="_blank" href="<?php echo $value->fblink; ?>"><img class="card-img-top" src="<?php echo $value->picture; ?>" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text"><?php echo $value->message; ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo $value->createdTime; ?></small></p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <!-- <div class="card">
                <img class="card-img-top" src="<?php echo base_url(); ?>/images/posts/post_1.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">1 This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?php echo base_url(); ?>/images/posts/post_2.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">2 This card has supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card text-center">
                <img class="card-img-top" src="<?php echo base_url(); ?>/images/posts/post_3.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">3 This card has supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?php echo base_url(); ?>/images/posts/post_2.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">4 This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?php echo base_url(); ?>/images/posts/post_1.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">5 This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="<?php echo base_url(); ?>/images/posts/post_3.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">6 This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div> -->
        </div>
        <div class="text-center mt-4">
            <input type="button" class="primary_btn" value="Load More">
        </div>
    </div>
</section>
<section class="socialmedia section section-bg section-bg-blue">
    <div class="container" data-aos="fade-up">
        <h2 class="section_secondary_title text-center mb-5">BLOGS</h2>
        <div class="ws-cards-horizontal row">
            <?php
            if (isset($blogList) && !empty($blogList)) {
                foreach ($blogList as $value) {
                    ?>
                    <div class="mb-3 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-white">
                                    <?php
                                    $blogTitle = $value->blogTitle;
                                    if (strlen($value->blogTitle) > 45) {
                                        $blogTitle = substr($value->blogTitle, 0, 50) . "" . "...";
                                    }
                                    echo $blogTitle
                                    ?></h4>
                                <span class="card-date"><?= $value->createdDate ?></span>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a class="readNow" href="<?php echo base_url() . "/blog/" . $value->blogLink; ?>">Know more <i class="icofont-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <!-- <div class="mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">11 July 2021</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">10 July 2021</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo base_url(); ?>/blogs" class="primary_btn btn">View All</a>
        </div>
    </div>
</section>