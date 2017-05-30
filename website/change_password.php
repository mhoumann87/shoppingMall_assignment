<?php require_once './includes/sessions.inc.php'; ?>
<?php require_once './includes/connection.inc.php'; ?>

<?php
    if (!isset($_SESSION['id'])) {
        redirect('./error401.php');
    }
?>


<?php include_once ('./includes/header.inc.php'); ?>

<main class="container">
    <div class="jumbotron">

        <h2>Change Your Password</h2>
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">
                <?php
                $errors = [];
                $new_user = '';
                $pass1_err = '';
                $pass2_err = '';
                $message = '';

                if (isset($_POST['submit'])) {

                    $user_id = $_SESSION['user_id'];

                    $password = trim($_POST['password']);
                    $password = filter_var($password, FILTER_SANITIZE_STRING);

                    $pass2 = trim($_POST['pass2']);
                    $pass2 = filter_var($pass2, FILTER_SANITIZE_STRING);

                    if ($password == '') {
                        $pass1_err = ' You must enter a new password';
                        $errors = 'No password';
                    }

                    if ($pass2 == '') {
                        $pass2_err = ' You have to repeat the password';
                        $errors = 'No repeat password';
                    }

                    if ($password != $pass2) {
                        $pass1_err = 'The passwords are not the same';
                        $pass2_err = 'The passwords are not the same';
                        $errors = 'Not the same password';
                    }

                    $sql = "SELECT password FROM users WHERE id = '{$user_id}'";
                    $r = mysqli_query($conn, $sql);
                    $pwd = mysqli_fetch_assoc($r);

                    if ($password == $pwd['password']) {
                        $pass1_err = ' You have to choose a new password';
                        $errors = 'Same password';
                    } else {

                    }$password = hashPassword($password);

                    $updated_at = date('Y-m-d H:i:s');

                    if (empty($errors)) {

                        $sql ="UPDATE users SET password = '{$password}', updated_at = '{$updated_at}' WHERE id = '{$user_id}'";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            $message = '<span class="success">Password is changed</span>';

                        } else {
                            $message = '<span class="err">Something went wrong, please try again</span>';
                        }
                    }




                }


                if (!empty($_GET)) {

                    if ($_GET['r'] == 1) {
                        $new_user = 'The first time you log in, you will have to change your password';
                    } else{
                        redirect('error404.php');
                    }
                }


                ?>

                <h4><?php echo $new_user; ?></h4>
                <form name="change_password" action="change_password.php" method="post">
                    <p><label>New password</label><span class="err"><?php echo $pass1_err; ?></span></p>
                    <p><input type="password" name="password" size="50" placeholder="New Password"></p>
                    <p><label>Repeat password</label><span class="err"><?php echo $pass2_err; ?></span></p>
                    <p><input type="password" name="pass2" size="50" placeholder="Repeat Password"></p>
                    <p><button class="btn btn-primary" name="submit">Change</button></p>
                </form>
                <p><?php echo $message; ?></p>
            </div>
            <div class="col-xs-3"></div>
        </div>

    </div>
</main>



<?php include_once ('./includes/footer.inc.php'); ?>
