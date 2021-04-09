<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>New Book</h1><hr>
                </div>
            </div>
        
            <form action="/admin/issueBook" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="cols col-4">
                <div class="form-input-div">
                    <label>User name</label>
                    <input onchange="loadUserDetails(event)" class="form-control" type="text" id="username" name="username" placeholder="User Name" required="">
                </div>
                </div>
                
                <div class="cols col-4">
                    <div class="form-input-div">
                        <label>User Details</label>
                        <textarea disabled class="form-control" id="userdetails" name="userDetails" placeholder="User details" required=""></textarea>
                    </div>
                </div>
                
                    <div class="cols col-4">
                <div class="form-input-div">
                    <label>ISBN Number</label>
                    <input onchange="loadBookDetails(event);" class="form-control" type="text" id="bookname" name="isbnNumber" placeholder="Book Name" required="">
                </div>
                </div>
               
                    <div class="cols col-4">
                <div class="form-input-div">
                    <label>Book Details</label>
                    <div class="form-control div-like-textarea disabled" id="bookdetails"></div>
                </div>
                </div>
                
                    <div class="cols col-9">
               <div class="form-input-div">
                    <label>Comments (if any)</label>
                    <textarea class="form-control" id="comments" name="comments" placeholder="comments" required=""></textarea>
                </div>
                </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-link">Add</button>
                </div>
                </div>
            </form>
        </div>
    </section>
</article>
<script>
    document.getElementById('issued').className += " active";
</script>