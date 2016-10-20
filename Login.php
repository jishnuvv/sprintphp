<?php 
	/**
	* 
	*/
	class Login extends CI_controller
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
			 $this->load->library('session');
				$this->session->set_userdata($user);

			#print_r($user);
			$url='http://localhost/service3/index.php/Login/loginService';
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
			// print_r($json);
			
			if($json['ResponseCode']==200)
			{
				$this->load->view('homepage',$json);
			}
			if ($json['ResponseCode']==500) 
			{
				$this->load->view('passworderror',$json);
			}
			if ($json['ResponseCode']==404) 
			{
				$this->load->view('emailerror');
			}
			}
			public function verify()
			{
				$this->load->view('emailverify');
			}
	}
 ?>