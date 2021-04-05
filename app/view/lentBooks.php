<article class="main">    
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Lent Books List</h1><hr>
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
                                <th>#</th>
                                <th>Book Name</th>
                                <th>ISBN </th>
                                <th>Issued Date</th>
                                <th>Return Date</th>
                                <th>Fine in(USD)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; if (isset($books)): ?>
                                
                                <?php foreach($books as $book):?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $book->isbnNumber;?></td>
                                        <td><?php echo $book->bookName?></td>
                                        <td><?php echo $book->issuedAt;?></td>
                                        <td><?php echo $book->returnAt;?></td>
                                        <td>
                                        <?php echo $book->fine;?>
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
    document.getElementById('lent').className += " active";
</script>