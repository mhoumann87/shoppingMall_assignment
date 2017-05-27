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

                    <h2 class="err">Do you want to delete this event?</h2>
                    <div class="row">
                        <div class="col-xs-3"></div>
                        <div class="col-xs-6">
                            <?php

                            $sql = "SELECT store_event FROM stores WHERE store_number = '{$_SESSION['id']}'";
                            $result = mysqli_query($conn, $sql);
                            $event = mysqli_fetch_assoc($result);
                            $message = '';

                            $updated_at = date('Y-m-d H:i:s');

                            if (isset($_POST['submit'])) {

                                    $sql = "UPDATE stores SET store_event = NULL, updated_at = '{$updated_at}' WHERE store_number = '{$_SESSION['id']}'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        redirect('store.php');
                                    } else {
                                        $message = 'something went wrong. Event not deleted';
                                    }
                                }

                            ?>

                            <h4>Active event</h4>
                            <p><?php echo $event['store_event']; ?></p>
                            <br>
                            <form name="delete_event" action="delete_event.php" method="post">
                                <button name="submit" class="btn btn-danger">Delete</button>
                                <a href="store.php" class="btn btn-primary">Cancel</a>
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