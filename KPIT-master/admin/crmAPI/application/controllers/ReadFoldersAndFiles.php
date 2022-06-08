<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReadFoldersAndFiles extends CI_Controller {

	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('CommonModel');
		$this->load->model('TraineeModel');
		$this->load->library("pagination");
		$this->load->library("response");
		$this->load->library("ValidateData");
	}

	public function readFoldersAndFiles()
	{	

		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$nestedFolderPath = $this->input->post('nestedFolderPath');
		$folderName = $this->input->post('folderName');
		$folderCurrentPath = $this->input->post('folderCurrentPath');
		$mediapath = $this->config->item("imagesPATH");
		 // echo $nestedFolderPath;exit();
		

			$readedFiles=array();
			if((isset($nestedFolderPath))&&(!empty($nestedFolderPath)))
			{
				$mediapath=$nestedFolderPath;
			}

			if (is_dir($mediapath)){
  				if ($dh = opendir($mediapath)){
    				while (($file = readdir($dh)) !== false){
      					$fname=pathinfo($file);
      					if($fname['basename']!="."&&$fname['basename']!="..")
      				{
      					$fname['realpath']=$mediapath;
      					$fname['folderName']=$folderName;
      					$fname['folderCurrentPath']=$folderCurrentPath;
      					// echo realpath($file);exit();
      					$readedFiles[]=	$fname;
      				}
      				
    			}
   			 closedir($dh);
  			}
		}
		$paths=array();
		$paths['realpath']=$mediapath;
		$paths['folderCurrentPath']=$folderCurrentPath;
		$paths['folderName']=$folderName;
		$status['data'] = $readedFiles;
		$status['paths']=$paths;
		if($readedFiles){
		$status['msg'] = "sucess";
		$status['statusCode'] = 400;
		$status['flag'] = 'S';
		$this->response->output($status,200);

		}else{
		$status['msg'] = $this->systemmsg->getErrorCode(227);
		$status['statusCode'] = 227;
		$status['flag'] = 'F';
		$this->response->output($status,200);
		}	


	}
		public function addFilesInFolder(){

		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		// echo $mediapath = $this->config->item("imagesPATH");exit();
		/////////images............
		$image64 = $this->input->post('fileList');

			$imagetoup = $this->validatedata->validate('folderPath','folderPath',false,'',array()); 

			
			foreach ($image64 as $value) {
  				$myPath=$imagetoup."myImage_".rand(1,9999).".png";
				$saveImage = $this->base64_to_jpeg($value,$myPath);
			}
		if($saveImage){
		$status['msg'] = "sucess";
		$status['statusCode'] = 400;
		$status['flag'] = 'S';
		$this->response->output($status,200);

		}else{
		$status['msg'] = $this->systemmsg->getErrorCode(227);
		$status['statusCode'] = 227;
		$status['flag'] = 'F';
		$this->response->output($status,200);
		}	

				//......................

	}	

	public function addFilesInFolder2($pathTOSave){

		
		 $pathTOSave=str_replace("_","/", $pathTOSave);
		$this->load->library('realtimeupload');
		// $pathTOSave = $this->config->item('imagesPATH');
		  // echo $pathTOSave;exit();
		if (!is_dir($pathTOSave)) {
			mkdir($pathTOSave,0777);
    		chmod($pathTOSave,0777);         
		}
		else{
			if (!is_writable($pathTOSave)) {
				chmod($pathTOSave,0777);
			}
		}
		$settings = array(
			'uploadFolder' => $pathTOSave,
			'extension' => ['png','pdf','jpg', 'jpeg', 'gif', 'mp4', 'avi', 'mkv', 'mp3', 'ogg', 'wav', 'docx', 'doc', 'xls', 'xlsx'],
			'maxFolderFiles' =>0,
			'maxFolderSize' => 0,
			'returnLocation' => true,
			'uniqueFilename'=> false,
			'dbTable'=>'',
			'fileTypeColumn'=>'',
			'fileColumn'=>'',
			'forignKey'=> '',
			'forignValue'=> '',
			'docType'=>"",
			'docTypeValue'=>'',
			'isSaveToDB'=>"N",
		);
		//$uploader = new RealTimeUpload();
		$this->realtimeupload->init($settings);
	}
	public function addDIR()
	{

		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$dirName = $this->input->post('dirName');
		$folderPath = $this->input->post('folderPath');

		$dirName=str_replace(" ","", $dirName);

		if (!is_dir($folderPath.$dirName)) {
			mkdir($folderPath.$dirName,0777);
    		chmod($folderPath.$dirName,0777);


    		$status['msg'] = "sucess";
			$status['statusCode'] = 400;
			$status['flag'] = 'S';
			$this->response->output($status,200);        
		}
		else{
			
			$status['msg'] = $this->systemmsg->getErrorCode(227);
			$status['statusCode'] = 227;
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}
	

	}

	function base64_to_jpeg($base64_string, $output_file) {
	    // open the output file for writing
	    $ifp = fopen( $output_file, 'wb' ); 

	    // split the string on commas
	    // $data[ 0 ] == "data:image/png;base64"
	    // $data[ 1 ] == <actual base64 string>
	    $data = explode( ',', $base64_string );

	    // we could add validation here with ensuring count( $data ) > 1
	    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

	    // clean up the file resource
	    fclose( $ifp ); 

	    return $output_file; 
	}
}