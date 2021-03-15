<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Library</title>
	    <meta charset="utf-8">
	    <meta name="author" content="periyandavar">
	    <meta name="discription" content="library Mangement system">
	    <meta name="keywords" content="Library, LMS">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?php echo baseURL()?>/static/img/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?php echo baseurl();?>/static/css/userlogin.css">
    </head>
    <body> 
        <section class="card signup">
            <h1>Registeration</h1>
            <hr>
            <form action="#" onsubmit="registrationFormValidator(event);" method="POST">
                <div class="form-input-div">
                    <label>Enter Full Name</label>
                    <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="fullname" name="fullname" autocomplete="off" placeholder="Full Name..." required="">
                </div>
                <div class="form-input-div">
                    <label>Enter User Name</label>
                    <input class="form-control" type="text" pattern="^[a-zA-Z0-9_]+$" id="username" name="username" autocomplete="off" placeholder="User Name..." required="">
                </div>
                <div class="form-input-div">
                    <label>Select Your Gender</label>
                    <select class="form-control select-input" name="gender" id="gender" placeholder="Full Name..." required="">
                        <option value="" style="display: none;">Select Gender</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select>
                </div>
                <div class="form-input-div">
                    <label>Enter Mobile Number </label>
                    <input class="form-control" pattern="^[789]\d{9}$" type="text" id="mobile" name="mobileno" maxlength="10" placeholder="Mobile Number..." autocomplete="off" required="">
                </div> 
                <div class="form-input-div">
                    <label>Enter Email</label>
                    <input class="form-control" type="email" name="email" id="emailid" placeholder="Email..." autocomplete="off" required="">  <!--onblur="checkAvailability()"-->
                    <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>                    
                <div class="form-input-div">
                    <label>Enter Password</label>
                    <input class="form-control" minlength="6" type="password" id="password" name="password" placeholder="********" autocomplete="off" required="">
                    <span id="pass1msg" style="display:none"></span>
                </div>    
                <div class="form-input-div">
                    <label>Confirm Password </label>
                    <input class="form-control"  onkeyup="checkConfirm()" minlength="6" type="password" id="confirmPassword" name="confirmpassword" placeholder="********" autocomplete="off" required="">
                    <span id="errormsg" style="color:red"></span>
                </div>   
                <div class="form-input-div">
                        <label>Verification code : </label>
                        <input type="text" id="vercode" name="vercode" maxlength="5" autocomplete="off" placeholder="Verification Code..." required="" style="width: 150px; height: 25px;">&nbsp;<img id="signImg" src='<?php echo baseurl() . "/home/captcha"; ?>'>
                </div>                                 
                <div class="form-buttons">
                    <button type="submit" name="signup" class="button-control positive">Submit</button>
                </div>
                <div class="msg" id="msg">
                    <?php if(isset($msg)) echo $msg ?>
                </div>
                <br><span> Already have an account..? <a class="link" href="login"> login here </a></span>
            </form>
        </section>
        <script src="js/core.js"></script>
    </body>
</html>
  