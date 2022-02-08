<?php 
$jsonData = $_GET['data'];
$studentData = json_decode($jsonData,true);
if($studentData)
{
    setcookie("id",$studentData['id']);
}else
{
    $studentData['id'] = $_COOKIE['id'];
}
if(isset($_COOKIE['fName']))
{
    echo "<h2>Welcome {$_COOKIE['fName']}</h2>";
    if(isset($_GET['errors']))
    {
        $errors = json_decode($_GET['errors'],true);
    }
}else
{
    header("Location:login.php");
}
?>



<html>
<body>
    <form method="get" action="studentController.php">
    <input name="id" value="<?= $studentData['id'] ?>" type="hidden">
        <label> Frist Name</label>
        <input name="fName" value="<?= $studentData['fName'] ?>" type="text">
        <?php
        if(isset($errors['fName']))
        {
            echo "***".$errors['fName'];
        }
        ?>
        <br>
        <br>

        <label> Last Name</label>
        <input name="lName" value="<?= $studentData['lName'] ?>" type="text">
        <?php
        if(isset($errors['lName']))
        {
            echo "***".$errors['lName'];
        }
        ?>
        <br>
        <br>

        <label>address</label>

        <textarea name="address"><?= $studentData['address'] ?>
        </textarea>
        <br>
        <br>


        <label> Department</label>
        <input name="department" type="text" value="OpenSource">
        <br>
        <br>

        <label> Password</label>
        <input name="password" type="password">
        <?php
        if(isset($errors['password']))
        {
            echo "***".$errors['password'];
        }
        ?>
        <br>
        <br>

        <?php
            $random_hash = substr(md5(uniqid(rand())), 5, 5);
            echo $random_hash;
        ?>
        <br>
        <input type="text" pattern= <?= $random_hash;?> required>
        <br>

        <input name = "update" type="submit" value="Udate Data">
        

    </form>
</body>

</html>