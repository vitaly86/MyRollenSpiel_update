<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form-style2.css">
    <title>Anmeldung</title>
</head>
<body>
    <form class="login-form" action="index.php" method="POST">
        <label for="username">Player Name</label>
        <input type="text" id="username" name="username2" required>
        <label for="lebenspunkte">Lebenspunkte</label>
        <input type="text" id="lebenspunkte" name="lebenspunkte2" required>
        <label for="angriffswert">Angriffswert</label>
        <input type="text" id="angriffswert" name="angriffswert2">
        <button type="submit">Anmelden</button>

    </form>
</body>
</html>