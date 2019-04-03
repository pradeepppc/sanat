<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
    .fa.fa-eye{
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        top: 50%;
        left: 100%;
        pointer-events: none;
        }

    </style>
    
     </head>
<body>

	<div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" method="POST" action="<? echo base_url()?>User/verify_login"> 
                    <span class="login100-form-title p-b-49">
                        Login
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Type your email" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" id="passa" type="password" name="password" placeholder="Type your password" >
                        
                        <span class="focus-input100" data-symbol="&#xf190;"></span>

                        <a onClick="alert('caskllcnlkas');"><i id="passstatus" class="fa fa-eye" aria-hidden="true"></i></a>
                        

                    </div>
                    
                    <div class="text-right p-t-8 p-b-31">
                        <a href="<?echo base_url() ?>profile/forgotpassword">
                            Forgot password?
                        </a>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                    <div>
                        <?php
                    echo '<label class="text-danger">' . $this->session->flashdata("error") . '</label>';
                            ?>
                        <span class="text-danger"><?php echo form_error("email"); ?></span>
                        <span class="text-danger"><?php echo form_error("password"); ?></span>

                    </div>
                    <div class="txt1 text-center p-t-54 p-b-20">
                        <span>
                            Or Sign Up Using
                        </span>
                    </div>

                    <div class="flex-c-m">
                        <a href="<? echo base_url()?>User/facebook_signin" class="login100-social-item bg1">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="<?echo base_url()?>User/twitter_signin" class="login100-social-item bg2">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="<?echo base_url()?>User/google_signin" class="login100-social-item bg3">
                            <i class="fa fa-google"></i>
                        </a>
                    </div>

                    <div class="flex-col-c p-t-155">
                        <span class="txt1 p-b-17">
                            Or Sign Up Using
                        </span>

                        <a href="<?echo base_url()?>user/register" class="txt2">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    

    <script type="text/javascript">
    function viewPassword()
    {
        alert("ppcplcdpacd");
    }        

    </script>

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
