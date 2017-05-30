<?php require_once ('functions.inc.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Shopping Mall Assignment - Login</title>
</head>
<body>
<div class="container-fluid top">
    <header>

        <div class="logoBox">
            <img src="./assets/images/logo.png" class="logo" alt="Shopping Mall Logo">
        </div>
        <div class="title">
            <h1>RO's Torv Customer Club - Store Administration</h1>
        </div>


    </header>
</div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Login<span class="sr-only">(current)</span></a></li>
                    <?php echo (isset($_SESSION['id']) && $_SESSION['id'] != 'Admin') ?
                    '<li><a href="store.php">Store Info</a></li>' : ''; ?>
                    <?php echo (isset($_SESSION['id']) && $_SESSION['id'] != 'Admin') ?
                    '<li><a href="offer.php">Add Offer</a></li>' : ''; ?>
                    <?php echo (isset($_SESSION['id']) && $_SESSION['id'] === 'Admin') ?
                        '<li><a href="create_user.php">Create User</a></li>' : ''; ?>
                    <?php echo (isset($_SESSION['id'])) ?
                    '<li><a href="change_password.php">Change Password</a></li>' : '';?>

                </ul>
                <?php echo (isset($_SESSION['id'])) ?
                 '<ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Logout</a></li>
                </ul>' : ''; ?>

            </div>
        </div>
    </nav>


