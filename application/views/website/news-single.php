<section class="services section-bg">
  <div class="container blogs" data-aos="fade-up">
        <h1 class="page-title text-center">Stay updated 24 X 7</h1>
        <div class="page-subtitle text-center">Subscribe to our newsletter for getting competition-related announcement alerts</div>
        
    </div>
</section>
<div class="container">
    <div class="blog-single">
        <div class="blog-single-header">
            <span class="back"><i class="icofont-thin-left"></i></span>
            <h3 class="title"><?php echo $news->blogTitle ?></h3>
            <span class="blog-date"><?php $cDate=date_create($news->createdDate); echo  date_format($cDate,"d-M-Y")  ?></span>
        </div>
        <div class="blog-body">
            <p><?php echo $news->description;  ?></p>
        </div>
    </div>
</div>
<section class="services section-bg">
    
    <div class="btn-owl btn-prev-otherBlogs"><i class="icofont-thin-left"></i></div>
    <div class="btn-owl btn-next-otherBlogs"><i class="icofont-thin-right"></i></div>
    <div class="container" data-aos="fade-up">
        <h1 class="page-title text-center">OTHER BLOGS</h1>
        <div class="ws-cards-horizontal row mt-5 otherBlogs owl-carousel owl-theme">
            <?php  
            if(isset($newsList)&&!empty($newsList)) 
                {
                    foreach ($newsList as $value) {
                        ?>
                        <div class="item mb-3 pl-2 pr-2">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-white"><?php echo$value->blogTitle ?></h4>
                                    <span class="card-date"><?php $cDate=date_create($value->createdDate); echo  date_format($cDate,"d-M-Y")  ?></span>
                                </div>
                                <div class="card-footer">
                                    <a class="readNow" href="<?php echo base_url()."single/".$value->blogLink;?>">Know more <i class="icofont-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php 
                    }
                }
            ?>
            <!-- <div class="item mb-3 pl-2 pr-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">23 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 pl-2 pr-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">11 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 pl-2 pr-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">10 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 pl-2 pr-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">11 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="item mb-3 pl-2 pr-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-white">Beyond Awards - All that KPIT Sparkle has to offer</h4>
                        <span class="card-date">10 July 2021</span>
                    </div>
                    <div class="card-footer">
                        <a class="readNow" href="#">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>