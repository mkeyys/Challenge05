<?php
session_start();
$message = '';
$name = $_SESSION['name'];

if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
  $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
  $fileName = $name.":".$_FILES['uploadedFile']['name'];
  $fileSize = $_FILES['uploadedFile']['size'];
  $fileType = $_FILES['uploadedFile']['type'];
  $fileNameCmps = explode(".", $fileName);
  $fileExtension = strtolower(end($fileNameCmps));
  // $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
  $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

  if (in_array($fileExtension, $allowedfileExtensions)) {
    $uploadFileDir = './uploadStudent/';
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
  $message = 'There is some error in the file upload. Please check the following error.<br>';
  $message .= 'Error:' . $_FILES['uploadedFile']['error'];
}
echo($message);
$_SESSION['message'] = $message;
// header("Location: dashboard.php");