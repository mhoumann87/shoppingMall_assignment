<?php include_once ('./includes/header.inc.php'); ?>

<main class="container">
    <div class="jumbotron">

        <h2>Log in</h2>
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">
                <form name="login" action="index.php" method="post">
                    <p><label>Username</label></p>
                    <p><input type="text" name="username" size="50" placeholder="Username"</p>
                    <p><label>Password</label></p>
                    <p><input type="password" name="password" size="50" placeholder="Password" </p>
                    <p><button class="btn btn-primary" name="submit">Log In</button></p>
                </form>
            </div>
            <div class="col-xs-3"></div>
        </div>

    </div>
</main>



<?php include_once ('./includes/footer.inc.php'); ?>