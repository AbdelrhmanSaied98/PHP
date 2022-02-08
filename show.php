<?php 
$jsonData = $_GET['data'];
$studentData = json_decode($jsonData,true);
if(isset($_COOKIE['fName']))
{
    echo "<h2>Welcome {$_COOKIE['fName']}</h2>";
}else
{
    header("Location:login.php");
}
?>
<html>
    <body>
        <a href="list.php">Back</a>
        <ul>
            <li><?= $studentData['id']?></li>
            <li><?= $studentData['fName']?></li>
            <li><?= $studentData['lName']?></li>
            <li><?= $studentData['address']?></li>
            <li><?= $studentData['gender']?></li>
            <li><?= $studentData['department']?></li>
            <li><?= $studentData['username']?></li>
        </ul>
    </body>
</html>