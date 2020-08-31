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
    <title>settings</title>
</head>
<body style="background:var(--text_color_white)">
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
    echo'
<div id="own-scroll-bar"></div>
    <header>
        <div class="logo"><span>One</span>&nbsp;Day</div>
        <nav>
            <ul>
                <li><a href="home?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="fa fa-home"></i>&nbsp;<span>Home</span></a></li>
                <li><a href="profile?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="far fa-user"></i>&nbsp;<span>Account</span></a></li>
                <li class="down_menu"><a href="#"><i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li class="dark_mode"><span id="dark_mode"><i id="dark-icon" class="fa fa-moon"></i></span></li>
                        <li><a  class="active" href="settings?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="fas fa-cog"></i></a></li>
                        <li><a href="includes/logout" id="logout"><i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="toggle-menu"><i class="fa fa-bars"></i></div>
    </header>
    <section class="container-settings">
        <div class="box">
            <h2 id="stng_title">general settings</h2><br><hr>
            <div class="nav-btns">
                <div id="stng_btn1" onclick="stng_btn1()" class="btn1 btn active"><i class="fas fa-cog"></i></div>
                <div id="stng_btn2" onclick="stng_btn2()" class="btn2 btn "><i class="fas fa-shield-alt"></i></div>
            </div>
                <!-- first form -->
             <form action="settings" method="post" class="general first-stng">
                <h3>you can update your information</h2><br>
                <div class="input-groupe" style="display: flex;flex-direction: row;">
                    <i class="fa fa-user"></i>
                    <input style="border-right: none;" type="text" placeholder="first name" name="f_name" value="'.$user['f_name'].'" required>
                    <input type="text" placeholder="last name" name="l_name" value="'.$user['l_name'].'" required>
                </div>
                <div class="input-groupe">
                    <i class="fa fa-phone"></i>
                    <input type="tel" placeholder="phone number" name="u_phone" value="'.$user['u_phone'].'" required>
                </div>
                <div class="input-groupe">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="username" name="new_username" value="'.$user['u_name'].'" required>
                </div>
                <div class="input-groupe">
                    <i class="fa fa-flag"></i>
                    <select id="uppercase_countries" class="form-control" name="u_country" required>
                        <option selected="1" value="Algeria">Algeria</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Libya">Libya</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Sourya">Sourya</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Turk">Turk</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="Egypte">Egypte</option>
                        <option value="United States Of America">United States Of America</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Jpan">Jpan</option>
                        <option value="Korea">Korea</option>
                        <option value="China">China</option>
                      </select>
                </div>
                <br><h3>life\'s objective</h2><br>
                <div class="input-groupe">
                    <i class="fa fa-audio-description"></i>
                    <input type="text" placeholder="write your life\'s objective" name="objective" value="'.$user['objective'].'" required>
                </div>
                <br><h3>BIO</h2><br>
                <div class="input-groupe">
                    <i class="fa fa-audio-description"></i>
                    <textarea placeholder="write your BIO" name="u_bio" value="'.$user['user_bio'].'" required>'.$user['user_bio'].'</textarea>
                </div>
                <button class="btn" name="update_general">update information</button><br/>
                ';include("includes/update_gn_stng.php");echo'
            </form>
            <!-- second form -->
            <form action="settings" method="post" class="general second-stng">
                <h3>insert a secret word to recover your account</h2><br>
                <div class="input-groupe">
                    <i class="fa fa-flag"></i>
                    <select class="form-control" name="u_secret_question" required>
                        <option selected="1" value="Where were you born ?">Where were you born ?</option>
                        <option value="what is your favorite dish ?">what is your favorite dish ?</option>
                        <option value="what is your favorite hobby ?">what is your favorite hobby ?</option>
                        <option value="What is your favorite color ?">What is your favorite color ?</option>
                      </select>
                </div>
                <div class="input-groupe">
                    <i class="fa fa-key"></i>
                    <input type="tel" placeholder="secret word" name="u_secret_word" value="'.$user['secret_word'].'" required>
                </div>
                <br>
                <h3>change your password</h2><br>
                <div class="input-groupe">
                    <i class="fa fa-key"></i>
                    <input type="tel" placeholder="old password" name="old_pass">
                </div>
                <div class="input-groupe">
                    <i class="fa fa-key"></i>
                    <input type="text" placeholder="new password" name="new_pass">
                </div>
                <div class="input-groupe">
                    <i class="fa fa-key"></i>
                    <input type="text" placeholder="repeat new password" name="new_pass_repeat">
                </div>
                <button class="btn" name="secure_update">update information</button><br/>
                ';include("includes/update_sc_stng.php");echo'
            </form>
        </div>
        <div class="delete_account">
            <a href="includes/delete_function?user_id='.$user['id'].'"><i class="fas fa-trash"></i>&nbsp;delete account</a>
        </div>
        </section>
        ';
        }
        ?>
    <script src="app/main.js"></script>
    <script src="app/preloader.js"></script>
    <script src="app/darkmode.js"></script>
    <script>
         //  start toggle settings
      var btn1_stng = document.getElementById('stng_btn1'),
          btn2_stng = document.getElementById('stng_btn2'),
          stng_title = document.getElementById('stng_title'),
          //display vars
          disp_one = document.getElementsByClassName('first-stng')[0],
          disp_two = document.getElementsByClassName('second-stng')[0];
          function stng_btn1(){
            disp_one.style.display = "block";
            disp_two.style.display = "none";
            stng_title.innerHTML = "general settings";
            btn1_stng.classList.add("active");
            btn2_stng.classList.remove("active");
          }
          function stng_btn2(){
            disp_two.style.display = "block";
            disp_one.style.display = "none";
            stng_title.innerHTML = "security settings";
            btn2_stng.classList.add("active");
            btn1_stng.classList.remove("active");
          }
      //  end toggle settings
    </script>
</body>
</html>