<!-- header starts -->
<header>
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="cols">
                    <div class="text-container">
                        <h1>A PLACE TO <span class="morph"> </span></h1>
                        <p class="heading-para">We store the energy that fuels the imagination. we open up windows to the world and inspire you to explore and achieve, and contribute to improving your quality of life.</p>
                        <a class="btn-link" href="/register">JOIN NOW</a>
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
</header> 
<!-- header ends -->
<!-- main content article start -->
<article>
    <!-- section 1 -->
    <section>
        <div class="container">
            <div class="row">
                <div class="cols col-3">
                    <div class="text-container">
                        <h1>Our Mission & Vision</h1>
                        <p class="text-para"><?php echo $mission; ?></p>
                        <p class="text-para italics-text"><?php echo $vision; ?></p>
                        <div class="text-author">Admin</div>
                    </div> 
                </div> 
                <div class="cols col-5">
                    <div class="image-container">
                        <img src="<?php echo Utility::baseURL()?>/static/img/cover/3.jpg">
                    </div>
                </div> 
            </div> 
        </div> 
    </section> 
    <!-- section 2 -->
    <section>
        <div class="container">
            <div class="row">
                <div class="cols col-9 container-heading">
                    <h1>Find the Books of your Taste<br>among the thounsand's collection </h1>
                </div> 
            </div>
            <!-- Book row -->
            <div class="row">
            <?php if (isset($books)):?>
                <?php foreach ($books as $book): ?>
                    <div class="card cols">
                        <!-- <div class="card-image img-container">
                                <img src="/upload/books/" alt="alternative">
                                <div class="overlay">
                                    <div class="details">"" <br><br> by </div>
                                </div>
                        </div> -->
                        <book-element cover="<?php echo Utility::baseURL()?>/upload/books/<?php echo $book->coverPic;?>" book="<?php echo $book->name; ?>" author="<?php echo $book->author;?>" id="<?php echo $book->id;?>">
                        </book-element>
                        <div class="card-content">
                            <h3><?php echo $book->name?></h3>
                            <div class="text-author"><?php echo $book->author;?></div>
                            <p><?php echo $book->description;?></p>
                            <p>only <?php echo $book->available;?> books available</p>
                            <div class="btn-container">
                                <a class="btn-link" href="/home/books/lend/<?php echo $book->id;?>">LEND NOW</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div> 
    </section>
</article>
<!-- Article ends -->
<script>
    document.getElementById("menu-home").className += " active";
</script>