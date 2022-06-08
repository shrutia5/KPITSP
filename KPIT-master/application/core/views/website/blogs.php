<section class="services section-bg">
    <div class="container blogs" data-aos="fade-up">
        <h1 class="page-title text-center">Stay updated 24 X 7</h1>
        <div class="page-subtitle text-center">Subscribe to our newsletter for getting competition-related announcement alerts</div>
    </div>
    <div class="container" data-aos="fade-up">
        <div class="ws-cards-horizontal row mt-5">
            <?php 
                if(isset($blogList)&&!empty($blogList)) 
                {
                    foreach ($blogList as $value) {
                        ?>
                            <div class="item mb-3 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-white normal titleHeight"><?php  
                                        $blogTitle = $value->blogTitle;
                                         if(strlen($value->blogTitle)>45)
                                         {  
                                            $blogTitle = substr($value->blogTitle,0,50).""."...";  
                                         }
                                        

                                        echo $blogTitle ?></h4>
                                        <span class="card-date"><?= $value->createdDate ?></span>
                                    </div>
                                    <div class="card-footer">
                                        <a class="readNow" href="<?php echo base_url()."/blog/".$value->blogLink;?>">Know more <i class="icofont-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php 
                    }
                }
            ?>

            
            <!-- <div class="item mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white normal">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">11 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="<?php echo base_url();?>/blog">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white normal">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">10 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="<?php echo base_url();?>/blog">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white normal">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">11 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="<?php echo base_url();?>/blog">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white normal">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">10 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="<?php echo base_url();?>/blog">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white normal">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">10 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="<?php echo base_url();?>/blog">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>