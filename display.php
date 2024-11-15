<?php
$conn = new mysqli('localhost', 'root', '', 'youtube');

// Fetch videos
$result = $conn->query("SELECT * FROM videos ORDER BY upload_date DESC");


while ($video = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $video['title'] . "</h3>";
    echo "<video width='320' height='240' controls>
            <source src='" . $video['filepath'] . "' type='video/mp4'>
          </video>";
    echo "<p>" . $video['description'] . "</p>";
    echo "</div>";
}
?>
