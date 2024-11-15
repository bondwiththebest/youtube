<?php
session_start();

//Connect to database
$conn = new mysqli('localhost', 'root', '', 'youtube');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user in database
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) 
        {
          $_SESSION['user_id'] = $user['id'];
            header("location:index.php");
            exit();
          }
          /*header('Location: index.php');*/
        } 
        else
        {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

?>

<style>
  .container1{
    width:auto;
    position:absolute;
    left: 50%;
    top:50%;
    transform: translate(-50%,-50%);
    box-shadow: 10px 10px 10px blue;
    padding:10px;
    padding-top:25px;
  }
  input,button{
    margin:5px;
  }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Streaming Site</title>
    <link rel="stylesheet" href="css/fstyles1.css" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-title">
            <img src="uploads/avatars/playpulse_logo_transparents.png" alt="User Avatar" height="50" width="150">
                Stream your way
                <input class="text-display-nav" type="search" size=100 placeholder="Enter the keyword to search">
                <input class="button_sub_nav" type="submit" value="Search">
        </div>
        <div class="user-profile">
            <img src="uploads/avatars/playpulse_logo.png" alt="User Avatar" height="40" width="40">
            <span>LogIn</span>
        </div>
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
          <div style="background-color:white;border-style:none; display:flex; justify-content:left; margin:10px; border-radius:10px;"><h3 style="text-Yalign:middle;"> <img src= "uploads/avatars/playpulse_logo_transparents.png" heigth=25 width=75> welcomes you</h3></div>
            <div class="video-section">
              <div class="container1">
                <div>
                  <form action="login.php" method="POST">
                    <div><input type="email" name="email" placeholder="Email" required><br></div>
                    <div><input type="password" name="password" placeholder="Password" required></div>
                    <div><button type="submit">Login</button></div>
                  </form>
                </div>
              </div>
        </main>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
