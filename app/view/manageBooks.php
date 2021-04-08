<?php
    if (!isset($books)) {
        return;
    }
?>
<article class="main">    
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Books &nbsp;<a class="btn-link" href="/books/add">Add</a></h1><hr>
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
                                <th>Author</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; if (isset($books)): ?>
                                
                                <?php foreach ($books as $book):?>
                                    <tr id="<?php echo $book->id;?>">
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $book->name;?></td>
                                        <td><?php echo $book->createdAt?></td>
                                        <td><?php echo $book->updatedAt;?></td>
                                        <td><div class="checkbox"><input type="checkbox" onchange="changeStatus(event,'/books/changeStatus/<?php echo $book->id;?>');" <?php if ($book->status == 1) {
    echo "checked";
}?>></div></td>
                                        <td>
                                            <a type="button" href="/books/edit/<?php echo $book->id;?>" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></a>
                                            <button type="button" onclick="deleteItem('/books/delete/<?php echo $book->id;?>');" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>
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
    document.getElementById('books').className += " active";
</script>
<!-- <script src="<?php echo Utility::baseURL();?>/static/js/bookstatus.js"></script> -->
