<?php
defined('VALID_REQ') or exit('Invalid request');
if (!isset($result)) {
    return;
}
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Edit Profile</h1>
                    <hr>
                </div>
            </div>

            <form action="/admin-profile" onsubmit="editProfileValidator(event);" method="POST">
                <div class="form-input-div">
                    <label>Full Name <span class="required-star">*</span></label>
                    <input class="form-control" type="text"
                        value="<?php echo $result->fullName; ?>"
                        pattern="^[a-zA-Z ]+$" id="fullname" name="fullname" autocomplete="off"
                        placeholder="Full Name..." required="">
                </div>
                <div class="form-input-div">
                    <label>Email <span class="required-star">*</span></label>
                    <input class="form-control" disabled type="email"
                        value="<?php echo $result->email; ?>"
                        name="mail" id="emailid" placeholder="Email..." autocomplete="off" required="">
                    <!--onblur="checkAvailability()"-->
                    <span id="user-availability-status" style="font-size:12px;"></span>
                </div>
                <div class="form-input-div">
                    <label>Password </label>
                    <input class="form-control" onkeyup="passStrength('password')" type="password" id="password"
                        name="password" placeholder="********" autocomplete="off">
                    <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none"
                        value="0"></meter>
                    <span id="pass1msg" style="display:none"></span>
                </div>
                <div class="form-input-div">
                    <label>Confirm Password </label>
                    <input class="form-control" onkeyup="checkConfirm('password','confirmPassword','errormsg')"
                        type="password" id="confirmPassword" name="confirmpassword" placeholder="********"
                        autocomplete="off">
                    <span id="errormsg" style="color:red"></span>
                </div>
                <div class="msg">
                    <i>last updation on <?php echo $result->updatedAt ?><i><br><br>
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