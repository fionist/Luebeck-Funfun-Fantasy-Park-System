<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.ico"media="screen" />
    <meta charset="UTF-8" name="viewport" content="wdith=device-width, initial-scale=1"/>
    <title>Luebeck Funfun Fantasy Park Homepage</title>
    <link rel="stylesheet" href="css/homepage.css">  
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>


<header>
    <div class="overlay">
<h1>Luebeck Funfun Fantasy Park </h1>
<br><br>
<p1>Legendary, amusing, thrilling and impressive experience.</p1>
    <br><br><br><br><br><br><br><br><br><br><br><br>
        <section class="navbar">
        <div class="container">
            <div class="menu text-right">
                    <span class="loginControl">
                                <?php if (isset($_SESSION['user_id'])) :  ?>
                                    <a class="logout-text">
                                        You are now logged as 
                                        <?php if ($_SESSION['username'] != 'admin')  : ?>
                                        <?php echo strtoupper($_SESSION['username']), "."?>
                                        <?php else : ?>
                                        <?php echo "<a class='logout-button'href='admin.php' >ADMIN.</a>" ?>
                                        <?php endif; ?>
                                        <a class="logout-text"> Click to </a><?php echo "<a href='user/logout.php' class='logout-button'>Log out</a>" ?>
                                    </a>
                                <?php else : ?>
                                    <a href="user/login.php" class="log-button">Log in</a>
                                <?php endif; ?>
                    </span>

                <ul>

                    <?php if(isset($_SESSION['user_id'])) : ?>
                    <li>
                        <a href="ticket/ticketUser.php">Buy Tickets</a>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['user_id'])) : ?>
                    <li>
                        <a href="ticket/history.php">Order history</a>
                    </li>
                    <?php endif; ?>               
                    <li>
                        <a href="news/news_page.php">Latest Release</a>
                    </li>
                    <li>
                        <a href="guide.php">Travel Guide</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>

                </ul>
                
            </div>          
        </div>
    </section>
        </div>
</header>

<body>
    <div class="footer-basic">
        <footer>
            <div class="social"><a1 href="#"><i class="icon ion-social-instagram"></i></a1><a1 href="#"><i class="icon ion-social-snapchat"></i></a1><a1 href="#"><i class="icon ion-social-twitter"></i></a1><a1 href="#"><i class="icon ion-social-facebook"></i></a1></div>
            <p class="copyright">Luebeck Funfun Fantasy Park © 2021<br>background source image:https://www.10wallpaper.com/cn/view/Amusement_Park-HD_Widescreen_Wallpaper.html,last access date 15.3.2021</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!--
    The main page for displaying.
    @author Yuning Bao & Lin Han
    @date 6.4.2021
-->
