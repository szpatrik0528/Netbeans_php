<?php
if (filter_input(INPUT_POST, 'regisztraciosAdatok', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $pass1 = filter_input(INPUT_POST, "password");
    $pass2 = filter_input(INPUT_POST, "password2");
    $name = htmlspecialchars(filter_input(INPUT_POST, 'username'));
    $igazolvanyszam = filter_input(INPUT_POST, "igazolvanyszam");
    $orokbefogado_neve = htmlspecialchars(filter_input(INPUT_POST, "orokbefogado_neve"));
    $email = filter_input(INPUT_POST, "emailcim", FILTER_VALIDATE_EMAIL);
    if (empty($email) || empty($orokbefogado_neve) || empty($igazolvanyszam) || empty($name) || empty($pass1) || empty($pass2)) {
        echo '<p>Minden mezőt ki kell tölteni!</p>';
    } else {
        if ($pass1 != $pass2) {
            echo '<p>Nem egyeznek a jelszavak!</p>';
        } else {
            $db->register($igazolvanyszam, $orokbefogado_neve, $email, $name, $pass1);
            header("Location: index.php");
        }
    }
}
?>
<div class="container">
    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="emailcim" class="form-label">Email cím</label>
                    <input type="text" class="form-control" id="emailcim" name="emailcim" minlength="1" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="orokbefogado_neve" class="form-label">Teljes név</label>
                    <input type="text" class="form-control" id="orokbefogado_neve" name="orokbefogado_neve" minlength="5" maxlength="50" aria-describedby="emailHelp">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="igazolvanyszam" class="form-label">Igazolványszám</label>
                        <input type="text" class="form-control" id="igazolvanyszam" name="igazolvanyszam" maxlength="8" pattern="[1-9]{1}[0-9]{5}[A-Za-z]{2}" aria-describedby="emailHelp">
                        <div>Fontos a beazonosítás miatt. </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Felhasználó név</label>
                    <input type="text" class="form-control" id="username" name="username" minlength="1" aria-describedby="emailHelp">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" id="password" minlength="2" name="password">
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Jelszó megerősítés</label>
            <input type="password" class="form-control" id="password2" minlength="2" name="password2">
        </div>
        <button type="submit" class="btn btn-primary" name="regisztraciosAdatok" value="true">Regisztráció</button>
    </form>
</div>