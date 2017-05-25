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


                $upload_errors = array(
                    // http://www.php.net/manual/en/features.file-upload.errors.php
                    UPLOAD_ERR_OK 			=> "No errors.",
                    UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
                    UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
                    UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
                    UPLOAD_ERR_NO_FILE 		=> "No file.",
                    UPLOAD_ERR_NO_TMP_DIR   => "No temporary directory.",
                    UPLOAD_ERR_CANT_WRITE   => "Can't write to disk.",
                    UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
                );


                if (isset($_POST['submit'])) {

                    //Title
                   $offer_title = trim($_POST['title']);
                   $offer_title = filter_var($offer_title, FILTER_SANITIZE_STRING);

                   if ($offer_title == '') {
                       $title_err = ' You must add a title';
                       $error = 'No title';
                   }

                    //Normal Price
                   $offer_normalprice = trim($_POST['regPrice']);
                   $offer_normalprice = filter_var($offer_normalprice, FILTER_SANITIZE_STRING);

                   if (!preg_match('/^[0-9]*\.[0-9]{2}$/', $offer_normalprice) || $offer_normalprice == '') {
                        $normal_err = ' You must add a valid price';
                        $error = 'No normal price';
                   }

                   //Offer price
                   $offer_price = trim($_POST['offerPrice']);
                   $offer_price = filter_var($offer_price, FILTER_SANITIZE_STRING);

                   if (!preg_match('/^[0-9]*\.[0-9]{2}$/', $offer_price) || $offer_price == '') {
                       $offer_err = ' You must add a valid price';
                       $error = 'No offer price';
                   }

                   //Description
                   $offer_description = trim($_POST['description']);
                   $offer_description = filter_var($offer_description, FILTER_SANITIZE_STRING);

                   if ($offer_description == '') {
                       $desc_err = 'You must add a description';
                       $error = 'No description';
                   }



                   //Photo upload
                    $temp_file = $_FILES['fileUpload']['tmp_name'];
                    $target_file = basename($_FILES['fileUpload']['name']);
                    $target_dir = './assets/images/store_no_'.$store_number.'_uploads';
                    $offer_photo = $target_dir.'/'.$target_file;

                    $image_size = $_FILES['fileUpload']['size'];
                    $image_type = pathinfo($target_file, PATHINFO_EXTENSION);

                    echo $image_type;

                    if (file_exists($offer_photo)) {
                        $img_err = ' An image with that name already exsits';
                        $error = 'Image exists';
                    }

                    if ($image_type != 'gif' && $image_type != 'jpeg' && $image_type != 'png' && $image_type != 'jpg') {
                        $img_err = 'The file type must be gif, jpg or png';
                        $error = 'Wrong file type';
                    }

                    if (empty($_FILES['fileUpload']['name'])) {
                        $img_err = ' You must add a photo';
                        $error = 'No photo';
                    }


                    //Date stamps
                    $created_at = date('Y-m-d H:i:s');
                    $updated_at = date('Y-m-d H:i:s');




                    if(empty($error)) {

                        if (move_uploaded_file($temp_file, $offer_photo)) {

                            $sql = "INSERT INTO offer (store_number, offer_photo, offer_title, offer_description, offer_normalprice, offer_price, created_at, updated_at) VALUES ('{$store_number}', '{$offer_photo}', '{$offer_title}','{$offer_description}', '{$offer_normalprice}', '{$offer_price}', '{$created_at}', '{$updated_at}')";
                            $result = mysqli_query($conn, $sql);
                            echo $sql;
                            if ($result) {
                                $message = '<p class="success">The offer is uploaded</p>';
                            } else {
                                $message = '<p class="err">Something went wrong, offer not uploaded. Try again</p>';
                            }//upload
                        } else {
                            $up_err = $_FILES['fileUpload']['error'];
                            $message = $upload_errors[$up_err];
                        }//move file


                    } else {

                        $message = '<p class="err">You have to correct the errors</p>';

                    }//empty error

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
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_filesize; ?>">
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
