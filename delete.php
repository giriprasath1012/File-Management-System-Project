<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$user = $_SESSION['username'];

if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    $conn = mysqli_connect("localhost", "root", "", "project");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM files WHERE filename = '$filename' AND username = '$user'";
    echo "<title>Delete</title>";
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";
    if (mysqli_query($conn, $sql)) {
        
        echo "<div class='delete'>";
        echo "<center><h3>Your File  <i>$filename </i> has been deleted successfully.</h3> </br></br></center>";
        echo '<center><a href="welcome.php" id="backButton" class="btn btn-back" >Back</a></center>';
        echo "</div>";
    } else {
       
        echo "Error deleting the file: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<script>
    function goBack() {
        
    }
</script>

