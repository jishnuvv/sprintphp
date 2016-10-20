<?php 
	/**
	* 
	*/
	class Signup1 extends CI_controller
	{
		public function signupfcn()
		{
			//echo "string";
			$user['fname']=$this->input->post('firstname');
			$user['sname']=$this->input->post('surname');
			$user['email']=$this->input->post('email');
			$user['reemail']=$this->input->post('re-enter');
			$user['password']=$this->input->post('password');
			$user['filename']=$_FILES['profile']['name'];
			$user['filesize']=$_FILES['profile']['size'];
			$user['dob']=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');
			$user['gender']=$this->input->post('gender');
			//print_r($user);
		
		     $config['upload_path']          = './image/';
                $config['allowed_types']        = 'gif|jpg|png';
               $config['max_size']             = 5000;
                $config['max_width']            = 8000;
                $config['max_height']           = 6500;

                $this->load->library('session');
				$this->session->set_userdata($user);

                $this->load->library('upload', $config);
                

                /*if (  $this->upload->do_upload('profile'))
                {
                	echo "success";
                }
                else
                {
                	echo "not sucess";
                }*/
                	$url='http://localhost/service3/index.php/Signup/validation';
			$option=array(
				'http' =>array(
					'header'=>"content-type: application/x-www-form-urlencoded\r\n",
					'method'=>"POST",
					'content'=>http_build_query($user),
					),
				);
			$context=stream_context_create($option);
			$result=file_get_contents($url,false,$context);
			//print_r($result);
			$json=json_decode($result,true);


			if($json['ResponseCode']==101)
			{

				echo "<script>alert('first name should have greater than 3 letters')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==150)
			{

				echo "<script>alert('enter your last name')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==170)
			{

				echo "<script>alert('enter your email')</script>";
				$this->load->view('mainpage');
			}

			if($json['ResponseCode']==102)
			{
				echo "<script>alert('email and reenter email are not match')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==103)
			{
				echo "<script>alert('not valid')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==107)
			{

				echo "<script>alert('choose profile pic')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==104)
			{
				echo "<script>alert(' maximum size of the profile pic is 5mb')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==106)
			{

				echo "<script>alert('choose your date of birth')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==105)
			{
				echo "<script>alert(' the minimum age for joining facebook is 13 years')</script>";
				$this->load->view('mainpage');
			}
			if($json['ResponseCode']==171)
			{
				echo "<script>alert('select your gender')</script>";
				$this->load->view('mainpage');
			}
			


			
			
			



            //$this->load->library('session');
       		//$this->session->set_userdata( $user);
       	
      
          
		         $config= Array( 
				'crlf' => '\r\n',      //should be "\r\n"
				'newline' => '\r\n',   //should be "\r\n"
				'protocol' => 'smtp', 
				'smtp_host' => 'ssl://smtp.googlemail.com', 
				'smtp_port' => 465, 
				'smtp_user' => 'jishnuvv61@gmail.com', // here goes your mail 
				'smtp_pass' => '9986075016', // here goes your mail password 
				'mailtype'  => 'html', 
    			'charset'   => 'utf-8',
    			'wordwrap' => TRUE 
				
				);
				$this->load->library('email', $config);
				$this->email->initialize($config);    
				$message = 'hiiiiii'; 
				 
				$this->email->set_newline("\r\n"); 
				$this->email->from('jishnuvv61@gmail.com'); // here goes your mail 
				$this->email->to($user['email']);// here goes your mail 
				$this->email->subject('Resume from JobsBuddy'); 
				$this->email->message($message); 
				if($this->email->send()) 
				{ 
			$this->load->view('emailverify');
				} 
				else 
				{
				//show_error($this->email->print_debugger()); 
				}
				
				
			}


			
	}
	?>