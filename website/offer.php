    <?php include_once ('./includes/header.inc.php'); ?>

<main class="container">
    <div class="jumbotron">
        <h2>Add Offer</h2>
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">
                <form action="offer.php" method="post" enctype="multipart/form-data">
                    <p></p><label>Title</label></form></p>
                    <p><input type="text" name="title" size="50" placeholder="Title"></p>
                    <p><label>Regular Price</label></p>
                    <p><input type="text" name="regPrice" size="50" placeholder="Regular Price"></p>
                    <p><label>Offer Price</label></p>
                    <p><input type="text" name="offerPrice" size="50" placeholder="Offer Price"></p>
                    <p><label>Title</label></p>
                    <p><textarea name="description" cols="51" rows="10" placeholder="Description"></textarea></p>
                    <input type="file" name="fileUpload">
                    <br>
                    <p><button class="btn btn-primary" name="submit">Add Offer</button>
                </form>
            </div>
            <div class="col-xs-3"></div>
        </div>
    </div>
</main>


<?php include_once ('./includes/footer.inc.php'); ?>
