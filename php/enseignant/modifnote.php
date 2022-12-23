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
    <title>Enseignant(e) | Modifier Note</title>
</head>
<body>
<div class="form">
        <div class="right-b"></div>
        <div class="login">
        
        <h2 class="Connect">Enseignant(e) | <?php echo strtoupper($name)?></h2>
            <form method="POST" action="">
            <div class="input">
                <input type="text" name="id" autocomplete="off" placeholder="L'id de l'étudiant" required=""><br>
                <select name="type" id="type">
                    <option value="tp">TP</option>
                    <option value="ds">DS</option>
                    <option value="exam">Examen</option>
                </select>
                <input type="text" name="note" class="login-box-field username" autocomplete="off" placeholder="Note" required=""><br>
            </div>
            <button class="button n e"style="vertical-align:middle" name="envoyer">Modifier</span></button></form>
            <button class="button n e" style="vertical-align:middle"><a href="./enseignant.php"><span>Revenir arriere</span></button><br><br><br>
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
    $id=$_POST['id'];
    $type=$_POST['type'];
    $note=(float)$_POST['note'];
    $password=$_SESSION['pass'];
    $affiche="select name from courses where mat_prof like '$password'";
    $aff=mysqli_query($conn,$affiche);
        if (mysqli_num_rows($aff) > 0) {
            while($row = mysqli_fetch_array($aff)){
                $cid = $row['name'];
            }
        }
    $affiche2="select student_id from exams where student_id='$id' and course_id='$cid' ";
    $aff2=mysqli_query($conn,$affiche2);
        if (mysqli_num_rows($aff2) > 0) {
            $sql = "UPDATE exams SET $type='$note' where student_id='$id' and course_id='$cid'";
            $s1=mysqli_query($conn,$sql);
            $_SESSION['status']="Le note été modifiée !";
            header("location:modifnote.php");
        }
        else{
    $_SESSION['statusbad']="Le note n'est pas modifiée, l'étudiant n'existe pas!";
    header("location:modifnote.php");
    }
}
?>