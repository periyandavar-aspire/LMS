<?php
defined('VALID_REQ') or exit('Invalid request');
if (!isset($books)) {
    return;
}
?>
<article class="main">
    <!-- section 1 -->
    <section>
        <div class="container">
            <div class="row" id="books-list">
                <?php if (isset($books)):?>
                <?php if (count($books) ==0): ?>
                <p> No Books found for your search result </p>
                <?php else:?>
                <?php foreach ($books as $book): ?>
                <div class="card cols">
                    <a href="/book/<?php echo $book->id;?>">
                    <book-element
                        cover="<?php echo Utility::baseURL()?>/upload/book/<?php echo $book->coverPic;?>"
                        book="<?php echo $book->name; ?>"
                        author="<?php echo $book->author;?>"
                        id="<?php echo $book->id;?>">
                    </book-element>
                    </a>

                    <div class="card-content">
                        <h3><?php echo $book->name?>
                        </h3>
                        <div class="text-author"><?php echo $book->author;?>
                        </div>
                        <p><?php echo $book->description;?>
                        </p>
                        <p>only <?php echo $book->available;?>
                            <?php echo ($book->available == 1) ? "copy" : "copies"; ?>
                            available
                        </p>
                        <div class="btn-container">
                            <a class="btn-link"
                                href="/book/<?php echo $book->id;?>">View
                                Book</a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <!-- show more button -->
            <div class="btn-container" id="loadMore">
                <a class="btn-link" onclick='loadMoreBooks(event, "/books/load");'>SHOW MORE</a>
            </div>
            <?php endif;?>
            <?php endif;?>
            
    </section>
</article>
<script>
    document.getElementById("books").className += " active";
</script>