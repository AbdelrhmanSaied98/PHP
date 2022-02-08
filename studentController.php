<?php
require('db.php');
require('student.php');
// add Student
$db = new db();
$connect = $db->getConnection();

if(isset($_POST['addStudent']))
{
    $newStudent = new student();
    $newStudent->fName = $_POST['fName'];
    $newStudent->lName = $_POST['lName'];
    $newStudent->address = $_POST['address'];
    $newStudent->gender = $_POST['gender'];
    $newStudent->username = $_POST['username'];
    $newStudent->password = $_POST['password'];
    $newStudent->department = $_POST['department'];
    $newStudent->img_name = $_FILES["img"]["name"];

    $imgExtension = pathinfo($_FILES["img"]["name"]);

    $allowExtensions = ["png","jpg"];
    if(in_array($imgExtension['extension'],$allowExtensions))
    {
        move_uploaded_file($_FILES["img"]["tmp_name"],"imgs/".$_FILES["img"]["name"]);
    }else
    {
        $newStudent->errors['img'] = "not allowed Extension";
    }
    
    if(count($newStudent->errors)>0)
    {
        $jsonError = json_encode($newStudent->errors);
        header("Location:addStudent.php?errors=$jsonError");
    }else
    {    
        try
        {
            $db->insert("Students","fName,lName,address,gender,department,username,password,img_name",$newStudent);

        }catch(PDOException $e)
        {
            echo $e->getMessage();
    
        }
        header("Location:list.php");
    }
    
    
}elseif(isset($_GET['delete']))
{
    $id = $_GET['id'];
    try
    {
        $db->delete("Students","id = '$id'");
        header("Location:list.php");

    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}elseif(isset($_GET['show']))
{
    $id = $_GET['id'];
    try
    {
        $data = $db->select("*","Students","id = '$id'");
        $studentData = $data->fetch(PDO::FETCH_ASSOC);
        $jsonData = json_encode($studentData);
        header("Location:show.php?data=$jsonData");

    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    
}elseif(isset($_GET['edit']))
{
    $id = $_GET['id'];
    try
    {
        $data = $db->select("*","Students","id = '$id'");
        $studentData = $data->fetch(PDO::FETCH_ASSOC);
        $jsonData = json_encode($studentData);
        header("Location:edit.php?data=$jsonData");

    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}elseif(isset($_GET['update']))
{
    $id = $_GET['id'];
    var_dump($_GET);

    $newStudent = new student();
    $newStudent->fName = $_GET['fName'];
    $newStudent->lName = $_GET['lName'];
    $newStudent->address = $_GET['address'];
    $newStudent->department = $_GET['department'];
    $newStudent->password = $_GET['password'];

    if(count($newStudent->errors)>0)
    {
        $jsonError = json_encode($newStudent->errors);
        header("Location:edit.php?id=$id&errors=$jsonError");
    }else
    {
        try
        {
        
            $updatedData = "fName = '$newStudent->fName',
            lName = '$newStudent->lName',
            address = '$newStudent->address',
            department = '$newStudent->department',
            password = '$newStudent->password'";

            $db->update("Students",$updatedData,"id = '$id'");
            header("Location:list.php");
        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    
    
}elseif(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data = $db->select("*","Students","username = '$username' and password = '$password'");
    if($data)
    {
        $studentData = $data->fetch(PDO::FETCH_ASSOC);
        setcookie("fName",$studentData['fName']);
        session_start();
        $_SESSION['password'] = $studentData['password'];
        header("Location:list.php");
    }else
    {
        header("Location:login.php");
    }
}
?>
