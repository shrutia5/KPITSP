<?php
$senderInitials = substr($this->session->userdata('name'),0,1).substr($this->session->userdata('lname'),0,1);
$userId = $this->session->userdata('userId');
?>
<!-- <div class="container"> -->
<input type="hidden" id="sender_initials" value="<?php echo strtoupper($senderInitials);?>">
<div class="messageout">
    <span class="unreadCount"></span>
    <div class="row">
        <div class="col-md-12 col-12 top-txt">
            <a href="<?php echo base_url();?>student/project"><i class="bx bxs-chevron-left bx-sm mentor-msg" style="color:#C8C8C8;"></i></a>
            <div class="header messageOpen">
                Message to <span><i class='bx bxs-chevron-down chat-box-head' id="message-arrow-down-icon"></i></span>
            </div>
        </div>

    </div>

    <div class="body" id="mobile-chatbox-body">
        <div class="container pt-2 conversations">
            <?php
            if(isset($projectsMessages) && !empty($projectsMessages)){
    
                foreach($projectsMessages as $mObj){
                    $msgDay = date("d M", strtotime($mObj->created_date));
                    if($msgDay == date("d M")){
                        $msgDay = "Today";
                    }else{

                    }
                    $msgTime = date("h:i a", strtotime($mObj->created_date));
                    if($userId == $mObj->sender_id){
                        ?>
                        <div class="row">
                            <div class="col-md-10 col-10 p-2">
                                <div class="left-chat">
                                    <p class="msg-p p-2"><?php echo $mObj->message;?></p>
                                </div>
                                <span class="time-txt"><?php echo $msgDay.', '.$msgTime;?></span>
                            </div>

                            <div class="col-md-2 col-2 p-0">
                                <p class="right-txt"><?php echo $senderInitials;?></p>
                            </div>
                        </div>
            <?php
                    }else{
                        $mSenderInitials = "";
                        if($mObj->by_admin=='y'){
                            $mSenderInitials = "AD";
                        }else{
                            $mSenderInitials = strtoupper(substr($mObj->firstname,0,1).substr($mObj->lastName,0,1));
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <p class="right-txt11"><?php echo $mSenderInitials;?></p>
                            </div>
                            <div class="col-md-10 col-10 p-2">
                                <div class="left-chat">
                                    <p class="msg-p p-2"><?php echo $mObj->message;?></p>
                                </div>
                                <span class="time-txt11"><?php echo $msgDay.', '.$msgTime;?></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }?>
        </div>
        <ul class="messageConversation">
            <li class="sender">
                <div class="d-flex">
                    <div class="message"></div>
                    <!-- <div class="icon-name" title=""></div> -->
                    <!-- <div class="icon-name" title="Evaluator Team">ET</div> -->
                </div>
                <span class="time"></span>
            </li>
            <li class="receiver">
                <!-- <div class="icon-name" title=""></div> -->
                <!-- <div class="icon-name" title="Evaluator Team">ET</div> -->
                <div class="message"></div>
                <span class="time"></span>
            </li>
            <div class="default-msg d-md-flex align-items-left">
                <!--<span>Start Conversion</span> -->
            </div>
        </ul>
        <div class="footer">
            
            <input type="hidden" name="msgProjectID" id="msgProjectID" value="<?php echo $projectd->projectID;?>" />
            <input type="hidden" name="senderId" id="senderId" value="<?php echo $userId;?>" />
            <input type="hidden" name="recId" id="recId" value="" />

            <i class='bx bx-smile'></i>
            <input id="messagetxt" type="text" placeholder="Write here..." name="messagetxt" value="" />
            <button type="submit" name="sendMsg" id="sendMsg" class="sendMsg">Send</button>
        </div>
    </div>
</div>
</div>