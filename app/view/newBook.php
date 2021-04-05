<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Add New Book &nbsp;<a class="btn-link" href="/admin/books">View Available Books</a></h1><hr>
                </div>
            </div>
        
            <form action="/admin/books/add" enctype="multipart/form-data" method="post">
                <div class="form-input-div">
                    <label>Name</label>
                    <input class="form-control" type="text" id="bookname" name="name" autocomplete="off" placeholder="Book Name" required="">
                </div>
                <div class="form-input-div">
                    <label>Location</label>
                    <input class="form-control" type="text" id="location" name="location" autocomplete="off" placeholder="Book Location" required="">
                </div>

                <div class="form-input-div">
                    <label>Author</label>
                    <select class="form-control select-input" type="text" id="author" name="author" required="">
                        <option style="display:none">Select Author</option>
                        <?php if(isset($authors)):?>
                         <?php foreach ($authors as $author): ?>
                         <option value="<?php echo $author->code;?>"><?php echo $author->value;?></option>
                         <?php endforeach;?>
                         <?php endif;?>
                    </select>
                </div>

                <div class="form-input-div">
                    <label>Category</label>
                    <select class="form-control select-input" type="text" id="category" name="category"required="">
                        <option style="display:none">Select Category</option>
                        <?php if(isset($categories)):?>
                         <?php foreach ($categories as $category): ?>
                         <option value="<?php echo $category->code;?>"><?php echo $category->value;?></option>
                         <?php endforeach;?>
                         <?php endif;?>
                    </select>
                </div>

                <div class="form-input-div">
                    <label>Publication</label>
                    <input class="form-control" type="text" id="publication" name="publication" autocomplete="off" placeholder="Book Publication" required="">
                </div>
                <div class="form-input-div">
                    <label>ISBN</label>
                    <input class="form-control" type="text" id="isbn" name="isbn" autocomplete="off" placeholder="ISBN Number" required="">
                </div>
                <div class="form-input-div">
                    <label>Price</label>
                    <input class="form-control" type="text" id="price" name="price" autocomplete="off" placeholder="Price" required="">
                </div>
                <div class="form-input-div">
                    <label>Stack</label>
                    <input class="form-control" type="text" id="stack" name="stack" autocomplete="off" placeholder="Stack" required="">
                </div>
                <div class="form-input-div">
                    <label>Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Description" required=""></textarea>
                </div>
                <div class="form-input-div">
                    <label>Keywords</label>
                    <textarea class="form-control" id="keywords" name="keywords" placeholder="Keywords" required=""></textarea>
                </div>
                <div class="form-input-div">
                    <label>Cover Pic</label>
                    <input class="form-control" type="file" id="coverPic" name="coverPic" accept=".jpg, .png" onchange="changePreview(event);" required="">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-link">Add</button>
                </div>
            </form>
        </div>
    </section>
</article>
<script>
    document.getElementById('books').className += " active";
</script>