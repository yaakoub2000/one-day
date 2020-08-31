<?php
session_start();
include("connection.php");
if(!isset($_SESSION['username'])){
    header("location:index");
}else{
    $getusername = $_SESSION['username'];
    $requser = $connect->prepare("SELECT * FROM users WHERE u_name = ?");
    $requser->execute(array($getusername));
    $user = $requser->fetch();

    //post delete
    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];
        $delete_post = $connect->prepare("DELETE FROM notes WHERE diarie_id= ? ");
        $deleted = $delete_post->execute(array($post_id));
        // -1 on profile
        $new_num_notes = $user['number_diaries'] - 1;
                            $sql_req = $connect->prepare("UPDATE users SET number_diaries = ? WHERE id = ?");
                            $substr_number = $sql_req->execute(array($new_num_notes,$_SESSION['id']));
        if($deleted&&$substr_number){
            header('location:../diaries');
        }
    }
    //user account delete
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $delete_user = $connect->prepare("DELETE FROM users WHERE id= ? ");
        $deleted = $delete_user->execute(array($user_id));
        //delete post
        $u_delete_post = $connect->prepare("DELETE FROM notes WHERE u_id= ? ");
        $deleted_posts = $u_delete_post->execute(array($user_id));
        //delete profile picture
        $profile_pic = '../'.$user['user_logo'];
        if($old_logo !== "images/users_logos/default_male.jpg" && $old_logo !== "images/users_logos/default_female.jpg"){
        unlink($profile_pic);
        }
        if($deleted&&$deleted_posts){
            header('location:logout');
        }
    }
}
?>