<!DOCTYPE html>
<html lang="en" >
<head>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	
    <script type='text/javascript'>

function UpdateMyPic()
{
    var pic = document.getElementById('profilepic');
    //var btn = document.getElementById('upload');
    var fileinput = document.getElementById('file-input');
    fileinput.type="file";
    
    fileinput.click();
    //btn.type = "submit";
    //btn.click();
    

}


function showFileSize() {
    var input, file;

    if (!window.FileReader) {
        alert("The file API isn't supported on this browser yet.");
        return;
    }

    input = document.getElementById('fileinput');
    if (!input) {
        bodyAppend("p", "Um, couldn't find the fileinput element.");
    }
    else if (!input.files) {
        bodyAppend("p", "This browser doesn't seem to support the `files` property of file inputs.");
    }
    else if (!input.files[0]) {
        bodyAppend("p", "Please select a file before clicking 'Load'");
    }
    else {
        file = input.files[0]; console.log(file);
        bodyAppend("p", "File " + file.name + " is " + file.size + " bytes in size");
    }
}
function bodyAppend(tagName, innerHTML) {
    var elm;

    elm = document.createElement(tagName);
    elm.innerHTML = innerHTML;
    document.getElementById('photodiv').appendChild(elm);
}
</script>

	<style type="text/css">
		
		.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;

}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}


	</style>

</head>
<body>

<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        
        <A href="<? echo base_url()?>user/index" >Back</A>
            &nbsp;
           <A href="<? echo base_url()?>profile/edit" >Edit Profile</A>
           &nbsp;
        <A href="<?echo base_url() ?>user/logout">Logout</A>
       <br>
        <p class="text-info" id="times" >May 05,2014,03:00 pm </p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $firstname;?> <?php echo $lastname;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">

                <?php echo $error;?>
                <?php echo form_open_multipart('Profile/do_upload');?>

                <div class="col-md-3 col-lg-3 " align="center" id="photodiv"> 
                    <?php 
                    if($userpic == 0)
                    {
                        echo 
                    '<img alt="User Pic" src="'. base_url() .'images/profile.png" class="img-circle img-responsive" id="profilepic" onclick="UpdateMyPic();">';
                    }
                    else
                    {
                       echo '<img alt="User Pic" src="'.base_url().'uploads/'.
                       $this->session->userdata("email") .'/'. $imagename  .'" class="img-circle img-responsive" id="profilepic" onclick="UpdateMyPic();">'; 
                    }
                    ?>
                    
                    <input type="hidden" name="userphoto" accept="image/*" id="file-input">
                    
                    <input type="submit" value="upload" name="submit">

                </div>
                </form>

                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>User Name</td>
                        <td><?php echo $this->session->userdata('email');?></td>
                      </tr>
                      <tr>
                        <td>Phone No</td>
                        <td><?php echo $phone;?></td>
                      </tr>
                      <!-- <tr>
                        <td>Date of Birth</td>
                        <td>01/24/1988</td>
                      </tr> -->
                   
                         <!-- <tr> -->
                         <!-- <tr>
                        <td>Gender</td>
                        <td>Female</td>
                      </tr> -->
                        
                      <tr>
                        <td>Email</td>
                        <td><a href='mailto:<?php echo $this->session->userdata("email");?>'><?php echo $this->session->userdata('email');?></a></td>
                      </tr>


                       <tr>
                        <td>Door Address</td>
                        <td><?php if(is_null($address))
                        			{
                        				echo "Not Given";
                        			}
                        			else
                        			{
                        				echo $address;
                        			}
                        	?></td>
                      </tr>

                        <tr>
                        <td>city</td>
                        <td><?php if(is_null($city))
                        			{
                        				echo "Not Given";
                        			}
                        			else
                        			{
                        				echo $city;
                        			}
                        	?></td>
                        </tr>

                        <tr>
                        <td>district</td>
                        <td><?php if(is_null($district))
                        			{
                        				echo "Not Given";
                        			}
                        			else
                        			{
                        				echo $district;
                        			}
                        	?></td>
                        </tr>


                        <tr>
                        <td>Pin Code</td>
                        <td><?php if(is_null($pincode))
                        			{
                        				echo "Not Given";
                        			}
                        			else
                        			{
                        				echo $pincode;
                        			}
                        	?></td>
                        </tr>

                        
                        <tr>
                        <td>state</td>
                        <td><?php if(is_null($state))
                        			{
                        				echo "Not Given";
                        			}
                        			else
                        			{
                        				echo $state;
                        			}
                        	?></td>
                        </tr>

                        
                      
                     
                    </tbody>
                  </table>
                  
                  <!-- <a href="#" class="btn btn-primary">Past Orders</a> -->
                  <a href="#" class="btn btn-primary">Live Chat With Us</a>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        
                         <span class="pull-right">
                            <a href="<?echo base_url()?>profile/edit" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <!-- <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a> -->
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>	

<script type="text/javascript">


    var d = document.getElementById('times');
    var dat = new Date();
    d.innerHTML = dat.toString(); 


    var  fileInput = document.getElementById('file-input');
    fileInput.addEventListener('change', function (event) {
        // do something like storing the image file in database using ajax
        
        alert('profile pick updaated');
        //changing the input field again to hidden
        //fileInput.type="hidden";       
    });

</script>

</body>

</html>