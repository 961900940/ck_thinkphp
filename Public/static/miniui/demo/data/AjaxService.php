<?php
require_once('invoke.php');
function SearchEmployees(){
	$key = request("key");
	$pageIndex = request("pageIndex");
	$pageSize = request("pageSize");
	
	$sortField = request("sortField");
    $sortOrder = request("sortOrder");
	
	require_once('TestDB.php');
	$testDB = new TestDB();
	$resultData = $testDB->SearchEmploye($key,$pageIndex,$pageSize,$sortField,$sortOrder);
	
	
	ob_end_clean();
	$json = json_encode($resultData);
	print_r($json);
};
function SaveEmployees(){
	$json = request("data");
	$rows = php_json_decode($json);
	require_once('TestDB.php');
	$testDB = new TestDB();
	foreach ($rows as $row){
		$id = $row["id"] != null?$row["id"]:"";
    $state = $row["_state"] != null?$row["_state"]:"";
	if($state == "added" || $id == ""){ //新增：id为空，或_state为added
		$row["createtime"] = date("Y-m-d   h:i:s");
		$testDB->InsertEmployee($row);
	}
		else if ($state == "removed" || $state == "deleted")
    {
			$testDB->DeleteEmployee($id);
    }
		else if ($state == "modified" || $state == "")  //更新：_state为空或modified
    {
			$testDB->UpdateEmployee($row);
    }
	}  
};
function RemoveEmployees(){
	$idStr = request("id");
	if (empty($idStr)) return;
    $ids = explode(',',$idStr);
	for ($i = 0, $l = count($ids); $i < $l; $i++)
    {
        $id = $ids[$i];
		require_once('TestDB.php');
		$testDB = new TestDB();
		$testDB->DeleteEmployee($id);
    }
}
function GetEmployee(){
	$id = $_GET["id"];
	require_once('TestDB.php');
	$testDB = new TestDB();
	$data = $testDB->GetEmployee($id);
	ob_end_clean();
	$json = json_encode($data);
	print_r($json);
};
function GetDepartments(){
	require_once('TestDB.php');
	$testDB = new TestDB();
	$data = $testDB->GetDepartments();
	ob_end_clean();
	$json = json_encode($data);
	print_r($json);
};
function GetPositions(){
	require_once('TestDB.php');
	$testDB = new TestDB();
	$data = $testDB->GetPositions();
	ob_end_clean();
	$json = json_encode($data);
	print_r($json);
}
function GetEducationals(){
	require_once('TestDB.php');
	$testDB = new TestDB();
	$data = $testDB->GetEducationals();
	ob_end_clean();
	$json = json_encode($data);
	print_r($json);
}
function GetPositionsByDepartmenId(){
	$id = request("id");
	require_once('TestDB.php');
	$testDB = new TestDB();
	$data = $testDB->GetPositionsByDepartmenId($id);
	ob_end_clean();
	$json = json_encode($data);
	print_r($json);
}
function GetDepartmentEmployees(){
	$dept_id = request("dept_id");
	$pageIndex = request("pageIndex");
    $pageSize = request("pageSize");
	
	require_once('TestDB.php');
	$testDB = new TestDB();
	$data = $testDB->GetDepartmentEmployees($dept_id,$pageIndex,$pageSize);
	ob_end_clean();
	$json = json_encode($data);
	print_r($json);
}
function SaveDepartment(){
	$departmentsStr = request("departments");
	$departments = php_json_decode($departmentsStr);
	require_once('TestDB.php');
	$testDB = new TestDB();
	foreach ($departments as $d){
		$data = $testDB->UpdateDepartment($d);
	}
}
function FilterCountrys(){
	$key = request("key");
	$value = request("value");
	
	$values = explode(",",$value);
	$valueMap = array();
	for($i=0;$i<count($values);$i++){
		$id = $values[$i];
		$valueMap[$id] = true;
	}
	$path = "countrys.txt";
	$content = substr(file_get_contents($path), 3);
	$data = json_decode($content,true);
	for($i=count($data)-1;$i>=0;$i--){
		$o = $data[$i];
		$id = $o["id"];
		if ($valueMap[$id] !== null){
			array_splice($data,$i,1);
		}
	}
	
	$result = array();
	for($i=0;$i<count($data);$i++){
		$o = $data[$i];
		$text = $o["text"];
		
		if(empty($key) || strripos($text,$key) !== false){
			array_push($result,$o);
		}
	}
	ob_end_clean();
	$json = json_encode($result);
	print_r($json);
}
function FilterCountrys2(){
	$key = request("key");
	$path = "countrys.txt";
	$content = substr(file_get_contents($path), 3); 
	$data = json_decode($content,true);
	$result = array();
	for($i=0;$i<count($data);$i++){
		$o = $data[$i];
		$text = $o["text"];
		
		if(empty($key)|| $key=="" || strripos($text,$key) !== false){
			array_push($result,$o);
		}
	}
	ob_end_clean();
	$json = json_encode($result);
	print_r($json);
}

?>