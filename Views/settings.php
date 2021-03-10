<section class="card">
    <h1>Customize Home Page</h1>
    <hr>
    <form action="/admin/updatePageSettings" onsubmit="//event.preventDefault(); registrationFormValidator(event);" method="POST">
        <div class="form-input-div">
            <label>About Us</label>
            <textarea class="form-control"id="aboutus" name="aboutus" required=""></textarea>
        </div>
        <div class="form-input-div">
            <label>Address</label>
            <textarea class="form-control"id="address" name="address" required=""></textarea>
        </div>
        <div class="form-input-div">
            <label>Phone Number </label>
            <input class="form-control" pattern="^[789]\d{9}$" type="text" id="mobile" name="mobileno" maxlength="10" placeholder="Mobile Number..." autocomplete="off" required="">
        </div>                                                    
        <div class="form-input-div">
            <label>Mission</label>
            <textarea class="form-control"id="mission" name="mission" required=""></textarea>
        </div>                    
        <div class="form-input-div">
            <label>Vision</label>
            <textarea class="form-control"id="vision" name="vision" required=""></textarea>
        </div>                                     
        <div class="form-buttons">
            <button type="submit" class="button-control positive">Submit</button>
        </div>
        <?php
        if(isset($pageMsg))
            echo $pageMsg;
        ?>
    </form>
</section>
<section class="card">
    <h1>Customize logo bannar</h1>
    <hr>
    <form action="/admin/uploadLogo" enctype="multipart/form-data" method="POST">
        <div class="form-input-div">
            <label>Logo banar with library Name</label>
            <input class="form-control" type="file" id="logobanar" name="logobanar" accept=".jpg, .png" onchange="changePreview(event);showElement('logo-upload-btn')" required="">
            <span id="pass2msg" style="color:red"></span>
        </div>
        <div class="form-buttons" id="logo-upload-btn" style="display:none">
            <button type="submit" class="button-control positive">Submit</button>
        </div>
        <?php
        if(isset($msg))
            echo $msg;
        ?>
    </form>
    <!-- <h1>Customize slideshow Images</h1>
    <hr>
    <form action="#" enctype="multipart/form-data" onsubmit="event.preventDefault(); registrationFormValidator(event);" method="POST">
        <div class="form-buttons" id="logo-upload-btn" style="display:none">
            <button type="submit" class="button-control positive">Submit</button>
        </div>
    </form> -->
</section>
<script>
    document.getElementById('settings').className += " active";
</script>