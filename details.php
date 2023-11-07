<?php

$conn = mysqli_connect("localhost", "root", "", "project");
session_start();
$user = $_SESSION['username'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

   
    $sql = "SELECT filename, description, type,updatedate, filecontent FROM files WHERE filename = '$filename' AND username ='$user'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['filename'];
        $des = $row['description'];
        $type = $row['type'];
        $content = $row['filecontent'];
        $date=$row['updatedate'];
        echo "<link rel='stylesheet' type='text/css' href='style.css'>";
        echo "<title>Details</title>";
        echo "<div class='container2'>";
        echo "<center>";
        echo "<h2>Details of your file</h2>";
        echo "<h3> <span>File Name:</span> $name </h3>";
        echo "<h3><span>Description of the file:</span> $des </h3>";
        echo "<h3><span>File Type:</span> $type </h3>";
        echo "<h3><span>File Uploaded Date:</span> $date </h3>";
        echo "<h3><a href='download.php?filename=$filename' class='download-link'>Download</a></h3></br>";
        if (strpos($type, 'image') !== false) {
            // Display image content
            echo "<img src='data:$type;base64," . base64_encode($content) . "' height='300px' width='300px' />";

        } elseif ($type == 'application/pdf') {
            // Display PDF content
            header('Content-Type: application/pdf');
            echo $content;
        } elseif (strpos($type, 'text') !== false) {
            // Display text content
            echo "<pre>$content</pre>";
        } else {
            echo "File type not supported for direct display.";
        }

        // Add a "Back" button
        echo '<center><a href="welcome.php" id="backButton" class="btn-back">Back</a></center>';
        echo "</center>";
        echo "</div>";
    } else {
        echo "File not found.";
    }
}

mysqli_close($conn);
?>
<style>
    h3 {
        color: #333;
        font-size: 24px;
        margin: 10px 0;
    }

    h2 {
        color: black;
        font-size: 30px;
        margin: 10px 0;
        text-decoration: underline;
    }

    span {
        color: blue;
    }

    .btn-back {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        width: 50px;
    }

    .btn-back:hover {
        background-color: #45a049;
    }
</style>
