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
</head>
<body style="background-color: hsl(0, 0%, 96%)">

<h3 for="act"> <?php
    // Echo session variables that were set on previous page
    echo "Hello " . $_SESSION["username"] . ', ' ;
    ?>Nhập thông tin học sinh muốn xóa:</h3>
<div>
    <form method="POST" action="teacher_del.php">
        <div class="row">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="form8Example1" class="form-control" name="id"/>
                    <label class="form-label" for="form8Example1">ID</label>
                </div>
            </div>
        </div>
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button id='return' type="button" name = 'return_r' class="btn btn-outline-secondary"><a href="../index_teacher.php">Quay lại</a></button>
            <button id='submit' type="submit" name = 'del_submit' class="btn btn-outline-secondary">Gửi</button>
        </div>
    </form>
</div>


<?php
//require("lib/connection.php");
$hostname = 'localhost:3306';
$username = 'root';
$password = 'ABC123';
$dbname = "prog5";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if (isset($_POST["del_submit"])) {
    $id = $_POST["id"];
    if ($id == "") {
        echo "Vui lòng điền đủ thông tin!";
    }else{
        $sql1 = "DELETE FROM infor_student WHERE ID_student = '$id'";
        $query1 = mysqli_query($conn,$sql1);
        $sql2 = "DELETE FROM user WHERE ID = '$id'";
        $query2 = mysqli_query($conn, $sql2);
        echo '<script>alert("Xóa thông tin sinh viên thành công")</script>';
    }
}
?>
</body>
</html>
