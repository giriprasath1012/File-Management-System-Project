<?php

$conn = mysqli_connect("localhost", "root", "", "project");
session_start();
$user = $_SESSION['username'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    $sql = "SELECT filename, filecontent, exe FROM files WHERE filename = '$filename'  AND username ='$user'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $filecontent = $row['filecontent'];
        $file = $row['exe'];

        
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=\"$file\"");
        
        echo $filecontent;
    } else {
        echo "File not found.";
    }
}

mysqli_close($conn);
?>
