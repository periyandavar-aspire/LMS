<section class="card">
    <h1>New Book</h1>
    <hr>
    <form action="#" onsubmit="event.preventDefault(); registrationFormValidator(event);" method="POST">
        <div class="form-input-div">
            <label>Enter Book Name</label>
            <input class="form-control" type="text" id="bookname" name="bookanme" autocomplete="off" placeholder="Book Name..." required="">
        </div>
        <div class="form-input-div">
            <label>Select Category</label>
            <select class="form-control select-input" name="category" id="category" required="">
                <option value="" style="display: none;">Select Category</option>
                <!-- <option value="m">Male</option>
                <option value="f">Female</option> -->
            </select>
        </div>
        <div class="form-input-div">
            <label>Select Authors</label>
            <select class="form-control select-input" name="authors" id="authors" required="">
                <option value="" style="display: none;">Select Authors</option>
                <!-- <option value="m">Male</option>
                <option value="f">Female</option> -->
            </select>
        </div>                                                    
        <div class="form-input-div">
            <label>Enter ISBN Number</label>
            <input class="form-control" type="text" name="isbn" id="isbn" placeholder="ISBN Number..." autocomplete="off" required="">  
            <span>An ISBN is an International Standard Book Number.ISBN Must be unique</span>
        </div>                    
        <div class="form-input-div">
            <label>Enter Price</label>
            <input class="form-control" type="text" pattern="[0-9]" id="price" name="price" placeholder="Price.." autocomplete="off" required="">
        </div>    
        <div class="form-input-div">
            <label>Enter Stack (No. of copies availabile)</label>
            <input class="form-control" type="number" pattern="[0-9]" id="stack" name="stack" placeholder="stack.." autocomplete="off" required="">
        </div>                                   
        <div class="form-buttons">
            <button type="submit" class="button-control positive">Add</button>
            <!-- <button type="button" onclick="closeModal('sign-up-modal');" class="button-control negative">Cancel</button> -->
        </div>
    </form>
</section>
<!-- <section class="card">
    <h1>Import Book</h1>
    <hr>
    <p> please use csv format file to import. The storage format should be like in the image
    <form action="#" onsubmit="event.preventDefault(); registrationFormValidator(event);" method="POST">
        <div class="form-input-div">
            <label>Enter Full Name</label>
            <input class="form-control" type="file"  id="file-import" name="file-import" autocomplete="off"  required="">
        </div>                                   
        <div class="form-buttons">
            <button type="submit" class="button-control positive">Import</button>
            <!-- <button type="button" onclick="closeModal('sign-up-modal');" class="button-control negative">Cancel</button> -->
        </div>
    </form>
</section> -->
<script>
    document.getElementById('books').className+=" active";
    <script src="../static/js/bookstatus.js"></script>
</script>