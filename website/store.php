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

<?php
    $sql = "SELECT * FROM stores WHERE store_number = '{$_SESSION['id']}'";
    $result = mysqli_query($conn, $sql);



    if (mysqli_num_rows($result) == 1) {

        $info = mysqli_fetch_assoc($result);



        $store_logo = $info['store_logo'];
        $store_open_week = $info['store_open_week'];
        $store_open_sat = $info['store_open_sat'];
        $store_open_sun = $info['store_open_sun'];
        $store_description = $info['store_description'];
        $store_phoneno = $info['store_phoneno'];
        $store_website = $info['store_website'];

        if ($info['store_event'] == NULL) {
            $store_event =  'No active events at the moment';
        } else {
            $store_event = $info['store_event'];
        }




    } else {
        redirect('update_store.php?n=1');
    }
?>

<main class="container">
    <div class="row">
        <div class="col-xs-5 border red">
            <div class="row">
                <div class="col-xs-8">
                    <img src="<?php echo $store_logo; ?>" class="storeLogo">
                </div>
                <div class="col-xs-4">
                    <a href="change_logo.php" class="btn btn-primary" role="button">Change logo</a>
                </div>
            </div>
            <div class="space"></div>
            <div class="row">
                <div class="col-xs-6">
                    <p>Opening hours</p>
                </div>
                <div class="col-xs-3">
                    <p>Weekdays</p>
                </div>
                <div class="col-xs-3">
                    <p><?php echo $store_open_week; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-3"></div>
                <div class="col-xs-3">
                    <p>Saturday</p>
                </div>
                <div class="col-xs-3">
                    <p><?php echo $store_open_sat; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-3"></div>
                <div class="col-xs-3">
                    <p>Sunday</p>
                </div>
                <div class="col-xs-3">
                    <p><?php echo $store_open_sun; ?></p>
                </div>
            </div>
            <div class="space"></div>
            <div class="row">
                <div class="col-xs-12">
                    <p><?php echo $store_description ;?></p>
                    <p>Website: <a href="http://www.hm.com/us/" target="_blank">http://www.hm.com/us/</a></p>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h4>Contact us</h4>
                    <p>Phone: <?php echo $store_phoneno;?></p>
                    <p><a href="<?php echo $store_website; ?>" target="_blank">Visit our website</a></p>

                </div>
            </div>
            <div class="space"></div>
            <a href="update_store.php" class="btn btn-primary" role="button">Change Info</a>
        </div>

            <div class="col-xs-2 blue"></div>
                <div class="col-xs-5 border red">
                    <h3>Active Offers:</h3>


                    <?php

                    $sql = "SELECT offer_id, offer_photo, offer_title FROM offer WHERE store_number = '{$_SESSION['id']}'";
                    $offer_array = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($offer_array) > 0) {

                        while ($offer = mysqli_fetch_assoc($offer_array)) {

                            echo '
                                <div class="row padding">
                                    <div class="col-xs-4">
                                        <p>'.$offer['offer_title'].'</p>
                                    </div>
                                    <div class="col-xs-4">
                                        <img src="'.$offer['offer_photo'].'" class="offerPhoto">
                                    </div>
                                    <div class="col-xs-4">
                                         <a href="delete_offer.php?id='.$offer['offer_id'].'" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                                  
                            ';

                        }


                    } else {
                        echo 'There are no active offers';
                    }


                    ?>


            <div class="space"></div>
            <div class="row">
                <div class="col-xs-12">
                    <a href="offer.php" class="btn btn-primary" role="button">Add Offer</a>
                </div>
            </div>
            <div class="space"></div>
            <h3>Active Events</h3>
            <div class="row">
                <div class="col-xs-12">
                    <p><?php echo $store_event; ?></p>
                </div>
            </div>
            <div class="space"></div>
            <div class="row">
                <div class="col-xs-12">
                    <a href="add_event.php" class="btn btn-primary" role="button">Add Event</a>
                    <a href="delete_event.php" class="btn btn-danger" role="button">Delete Event</a>
                </div>
            </div>
        </div>

    </div>
</main>


<?php include_once ('./includes/footer.inc.php'); ?>
