<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid text-white">
        <div class="row">
            <div class="col-md-3">
                <div class="innovative d-inline-flex">
                    <h4>Innovate Finalist</h4>
                    <form action="" id="juryFilter">
                    <select name="filterOption" id="filterOption">
                        <option <?php if(isset($_GET['filterOption']) && !empty($_GET['filterOption']) && $_GET['filterOption']== "All"){ echo "selected";}?> value="All">All</option>
                        <option <?php if(isset($_GET['filterOption']) && !empty($_GET['filterOption']) && $_GET['filterOption']== "top10"){ echo "selected";}?> value="top10">Top 10</option>
                    </select>
                            </form>
                    <!-- <i class="bx bxs-chevron-down mt-1" id="togglemenu"></i> -->
                </div>
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-3">
                <div class="list-view11 d-inline-flex">
                    <ul class="nav nav-pills view">
                        <li class="nav-item">
                            <a class='bx bx-list-ul bx-md'  data-toggle="pill" href="#screen2"></a>
                        </li>
                        <li class="nav-item">
                            <a  class='bx bx-grid bx-md active' data-toggle="pill" href="#screen1"></a>
                        </li>
                    </ul>
                    <div id="finalistsData_filter" class="dataTables_filter">
                        <input type="search" class="form-control form-control-sm" placeholder="search here"
                                    aria-controls="finalistsData"><i class='bx bx-search bx-md'></i>
                    </div>
                </div>
                

        </div>
        <div class="container-fluid tab-content">
        <div  id="screen1" class="tab-pane active" style="width: 100%;">
        <div  class="row view-group mt-4" >
            <?php $i=1; 
            if(isset($juryFinalists) && !empty($juryFinalists)){
                foreach ($juryFinalists as $key => $juryList) {  ?>
                <div class="item col-xs-3 col-lg-3 col-md-3">
                    <div class="owl-item" style="width: auto;">
                            <div class="video-res">
                                <div class="img-top-text">
                                    #<?php 
                                    if($i < 10) {
                                        echo '0'.$i;
                                    } else {
                                        echo $i;
                                    }
                                     ?>
                                </div>
                                <div class="video-body">
                                    <div class="play"><i class="icofont-play-alt-2"></i></div>
                                </div>
                            
                                <img src="<?php echo base_url();?>images/clients/car.jpg">
                            </div>
                            <div class="content">
                                <p class="p1"><?php echo $juryList->sparkleID; ?></p>
                                <p class="p2"><?php echo $juryList->projectName; ?></p>
                                <p class="p1"><?php echo "Team" ?></p>
                                <p class="p4"><?php echo "vertax"; ?></p>
                                <div class="mt-4 view3">
                                    <a href="<?php echo base_url();?>jury/projectDetail/<?php echo $juryList->projectID ?>">VIEW PROJECT</a>
                                </div>
                            </div>
                    </div>
                </div> 
            <?php $i++; } } ?>  
        </div>
    </div>
        <!-- list view -->
        <div id="screen2" class="container-fluid tab-pane fade" >
        <div  class="row view-group table-group mt-4">
            <div class="col-md-12 col-12">
                <div class="table-responsive">
                    <table class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="approvetable" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Top: activate to sort column descending" style="border-top: none;">No.</th>
                                <th class="sorting" tabindex="0" aria-controls="approvetable" rowspan="1" colspan="1"
                                    aria-label="Sparkle ID: activate to sort column ascending" style="width: 73.75px;border-top: none;">
                                    Sparkle ID</th>
                                <th class="sorting" tabindex="0" aria-controls="approvetable" rowspan="1" colspan="1"
                                    aria-label="Project Name: activate to sort column ascending"
                                    style="width: 53.75px;border-top: none;">Project Name</th>
                                <th class="sorting" tabindex="0" aria-controls="approvetable" rowspan="1" colspan="1"
                                    aria-label="Category: activate to sort column ascending" style="width: 58.75px;border-top: none;">
                                    Team</th>
                                <th class="sorting" tabindex="0" aria-controls="approvetable" rowspan="1" colspan="1"
                                    aria-label="Sub-Category: activate to sort column ascending"
                                    style="width: 67.75px;border-top: none;">Members</th>
                                <th class="sorting" tabindex="0" aria-controls="approvetable" rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending" style="width: 41.75px;border-top: none;">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=1;
                            if(isset($juryFinalists) && !empty($juryFinalists)){
                                foreach ($juryFinalists as $key => $juryList) { ?>
                                    <tr class="odd">
                                    <td><?php 
                                    if($i <10){
                                        echo '0'.$i;
                                    }else{
                                    echo $i; }?></td>
                                     <td><a href="<?php echo base_url()?>jury/projectDetail/<?php echo $juryList->projectID ?>" target="_blank"><?php echo $juryList->sparkleID?></a></td>
                                     <td width="500px"><?php echo $juryList->projectName?></td>
                                     <td width="100px"><?php echo $juryList->categoryID?></td>
                                     <td width="200px">
                                         <?php
                                            if(isset($juryList->jurymem)&&!empty($juryList->jurymem)){
                                                foreach ($juryList->jurymem as $key => $juryMember) {
                                                   echo ucfirst($juryMember->firstname).",";
                                                }
                                            }
                                         ?>
                                     </td>
                                     <td width="150px">
                                         <?php if($juryList->juryAction == "Top 10" && $_GET['filterOption']== "top10"){ ?>
                                             <a href="#removeTop10" class="juryremove" data-proId="<?= $juryList->projectID ?>" data-id="<?= $juryList->sparkleID ?>"  data-toggle="modal">Remove from top 10</i></a>
                                        <?php } else{?>
                                         <a href="#prototypeVideojury" class="juryaction" data-id="<?= $juryList->sparkleID ?>" data-url="<?= base_url()?>images/studentFiles/<?= $juryList->sparkleID?>/<?= $juryList->prototypeProgressVideo?>" data-value="<?= $juryList->prototypeProgressVideo ?>" data-toggle="modal"><i class="bx bx-play-circle"></i></a>
                                        <?php } ?>
                                        </td>
                                 </tr>
                             <?php   $i++; }
                            
                            } ?>       
                        </tbody>
                        <!--Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>

<!-- Modal -->
<div class="modal fade" id="prototypeVideojury" tabindex="-1" role="dialog" aria-labelledby="prototypeVideojuryTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <video  id="v1" width="100%" height="240" controls="controls">
            <source src="video.mp4" type="video/mp4" />
        </video>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="removeTop10" tabindex="-1" role="dialog" aria-labelledby="removeTop10Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p class="jurymodal-title">Remove From Top 10?</p>
        <p class="jurymodal-remove"></p>
        <div class="jurytop10Btn">
            <a href="" data-dismiss="modal">NO</a>
            <input type="submit" class="removetop" data-dismiss="modal" value="YES">
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script>
    $(document).ready(function () {
        $("#list").click(function () {
            $('#list-table').show();
            $('.view-group').hide();

        });
       
    });
</script> -->
