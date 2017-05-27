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

                    <h2 class="err">Do you want to delete this offer?</h2>
                    <div class="row">
                        <div class="col-xs-3"></div>
                        <div class="col-xs-6">

                            <?php
                            $message = '';

                            $sql = "SELECT * FROM offer WHERE offer_id = '{$_GET['id']}' AND store_number = '{$_SESSION['id']}'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $offer = mysqli_fetch_assoc($result);

                                echo '
                                    <div class="row padding">
                                        <div class="col-xs-6">
                                           <img src="'.$offer['offer_photo'].'" class="showPhoto">
                                        </div>
                                        <div class="col-xs-6">
                                        <h3>'.$offer['offer_title'].'</h3>
                                        <p>'.$offer['offer_description'].'</p>
                                        <p>Normal price '.$offer['offer_normalprice'].'</p>
                                        <p>Offer price <span class="err">'.$offer['offer_price'].'</span></p>
                                        </div>
                                    </div>
                                ';

                            } else {
                                echo 'Can not find the offer';
                            }//num_rows

                            if (isset($_POST['submit'])) {

                                $sql = "DELETE FROM offer WHERE offer_id = '{$_GET['id']}' AND store_number = '{$_SESSION['id']}' LIMIT 1";
                                $r = mysqli_query($conn, $sql);

                                if ($r) {
                                    redirect('store.php');
                                } else {
                                    $message = 'Something went wrong. Offer not deleted';
                                }

                            }

                            ?>
                            <br>
                            <form name="delete_offer" action="delete_offer.php?id=<?php echo $_GET['id']; ?>" method="post">
                                <button name="submit" class="btn btn-danger">Delete</button>
                                <a href="store.php" class="btn btn-primary" role="button">Cancel</a>
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