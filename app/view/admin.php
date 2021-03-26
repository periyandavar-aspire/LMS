<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Library</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
 	    <link rel="icon" type="image/png" href="<?php echo Utility::baseURL()?>/static/img/favicon.png"/>
         <link rel="stylesheet" type="text/css" href="<?php echo Utility::baseURL()?>/static/css/form.css">
         <link rel="stylesheet" type="text/css" href="<?php echo Utility::baseURL()?>/static/css/cores.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Utility::baseURL()?>/static/css/login.css">
        
    </head>
    <body>
        <article>
            
            <section>
                <div class="container">
                    <div class="row">
                        <div class="cols col-2 login-wrapper">
                            <!-- <div class="login-wrapper"> -->
                                <div class="text-container">
                                <div class="logo-banar"  src="<?php echo Utility::baseURL()?>/static/img/favicon.png">
                                </div>
                                <h3>WELCOME</h3>
                                <p> Sign in with your login credentials here..</p>
                                <form action="/admin/login" method="post">
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
                                        <label>Verification code : </label><br>
                                        <input  type="text" name="verfcode" maxlength="5" autocomplete="off" placeholder="Verification Code..." required="" style="width: 150px; height: 25px;">&nbsp;<img src="<?php echo "/home/captcha"; ?>">
                                    </div> 
                                    <div class="msg">
                                        <?php if(isset($msg)) echo $msg; ?>
                                    </div>
                                    <div class="form-buttons">
                                        <button type="submit" class="btn-link">Login</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </body>
</html>