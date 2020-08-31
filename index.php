<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: profile?".$_SESSION['username']."-".$_SESSION['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/note.png" type="image/png" sizes="18x18">
    <link rel="stylesheet" href="styles/main.css"/>
    <link rel="stylesheet" href="styles/all.min.css"/>
    <link rel="stylesheet" href="styles/preloader.css">
    <link class="dark_toggle" rel="stylesheet"/>
    <title>Wrtie your diaries - articles safley</title>
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
    <!-- start header  -->
    <header>
        <div class="logo"><span>One</span>&nbsp;Day</div>
        <nav>
            <ul>
                <li><a href="index" class="active"><i class="fa fa-home"></i>&nbsp;<span>Home</span></a></li>
                <li><a href="register"><i class="far fa-user"></i>&nbsp;<span>Register</span></a></li>
                <li class="down_menu"><a><i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li class="dark_mode"><span id="dark_mode"><i id="dark-icon" class="fa fa-moon"></i></span></li>
                        <li><a onclick="scroll_info()" class="info_ttg"><i class="fas fa-info"></i></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="toggle-menu"><i class="fas fa-bars"></i></div>
    </header>
    <!-- start first page  -->
    <section id="bubble" class="container">
        <div class="content">
            <h2 id="off_title"></h2>
            <button onclick="scroll_start()" class="btn">Let's get started</button>
        </div>
    </section>
    <!-- end first page  -->
    <!-- start section two  ------------------------------------------------------------------------------------>
    <section id="second-section" class="second-section">
        <div style="left: -50%;" id="first-box-item" class="box-item">
            <div class="img"><i class="fas fa-language"></i></div>
            <h2>Our language</h2>
            <p>We have translators in all languages of the world so we can communicate with all our costumers in a way that makes them feel comfortable.</p>
        </div>
        <div class="box-item">
            <div class="img"><i class="fa fa-user"></i></div>
            <h2>Join us</h2>
            <p>Join our website and write your first article , be one of the first members.</p>
            <a href="register" class="btn-join">join now</a>
        </div>
        <div style="right: -50%;" id="last-box-item" class="box-item">
            <div class="img"><i class="fab fa-angellist"></i></div>
            <h2>Easy to use</h2>
            <p>Easy and simple interfaces, you wil 
                not see a lot of complex designs 
                and heavy graphics here.</p>
        </div>
    </section>
    <!-- end section two  ------------------------------------------------------------------------------------>
    <!-- start last section  ------------------------------------------------------------------------------------>
    <section id="last-section" class="last-section">
        <div id="last_section_box" class="box_text">
            <h2>Whate are you writing for ?</h2>
            <p>
            one day will help you to write your diaries safley. <br/><hr><br/>
            <h3>soon</h3><br>
                  - add a page for writing articles. <br>
                  - add a page for writing notes. <br>
                  - add a page for writing novels. <br>
                  - add the edit button on each of written pages : diaries , articles , notes , novels. <br>
                  - add a pop-up window : how you feel today. <br/><br/><hr>
            </p>
        </div>
        <div class="s-to-top" onclick="scroll_to_top()"><i class="fas fa-angle-double-up"></i></div>
    </section>
    <!-- end last section  ------------------------------------------------------------------------------------>
    <section class="footer">
            <h2>@one day 2020</h2>
            <ul>
                <li><a href=""><i style="color:#0000ff;" class="fab fa-facebook"></i></a></li>
                <li><a href=""><i style="color:#be00b5;" class="fab fa-instagram"></i></a></li>
                <li><a href=""><i style="color:#ff0000;" class="fab fa-youtube"></i></a></li>
            </ul>
        <div class="coded">
            coded with <i style="color: red;" class="fas fa-heart"></i> and <i style="color: var(--first_color);" class="fas fa-coffee"></i> by mr jakoub
        </div>
    </section>
    <script src="app/main.js"></script>
    <script src="app/animation.js"></script>
    <script src="app/preloader.js"></script>
    <script src="app/darkmode.js"></script>
    <script>
        var i = 0,txt = "Write your diaries and your articles safley";
    function typeWriter() {
    if (i < txt.length) {
        document.getElementById("off_title").innerHTML += txt.charAt(i);
        i++;
    }
    }
    setInterval(() => {
        typeWriter();
    }, 100);
    </script>
</body>
</html>

