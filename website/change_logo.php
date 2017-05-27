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

            <h2>Change logo</h2>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6">

        <?php
            $sql = "SELECT store_logo FROM stores WHERE store_number = '{$_SESSION['id']}'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($logo = mysqli_fetch_assoc($result)) {
                    echo '
                        <img src="'.$logo['store_logo'].'" class="storeLogo">
                    ';
                }

            } else {
                echo 'Can not find any logo for this store';
            }

            $errors = [];
            $img_err = '';
            $message = '';
            $max_filesize = 512000;

            $store_number = $_SESSION['id'];
            $updated_at = date('Y-m-d H:i:s');

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

                //Photo upload
                $temp_file = $_FILES['fileUpload']['tmp_name'];
                $target_file = basename($_FILES['fileUpload']['name']);
                $target_dir = './assets/images/store_no_'.$store_number.'_uploads';
                $offer_photo = $target_dir.'/'.$target_file;

                $image_size = $_FILES['fileUpload']['size'];
                $image_type = pathinfo($target_file, PATHINFO_EXTENSION);


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

                if (empty($errors)) {

                    if (move_uploaded_file($temp_file, $offer_photo)) {

                        $sql = "UPDATE stores SET store_logo = '{$offer_photo}', updated_at = '{$updated_at}' WHERE store_number = '{$store_number}'";
                        $result = mysqli_query($conn, $sql);

                       if ($result) {
                            redirect('store.php');
                        } else {
                            $message = '<span class="err">Something went wrong, new logo not uploaded. Try again</span>';
                        }//upload
                    } else {
                        echo $sql;
                        $up_err = $_FILES['fileUpload']['error'];
                        $message = $upload_errors[$up_err];
                    }//move file
                }
            }//submit



        ?>


                    <form action="change_logo.php" method="post" enctype="multipart/form-data">
                        <br>
                        <p><label>Add new logo</label><span class="err"><?php echo $img_err;?></span> </p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_filesize; ?>">
                        <input type="file" name="fileUpload">
                        <br>
                        <p>
                            <button class="btn btn-primary" name="submit">Change</button>
                            <a href="store.php" class="btn btn-danger" role="button">Cancel</a>
                        </p>
                    </form>
                    <p><?php echo $message; ?></p>
                </div>
                <div class="col-xs-3"></div>
            </div>

        </div>
    </main>



<?php include_once ('./includes/footer.inc.php'); ?>