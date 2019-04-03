<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Reset Password</title>
    <style type="text/css">
    	.formdiv{
    		/*position: absolute;*/
    		margin-top: 5%;
    		margin-left: 20%;
    		margin-right: 20%;
    	}
    	.heading{
    		margin-left: 40%;
    		margin-top: 5%;
    	}

    	#link{
    		margin-left: 20%;
    	}

    </style>
  </head>
  <body>
  	<div class="heading"><h2>Reset password</h2></div>
  	<div class="formdiv">
    <form method="POST" action="<?php echo base_url()?>Profile/reset">
    	
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">Please enter the email with which you have registered.</small>

            <span class="text-danger"><?php echo form_error('email'); ?></span>
        </div>
    
    	<button type="submit" class="btn btn-primary mb-2" >Submit Data</button>
    	<div>
    		<?php
                    echo '<label class="text-success">' . $this->session->flashdata("error") . '</label>';
             ?>
    	</div>
    </form>
	</div>

	<div>
	<a class="btn btn-primary" id="link" href="<?php echo base_url()?>user/login" role="button">Back</a>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


