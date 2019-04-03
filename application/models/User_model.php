<?php

	/**
	 * This is a model class for the user which is used for the purpose of the database operations .
	 */
	class User_model extends CI_Model
	{
		/*
		This function is called to add the user with the given data in the field $data
		*/

		function add_user($data)
		{
			$email = $data["email"];
			$password = $data["password"];
			$firstname = $data["firstname"];
			$lastname = $data["lastname"];
			$phone = $data["phone"];

			$user_data =  array(
				'first_name' => $firstname, 
				'last_name' => $lastname,
				'email' => $email,
				'phone' => $phone
					);
			$login_data = array(
				'email' => $email, 
				'password' => $password,
				'usertype' => 0
					);

			if($this->db->insert("user",$user_data))
			{
				if($this->db->insert("login",$login_data))
				return true;
				else
				return false;
			}
			else
			{
				return false;
			}


		}


		/*
		This function is called to add the user with the given data in the field $data
		*/
		function add_social_user($data)
		{
			$user_data['first_name'] = $data['first_name'];
			$user_data['last_name']  = $data['last_name'];
			$user_data['email']      = $data['email'];

			$login_data['email'] = $data['email'];
			$login_data['user_type'] = 1; // 0 if normal user 1 if social login user
			$login_data['email_valid'] = 1;

			if($this->db->insert("socialuser",$data))
			{
				//insert data into actual user data
				if($this->db->insert("user",$user_data))
				{
					if($this->db->insert("login",$login_data))
					return true;
					else
					return false;
				}
				else
				{
					return false;
				}				
			}
			else
			{
				return false;
			}
		}


		/*
		This function tells us if the email already exists or not
		returns false if already registered
		not registered => Returns True
		*/
		function verify_email($email)
		{
			$this->db->select("*");
			$this->db->from("user");
			$this->db->where("email",$email);
			$query = $this->db->get();
			if($query->num_rows() != 0)
			{ 
			return false;
			}
			else
			{
			return true;
			}	
		}

		/*
		This function tells us if phone number is already registered with us
		if exists => False
		if Not exist => True
		*/
		function verify_phone($phone)
		{
			$this->db->select("*");
			$this->db->from("user");
			$this->db->where("phone",$phone);
			$query = $this->db->get();
			if($query->num_rows() != 0)
			{ 
			return false;
			}
			else
			{
			return true;
			}	
		}

		/*
		This is used for checking the credentials of the user at the time of login
		*/		
		function check_credentials($data)
		{
			$email = $data["email"];
			$password = $data["password"];
			$query = $this->db->get_where('login', array('email' => $email,'password' => $password));
			$num_rows = $query->num_rows(); 
			if($num_rows == 1)
			{
				return true;
			}
			else if($num_rows > 1)
			{
				//there is a redundancy in the database
				return false;
			}
			else
			{
				return false;
			}
		}

		/*
		This function returns the user data
		*/
		function get_user_data()
		{
			$email = $this->session->userdata('email');
			$query = $this->db->query("SELECT * FROM user WHERE email='$email'");
			$row = $query->row();
			$num_rows = $query->num_rows();
			if($num_rows > 1)
			{
				//There is a error in the database report this case to the admin .
			}
			$data['firstname'] = $row->first_name;
			$data['lastname'] = $row->last_name;
			$data['phone'] = $row->phone;
			$data['address'] = $row->address;
			$data['pincode'] = $row->pincode;
			$data['district'] = $row->district;
			$data['state'] = $row->state;
			$data['city'] = $row->city;
			$data['userpic'] = $row->userpic;
			$data['imagename'] = $row->image_name;

			return $data;
		}
		/*
		This function updates the details of the user in database .
		*/
		function edit_profile($data)
		{
			$email = $this->session->userdata('email');
			$this->db->where('email', $email);
			if($this->db->update('user',$data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}


		/*
		This function is used to reset the password
		*/
		function reset_password($data)
		{
			$email = $data['email'];
			$password = $data['password'];
			$data1['password'] = $password;
			$this->db->where('email', $email);
			if($this->db->update('login',$data1))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/*
		This function is used to check if the given password is same as in the 
		database .
		*/

		function verify_password($password)
		{

			$email = $this->session->userdata('email');
			$this->db->select("*");
			$this->db->from("login");
			$this->db->where("email",$email);
			$query = $this->db->get();
			$row = $query->row();
			$actualpassword = $row->password;
			if($actualpassword == $password)
			{
				return true;
			}
			else
			{
				return false;
			}

		}


		/*
		This is used to the user pic field in user table to 1 as a sign of having a profile pic
		*/

		function set_user_pic($file_name)
		{
			$email = $this->session->userdata("email");
			$this->db->set('userpic',1);
			$this->db->set('image_name',$file_name);
			$this->db->where('email',$email);
			$this->db->update('user');
			return true;
		}

		/*
		 This function only returns about the profile image
		*/	

		 function get_profile_data()
		 {
		 	$email = $this->session->userdata("email");
		 	$query = $this->db->query("SELECT userpic,image_name  FROM user WHERE email='$email'");
			$row = $query->row();
			$num_rows = $query->num_rows();
			if($num_rows > 1)
			{
				//There is a error in the database report this case to the admin .
			}
			$data['userpic'] = $row->userpic;
			$data['imagename'] = $row->image_name;
			$query2 = $this->db->query("SELECT isadmin  FROM login WHERE email='$email'");
			$row2 = $query2->row();
			$num_rows = $query2->num_rows();
			if($num_rows > 1)
			{
				//There is a error in the database report this case to the admin .
			}
			$data['isadmin'] = $row2->isadmin;
			return $data;

		 }


		 /*
		This is used to set password for the social user at registeration
		 */
		 function set_social_password($password)
		 {
		 	$email = $this->session->userdata('email');
		 	$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('login');
			return true;
		 }

		 /*
			This function is used to check if the person is admin or not
		 */

		 function check_admin()
		 {
		 	$email = $this->session->userdata('email');
		 	$query2 = $this->db->query("SELECT isadmin  FROM login WHERE email='$email'");
			$row2 = $query2->row();
			$num_rows = $query2->num_rows();
			if($num_rows > 1)
			{
				//There is a error in the database report this case to the admin .
			}
			$isadmin = $row2->isadmin;
			if($isadmin == 1)
				return true;
			else
				return false;
		 }

		 /*
			This function is used for update of dob
		 */
		function update_dob($data)
		{
			$this->db->set('cost',$data['cost']);
			$this->db->set('quantity',$data['quantity']);
			$this->db->where('id',1);
			$this->db->update('dob');
			return true;	
		}


		/*
		This is used to check if the password entered is correct or not
		*/
		function check_password($password)
		{
			$email = $this->session->userdata('email');
			$query = $this->db->query("SELECT password  FROM login WHERE email='$email'");
			$row = $query->row();
			$num_rows = $query->num_rows();
			if($num_rows > 1)
			{
				//There is a error in the database report this case to the admin .
			}
			$actpass = $row->password;
			if($actpass == $password)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/*
		This function returns the present password of the user
		*/
		function get_password($email)
		{
			$query = $this->db->query("SELECT password  FROM login WHERE email='$email'");
			$row = $query->row();
			$num_rows = $query->num_rows();
			if($num_rows > 1)
			{
				//There is a error in the database report this case to the admin .
			}
			$actpass = $row->password;
			return $actpass;
		}

		/*
		This function verifies if the email and password matches or doesnt match
		*/
		function verify_reset_password_code($email,$code)
		{
			//this checks if the password we are changing is actually for our account or some others 
			$sql="SELECT password FROM login WHERE email='$email'";
			$result=$this->db->query($sql);
			$row=$result->row();
			$password = $row->password;
			if($result->num_rows() === 1)
			{
				return ($code == md5($this->config->item('salt').$password)) ?true:false;
				//if the code is same as doing the encryption on the password then it returns true
			}
			else
			{
				// return md5($row->password);
				return false;
			}
		}


		/*
		This function gives you the current dob details .
		*/
		function get_dob_details()
		{
			$sql="SELECT * FROM dob WHERE id=1";
			$result=$this->db->query($sql);
			$row=$result->row();
			$data['cost']  = $row->cost;
			$data['quantity']  = $row->quantity;
			return $data;
			
		}
}
?>