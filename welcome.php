<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Home Page</h2>
    <div class="container2">
        <h2>File Management System </br></br><?php
    session_start();
    echo "Welcome, " . $_SESSION['username'];?></h2>
        <button id="uploadBtn" class="btn headbtn" onclick="showUploadForm()">File Upload</button>
        <button id="downloadBtn" class="btn headbtn" onclick="showDownloadOptions()">File Download</button>
        <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" style="display: none;">
            <input type="text" name="filename" class="form-input" placeholder="Filename" required><br>
            <input type="text" name="description" class="form-input" placeholder="Description" required><br>
            <input type="text" name="type" class="form-input" placeholder="Type" required><br>
            <input type="file" name="file" class="form-input" required><br>
            <input type="submit" value="Upload" class="btn btn-submit"><br>
        </form>
        <div id="downloadOptions" style="display: none; ">

        <form id="uploadForm" action="search.php" method="post" enctype="multipart/form-data" >
    
        <center><h3>Select Search Option:</h3>
        <select id="searchOption" name="searchOption" class="form-input">
        <option value="1">Search by filename</option>
        <option value="2">Search by type</option>
        <option value="3">Search by Date</option>
        <option value="4">All</option>
        </select></center>
        <input type="text" name="searchText" class="form-input" placeholder="Enter search text">
    <input type="submit" name="search" value="Search" class="btn btn-submit">
</form>
        </div>
    </div>

    <?php

    if (!isset($_SESSION['username'])) {
        header("Location: login.html"); 
    }
    echo "</br></br><a href='logout.php' class='btn btn-back'>Logout</a>";
    ?>

    <script>
        function showUploadForm() {
            document.getElementById('uploadForm').style.display = 'block';
            document.getElementById('downloadOptions').style.display = 'none';
        }

        function showDownloadOptions() {
            document.getElementById('uploadForm').style.display = 'none';
            document.getElementById('downloadOptions').style.display = 'block';
        }
    </script>
</body>
</html>
