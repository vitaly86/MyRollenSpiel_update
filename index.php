<?php
include "Kampf.php";
?>
<?php
$spieler1 = null;
$spieler2 = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username1"]) && !empty($_POST["username1"])) {
        $username = $_POST["username1"];
        $lebenspunkte = $_POST["lebenspunkte1"];
        $angriffswert = $_POST["angriffswert1"];
        $_SESSION["first"] = $_POST["username1"];
        $spieler1 = new Spieler($username, $lebenspunkte, $angriffswert);
    } else if (isset($_POST["username2"]) && !empty($_POST["username2"])) {
        $username = $_POST["username2"];
        $lebenspunkte = $_POST["lebenspunkte2"];
        $angriffswert = $_POST["angriffswert2"];
        $_SESSION["second"] = $_POST["username2"];
        $spieler2 = new Spieler($username, $lebenspunkte, $angriffswert);
    }
} else {
    $spieler1 = new Spieler("Player 1", 100, 20);
    $spieler2 = new Spieler("Player 2", 100, 30);
}

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RollenSpiel</title>
</head>

<body>
    <div id="logo">
        <img src="photos/Mortal-Kombat-Logo.png" alt="logo" id="game-logo">
    </div>
    <div class="container">
        <div class="box">
            <h1><a href="anmeldung1.php"><?php echo $_SESSION["first"] ?? "Player 1" ?></a></h1>
            <img src="photos/player_1.png" alt="first_player" class="players-img">
        </div>
        <div class="box">
            <?php $kampf = new Kampf($spieler1, $spieler2); ?>
            <h1 style="color:blue;">Results</h1>
            <?php $kampf->kampf(); ?>
        </div>
        <div class="box">
            <h1><a href="anmeldung2.php"><?php echo $_SESSION["second"] ?? "Player 2" ?></a></h1>
            <img src="photos/player_2.png" alt="second_player" class="players-img">
        </div>
    </div>
</body>

</html>