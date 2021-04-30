<?php
/**
 * Settings
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
        <h1>Settings</h1>
        <hr>
        <form action="/admin/settings" onsubmit="//event.preventDefault(); registrationFormValidator(event);"
            method="POST">
            <div class="form-input-div">
                <label>Maximum Book Lend <span class="required-star">*</span> </label>
                <input class="form-control" type="number" id="maxbookLend" name="maxBookLend" maxlength="2"
                    placeholder="Maximum Book Lend" autocomplete="off" required=""
                    value="<?php echo $data->maxBookLend; ?>">
            </div>
            <div class="form-input-div">
                <label>Maximum Lend Days <span class="required-star">*</span></label>
                <input class="form-control" type="number" id="maxLendDays" name="maxLendDays" maxlength="2"
                    placeholder="Maximum Lend Days" required=""
                    value="<?php echo $data->maxLendDays; ?>">
            </div>
            <div class="form-input-div">
                <label>Maximum Book Request  <span class="required-star">*</span></label>
                <input class="form-control" type="number" id="maxBookRequest" name="maxBookRequest" maxlength="2"
                    placeholder="Maximum Book Request" required=""
                    value="<?php echo $data->maxBookRequest; ?>">
            </div>
            <div class="form-input-div">
                <label>Fine Amout per day <span class="required-star">*</span></label>
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