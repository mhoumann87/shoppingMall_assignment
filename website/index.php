<?php require_once './includes/sessions.inc.php'; ?>
<?php require_once './includes/connection.inc.php'; ?>


<?php include_once ('./includes/header.inc.php'); ?>

<main class="container">
    <div class="jumbotron">

        <h2>Log in</h2>
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">
                <?php

                $errors = [];
                $message = '';

                $username = '';
                $name_err = '';
                $password = '';
                $pass_err = '';

                if (isset($_POST['submit'])) {

                    $username = trim($_POST['username']);
                    $username = filter_var($username, FILTER_SANITIZE_STRING);

                    if ($username == '') {
                        $name_err = ' You must enter a username';
                        $errors = 'No Username';
                    }

                    $password = trim($_POST['password']);
                    $password = filter_var($password, FILTER_SANITIZE_STRING);

                    if ($password == '') {
                        $pass_err = ' You must enter a password';
                        $errors = 'No Password';
                    }

echo date();
                    if (empty($errors)) {

                        $sql = "SELECT * FROM users WHERE name='{$username}' AND password = '{$password}'";
                        $result = mysqli_query($conn, $sql);

                        echo mysqli_num_rows($result);

                       if (mysqli_num_rows($result) == 1) {
                            $store = mysqli_fetch_assoc($result);

                            $_SESSIONS['storenumber'] = $store['storenumber'];
                            redirect('store.php');

                        } else {
                            $message = 'Username and password do not match';
                        }

                    }

                }//submit


                ?>


                <form name="login" action="index.php" method="post">
                    <p><label>Username</label><span class="err"><?php echo $name_err; ?></span></p>
                    <p><input type="text" name="username" size="50" placeholder="<?php echo ($username != '') ? $username:'Username';  ?>"</p>
                    <p><label>Password</label><span class="err"><?php echo $pass_err; ?></span> </p>
                    <p><input type="password" name="password" size="50" placeholder="Password" </p>
                    <p><button class="btn btn-primary" name="submit">Log In</button></p>
                </form>
                <p class="err"><?php echo $message; ?></p>
            </div>
            <div class="col-xs-3"></div>
        </div>

    </div>
</main>



<?php include_once ('./includes/footer.inc.php'); ?>