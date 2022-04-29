<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0 mb-2">
        <div class="">
            <!-- <div class="incuFinalist">
                <span>Innovate Finalists</span>
                <i class='bx bx-chevron-down'></i>
            </div> -->
            <div class="col-md-3" style="z-index: 10;">
                <select class="invoFilter form-select" aria-label="" style="position: absolute;top: 10px;left: 19px;">
                    <option <?php if($type == "top") { echo "selected"; } ?> value="top">Top 100</option>
                    <option <?php if($type == "finalist") { echo "selected"; } ?> value="finalist">Finalist</option>
                    <option <?php if($type == "kpitSelect") { echo "selected"; } ?> value="kpitSelect">Kpit Recommendation</option>
                </select>
                <!-- <a onclick="$('.incuFina-content').toggle('display-none');"> <span class="change-text">Innovate Finalists</span><i class='bx bx-chevron-down'></i>
                <div class="incuFina-content">
                    <input type="radio" name="incubateFina" id="top100" value="top">
                    <label for="top">Top 100</label><br>
                    <input type="radio" name="incubateFina" id="finalist" value="finalist">
                    <label for="finalist">Finalist</label><br>
                    <input type="radio" name="incubateFina" id="recommendation" value="recommendation">
                    <label for="recommendation">Kpit Recommendation</label><br>
                </div>
                </a> -->
            </div>
            <!--<span class="search-icon"><i class='bx bx-search-alt-2'></i></span>-->
        </div>
        <div class="container-fluid p-0 incu-dash">
        <table id="incubatorFinalist" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sparkle ID</th>
                <th>Project Name</th>
                <th>Category</th>
                <th>SubCategory</th>
                <th>Incubated By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $userID = $this->session->userdata('userId');
                if(!empty($finalists)){
                    $i=-1;
                    foreach ($finalists as $key => $rec) {
            ?>
            <tr>
                <td><a href="<?php echo base_url()?>incubator/project-details/<?php echo  $rec->projectID ?>" target="_blank"><?php echo $rec->sparkleID ?></a></td>
                <td><?php echo $rec->projectName ?></td>
                <td>
                <?php 
                    if(isset($rec->category_name)){ echo $rec->category_name; }
                ?>
                </td>
                <td>
                <?php 
                if(isset($rec->sub_cat_name)){ echo $rec->sub_cat_name; }
                ?>
                </td>
                <td><?php
                $canIncubated = true;
                $whereCnd = array("projectID ="=>$rec->projectID);
                $join = array();
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="userregistration";
                $join[0]['alias'] ="inc";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                
                $incubators = $this->CommonModel->GetMasterListDetails("inc.userID,firstname,otherCollege",'project_incubation',$whereCnd,'','',$join,array('orderBy'=>'incubationDate', 'order'=>'ASC'));
                if(!empty($incubators)){
                    $arrInc = array();
                    foreach($incubators as $incubator){
                        if($incubator->userID == $userID){
                            $canIncubated = false;
                        }
                        $arrInc[] = $incubator->otherCollege;
                    }
                    $arrInc = array_filter($arrInc);
                    echo implode(", ", $arrInc);
                }
                ?></td>
                <td><?php if($canIncubated){ ?>
                        <button type="button"  class="incubateSelect actionBtn btn btn-link" data-id="<?= $rec->projectID ?>" data-value="<?= $rec->incubateAction; ?>">Incubate</button>
                        <?php }else{ ?>
                            <button type="button" class="incubateRemove actionBtn btn btn-link" data-id="<?= $rec->projectID ?>" data-value="<?= $rec->incubateAction; ?>">Remove</button>
                       <?php } ?>
                    
                    <!-- <a href="#incubator" onclick="myFunc();" data-id="<?= $rec->projectID ?>" id="<?= $rec->incubateAction; ?>" class="actionValue" data-index="<?= $i ?>"  data-toggle="modal" style="text-transform: capitalize;"><?= $rec->incubateAction; ?></a> -->
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
        </div>
    </div>
</main>

