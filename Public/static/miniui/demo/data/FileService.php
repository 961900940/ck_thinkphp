<?php
require_once('invoke.php');
	
function LoadFolders(){
	$id = $_GET["id"];
	if(empty($id) || $id == null){
		$id = "-1";
	}
	$myconn = createDB();
	
	$sql = "select * from plus_file where folder = 1 and pid = '" . $id . "' order by updatedate";
	$result=mysql_query($sql,$myconn);
	$data = array();
	while($row=mysql_fetch_array($result))//通过循环读取数据内容
	{
		
		$nodeId = $row["id"];
		
		$row["isLeaf"] = false;
		$row["expanded"] = false;
		
		array_push($data,$row);
	}
	writeJSON($data);
}

function LoadFiles(){
	$folderId = $_GET["folderId"];
	$myconn = createDB();
	$sql = "select * from plus_file where pid = '" . $folderId . "' and folder = 0 order by updatedate";
	$result=mysql_query($sql,$myconn);
	$data = array();
	while($row=mysql_fetch_array($result))//通过循环读取数据内容
	{
		array_push($data,$row);
	}
	writeJSON($data);
}
?>
