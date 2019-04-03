<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	/*
	This is a user profile controller . All the methods like showing , editing the profile , password happens here
	**/

	
	class Profile extends CI_Controller
	{
		/*
		This function directs to the profile page
		*/
		function view_profile()
		{
			if($this->session->has_userdata('email'))
			{
				$this->load->model('User_model');
				$data = $this->User_model->get_user_data();
				$data['error'] = '';
				$this->load->view('Myprofile_view',$data);
			}
			else
			{
				$this->session->set_flashdata('error','Please login to view your profile');
				$this->load->view("Login_view");
			}
		}


		/*
		This function displays the edit page for editing the details
		*/

		function edit()
		{
			if($this->session->has_userdata('email'))
			{
				$this->load->model('User_model');
				$data = $this->User_model->get_user_data();
				$this->load->view('Edit_Profile_view',$data);	
			}	
			else
			{
				$this->session->set_flashdata('error','Please login to view your profile');
				$this->load->view("Login_view");	
			}		
		}


		/*
		This function checks the form input from the edit profile page and updates it in the
		database .
		*/

		function edit_profile()
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules("firstname","Firstname",'required|alpha');
			$this->form_validation->set_rules("lastname","Lastname",'required|alpha');	
			// $this->form_validation->set_rules("phone","Phone",'integer|required|callback_check_phone');
			$this->form_validation->set_rules("address","Address");
			$this->form_validation->set_rules("city","City",'alpha');
			$this->form_validation->set_rules("district","District",'alpha');
			$this->form_validation->set_rules("state","State",'alpha');
			$this->form_validation->set_rules("pincode","Pincode",'integer');

			
			
			if($this->form_validation->run())
			{
				$this->load->model("User_model");
				$data = array(
					// "phone" => $this->input->post("phone"),
					"state" => $this->input->post("state"),
					"first_name" => $this->input->post("firstname"),
					"last_name" => $this->input->post("lastname"),
					"address" => $this->input->post("address"),
					"pincode" => $this->input->post("pincode"),
					"district" => $this->input->post("district"),
					"city" => $this->input->post("city")
				);

				if($this->User_model->edit_profile($data))
				redirect("profile/view_profile");
				else
				{
					$this->session->set_flashdata('error','Sorry there is some thing happened from our end ');
					$this->edit();
				}
			}
			else
			{
				$this->edit();
			}

		}


		/*
		This is a call back function for checking if the phone already exists in the database
		*/
		function check_phone($phone)
		{
			$this->load->model("User_model");
			$verify_phone = $this->User_model->verify_phone($phone);
			if($verify_phone)
			{
				
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_phone','This phone number already exists please login');
				return false;
			}	
		}


		/*
		This is used for uploading the file in to our database .
		*/

		function do_upload()
		{
			if($this->session->has_userdata('email'))
			{
				$email = $this->session->userdata('email');
				$path = "./uploads/" . $email . "/";
				//check if the file is uploaded or not
				if(!isset($_FILES['userphoto']))
				{
					$this->load->model('User_model');
					$data = $this->User_model->get_user_data();
					$data['error'] = 'Please select a file to upload';
					$this->load->view("Myprofile_view",$data);
					return;
				}


				$name = $_FILES['userphoto']['name'];
				$extention = pathinfo($name, PATHINFO_EXTENSION);

				
				$filename = "profile." . $extention;
				
				$config = array(
				'upload_path' => $path,
				'file_name'   => $filename,
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "8048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "1024",
				'max_width' => "1024"
					);
				$this->load->library('upload', $config);
				if($this->upload->do_upload('userphoto'))
				{
					$data = array('upload_data' => $this->upload->data());
					// $this->load->view('upload_success', $data);
					//put the userpic field to 1
					$this->load->model("User_model");
					$this->User_model->set_user_pic($filename);
					$this->view_profile();
					return;
				}
				else
				{
					// $error = array('error' => $this->upload->display_errors());
					$this->load->model('User_model');
					$data = $this->User_model->get_user_data();
					$data['error'] = $this->upload->display_errors();
					$this->load->view("Myprofile_view",$data);	
				}

			}
			else
			{
				$this->session->set_flashdata('error','Please login to upload profile pic');
				$this->load->view("Login_view");
			}
		}

		/*
		This dislplays the page to ask the user for his email
		*/
		public function forgotpassword()
		{
			if(!$this->session->has_userdata('email'))
			{
				$this->load->view("ask_email_view");
			}
		}


		/*
		This function send the mail to the user for password reset if he forgot his password
		*/
		public function reset()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules("email","Email","required|callback_check_email");
			$this->load->model('User_model');

			$email = $this->input->post('email');
			if($this->form_validation->run())
			{	

				$result = $this->User_model->get_password($email);
				$this->send_reset_password_email($email,$result);
				echo "<script type='text/javascript'>alert('A link to reset your password has been sent to your email.Please check your email.'); </script>"; 
				redirect(base_url() . 'user/index');
				//return;
			}
			else
			{
				$this->forgotpassword();
				
			}
		}

		/*
		call back function to check if email exist in our database or not
		*/
		
		function check_email($email)
		{
			$this->load->model("User_model");
			$verify_email = $this->User_model->verify_email($email);
			if(!$verify_email)
			{
				
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_email','Email entered is not registered with us please try again');
				return false;
			}	
		}


		/*
		This function is used for  sending mail to the user
		*/

		private function send_reset_password_email($email,$password)
		{
    
        //this function shows what we are sending in the mail and to whom  
    	$email_code=md5($this->config->item('salt').$password);
        $subject='reset password';
    	$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
       <meta http-equiv="Content-Type" content="text/html; charset-utf-g" /></head><body>';
          //the link we will send will look like http://Login_controller/reset_password_form/satyakrishna1998@gmail.com/d8578edf8458ce06fbc5bb76a58c5ca4
        $message .='<p> dear user </p>';
        $message .='<p> we want to help you reset your password!please <strong> <a href=" '.base_url().'Profile/reset_password_form/'.$email.'/'.$email_code.' ">click here</a></strong>to reset your password.</p>';
        $message .='<p>Thank you!</p>';
        $message .='</body></html>';
        $this->sendmail($email,$subject,$message);
        // this will invoke the function send mail
    	}


    	/*
    	This function send mail with specified arguments
		*/
	function sendmail($to,$subject,$message)  
	{		
			//this function actually 
			$this->load->library('SMTP');
			//need these libraries for sending mails in php
 			$this->load->library('PHPMailer');
 			//this has all the from address and types of mail we send
  			$mail= $this->phpmailer->get_obj();
  			$mail->isSMTP();   // by SMTP
  			$mail->SMTPAuth   = true;   // user and password
  			$mail->SMTPSecure = "ssl";    // options: 'ssl', 'tls' , ''  
  	        // From (origin)
 	        // There is also addBCC
  			$mail->Subject  = $subject;
 			$mail->Body = $message;
  			$mail->isHTML();   // Set HTML type  
  			$mail->addAddress($to);
  			return $mail->send();

	}


	public function reset_password_form($email,$email_code)
	{
			
			if(isset($email,$email_code))
			{
				
				$this->load->model('User_model');
				$verified=$this->User_model->verify_reset_password_code($email,$email_code);
				//it makes sure that the link we produce in  the mail cannot be used to manipulate other documents
				
				if($verified)
				{
				$data['email'] = $email;
				$this->load->view("password_reset_view",$data);	
				}
				else
				{
					
				echo "<script type='text/javascript'>alert('This link have been Expired!. Please Generate new link.');</script>";
				$this->load->view('ask_email_view');
				}
			}
	}		


}
?>