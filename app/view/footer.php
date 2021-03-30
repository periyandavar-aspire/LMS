<!-- footer starts -->
<?php
if (!isset($footer)) {
    return;
} ?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="cols col-3">
                <div class="text-container">
                    <h4>About us</h4>
                    <p class="indent-para"><?php echo $footer->aboutUs;?></p>
                </div>
            </div>
            <div class="cols col-3">
                <div class="text-container">
                    <h4>Contact us</h4>
                    <p><i class="fa fa-map-marker symbols" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $footer->address;?><br>
                        <i class="fa fa-phone symbols" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $footer->mobile; ?><br>
                        <i class="fa fa-envelope-o symbols" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $footer->email; ?><br>
                    </p>
                </div>
            </div>
            <div class="cols col-1">
                <div class="text-container">
                    <h4>Follow us</h4>
                    <ul class="unstyle-list">
                        <li>
                            <a href="<?php echo $footer->fbUrl;?>" target="_blank"><i class="fa fa-facebook-square symbols" aria-hidden="true"></i>&nbsp;&nbsp;Facebook</a>
                        </li>
                        <li>
                            <a href="<?php echo $footer->instaUrl;?>" target="_blank"><i class="fa fa-instagram symbols" aria-hidden="true"></i>&nbsp;&nbsp;Instagram</a>
                        </li>
                        <li>
                            <a href="<?php echo $footer->ytUrl;?>" target="_blank"><i class="fa fa-youtube-play symbols" aria-hidden="true"></i>&nbsp;&nbsp;Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container align-container-center">
        <div class="row">
            <div class="cols col-9">
                <p>Copyright © 2020 LMS</p>
            </div>
        </div>
    </div>
</footer>
<!-- end of footer -->
<!-- loading scripts -->
<script src="/static/js/core.js"></script>
<script src="/static/js/scriptHome.js"></script>
</body>

</html>