<?php
include("connection.php");
//global vars
$err_msg = "";
//secure information function
if(isset($_SESSION['username'])){
if(isset($_POST['secure_update'])){

    $secret_question = filter_info_update($_POST['u_secret_question']);
    $secret_word = filter_info_update($_POST['u_secret_word']);
    $old_pass = filter_info_update($_POST['old_pass']);
    $new_pass = filter_info_update($_POST['new_pass']);
    $new_pass_repeat = filter_info_update($_POST['new_pass_repeat']);
//fetch info
    $getusername = $_SESSION['username'];
    $requser = $connect->prepare("SELECT * FROM users WHERE u_name = ?");
    $requser->execute(array($getusername));
    $user = $requser->fetch();

    if($secret_question&&$secret_word){
            $sql_req = $connect->prepare("UPDATE users SET secret_word_qst = ? ,secret_word = ?  WHERE id = ?");
            $sql_req->execute(array($secret_question,$secret_word,$_SESSION['id']));
            // echo "<script>document.getElementById('logout').click();</script>";
    }else{
        $err_msg = "please fill up all the Fields";
    }
    //check passwords
    if($old_pass||$new_pass||$new_pass_repeat){
        if($old_pass&&$new_pass&&$new_pass_repeat){
            if(password_verify($old_pass,$user['user_pass'])){
                if($new_pass == $new_pass_repeat){
                    if(strlen($new_pass)>=8){
                        $new_pass = password_hash($new_pass,PASSWORD_DEFAULT);
                        $sql_req = $connect->prepare("UPDATE users SET user_pass = ?  WHERE id = ?");
                        $sql_req->execute(array($new_pass,$_SESSION['id']));
                    }else{
                        $err_msg = "Your new password must be at least 8 characters";
                    }
                }else{
                    $err_msg = "new Password and repeat password must be the same";
                }
            }else{
                $err_msg = "please check your old password";
            }
        }else{
            $err_msg = "please fill up all the Fields";
        }
    }
}
        echo $err_msg;
}else{
    header('location:index');
}
?>


<!-- if($old_pass&&$new_pass&&$new_pass_repeat){
            if(password_verify($old_pass,$user['user_pass'])){
                $request = $connect->prepare("SELECT * FROM users WHERE user_pass = ? AND id = ?");
                $request->execute(array(password_verify($old_pass,$user['user_pass']),$_SESSION['id']));
                $passwordexist = $request->rowCount();
                if($passwordexist == 1){
                    echo "kml kml sahit";
            }else{
                $err_msg = "please check your old password";
                }
        }else{
            $err_msg = "please fill up all the Fields";
        } -->