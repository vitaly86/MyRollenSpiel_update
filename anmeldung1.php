<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form-style1.css">
    <title>Anmeldung</title>
</head>
<body>
    <form class="login-form" action="index.php" method="POST">
        <label for="username1">Player Name</label>
        <input type="text" id="username" name="username1" required>
        <label for="lebenspunkte1">Lebenspunkte</label>
        <input type="text" id="lebenspunkte" name="lebenspunkte1" required>
        <label for="angriffswert1">Angriffswert</label>
        <input type="text" id="angriffswert" name="angriffswert1">
        <button type="submit">Anmelden</button>

    </form>
</body>
</html>