<?php
defined('VALID_REQ') or exit('Invalid request');
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Lent Books List</h1>
                    <hr>
                </div>
            </div>
            <div class="div-card-body">
                <div class='table-panel'>
                    <div class="form-input-div">
                        <label> Record count </label>
                        <select id="recordCount" onchange="changePagination('/user/requestedBooks');"
                            class="table-form-control">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>
                    </div>
                    <div class="form-input-div">
                        <label> Search </label>
                        <input type="text" id="recordSearch" onchange="changePagination('/user/requestedBooks');"
                            value="<?php echo $pagination['search']; ?>"
                            class="table-form-control">
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tab_design">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>ISBN </th>
                                <th>Requested Date</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; if (isset($books)): ?>

                            <?php foreach ($books as $book):?>
                            <tr id="<?php echo $book->id;?>">
                                <td><?php echo ++$i;?>
                                </td>
                                <td><?php echo $book->isbnNumber;?>
                                </td>
                                <td><?php echo $book->bookName?>
                                </td>
                                <td><?php echo $book->requestedAt;?>
                                </td>
                                <td><?php echo $book->comments;?>
                                </td>
                                <td><?php echo $book->status;?>
                                </td>
                                <td>
                                    <button type="button"
                                        onclick="deleteItem('/userRequest/delete/<?php echo $book->id; ?>');"
                                        class="button-control icon-btn negative" title="delete"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="table-panel">
                    <div>
                        <?php if ($pagination['tcount']==0): ?>
                            No records found
                        <?php else:?>
                        Showing <?php echo $pagination['start']; ?>
                        to <?php echo $pagination['end']; ?>
                        of <?php echo $pagination['tcount']; ?>
                        entries
                        <?php endif;?>
                    </div>
                    <div>
                        <ul class="pagination">
                            <?php
                                if ($pagination['tpages'] > 1) {
                                    $previous = ($pagination['start'] == 1)
                                    ? '<li class="disable"><a class="disable">Previous</a></li>'
                                    : '<li><a href="/user/requestedBooks?index='.((($pagination['cpage']-1)) * $pagination['limit']).'&limit='.$pagination['limit'].'&search='.$pagination['search'].'">Previous</a></li>';
                                    echo $previous;
                                    $first = ($pagination['start'] == 1)
                                    ? '<li class="active"><a>1</a></li>'
                                    : '<li><a href="/user/requestedBooks?index=0&limit='.$pagination['limit'].'&search='.$pagination['search'].'">1</a></li>';
                                    echo $first;
                                    if ($pagination['tpages'] > 6 && $pagination['cpage'] > 4) {
                                        $i = $pagination['cpage'];
                                        $iEnd = $pagination['cpage'] + 3;
                                        $iEnd = $pagination['tpages'] < $iEnd ? $pagination['tpages'] : $iEnd;
                                    } else {
                                        $i = 2;
                                        $iEnd = $pagination['tpages'] < 6 ? $pagination['tpages'] : 6;
                                    }
                                    if ($i != 2) {
                                        echo "<li class='disable'>...</li>";
                                    }
                                    for (; $i < $iEnd; $i++) {
                                        $li = "<li";
                                        $li = ($i == $pagination['cpage']+1)
                                        ? $li . " class='active'><a>$i</a></li>"
                                        : $li . "><a href='/user/requestedBooks?index=".($pagination['limit']*($i-1))."&limit=".$pagination['limit'].'&search='.$pagination['search']."'>$i</a></li>";
                                        // $li .= "";
                                        echo $li;
                                    }
                                    if ($i != $pagination['tpages']) {
                                        echo "<li class='disable'>...</li>";
                                    }
                                    $last = ($pagination['end'] == $pagination['tcount'])
                                    ? '<li class="active"><a>'.$pagination['tpages'].'</a></li>'
                                    : '<li><a href="/user/requestedBooks?index='.(($pagination['tpages']-1)*$pagination['limit']).'&limit='.$pagination['limit'].'&search='.$pagination['search'].'">'.$pagination['tpages'].'</a></li>';
                                    echo $last;
                                    $next = ($pagination['end'] == $pagination['tcount'])
                                    ? '<li class="disable"><a class="disable">Next</a></li>'
                                    : '<li><a href="/user/requestedBooks?index='.((($pagination['cpage']+1)* $pagination['limit'])).'&limit='.$pagination['limit'].'&search='.$pagination['search'].'">Next</a></li>';
                                    echo $next;
                                }
                            ?>

                            <!-- <li class="active"><a>1</a></li>
                            <li><a>2</a></li>
                            <li><a>3</a></li> -->
                            <!-- <li><a>Next</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<script>
    document.getElementById('booked').className += " active";
    document.getElementById('recordCount').value =
        "<?php echo $pagination['limit'] ?>";
</script>