<div class="container">
    <div class="row">
        <?php
        foreach ($db->osszesAllat() as $row) {
            $images = null;
            if (file_exists("./allatkepek/" . $row['allat_neve'] . ".jpg")) {
                $images = "./allatkepek/" . $row['allat_neve'] . ".jpg";
            } else if (file_exists("./allatkepek/" . $row['allat_neve'] . ".jpeg")) {
                $images = "./allatkepek/" . $row['allat_neve'] . ".jpeg";
            } else if (file_exists("./allatkepek/" . $row['allat_neve'] . ".png")) {
                $images = "./allatkepek/" . $row['allat_neve'] . ".png";
            }else{
                $images ="./images/unnamed.jpg";
            }

            $card = '
                    <div class="card col-3 ms-2" style="width: 18rem ;">
                    <img src="'. $images.'" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">' . $row['allat_neve'] . '</h5>' .
                    '<p class="card-text"> született: ' . $row['szuletesi_ido'] . '</p>' .
                    '<p class="card-text"> neme: ' . $row['nem'] . '</p>' .
                    '<p class="card-text"> nálunk: ' . $row['nyilvantartasban'] . '</p>' .
                    '<p class="card-text"> ' . $row['megjegyzes'] . '</p>' .
                    '<a href="index.php?menu=home&id=' . $row['allatid'] . '" class="btn btn-primary">Kiválaszt</a>
                </div>
                </div>';
            echo $card;
        }
        ?>
    </div>
</div>