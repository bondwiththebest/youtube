<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Streaming Site</title>
    <link rel="stylesheet" href="css/fstyles1.css">
    <script src="js/popup.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-title">
            <img src="uploads/avatars/playpulse_logo_transparents.png" alt="User Avatar" height="50" width="150">
                <br>Stream your way
                <input class="text-display-nav" type="search" size=100 placeholder="Enter the keyword to search">
                <input class="button_sub_nav" type="submit" value="Search">
        </div>
        <div class="user-profile">
            <img src="uploads/avatars/playpulse_logo.png" alt="User Avatar" height="40" width="40">
            <span><?php
            if($_SESSION==null)
            {
                ?><a href=login.php>Log In</a>
                <?php
                }else{?>
                    <?php echo "Welcome".$_SESSION['user_id'];
                    echo "<br><a href=index.php>SignOut</a>";
                    session_destroy();
                 }?>
                </span>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Subscriptions</a></li>
                <li><a href="#">Library</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Watch Later</a></li>
                <li><a href="#">Liked Videos</a></li>
            </ul>
        </aside>

        <!-- Main Video Section -->
        <main class="main-content">
            <div style="background-color:white;border-style:none; display:flex; justify-content:left; margin:10px; border-radius:10px;"><h3 style="text-Yalign:middle;"> <img src= "uploads/avatars/playpulse_logo_transparents.png" heigth=25 width=75> welcomes you |<a href=upload.php>Upload</a>|</h3></div>
            <div class="video-section">
                <p>Here will be a list of videos and suggestions.</p>
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'youtube');

                    // Fetch videos
                    $result = $conn->query("SELECT * FROM videos ORDER BY upload_date DESC");

                    while ($video = $result->fetch_assoc())
                    {
                        echo "<div class='video-section'>";
                        echo "<h3>" . $video['title'] . "</h3>";
                        echo "<video width='320' height='240' controls>
                              <source src='" . $video['filepath'] . "' type='video/mp4'>
                            </video>";
                        echo "<p>" . $video['description'] . "</p>";
                        echo "</div>";
                    }
                ?>
            </div>
            <button class="open-button" onclick="openForm()">Open Form</button>
            <div style="display:none;" class="form-popup" id="myForm">
                <form action="/action_page.php" class="form-container">
                    <h1>Login</h1>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <button type="submit" class="btn">Login</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>

        </main>
    </div>

</body>
</html>