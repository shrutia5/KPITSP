<section class="services section-bg">
  <div class="container" data-aos="fade-up">
        <h2 class="section_secondary_title normal text-center">Leading you to the pathway</h2>
        <div class="page-subtitle text-center">Our helpful resources are here to lead you through the way</div>
<!--        <div class="row mt-md-5">
            <div class="col-md-12">
                <div class="search-box">
                    <span><i class="icofont-search-2"></i></span>
                    <input type="text" placeholder="How can we help you?">
                </div>
            </div>
        </div>-->
    </div>
</section>

<section class="services section-bg">
    <div class="container" data-aos="fade-up">
    <div class="col-md-10">
            <h2 class="section_secondary_title text-left video-left-title">Useful Videos</h2>  
        </div>    
        <div class="btn-prev-useful"><i class="icofont-thin-left"></i></div>
        <div class="btn-next-useful"><i class="icofont-thin-right"></i></div>
    </div>
    <div class="container-fluid p-0" data-aos="fade-up">
        <div class="row mt-md-5 useful-resources owl-carousel owl-theme">
            <?php 
            if(isset($usefulVideos)&&!empty($usefulVideos))
            {
                foreach ($usefulVideos as $key => $value) {?>
                    <div class="item">
                        <a target="_blank" href="<?php echo  $value['link'] ?>">
                            <div class="video-res">
                                <div class="video-body">
                                    <div class="play"><i class="icofont-play-alt-2"></i></div>
                                </div>
                                <img src="<?php echo base_url()?>/images/videos/<?php echo $value['image'] ?>">
                            </div>
                            <div class="helpVideo">
                                <div class="duration">Duration: <?php echo $value['duration'] ?></div>
                                <div class="video-title"><?php echo $value['title'] ?></div>
                            </div>
                        </a>
                </div>
                <?php
                }
            }
            ?>
        </div>
        
    </div>
</section>
<section class="services section-bg-blue">
    <div class="container" data-aos="fade-up">
        <div class="col-md-10 p-0">
            <h2 class="section_secondary_title text-left">Guidelines, Procedures & Quick Reader</h2>  
        </div>
    </div>
    <div class="container mt-5 faq" id="faq" data-aos="fade-up">
        <ul class="faq-list" data-aos="fade-up">
            <?php 
                if(isset($faqList)&&!empty($faqList))
                {
                    foreach ($faqList as $key => $value) {
                        $uniID="faq_".rand();
                        ?>
                        <li>
                            <a data-toggle="collapse" class="collapsed" href="#<?=$uniID?>"><?php echo $value->faqQuestion?><i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
                            <div id="<?=$uniID?>" class="collapse collapse-data" data-parent=".faq-list">
                              <p>
                                <?php echo  $value->faqAnswer ?>
                              </p>
                            </div>
                        </li>
          <?php
                    }
                }
            ?>
          

          <!-- <li>
            <a data-toggle="collapse" href="#faq2" class="collapsed">Guidelines to submit an idea <i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
            <div id="faq2" class="collapse collapse-data" data-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq3" class="collapsed">Guidelines to add team members <i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
            <div id="faq3" class="collapse collapse-data" data-parent=".faq-list">
              <p>
                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq4" class="collapsed">Download TRIZ App <i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
            <div id="faq4" class="collapse collapse-data" data-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq5" class="collapsed">Understand more about the TRIZ Methodology <i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
            <div id="faq5" class="collapse collapse-data" data-parent=".faq-list">
              <p>
                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq6" class="collapsed">Get started with your own 'Lean Canvas' <i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
            <div id="faq6" class="collapse collapse-data" data-parent=".faq-list">
              <p>
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
              </p>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#faq7" class="collapsed">How to file a provisional patent in India? <i class="bx bx-plus icon-show"></i><i class="bx bx-minus icon-close"></i></a>
            <div id="faq7" class="collapse collapse-data" data-parent=".faq-list">
              <p>
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
              </p>
            </div>
          </li> -->
          
        </ul>
    </div>
