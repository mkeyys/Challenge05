<?php
session_start();
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
<div class="container ">
    <div>
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <form method="POST" action="login.php" >
                                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                        <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label">Username</label>
                                            <input id="typeEmailX" name="username" class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="typePasswordX">Password</label>
                                            <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label">Position</label>
                                            <select name="position" id="position" class="form-control form-control-lg">
                                                <option value="teacher">Teacher</option>
                                                <option value="student">Student</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit" name="btn_submit">Login</button>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
//require("lib/connection.php");
$hostname = 'localhost:3306';
$username = 'root';
$password = 'ABC123';
$dbname = "prog5";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if (isset($_POST["btn_submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $position = $_POST["position"];

    if ($username == "" || $password =="" || $position ==""|| $email == "") {
        echo "Vui lòng điền đủ thông tin!";
    }else{
        $sql = "SELECT username, password, email, position FROM user WHERE username = '$username' AND password = '$password' AND position = '$position' AND email = '$email'";
        $query = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows==0) {
            echo '<script>alert("Thông tin đăng nhập không chính xác")</script>';

        }else{
            //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
            $_SESSION['username'] = $username;
            // Thực thi hành động sau khi lưu thông tin vào session
            if($position == "teacher"){
                header('Location: index_teacher.php');
            }elseif ($position == "student"){
                header('Location: index_student.php');
            }
        }
    }
}
?>
</body>
</html>
