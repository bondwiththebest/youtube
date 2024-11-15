<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'youtube');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Handle video upload
    $target_dir = "uploads/videos/";
    $target_file = $target_dir . basename($_FILES["video"]["name"]);
    move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO videos (title, description, filepath) VALUES ('$title', '$description', '$target_file')";
    if ($conn->query($sql)) {
        echo "Video uploaded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Streaming Site</title>
    <link rel="stylesheet" href="css/fstyles1.css">
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
            <span>Username</span>
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
            <div style="background-color:white;border-style:none; display:flex; justify-content:left; margin:10px; border-radius:10px;"><h3 style="text-Yalign:middle;"> <a href="index.php"><img src= 'uploads/avatars/playpulse_logo_transparents.png' heigth=35 width=75></a> welcomes you</h3></div>
            <div class="video-section">
                <p>You might also liked it...</p>
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'youtube');

                    // Fetch videos
                    $result = $conn->query("SELECT * FROM videos ORDER BY upload_date DESC");
                    if($result->num_rows>0)
                    {
                        echo"<table>";
                        echo "<tr>";
                        while ($video = $result->fetch_assoc())
                        {   
                          
                            
                                echo "<td>";
                                echo "<div style='width:auto;box-shadow 3px 3px 3px blue;'>";
                                echo "<h3>" . $video['title'] . "</h3>";
                                echo "<video width='320' height='240' controls>
                                        <source src='" . $video['filepath'] . "' type='video/mp4'>
                                        </video>";
                                echo "<p>" . $video['description'] . "</p>";
                                echo "</div>";
                                echo"</td>";
                            
                        }
                        echo"</tr>";
                        echo"</table>";
                    }
                    else
                    {
                        echo "There are no videos.";
                    }
                ?>

            </div>
        </main>
        <main class="main-content">
          <div style="background-color:white;border-style:none; display:flex; justify-content:left; margin:10px; border-radius:10px;"><h3 style="text-Yalign:middle;"> <img src= "uploads/avatars/playpulse_logo_transparents.png" heigth=25 width=75> welcomes you</h3></div>
            <div class="video-section">
              <div class="container1">
                <div style="padding:25px;">
                  <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div><input type="text" name="title" placeholder="Video Title" required></div>
                    <div><textarea name="description" placeholder="Description" required></textarea></div>
                    <div><input type="file" name="video" accept="video/*" required></div>
                    <div><button type="submit">Upload Video</button></div>
                  </form>
                 
                </div>
              </div>
        </main>
    </div>

    <script src="scripts.js"></script>
</body>
</html>

