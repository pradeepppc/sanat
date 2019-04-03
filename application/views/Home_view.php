<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sanat</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<? echo base_url()?>css/home.css">

  
      <link rel="stylesheet" href="<? echo base_url()?>css/style1.css">

<style type="text/css">
	

.mySlides {display:none;}
body {
margin: 0;
  font-size: 28px;
}

.image-box{

  background-size: contain;
  position: relative;
  background-position: center;
  background-repeat: no-repeat;
  height: 80%;
  width: 80%;
}

.dobbox{
  background-size: contain;
  position: relative;
  background-position: center;
  background-repeat: no-repeat;
  height: 80%;
  width: 80%;
}

a:hover{
	color: #ec8843;

}

a#signin{
	position: relative;
	left:20%;
}


.dropdown {
     position: fixed;
     display: inline-block;
     right: 1%; 

}

.dropdown-content {
     display: none;
    position: fixed;
    
     background-color: #f9f9f9; 
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
	}


.user_pic{
  

  display: inline-block;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
}

.heading{
  width: 100%;
  height: 60%;
}

.textheading{
  position: relative;
  margin-top: 10%;
}

.copyright{
  position: relative;
  
  width:100%;
  margin-top: 5%;
  background-color: #bfb9b5;
}

.copyfooter{
  position: relative;
  margin-top: 13%;
  margin-right: 70%;
}

