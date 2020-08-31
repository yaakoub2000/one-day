<?php
session_start();
include("includes/connection.php");
//secure input
function filter_info($input){
    $input = stripslashes(htmlspecialchars(trim($input)));
    return $input;
}
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
    <title>Home</title>
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
$err_msg = "";
    echo'
    <div id="own-scroll-bar"></div>
    <header>
        <div class="logo"><span>One</span>&nbsp;Day</div>
        <nav>
            <ul>
                <li><a href="home?'.$_SESSION['username']."-".$_SESSION['id'].'" class="active"><i class="fa fa-home"></i>&nbsp;<span>Home</span></a></li>
                <li><a href="profile?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="far fa-user"></i>&nbsp;<span>Account</span></a></li>
                <li class="down_menu"><a><i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li class="dark_mode"><span id="dark_mode"><i id="dark-icon" class="fa fa-moon"></i></span></li>
                        <li><a href="settings?'.$_SESSION['username']."-".$_SESSION['id'].'"><i class="fas fa-cog"></i></a></li>
                        <li><a href="includes/logout"><i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="toggle-menu"><i class="fas fa-bars"></i></div>
    </header>
    <section class="container-home">
        <div class="objective">
            <p>Don\'t forget your objective :</p><span>'.$user['objective'].'</span>
            <i id="objective_down" class="fas fa-caret-down"></i>
        </div>
        <form method="post" action="home" class="box-notes">
        <div class="box-write">
            <div class="input-groupe">
                <p>words :<span id="nbr_words"></span></p>
                <input type="text" placeholder="write a title here" name="note_title" required>
                <button name="post_note"><i title="save" class="fas fa-save"></i></button>
                <i id="fullscreen" title="full screen" class="fas fa-expand-alt"></i>
            </div>
            <div class="input-text">
                <textarea id="text_written" name="note_text" placeholder="write your diarys here"></textarea>
            </div>
        </div>
        <!-- notes insert -->
        ';
            if(isset($_POST['post_note'])){
                $note_title = filter_info($_POST['note_title']);
                $note_text = filter_info($_POST['note_text']);
                $date = date("Y-m-d");
                if($note_title&&$note_text){
                    if(strlen($note_title) <= 50){
                        if(strlen($note_text) <= 1000000){
                            //number of notes
                            $new_num_notes = $user['number_diaries'] + 1;
                            $sql_req = $connect->prepare("UPDATE users SET number_diaries = ? WHERE id = ?");
                            $sql_req->execute(array($new_num_notes,$_SESSION['id']));
                            $reqnote = $connect->prepare("INSERT INTO notes(u_id,diarie_title,diarie_text,diarie_date) VALUES (?,?,?,?)");
                            $x =$reqnote->execute(array($_SESSION['id'],$note_title,$note_text,$date));
                        }else{
                            $err_msg = "title must be less then 1000000 characters";
                        }
                    }else{
                        $err_msg = "title must be less then 50 characters";
                    }
                }else{
                    $err_msg = "please fill up all the Fields";
                }
            }
        echo '
        </form>
        </section>
        ';
        }
        echo '<span class="errmsg">'.$err_msg.'<span>';?>
    <script src="app/main.js"></script>
    <script src="app/preloader.js"></script>
    <script src="app/darkmode.js"></script>
    <script>
        //  start home
        var objective_down = document.getElementById('objective_down'),
            objective = document.getElementsByClassName('objective')[0];
            objective_down.addEventListener("click",()=>{
                if(objective_down.classList.contains('fa-caret-down')){
                    objective_down.classList.remove('fa-caret-down');
                    objective_down.classList.add('fa-caret-up');
                }else{
                    objective_down.classList.add('fa-caret-down');
                    objective_down.classList.remove('fa-caret-up');
                }
                objective.classList.toggle('active');
            });
      //  end home
      // calculate words function
      var nbr_words = document.getElementById('nbr_words');
          text_written = document.getElementById('text_written');
                function WordCounter(str) { 
                    var x = str.trim();
            return x.split(" ").length;
            }
            text_written.addEventListener("keyup",()=>{
                nbr_words.innerHTML = WordCounter(text_written.value);
                if(text_written.value == ""){
                    nbr_words.innerHTML = "";
                }
            });
        //full screen
        var form = document.getElementsByClassName('box-notes')[0],
            fullscreen_btn = document.getElementById('fullscreen');
            fullscreen_btn.addEventListener("click",()=>{
                fullscreen_btn.classList.toggle("fa-compress-alt")
                form.classList.toggle('fullscreen');
                if(form.classList.contains('fullscreen')){
                form.requestFullscreen();
                }else{
                    document.exitFullscreen();
                }
            });
                    
    </script>
</body>
</html>