<?php
session_start();
$message = '';
if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
  $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
  $fileName = $_FILES['uploadedFile']['name'];
  $fileSize = $_FILES['uploadedFile']['size'];
  $fileType = $_FILES['uploadedFile']['type'];
  $fileNameCmps = explode(".", $fileName);
  $fileExtension = strtolower(end($fileNameCmps));
  // $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
  $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

  if (in_array($fileExtension, $allowedfileExtensions)) {
    $uploadFileDir = './uploaded/';
    $dest_path = $uploadFileDir . $fileName;

    if(move_uploaded_file($fileTmpPath, $dest_path)) {
      $message ='File is successfully uploaded.';
    }
    else {
      $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
    }
  }
  else{
    $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
  }
}
else{
  $message = 'ERROR.<br>';
  $message .= 'Error:' . $_FILES['uploadedFile']['error'];
}
$_SESSION['message'] = $message;
header("Location: dashboard.php");