<section class="card">
    <h1>New Category</h1>
    <hr>
    <form action="#" onsubmit="event.preventDefault(); registrationFormValidator(event);" method="POST">
        <div class="form-input-div">
            <label>Enter Full Name</label>
            <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="fullname" name="fullanme" autocomplete="off" placeholder="Full Name..." required="">
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
            <input class="form-control" onkeyup="passStrength()" type="password" id="pass1" name="password" placeholder="********" autocomplete="off" required="">
            <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none" value="0"></meter>
            <span id="pass1msg" style="display:none"></span>
        </div>    
        <div class="form-input-div">
            <label>Confirm Password </label>
            <input class="form-control"  onkeyup="confirmPassword()" type="password" id="pass2" name="confirmpassword" placeholder="********" autocomplete="off" required="">
            <span id="pass2msg" style="color:red"></span>
        </div>                                   
        <div class="form-buttons">
            <button type="submit" class="button-control positive">Signup</button>
            <button type="button" onclick="closeModal('sign-up-modal');" class="button-control negative">Cancel</button>
        </div>
    </form>
</section>
<script>
    document.getElementById('books').className+=" active";
    <script src="../static/js/bookstatus.js"></script>
</script>