<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$this->load->view('login4');
	}



	public function mailsend()
	{
		$configs = array(
        'protocol'=>'smtp',
        'smtp_host'=>'ssl://smtp.gmail.com',
        'smtp_user'=>'cgmaster.iran@gmail.com',
        'smtp_pass'=>"PASSWORD",
        'smtp_port'=>'456'
        );
        $this->load->library("email", $configs);
        $this->email->set_newline("\r\n");
        $this->email->to("nishamedayannur@gmail.com");
        $this->email->from("cgmaster.iran@gmail.com", "Mostafa Talebi");
        $this->email->subject("This is bloody amazing.");
        $this->email->message("Body of the Message");
        if($this->email->send())
        {
            echo "Done!";   
        }
        else
        {
            echo $this->email->print_debugger();    
        }
	}
}
?>