.phone{
  margin-top: 10%;
  position: relative;
  width: 100%;
  height: 70%;
}
</style>
  
  	<!-- script for google map -->
	    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
	   <script type="text/javascript">
    function initialize() {
       var latlng = new google.maps.LatLng(16.842928,79.546305);
        var map = new google.maps.Map(document.getElementById('map'), {
          center: latlng,
          zoom: 13
        });
        var marker = new google.maps.Marker({
          map: map,
          position: latlng,
          draggable: false,
          anchorPoint: new google.maps.Point(0, -29)
       });
        var infowindow = new google.maps.InfoWindow();   
        google.maps.event.addListener(marker, 'click', function() {
          var iwContent = '<div id="iw_container">' +
          '<div class="iw_title"><b>Location</b> : Sanat Solvant</div></div>';
          // including content to the infowindow
          infowindow.setContent(iwContent);
          // opening the infowindow in the current map and at the current marker location
          infowindow.open(map, marker);
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</head>

<body>

  <header class="et-header">
	<div class="et-header__left">
		<a href="" class="et-header__logo"><font size="8">Sanat</font></a>
	</div>
	<div class="et-header__right">
		<?php 
		if($this->session->has_userdata('email'))
		{
      
      echo "
                <div class='dropdown'>
                <div>";
      if($userpic == 0)
      {
          echo "<a><img src='". base_url() ."images/logo1.jpg' class='user_pic'></img></a>";
      }
      else
      {
          echo "<a><img src='". base_url() ."uploads/".$this->session->userdata('email')."/".$imagename."' class='user_pic'></img></a>";
      }
      echo      "</div>
                <div class='dropdown-content'>
                <a id='myprofile' href='". base_url() ."profile/view_profile'>My Profile</a>
                <a id='changepassword' href='".base_url()."User/change_password'>Change Password</a>
                <a id='logout' href='". base_url() ."User/logout'>Logout</a>";
      if($isadmin == 1)
      {
			     echo "<a id='EditDobDetails' href='". base_url() ."Dob/EditDobDetails'>Edit Dob</a>";				
      }
        echo"
                </div>
                </div>
                ";

		}
		else
		{
			echo "<a href='" .  base_url()  . "user/login' class='et-header__logo' id='login'><font size='5'>Log In</font></a>

				<a href='" .  base_url()  . "user/register' class='et-header__logo' id='signin'><font size='5'>Sign In</font></a>
				";
		
		}

		?>	
		
		
	</div>
	
</header>

<section class="et-hero-tabs">
	
	
	
	<div class="image-box">
	<img class="mySlides" src="<?echo base_url()?>images/slides/p1.jpg" style="width:100%" height="100%">
  	<img class="mySlides" src="<? echo base_url()?>images/slides/p2.jpg" style="width:100%" height="100%" >
  	<img class="mySlides" src="<? echo base_url()?>images/slides/p3.jpg" style="width:100%" height="100%" style='float: right;'>
  	<img class="mySlides" src="<? echo base_url()?>images/slides/p4.jpeg" style="width:100%" height="100%" style='float: right;'>
  	<img class="mySlides" src="<? echo base_url()?>images/slides/p3.jpg" style="width:100%" height="100%" style='float: right;'>
  	</div>


	
	


  <div class="et-hero-tabs-container">
		<a class="et-hero-tab" href="#about">About Us</a>
		<a class="et-hero-tab" href="#quality">Dob Quality</a>
		<a class="et-hero-tab" href="#buy">Buy Now</a>
 		<a class="et-hero-tab" href="#location">location</a>
 		<a class="et-hero-tab" href="#contact">Contact Us</a>
 		<!-- <a class="et-hero-tab" href="<?echo base_url()?>/user/login">Login</a>
 		<a class="et-hero-tab" href="<?echo base_url()?>/user/register">Register</a> -->
  		<span class="et-hero-tab-slider"></span>
  </div>
</section>

<main class="et-main">
	<section class="et-slide" id="about">
    <div class="heading">
		  <h1>Sanat Private Limited</h1>
      <div class="textheading">
        <h3 style="font-size: 30px;">Write about the solvant and its overtake from and ibpl and its ability to supply 
         good quality of dob at cheap rates which also includes free delivery .
        </h3>
    </div>
    </div>
  
	</section>
	
	<section class="et-slide" id="quality">
	<div style="width: 100%;height: 70%;">
   

   <div style="float:left;width: 50%;height: 100%">
    <img class="DobSlides" src="<?echo base_url()?>images/slides/p1.jpg" style="width:100%" height="
    100%">
    <img class="DobSlides" src="<? echo base_url()?>images/slides/p2.jpg" style="width:100%" height="100%" >
    <img class="DobSlides" src="<? echo base_url()?>images/slides/p3.jpg" style="width:100%" height="100%" >
    <img class="DobSlides" src="<? echo base_url()?>images/slides/p4.jpeg" style="width:100%" height="100%" >
    <img class="DobSlides" src="<? echo base_url()?>images/slides/p3.jpg" style="width:100%" height="100%">
   </div>


   <div style="float:right;width: 50%;height: 100%;margin-top: 10%;">
    <h3 style="font-size: 20px;">Here explain about the quality of the dob and the percentages of material like humidity and
    other stuff is mentioned</h3>
   </div>


</div>
<div style="clear:both"></div>


	</section>

	<section class="et-slide" id="buy">
		<div class="dobdiv">
      <h2>Current prize of dob is Rs <?php echo $cost?>/- per quintal</h2>
      <h2>Currently availaible dob in quintals is <?php echo $quantity?></h2>
    </div>
	</section>

	<section class="et-slide" id="location">
		<h3>You can find our address here</h3>
		<div id="map" style="width: 100%; height: 70%;"></div>  
	</section>

	<section class="et-slide" id="contact">
  <div class="phone">
		<h1>Give the phone numbers of the people who can be contacted for buying</h1>
		<h3></h3>
  </div>
    <div class="copyright">
      <div id="footer" xmlns:dc="http://purl.org/dc/elements/1.1/" class="copyfooter">
        <p id="copyright" property="dc:rights">&copy;
        <span property="dc:dateCopyrighted">2018</span>
        <span property="dc:publisher">Sanat Solvants</span>
        </p>
      </div>
    </div>
	</section>


</main>
  <script src='<? echo base_url()?>js/home_jquery.js'></script>

  

    <script  src="<? echo base_url()?>js/index1.js"></script>
    <script type="text/javascript">
    		var myIndex = 0;
        var Index = 0;
			   carousel();
         dob();

		function carousel() {
    	var i;
    	var x = document.getElementsByClassName("mySlides");
    	for (i = 0; i < x.length; i++) {
       			x[i].style.display = "none";
    			}
    		myIndex++;
    		if (myIndex > x.length) {myIndex = 1}
   			 x[myIndex-1].style.display = "block";
    		setTimeout(carousel, 2000); // Change image every 2 seconds
				}

      function dob()
      {
        var i;
        var x = document.getElementsByClassName("DobSlides");
      for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
          }
        Index++;
        if (Index > x.length) {Index = 1}
         x[Index-1].style.display = "block";
        setTimeout(dob, 2000); // Change image every 2 seconds
      }


    </script>



</body>

</html>