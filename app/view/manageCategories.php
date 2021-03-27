<article class="main">    
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Categories &nbsp;<a class="btn-link" onclick="openModal('addRecord');">Add</a></h1><hr>
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
                                <th>Category</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>PHP And MySql programming</td>
                                <td>2017-07-15 16:29:26</td>
                                <td>2017-07-15 16:29:26</td>
                                <td><div class="checkbox"><input type="checkbox"></div></td>
                                <td>
                                    <button type="button" class="button-control icon-btn" title="view"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr> 
                            <tr>
                                <td>1</td>
                                <td>PHP And MySql programming</td>
                                <td>2017-07-15 16:29:26</td>
                                <td>2017-07-15 16:29:26</td>
                                <td><div class="checkbox"><input type="checkbox"></div></td>
                                <td>
                                    <button type="button" class="button-control icon-btn" title="view"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr> 
                            <tr>
                                <td>1</td>
                                <td>PHP And MySql programming</td>
                                <td>2017-07-15 16:29:26</td>
                                <td>2017-07-15 16:29:26</td>
                                <td><div class="checkbox"><input type="checkbox"></div></td>
                                <td>
                                    <button type="button" class="button-control icon-btn" title="view"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr> 
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
                <h1>Add New Category</h1>
                <hr><br>
                <form action="/admin/categories/add" method="post">
                    <div class="form-input-div">
                        <label>Category Name</label>
                        <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="catname" name="name" autocomplete="off" placeholder="Category Name..." required="">
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
    document.getElementById('categories').className += " active";
</script>