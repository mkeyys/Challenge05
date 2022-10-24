<?php
$hostname = 'localhost:3306';
$username = 'root';
$password = 'ABC123';
$dbname = "prog5";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if (!$conn) {
    die('Không thể kết nối: ' . mysqli_error($conn));
    exit();
}


$sql = "INSERT INTO user (ID,username,password,email,position) VALUES ('TC002','teacher002','tc002','teacher002@gmail.com','teacher')";
$ret = mysqli_query($conn,$sql);
if (!$ret) {
    die('Không thể thêm dữ liệu: ' . mysqli_error($conn));
}
echo "Thêm dữ liệu thành công\n";
mysqli_close($conn);
?>