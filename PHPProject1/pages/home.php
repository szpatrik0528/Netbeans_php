<?php
$images = [
    'image1.jpg',
    'image2.jpg',
    'kutya3.jpg',
    'macska1.jpg',
    'kutya4.jpg',
    'kutya5.jpg',
    'kutya6.jpg',
    'kutya7.jpg',
    'macska2.jpg',
    'kutya8.jpg',
    'kutya9.jpg',
    'macska3.jpg',
    'macska4.jpg',
    'kutya10.jpg',
    'kutya11.jpg',
    'kutya12.jpg',
];
?>
<h1>Nyitólap</h1>
<div class="row">
    <?php
    if ($result->num_rows > 0) {
        $imageIndex = 0;
        while ($row = $result->fetch_assoc()) {
            $imagePath = $images[$imageIndex % count($images)]; // Reuse images in a circular manner
            $imageIndex++;
            $allat_neve = $row['allat_neve'];
            $szuletesi_ido = $row['szuletesi_ido'];
            $nem = $row['nem'];
            $nyilvantartasban = $row['nyilvantartasban'];
            $megjegyzes = $row['megjegyzes'];
        }
    }
    ?>
    <div class="card" style="width: 18rem; height: auto; text-align: center; justify-content: center;">
        <img src="<?= $imagePath ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $allat_neve ?></h5>
            <p class="card-text">
<?= $allat_neve ?> (született: <?= $szuletesi_ido ?>, neme: <?= $nem ?>, nálunk: <?= $nyilvantartasban ?>) <?= $megjegyzes ?>
            </p>
            <a href="index.php?menu=home&id=<?= $row['allatid'] ?>" class="btn btn-primary">Kiválaszt</a>
        </div>
    </div>
</div>