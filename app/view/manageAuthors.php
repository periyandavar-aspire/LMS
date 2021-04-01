<article class="main">    
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Authors &nbsp;<a class="btn-link" onclick="openModal('addRecord');">Add</a></h1><hr>
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
                            <?php $i=0; if (isset($authors)): ?>
                                
                                <?php foreach($authors as $author):?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $author->name;?></td>
                                        <td><?php echo $author->createdAt;?></td>
                                        <td><?php echo $author->updatedAt;?></td>
                                        <td><div class="checkbox"><input type="checkbox" id="<?php echo $author->id;?>" <?php if ($author->status == 1) echo "checked";?>></div></td>
                                        <td>
                                            <a type="button" href="/admin/authors/edit/<?php echo $author->id;?>" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></a>
                                            <a type="button" href="/admin/authors/edit/<?php echo $author->id;?>" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></a>
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
                <h1>Add New Author</h1>
                <hr><br>
                <form action="/authors/add" method="post">
                    <div class="form-input-div">
                        <label>Author Name</label>
                        <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="autname" name="name" autocomplete="off" placeholder="Author Name..." required="">
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
    document.getElementById('authors').className += " active";
</script>