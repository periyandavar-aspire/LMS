<?php
    // if (!isset($books)) {
    //     return;
    // }
?>
<article class="main">    
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Issued Books &nbsp;<a class="btn-link" onclick="openModal('addRecord');loadCategories();loadAuthors();">New Entry</a></h1><hr>
                </div>
            </div>
            <div class="div-card-body">
                <div class='table-panel'>
                    <div class="form-input-div">
                        <label> Record count </label>
                        <select class="table-form-control">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>
                    </div>
                    <div class="form-input-div">
                        <label> Search </label>
                        <input type="text" class="table-form-control">
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tab_design">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>ISBN Number</th>
                                <th>Book Name</th>
                                <th>User Name</th>
                                <th>Issued Date</th>
                                <th>Return Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; if (isset($books)): ?>
                                
                                <?php foreach($books as $book):?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $book->name;?></td>
                                        <td><?php echo $book->createdAt?></td>
                                        <td><?php echo $book->updatedAt;?></td>
                                        <td><div class="checkbox"><input type="checkbox" id="<?php echo $book->id;?>" <?php if ($book->status == 1) echo "checked";?>></div></td>
                                        <td>
                                            <a type="button" href="/admin/books/edit/<?php echo $book->id;?>" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></a>
                                            <a type="button" href="/admin/books/delete/<?php echo $book->id;?>" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr> 
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="table-panel">
                    <div>
                        Showing 1 to 2 of 2 entries
                    </div>
                    <div>
                        <ul class="pagination">
                            <li class="disable"><a>Previous</a></li>
                            <li class="active"><a>1</a></li>
                            <li><a>2</a></li>
                            <li><a>3</a></li>
                            <li><a>Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-shadow" id="addRecord">
            <div class="modal">
                <span class="close-modal" onclick="closeModal('addRecord');">✖</span>
                <h1>Add New Book</h1>
                <hr><br>
                <form action="/admin/books" enctype="multipart/form-data" method="post">
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
                        <select class="form-control" type="text" id="author" name="author" required="">
                            <option style="display:none">Select Author</option>
                        </select>
                    </div>

                    <div class="form-input-div">
                        <label>Category</label>
                        <select class="form-control" type="text" id="category" name="category"required="">
                            <option style="display:none">Select Category</option>
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
                        <input class="form-control" type="text" id="stack" name="stack" autocomplete="off" placeholder="stack" required="">
                    </div>
                    <div class="form-input-div">
                        <label>Description</label>
                        <input class="form-control" type="text" id="description" name="description" autocomplete="off" placeholder="description" required="">
                    </div>
                    <div class="form-input-div">
                        <label>Keywords</label>
                        <input class="form-control" type="text" id="keywords" name="keywords" autocomplete="off" placeholder="keywords" required="">
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
        </div>
    </section>
</article>

<script>
    document.getElementById('issued').className += " active";
</script>
<!-- <script src="<?php echo Utility::baseURL();?>/static/js/bookstatus.js"></script> -->
