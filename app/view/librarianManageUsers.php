<?php
    if (!isset($users)) {
        return;
    }
?>
<article class="main">    
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Users</h1><hr>
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
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Registered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; if (isset($users)): ?>
                                
                                <?php foreach ($users as $user):?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $user->fullName;?></td>
                                        <td><?php echo $user->userName;?></td>
                                        <td><?php echo $user->email;?></td>
                                        <td><?php echo $user->mobile;?></td>
                                        <td><?php echo $user->createdAt?></td>
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
    document.getElementById('manageUsers').className += " active";
</script>
<!-- <script src="<?php echo Utility::baseURL();?>/static/js/bookstatus.js"></script> -->
