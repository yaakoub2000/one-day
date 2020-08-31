<?php
include("connection.php");
//secure information function
//global vars
$err_msg = "";
function filter_info_login($input){
    $input = stripslashes(htmlspecialchars(trim($input)));
    return $input;
}
//secure information function
    if(isset($_POST['sign_in'])){
        $email_connect = filter_info_login($_POST['u_name']);
        $pass_connect = filter_info_login($_POST['u_pass']);

        if($email_connect&&$pass_connect){
            
            $request = $connect->prepare("SELECT * FROM users WHERE u_name = ?");
            $request->execute(array($email_connect));
            $userexist = $request->rowCount();
            if($userexist == 1){
                    $user = $request->fetch();
                if(password_verify($pass_connect,$user['user_pass'])){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['u_name'];
                    header("Location: profile?".$_SESSION['username']."-".$_SESSION['id']);
                    
                }else{
                    $err_msg = "please check your password";
                }
            }else{
                $err_msg = "please check your username";
            }
        }else{
            $err_msg = "please fill up all the Fields";
        }
        echo $err_msg;
    }
?>