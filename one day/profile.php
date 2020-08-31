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
    <title>profile</title>
</head>
<body>
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
    <header>
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
    <section class="container-profile">
        <div class="profila-pic">
            <img src="'.$user['user_logo'].'" alt="profile-picture">
            <form method="post" action="profile" enctype="multipart/form-data">
                <label class="over" for="file-logo"><i id="profile-camera" class="fa fa-camera"></i><input id="file-logo" type="file" name="u_logo" size="60" accept="image/*"/></label>
                <button class="btn" name="update_logo">update</button>
                ';
                    if(isset($_POST['update_logo'])){
                        if(isset($_FILES['u_logo']) AND !empty($_FILES['u_logo']['name'])){
                            $old_logo = $user['user_logo'];
                            $max_size = 4000000;
                            $accepted_extentions = array('jpg','jpeg','png','gif');
                            if($_FILES['u_logo']['size'] <= $max_size){
                                $extention_uploaded = strtolower(substr(strrchr($_FILES['u_logo']['name'],"."),1));
                                if(in_array($extention_uploaded,$accepted_extentions)){
                                    if($old_logo !== "images/users_logos/default_male.jpg" && $old_logo !== "images/users_logos/default_female.jpg"){
                                    unlink($old_logo);
                                }

                                    $path = "images/avatars/".$_SESSION['id'].".".$extention_uploaded;
                                    $result = move_uploaded_file($_FILES['u_logo']['tmp_name'],$path);
                                    if($result){
                                        $logo = $path.$_SESSION['id'].$_FILES['u_logo']['name'];
                                        $reqlogo = $connect->prepare("UPDATE users SET user_logo = ? WHERE id = ?");
                                        $reqlogo->execute(array($path,$_SESSION['id']));
                                        header("Refresh:1");
                                    }else{
                                        $err_msg = "Error while uploading the image";
                                    }
                                }else{
                                    $err_msg = "accepted formats : jpg - jpeg - png - gif";
                                }
                            }else{
                                $err_msg = "image size must be less then ".$max_size."octet";
                            }
                        }else{
                            $err_msg = "please select an image";
                        }
                    }
                echo '
                
            </form>
        </div>
         <h2 id="username"> '.$getusername.' </h2>
        <div class="box-profile">
            <div class="left_side">
                <div class="bio">
                    <h2>Bio</h2><br>
                    <p>'.$user['user_bio'].'</p>
                </div>
                <div class="info">
                    <p>full name :<span>'.$user['f_name']." ".$user['l_name'].'</span></p>
                    <p>email :<span>'.$user['user_email'].'</span></p>
                </div>
            </div>
            <div class="writen">
                <h2>writen</h2><br>
                <a href="diaries?'.$_SESSION['username']."-".$_SESSION['id'].'"><p>diaries <span>'.$user['number_diaries'].'</span></p></a>
            </div>
        </div>
        </section>
        ';
        }
        echo '<span class="errmsg">'.$err_msg.'<span>';
        ?>
    <script src="app/main.js"></script>
    <script src="app/preloader.js"></script>
    <script src="app/darkmode.js"></script>
    <script>
        //  start profile
        var profile_over = document.getElementsByClassName('over')[0],
              profile_camera = document.getElementById('profile-camera');
          profile_over.addEventListener("mouseover",()=>{
            profile_camera.style.display = "flex";
          });
          profile_over.addEventListener("mouseleave",()=>{
            profile_camera.style.display = "none";
          });
      //  end profile
    </script>
</body>
</html>