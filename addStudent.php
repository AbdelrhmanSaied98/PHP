<?php
if(isset($_GET['errors']))
{
    $errors = json_decode($_GET['errors'],true);
}
?>

<html>
<body>
    <form method="post" enctype="multipart/form-data" action="studentController.php">
        <label> Frist Name</label>
        <input name="fName" type="text">
        <?php
        if(isset($errors['fName']))
        {
            echo "***".$errors['fName'];
        }
        ?>
        <br>
        <br>

        <label> Last Name</label>
        <input name="lName" type="text">
        <?php
        if(isset($errors['lName']))
        {
            echo "***".$errors['lName'];
        }
        ?>
        <br>
        <br>

        <label>address</label>

        <textarea name="address">
        </textarea>
        <br>
        <br>

        <label> Country</label>
        <select name="country">
            <option value="Alex">Alex</option>
            <option value="Cairo">Cairo</option>
            <option value="Giza">Giza</option>
            <option value="Isamila">Isamila</option>
        </select>
        <br>
        <br>

        <label> Gender</label>
        <input type="radio" name="gender" value="Male">
        <label>Male</label>
        <input type="radio" name="gender" value="Female">
        <label>Female</label>
        <br>
        <br>

        <label> Skills </label>
        <input type="checkbox" name="php">
        <label>PHP</label>
        <input type="checkbox" name="J2SE">
        <label>J2SE</label>
        <br>
        <input type="checkbox" name="MySQL" >
        <label>MySQL</label>
        <input type="checkbox" name="PostgreeSQL" >
        <label>PostgreeSQL</label>
        <br>
        <br>

        <label> User Name</label>
        <input name="username" type="text">
        <?php
        if(isset($errors['username']))
        {
            echo "***".$errors['username'];
        }
        ?>
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

        <label> Department</label>
        <input name="department" type="text" value="OpenSource">
        <br>
        <br>

        <?php
            $random_hash = substr(md5(uniqid(rand())), 5, 5);
            echo $random_hash;
        ?>
        <br>
        <input type="text" pattern= <?= $random_hash;?> >
        <br>

        <input name = "img" type="file">
        <?php
        if(isset($errors['img']))
        {
            echo "***".$errors['img'];
        }
        ?>
        <br>

        <input name = "addStudent" type="submit">

    </form>
</body>

</html>