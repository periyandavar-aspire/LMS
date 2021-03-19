<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Library</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
 	    <link rel="icon" type="image/png" href="<?php echo Utility::baseURL()?>/static/img/favicon.png"/>
         <link rel="stylesheet" type="text/css" href="<?php echo Utility::baseURL()?>/static/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Utility::baseURL()?>/static/css/login.css">
        
    </head>
    <body>
        <article>
            <!-- <section class="left-panel-login">
                <img src="img/login.jpg">
            </section> -->
            <section class="right-panel-login">
                <div class="login-wrapper">
                    <img class="logo-banar"  src="<?php echo Utility::baseURL()?>/static/img/lms-logo.jpg">
                    <h1>Login Page</h1>
                    <hr>
                <form action="adminLogin" method="post">
                    <div class="form-input-div">
                        <label>Enter Email ID</label>
                        <input class="form-control" type="email" name="email" id="mailid" placeholder="Email..." autocomplete="off" required="">  <!--onblur="checkAvailability()"-->
                        <span id="user-availability-status" style="font-size:12px;"></span> 
                    </div>
                    <div class="form-input-div">
                        <label>Enter Password</label>
                        <input class="form-control" type="password" id="pass" name="password" placeholder="Enter Password..." autocomplete="off" required="">
                        <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none" value="0"></meter>
		                <span id="pass1msg" style="display:none"></span>
                    </div>
                    <div class="form-input-div">
                        <label>Verification code : </label>
                        <input type="text" name="verfcode" maxlength="5" autocomplete="off" placeholder="Verification Code..." required="" style="width: 150px; height: 25px;">&nbsp;<img src="<?php echo "/home/captcha"; ?>">
                    </div> 
                    <div class="form-buttons">
                        <button type="submit" class="button-control positive">Login</button>
                    </div>
                    <div class="msg">
                        <?php if(isset($msg)) echo $msg; ?>
                    </div>
                </form>
                </div>
            </section>
        </article>
    </body>
</html>