<?php
if (filter_input(INPUT_POST, "Adatmodositas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    $adatok = $_POST;
    var_dump($adatok);
    $allatid = filter_input(INPUT_POST, "allatid", FILTER_SANITIZE_NUMBER_INT);
    $allat_neve = htmlspecialchars(filter_input(INPUT_POST, "allat_neve"));
    $faj = filter_input(INPUT_POST, "fajSelect");
    $fajta = filter_input(INPUT_POST, "fajtaSelect");
    $szuletesi_ido = filter_input(INPUT_POST, "szuletesi_ido");
    $nem = filter_input(INPUT_POST, "nemSelect");
    $megjegyzes = filter_input(INPUT_POST, "megjegyzes");
    $nyilvantartasban = filter_input(INPUT_POST, "nyilvantartasban");
    $from = null;
    $to = null;
    if ($_FILES['kepfajl']['error'] == 0) {
        $kiterjesztes = null;
        switch ($_FILES['kepfajl']['type']) {
            case 'image/png':
                $kiterjesztes = ".png";
                break;
            case 'image/jpeg':
                $kiterjesztes = ".jpg";
                break;
            default:
                break;
        }
        $from = $_FILES['kepfajl']['tmp_name'];
        $to = dir(getcwd());
        $to = $to->path . DIRECTORY_SEPARATOR . "allatkepek" . DIRECTORY_SEPARATOR . $allat_neve . $kiterjesztes;
        if (copy($from, $to)) {
            echo '<p>A kép feltöltés sikeres</p>';
        } else {
            echo '<p>A kép feltöltés sikertelen!</p>';
        }
    }
    if ($db->setKivalasztottAllat($allatid, $allat_neve, $faj, $fajta, $szuletesi_ido, $nem, $megjegyzes, $nyilvantartasban)) {
        echo '<p>Az adatok módosítása sikeres</p>';
        header("Location: index.php?menu=home");
    } else {
        echo '<p>Az adatok módosítása sikertelen!</p>';
    }
} else {
    $adatok = $db->getKivalasztottAllat($id);
}
?>
<!--<!-- array (size=8)
  'allatid' => string '7' (length=1)
  'allat_neve' => string 'Gazsi' (length=5)
  'faj' => string 'kutya' (length=5)
  'fajta' => string 'Mobsz' (length=5)
  'szuletesi_ido' => string '2021-01-11' (length=10)
  'nem' => string 'szuka' (length=5)
  'megjegyzes' => string 'csinos' (length=6)
  'nyilvantartasban' => string '2023-05-10' (length=10) -->
<form method="post" action="index.php?menu=home&id=<?php echo $adatok['allatid']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="allatid" value="<?php echo $adatok['allatid']; ?>">
    <div class="mb-3">
        <label for="allat_neve" class="form-label">Állat neve</label>
        <input type="text" class="form-control" name="allat_neve" id="allat_neve" value="<?php echo $adatok['allat_neve']; ?>">
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="fajSelect" class="form-label">Állatfaj</label>
            <select id="fajSelect" name="fajSelect" class="form-select">
                <?php
                foreach ($db->getFajok() as $value) {
                    if ($adatok['faj'] == $value[0]) {
                        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
                    } else {
                        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                    }
                }
                ?>

            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="fajtaSelect" class="form-label">Állatfajta</label>
            <select id="fajtaSelect" name="fajtaSelect" class="form-select">
                <?php
                foreach ($db->getFajtak() as $value) {
                    if ($adatok['fajta'] == $value[0]) {
                        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
                    } else {
                        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                    }
                }
                ?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="szuletesi_ido" class="form-label">Születési idő</label>
            <input type="date" class="form-control" name="szuletesi_ido" id="szuletesi_ido" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $adatok['szuletesi_ido']; ?>">
        </div>
        <div class="mb-3 col-6">
            <label for="nem" class="form-label">Az állat neme</label>
            <select id="nemSelect" name="nemSelect" class="form-select" >
                <option<?php echo ($adatok["nemSelect"] == "kan" || $adatok["nem"] == "kan" ? " selected " : ""); ?> value="kan">kan</option>
                <option<?php echo ($adatok["nemSelect"] == "szuka" ? " selected " : ""); ?> value="szuka">szuka</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="nyilvantartasban" class="form-label">Nyilvántartásba vétel</label>
            <input type="date" class="form-control" name="nyilvantartasban" id="szuletesi_ido" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo $adatok['szuletesi_ido']; ?>">
        </div>
        <div class="mb-3 col-6">
            <label for="megjegyzes" class="form-label">Megjegyzés</label>
            <input type="text" class="form-control" name="megjegyzes" id="megjegyzes" value="<?php echo $adatok['megjegyzes']; ?>">
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" value="">
        </div>

    </div>
    <button type="submit" class="btn btn-success" value="1" name="Adatmodositas">Módosítás</button>
    <a href="index.php?menu=orokbefogadasUser&userid=<?php echo $id; ?> &allatid=<?php echo $adatok['allatid']; ?>" class="btn btn-primary">Örökbe fogadom</a>
</form>
<?php ?>