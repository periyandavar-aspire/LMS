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
                    <h1>Issued Book Entry</h1><hr>
                </div>
            </div>
        
            <form action="/admin/books/add" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="cols col-4">
                <div class="form-input-div">
                    <label>User name</label>
                    <input class="form-control" type="text" id="username" name="user" placeholder="User Name" required="">
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
                    <label>Book name</label>
                    <input class="form-control" type="text" id="bookname" name="book" placeholder="Book Name" required="">
                </div>
                </div>
               
                    <div class="cols col-4">
                <div class="form-input-div">
                    <label>Book Details</label>
                    <textarea disabled class="form-control" id="bookdetails" name="bookDetails" placeholder="Book details" required=""></textarea>
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
 
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Issued Books
                         <!-- &nbsp;<a class="btn-link" href="/admin/issueBook">New Entry</a> -->
                        </h1><hr>
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
                            <?php $i=0; if (isset($issuedBooks)): ?>
                                
                                <?php foreach($issuedBooks as $issued):?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $issued->isbnNumber;?></td>
                                        <td><?php echo $issued->bookName?></td>
                                        <td><?php echo $issued->userName;?></td>
                                        <td><?php echo $issued->issuedAt;?></td>
                                        <td><?php echo $issued->returnAt;?></td>
                                        <td>
                                            <a type="button" href="/admin/issuedBooks/edit/<?php echo $book->id;?>" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></a>
                                            <!-- <a type="button" href="/admin/issuedBooks/delete/<?php echo $book->id;?>" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></a> -->
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
    </section>
    </article>
<script>
    document.getElementById('issued').className += " active";
</script>
<script>
    document.getElementById('issued').className += " active";
</script>
<!-- <script src="<?php echo Utility::baseURL();?>/static/js/bookstatus.js"></script> -->
