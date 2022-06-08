<div class="card-helpful">
    <div class="card-body-helpful">
            <ul class="ul-helpful">
            <?php foreach ($helpfulDetails as $key => $value) { ?>
            <li>
                <h5 class="h5-helpful"><?php echo $value->title;?></h5>
                <div class="para-helpful"><?php echo $value->description;?></div>
                <a target="_blank" class="link-helpful" href="<?php echo $value->link;?>">Read More</a>
            </li>
            <?php } ?>
        </ul>
        </div>
</div>