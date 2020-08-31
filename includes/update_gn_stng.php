<?php
include("connection.php");
//global vars
$err_msg = "";
//secure information function
function filter_info_update($input){
    $input = stripslashes(htmlspecialchars(trim(strtolower($input))));
    return $input;
}
if(isset($_SESSION['username'])){
if(isset($_POST['update_general'])){

    $first_name = filter_info_update($_POST['f_name']);
    $last_name = filter_info_update($_POST['l_name']);
    $phone = filter_info_update($_POST['u_phone']);
    $user_name = filter_info_update($_POST['new_username']);
    $country = filter_info_update($_POST['u_country']);
    $objective = filter_info_update($_POST['objective']);
    $u_bio = filter_info_update($_POST['u_bio']);

    if($first_name&&$last_name&&$phone&&$user_name&&$country&&$objective&&$u_bio){
        if($_SESSION['username'] == $user_name){
            $sql_req = $connect->prepare("UPDATE users SET f_name = ? ,l_name = ?,country = ? ,u_phone = ?,objective = ?,user_bio = ?  WHERE id = ?");
            $sql_req->execute(array($first_name,$last_name,$country,$phone,$objective,$u_bio,$_SESSION['id']));
            // echo "<script>document.getElementById('logout').click();</script>";
        }else{
        $req_user = $connect->prepare("SELECT * FROM users WHERE u_name = ?");
        $req_user->execute(array($user_name));
        $user_exist = $req_user->rowCount();
        if($user_exist == 0){
            $sql_req = $connect->prepare("UPDATE users SET u_name = ? WHERE id = ?");
            $sql_req->execute(array($user_name,$_SESSION['id']));
            $sql_requ_otherinfo = $connect->prepare("UPDATE users SET f_name = ? ,l_name = ?,country = ? ,u_phone = ?,objective = ?,user_bio = ?  WHERE id = ?");
            $sql_requ_otherinfo->execute(array($first_name,$last_name,$country,$phone,$objective,$u_bio,$_SESSION['id']));
            echo "<script>document.getElementById('logout').click();</script>";
            
        }else{
        $err_msg = "username already exist";       
        }
        }
    }else{
        $err_msg = "please fill up all the Fields";
    }
}

        echo $err_msg;
}else{
    header('location:../index');
}
?>