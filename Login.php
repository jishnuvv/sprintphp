<?php 
	/**
	* 
	*/
	class login extends CI_controller
	{
		
		public function loginControl()
		{
			$this->load->view('mainpage'); 
		}
		 public function emailControl()
		 {
			$this->load->view('emailerror');
		}
		public function password()
		{
			$this->load->view('passworderror');
		}
		public function home()
		{
			$this->load->view('homepage');
		}
		public function login1()
		{
			$user['email']=$this->input->post('email');
			$user['password']=$this->input->post('password');
			

			#print_r($user);
			$url='http://api.baabtra.com/LoginService/login.php';
			$option=array(
				'http' =>array(
					'header'=>"content-type: application/x-www-form-urlencoded\r\n",
					'method'=>"POST",
					'content'=>http_build_query($user),
					),
				);
			$context=stream_context_create($option);
			$result=file_get_contents($url,false,$context);
			$json=json_decode($result,true);
			#print_r($json);
			
			if($json[0]['ResponseCode']==200)
			{
				$this->load->view('homepage');
			}
			if ($json[0]['ResponseCode']==500) 
			{
				$this->load->view('passworderror');
			}
			if ($json[0]['ResponseCode']==404) 
			{
				$this->load->view('emailerror');
			}
			}
	}
 ?>