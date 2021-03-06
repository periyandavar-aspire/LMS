<!DOCTYPE html>
<html lang="en">
    <head>
	    <title>Library</title>
	    <meta charset="utf-8">
	    <meta name="author" content="periyandavar">
	    <meta name="discription" content="library Mangement system">
	    <meta name="keywords" content="Library, LMS">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
 	    <link rel="icon" type="image/png" href="img/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/core.css">
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/user.css">
        <link rel="stylesheet" type="text/css" href="<?php echo baseURL()?>/static/css/font-awesome-4.7.0/css/font-awesome.min.css">
    </head>
    <body> 
    	<header>
            <img src="<?php echo baseURL()?>/static/img/lms-logo.png">
		    <a href="javascript:dropDownMenuClick('user-drop-down');" class="shortMenu">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
            <div class="drop-down" id="user-drop-down">
                <ul>
                    <li onclick="openModal('sign-up-modal');dropDownMenuClick('user-drop-down');">Profile</li>
                    <li onclick="openModal('log-in-modal');dropDownMenuClick('user-drop-down');">Logout</li>
                </ul>
            </div>
            <a href="javascript:dropDownMenuClick('nav-drop-down');" class="mobNav" >
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <div class="drop-down" id="nav-drop-down">
                <ul>
                    <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a></li>
                    <li><a href="#"><i class="fa fa-book" aria-hidden="true"></i> Issued Books</a></li>
                    <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                </ul>
            </div>
            <a style="margin-right: 0;" id="searchButton" href="javascript:dropDownMenuClick('searchBar');">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
            <div class="searchBar" id="searchBar">
                <input type="text"  name="search" placeholder="Search...">
                <button>
                    <i class="fa fa-search" aria-hidden="true"></i>
                 </button>
            </div>    
	    </header>
        <nav>
            <ul>
                <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                <li><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-book" aria-hidden="true"></i> Issued Books</a></li>
                <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </nav>
        <article class="main">
		    <section class="card">
                <hr>
                <h1>Mission</h1> 
                <hr>
                <p> The University Libraries strengthen and enhance the teaching, research and service 
                    of the University at Albany. The Libraries promote intellectual growth and creativity 
                    by developing collections, facilitating access to information resources, 
                    teaching the effective use of information resources and critical evaluation skills and 
                    offering research assistance. </p>
                <hr>
                <h1>Vision</h1>
                <hr>
                <p>The University Libraries are engaged in learning and discovery as essential participants 
                    in the educational community. We develop, organize, provide access to and preserve 
                    materials to meet the needs of present and future generations of students and scholars. 
                    We explore and implement innovative technologies and services to deliver information and 
                    scholarly resources conveniently to users anytime/anyplace. We also provide well-equipped 
                    and functional physical spaces where students can pursue independent learning and discovery 
                    outside the classroom. The University Libraries support scholarship and research productivity 
                    and foster their vitality.</p>
                <hr>
		    </section>
            <section>
                <div class="div-card">
                    <div class="div-card-header">
                        Table
                    </div>
                    <div class="div-card-body"  style="overflow-x:auto;">
                        <div>
                            <div class="left-panel">
                                Record count
                                <select class="form-control left-panel-select">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                </select>
                            </div>
                            <div class="right-panel">
                                Search <input type="text" class="form-control left-panel-input">
                            </div>
                        </div>
                        <table class="tab_design">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Book Name</th>
                                    <th>ISBN </th>
                                    <th>Issued Date</th>
                                    <th>Return Date</th>
                                    <th>Fine in(USD)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PHP And MySql programming</td>
                                    <td>222333</td>
                                    <td>2017-07-15 16:29:26</td>
                                    <td><span style="color:red">Not Return Yet</span></td>
                                    <td></td>
                                </tr> 
                                <tr>
                                    <td>1</td>
                                    <td>PHP And MySql programming</td>
                                    <td>222333</td>
                                    <td>2017-07-15 16:29:26</td>
                                    <td><span style="color:red">Not Return Yet</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>PHP And MySql programming</td>
                                    <td>222333</td>
                                    <td>2017-07-15 16:29:26</td>
                                    <td><span style="color:red">Not Return Yet</span></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel">
                            <div class="left-panel">
                                Showing 1 to 2 of 2 entries
                            </div>
                            <div class="right-panel">
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
            <section class="card">
                <h1>User Profile</h1>
                <hr>
                <form action="#" onsubmit="event.preventDefault(); registrationFormValidator(event);" method="POST">
                    <div class="form-input-div">
                        <label>Enter Full Name</label>
                        <input class="form-control" type="text" pattern="^[a-zA-Z ]+$" id="fullname" name="fullanme" autocomplete="off" placeholder="Full Name..." required="">
                    </div>
                    <div class="form-input-div">
                        <label>Select Your Gender</label>
                        <select class="form-control select-input" name="gender" id="gender" placeholder="Full Name..." required="">
                            <option value="" style="display: none;">Select Gender</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                    <div class="form-input-div">
                        <label>Enter Mobile Number </label>
                        <input class="form-control" pattern="^[789]\d{9}$" type="text" id="mobile" name="mobileno" maxlength="10" placeholder="Mobile Number..." autocomplete="off" required="">
                    </div>                                                    
                    <div class="form-input-div">
                        <label>Enter Email</label>
                        <input class="form-control" type="email" name="email" id="emailid" placeholder="Email..." autocomplete="off" required="">  <!--onblur="checkAvailability()"-->
                        <span id="user-availability-status" style="font-size:12px;"></span> 
                    </div>                    
                    <div class="form-input-div">
                        <label>Enter Password</label>
                        <input class="form-control" onkeyup="passStrength()" type="password" id="pass1" name="password" placeholder="********" autocomplete="off" required="">
                        <meter id="pass1str" min="0" low="40" high="95" max="100" optimum="50" style="display:none" value="0"></meter>
		                <span id="pass1msg" style="display:none"></span>
                    </div>    
                    <div class="form-input-div">
                        <label>Confirm Password </label>
                        <input class="form-control"  onkeyup="confirmPassword()" type="password" id="pass2" name="confirmpassword" placeholder="********" autocomplete="off" required="">
                        <span id="pass2msg" style="color:red"></span>
                    </div>                                   
                    <div class="form-buttons">
                        <button type="submit" class="button-control positive">Signup</button>
                        <button type="button" onclick="closeModal('sign-up-modal');" class="button-control negative">Cancel</button>
                    </div>
                </form>
            </section>
            <section class="card">
                <h1>Buttons</h1>
                General
                <button type="button" class="button-control">Button</button>
                Positive
                <button type="button" class="button-control positive">OK</button>
                Negative
                <button type="button" class="button-control negative">Cancel</button>
                View
                <button type="button" class="button-control icon-btn" title="view"><i class="fa fa-eye"></i></button>
                Edit
                <button type="button" class="button-control icon-btn positive" title="edit"><i class="fa fa-edit"></i></button>
                Delete
                <button type="button" class="button-control icon-btn negative" title="delete"><i class="fa fa-trash"></i></button>
                <h1>Check box</h1>
                <div class="checkbox"><input type="checkbox"><label>one</label></div>
                <input type="checkbox"><label>two</label>
                <input type="checkbox"><label>three</label>
            </section>
        </article>
        <footer>
    		LMS &#169; 2021
    	</footer>
        <script src="<?php echo baseURL()?>/static/js/core.js"></script>
        <script src="<?php echo baseURL()?>/static/js/form.js"></script>
    </body>
</html>