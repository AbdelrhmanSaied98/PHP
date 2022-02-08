<html>
<body>
<?php
session_start();
    if(isset($_COOKIE['fName']))
    {
        echo "<h2>Welcome {$_COOKIE['fName']}</h2>";
        echo "<h2>Welcome {$_SESSION['password']}</h2>";
    }else
    {
        header("Location:login.php");
    }
    ?>
    <table style="border: 1px solid black;width:100%">
    <tr>
        <th style='border: 1px solid black;'>ID</th>
        <th style='border: 1px solid black;'>Frist Name</th>
        <th style='border: 1px solid black;'>Second Name</th>
        <th style='border: 1px solid black;'>Address</th>
        <th style='border: 1px solid black;'>Gender</th>
        <th style='border: 1px solid black;'>Department</th>
        <th style='border: 1px solid black;'>UserName</th>
        <th style='border: 1px solid black;'>Imgae Name</th>
    </tr>
<?php

try
{
    $connect = new PDO("mysql:host=localhost;dbname=PHP","root","");
    $data = $connect->query("select * from Students");
    while($raw = $data->fetch(PDO::FETCH_ASSOC))
    {
        echo "<tr>";
        foreach($raw as $key => $value)
        {
            if($key != 'password')
            {
                echo "<td style='border: 1px solid black;' >$value</td>";
            }
            
        }
        echo "<td><a href='studentController.php?id={$raw['id']}&show'>Show</a></td>";
        echo "<td><a href='studentController.php?id={$raw['id']}&edit'>Edit</a></td>";
        echo "<td><a href='studentController.php?id={$raw['id']}&delete'>Delete</a></td>";
        echo "<tr>";
    }

}catch(PDOException $e)
{
    echo $e->getMessage();
}
$connect = null;

?>
</table>
</body>
</html>