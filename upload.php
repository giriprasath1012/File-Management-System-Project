<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    session_start();
    $username=$_SESSION['username'];
    $filename=$_POST['filename'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    
    $conn = mysqli_connect("localhost", "root", "", "project");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $file_content = file_get_contents($file_tmp);
    $file_content = mysqli_real_escape_string($conn, $file_content);
  
  
    $sql = "INSERT INTO files (username,filename, description, type, filecontent,exe) VALUES ('$username','$filename', '$description', '$type', '$file_content','$file_name')";
    echo "<title>Upload</title>";
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";
    if (mysqli_query($conn, $sql)) {
        echo "<center><h3>Your File  <i>$filename </i> uploaded and inserted into the database successfully.</h3> </br></br></center>";
        echo '<center><button id="backButton" class="btn-back" onclick="goBack()">Back</button></center>';
    
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<style>
    .btn-back {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        width: 100px;
    }

    .btn-back:hover {
        background-color: #45a049;
    }
</style>

<script>
    function goBack() {
        window.history.back();
    }
</script>
