<?php
defined('VALID_REQ') or exit('Invalid request');
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Report Generation </h1>
                    <hr>
                </div>
            </div>
        <div class="row">
            
            <div class="cols col-2">
                <div class="form-input-div">
                    <label>User Name <span class="required-star">*</span></label>
                    <input class="form-control" autocomplete="off" type="text" id="username" name="username"
                        placeholder="User Name" required="">
                </div>
            </div>
            <div class="cols col-2">
                <div class="form-buttons">
                    <button type="submit" class="btn-link">Generate user report</button>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
    document.getElementById('reports').className += " active";
</script>