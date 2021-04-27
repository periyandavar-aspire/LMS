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
                    <label>ISBN Number <span class="required-star">*</span></label>
                    <input pattern="^[0-9]+$" class="form-control" autocomplete="off" type="text"
                        id="isbnNumber" name="isbnNumber" placeholder="Book Name" required="">
                </div>
            </div>
            <div class="cols col-2">
                <div class="form-buttons">
                    <button type="submit" class="btn-link">Generate book report</button>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
    document.getElementById('reports').className += " active";
    autocomplete(document.getElementById("username"), null, "/user/get/");
    autocomplete(document.getElementById("isbnNumber"), null, "/book/get/");
</script>