<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<form name="create_store" action="update_store.php" method="post">

    <label>Customer Name</label>
    <input type="text" name="customer_username" size="30">
    <label>Customer Mail</label>
    <input type="text" name="customer_email" size="30">
    <label>Customer Password</label>
    <input type="text" name="customer_password" size="30">
    <button name="submit">Sign Up</button>

    <?php
        $customer_username = '';
        $customer_email = '';
        $customer_password = '';

        $errors ='';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $customer_username = $_POST['customer_username'];
        $customer_email =  $_POST['customer_email'];
        $customer_password = $_POST['customer_password'];;

        $sql = "CREATE "

    }


    ?>

</form>

</body>
</html>