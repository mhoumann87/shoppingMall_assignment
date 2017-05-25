<?php require_once './includes/sessions.inc.php'; ?>
<?php require_once './includes/connection.inc.php'; ?>
<?php

?>

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
                $email = '';
                $mail_err = '';

                $storenumber = '';
                $num_err = '';



                $name = '';
                $name_err = '';


                if (isset($_POST['submit'])) {

                    //Name
                    $name = trim($_POST['name']);
                    $name = filter_var($name, FILTER_SANITIZE_STRING);

                    if ($name == '') {
                        $name_err = ' You must enter a name';
                        $errors = 'No Username';
                                            }

                    //email
                    $email = trim($_POST['email']);
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);


                    if ($email == '') {
                        $mail_err = ' You must add an email';
                        $errors = 'No email';
                    } else {

                        $sql = "SELECT * FROM users WHERE email = '{$email}'";
                        $mail = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($mail) > 0) {
                            $mail_err = ' Mail is all ready in the database';
                            $errors = 'Mail exists';
                        }
                    }

                    //Hardcoded password, user will be forced to change first time they login
                    $password = '1234';

                    $function = $_POST['function'];

                    $storenumber = trim($_POST['storenumber']);
                    $storenumber = filter_var($storenumber, FILTER_SANITIZE_NUMBER_INT);


                     if ($function == 'Store' && $storenumber == '') {
                        $num_err = ' You are adding a store, and  you need to give a store number';
                        $errors = 'No Store number';
                     }

                     if ($function == 'Admin') {
                         $storenumber = 'NULL';
                     }


                    //Date stamps
                    $created_at = date('Y-m-d H:i:s');
                    $updated_at = date('Y-m-d H:i:s');


                    if (empty($errors)) {


                        $sql = "INSERT INTO users (name, email, password, function, storenumber, created_at, updated_at) VALUES ('{$name}', '{$email}', '{$password}', '{$function}', {$storenumber}, '{$created_at}', '{$updated_at}')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            $message = '<span class="success">User created</span>';
                            $name = '';
                            $email = '';
                            $storenumber = '';
                        } else {
                            $message = '<span class="err">Something went wrong, please try again</span>';
                        }






                    }//empty errors

                }//submit


                ?>


                <form name="create_user" action="create_user.php" method="post">
                    <p><label>Name</label><span class="err"><?php echo $name_err; ?></span></p>
                    <p><input type="text" name="name" size="50" placeholder="Name" value="<?php echo ($name != '') ? $name:'';  ?>"></p>
                    <p><label>Email</label><span class="err"><?php echo $mail_err; ?></span> </p>
                    <p><input type="email" name="email" size="50" placeholder="Email" value="<?php echo ($email != '') ? $email:'';  ?>"></p>
                    <p><label>Select function</label></p>
                    <p><select title="function" name="function">
                        <option value="Store" selected>Store</option>
                        <option value="Admin">Admin</option>
                        </select></p>
                    <p><label>Store number if this is a store</label><span class="err"><?php echo $num_err; ?></span></p>
                    <p><input type="number" name="storenumber" placeholder="Store Number" value="<?php echo ($storenumber != '') ? $storenumber:'';  ?>"></p>
                    <p><button class="btn btn-primary" name="submit">Create</button></p>
                </form>
                <p><?php echo $message; ?></p>
            </div>
            <div class="col-xs-3"></div>
        </div>

    </div>
</main>



<?php include_once ('./includes/footer.inc.php'); ?>
