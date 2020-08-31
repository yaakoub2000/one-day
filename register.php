<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: profile?".$_SESSION['username']."-".$_SESSION['id']);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/note.png" type="image/png" sizes="18x18">
    <link rel="stylesheet" href="styles/all.min.css"/>
    <link rel="stylesheet" href="styles/preloader.css">
    <link rel="stylesheet" href="styles/register.css"/>
    <title>Wrtie your diaries - articles safley</title>
</head>
<style>
    .container .recover_acc{
    position: relative;
    display:none;
}
.container .recover_acc i{
    position: absolute;
    top: 3%;
    right: 3%;
    font-size: 25px;
    cursor: pointer;
}
.container .recover_question{
    position: relative;
    display:none;
}
.container .user #subtext{
    cursor: pointer;
}
</style>
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
    <!-- start section  ------------------------------------------------------------------------------------>
<section class="container">
    <div class="animated-box">
        <div class="bx-s-in bx-left-pos bx-s">
            <h2>one of us ?</h2>
            <button id="btn-s-in" class="btn btn-anim-page">sign in</button>
        </div>
        <div class="bx-s-up bx-left-neg bx-s">
            <h2>new here ?</h2>
            <button id="btn-s-up" class="btn btn-anim-page">sign up</button>
        </div>
    </div>
    <form  action="register" method="post" class="sign-in user">
        <div class="box-sign-in">
                <h2>sign in</h2>
            <div class="input-groupe">
                <i class="fa fa-user"></i>
                <input type="text" placeholder="username" name="u_name" required>
            </div>
            <div class="input-groupe">
                <i class="fa fa-key"></i>
                <input type="password" placeholder="Password" name="u_pass" required>
            </div>
            <button class="btn" name="sign_in">Sign in</button>
            <p id="subtext" class="subtext"><a>Forgot username or password ?</a></p>
        </div>
        <?php include("includes/signin.php"); ?>
    </form>
    <form action="register" method="post" class="sign-up user">
        <div class="box-sign-up">
            <h2>sign up</h2>
        <div class="input-groupe">
            <i class="fa fa-user"></i>
            <input type="text" placeholder="username" name="u_username" required>
        </div>
        <div class="input-groupe">
            <i class="fa fa-envelope"></i>
            <input type="email" placeholder="Email address" name="u_email" required>
        </div>
        <div class="input-groupe">
            <i class="fa fa-key"></i>
            <input type="password" placeholder="Password" name="u_password" required>
        </div>
        <div class="input-groupe">
            <i class="fa fa-key"></i>
            <input type="password" placeholder="Password Repeat" name="repeatpassword" required>
        </div>
        <div class="input-groupe">
        <i class="fas fa-male"></i>
            <select name="u_gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="input-groupe">
            <i class="fas fa-calendar-alt"></i>
            <div class="age">
            <?php
            echo "<select class='age_select' name='u_age_day' required>";
            for($day = 1;$day <=31 ;$day++){
                if($day == 30){
                    echo '<option selected="1" value="'.$day.'">'.$day.'</option>';
                }else echo '<option value="'.$day.'">'.$day.'</option>';
            }
            echo "</select>";
            echo "<select class='age_select' name='u_age_month' required>";
            for($month = 1;$month <=12 ;$month++){
                if($month == 10){
                    echo '<option selected="1" value="'.$month.'">'.$month.'</option>';
                }else echo '<option value="'.$month.'">'.$month.'</option>';
            }
            echo "</select>";
            echo "<select class='age_select' name='u_age_year' required>";
            for($year = 1921;$year <=2015 ;$year++){
                if($year == 2000){
                    echo '<option selected="1" value="'.$year.'">'.$year.'</option>';
                }else echo '<option value="'.$year.'">'.$year.'</option>';
            }
            echo "</select>";
            ?>
            </div>
            <!-- <input type="date" min="1921-01-01" name="u_age" required> -->
        </div>
        <button class="btn" name="sign_up">Sin up</button>
        </div>
        <?php include("includes/signup.php"); ?>
    </form>
    <!-- recover form -->
    <form action="register" method="post" class="recover_acc user">
        <i class="fas fa-times close_bx"></i>
        <div id="recover-box" class="recover-box">
                <h2>recover account</h2><br>
                <p style="background: var(--text_color_black);color: var(--text_color_white);padding: 10px;">Search for your account by email</p><br>
            <div class="input-groupe" style="display: inline;">
                <input type="email" placeholder="write your email address" name="rec_email" required>
            </div><br>
            <button class="btn" name="search">Search</button>
        </div><br>
        <?php
         $err_msg = "";
            if(isset($_POST['search'])){
                $email_recover = filter_info_login($_POST['rec_email']);
                if(!empty($email_recover)){
                    $request = $connect->prepare("SELECT * FROM users WHERE user_email = ?");
                        $request->execute(array($email_recover));
                        $userexist = $request->rowCount();
                        if($userexist == 1){
                            $user = $request->fetch();
                            $_SESSION['email'] = $user['user_email'];
                            echo "<script>window.location.href = 'includes/recover';</script>";
                        }else{
                            $err_msg = "please enter a valid email";
                        }
                }else{
                    $err_msg = "please enter your email";
                }
                echo $err_msg;
                }?>
    </form>
    <img class="back-img" src="images/background.jpg" alt="background">
