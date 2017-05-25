    <?php require_once ('./includes/connection.inc.php'); ?>
    <?php include_once ('./includes/header.inc.php'); ?>

<main class="container">
    <div class="jumbotron">
        <h2>Add Offer</h2>
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">

                <?php

                $store_number = 2; //TODO Have to change this for a varaible based on logged in store !!!!!!!

                $error = [];
                $offer_title = '';
                $title_err = '';
                $offer_normalprice = '';
                $normal_err = '';
                $offer_price = '';
                $offer_err = '';
                $offer_description = '';
                $desc_err = '';
                $max_filesize = 512000;
                $img_err ='';
                $message = '';

                if (isset($_POST['submit'])) {

                   $offer_title = trim($_POST['title']);
                   $offer_title = filter_var($offer_title, FILTER_SANITIZE_STRING);

                   if ($offer_title == '') {
                       $title_err = ' You must add a title';
                       $error = 'No title';
                   }

                   $offer_normalprice = trim($_POST['regPrice']);
                   $offer_normalprice = filter_var($offer_normalprice, FILTER_SANITIZE_STRING);

                   if (!preg_match('/^[0-9]*\.[0-9]{2}$/', $offer_normalprice) || $offer_normalprice == '') {
                        $normal_err = ' You must add a valid price';
                        $error = 'No normal price';
                   }

                   $offer_price = trim($_POST['offerPrice']);
                   $offer_price = filter_var($offer_price, FILTER_SANITIZE_STRING);

                   if (!preg_match('/^[0-9]*\.[0-9]{2}$/', $offer_price) || $offer_price == '') {
                       $offer_err = ' You must add a valid price';
                       $error = 'No offer price';
                   }

                   $offer_description = trim($_POST['description']);
                   $offer_description = filter_var($offer_description, FILTER_SANITIZE_STRING);

                   if ($offer_description == '') {
                       $desc_err = 'You must add a description';
                       $error = 'No description';
                   }

                    $image_size = $_FILES['fileUpload']['size'];
                    $image_type = $_FILES['fileUpload']['type'];


                    if (empty($_FILES['fileUpload']['name'])){
                        $img_err = 'You must add an image';
                        $error = 'Image to large';
                    } else {
                        if($image_size > $max_filesize) {
                            $img_err = 'The selected image is too big';
                            $error = 'Image to large';
                        } else {
                            if($image_type === 'image/gif' || $image_type === 'image/jpeg' || $image_type === 'image/png') {
                                $offer_photo = addslashes(file_get_contents($_FILES['fileUpload']['tmp_name']));
                            } else {
                                $img_err = 'The file type must be gif, jpg or png';
                            }//image type
                        }//Image size
                    }//image empty


                    if(empty($error)) {

                        $sql = "INSERT INTO offer (store_number, offer_photo, offer_title, offer_description, offer_normalprice, offer_price) VALUES ('{$store_number}', '{$offer_photo}', '{$offer_title}','{$offer_description}', '{$offer_normalprice}', '{$offer_price}')";
                        $result = mysqli_query($conn, $sql);

                            if($result) {
                                $message = '<p class="success">The offer is uploaded</p>';
                            } else {
                                $message = '<p class="err">Something went wrong, offer not uploaded. Try again</p>';
                            }//upload
                    } else {
                        $message = '<p class="err">You have to correct the errors</p>';
                    }

                }//isset submit


                ?>

                <form action="offer.php" method="post" enctype="multipart/form-data">

                    <p><label>Title</label><span class="err"><?php echo $title_err; ?></span></p>
                    <p><input type="text" name="title" size="50" placeholder="<?php echo ($offer_title !='') ? $offer_title :  'Title';?>"></p>
                    <p><label>Regular Price</label><span class="err"><?php echo $normal_err; ?></span></p>
                    <p><input type="text" name="regPrice" size="50" placeholder="<?php echo ($offer_normalprice !='') ? $offer_normalprice :  'Regular Price';?>"></p>
                    <p><label>Offer Price</label><span class="err"><?php echo $offer_err; ?></span></p>
                    <p><input type="text" name="offerPrice" size="50" placeholder="<?php echo ($offer_price !='') ? $offer_price :  'Offer Price';?>"></p>
                    <p><label>Description</label><span class="err"><?php echo $desc_err; ?></span></p>
                    <p><textarea name="description" cols="51" rows="10" placeholder="<?php echo ($offer_description !='') ? $offer_description :  'Description';?>"></textarea></p>
                    <p><label>Upload Photo max. 500kb</label><span class="err"><?php echo $img_err; ?></span></p>
                    <input type="file" name="fileUpload">
                    <br>
                    <p><button class="btn btn-primary" name="submit">Add Offer</button>
                </form>
                <?php echo $message; ?>
                

            </div>
            <div class="col-xs-3"></div>
        </div>
    </div>
</main>


<?php include_once ('./includes/footer.inc.php'); ?>
