<?php
require "config/database.php";
session_start();
if (!$_SESSION['user_name'] && !$_SESSION['user_id'] && !$_SESSION['user_email'] )
{
    header('Location:index.php');
}
$userdata = NULL;
if (isset($_POST['update']))
{
    $username = $_POST['user_name'];
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $country    = $_POST['country'];
    $city       = $_POST['city']; 
    $usermail = $_POST['user_email'];
    $mailreciver = $_POST['receive_email'];
    echo $usermail;
    $user_id = $_SESSION['user_id'];
    try{
        $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE `users` SET `user_name` = '$username', firstname = '$firstname', lastname = '$lastname', country = '$country', city = '$city',receive_email = '$mailreciver',
        user_email ='$usermail' WHERE user_id = ?";
        $sql = $conn->prepare($query);
      /*  $sql = $conn->prepare("UPDATE `users` SET `user_name` = '$username', firstname = '$firstname', lastname = '$lastname', country = '$country',
         city = '$city',receive_email = '$mailreciver', user_mail ='$usermail'
         WHERE user_email = :user_email");*/
        $sql->bindParam(1, $user_id);
        $sql->execute();
        if ($sql->rowCount())
            header("Location: userprofile.php");
        if (!$sql)
        {
            print_r ($conn->errorInfo());
        }
        else
        {
            // echo "executedd";
           // if (isset($_POST['check']) && ($_POST['check'] == 'Yes'))
           // {
                echo "Profile Updated";
           // }
        }
    }
    catch(PDOException $e)
    {
        echo " Error".$e->getMessage();
    }
}

//     if (isset($_SESSION['user_name']))
//         {
//             echo "check ->" . $_SESSION['user_name']. $_SESSION['user_id'] ;
//             //  $userdata = getuserdata(getid($_SESSION['user_name']));
//             // $userdata = getuserdata("mali");
//         }
 ?>