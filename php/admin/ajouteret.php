<?php include ("../connection.php"); 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="image/poly.png">
    <link rel="stylesheet" href="../../css/index.css">
        <link href="https://fonts.googleapis.com/css2?family=KoHo:wght@300&family=Sono:wght@300&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <title>Admin | Ajouter Etudiant</title>
</head>
<body>
    <div class="form">
        <div class="right-b"></div>
        <div class="login">
            <h2 class="Connect">Admin | Ajouter Etudiant</h2>
            <form method="POST" action="">
            <div class="input">
                <input type="text" name="mat" autocomplete="off" placeholder="Matricule" required=""><br>
                <input type="text" name="np" autocomplete="off" placeholder="Nom et Prénom" required=""><br>
                <input type="text" name="username" autocomplete="off" placeholder="Username" required="">
            </div>
            <button class="button n e"style="vertical-align:middle" name="envoyer">Ajouter</span></button></form>
            <button class="button n e" style="vertical-align:middle"><a href="./admin.php"><span>Revenir arriere</span></button><br><br><br>
            <button class="button n e l"style="vertical-align:middle"><a href="../logout.php"><img src="../../image/back.png" class="iconw">&nbsp;Log out</span></button>
    </div><br><br><br><br>
    <footer> 
        <p>© Copyright 2022 Polytechnique Sousse. Tous droits réservés.</p>  
        <?php if (isset($_SESSION['status'])){
            echo "<span class='line'>";
                echo "<p class='status' style=\"color:green;
                pointer-events: none; \">".$_SESSION['status'];
                unset($_SESSION['status']);
            }else if (isset($_SESSION['statusbad'])){
                echo "<span class='line'>";
                echo "<p class='status' style=\"color:red;
                pointer-events: none; \">".$_SESSION['statusbad'];
                unset($_SESSION['statusbad']); 
            }
            echo " </span>"
                ?>
    </footer>
</body>
</html>
<?php
if (isset($_POST["envoyer"])){
    $mat=$_POST['mat'];
    $np=$_POST['np'];
    $un=$_POST['username'];
    try
    {
        $requet= "insert into users values
        ('$un','$mat','1')";
        $requet2= "insert into students values
        ('$mat','$np')";
        /*$requet3= "insert into courses values
        ('$course','$mat')";*/
        $ok=mysqli_query($conn,$requet);
        $ok2=mysqli_query($conn,$requet2);
        /*$ok3=mysqli_query($conn,$requet3);*/
        if ($ok && $ok2 ){
            $_SESSION['status']="Les données sont insérés !";
            header("location:ajouteret.php");
        }
    }
    catch(Exception $e)
    {
        $_SESSION['statusbad']="Il existe déja le matricule ".$mat." dans le base de données verifier vos info !";
            header("location:ajouteret.php");
    }
}
?>