<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mediamodel');
		//Load Dependencies

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$data['title'] = "media";
		$data['files'] = $this->mediamodel->all();
		$this->load->view('media', $data, FALSE);
	}

	// Add a new item
	public function add()
	{
		$this->load->library('upload');
    $imagePath = realpath(APPPATH . '../assets/uploads');
        $number_of_files_uploaded = count($_FILES['files']['name']);

    
        for ($i = 0; $i <  $number_of_files_uploaded; $i++) {
            $_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
            $_FILES['userfile']['type']     = $_FILES['files']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['files']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['files']['size'][$i];
            //configuration for upload your images
            $config = array(
                'file_name'     => time().uniqid(),
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 3000,
                'overwrite'     => FALSE,
                'upload_path'
                =>$imagePath
            );
            $this->upload->initialize($config);
            $errCount = 0;//counting errrs
            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $theImages[] = array(
                    'errors'=> $error
                );//saving arrors in the array
            }
            else
            {
                $filename = $this->upload->data();
                $theImages[] = array(
                    'fileName'=>$filename['file_name']
                );
                $params = array('file_name' => '/assets/uploads/'.$filename['file_name'], );
                $this->mediamodel->store($params);
            }//if file uploaded
            
        }//for loop end
       
        redirect('media','refresh');
   

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Media.php */
/* Location: ./application/controllers/Media.php */
