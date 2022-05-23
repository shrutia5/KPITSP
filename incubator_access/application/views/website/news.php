<section class="services section-bg">
  <div class="container blogs" data-aos="fade-up">
        <h2 class="secondary_title text-center"><?php if(isset($newsList[0]->blogTitle)){echo $newsList[0]->blogTitle;}  ?></h2>
        <div class="row first pt-5">
            <div class="col-md-6 p-0">
                 <?php 
                if(isset($newsList[0]->blogImage))
                {
                ?>
                    <img src="<?php echo $this->config->item('imagesPATH')."blogImages/".$newsList[0]->blogImage;?>" alt="default Post">
                <?php
                }else
                {
                    ?>
                    <img src="<?php echo base_url();?>images/posts/default-post.jpg" alt="default Post">
                    <?php
                }   
                ?>
            </div>
            <div class="col-md-6 blog-body">
                <h3><?php if(isset($newsList[0]->blogTitle)){echo $newsList[0]->blogTitle;}  ?></h3>
                <span class="blog-date"><?php if(isset($newsList[0]->createdDate)){$cDate=date_create($newsList[0]->createdDate); echo  date_format($cDate,"d-M-Y");} ?></span>
                <?php if(isset($newsList[0]->description)){?>
                    <p class="mt-4 mb-4 card-text"><?php if (strlen($newsList[0]->description) > 200){$description = substr($newsList[0]->description, 0, 200);}else{$description=$newsList[0]->description;}echo $description; ?> <i class="icofont-long-arrow-right"></i></p>
                <?php  } ?>
            </div>
        </div>
        <div class="row first pt-5">
            <div class="blogs card-deck">
                <?php 
                    if(isset($newsList)&&!empty($newsList)) 
                    {
                        for($i=1;$i<count($newsList);$i++) {
                        ?>
                            <div class="card">
                                <?php 
                                if(!empty($newsList[$i]->blogImage))
                                {
                                ?>
                                    <img class="card-img-top" src="<?php echo $this->config->item('imagesPATH')."blogImages/".$newsList[$i]->blogImage;?>" alt="Card image cap">
                                <?php
                                }else
                                {
                                    ?>
                                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                                    <?php
                                }
                                ?>
                                <div class="card-body small-p">
                                    <h4 class="card-title mb-2"><?php echo $newsList[$i]->blogTitle; ?></h4>
                                    <span class="blog-date mb-3"><?php $cDate=date_create($newsList[$i]->createdDate); echo  date_format($cDate,"d-M-Y") ?></span>
                                    <p class="card-text"><?php if (strlen($newsList[$i]->description) > 200){$description = substr($newsList[$i]->description, 0, 200);}else{$description=$newsList[$i]->description;}
                                             echo $description; ?></p>
                                </div>
                                <div class="card-footer">
                                <a class="readNow" href="<?php echo base_url()."single/".$newsList[$i]->blogLink;?>">Know more <i class="icofont-long-arrow-right"></i></a>
                                </div>
                            </div>
                         <?php 
                        }
                    }
                ?>
                <!-- <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                    <div class="card-body small-p">
                    <h4 class="card-title mb-2">Card title</h4>
                    <span class="blog-date mb-3">11 July 2021</span>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                    <a class="readNow" href="<?php echo base_url();?>/single">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                    <div class="card-body small-p">
                    <h4 class="card-title mb-2">Card title</h4>
                    <span class="blog-date mb-3">11 July 2021</span>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                    <a class="readNow" href="<?php echo base_url();?>/single">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                    <div class="card-body small-p">
                    <h4 class="card-title mb-2">Card title</h4>
                    <span class="blog-date mb-3">11 July 2021</span>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                    <a class="readNow" href="<?php echo base_url();?>/single">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div> -->
            <!-- <div class="blogs card-deck">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                    <div class="card-body small-p">
                    <h4 class="card-title mb-2">Card title</h4>
                    <span class="blog-date mb-3">11 July 2021</span>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                    <a class="readNow" href="<?php echo base_url();?>/single">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                    <div class="card-body small-p">
                    <h4 class="card-title mb-2">Card title</h4>
                    <span class="blog-date mb-3">11 July 2021</span>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                    <a class="readNow" href="<?php echo base_url();?>/single">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/posts/default-post.jpg" alt="Card image cap">
                    <div class="card-body small-p">
                    <h4 class="card-title mb-2">Card title</h4>
                    <span class="blog-date mb-3">11 July 2021</span>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                    <a class="readNow" href="<?php echo base_url();?>/single">Know more <i class="icofont-long-arrow-right"></i></a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>