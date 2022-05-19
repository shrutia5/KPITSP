<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpful extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        // Your own constructor code
    }
	public function index()
	{
        //faq list
        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("status ="=>"'active'");
        $faqs=$this->CommonModel->GetMasterListDetails('*',"faqMaster",$where,'','',$join=array(),$other);

        //videos
        $usefulVideos=array();
        $usefulVideos[0]['title'] ="How to submit an idea?";
        $usefulVideos[0]['link'] ="https://www.youtube.com/watch?v=SQyeLY6Wldc";
        $usefulVideos[0]['duration']="01:09 min";
        $usefulVideos[0]['image'] ="vishal.JPG";
        // $usefulVideos[0]['image'] ="useful-video-idea.png";

        $usefulVideos[1]['title'] ="Get to know about all the TRL Levels";
        $usefulVideos[1]['link'] ="https://www.youtube.com/watch?v=OvE_fnAqi-k&list=PLreiOfKMvymCSv73puCUXHK6hu7DCPJoQ&index=7&t=26s";
        $usefulVideos[1]['duration']="04:13 min";
        $usefulVideos[1]['image'] ="two.jpg";
        // $usefulVideos[1]['image'] ="Get_know_about_Levels.png";

        $usefulVideos[2]['title'] ="Know about submitting ideas in Mobility";
        $usefulVideos[2]['link'] ="https://www.youtube.com/watch?v=lFYfWUrDYUA&list=PLreiOfKMvymCSv73puCUXHK6hu7DCPJoQ&index=8&t=6s";
        $usefulVideos[2]['duration']="09:35 min";
        $usefulVideos[2]['image'] ="three.jpg";
        // $usefulVideos[2]['image'] ="Submittingideasinmobility.png";

        $usefulVideos[3]['title'] ="About TRIZ Methodology";
        $usefulVideos[3]['link'] ="https://www.youtube.com/watch?v=zW2gFnq1GgA&list=PLreiOfKMvymCSv73puCUXHK6hu7DCPJoQ&index=9&t=11s";
        $usefulVideos[3]['duration']="12:47 min";
        $usefulVideos[3]['image'] ="four.jpg";
        // $usefulVideos[3]['image'] ="About_TRIZ_Methodology.png";

        $usefulVideos[4]['title'] ="Using Lean canvas model for submitting ideas";
        $usefulVideos[4]['link'] ="https://www.youtube.com/watch?v=NAMJkl9nRYQ&list=PLreiOfKMvymCSv73puCUXHK6hu7DCPJoQ&index=10&t=6s";
        $usefulVideos[4]['duration']="06:07 min";
        $usefulVideos[4]['image'] ="five.jpg";
        // $usefulVideos[4]['image'] ="Using_Lean_submitting_ideas.png";

        $usefulVideos[5]['title'] ="Complete idea submission for KPIT Sparkle 2021";
        $usefulVideos[5]['link'] ="https://www.youtube.com/watch?v=kIthrux0t3s&list=PLreiOfKMvymCSv73puCUXHK6hu7DCPJoQ&index=11&t=5s";
        $usefulVideos[5]['duration']="10:17 min";
        $usefulVideos[5]['image'] ="six.jpg";
        // $usefulVideos[5]['image'] ="Complete_idea_submission_for_KPIT_Sparkle.png";

        $usefulVideos[6]['title'] ="Know about submitting ideas in Energy";
        $usefulVideos[6]['link'] ="https://www.youtube.com/watch?v=1S7LBrrgaQw&list=PLreiOfKMvymCSv73puCUXHK6hu7DCPJoQ&index=12&t=6s";
        $usefulVideos[6]['duration']="10:17 min";
        $usefulVideos[6]['image'] ="seven.jpg";
        // $usefulVideos[6]['image'] ="Know_about_submitting_ideas_in_Energy.png";

        // print_r($usefulVideos);exit;
        $protoTypeVideos=array();
        $protoTypeVideos[0]['title'] ="KPIT Sparkle 2021 Platinum Award Winner";
        $protoTypeVideos[0]['link'] ="https://www.youtube.com/watch?v=hl34Dj60vSg";
        $protoTypeVideos[0]['duration']="05:45 min";
        $protoTypeVideos[0]['image'] ="platinum.JPG";
        // $protoTypeVideos[0]['image'] ="Prototype_KPIT _Sparkle_2021_Platinum_Award_Winner.png";

        $protoTypeVideos[1]['title'] ="KPIT Sparkle 2021 Gold Award Winner";
        $protoTypeVideos[1]['link'] ="https://www.youtube.com/watch?v=4MG7V9JN7Qk";
        $protoTypeVideos[1]['duration']="06:19 min";
        $protoTypeVideos[1]['image'] ="gold.JPG";
        // $protoTypeVideos[1]['image'] ="Prototype_KPIT_Sparkle_2021_Gold_Award_Winner.png";

        $protoTypeVideos[2]['title'] ="KPIT Sparkle 2021 Silver1 Award Winner";
        $protoTypeVideos[2]['link'] ="https://www.youtube.com/watch?v=s3wiqVmycC8";
        $protoTypeVideos[2]['duration']="06:07 min";
        $protoTypeVideos[2]['image'] ="silver1.JPG";
        // $protoTypeVideos[2]['image'] ="Prototype_KPIT_Sparkle_2021_Silver1_Award_Winner.png";

        $protoTypeVideos[3]['title'] ="KPIT Sparkle 2021 Silver2 Award Winner";
        $protoTypeVideos[3]['link'] ="https://www.youtube.com/watch?v=EjZrL9L7yXQ";
        $protoTypeVideos[3]['duration']="02:19 min";
        $protoTypeVideos[3]['image'] ="silver2.JPG";
        // $protoTypeVideos[3]['image'] ="Prototype_KPIT_Sparkle_2021_Silver2_Award_Winner.png";

        //////MathWorks Onramp courses
        $mathWorks=array();
        $mathWorks[0]['title'] ="MATLAB Onramp";
        $mathWorks[0]['link'] ="https://in.mathworks.com/learn/tutorials/matlab-onramp.html";
        $mathWorks[0]['duration']="01:17 min";
        $mathWorks[0]['image'] ="matlab1.JPG";
        // $mathWorks[0]['image'] ="MATLABOnramp.png";

        $mathWorks[1]['title'] ="Simulink Onramp";
        $mathWorks[1]['link'] ="https://in.mathworks.com/learn/tutorials/simulink-onramp.html";
        $mathWorks[1]['duration']="01:28 min";
        $mathWorks[1]['image'] ="matlab2.JPG";
        // $mathWorks[1]['image'] ="MathWork_Siulink_Onramp.png";

        $mathWorks[2]['title'] ="Stateflow Onramp";
        $mathWorks[2]['link'] ="https://in.mathworks.com/learn/tutorials/stateflow-onramp.html?s_tid=srchtitle";
        $mathWorks[2]['duration']="01:23 min";
        $mathWorks[2]['image'] ="matlab3.JPG";
        // $mathWorks[2]['image'] ="MathworkStateflowOnramp.png";

        $mathWorks[3]['title'] ="Machine Learning Onramp";
        $mathWorks[3]['link'] ="https://in.mathworks.com/learn/tutorials/machine-learning-onramp.html";
        $mathWorks[3]['duration']="02:21 min";
        $mathWorks[3]['image'] ="matlab4.JPG";
        // $mathWorks[3]['image'] ="Mathworkmachinelearning.png";
        
        $mathWorks[4]['title'] ="Image Processing Onramp";
        $mathWorks[4]['link'] ="https://in.mathworks.com/learn/tutorials/image-processing-onramp.html";
        $mathWorks[4]['duration']="01:48 min";
        $mathWorks[4]['image'] ="matlab5.JPG";
        // $mathWorks[4]['image'] ="MathworkImageProcessing Onramp.png";

        $data=array();
        $data['faqList']=$faqs;
        $data['usefulVideos']=$usefulVideos;
        $data['mathWorks']=$mathWorks;
        $data['protoTypeVideos']=$protoTypeVideos;
        $data['pageTitle']="Helpful-resources";
        $data['metaDescription']="metaDescription";
        $data['metakeywords']="metakeywords";
        $this->load->view('website/header',$data);
        $this->load->view('website/helpful-resources',$data);
        $this->load->view('website/footer');
	}
    
}
