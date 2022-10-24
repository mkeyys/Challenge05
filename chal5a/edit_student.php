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

<h3 for="act"> <?php
    // Echo session variables that were set on previous page
    echo "Hello " . $_SESSION["username"] . ', ' ;
    ?>Nhập thông tin muốn sửa:</h3>

<div>
    <form method="POST" action="edit_student.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <?php
                $hostname = 'localhost:3306';
                $username = 'root';
                $password = 'ABC123';
                $dbname = "prog5";
                $conn = mysqli_connect($hostname, $username, $password,$dbname);
                $student = $_SESSION["username"];
                $sql0 = "SELECT * FROM infor_student WHERE user_student = '$student'";
                if ($res0 = mysqli_query($conn, $sql0)) {
                    if (mysqli_num_rows($res0) > 0) {
                        while ($row0 = mysqli_fetch_array($res0)) {
                            echo "<tr>"."ID: ".$row0['ID_student']."</tr>"."<br>";
                            echo "<tr>"."Username: ".$row0['user_student']."</tr>"."<br>";
                            echo "<tr>"."Fullname: ".$row0['fullname_student']."</tr>"."<br>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        mysqli_free_result($res0);
                    }
                    else {
                        echo "No matching records are found.";
                    }
                }
                else {
                    echo "ERROR: Could not able to execute $sql0. "
                        .mysqli_error($conn);
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-outline">
                    <input type="password" id="form8Example4" class="form-control" name="password" />
                    <label class="form-label" for="form8Example4">Password</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="email" id="form8Example5" class="form-control" name="email"/>
                    <label class="form-label" for="form8Example5">Email address</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="form8Example1" class="form-control" name="phone"/>
                    <label class="form-label" for="form8Example1">Phone</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="file" name="file" class="form-control" id="fileToUpload" />
                    <label class="form-label" for="form8Example1">Avatar</label>
                </div>
            </div>
        </div>
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button id='return' type="button" name = 'return_l' class="btn btn-outline-secondary"><a href="index_student.php">Quay lại</a></button>
            <button id='submit' type="submit" name = 'edit_submit' class="btn btn-outline-secondary">Gửi</button>
            <button id='return' type="button" name = 'return_r' class="btn btn-outline-secondary"><a href="./student/view_student.php">Xem thông tin</a></button>
        </div>
    </form>
</div>


<?php
//require("lib/connection.php");
if (isset($_POST["edit_submit"])) {
    $pass = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $filetype = $file['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','jpg');
    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0 )
            if ($fileSize <= 10000000){
                $fileDes = 'avatar/' . $fileName;;
                move_uploaded_file($fileTmpName, $fileDes);
                $sql3 = "UPDATE db_image SET image='$fileDes' WHERE user='$student'";
                $query3 = mysqli_query($conn, $sql3);
            }else{
                echo '<script>alert("Image too big")</script>';
            }

    }else{
        echo '<script>alert("Error")</script>';
    }

    if ( $pass == "" || $email == "" || $phone == "" ) {
        echo '<script>alert("Vui lòng điền đủ thông tin")</script>';
    }else{
        $sql1 = " UPDATE infor_student SET pass_student = '$pass', email_student = '$email', phone_student = '$phone' WHERE user_student = '$student' ";
        $query1 = mysqli_query($conn,$sql1);
        $sql2 = "UPDATE user SET  password = '$pass', email = '$email', WHERE username = '$student'";
        $query2 = mysqli_query($conn, $sql2);
        echo '<script>alert("Cập nhập thông tin sinh viên thành công")</script>';
    }
}
?>
</body>
</html>
