<section class="services section-bg">
    <div class="container blogs" data-aos="fade-up">
        <h2 class="secondary_title text-center">Feel free to ping us anytime.</h2>
        <div class="page-subtitle text-center">Drop a mail or call us to know more</div>
        <div class="row first pt-5">
            <div class="col-md-6 contact-us-over pr-md-0">
                <img src="<?php echo base_url(); ?>/images/contact-us.jpg">
            </div>
            <div class="col-md-6 conact-us-form">
                <form id="contactUsForm" action="<?php echo base_url(); ?>contactUsForm"  method="post">
                    <div class="form-row">
                        <div class="col-12 form-group">
                            <label>Enquiry Type*</label><br/>
                            <select name="enquryType" id="enquryType" class="form-control">
                                <option selected="" value="Student">Student</option>
                                <option value="For Incubation">For Incubation</option>
                            </select>
                            <div class="validate"></div>
                        </div>
                        <div class="col-12 form-group">
                            <label class="studentShow">Full Name*</label>
                            <label class="forIncubation">Company/Institute Name*</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                        </div>
                        <div class="col-12 form-group">
                            <label>Email ID*</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                            <div class="validate"></div>
                        </div>
                        <div class="col-12 form-group studentShow">
                            <label>Contact Number*</label>
                            <input type="text" class="form-control" name="contactNumber" id="contactNumber" placeholder="Enter your number">
                            <div class="validate"></div>
                        </div>
                        <div class="col-12 form-group forIncubation">
                            <label>Reason Of Contacting?</label>
                            <select id="conReason" name="conReason">
                                <option value="">Select</option>
                                <option value="Want to partner with the contest">Want to partner with the contest</option>
                                <option value="Need more Information">Need more Information</option>
                                <option value="Need ideas for startup incubations">Need ideas for startup incubations</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="validate"></div>
                        </div>
                        <div class="col-12 form-group">
                            <label>Any Message</label><br/>
                            <textarea style="width:100%" id="message" name="message" placeholder="Write here...."></textarea>
                        </div>
<!--                        <div class="col-12 form-group">
                            <div class="g-recaptcha" data-sitekey="6LeK_UocAAAAAEnGzLYLbgZRCFa4tdqo7Gd7A66g"></div>
                        </div>-->
                        <div class="col-12 form-group">
                            <input type="submit" name="save" id="save" value="SEND"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
