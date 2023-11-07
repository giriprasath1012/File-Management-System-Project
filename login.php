<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $conn = mysqli_connect("localhost", "root", "", "project");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $sql = "SELECT username, password FROM login WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $pass=$row['password'];
        
        if (strcasecmp($password,$pass)==0) {
            
            session_start();
            $_SESSION['username'] = $row['username'];
            header("Location:welcome.php");
            exit;
        } else {
            echo "<script>alert('Incorect Password')</script>";
            echo '<center><a href="login.html" id="backButton" class="btn-back">Back</a></center>';
            //header("Location:login.html");
           
            
        }
    } else {
        
        echo "<script>alert('User Not Found')</script>";
    }

    mysqli_close($conn);
}
?>
