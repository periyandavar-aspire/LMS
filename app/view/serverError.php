<?php
defined('VALID_REQ') or exit('Invalid request');
?>
<!-- header starts -->
<header class="err-500-container">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="cols">
                    <div class="text-container">
                        <div class='msg-card'>
                            <h1>500 Internal Server Error</h1><br>
                            <p class="heading-para"><?php echo $msg; ?>
                            </p>
                            <?php if (isset($data)) {
                                print_r($data);
                            } ?>
                            </p>
                            <a class="btn-link" href="/home">GO TO HOME</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header ends -->