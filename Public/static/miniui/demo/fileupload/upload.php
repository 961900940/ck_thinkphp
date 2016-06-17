<?php
$path = "./upload/";
$Fdata = $_FILES["Fdata"]["name"];
$file = iconv("UTF-8","gb2312", $path.$Fdata);
$result = move_uploaded_file($_FILES["Fdata"]["tmp_name"], $file);
if($result == true){
	date_default_timezone_set("PRC");
	$date = date("Y-m-d H:i:s");
	echo $Fdata.$date;
}
?>