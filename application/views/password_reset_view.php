<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<? echo base_url()?>images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css"  href="<? echo base_url()?>vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>css/main.css">
    <style type="text/css">
    .fa{
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        top: 50%;
        left: 100%;
        pointer-events: none;
        }

    </style>
     <script src="<? echo base_url()?>js/showpassword.js"></script>
</head>
<body>

	<div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" method="POST" action="<?
                echo base_url()?>user/reset_password"> 
                    <span class="login100-form-title p-b-49">
                        Reset Password
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" value="<?php echo $email?>" placeholder="Type your email" readonly>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input id="passa" class="input100" type="password" name="password" placeholder="Type your password">
                        <i id="passstatus1" class="fa fa-eye" aria-hidden="true" onclick="viewPassworda()"></i>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>

                    </div>
                    <br/>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Retype Password</span>
                        <input id="passb" class="input100" type="password" name="repassword" placeholder="Type your password">
                        <i id="passstatus2" class="fa fa-eye" aria-hidden="true" onclick="viewPasswordb()"></i>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                    <br/>
                                       
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Reset
                            </button>
                        </div>
                    </div>

                    <br/>
                    <div>
                        <?php
                    echo '<label class="text-danger">' . $this->session->flashdata("error") . '</label>';
                            ?>
                        <span class="text-danger"><?php echo form_error("email"); ?></span>
                        <span class="text-danger"><?php echo form_error("password"); ?></span>
                        <span class="text-danger"><?php echo form_error("repassword"); ?></span>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
    <script src="<? echo base_url()?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<? echo base_url()?>vendor/animsition/js/animsition.min.js"></script>
    <script src="<? echo base_url()?>vendor/bootstrap/js/popper.js"></script>
    <script src="<? echo base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<? echo base_url()?>vendor/select2/select2.min.js"></script>
    <script src="<? echo base_url()?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<? echo base_url()?>vendor/daterangepicker/daterangepicker.js"></script>
    <script src="<? echo base_url()?>vendor/countdowntime/countdowntime.js"></script>
    <script src="<? echo base_url()?>js/main.js"></script>
   
    </body>
</html>
