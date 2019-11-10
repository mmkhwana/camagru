<?php
require "config.database";
session_start();
if (isset($_SESSION['user_name']))
{
    if(isset($_POST['like']))
    {
        $like = 0;
        
    }
}
?>