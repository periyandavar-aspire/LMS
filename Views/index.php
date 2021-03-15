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
    <body> 
        <!-- Navigation -->
        <nav id="fixed-top" class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Aria</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="index.html"><img src="<?php echo baseURL()?>/static/img/lms-logo.jpg"></a>
       

        <div class="expand-navbar" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#header">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#intro">INTRO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">SERVICES</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">CONTACT</a>
                </li>
            </ul>
            <span class="nav-icons">
                <span>
                    <a class="nav-link" href="#">
                        <span class="hexagon"></span>
                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                <a href="javascript:dropDownMenuClick('user-drop-down');"><i class="fa fa-user" aria-hidden="true"></i>
            </a>
            <div class="drop-down" id="user-drop-down">
                <ul>
                    <li> <a href="<?php echo baseURL()?>/home/registration">Sign up</a></li>
                    <li> <a href="<?php echo baseURL()?>/home/login">Login</a></li>
                </ul>
            </div>
                </span>
            </span>
        </div>
    </nav>
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="text-container">
                            <h1>MORE..!<span><span class="morph">READ </span><span class="morph">LEARN </span></h1>
                            <p class="p-heading p-large">The University Libraries strengthen and enhance the teaching, research and service of the University at Albany. The Libraries promote intellectual growth and creativity by developing collections, facilitating access to information resources, teaching the effective use of information resources and critical evaluation skills and offering research assistance.</p>
                        </div>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
	    
    
        <!-- article -->
	    <article class="main">
    		<section class="section-card">
                <hr>
                <h1>Mission</h1> 
                <hr>
                    <p>The University Libraries strengthen and enhance the teaching, research and 
                       service of the University at Albany. The Libraries promote intellectual growth and 
                       creativity by developing collections, facilitating access to information resources, 
                       teaching the effective use of information resources and critical evaluation skills and 
                       offering research assistance.</p>
                <hr>
                <h1>Vision</h1>
                <hr>
                    <p>The University Libraries are engaged in learning and discovery as essential participants 
                        in the educational community. We develop, organize, provide access to and preserve materials 
                        to meet the needs of present and future generations of students and scholars. We explore and 
                        implement innovative technologies and services to deliver information and scholarly resources 
                        conveniently to users anytime/anyplace. We also provide well-equipped and functional physical 
                        spaces where students can pursue independent learning and discovery outside the classroom. 
                        The University Libraries support scholarship and research productivity and 
                        foster their vitality.</p>
                <hr>
		    </section>
            <aside>
                <div class="side-bar-right">
                    <h1>About Us</h1>
                    <hr>
                    <p>The University Libraries are engaged in learning and discovery as essential participants 
                       in the educational community. We develop, organize, provide access to and preserve materials 
                       to meet the needs of present and future generations of students and scholars.</p>
                </div>
                <div class="side-bar-right">
                    <h1>Contact Us</h1>
                    <hr>
                    <h2 class="title">Address</h2><address>
                    National Highway, Brgy. <br>
                    2 Poblacion E.B.<br>
                    Magalona., Negros<br>
                    Occidental</address>
                    <h2 class="title">Tel. nos.:</h2>
                    (034) 433-2281 / 435-0535
                    </p>
                </div>
            </aside>
        </article>
        <br><br>
        
	    <!-- footer -->
	    <footer>
    		LMS &#169; 2021
    	</footer>
        <script src="<?php echo baseURL()?>/static/js/core.js"></script>
        <script src="<?php echo baseURL()?>/static/js/form.js"></script>
        <!-- <script>slideshow();</script> -->
    </body>  
    <script>
        window.onscroll = function (event) {
            if (window.pageYOffset > 20) {
                addClass(document.getElementById("fixed-top"), "nav-bar-active");
		} else {
            removeClass(document.getElementById("fixed-top"), "nav-bar-active");
		}
        }
        function hasClass(elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
        elem.className += ' ' + className;
    }
}
function removeClass(elem, className) {
    if (hasClass(elem, className)) {
        elem.className = elem.className.replace(" "+className," ");
    }
}

    </script>  
</html>