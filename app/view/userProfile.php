<?php
    if (!isset($result)) {
        return;
    }
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Edit Profile</h1><hr>
                </div>
            </div>
        
        <form action="/user/profile/update" onsubmit="editProfileValidator(event);" method="POST">
            <div class="form-input-div">
                <label>Full Name <span class="required-star">*</span></label>
                <input class="form-control" type="text" value="<?php echo $result->fullName; ?>" pattern="^[a-zA-Z ]+$" id="fullname" name="fullname" autocomplete="off" placeholder="Full Name..." required="">
            </div>
            <div class="form-input-div">
                <label>User Name</label>
                <input class="form-control" disabled type="text" value="<?php echo $result->userName; ?>" pattern="^[a-zA-Z0-9_]+$" id="username" name="username" autocomplete="off" placeholder="User Name..." required="">
            </div>
            <div class="form-input-div">
                <label>Select Your Gender <span class="required-star">*</span></label>
                <select class="form-control select-input" name="gender" id="gender" placeholder="Full Name..." required="">
                    <option value="" style="display: none;">Select Gender</option>
                    <option value="m" <?php if ($result->gender=='1') {
    echo "selected";
} ?>>Male</option>
                    <option value="f" <?php if ($result->gender=='2') {
    echo "selected";
} ?>>Female</option>
                </select>
            </div>
            <div class="form-input-div">
                <label>Mobile Number <span class="required-star">*</span></label>
                <input class="form-control" value="<?php echo $result->mobile; ?>" pattern="^[789]\d{9}$" type="text" id="mobile" name="mobile" maxlength="10" placeholder="Mobile Number..." autocomplete="off" required="">
            </div>                                                    
            <div class="form-input-div">
                <label>Email <span class="required-star">*</span></label>
                <input class="form-control" disabled type="email" value="<?php echo $result->mail; ?>" name="mail" id="emailid" placeholder="Email..." autocomplete="off" required="">  <!--onblur="checkAvailability()"-->
                <span id="user-availability-status" style="font-size:12px;"></span> 
            </div>                    
            <div class="form-input-div">
                <label>Password </label>
                <input class="form-control" onkeyup="passStrength('password')" type="password" id="password" name="password" placeholder="********" autocomplete="off">
                <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none" value="0"></meter>
                <span id="pass1msg" style="display:none"></span>
            </div>    
            <div class="form-input-div">
                <label>Confirm Password </label>
                <input class="form-control"  onkeyup="checkConfirm('password','confirmPassword','errormsg')" type="password" id="confirmPassword" name="confirmpassword" placeholder="********" autocomplete="off">
                <span id="errormsg" style="color:red"></span>
            </div>  
            <div class="msg">
                <?php if (isset($msg)) {
    echo $msg;
} ?>
            </div>                                 
            <div class="form-buttons">
                <button type="submit" class="btn-link">Update</button>
            </div>
        </form>
        </div>
    </section>
</article>

<script>
    document.getElementById('profile').className += " active";
</script>