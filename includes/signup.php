<?php
include('connection.php');
//global vars
$err_msg = "";
    //secure information function
    function filter_info($input){
        $input = stripslashes(htmlspecialchars(trim($input)));
        return $input;
    }

    if(isset($_POST['sign_up'])){
        $firstname = "";
        $lastname = "";
        $username = filter_info(strtolower($_POST['u_username']));
        $email = filter_info($_POST['u_email']);
        $password = filter_info($_POST['u_password']);
        $repeatpassword = filter_info($_POST['repeatpassword']);
        $gender = filter_info(strtolower($_POST['u_gender']));
        $u_age_day = filter_info(intval($_POST['u_age_day']));
        $u_age_month = filter_info(intval($_POST['u_age_month']));
        $u_age_year = filter_info(intval($_POST['u_age_year']));
        $birth_date = $u_age_day."-".$u_age_month."-".$u_age_year;
        $bio = "welcome from one day";
        $objective = "edit your objective from settings";
        $phone = "";
        $num_diaries = "";
        if($gender == 'male'){
            $profile_pic = "images/users_logos/default_male.jpg";
        }else{
            $profile_pic = "images/users_logos/default_female.jpg";
        }
        $reg_date = date("Y-m-d");
        //conditions
        if($username&&$email&&$password&&$repeatpassword&&$birth_date&&$gender){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                if($password == $repeatpassword){
                    if(strlen($password)>=8){
                        // start already information exist
                            //username
                        $req_user = $connect->prepare("SELECT * FROM users WHERE u_name = ?");
                        $req_user->execute(array($username));
                        $user_exist = $req_user->rowCount();
                            //email
                        $req_mail = $connect->prepare("SELECT * FROM users WHERE user_email = ?");
                        $req_mail->execute(array($email));
                        $email_exist = $req_mail->rowCount();
                        // end already information exist
                        if($email_exist == 0){
                            if($user_exist == 0){
                            $password = password_hash($password,PASSWORD_DEFAULT);

                            $sql_req = $connect->prepare("INSERT INTO users(f_name,l_name,u_name,user_email,user_pass,user_gender,user_age,user_logo,user_reg_date,objective,user_bio,u_phone,number_diaries) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            $sql_req->execute(array($firstname,$lastname,$username,$email,$password,$gender,$birth_date,$profile_pic,$reg_date,$objective,$bio,$phone,$num_diaries));
                            echo "<script>localStorage.setItem('sign','true');</script>";
                            }else{
                                $err_msg = "username already exist";
                            }
                        }else{
                            $err_msg = "your email already exist";
                        }
                    }else{
                        $err_msg = "Your password must be at least 8 characters";
                    }
                }else{
                    $err_msg = "Passwords must be the same";
                }
            }else{
                $err_msg = "please Enter a validate email";
            }
        }else{
            $err_msg = "please fill up all the Fields";
        }
        echo $err_msg;
    }

?>
