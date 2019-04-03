<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/*
	This is the Dob controller , all the functions related to Dob rate and quanitity are done here .
	**/

	
	class Dob extends CI_Controller
	{
		//This function displays the edit page for the dob
		public function EditDobDetails()
		{
			if($this->session->has_userdata('email'))
			{
				$this->load->model("User_model");
				if($this->User_model->check_admin())
				{
					$this->load->view("edit_dob_view");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Please login to access');
				$this->load->view("Login_view");
			}
		}

		/*
			This function changes the values of dob in the database
		*/
		public function EditDob()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules("cost","Cost",'required|integer');
			$this->form_validation->set_rules("quanitity","Quanitity",'required|integer');

			if($this->form_validation->run())
			{
				$this->load->model("User_model");
				$cost = $this->input->post("cost");
				$quantity = $this->input->post("quanitity");
				$data['cost'] = $cost;
				$data['quantity'] = $quantity;
				if($this->User_model->update_dob($data))
				{
					$this->session->set_flashdata('error','Values updated succesfully');
					$this->load->view("edit_dob_view");
				}
				else
				{

					$this->EditDobDetails();
				}
			}
			else
			{
				$this->EditDobDetails();
			}	
		}

	}


?>