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
    <title>Enseignant(e)</title>
</head>
<body>
<div class="form">
        <div class="right-b"></div>
        <div class="login">
        
        <h2 class="Connect">Enseignant(e) | <?php echo strtoupper($name)?></h2>
            <form method="POST" action="">
            <div class="input">
                <input type="text" name="id" autocomplete="off" placeholder="L'id de l'étudiant" required=""><br>
                <input type="text" name="ds" autocomplete="off" placeholder="DS"><br>
                <input type="text" name="tp" autocomplete="off" placeholder="TP"><br>
                <input type="text" name="ex" autocomplete="off" placeholder="EXAMEN">
            </div>
            <button class="button n e"style="vertical-align:middle" name="envoyer">Ajouter</span></button></form>
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
            echo " </span>";
                ?>
</footer>
</body>
</html> 
<?php
if (isset($_POST["envoyer"])){
    $id=$_POST['id'];
    $ds=(float)$_POST['ds'];
    $tp=(float)$_POST['tp'];
    $ex=(float)$_POST['ex'];  
    $password=$_SESSION['pass'];
    $affiche="select name from courses where mat_prof like '$password'";
    $aff=mysqli_query($conn,$affiche);
        if (mysqli_num_rows($aff) > 0) {
            while($row = mysqli_fetch_array($aff)){
                $cid = $row['name'];
            }
        }
    try{
    $affiche2="select course_id student_id from exams";
    $aff2=mysqli_query($conn,$affiche2);
        if (mysqli_num_rows($aff2) > 0) {
            while($row2 = mysqli_fetch_array($aff2)){
                $sid=$row2['student_id'];
              if ($row2['course_id']=$cid && $row2['student_id']=$id && $ds==0 && $ex==0 && $tp==0){
                    $_SESSION['statusbad']="Saisir vos notes s.v.p";
                }
                else if ($row2['course_id']=$cid && $row2['student_id']=$id && $tp==0 && $ex==0){
                  $sql = "UPDATE exams SET ds='$ds' where student_id = '$id' and course_id='$cid' ";
                  $s1=mysqli_query($conn,$sql);
                  $_SESSION['status']="Vous avez ajouter le note de ds !";
                }else if ($row2['course_id']=$cid && $row2['student_id']=$id && $tp==0 && $ds==0){
                    $sql2= "UPDATE exams SET exam='$ex'  where student_id = '$id' and course_id='$cid'";
                    $s3=mysqli_query($conn,$sql2);  
                    $_SESSION['status']="Vous avez ajouter le note d'examen !";

                }else if ($row2['course_id']=$cid && $row2['student_id']=$id && $ds==0 && $ex==0){
                    $sql1 = "UPDATE exams SET tp='$tp'  where student_id = '$id' and course_id='$cid'";
                    $s2=mysqli_query($conn,$sql1);
                    $_SESSION['status']="Vous avez ajouter le note de tp !";
                }
                
                else if ($row2['course_id']=$cid && $row2['student_id']=$id && $ds==0){
                    $sql1 = "UPDATE exams SET tp='$tp', exam='$ex' where student_id = '$id' and course_id='$cid'";
                    $s4=mysqli_query($conn,$sql1);
                    $_SESSION['status']="Vous avez ajouter le note de tp et examen !";
                }
                else if ($row2['course_id']=$cid && $row2['student_id']=$id && $ex==0){
                    $sql1 = "UPDATE exams SET tp='$tp', ds='$ds' where student_id = '$id' and course_id='$cid'";
                    $s5=mysqli_query($conn,$sql1);
                    $_SESSION['status']="Vous avez ajouter le note de tp et ds !";
                }
                else if ($row2['course_id']=$cid && $row2['student_id']=$id && $tp==0){
                    $sql2= "UPDATE exams SET exam='$ex', ds='$ds'  where student_id = '$id' and course_id='$cid'";
                    $s6=mysqli_query($conn,$sql2); 
                    $_SESSION['status']="Vous avez ajouter le note d'examen et ds !";
                }         
                else { 
                    $requet= "insert into exams values
                    ('$cid','$id','$ds','$tp','$ex')"; 
                $ok=mysqli_query($conn,$requet);
                $_SESSION['status']="Les notes sont insérés !";
                }
            }
        }else {
            $requet= "insert into exams values
                    ('$cid','$id','$ds','$tp','$ex')"; 
                $ok=mysqli_query($conn,$requet);
                $_SESSION['status']="Les notes sont insérés !";
        }
    if ($ok || $s1 || $s2 || $s3 || $s4 || $s5 || $s6 ){
        header("location:ajoutnote.php");
    }else{
        header("location:ajoutnote.php");
    }
}catch(Exception $e){
    $_SESSION['statusbad']="L'étudiant n'existe pas et vous n'avez pas modifier les notes d'aprés cette interface !";
        header("location:ajoutnote.php");
}
}

?> 
