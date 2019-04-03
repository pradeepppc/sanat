<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/*
	This is the user controller , all the functions related to user login and registeration are done here .
	**/
	

	class User extends CI_Controller
	{
		
		/*This is a test function which is used for the testing of the views*/
		public function check_view()
		{
			if($this->session->has_userdata('email'))
			{
			$this->load->view("Home_view");
			}
			else
			{
			$this->load->view("Home_view");	
			}	
		}

		/*
		This function will load the home page
		*/
		public function index()
		{
			if($this->session->has_userdata('email'))
			{
			$this->load->model("User_model");
			$profiledata = $this->User_model->get_profile_data();
			$data = $this->User_model->get_dob_details();
			$profiledata['cost'] = $data['cost'];
			$profiledata['quantity'] = $data['quantity'];
			$this->load->view("Home_view",$profiledata);
			}
			else
			{
			$this->load->model("User_model");
			$data = $this->User_model->get_dob_details();
			$this->load->view("Home_view",$data);	
			}	
		}


		/*
		This function directs to the login page
		*/
		public function login()
		{
			if(!$this->session->has_userdata('email'))
			$this->load->view("Login_view");
			else
			$this->index();
		}


		/*
		This function directs to the user registration page
		*/
		public function register()
		{
			if(!$this->session->has_userdata('email'))
			$this->load->view("Register_view");	
			else
			$this->index();
		}


		/**
		This function is used for the verification of the user at the time of registration
		*/

		public function verify_registration()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules("email","Email",'required|valid_email|callback_check_email');
			$this->form_validation->set_rules("password","Password",'required');
			$this->form_validation->set_rules("repassword","Repassword",'required');
			$this->form_validation->set_rules("firstname","Firstname",'required|alpha');
			$this->form_validation->set_rules("lastname","Lastname",'required|alpha');	
			$this->form_validation->set_rules("phone","Phone",'integer|required|callback_check_phone');
			
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$repassword = $this->input->post("repassword");
			$firstname = $this->input->post("firstname");
			$lastname = $this->input->post("lastname");
			$phone = $this->input->post("phone");

			//checking if passwords were same or not
			if($repassword != $password)
			{
				$this->session->set_flashdata('error','passwords didnt match');
				redirect(base_url() . 'user/register');
			}

			if($this->form_validation->run())
			{
				$this->load->model("User_model");
				$data = array(
					"email" => $email,
					"password" => $password,
					"firstname" => $firstname,
					"lastname" => $lastname,
					"phone" => $phone,
					);

				if($this->User_model->add_user($data))
				{
					// Create a new directory for this user to store data (pictures,videos,etc .. )
					$path = "./uploads/" . $email; // path where the directory has to be created
					if(mkdir($path,0777))
					{
						$this->session->set_userdata('email',$email);
						$this->index();
						return;	
					}
					else
					{
						echo "User added but directory not created";
					}
				}	
				else
				{
					$this->session->set_flashdata('error','Sorry server error');
					redirect(base_url() . 'user/register');
				}
			}
			else
			{
				$this->register();
			}

		
		}

		
		/*
		This is login validation function
		*/
		function verify_login()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules("email","Email",'required');
			$this->form_validation->set_rules("password","Password",'required');

			$data =  array(
				'email' => $this->input->post("email"),
				'password' => $this->input->post("password")
				);
			if($this->form_validation->run())
			{
				$this->load->model("User_model");
				if($this->User_model->check_credentials($data))
				{
					//set the session variables
					$this->session->set_userdata('email',$this->input->post("email"));
					$this->index();
				}	
				else
				{
					$this->session->set_flashdata('error','email or password is incorrect');
					$this->login();
				}
			}	
			else
			{
				$this->login();
			}		

		}

		function logout()
		{
			$this->session->unset_userdata('email');
			$this->index();
		}

		function reset_password()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules("email","Email",'required|valid_email|callback_check_email_reset');
			$this->form_validation->set_rules("password","Password",'required');
			$this->form_validation->set_rules("repassword","Repassword",'required');

			$password = $this->input->post('password');
			$repassword = $this->input->post('repassword');
			$email = $this->input->post('email');
			$data['email'] = $email;
			if($password != $repassword)
			{
				$this->session->set_flashdata('error','passwords didnt match');
				$this->forgot_password();
				return;
			}

			if($this->form_validation->run())
			{

			$data = array(
					'email'    => $email,
					'password' => $password);

				$this->load->model('User_model');
				if($this->User_model->reset_password($data))
				{
					if(!$this->session->has_userdata('email'))
					{
					$this->session->set_flashdata('error','Password updated please login');	
					$this->login();
					}
					else
					{
						$this->index();
					}
				}
				else
				{
					$this->session->set_flashdata('error','Something wrong happened from our side plsease try again');

					$this->load->view("password_reset_view",$data);		
				}
			}
			else
			{
				$this->load->view('password_reset_view',$data);
			}


		}
		
		/*
		This is a call back function for checking if the email already exists in the database
		retunrs false if exists .
		*/
		function check_email($email)
		{
			$this->load->model("User_model");
			$verify_email = $this->User_model->verify_email($email);
			if($verify_email)
			{
				
				return true;
			}
			else
			{
				$this->form_validation->set_message('check_email','Email already exists please login');
				return false;
			}
		}

		/*
		This is a call back function for checking if the email already exists in the database
		or not . returns true if exists
		*/
		function check_email_reset($email)
		{
			$this->load->model("User_model");
			$verify_email = $this->User_model->verify_email($email);
			if($verify_email)
			{
				
				$this->form_validation->set_message('check_email_reset','This email is not 
					registered with us , Please check again');
				return false;
			}
			else
			{
				return true;
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
		This function is used to chage the password for user if he is already login
		*/
		
		function change_password()
		{
			if($this->session->has_userdata('email'))
			{
				$this->load->view("change_password_view");
			}
			else
			{
				$this->session->set_flashdata("error","Please login with your registered email or phone number");
				$this->login();
			}
		}


		/*
		This function check for the form elements from the chage password view 
		*/
		function change_password_valid()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules("password","Password","required");
			$this->form_validation->set_rules("newpassword","Newpassword",'required');
			$this->form_validation->set_rules("repassword","Repassword",'required');

			$password = $this->input->post("password");
			$newpassword = $this->input->post("newpassword");
			$repassword = $this->input->post("repassword");

			$this->load->model("User_model");
			if(!$this->User_model->check_password($password))
			{
				$this->session->set_flashdata('error','Password entered is incorrect please check');
				$this->change_password();
				return;
			}


			if($this->form_validation->run())
			{


				if($newpassword != $repassword)
				{
					$this->session->set_flashdata("error","Passwords didnt match");
					$this->change_password();
					return;
				}

				$data = array(
					'email'    => $this->session->userdata('email'),
					'password' => $newpassword);

				
				if($this->User_model->reset_password($data))
				{
					
					//$this->session->set_flashdata('error','Password updated');	
					$this->index();
					return;
				}
				else
				{
					$this->session->set_flashdata('error','Something wrong happened from our side plsease try again');
					$this->change_password();
					return;		
				}
			}
			else
			{
				$this->change_password();
			}

		}


		/*
		this is a call back function for checking password correctness
		*/
		function password_check($pass)
		{
			
			$this->load->model("User_model");
			$verify_password = $this->User_model->verify_password($pass);
			if($verify_password)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('password_check','Password entered is incorrect');
				return FALSE;
			}		
		}

		/*
		This is used for sign in of the user using google + 
		*/
		function google_signin()
		{
		$client_id = 
		'1005216845954-l2r91dkbmkc30cicna06stbq3okgb7gs.apps.googleusercontent.com';
        $client_secret = 'GKePlewNPhO8xK7jJxwl9GIm';
        $redirect_uri = base_url('user/gcallback');;

        //Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("sanat");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");

        //Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);
        
        $authUrl = $client->createAuthUrl();
        
        header('Location: '.$authUrl);

		}

		

		/*
			After user varification from google we will get user data .
		*/

	function gcallback()
    {
            // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
     $client_id = '1005216845954-l2r91dkbmkc30cicna06stbq3okgb7gs.apps.googleusercontent.com';
     $client_secret = 'GKePlewNPhO8xK7jJxwl9GIm';
     $redirect_uri = base_url('user/gcallback');

    //Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName("sanat");
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope("email");
    $client->addScope("profile");

    //Send Client Request
    $service = new Google_Service_Oauth2($client);

    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    
    // User information retrieval starts..............................

    $user = $service->userinfo->get(); //get user info 
    
    //splitting the username into two names
    $name = preg_split("/[\s,]+/",$user->name);

    //storing the data in a array

    $data['first_name'] = $name[0];
    $data['last_name'] = $name[1];
    $data['oauth_provider'] = "google";
    $data['oauth_uid'] =  $user->id;
    $data['email'] = $user->email;
    $data['gender'] = $user->gender;
    $data['profile_url'] = $user->picture;
    $data['profile_page'] = $user->link;

    
    $this->load->model("User_model");
    //check if the eamil is already registered with us
    if(!$this->User_model->verify_email($data['email']))
    {
    	//direct him to login page
  		 $this->session->set_userdata('email',$data['email']);
  		 $this->index();
    }
    else
    {
    	//store the data in the data base 
    	if($this->User_model->add_social_user($data))
    	{
    		// Create a new directory for this user to store data (pictures,videos,etc .. )
			$path = "./uploads/" . $data['email']; // path where the directory has to be created
			if(mkdir($path,0777))
			{
				$this->session->set_userdata('email',$data['email']);
				//redirect him to a page where he can set his password
				$this->session->set_flashdata("error","Please set password and then Proceed");		
				$this->load->view("password_set_view");
				return;	
			}
			else
			{
				echo "User added but directory not created";
			}
		}
    	else
    	{
    		$this->session->set_flashdata("error","Sorry there was a error from our side please try again");
			$this->login();		
    	}
    		

    }

}
	

	/*
	This function is used to set password for the person registered via social media

	*/

	function set_password()
	{
			

			$this->load->library('form_validation');
			$this->form_validation->set_rules("password","Password",'required');
			$this->form_validation->set_rules("repassword","Repassword",'required');

			$password = $this->input->post('password');
			$repassword = $this->input->post('repassword');
			$email = $this->session->userdata('email');

			if($password != $repassword)
			{
				$this->session->set_flashdata('error','passwords didnt match');
				$this->load->view("password_set_view");
				return;
			}

			if($this->form_validation->run())
			{
				//update in database
				$this->load->model("User_model");
				if($this->User_model->set_social_password($password))
				{
					$this->index();
				}
				else
				{
					$this->session->set_flashdata('error','Sorry there is a error please try again');
					$this->load->view("password_set_view");
				}
			}
			else
			{
				$this->load->view("password_set_view");
				return;	
			}

	}	






	}
    
?>