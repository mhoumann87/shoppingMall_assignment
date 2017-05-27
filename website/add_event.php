<?php require_once './includes/sessions.inc.php'; ?>
<?php require_once './includes/connection.inc.php'; ?>

<?php
    if (!isset($_SESSION['id'])) {
    redirect('./error401.php');
    } else if ($_SESSION['id'] == 'Admin') {
    redirect('./error401.php');
    }

?>

<?php include_once ('./includes/header.inc.php'); ?>

    <main class="container">
        <div class="jumbotron">
            <main class="container">
                <div class="jumbotron">

                    <h2>Add event</h2>
                    <div class="row">
                        <div class="col-xs-3"></div>
                        <div class="col-xs-6">

                            <?php

                            $errors = [];
                            $store_event = '';
                            $event_err = '';
                            $message = '';

                            $updated_at = date('Y-m-d H:i:s');

                            if (isset($_POST['submit'])) {

                                $store_event = trim($_POST['store_event']);
                                $store_event = filter_var($store_event, FILTER_SANITIZE_STRING);

                                if ($store_event == ´´) {
                                    $event_err = 'You need to add an event of click cancel';
                                    $errors = 'No input';
                                }

                                if (empty($errors)) {
                                    $sql = "UPDATE stores SET store_event = '{$store_event}', updated_at = '{$updated_at}' WHERE store_number = '{$_SESSION['id']}'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        redirect('store.php');
                                    } else {
                                        $message = 'something went wrong. Event not added';
                                    }

                                }
                            }
                            ?>

                            <form name="add_event" action="add_event.php" method="post">
                                <p><label>Add event</label><span class="err"><?php echo $event_err; ?></span> </p>
                                <textarea name="store_event" cols="51" rows="10" placeholder="Event"><?php echo $store_event; ?></textarea>
                                <br>
                                <button name="submit" class="btn btn-primary">Add event</button>
                                <a href="store.php" class="btn btn-danger" role="button">Cancel</a>
                            </form>
                            <p><span class="err"><?php echo $message; ?></span> </p>
                        </div>
                        <div class="col-xs-3"></div>
                    </div>

                </div>
            </main>


        </div>
    </main>



<?php include_once ('./includes/footer.inc.php'); ?>