<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>User Request</h1>
                    <hr>
                </div>
            </div>

            <form action="" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>User name</label>
                            <input disabled class="form-control disabled" type="text" id="username" name="username"
                                value="<?php echo $user->userName; ?>"
                                placeholder="User Name" required="">
                        </div>
                    </div>

                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>User Details</label>
                            <div class="form-control div-like-textarea disabled" id="userdetails">
                                <?php
                                echo $user->fullName . "<br>";
                                echo $user->mobile . "<br>";
                                echo $user->email . "<br>";
                                echo 'lent books '.$user->lent ;
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>ISBN Number</label>
                            <input disabled class="form-control disabled" type="text" id="isbnNumber"
                                value="<?php echo $book->isbnNumber; ?>"
                                name="isbnNumber" placeholder="Book Name" required="">
                        </div>
                    </div>

                    <div class="cols col-4">
                        <div class="form-input-div">
                            <label>Book Details</label>
                            <div class="form-control div-like-textarea disabled" id="bookdetails">
                                <div class="img-wrapper">
                                    <?php
                            echo "<img src='/upload/book/$book->coverPic'>";
                        ?>
                                </div>
                                <div class="text-wrapper">
                                    <?php
                                echo $book->name . '<br>';
                                echo "location: $book->location <br>";
                                echo "$book->publication<br>";
                                $available = $book->available == 0 ? 'no' : $book->available;
                                $available .= $book->available == 1 ? ' copy' : ' copies';
                                echo "$available available";
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cols col-9">
                        <div class="form-input-div">
                            <label>Comments (if any)</label>
                            <textarea class="form-control" id="comments" name="comments"
                                placeholder="comments"><?php echo $comments; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" name='status' value='1' class="btn-link">Approve</button>
                    <button type="submit" name='status' value='0' class="btn-link negative">Reject</button>
                </div>
        </div>
        </form>
        </div>
    </section>
</article>
<script>
    document.getElementById('request').className += " active";
</script>