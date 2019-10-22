<?php
if (isset($_POST['signin-submit']))
{
    require "db.php";
    $mailuser = $_POST['user_email'];
    $password = $_POST['user_pwd'];

    if (empty($mailuser) || empty($password))
    {
        header("Location:../signin.php?erro=emptyfields");
        exit();
    }
    else
    {
        //$sql = "SELECT * FROM user WHERE user_email = ?";
        $sql = "SELECT * FROM 'user' WHERE 'user_email'='".$mailuser."'";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location:../signin.php?erro=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s",$mailuser);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_stmt_fetch_assoc($result))
            {
                $hashed = $row["user_pwd"];
                if (!password_verify($password, $hashed))
                {
                    header("Location:../signin.php?erro=wrongpwd");
                    exit();
                }
                else
                {
                    session_start();
                    $_SESSION["userId"] = $row["user_id"];
                    $_SESSION["userName"] = $row["user_name"];
                    header("Location:../signin.php?signin=success");
                    exit();
                }
            }
            else
            {
                header("Location:../signin.php?erro=nouser");
                exit();
            }
        }
    }
}
else
{
    header("Location:../signin.php");
    exit();
}
?>
