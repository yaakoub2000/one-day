<?php
session_start();
include("connection.php");
if(!isset($_SESSION['email'])){
    header("location:../index");
}else{
    $getemail = $_SESSION['email'];
    $requser = $connect->prepare("SELECT * FROM users WHERE user_email = ?");
    $requser->execute(array($getemail));
    $user = $requser->fetch();

?>
<?php
    echo'
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/note.png" type="image/png" sizes="18x18">
    <link rel="stylesheet" href="../styles/register.css"/>
    <title>Wrtie your diaries - articles safley</title>
</head>
<section class="container">
    <form action="newpass" method="post" class="recover_question user">
                <p style="background: var(--text_color_black);color: var(--text_color_white);padding: 10px;">enter a new password now</p><br>
                <div class="input-groupe">
                    <i class="fa fa-key"></i>
                    <input type="text" placeholder="new password" name="newpass" required>
                </div>
                <div class="input-groupe">
                    <i class="fa fa-key"></i>
                    <input type="text" placeholder="repeat new password" name="newpass_repeat" required>
                </div><br>
            <button class="btn" name="change">change</button><br>
            ';
            ?>
            <?php
            $err_msg ="";
            function filter_info($input){
                $input = stripslashes(htmlspecialchars(trim(strtolower($input))));
                return $input;
            }
            if(isset($_POST['change'])){
                $password = filter_info($_POST['newpass']);
                $password_repeat = filter_info($_POST['newpass_repeat']);
                if($password&&$password_repeat){
                    if($password == $password_repeat){
                        if(strlen($password)>=8){
                            $password = password_hash($password,PASSWORD_DEFAULT);
                            $sql_req = $connect->prepare("UPDATE users SET user_pass = ?  WHERE user_email = ?");
                            $sql_req->execute(array($password,$_SESSION['email']));
                            echo '<script>localStorage.setItem("recover","false");</script>';
                            header('Refresh: 1; URL=logout');
                        }else{
                            $err_msg = "Your new password must be at least 8 characters";
                        }
                    }else{
                        $err_msg = "new Password and repeat password must be the same";
                    }
                }else{
                    $err_msg = "please fill up all the Fields";
                }
            }
            echo $err_msg;
            
                ?>
                <?php
            echo '
            </form>
            </section>
        ';
        }?>