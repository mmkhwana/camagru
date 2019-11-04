<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config/database.php";

function getuserdata($userid)
{
    $conn = $GLOBALS['conn'];
    try{
        $array = array();
        $stmt = $conn->prepare("SELECT `*` FROM `users` WHERE `user_id` = :$userid");
        $stmt->bindvalue(':user_id', $userid);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        while ($value)
        {
            $array['user_id'] = $value['user_id'];
            $array['user_name'] = $value['user_name'];
            $array['firstname'] = $value['firstname'];
            $array['lastname'] = $value['lastname'];
            $array['user_email'] = $value['user_email'];
            $array['country'] = $value['country'];
            $array['city'] = $value['city'];
            $array['about_me'] = $value['about_me'];
        }
    } catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    return $array;
}
function getid($username)
{
    try
    {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare("SELECT `user_id` FROM `users` WHERE `user_name` = :$username");
        $stmt->bindvalue(':user_name', $username);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        while ($value)
        {
            return $value['user_id'];
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}