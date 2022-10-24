<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Font Roboto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />
    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"
    ></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css" />
    <title>Hello, world!</title>
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body style="background-color: hsl(0, 0%, 96%)">
<h3 for="act"> <?php
    // Echo session variables that were set on previous page
    echo "Hello " . $_SESSION["username"] . ', ' ;
    ?>Đây là danh sách các người dùng:</h3>

<?php
//require("lib/connection.php");
$hostname = 'localhost:3306';
$username = 'root';
$password = 'ABC123';
$dbname = "prog5";
$conn = mysqli_connect($hostname, $username, $password,$dbname);

$sql = "SELECT * FROM user";
if ($res = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($res) > 0) {
        echo "<table style='width:100%'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>User</th>";
        echo "<th>Email</th>";
        echo "<th>Position</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>".$row['ID']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['position']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }
    else {
        echo "No matching records are found.";
    }
}
else {
    echo "ERROR: Could not able to execute $sql. "
        .mysqli_error($conn);
}
mysqli_close($conn);

?>

<div class="btn-group" role="group" aria-label="Basic outlined example">
    <button id='return' type="button" name = 'return_r' class="btn btn-outline-secondary"><a href="../index_teacher.php">Quay lại</a></button>
</div>
</body>
</html>
