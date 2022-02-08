<?php
require_once('db.php');
$db = new db();
class student
{
    private $fName;
    private $lName;
    private $address;
    private $gender;
    private $username;
    private $password;
    private $department;
    private $img_name;
    public $errors = [];

    
    
    function __set($name, $value)
    {
        $value = $this->validations($value);
        //fName
        if($name == "fName")
        {
            if(strlen($value)<3)
            {
                $this->errors['fName'] = "Frist name must be more than 3 characters";
            }
        // lName
        }elseif($name == "lName")
        {
            if(strlen($value)<3)
            {
                $this->errors['lName'] = "Last name must be more than 3 characters";
            }
        // userName
        }elseif($name == "username")
        {
            if(strlen($value)<3)
            {
                $this->errors['username'] = "username must be more than 3 characters";
            }elseif(!$this->checkUserName($value))
            {
                $this->errors['username'] = "username is Taken";
            }
        //password
        }elseif($name == "password")
        {
            if(strlen($value)<6)
            {
                $this->errors['password'] = "password must be more than 6 characters";
            }
        }

        if(count($this->errors) == 0)
        {
            $this->$name = $value;
        }
    }
    function __get($name)
    {
        return $this->$name;
    }

    function validations($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return($data);
    }
    function checkUserName($newUsername)
    {
        $data = $GLOBALS['db']->select("*","Students","username = '$newUsername'");
        $count = $data->rowCount();
        if($count == 0)
        {
            return true;
        }else
        {
            return false;
        }
    }

}

?>