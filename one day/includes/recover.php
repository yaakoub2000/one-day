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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/note.png" type="image/png" sizes="18x18">
    <link rel="stylesheet" href="../styles/register.css"/>
    <title>Wrtie your diaries - articles safley</title>
<?php
    echo'
    
</head>
<section class="container">
    <form action="recover" method="post" class="recover_question user">
                <p style="background: var(--text_color_black);color: var(--text_color_white);padding: 10px;">hello '.$user["f_name"].'<br/>'. $user["secret_word_qst"].' </p><br>
                <div class="input-groupe" style="display: inline;">
                <input type="text" placeholder="write your secret word" name="secret_word" required><br/>
            </div><br>
            <button class="btn" name="answer">answer</button><br>
            ';
            ?>
            <?php
            function filter_info($input){
                $input = stripslashes(htmlspecialchars(trim(strtolower($input))));
                return $input;
            }
            $err_msg = "";
            if(isset($_POST['answer'])){
                $secret_word = filter_info($_POST['secret_word']);
                if(!empty($secret_word)){
                    if($secret_word == $user["secret_word"]){
                        header('location:newpass');
                    }else{
                        $err_msg = "wrong secret word !";
                    }
                    }else{
                        $err_msg = "please enter your secret word";
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