</section>
<section class="services section-bg">

    <div class="container mt-5" data-aos="fade-up">
        <div class="col-md-10">
            <h2 class="section_secondary_title text-left video-left-title">Sample Prototype Videos</h2>  
        </div>
        <div class="btn-prev-prototype"><i class="icofont-thin-left"></i></div>
        <div class="btn-next-prototype"><i class="icofont-thin-right"></i></div>
    </div>
    <div class="container-fluid" data-aos="fade-up">
        <div class="row mt-md-5 prototype-videos owl-carousel owl-theme">
        <?php 
                 if(isset($protoTypeVideos)&&!empty($protoTypeVideos))
                 {
                     foreach ($protoTypeVideos as $key => $value) {?>
                        <div class="item">
                            <a target="_blank" href="<?php echo  $value['link'] ?>">
                                <div class="video-res">
                                    <div class="video-body">
                                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                                    </div>
                                    <img src="<?php echo base_url()?>/images/videos/<?php echo  $value['image'] ?>">
                                </div>
                                <div class="helpVideo">
                                    <div class="duration">Duration: <?php echo  $value['duration'] ?></div>
                                    <div class="video-title"><?php echo  $value['title'] ?></div>
                                </div>
                             </a>
                        </div>
                        <?php
                    }
                }
            ?>

            <!-- <div class="item">
                <div class="video-res">
                    <div class="video-body">
                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                    </div>
                    <img src="<?php echo base_url()?>/images/videos/video-2.png">
                    
                </div>
                <div class="helpVideo">
                    <div class="duration">Duration: 5 mins</div>
                    <div class="video-title">How to submit an idea?</div>
                </div>
            </div>
            <div class="item">
                <div class="video-res">
                    <div class="video-body">
                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                    </div>
                    <img src="<?php echo base_url()?>/images/videos/video-1.png">
                    
                </div>
                <div class="helpVideo">
                    <div class="duration">Duration: 5 mins</div>
                    <div class="video-title">Complete idea submission for KPIT Sparkle 2021</div>
                </div>
            </div> -->
            
        </div>
        
    </div>
    <div class="container mt-5" data-aos="fade-up">
        <div class="col-md-10">
            <h2 class="section_secondary_title text-left video-left-title">MathWorks Onramp courses</h2>  
        </div>
        <div class="btn-prev-mathworks"><i class="icofont-thin-left"></i></div>
        <div class="btn-next-mathworks"><i class="icofont-thin-right"></i></div>
    </div>
    <div class="container-fluid" data-aos="fade-up">
        <div class="row mt-md-5 mathworks-videos owl-carousel owl-theme">
        <?php 
                 if(isset($mathWorks)&&!empty($mathWorks))
                 {
                     foreach ($mathWorks as $key => $value) {?>
                        <div class="item">
                            <a target="_blank" href="<?php echo  $value['link'] ?>">
                                <div class="video-res">
                                    <div class="video-body">
                                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                                    </div>
                                    <img src="<?php echo base_url()?>/images/videos/<?php echo  $value['image'] ?>">
                                </div>
                                <div class="helpVideo">
                                    <div class="duration">Duration: <?php echo  $value['duration'] ?></div>
                                    <div class="video-title"><?php echo  $value['title'] ?></div>
                                </div>
                             </a>
                        </div>
                        <?php
                    }
                }
            ?>
            <!-- <div class="item">
                <div class="video-res">
                    <div class="video-body">
                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                    </div>
                    <img src="<?php echo base_url()?>/images/videos/video-1.png">
                    
                </div>
                <div class="helpVideo">
                    <div class="duration">Duration: 5 mins</div>
                    <div class="video-title">Complete idea submission for KPIT Sparkle 2021</div>
                </div>
            </div>
            <div class="item">
                <div class="video-res">
                    <div class="video-body">
                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                    </div>
                    <img src="<?php echo base_url()?>/images/videos/video-2.png">
                    
                </div>
                <div class="helpVideo">
                    <div class="duration">Duration: 5 mins</div>
                    <div class="video-title">How to submit an idea?</div>
                </div>
            </div>
            <div class="item">
                <div class="video-res">
                    <div class="video-body">
                        <div class="play"><i class="icofont-play-alt-2"></i></div>
                    </div>
                    <img src="<?php echo base_url()?>/images/videos/video-1.png">
                    
                </div>
                <div class="helpVideo">
                    <div class="duration">Duration: 5 mins</div>
                    <div class="video-title">Complete idea submission for KPIT Sparkle 2021</div>
                </div>
            </div> -->
            
        </div>
        
    </div>
</section>