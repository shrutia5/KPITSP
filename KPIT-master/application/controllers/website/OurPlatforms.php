<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OurPlatforms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel');
        // Your own constructor code
    }
	public function index()
	{
        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("status ="=>"'active'");
        $faqs=$this->CommonModel->GetMasterListDetails('*',"faqMaster",$where,'3','',$join=array(),$other);

        $protoTypeVideos=array();
        $protoTypeVideos[0]['title'] ="KPIT Sparkle 2021 Platinum Award Winner";
        $protoTypeVideos[0]['link'] ="https://www.youtube.com/watch?v=7flqXIBUEdw";
        $protoTypeVideos[0]['duration']="02:03 min";
        $protoTypeVideos[0]['image'] ="PlatinumAwardWinner.png";
        // $protoTypeVideos[0]['image'] ="Prototype_KPIT _Sparkle_2021_Platinum_Award_Winner.png";

        $protoTypeVideos[1]['title'] ="KPIT Sparkle 2021 Gold Award Winner";
        $protoTypeVideos[1]['link'] ="https://www.youtube.com/watch?v=1Ene3AvEzbw";
        $protoTypeVideos[1]['duration']="01:39 min";
        $protoTypeVideos[1]['image'] ="GoldAwardWinner.png";
        // $protoTypeVideos[1]['image'] ="Prototype_KPIT_Sparkle_2021_Gold_Award_Winner.png";

        $protoTypeVideos[2]['title'] ="KPIT Sparkle 2021 Silver1 Award Winner";
        $protoTypeVideos[2]['link'] ="https://www.youtube.com/watch?v=Tn420lXQCSc";
        $protoTypeVideos[2]['duration']="02:11 min";
        $protoTypeVideos[2]['image'] ="SilverAward1Winner.png";
        // $protoTypeVideos[2]['image'] ="Prototype_KPIT_Sparkle_2021_Silver1_Award_Winner.png";

        $protoTypeVideos[3]['title'] ="KPIT Sparkle 2021 Silver2 Award Winner";
        $protoTypeVideos[3]['link'] ="https://www.youtube.com/watch?v=7O9ZWJ7-F40";
        $protoTypeVideos[3]['duration']="02:35 min";
        $protoTypeVideos[3]['image'] ="SilverAward2Winner.png";
        // $protoTypeVideos[3]['image'] ="Prototype_KPIT_Sparkle_2021_Silver2_Award_Winner.png";
        $data=array();
        $data['faqList']=$faqs;
        $data['protoTypeVideos']=$protoTypeVideos;
        $data['pageTitle']="i-INNOVATE";
        $data['metaDescription']="metaDescription";
        $data['metakeywords']="metakeywords";
		$this->load->view('website/header',$data);
        $this->load->view('website/i-INNOVATE',$data);
        $this->load->view('website/footer');
	}
}
