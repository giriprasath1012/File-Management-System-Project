<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
$user=$_SESSION['username'];
if (isset($_POST['search'])) {
    
    $conn = mysqli_connect("localhost", "root", "", "project");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

   
    $searchOption = $_POST['searchOption'];

    if ($searchOption == "1") {
        $key = $_POST['searchText'];
        $sql = "SELECT filename, filecontent FROM files WHERE filename = '$key' AND username ='$user'";
        $s = "Filename";
    } elseif ($searchOption == "2") {
        $key = $_POST['searchText'];
        $sql = "SELECT filename, filecontent FROM files WHERE type = '$key' AND username ='$user'";
        $s = "File Type";
    } elseif ($searchOption == "3") {
        $key = $_POST['searchText'];
        $sql = "SELECT filename, filecontent FROM files WHERE updatedate = '$key' AND username ='$user'";
        $s = "File Date";
    }
    elseif ($searchOption == "4") {
        $key = "All type of file";
        $sql = "SELECT filename, filecontent FROM files WHERE  username ='$user'";
        $s = "File Date";
    }

    $result = mysqli_query($conn, $sql);
    echo "<title>Search</title>";
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Your Result for $s: $key</h2>";
        echo "<div class='result-container'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $filename = $row['filename'];
            $filecontent = $row['filecontent'];

            echo "<div class='result-item'>";
            echo "<h3>Filename: $filename</h3>";
            echo "<a href='download.php?filename=$filename' class='download-link'>Download</a>";
           
            echo "<a href='details.php?filename=$filename' class='download-link' style='margin-left: 20px;'>Details</a>";
            echo "<a href='delete.php?filename=$filename' class='download-link' style='margin-left: 20px;'>Delete</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<h2>No results found for $s: $key</h2>";
    }

    mysqli_close($conn);
}
?>
