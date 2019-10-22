<?php
    if(isset($_POST['signup-submit']))
    {
        require 'db.php';
        $username = $_POST['user_name'];
        $email = $_POST['user_email'];
        $password = $_POST['user_pwd'];
        $passwordconf = $_POST['user_pwdconf'];

        if (empty($username) || empty($email) || empty($password) || empty($passwordconf))
        {
            header("Location:../signup.php?error=emptyField&user_name=".$username."&user_email=".$email);
            exit();
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username))
        {
            header("Location: ../signup.php?error=invaliduser_mailuser_name");
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            header("Location: ../signup.php?error=invaliduser_mail&user_name=".$username);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9]*$/",$username))
        {
            header("Location: ../signup.php?error=invaliduser_name&user_email=".$email);
            exit();
        }
        else if($password !== $passwordconf)
        {
            header("Location: ../signup.php?error=passwordcheck&user_name=".$username."&user_email=".$email);
            exit();
        }
        else
        {
            $sql = "SELECT user_name FROM users WHERE user_name = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql))
            {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt,"s",$username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $result = mysqli_stmt_num_rows($stmt);
                if($result > 0)
                {
                    header("Location: ../signup.php?error=usertaken&mail=".$email);
                    exit();
                }
                else
                {
                    $sql = "INSERT INTO users (user_name, user_email,user_pwd) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql))
                    {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
                        mysqli_stmt_bind_param($stmt, "sss",$username,$email,$hashedpwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?signup=suuccess");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else
    {
        header("Location: ../signup.php");
        exit();
    }
?>