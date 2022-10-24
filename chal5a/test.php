<!DOCTYPE html>
<html>
<body>

<form action="test.php" method="POST" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file" id="fileToUpload">
    <button type="submit" name="submit">UPLOAD
    </button>
</form>
<?php
$hostname = 'localhost:3306';
$username = 'root';
$password = 'ABC123';
$dbname = "prog5";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if  (isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $filetype = $file['type'];
    print_r($fileTmpName);
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','jpg');

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0 )
            if ($fileSize <= 10000000){
                $fileDes = 'avatar/' . $fileName;
                move_uploaded_file($fileTmpName, $fileDes);
                $sql = "UPDATE db_image SET image='$fileDes' WHERE id_student='ST006'";
                $query = mysqli_query($conn, $sql);
                echo '<script>alert("Upload thành công")</script>';
            }else{
                echo "File too big";
            }

        }else{
            echo "error";
        }
    }
$sql2 = "SELECT * FROM db_image WHERE id_student='ST006'";
$res = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($res);
?>

<div>
    <img src="./<?php print_r($row['image']) ?>">
</div>
</body>
</html>