<?php
require_once "config/database.php";
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/cam.css">
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
        <title>camagru</title> 
    </head>
<header>
    <div class = "navbar">
        <h1 class="active" href = "main.php">CAMAGRU</h1>
        <?php
            if (isset($_SESSION['user_name']) && isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
            {
                echo "<a href = 'main.php'>My timeline</a>";
                echo "<a href = 'userprofile.php'>Edit Profile</a>";       
                echo "<a href = 'signout.php'>Sign Out</a>";
            }else
            {
                echo "<a href = 'signup.php'>Sign in</a>";

            }
        ?>
    </div>
</header>
<body>
    <div class = "container">
    <?php
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 5;
    $offset = ($pageno-1) * $no_of_records_per_page; 
    $stmt = $conn->prepare("SELECT * FROM `images`"); 
    $stmt->execute();
    $total_rows  = $stmt->rowCount();
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $stmt1 = $conn->prepare("SELECT * FROM `images` GROUP BY img_id  LIMIT $offset, $no_of_records_per_page"); 
    $stmt1->execute();
    if ($stmt1 === false){                                            
        $error = "NO POSTS YET...ADD SOMETHING.";
    }else{ 
        foreach ($stmt1 as $row) {
            echo    "<div class = 'gallery'>";
            echo    "<img src='".$row['img_dir']."' alt='image' width = '300px' height = '300px'>";

            echo    "<form action = like.php method = 'post'><div class = 'like_'><button type = 'submit' name = 'like'>like</button></div></form>";
            echo    "<form action = comment.php method = 'post'><div class = 'comment_'><button type = 'submit' name = 'comment'>comment</button></div></form>";
            echo    "</div>";
            
        }
    }
    ?>
    <div class = "bottom-div">
    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo 'index.php'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo 'index.php'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
    </div>
    </div> 
</body>
</html>