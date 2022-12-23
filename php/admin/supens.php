<?php include ("../connection.php"); 
session_start();
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
    <title>Admin | Supprimer Enseignant(e)</title>
</head>
<body>
    <div class="form">
        <div class="right-b"></div>
        <div class="login">
            <h2 class="Connect">Admin | Supprimer Enseignant(e)</h2>
            <form method="POST" action="">
            <div class="input">
                <input type="text" name="mat" autocomplete="off" placeholder="Matricule" required=""><br>
            </div>
            <button class="button n e"style="vertical-align:middle" name="envoyer">Supprimer</span></button></form>
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
if (isset($_POST["envoyer"]))
{
    $mat=$_POST['mat'];  
    $affiche="select name from prof where mat_prof='$mat'";
    $aff=mysqli_query($conn,$affiche);
    $requet="delete from users where password='$mat' and role='2'";
    $requet1="delete from courses where mat_prof='$mat'";
    $requet2="delete from prof where mat_prof='$mat'";
    $ok=mysqli_query($conn,$requet);
    $ok1=mysqli_query($conn,$requet1); 
    $ok2=mysqli_query($conn,$requet2); 
    if (mysqli_num_rows($aff) > 0) {
        while($row = mysqli_fetch_array($aff)){
            if ($ok && $ok2 && $ok1){
                $_SESSION['status']="L'enseignant ".$row['name']." a été supprimer !";
                header("location:supens.php");
            }
        }
    }else{
        $_SESSION['statusbad']="Le matricule ".$mat." n'éxiste pas !";
        header("location:supens.php");
    }
}
?>