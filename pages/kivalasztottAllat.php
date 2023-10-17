<?php
if (filter_input(INPUT_POST, "Adatmodositas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    echo 'Kaptunk adatokat';
    $adatok = $_POST;
    var_dump($_FILES);
    if ($_FILES['error'] == 0) {
        $kiterjesztes = null;
        switch ($_FILES['type']) {
            case 'image/png':
                $kiterjesztes = ".png";
                break;
            case 'image/jpg':
                $kiterjesztes = ".jpg";
                break;
            case 'image/jpeg':
                $kiterjesztes = ".jpeg";
                break;
            default:
                break;
        }
        $forras = $_FILES['tmp_name'];
        $cel = DIRECTORY_SEPARATOR . "\\allatkepek\\" . DIRECTORY_SEPARATOR.$adatok['allat_neve'].$kiterjesztes;
        copy($forras, $cel);
    }
} else {
    echo 'Nem adtál adatot';
    $adatok = $db->kivalasztottAllat($id);
}
?>
<?php
$adatok = $db->kivalasztottAllat($id);
?>
<!-- array(8) {
  ["allatid"]=>string(1) "1"
  ["allat_neve"]=>string(7) "András"
  ["faj"]=>string(5) "kutya"
  ["fajta"]=>string(6) "vizsla"
  ["szuletesi_ido"]=>string(10) "2018-09-11"
  ["nem"]=>string(3) "kan"
  ["megjegyzes"]=>string(16) "betegsége nincs"
  ["nyilvantartasban"]=>string(10) "2022-11-22"
} -->
<form method="post" action="index.php?menu=home&id=<?php echo $adatok['allatid'] ?>" >
    <input type="hidden" name="allatid" value=""<?php echo $adatok['allatid'] ?> enctype="multipart/form-data">

    <div class="container">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="allat_neve" class="form-label">Állat neve</label>
                <input type="text" class="form-control" id="allat_neve" name="allat_neve" value="<?php echo $adatok['allat_neve']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fajSelect" class="form-label">Állatfaj</label>
                    <select id="fajSelect" class="form-select" name="fajSelect" value="<?php echo $adatok['fajSelect'] ?>">
                        <?php
                        foreach ($db->getFajok() as $value) {
                            echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fajtaSelect" class="form-label">Fajta</label>
                    <select id="fajtaSelect" class="form-select" name="fajtaSelect" value="<?php echo $adatok['fajSelect'] ?>">
                        <?php
                        foreach ($db->getFajta() as $value) {
                            echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="szuletesi_ido" class="form-label">Születési Idő</label>
            <input type="date" class="form-control" id="szuletesi_ido" name="szuletesi_ido" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $adatok['szuletesi_ido']; ?>">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nemSelect" class="form-label">Neme</label>
                    <select id="nemSelect" class="form-select" name="nemSelect" value="<?php echo $adatok['nemSelect']; ?>">
                        <?php
                        foreach ($db->getNem() as $value) {
                            echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="megjegyzesSelect" class="form-label">Megjegyzés</label>
                    <select id="megjegyzesSelect" class="form-select" name="megjegyzesSelect" value="<?php echo $adatok['megjegyzesSelect']; ?>">
                        <?php
                        foreach ($db->getMegjegyzés() as $value) {
                            echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="nyilvantartasban" class="form-label">Nyilvántartásban</label>
            <input type="date" class="form-control" id="nyilvantartasban" name="nyilvantartasban" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $adatok['nyilvantartasban']; ?>">
        </div>
        <div class="container col-md-6">
            <div class="mb-5">
                <label for="kepfajl" class="form-label">Képfeltöltés</label>
                <input class="form-control" type="file" id="kepfajl" name="kepfajl" value="">
                <button type="sumbit" class="btn btn-success" name="Adatmodositas" value="1">Adatmodositas</button>
            </div>
        </div>
    </div>
</form>
