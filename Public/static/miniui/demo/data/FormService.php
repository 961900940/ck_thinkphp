<?php
require_once('invoke.php');

$method = $_GET['method'];
switch($method){
	case "SaveData":
		SaveData();
		break;
	case "LoadData":
		LoadData();
		break;
}

function SaveData(){
	$submitJSON = $_POST["submitData"];
	writeJSON($submitJSON);
}

function LoadData(){
	$path = "form.txt";
	$content = file_get_contents($path);
	writeJSON($content);
}
?>