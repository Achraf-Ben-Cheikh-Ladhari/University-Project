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
    <title>Enseignant | Affiche note</title>
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
    <li><a href="./enseignant.php"><img src="../../image/backb.png" class="icon">&nbsp;<STRONG>Arriére</STRONG></a></li>
    <li><a href="../logout.php"><img src="../../image/logout.png" class="icon">&nbsp;<STRONG>Log Out </STRONG></a></li>
</ul>
</div>

<i class="fas fa-bars bar"></i>
</div>

<h3 class="aff">Affichage des notes de 
<?php        
$password=$_SESSION['pass'];
$affiche="select name from courses where mat_prof like '$password'";
$aff= $conn->query($affiche);
    while($row1 = mysqli_fetch_array($aff)){
       $cid= $row1['name'];
    } 
echo $cid ?></h2>
<table>
  <tr>
    <th>Matricule de l'étudiant</th>
    <th>Ds</th>
    <th>Tp</th>
    <th>Examen</th>
  </tr>
    <?php
        $password=$_SESSION['pass'];
        $affiche="select name from courses where mat_prof like '$password'";
        $aff= $conn->query($affiche);
            while($row1 = mysqli_fetch_array($aff)){
               $cid= $row1['name'];
            }
$sql = "SELECT * FROM exams where course_id='$cid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>".$row['student_id']."</td>
    <td>". $row['ds']."</td>
    <td>". $row['tp']."</td>
    <td>". $row['exam']."</td>
  </tr> ";
  }
} else {
  echo "0 results";
}
echo "</table>";
?>

    </div><br><br><br><br>
    <footer>
        <p>© Copyright 2022 Polytechnique Sousse. Tous droits réservés.</p>
</footer>
<script src="index.js"></script>
</body>
</html> 