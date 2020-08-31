<?php
session_start();
include("includes/connection.php");
if(!isset($_SESSION['username'])){
    header("location:index");
}else{
    $getusername = $_SESSION['username'];
    $requser = $connect->prepare("SELECT * FROM users WHERE u_name = ?");
    $requser->execute(array($getusername));
    $user = $requser->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/note.png" type="image/png" sizes="18x18">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/all.min.css"/>
    <link rel="stylesheet" href="styles/preloader.css">
    <link class="dark_toggle" rel="stylesheet"/>
    <title>diaries</title>
</head>
<body style="background: var(--text_color_white);">
<!-- start website plugins -->
<div id="own-scroll-bar"></div>
    <div class="transition">
        <div class="box">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <div>one day</div>
        </div>
    </div>
    <!-- end website plugins -->
<?php
$err_msg ="";
    echo'
    <div id="own-scroll-bar"></div>
    <header id="hedear">
        <div class="logo"><span>One</span>&nbsp;Day</div>
        <nav>
            <ul>
                <li><a href="home?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="fa fa-home"></i>&nbsp;<span>Home</span></a></li>
                <li><a href="profile?'.$_SESSION['username']."-".$_SESSION['id'].'" class="active"><i class="far fa-user"></i>&nbsp;<span>Account</span></a></li>
                <li class="down_menu"><a><i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li class="dark_mode"><span id="dark_mode"><i id="dark-icon" class="fa fa-moon"></i></span></li>
                        <li><a href="settings?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="fas fa-cog"></i></a></li>
                        <li><a href="includes/logout"><i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="toggle-menu"><i class="fa fa-bars"></i></div>
    </header>
    <section class="container-diaries">
    ';
    ?>
    <?php
        if($user['number_diaries'] > 0){
                global $connect;
            $reqpost = $connect->prepare("SELECT * FROM notes WHERE u_id = ? ORDER by 1 DESC");
            $reqpost->execute(array($_SESSION['id']));
            
            while($post = $reqpost->fetch()){
                $post_title = substr($post['diarie_title'],0,10);
                $post_content = substr($post['diarie_text'],0,30);
                $post_id = $post['diarie_id'];
                $post_date = $post['diarie_date'];
                echo'
            <div class="box-diarie">
            <h2>'.$post_title.'</h2>
            <h3>'.$post_content.'</h3>
            <p>'.$post_date.'</p>
            <div class="btns">
                <a href="includes/delete_function?p_id='.$post_id.'"><button name="delete"><i style="color: red;" class="fas fa-trash"></i></button></a>
            </div>
        </div>
                 ';
            }
        }else{
            header('location:profile');
        }
        echo $err_msg;
    }
        ?>
        </section>
    <script src="app/main.js"></script>
    <script src="app/preloader.js"></script>
    <script src="app/darkmode.js"></script>
    <script>
        var parent = document.getElementsByClassName('container-diaries')[0];

        function number_of_childs(element){
            return element.childElementCount;
        }

     console.log(number_of_childs(parent));
    </script>
</body>
</html>