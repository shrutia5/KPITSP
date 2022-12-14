<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $patnerList=$this->CommonModel->GetMasterListDetails('*',"ourclients",$where,'','',$join=array(),$other);

     // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v11.0/108335314922293?fields=posts.limit(10)%7Bfull_picture%2Ccreated_time%2Cmessage%7D%2Clink%2Csingle_line_address&access_token=EAAFqRKX5ZCvABAGufFHdWuJ3nBujS1r2OURzepuI2Kgo5KotRnaQ8ZAuQiPS37pbQR2v4X6EtPGGFhOzzcfWE7lapHvwyyZBZAXAjcDgZAZBPYZAXxh7Y5gcX8jm9RJaSVSLFXmtwS6V6h5w6YFWiZAWelblORQ8lPpSEk8x3HaZBN0ToYxR6X5wfP72ZAg4SWQZCgZD');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $result=json_decode($result);
        // echo "<pre>";
        // print_r($result);exit;
        $mediaList=array();
        foreach($result->posts->data as $list)
        {
            $message="";
            $pic="";
            if(isset($list->full_picture))
            {
                $pic=$list->full_picture;
            }

            if(isset($list->message))
            {
                $message=$list->message;
            }
            // echo "<pre>";
            // print_r();exit;
            $socialData=array();
            $socialData['picture']=$pic;
            $socialData['message']=$message;
            $timeArr=explode("T",$list->created_time);
            $socialData['createdTime']=$timeArr[0];
            $socialData['fblink']=$result->link;
            $loadMore=$result->posts->paging->cursors->after;
            array_push($mediaList,(object)$socialData);

        }
        // print_r($mediaList);exit;
        $data=array();
        $data['patnerList']=$patnerList;
        $data['mediaList']=$mediaList;
        $data['loadMore']=$loadMore;

		$this->load->view('website/header');
        $this->load->view('website/home',$data);
        $this->load->view('website/footer');
	}
    public function news()
	{
		$this->load->view('website/header');
        $this->load->view('website/news');
        $this->load->view('website/footer');
	}
}
