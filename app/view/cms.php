<?php
/**
 * CMS
 * php version 7.3.5
 *
 * @category View
 * @package  View
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
if (!isset($data)) {
    return;
}
?>
<article class="main">
    <section>
        <h1>Customize Home Page</h1>
        <hr>
        <form action="/admin/cms" onsubmit="cmsValidator(event);" method="POST">
            <div class="form-input-div">
                <label>About Us <span class="required-star">*</span></label>
                <textarea class="form-control" id="aboutus" name="aboutus"
                    required=""><?php echo $data->aboutUs; ?></textarea>
            </div>
            <div class="form-input-div">
                <label>Address <span class="required-star">*</span></label>
                <textarea class="form-control" id="address" name="address"
                    required=""><?php echo $data->address; ?></textarea>
            </div>
            <div class="form-input-div">
                <label>Vision <span class="required-star">*</span></label>
                <textarea class="form-control" id="vision" name="vision"
                    required=""><?php  echo $data->vision;?></textarea>
            </div>
            <div class="form-input-div">
                <label>Mission <span class="required-star">*</span></label>
                <textarea class="form-control" id="mission" name="mission"
                    required=""><?php echo $data->mission; ?></textarea>
            </div>
            <div class="form-input-div">
                <label>Phone Number <span class="required-star">*</span></label>
                <input class="form-control" type="text" id="mobile" name="mobile"
                    value="<?php echo $data->mobile?>" maxlength="13"
                    placeholder="Mobile Number" autocomplete="off" required="">
            </div>
            <div class="form-input-div">
                <label>Email <span class="required-star">*</span></label>
                <input class="form-control" type="email" name="email" id="emailid" placeholder="Email"
                    value="<?php echo $data->email?>"
                    autocomplete="off" required="">
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