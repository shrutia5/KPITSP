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
        </ul>
    </div>
</section>