<?php include ("../connection.php"); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ètudiant</title>
    <link rel="icon" type="image/x-icon" href="image/poly.png">
    <link rel="stylesheet" href="../../css/index.css">
    <script src="https://kit.fontawesome.com/d59e9722f0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:wght@300&family=Sono:wght@300&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<div class="form">
<div class="right-b">
<div class="side-bar">
<ul>
    <li><a href="../logout.php"><img src="../../image/logout.png" class="icon">&nbsp;<STRONG>Log Out </STRONG></a></li>
</ul>
</div>

<i class="fas fa-bars bar"></i>
</div>
<div class="container">
    <section class="note">
<h3 class="aff">Affichage des notes de 
<?php        
$password=$_SESSION['pass'];
$affiche="select name from students where mat_student like '$password'";
$aff= $conn->query($affiche);
    while($row1 = mysqli_fetch_array($aff)){
       $cid= $row1['name'];
    } 
echo $cid ?></h2>
<table>
  <tr>
    <th>Matiére</th>
    <th>Ds</th>
    <th>Tp</th>
    <th>Examen</th>
  </tr>
    <?php
       $password=$_SESSION['pass'];
       $affiche="select name from students where mat_student like '$password'";
       $aff= $conn->query($affiche);
           while($row1 = mysqli_fetch_array($aff)){
              $cid= $row1['name'];
           } 
$sql = "SELECT * FROM exams where student_id='$password'";
$result = $conn->query($sql);
$i=1;
$moy=0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>".$row['course_id']."</td>
    <td>". $row['ds']."</td>
    <td>". $row['tp']."</td>
    <td>". $row['exam']."</td>
  </tr> ";

  $ds=$row['ds'];
  $tp=$row['tp'];
  $exam=$row['exam'];
  $moy+=$ds*0.2+$tp*0.3+$exam*0.5;
  $i=$i+1;
  }
} else {
  echo "<tr>
  <td>Not Ready Yet</td>
  </tr>";
}
if($i>1){
$moy=$moy/($i-1);
if ($moy>=10){

echo "</table><br><br><hr><br>";
echo "<span class='line'>";
echo"<p class='status' style=\"color:green;
pointer-events: none; margin-left:50px;\" 
 >Décision du jury: Admis  😊 | Moyenne: ".$moy;
}else{
    echo "</table><br><br><hr><br>";
    echo "<span class='line'>";
    echo "<p class='status'style=\"color:red;
    pointer-events: none; margin-left:50px; \">Décision du jury: Réfusée 😠 | Moyenne: ".$moy ;
}}
echo " </span>"
?>
</section>
</div><br><br><br><br>
<footer>
    <p>© Copyright 2022 Polytechnique Sousse. Tous droits réservés.</p>
</footer>
<script src="../enseignant/index.js"></script>
</body>
</html> 