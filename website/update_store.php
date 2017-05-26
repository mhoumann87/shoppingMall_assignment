<?php require_once './includes/sessions.inc.php'; ?>
<?php require_once './includes/connection.inc.php'; ?>


<?php include_once ('./includes/header.inc.php'); ?>

    <main class="container">
        <div class="jumbotron">

            <?php
            $errors = [];
            $message = '';
            $store_number = $_SESSION['id'];
            $store_name = '';
            $name_err = '';
            $store_phoneno = '';
            $phone_err = '';
            $store_website = '';
            $web_err = '';
            $add_photo = 0;
            $max_filesize = 512000;
            $err_logo = '';

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

            if (!empty($_GET)) {

                if ($_GET['n'] == 1) {

                    $store_number = $_SESSION['id'];

                    $url = 'update_store.php?n=1';
                    $submit_name = 'create';
                    $headline = 'Create Store Information';
                    $button_txt = 'Create';
                    $add_photo = 1;

                    if (isset($_POST['create'])) {


                        $store_name = trim($_POST['store_name']);
                        $store_name = filter_var($store_name, FILTER_SANITIZE_STRING);

                        if ($store_name == '') {
                            $name_err = ' You have to add a store name';
                            $errors = 'No name';
                        }

                        $store_phoneno = trim($_POST['store_phoneno']);
                        $store_phoneno = filter_var($store_phoneno, FILTER_SANITIZE_STRING);

                        if ($store_phoneno == '') {
                            $phone_err = ' You have to add a phone number';
                            $errors = 'No phone number';
                        }

                        $store_website = trim($_POST['store_website']);
                        $store_website = filter_var($store_website, FILTER_SANITIZE_URL);

                        if ($store_website == '') {
                            $web_err = ' You have to add a website URL';
                            $errors = 'No website';
                        }

                        //Photo upload
                        $temp_file = $_FILES['store_logo']['tmp_name'];
                        $target_file = basename($_FILES['store_logo']['name']);
                        $target_dir = './assets/images/store_no_'.$store_number.'_uploads';
                        $store_logo = $target_dir.'/'.$target_file;

                        $image_size = $_FILES['store_logo']['size'];
                        $image_type = pathinfo($target_file, PATHINFO_EXTENSION);



                        if (file_exists($store_logo)) {
                            $err_logo = ' An image with that name already exsits';
                            $error = 'Image exists';
                        }

                        if ($image_type != 'gif' && $image_type != 'jpeg' && $image_type != 'png' && $image_type != 'jpg') {
                            $err_logo = 'The file type must be gif, jpg or png';
                            $error = 'Wrong file type';
                        }

                        if (empty($_FILES['store_logo']['name'])) {
                            $err_logo = ' You must add a photo';
                            $error = 'No photo';
                        }


                        $created_at = date('Y-m-d H:i:s');
                        $updated_at = date('Y-m-d H:i:s');

                    if (empty($errors)) {

                        if (move_uploaded_file($temp_file, $store_logo)) {

                            $sql = "INSERT INTO stores (store_number, store_name, store_logo, store_phoneno, store_website, created_at, updated_at) VALUES ('{$store_number}', '{$store_name}', '{$store_logo}','{$store_phoneno}', '{$store_website}', '{$created_at}', '{$updated_at}')";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                $message = '<span class="success">Store is created</span>';

                            } else {
                                $message = '<span class="err">Something went wrong, offer not uploaded. Try again</span>';
                            }//upload
                        } else {
                            $up_err = $_FILES['fileUpload']['error'];
                            $message = $upload_errors[$up_err];
                        }//move file


                    }


                    }//submit

                } else {
                    redirect('error404.php');
                }//get n 0 1


            } else {
                $url = 'update_store.php';
                $headline = 'Change Store Information';
                $button_txt = 'Change';
                $submit_name = 'change';

                $sql = "SELECT * FROM stores WHERE store_number = '{$_SESSION['id']}'";
                $info = mysqli_query($conn, $sql);

                if (mysqli_num_rows($info) > 0) {

                    $store = mysqli_fetch_assoc($info);
                    $store_name = $store['store_name'];
                    $store_phoneno = $store['store_phoneno'];
                    $store_website = $store['store_website'];

                    if (isset($_POST['change'])) {

                        $store_name = trim($_POST['store_name']);
                        $store_name = filter_var($store_name, FILTER_SANITIZE_STRING);

                        if ($store_name == '') {
                            $name_err = ' You have to add a store name';
                            $errors = 'No name';
                        }

                        $store_phoneno = trim($_POST['store_phoneno']);
                        $store_phoneno = filter_var($store_phoneno, FILTER_SANITIZE_STRING);

                        if ($store_phoneno == '') {
                            $phone_err = ' You have to add a phone number';
                            $errors = 'No phone number';
                        }

                        $store_website = trim($_POST['store_website']);
                        $store_website = filter_var($store_website, FILTER_SANITIZE_URL);

                        if ($store_website == '') {
                            $web_err = ' You have to add a website URL';
                            $errors = 'No website';
                        }

                        $updated_at = date('Y-m-d H:i:s');

                        if (empty($errors)) {

                            $sql = "UPDATE stores SET store_name = '{$store_name}', store_phoneno = '{$store_phoneno}', store_website = '{$store_website}', updated_at = '{$updated_at}' WHERE store_number = '{$_SESSION['id']}'";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                $message = '<span class="success">Information updated</span>';
                            } else {
                                $message = '<span class="err">Something went wrong, please try again</span>';
                            }

                        }// empty errors


                    }//if isset submit

                } else {
                    $message = '<span class="err">Something went wrong</span>';
                }//num_rows
            }
            ?>

            <h2><?php echo $headline; ?></h2>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6">
                    <form name="update_store" action="<?php echo $url; ?>" method="post" enctype="multipart/form-data">
                        <p><label>Store name</label><span class="err"><?php echo $name_err; ?></span></p>
                        <p><input type="text" name="store_name" size="50" placeholder="Store name"value="<?php echo ($store_name != '') ? $store_name:'';  ?>"</p>
                        <p><label>Phone number</label><span class="err"><?php echo $phone_err; ?></span> </p>
                        <p><input type="text" name="store_phoneno" size="50" placeholder="Phone Number" value="<?php echo ($store_phoneno != '') ? $store_phoneno : '' ?>"></p>
                        <p><label>Website URL</label><span class="err"><?php echo $web_err; ?></span></p>
                        <p><input type="url" name="store_website" size="50" placeholder="Website URL" value="<?php echo ($store_website != '') ? $store_website : ''; ?>"></p>
                        <?php
                            echo ($add_photo == 1) ? '
                            <p><label>Add Logo Image max. 500kb</label><span class="err">'.$err_logo.'</span></p>
                            <p><input type="hidden" name="MAX_FILE_SIZE" value="'.$max_filesize.'"></p>
                            <p><input type="file" name="store_logo"></p>
                            ' : '';
                        ?>
                        <p>
                            <button class="btn btn-primary" name="<?php echo $submit_name; ?>"><?php echo $button_txt; ?></button>
                            <?php echo ($add_photo == 0) ? '&nbsp;<a href="store.php" class="btn btn-danger" role="button">Cancle</a>' : '' ;?>
                        </p>

                    </form>
                    <p><?php echo $message; ?></p>
                </div>
                <div class="col-xs-3"></div>
            </div>

        </div>
    </main>



<?php include_once ('./includes/footer.inc.php'); ?>