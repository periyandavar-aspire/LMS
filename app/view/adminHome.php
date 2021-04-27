<?php
defined('VALID_REQ') or exit('Invalid request');
?>
<article class="main">
    <section>
        <div class="container">
            <div class="row">
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/admin/profile" id="profile"><i class="fa fa-user-circle"
                            aria-hidden="true"></i><br>Profile</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/categories" id="categories"><i class="fa fa-list-alt"
                            aria-hidden="true"></i><br>Categories</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/authors" id="authors"><i class="fa fa-user-o" aria-hidden="true"></i><br>Authors</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/books" id="books"><i class="fa fa-book" aria-hidden="true"></i><br>Books</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/issueBook" id="issued"><i class="fa fa-table" aria-hidden="true"></i><br>Issued Books</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/userRequest" id="request"><i class="fa fa-list" aria-hidden="true"></i><br>User
                        Request</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/admin/manageUsers" id="request"><i class="fa fa-users"
                            aria-hidden="true"></i><br>Users</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/admin/settings" id="request"><i class="fa fa-cog" aria-hidden="true"></i><br>Settings</a>
                </div>
                <div class="cols col-1 div-card dashboard-icons">
                    <a href="/admin/cms" id="request"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><br>Manage
                        contents</a>
                </div>
            </div>
        </div>
    </section>
</article>
<script>
    document.getElementById('home').className += " active";
</script>