<?php

require 'connect.php';

define('UPLOAD_PATH', 'uploads/');


if(isset($_FILES['pic']['name'])){
//uploading file and storing it to database as well
try{
$hue=$_POST['hue'];
$sat=$_POST['sat'];
$val=$_POST['val'];

$rawname = explode(".",$_FILES['pic']['name']);
$timestamp = time();
$fixname = $timestamp.'.'.$rawname[1];

move_uploaded_file($_FILES['pic']['tmp_name'], UPLOAD_PATH . $fixname);
$stmt = $conn->prepare("INSERT INTO meta_image (hue,sat,val,filename) VALUES (?,?,?,?)");
$stmt->bind_param("iiis",$hue, $sat,$val,$fixname);
if($stmt->execute()){
$response['error'] = false;
$response['message'] = 'File uploaded successfully';
header("location: index.php");
}else{
throw new Exception("Could not upload file");
}
}catch(Exception $e){
$response['error'] = true;
$response['message'] = 'Could not upload file';
}

}else{
$response['error'] = true;
$response['message'] = "Required params not available";
}
var_dump($response);
 ?>
