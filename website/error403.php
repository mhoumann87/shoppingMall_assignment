<?php require_once './includes/sessions.inc.php'; ?>
<?php require_once './includes/connection.inc.php'; ?>


<?php include_once ('./includes/header.inc.php'); ?>

    <main class="container">
        <div class="jumbotron">

            <h2>Access Denied</h2>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6 err_page">
                    <img src="assets/images/no_access.png" class="err_photo" alt="Can't find the page you looked for">
                    <h2>You have no rights to see the page you looked for!</h2>
                    <p><a href="index.php">Return to the front page</a></p>

                </div>
                <div class="col-xs-3"></div>
            </div>

        </div>
    </main>



<?php include_once ('./includes/footer.inc.php'); ?>