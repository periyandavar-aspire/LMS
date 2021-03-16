<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Library</title>
	    <meta charset="utf-8">
	    <meta name="author" content="periyandavar">
        <meta name="discription" content="library Mangement system">
	    <meta name="keywords" content="Library, LMS">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
 	    <link rel="icon" type="image/png" href="<?php echo baseURL()?>/static/img/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/form.css">
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/core.css"> -->
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/cores.css">
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/icons.css">
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/font-awesome-4.7.0/css/font-awesome.min.css">
    </head>
    <body id="body"> 

        <!-- href to move top of the page-->
        <a href="#body" id="back-to-top"></a>

        <!-- Navigation Menu-->
        <nav id="fixed-top" class="navbar fixed-top">
        
            <!-- Image Logo -->
            <a class="navbar-logo" href="home"><img src="<?php echo baseURL()?>/static/img/favicon.png">&nbsp;LMS</a>

            <button class="navbar-toggler" type="button" onclick="menucontrol();">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
        
            <div class="expand-navbar" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="home">HOME </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="books">BOOKS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home/login">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home/registration">REGISTER</a>
                    </li>
                </ul>
                
            </div>
        </nav>
        <!-- Navigation ends -->
        <!-- header starts -->
        <header>
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="cols">
                            <div class="text-container">
                                <h1>A PLACE TO <span class="morph"> </span></h1>
                                <p class="heading-para">We store the energy that fuels the imagination. we open up windows to the world and inspire you to explore and achieve, and contribute to improving your quality of life.</p>
                                <a class="btn-link" href="home/registration">JOIN NOW</a>
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
                                <h1>Our vision & Mission</h1>
                                <p class="text-para">The University Libraries are engaged in learning and discovery as essential participants 
                                in the educational community. We develop, organize, provide access to and preserve materials 
                                to meet the needs of present and future generations of students and scholars. We explore and 
                                implement innovative technologies and services to deliver information and scholarly resources 
                                conveniently to users anytime/anyplace. We also provide well-equipped and functional physical 
                                spaces where students can pursue independent learning and discovery outside the classroom. 
                                The University Libraries support scholarship and research productivity and 
                                foster their vitality.</p>
                                <p class="text-para italics-text">"Our vission is to strengthen and enhance the learning and to promote the intellectual growth and 
                                creativity by developing collections, facilitating access to information resources, 
                                teaching the effective use of information resources and critical evaluation skills and 
                                offering research assistance."</p>
                                <div class="text-author">Admin</div>
                            </div> 
                        </div> 
                        <div class="cols col-5">
                            <div class="image-container">
                                <img src="<?php echo baseURL()?>/static/img/cover/3.jpg">
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
                        <div class="card cols">
                            <div class="card-image img-container">
                                <!-- <div class="img-container"> -->
                                    <img src="<?php echo baseURL()?>/uploads/books/1.jpg" alt="alternative">
                                    <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="card-content">
                                <h3>The Atlantis Gene</h3>
                                <div class="text-author">A.G. Riddle</div>
                                <p>The new mystrious story</p>
                                <p>only 3 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/2.jpg" alt="alternative">
                                <div class="overlay">
                                    <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Gravity of Us</h3>
                                <div class="text-author">Phil Stamper</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <!-- end of card -->

                        <!-- Card -->
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/3.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Histories 4 Ans</h3>
                                <div class="text-author">Fleurus</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/4.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Atlantis Gene</h3>
                                <div class="text-author">A.G. Riddle</div>
                                <p>The new mystrious story</p>
                                <p>only 3 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>    
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/5.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Gravity of Us</h3>
                                <div class="text-author">Phil Stamper</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/6.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Histories 4 Ans</h3>
                                <div class="text-author">Fleurus</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/1.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Atlantis Gene</h3>
                                <div class="text-author">A.G. Riddle</div>
                                <p>The new mystrious story</p>
                                <p>only 3 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/2.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Gravity of Us</h3>
                                <div class="text-author">Phil Stamper</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/3.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Histories 4 Ans</h3>
                                <div class="text-author">Fleurus</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/4.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Atlantis Gene</h3>
                                <div class="text-author">A.G. Riddle</div>
                                <p>The new mystrious story</p>
                                <p>only 3 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/5.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Gravity of Us</h3>
                                <div class="text-author">Phil Stamper</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="card cols">
                            <div class="card-image img-container">
                                <img src="<?php echo baseURL()?>/uploads/books/6.jpg" alt="alternative">
                                <div class="overlay">
                                        <div class="details">"Book Name" <br><br> by Author</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3>The Histories 4 Ans</h3>
                                <div class="text-author">Fleurus</div>
                                <p>The new mystrious story</p>
                                <p>only 2 books available</p>
                                <div class="btn-container">
                                    <a class="btn-link" href="#">LEND NOW</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- Books row end -->
                    <!-- show more button -->
                    <div class="btn-container">
                        <a class="btn-link" href="books">SHOW MORE</a>
                    </div>
                </div> 
            </section>
        </article>
        <!-- Article ends -->
        <!-- footer starts -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="cols col-3">
                        <div class="text-container">
                            <h4>About us</h4>
                            <p class="indent-para">Libraries are engaged in learning and discovery as essential participants 
                            in the educational community. We develop, organize, provide access to and preserve materials 
                            to meet the needs of present and future generations of students and scholars.</p>
                        </div>
                    </div>
                    <div class="cols col-3">
                        <div class="text-container">
                            <h4>Contact us</h4>
                            <p><i class="fa fa-map-marker symbols" aria-hidden="true"></i>&nbsp;&nbsp;National Highway, Brgy. 2 Poblacion E.B. Magalona., Negros Occidental<br>
                                <i class="fa fa-phone symbols" aria-hidden="true"></i>&nbsp;&nbsp;(034) 433-2281 / 435-0535<br>
                                <i class="fa fa-envelope-o symbols" aria-hidden="true"></i>&nbsp;&nbsp;jan@lms.com<br>
                            </p>
                        </div>
                    </div> 
                    <div class="cols col-1">
                        <div class="text-container">
                            <h4>Follow us</h4>
                            <ul class="unstyle-list">
                                <li>
                                    <a><i class="fa fa-facebook-square symbols" aria-hidden="true"></i>&nbsp;&nbsp;Facebook</a>
                                </li>
                                <li>
                                <a><i class="fa fa-instagram symbols" aria-hidden="true"></i>&nbsp;&nbsp;Instagram</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-youtube-play symbols" aria-hidden="true"></i>&nbsp;&nbsp;Youtube</a>
                                </li>
                            </ul>
                        </div> 
                    </div>
                </div> 
            </div> 
            <div class="container align-container-center">
                <div class="row">
                    <div class="cols col-9">
                        <p>Copyright © 2020 LMS</p>
                    </div> 
                </div> 
            </div> 
        </footer>
        <!-- end of footer -->
        <!-- loading scripts -->
        <script src="<?php echo baseURL()?>/static/js/core.js"></script>
        <!-- <script src="<?php //echo baseURL()?>/static/js/form.js"></script> -->
    </body>  
</html>