<main id="portal">
    <div id="portal-space"></div>
    <div class="container-fluid p-0">
        <div class="row m-0 admin-height">
            <div class="col-md-9 mobile-changes1">
                <div class="helpful-section noFooter ad-select">
                    <form id="reportFilter" action="<?php echo base_url('admin/reports');?>" method="get">
                    <input type="hidden" id="report_type" name="report_type" value=""/>
                        <div class="row">
                            <div class="col-md-4">
                                <select id="reportType" name="reportType" class="dropChange form-control">
                                    <option <?php if($filter['reportType'] == "statistics2"){echo "selected='selected'";}?> value="statistics2">Week wise statistics</option>    
                                    <!--<option <?php if($filter['reportType'] == "statistics"){echo "selected='selected'";}?> value="statistics">Statistics</option>-->
                                    <option <?php if($filter['reportType'] == "list_of_reg"){echo "selected='selected'";}?> value="list_of_reg">List of registrations</option>
                                    <option <?php if($filter['reportType'] == "all_report"){echo "selected='selected'";}?> value="all_report">All reports</option>
                                    <!-- <option <?php if($filter['reportType'] == "evaluators"){echo "selected='selected'";}?> value="evaluators">Evaluators</option>
                                    <option <?php if($filter['reportType'] == "voting_graph"){echo "selected='selected'";}?> value="voting_graph">Voting Detail Graph</option> -->
                                </select>
                            </div>  
                            <div class="col-md-2">
                                <input id="filter" type="button" value="filter"/>
                            </div>  
                            <div class="col-md-2">
                                <input id="excel" type="button" value="excel"/>
                            </div>  
                            <div class="col-md-2">
                                <input id="pdf" type="button" value="pdf"/>
                            </div>  
                        </div>
                        <?php if($filter['reportType'] == "all_report"){ ?>
                        <div class="row">
                            <div class="col-md-3">
                            <input type="radio" <?php if(isset($allrep) && $allrep == "country_wise"){echo "checked";} ?> class="dropChange" id="country_wise" name="allrep" value="country_wise"><label for="country_wise">&nbsp;Country wise</label>
                                <!-- <select class="form-control" id="country_id" name="country_id" onchange="this.form.submit()">
                                    <option value="">Select</option>
                                    <?php foreach($countryList as $key => $value){
                                        if($value->country_id == $country_id){
                                            $sel = "selected='selected'";
                                        }else{
                                            $sel="";
                                        }
                                       echo "<option ".$sel." value='".$value->country_id."' >".$value->country_name."</option>";
                                    } ?>
                                </select> -->
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "state_wise"){echo "checked";} ?> class="dropChange" id="state_wise" name="allrep" value="state_wise"><label for="state_wise">&nbsp;State wise</label>
                                <!-- <select class="form-control" id="state_id" name="state_id" onchange="this.form.submit()">
                                    <option value="">Select</option>
                                    <?php foreach ($stateList as $key => $value) {
                                        if($value->state_id == $state_id){
                                            $sel = "selected='selected'";
                                        }else{
                                            $sel="";
                                        }

                                        echo "<option ".$sel." value='".$value->state_id."'>".$value->state_name."</option>";
                                    }?>
                                </select> -->
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "city_wise"){echo "checked";} ?> class="dropChange" id="city_wise" name="allrep" value="city_wise"><label for="city_wise">&nbsp;City wise</label>
                                <!-- <select class="form-control" id="city_id" name="city_id" onchange="this.form.submit()">
                                    <option value="">Select</option>
                                    <?php foreach ($cityList as $key => $value) {
                                        if($value->city_id == $city_id){
                                            $sel = "selected='selected'";
                                        }else{
                                            $sel="";
                                        }
                                        echo "<option ".$sel." value='".$value->city_id."'>".$value->city_name."</option>";
                                    }?>
                                </select> -->
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "premier_wise"){echo "checked";} ?> class="dropChange" id="premier_wise" name="allrep" value="premier_wise"><label for="premier_wise">&nbsp;Premier colleges</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "branch_wise"){echo "checked";} ?> class="dropChange" id="branch_wise" name="allrep" value="branch_wise"><label for="branch_wise">&nbsp;Branch wise</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "degree_wise"){echo "checked";} ?> class="dropChange" id="degree_wise" name="allrep" value="degree_wise"><label for="degree_wise">&nbsp;Degree wise</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "year_of_com"){echo "checked";} ?> class="dropChange" id="year_of_com" name="allrep" value="year_of_com"><label for="year_of_com">&nbsp;Year of completion wise</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "gender_wise"){echo "checked";} ?> class="dropChange" id="gender_wise" name="allrep" value="gender_wise"><label for="gender_wise">&nbsp;Gender wise</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "week_wise"){echo "checked";} ?> class="dropChange" id="week_wise" name="allrep" value="week_wise"><label for="week_wise">&nbsp;Week wise</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" <?php if(isset($allrep) && $allrep == "top_100_clg"){echo "checked";} ?> class="dropChange" id="top_100_clg" name="allrep" value="top_100_clg"><label for="top_100_clg">&nbsp;Top 100 colleges</label>
                            </div>
                        </div>
                            <?php } ?>

                    </form>
                    <?php 
                    switch ($filter['reportType']) {
                        case 'list_of_reg':
                            $this->load->view('admin/register_report',$otherPage);
                            break;
                        case 'all_report':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'premier_wise':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'branch_wise':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'degree_wise':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'year_of_com':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'gender_wise':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'week_wise':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'top_100_clg':
                            $this->load->view('admin/all_report',$otherPage);
                        break;
                        case 'statistics':
                            $this->load->view('admin/statistics_report',$otherPage);
                        break;
                        case 'statistics2':
                            $this->load->view('admin/statistics2_report',$otherPage);
                        break;
                        case 'evaluators':
                            $this->load->view('admin/evaluators_report',$otherPage);
                        break;
                        case 'voting_graph':
                            $this->load->view('admin/voating_report',$otherPage);
                        break;
                        default: // Abhay : Added this default case in order to show Statistics reports by default on reports page.
                            $this->load->view('admin/statistics_report',$otherPage);
                        break;
                    }
                    ?> 
                </div>
            </div>
            <div class="col-md-3 mobile-col-3">
                <div class="row form-row ws-form-row m-0" style="display: block !important;">
                    <div class="full-left noFooter">
                        <p style="font-size: 18px;">Useful Links</p>
                        <hr class="admin-link">
                        <!-- <p style="font-size: 16px;" class="p1">View Evaluation progress <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                        <hr class="admin-link">
                        <p style="font-size: 16px;" class="p1">View Incubation progress <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                        <hr class="admin-link">
                        <p style="font-size: 16px;" class="p1">Schedule Webinars <a href=""><i class='bx bxs-chevron-right'></i></a></p>
                        <hr class="admin-link"> -->
                        <a href="<?php echo base_url()?>admin/reports"><p style="font-size: 16px;" class="p1">Reports <i class='bx bxs-chevron-right'></i></a></p>
                    </div>
                </div>
                <!-- <div class="row form-row ws-form-row m-0 voat-star" style="display: block !important;">
                    <div class="full-left noFooter">
                        <p style="font-size: 18px;">Voting Stats</p>
                        <hr class="admin-link">
                        <div class="row">
                            <div class="col-md-7">Project Name</div>
                            <div class="col-md-5">Count</div>
                        </div>
                        <hr class="admin-link">
                        <div class="voat-star-scroll">
                            <div class="row">
                                <div class="col-md-7"><a href="">Design with EV and thermal management with automobile</a></div>
                                <div class="col-md-5">21,000</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Eco-Generator</a></div>
                                <div class="col-md-5">16,573</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Geo Green</a></div>
                                <div class="col-md-5">12,260</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Save Electricity</a></div>
                                <div class="col-md-5">10,192</div>
                            </div>
                            <hr class="admin-link">
                            <div class="row">
                                <div class="col-md-7"><a href="">Save water</a></div>
                                <div class="col-md-5">6,061</div>
                            </div>
                            <hr class="admin-link">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reasonModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="rejectAction" value="rejectProject">
        <textarea placeholder="Start writing here..."  class="form-control" id="textReason" required>Ok</textarea>
        <p class='error hide' id="rejection-error">Please provide some reason</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="rejectConfirm" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>