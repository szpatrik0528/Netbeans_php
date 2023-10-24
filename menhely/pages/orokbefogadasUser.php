<h1>Az örökbefogadás kezdete</h1>

<?php
$userid = $_SESSION['user']['userid'];
$allatid = filter_input(INPUT_GET, "allatid");
$allat = $db->getKivalasztottAllat($allatid);
if (filter_input(INPUT_POST, "orokbefogadas", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $allatid = filter_input(INPUT_POST, "allatid", FILTER_VALIDATE_INT);
    $userid = filter_input(INPUT_POST, "userid", FILTER_VALIDATE_INT);
    echo "rögzítés";
}
var_dump($_SESSION);
echo '<p>Valóban szeretné a ' . $allat['allat_neve'] . ' nevű állatunkat örökbe fogadni?</p>';
if($db->setOrokbefogadas($allatid, $_SESSION['user']['userid'])){
    header("Location: index.php?menu=home");
}else{
    echo 'Sikertelen rögzítés';
}
?>
<form method="POST">
    <input type="hidden" name="userid" value="<?php echo $_SESSION['user']['userid'] ?>">
    <input type="hidden" name="allatid" value="<?php echo $allatid ?>">
    <button type="submit" class="btn btn-danger" name="orokbefogadas" value="1">Igen</button>
    <button type="submit" class="btn btn-light">Mégsem</button>

    <a href="index.php?menu=orokbefogadasUser&userid=<?php echo $_SESSION['user']['userid']; ?> &allatid=<?php echo $allatid; ?>" class="btn btn-primary">Örökbe fogadom</a>
</form>