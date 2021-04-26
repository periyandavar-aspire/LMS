<?php
    if (!isset($data)) {
        return;
    }
?>
<article class="main">
    <section>
        <h1>Customize Home Page</h1>
        <hr>
        <form action="/admin/cms" onsubmit="//event.preventDefault(); registrationFormValidator(event);" method="POST">
            <div class="form-input-div">
                <label>About Us</label>
                <textarea class="form-control" id="aboutus" name="aboutus"
                    required=""><?php echo $data->aboutUs; ?></textarea>
            </div>
            <div class="form-input-div">
                <label>Address</label>
                <textarea class="form-control" id="address" name="address"
                    required=""><?php echo $data->address; ?></textarea>
            </div>
            <div class="form-input-div">
                <label>Mobile Number <span class="required-star">*</span></label>
                <input class="form-control" type="text" id="mobile" name="mobile"
                    value="<?php echo $data->mobile?>" maxlength="10"
                    placeholder="Mobile Number" autocomplete="off" required="">
            </div>
            <div class="form-input-div">
                <label>Email <span class="required-star">*</span></label>
                <input class="form-control" type="email" name="email" id="emailid" placeholder="Email"
                    value="<?php echo $data->email?>"
                    autocomplete="off" required="">
            </div>
            <div class="form-input-div">
                <label>Facebook Link </label>
                <input class="form-control" type="url" name="fbUrl" id="fburl" placeholder="Facebook"
                    value="<?php echo $data->fbUrl?>"
                    autocomplete="off" required="">
            </div>
            <div class="form-input-div">
                <label>YouTube Link</label>
                <input class="form-control" type="url" name="ytUrl" id="ytUrl" placeholder="YouTube"
                    value="<?php echo $data->ytUrl?>"
                    autocomplete="off" required="">
            </div>
            <div class="form-input-div">
                <label>Insta Link </label>
                <input class="form-control" type="url" name="instaUrl" id="instaUrl" placeholder="Instagram"
                    value="<?php echo $data->instaUrl?>"
                    autocomplete="off" required="">
            </div>
            <div class="form-input-div">
                <label>Vision</label>
                <textarea class="form-control" id="vision" name="vision"
                    required=""><?php  echo $data->vision;?></textarea>
            </div>
            <div class="form-input-div">
                <label>Mission</label>
                <textarea class="form-control" id="mission" name="mission"
                    required=""><?php echo $data->mission; ?></textarea>
            </div>
            <div class="msg">
                <i>last updation on <?php echo $data->updatedAt ?><i><br>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn-link">Submit</button>
            </div>
        </form>
    </section>

</article>
<script>
    document.getElementById('cms').className += " active";
</script>