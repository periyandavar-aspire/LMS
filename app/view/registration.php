<!-- top container starts -->
<div class="top-container regist-container">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="cols">
                    <div class="text-container">
                        <h1>JOIN NOW TO <span class="morph"> </span></h1><br>
                        <!-- <p class="heading-para">We store the energy that fuels the imagination. we open up windows to the world and inspire you to explore and achieve, and contribute to improving your quality of life.</p>
                        <a class="btn-link" href="home/registration">JOIN NOW</a> -->
                        <section class="form-card">
                            <h1>User Registeration</h1>
                            <hr>
                            <form action="" onsubmit="registrationFormValidator(event);" method="POST">
                                <div class="form-input-div">
                                    <label>Enter Full Name <span class="required-star">*</span></label>
                                    <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="fullname"
                                        name="fullname" autocomplete="off" placeholder="Full Name..." required="">
                                </div>
                                <div class="form-input-div">
                                    <label>Enter User Name <span class="required-star">*</span></label>
                                    <input class="form-control" type="text" pattern="^[a-zA-Z0-9_]+$" id="username"
                                        name="username" autocomplete="off" placeholder="User Name..." required="">
                                </div>
                                <div class="form-input-div">
                                    <label>Select Your Gender <span class="required-star">*</span></label>
                                    <select class="form-control select-input" name="gender" id="gender"
                                        placeholder="Full Name..." required="">
                                        <option value="" style="display: none;">Select Gender</option>
                                        <?php if ($dropdownGen != null):?>
                                        <?php foreach ($dropdownGen as $gender):?>
                                        <option
                                            value="<?php echo $gender['code']?>">
                                            <?php echo $gender['value']?>
                                        </option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                        <!-- <option value="m">Male</option>
                                        <option value="f">Female</option> -->
                                    </select>
                                </div>
                                <div class="form-input-div">
                                    <label>Enter Mobile Number <span class="required-star">*</span></label>
                                    <input class="form-control" pattern="^[789]\d{9}$" type="text" id="mobile"
                                        name="mobile" maxlength="10" placeholder="Mobile Number..." autocomplete="off"
                                        required="">
                                </div>
                                <div class="form-input-div">
                                    <label>Enter Email <span class="required-star">*</span></label>
                                    <input class="form-control" type="email" name="email" id="emailid"
                                        placeholder="Email..." autocomplete="off" required="">
                                    <!--onblur="checkAvailability()"-->
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>
                                <div class="form-input-div">
                                    <label>Enter Password <span class="required-star">*</span></label>
                                    <input class="form-control" onkeyup="passStrength('password')" minlength="6"
                                        type="password" id="password" name="password" placeholder="********"
                                        autocomplete="off" required="">
                                    <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50"
                                        style="display:none" value="0"></meter>
                                    <span id="pass1msg" style="display:none"></span>
                                </div>
                                <div class="form-input-div">
                                    <label>Confirm Password <span class="required-star">*</span></label>
                                    <input class="form-control"
                                        onkeyup="checkConfirm('password','confirmPassword','errormsg')" minlength="6"
                                        type="password" id="confirmPassword" name="confirmpassword"
                                        placeholder="********" autocomplete="off" required="">
                                    <span id="errormsg" style="color:red"></span>
                                </div>
                                <div class="form-input-div">
                                    <label>Verification code <span class="required-star">*</span></label>
                                    <input type="text" id="vercode" name="captcha" maxlength="5" autocomplete="off"
                                        placeholder="Verification Code..." required=""
                                        style="width: 150px; height: 25px;">&nbsp;<img id="signImg"
                                        src='<?php echo Utility::baseURL() . "/home/captcha"; ?>'>
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" name="signup" class="btn-link">Submit</button>
                                </div>
                                <div class="msg" id="msg">
                                    <?php if (isset($msg)) {
    echo $msg;
} ?>
                                </div>
                                <br><span> Already have an account..? <a class="link" href="/login"> login here
                                    </a></span>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- top container ends -->
<script>
    document.getElementById("menu-register").className += " active";
</script>
<script src="<?php echo Utility::baseURL();?>/static/js/form.js"></script>