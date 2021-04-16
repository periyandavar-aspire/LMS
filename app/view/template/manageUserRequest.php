<?php
    if (!isset($issuedBooks)) {
        return;
    }
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>User Request for Books
                        <hr>
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
                                <th>Requested Date</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; if (isset($issuedBooks)): ?>

                            <?php foreach ($issuedBooks as $issued):?>
                            <tr>
                                <td><?php echo ++$i;?>
                                </td>
                                <td><?php echo $issued->isbnNumber;?>
                                </td>
                                <td><?php echo $issued->bookName?>
                                </td>
                                <td><?php echo $issued->userName;?>
                                </td>
                                <td><?php echo $issued->requestedAt;?>
                                </td>
                                <td><?php echo $issued->comments;?>
                                </td>
                                <td><?php echo $issued->status;?>
                                </td>
                                <td>
                                    <a type="button"
                                        href="/userRequest/<?php echo $issued->id;?>"
                                        class="button-control icon-btn positive" title="edit"><i
                                            class="fa fa-edit"></i></a>
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
    document.getElementById('request').className += " active";
</script>
<!-- <script src="<?php echo Utility::baseURL();?>/static/js/bookstatus.js">
</script> -->