<?php
    if (!isset($book)) {
        return;
    }
    ?>
<article class="main">
    <section>
        <div class="container div-card view-book">
            <div class="row">
                <div class="cols col-9">
                    <h1><?php echo $book->name?>
                    </h1>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="cols col-3 img-cover">
                    <img
                        src="/upload/book/<?php echo $book->coverpic; ?>">
                </div>
                <div class="cols col-4">
                    <div>
                        <h3> Authors </h3>
                        <div class='text-author'>
                            <ul class="styled-list">
                                <?php
                                foreach (explode(",", $book->authors) as $author) {
                                    echo "<li>  $author </li>";
                                }
                            ?>
                            </ul>
                        </div>
                        <h3> About the Book </h3>
                        <p class="text-para"><?php echo $book->description; ?>
                        </p>
                        <h3> Categories </h3>
                        <ul class="styled-list">
                            <?php
                                foreach (explode(",", $book->categories) as $category) {
                                    echo "<li>  $category </li>";
                                }
                            ?>
                        </ul>
                        <h3>ISBN Number</h3>
                        <p class="text-para"> <?php echo $book->isbnNumber; ?>
                        </p>
                        <h3>Location</h3>
                        <p> <?php echo $book->location;?>
                        </p>
                        <p class="stack-msg">* Currently <i><?php echo ($book->available == 0) ? "no" : $book->available; ?>
                            </i> <?php echo ($book->available == 1) ? "copy" : "copies"; ?>
                            available</p>
                        <?php if ($user == REG_USER): ?>
                        <div class="form-buttons">
                            <button
                                onclick="requestBook(<?php echo $book->isbnNumber . ',' . $book->available; ?>)"
                                class="btn-link <?php echo ($book->available == 0) ? "disabled" : ""; ?>">Request
                                to Lend</button>
                            <a href="/user/availbleBooks" class="btn-link">View All</a>
                        </div>
                        <?php else: ?>
                        <h3>Stack</h3>
                        <p> <?php echo $book->stack;?> <?php echo ($book->stack == 1) ? "copy" : "copies"; ?></p>
                        <h3> Issued To users </h3>
                        <ul class="styled-list">
                            <?php
                                if (empty($issuedUsers->issued)) {
                                    echo "-";
                                } else {
                                    foreach ($issuedUsers->issued as $user) {
                                        echo "<li>  $user </li>";
                                    }
                                }
                            ?>
                        </ul>
                        <h3> Requested users </h3>
                        <ul class="styled-list">
                            <?php
                                if (empty($issuedUsers->requested)) {
                                    echo "-";
                                } else {
                                    foreach ($issuedUsers->requested as $user) {
                                        echo "<li>  $user </li>";
                                    }
                                }
                            ?>
                        </ul>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
<script>
    document.getElementById("books").className += " active";
</script>