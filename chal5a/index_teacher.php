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
    <link rel="stylesheet" href="style.css" />
    <title>Hello, world!</title>
</head>
<body style="background-color: hsl(0, 0%, 96%)">
<div class="accordion" id="accordionExample">
    <div>
        <form method="POST" action="index_teacher.php">

            <h3 for="act"> <?php
                // Echo session variables that were set on previous page
                echo "Hello " . $_SESSION["username"] . ', ' ;
                ?>Bạn muốn:</h3>
            <select class="form-select" aria-label="Default select example" name="act" id="act">
                <option value="sel">Xem thông tin sinh viên</option>
                <option value="upd">Sửa thông tin sinh viên</option>
                <option value="ins">Thêm thông tin sinh viên</option>
                <option value="del">Xóa thông tin sinh viên</option>
                <option value="list_user">Xem danh sách người dùng khác</option>
            </select>
            <br>
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button id='return' type="button" name = 'return_r' class="btn btn-outline-secondary"><a href="login.php">Quay lại</a></button>
                <button id='submit' type="submit" name = 'submit_r' class="btn btn-outline-secondary">Gửi</button>
            </div>

        </form>
    </div>
</div>
<?php
//require("lib/connection.php");
$hostname = 'localhost:3306';
$username = 'root';
$password = 'ABC123';
$dbname = "prog5";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if (isset($_POST["submit_r"])) {
    $act = $_POST["act"];

    if($act == "sel"){
        header('Location: ./teacher/teacher_sel.php');
    }
    elseif ($act == "upd"){
        header('Location: ./teacher/teacher_upd.php');
    }elseif ($act == "ins"){
        header('Location: ./teacher/teacher_ins.php');
    }elseif ($act == "del"){
        header('Location: ./teacher/teacher_del.php');
    }elseif ($act == "list_user"){
        header('Location: ./teacher/teacher_list_user.php');
    }

}
//session_destroy();
?>
</body>
</html>
