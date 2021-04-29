<?php
defined('VALID_REQ') or exit('Invalid request');
?>
<article class="main">
    <section>
        <div class="container div-card">
            <div class="row">
                <div class="cols col-9">
                    <h1>Add New Book &nbsp;<a class="btn-link" href="/book-management">View Available Books</a></h1>
                    <hr>
                </div>
            </div>

            <form action="" enctype="multipart/form-data" onsubmit="bookEditFormValidator(event);" method="post">
                <div class="form-input-div">
                    <label>Name</label>
                    <input class="form-control" type="text" <?php if (isset($book->name)) {
                        echo "value='".$book->name."'";
                    }?>
                    id="bookname" name="name" autocomplete="off" placeholder="Book Name" required="">
                </div>
                <div class="form-input-div">
                    <label>Location</label>
                    <input class="form-control" type="text" <?php if (isset($book->location)) {
                        echo "value='".$book->location."'";
                    }?>
                    id="location" name="location" autocomplete="off" placeholder="Book Location" required="">
                </div>

                <!-- <div class="form-input-div">
                    <label>Author</label>
                    <input class="form-control autocomplete" type="text" id="search-author" autocomplete="off"
                        placeholder="Search Author">
                </div> -->
                <div class="form-input-div">
                    <label>Authors</label>
                    <div class="form-control list-group" contenteditable="true" id="authorslist" name="userDetails">
                        <?php
                            if (isset($book)) {
                                $dataCodes = explode(",", $book->authorCodes);
                                $dataValues = explode(",", $book->authors);
                                for ($i=0; $i < count($dataCodes); $i++) {
                                    echo '<span contenteditable="false" class="list-group-item" id="list-group-item-' . $dataCodes[$i] . '" data-value="' . $dataCodes[$i] . '">' . $dataValues[$i] . ' <span class="badge removeItems" id="removeItem-'.$dataCodes[$i].'" data-id="' . $dataCodes[$i] . '">X</span></span>&nbsp;';
                                }
                            }
                        ?>
                    </div>
                </div>
                <input type="hidden" <?php if (isset($book->authorCodes)) {
                            echo "value='".$book->authorCodes.",'";
                        }?>
                        name="author" required id="selected-author">
                <!-- <div class="form-input-div">
                    <label>Category</label>
                    <input class="form-control autocomplete" type="text" id="search-category" autocomplete="off"
                        placeholder="Search Category">
                </div> -->
                <div class="form-input-div">
                    <label>Categories</label>
                    <div contenteditable="true" class="form-control list-group " id="catlist" name="userDetails">
                        <?php
                            if (isset($book)) {
                                $dataCodes = explode(",", $book->categoryCodes);
                                $dataValues = explode(",", $book->categories);
                                for ($i=0; $i < count($dataCodes); $i++) {
                                    echo '<span contenteditable="false" class="list-group-item" id="list-group-item-' . $dataCodes[$i] . '" data-value="' . $dataCodes[$i] . '">' . $dataValues[$i] . ' <span class="badge removeItems" id="removeItem-'.$dataCodes[$i].'" data-id="' . $dataCodes[$i] . '">X</span></span>&nbsp;';
                                }
                            }
                        ?>
                    </div>
                    <input type="hidden" <?php if (isset($book->categoryCodes)) {
                            echo "value='".$book->categoryCodes.",'";
                        }?>
                        name="category" required id="selected-category">
                </div>

                <div class="form-input-div">
                    <label>Publication</label>
                    <input class="form-control" type="text" <?php if (isset($book->publication)) {
                            echo "value='".$book->publication."'";
                        }?>
                    id="publication" name="publication" autocomplete="off" placeholder="Book Publication" required="">
                </div>
                <div class="form-input-div">
                    <label>ISBN</label>
                    <input class="form-control" type="text" <?php if (isset($book->isbn)) {
                            echo "value='".$book->isbn."'";
                        }?>
                    id="isbn" name="isbn" autocomplete="off" placeholder="ISBN Number" required="">
                </div>
                <div class="form-input-div">
                    <label>Price</label>
                    <input class="form-control" type="number" min="0" id="price" name="price" <?php if (isset($book->price)) {
                            echo "value='".$book->price."'";
                        }?>
                    autocomplete="off" placeholder="Price" required="">
                </div>
                <div class="form-input-div">
                    <label>Stack</label>
                    <input class="form-control" type="number" min="0" id="stack" name="stack" <?php if (isset($book->stack)) {
                            echo "value='".$book->stack."'";
                        }?>
                    autocomplete="off" placeholder="Stack" required="">
                </div>
                <div class="form-input-div">
                    <label>Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Description"
                        required=""><?php if (isset($book->description)) {
                            echo $book->description;
                        }?></textarea>
                </div>

                <div class="form-input-div">
                    <label>Cover Picture</label>
                    <?php if (isset($book->coverPic)) {
                            echo '<input class="form-control" type="file" id="coverPic" name="coverPic" accept=".jpg, .png" onchange="changePreview(event);">';
                            echo '<img class="file-preview" id="file-preview" src="/upload/book/' . $book->coverPic .'">';
                        } else {
                            echo '<input class="form-control" type="file" id="coverPic" name="coverPic" accept=".jpg, .png" onchange="changePreview(event);" required="">';
                        } ?>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-link">
                        <?php isset($book) ? print("Update") : print("Add"); ?>
                    </button>
                </div>
            </form>
        </div>
    </section>
</article>
<script>
    document.getElementById('books').className += " active";
    autocomplete(document.getElementById("authorslist"), document.getElementById("authorslist"), "/authors/", null, "selected-author",true );
    autocomplete(document.getElementById("catlist"), document.getElementById("catlist"), "/categories/", null, "selected-category", true);
</script>