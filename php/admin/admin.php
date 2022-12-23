<?php
 include ("../connection.php");
session_start();
$name=$_SESSION['login'];
$name = str_replace('.', ' ', $name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="image/poly.png">
    <link rel="stylesheet" href="../../css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:wght@300&family=Sono:wght@300&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
    <div class="form">
        <div class="right-b"></div>
        <div class="login">
            <h2 class="Connect">Admin | <?php echo strtoupper($name)?></h2>
            <div class="input">
                <button class="button n" style="vertical-align:middle"><a href="./ajouteret.php">Ajouter étudiant</span></button>
                </div>
            <div class="input">
                <button class="button n" style="vertical-align:middle"><a href="./ajoutens.php">Ajouter enseingnant</span></button>
                </div><br><br><br><br><br><br>
                <div class="input">
                    <button class="button n" style="vertical-align:middle"><a href="./supet.php">Supprimer étudiant</span></button>
                    </div>
                <div class="input">
                    <button class="button n" style="vertical-align:middle"><a href="./supens.php">Supprimer enseingnant</span></button>
                    </div><br><br><br><br><br><br><br>
            <button class="button l"style="vertical-align:middle"><a href="../logout.php"><img src="../../image/back.png" class="iconw">&nbsp;Log out</span></button>
        </div>
    </div><br><br><br><br>
    <footer>
        <div class="container">
        <p>© Copyright 2022 Polytechnique Sousse. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>