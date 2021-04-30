<style>
    body {
        background: #1287cc;
        background: -webkit-linear-gradient(to right, #1CB5E0, #1287cc);
        background: linear-gradient(to right, #1CB5E0, #1287cc);
    }
    
    .wrapper {
        position: relative;
        background: #0a2534;
        border-radius: 5px;
        padding-left: 30px;
        padding-right: 30px;
        -webkit-box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
        -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
        box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
        margin: auto;
        padding-top: 23px;
        top: 20px;
        padding-bottom: 17px;
        width: 50%;
        color: white;
        font-family: sans-serif;
    }
    
    .wrapper span {
        margin-bottom: 3px;
        color: rgba(255, 255, 255, .5);
        text-align: center;
        margin: 0;
        font-size: 14px;
        padding-bottom: 17px;
        padding-top: 24px;
    }
    
    .nav-link {
        display: inline-block;
        padding: 13px 23px;
        border: 2px solid dodgerblue;
        border-radius: 8.5px;
        background-color: dodgerblue;
        color: #fff;
        font: 700 12px sans-serif;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .nav-link:hover {
        color: dodgerblue;
        background-color: transparent;
    }
    
    .container {
        display: block;
        margin: auto;
        text-align: center;
    }
</style>

<body>

    <article>

        <section>
            <div class="wrapper">
                <h3>Recover LMS Account</h3>
                <div class="container">
                    <p> Hi <?php echo $user; ?>, use the below link to recover your LMS account, this link will be valid only for 10 minutes</p>
                    <a class="nav-link" href="">Recover</a><br><br>
                    <span></span>
                </div>
            </div>
        </section>
    </article>
</body>

</html>