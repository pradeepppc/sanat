<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    	h3{
    		text-align: center;
    	}
    	div{
    		text-align: center;
    	}
    	table{
    		text-align: center;
    	}
    	#cap{
    		text-align: center;
    	}
    	.btn{
    text-align: center;
    margin-right: 20px;
    margin-top: 20px;
    width: 290px;
    height: 30px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: #acd6ef; /*IE fallback*/
    background-image: -webkit-gradient(linear, left top, left bottom, from(#FFA500), to(#FFC966));
    background-image: -moz-linear-gradient(top left 90deg, #FFA500 0%, #FFC966 100%);
    background-image: linear-gradient(top left 90deg, #FFA500 0%, #FFC966 100%);
    border-radius: 30px;
    border: 1px solid #66add6;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .3), inset 0 1px 0 rgba(255, 255, 255, .5);
    cursor: pointer;

}
.btn:hover{
    background-image: -webkit-gradient(linear, left top, left bottom, from(#b6e2ff), to(#6ec2e8));
    background-image: -moz-linear-gradient(top left 90deg, #b6e2ff 0%, #6ec2e8 100%);
    background-image: linear-gradient(top left 90deg, #b6e2ff 0%, #6ec2e8 100%);
}


    </style>
</head>
<body>
	<center>
	<div class="container">
	<form method="post" action="<?php echo base_url()?>profile/edit_profile" id="my_form">
	<table class="table">
		<caption id="cap"><font size="5">Your Profile</font></caption>
		<tbody>
		<tr class="success">
			<td>Email</td>
			<td><input type="email" name="email" class="form-control" value="<?php echo $this->session->userdata('email');?>" disabled></td>
			<td><span class="text-danger"><?php echo form_error('email'); ?></span></td>
		</tr>	
		<!-- <tr class="danger">
			<td>Surname</td>
			<td><input type="text" name="surname" class="form-control" value="<?php echo $surname?>"></td>
			<td><span class="text-danger"><?php echo form_error('surname'); ?></span></td>
		</tr> -->
		<tr class="danger">
			<td>Firstname</td>
			<td><input type="text" name="firstname" class="form-control" value="<?php echo $firstname?>"></td>
			<td><span class="text-danger"><?php echo form_error('firstname'); ?></span></td>
		</tr>
		<!-- <tr class="danger">
			<td>Middle name</td>
			<td><input type="text" name="middlename" class="form-control" value="<?php echo $middlename?>"></td>
			<td><span class="text-danger"><?php echo form_error('middlename'); ?></span></td>
		</tr> -->


 		<tr class="success">
			<td>Last Name</td>
			<td><input type="text" name="lastname" class="form-control" value="<?php echo $lastname?>"></td>
			<td><span class="text-danger"><?php echo form_error('lastname'); ?></span></td>
		</tr>

		<tr class="danger">
			<td>Phone</td>
			<td><input type="text" name="phone" class="form-control" value="<?php echo $phone?>" disabled></td>
			<td><span class="text-danger"><?php echo form_error('phone'); ?></span></td>
		</tr>

		<!-- <tr class="danger">
			<td>Dato Of Birth</td>
			<td><input type="date" name="date" class="form-control" value="<?php echo $dob?>"></td>
			<td><span class="text-danger"><?php echo form_error('date'); ?></span></td>
		</tr> -->	
		<tr class="success">
			<td>Door Address</td>
			<td><input type="text" name="address" class="form-control" value="<?php echo $address?>"></td>
			<td><span class="text-danger"><?php echo form_error('address'); ?></span></td>
		</tr>

		<tr class="danger">
			<td>City</td>
			<td><input type="text" name="city" class="form-control" value="<?php echo $city?>"></td>
			<td><span class="text-danger"><?php echo form_error('city'); ?></span></td>
		</tr>
		

		<tr class="success">
			<td>District</td>
			<td><input type="text" name="district" class="form-control" value="<?php echo $district?>"></td>
			<td><span class="text-danger"><?php echo form_error('district'); ?></span></td>
		</tr>		


		<tr class="danger">
			<td>State</td>
			<td><input type="text" name="state" class="form-control" value="<?php echo $state?>"></td>
			<td><span class="text-danger"><?php echo form_error('state'); ?></span></td>
		</tr>
		<tr class="success">
			<td>Pin Code</td>
			<td><input type="text" name="pincode" class="form-control" value="<?php echo $pincode?>"></td>
			<td><span class="text-danger"><?php echo form_error('pincode'); ?></span></td>
		</tr>
		<!-- <tr class="success">
			<td>Country</td>
			<td><input type="text" name="country" class="form-control" value="<?php echo $country?>"></td>
			<td><span class="text-danger"><?php echo form_error('country'); ?></span></td>
		</tr> -->
		
		</tbody>

	</table>
		<?php
                    echo '<label class="text-danger">' . $this->session->flashdata("error") . '</label>';
                            ?>

		<div class="form-group">
			<input type="submit" name="Submit" value="Update" class="btn">
		</div>

	</form>
	</div>

	<div class="container">
			<a href="<?php echo base_url()?>profile/view_profile" class="btn" role="button">Back</a>
	</div>
</center>
	

</body>
</html>