</section>
        <!-- end section  ------------------------------------------------------------------------------------>
        <script src="app/preloader.js"></script>
<script>
        var sign_in = localStorage.getItem('sign');
    const btn_sign_in = document.getElementById('btn-s-in'),
          bx_sign_in = document.getElementsByClassName('bx-s-in')[0],
          btn_sign_up = document.getElementById('btn-s-up'),
          bx_sign_up = document.getElementsByClassName('bx-s-up')[0],
          animated_box = document.getElementsByClassName('animated-box')[0],
          sign_in_form = document.getElementsByClassName('sign-in')[0],
          sign_up_form = document.getElementsByClassName('sign-up')[0];
        function animate_bx(){
            animated_box.classList.add('anim-page');
                setTimeout(() => {
                    animated_box.classList.remove('anim-page');
                }, 2000);
        }
          btn_sign_in.addEventListener("click",()=>{
            localStorage.setItem('sign','true');
              animate_bx();
              if(!bx_sign_in.classList.contains('bx-left-neg') &&  bx_sign_in.classList.contains('bx-left-pos')){
                bx_sign_in.classList.add('bx-left-neg');
                bx_sign_in.classList.remove('bx-left-pos');
                setTimeout(() => {
                    bx_sign_up.classList.remove('bx-left-neg');
                    bx_sign_up.classList.add('bx-left-pos');
                }, 2000);
              }
                //form
                setTimeout(() => {
                    sign_in_form.style.display = "block";
                    sign_up_form.style.display = "none";
                }, 1500);
          });
          btn_sign_up.addEventListener("click",()=>{
            localStorage.setItem('sign','false');
              animate_bx();
              if(!bx_sign_up.classList.contains('bx-left-neg') &&  bx_sign_up.classList.contains('bx-left-pos')){
                bx_sign_up.classList.add('bx-left-neg');
                bx_sign_up.classList.remove('bx-left-pos');
                setTimeout(() => {
                    bx_sign_in.classList.remove('bx-left-neg');
                    bx_sign_in.classList.add('bx-left-pos');
                }, 2000);
            }
                //form
                setTimeout(() => {
                    sign_up_form.style.display = "block";
                    sign_in_form.style.display = "none";
                }, 1500);
          });

        //stay login page
          function enable_login(){
            if(!bx_sign_in.classList.contains('bx-left-neg') &&  bx_sign_in.classList.contains('bx-left-pos')){
                bx_sign_in.classList.add('bx-left-neg');
                bx_sign_in.classList.remove('bx-left-pos');
                    bx_sign_up.classList.remove('bx-left-neg');
                    bx_sign_up.classList.add('bx-left-pos');
                    sign_in_form.style.display = "block";
                    sign_up_form.style.display = "none";
              }
          }
          var sign_in = localStorage.getItem('sign');
        if(sign_in == 'true'){
        enable_login();
        }
        //recover
        var recover = localStorage.getItem('recover'),
            btn_recover = document.getElementsByClassName('subtext')[0],
            recover_acc = document.getElementsByClassName('recover_acc')[0],
            left_bx = document.getElementsByClassName('animated-box')[0],
            close = document.getElementsByClassName('close_bx')[0],
            recover_question = document.getElementsByClassName('recover_question')[0],
            recover_box = document.getElementById('recover-box');

            btn_recover.addEventListener("click",()=>{
                localStorage.setItem("recover","true");
                recover_acc.style.display = "block";
                left_bx.style.display ="none";
                sign_in_form.style.display = "none";
            });
            close.addEventListener("click",()=>{
                localStorage.setItem('recover',"false");
                recover_acc.style.display = "none";
                left_bx.style.display ="flex";
                sign_in_form.style.display = "block";
            });
            if(recover  == 'true'){
                recover_acc.style.display = "block";
                left_bx.style.display ="none";
                sign_in_form.style.display = "none";
            }
</script>
</body>
</html>