<?php
defined('VALID_REQ') or exit('Invalid request');
if (!isset($data)) {
    return;
}
?>
<article class="main">
    <section>
        <h1>Settings</h1>
        <hr>
        <form action="/admin/settings" onsubmit="//event.preventDefault(); registrationFormValidator(event);"
            method="POST">
            <div class="form-input-div">
                <label>Maximum Book Lend </label>
                <input class="form-control" type="number" id="maxbookLend" name="maxBookLend" maxlength="2"
                    placeholder="Maximum Book Lend" autocomplete="off" required=""
                    value="<?php echo $data->maxBookLend; ?>">
            </div>
            <div class="form-input-div">
                <label>Maximum Lend Days</label>
                <input class="form-control" type="number" id="maxLendDays" name="maxLendDays" maxlength="2"
                    placeholder="Maximum Lend Days" required=""
                    value="<?php echo $data->maxLendDays; ?>">
            </div>
            <div class="form-input-div">
                <label>Maximum Book Request </label>
                <input class="form-control" type="number" id="maxBookRequest" name="maxBookRequest" maxlength="2"
                    placeholder="Maximum Book Request" required=""
                    value="<?php echo $data->maxBookRequest; ?>">
            </div>
            <div class="form-input-div">
                <label>Fine Amout per day</label>
                <input class="form-control" type="number" id="fineAmtPerDay" name="fineAmtPerDay"
                    placeholder="Fine Amount per day" $maxlength="2" required=""
                    value="<?php echo $data->fineAmtPerDay; ?>">
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
    document.getElementById('settings').className += " active";
</script>