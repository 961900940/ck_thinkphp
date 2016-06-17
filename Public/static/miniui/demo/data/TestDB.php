<?php
require_once('invoke.php');
class TestDB{
	
	public function InsertNode($node){
		$myconn = createDB();
		
		$sql="insert into plus_file set createdate='".$node["createdate"]."',updatedate='".$node["updatedate"]."', id='".$node["id"]."',name='".$node["name"]."',type='".$node["type"]."',size='".$node["size"]."',url='".$node["url"]."',pid='".$node["pid"]."',num='".$node["num"]."'";
		mysql_query($sql,$myconn);
	}
	
	public function UpdateTreeNode($node){
		$myconn = createDB();
		$sql = "update plus_file set name = '{$node["name"]}',createdate = '{$node["createdate"]}',updatedate = '{$node["updatedate"]}',type = '{$node["type"]}',size = '{$node["size"]}',url = '{$node["url"]}',pid = '{$node["pid"]}',num = '{$node["num"]}' where id = '{$node["id"]}'";
		
		mysql_query($sql,$myconn);
	}
	
	public function RemoveNode($node){
		$myconn = createDB();
		
		$id = $node["id"];
		$sql = "delete from plus_file where id = '".$id."'";
		mysql_query($sql,$myconn);
	}
	
	public function SearchEmploye($key, $index, $size, $sortField, $sortOrder){
		$myconn = createDB();
		
		$countresult=mysql_query("select count(1) from t_employee where name like '%" . $key . "%' ",$myconn);
		$datacount=mysql_fetch_array($countresult);
		$total = $datacount[0];
		
		$start = $index * $size;
		
		if(!empty($sortField)){
			if ($sortOrder != "desc") $sortOrder = "asc";
			$order = " order by " . $sortField . " " . $sortOrder;
		}else{
			$order = " order by createtime desc";
		}
		
		$sql = "
		select a.*, b.name dept_name, c.name position_name, d.name educational_name
		from t_employee a
		left join t_department b
		on a.dept_id = b.id 
		left join t_position c
		on a.position = c.id 
		left join t_educational d
		on a.educational = d.id 
		where a.name like '%" . $key . "%' ".$order."
		limit $start,$size";
		
		$dataresult=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($dataresult))
		{
			array_push($data,$row);
		}
		
		$resultData = array("total"=>$total,"data"=>$data);
		return $resultData;
	}
	
	public function InsertEmployee($user){
		$myconn = createDB();
		
		require_once('guid.php');  
		$computer_name = $_SERVER["SERVER_NAME"];  
		$ip            = $_SERVER["SERVER_ADDR"];  
		$guid = new Guid($computer_name, $ip);
		
		if($user["id"] == null || $user["id"] == ""){
			$user["id"] = $guid->toString();
			$user["createtime"] = date('Y-m-d H:i:s',time());
		}
		if($user["name"] == null)$user["name"] = "";
		if($user["married"] == null || $user["married"] == "")$user["married"] = "0";
		if($user["age"] == null || $user["age"] == "")$user["age"] = "0";
		if($user["gender"] == null || $user["gender"] == "")$user["gender"] = "0";
		
		if($user["birthday"] == "") $user["birthday"] = "null";
		else $user["birthday"] = '"'.$user["birthday"].'"';
		
		$sql = "insert into t_employee (id, loginname, name, age, married, gender, birthday, country, city, dept_id, position, createtime, salary, educational, school, email, remarks)values('".$user["id"]."', '".$user["loginname"]."', '".$user["name"]."', '".$user["age"]."', '".$user["married"]."', '".$user["gender"]."', ".$user["birthday"].", '".$user["country"]."', '".$user["city"]."', '".$user["dept_id"]."', '".$user["position"]."','".$user["createtime"]."', '".$user["salary"]."', '".$user["educational"]."', '".$user["school"]."','".$user["email"]."', '".$user["remarks"]."')";
		mysql_query($sql,$myconn);
		
		return $guid->toString();
	}
	
	public function DeleteEmployee($id){
		if($id == null) $id = request("pageIndex");
		
		$myconn = createDB();
		$sql = "delete from t_employee where id = '".$id."'";
		mysql_query($sql,$myconn);
	}
	
	public function GetEmployee($id){
		$myconn = createDB();
		
		$sql = "select * from t_employee where id = '".$id."'";
        $result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		return count($data) > 0 ? $data[0] : null;
	}
	
	public function GetDepartments(){
		$myconn = createDB();
		
		$sql = "select a.* from t_department a";
		$result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		return $data;
	}
	
	public function GetDepartment($id){
		$myconn = createDB();
		
		$sql = "select * from t_department where id = '" . $id . "'";
		$result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		return count($data) > 0 ? $data[0] : null;
	}
	
	public function GetPositions(){
		$myconn = createDB();
		
		$sql = "select * from t_position";
		
		$result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		return $data;
	}
	
	public function GetEducationals(){
		$myconn = createDB();
		
		$sql = "select * from t_educational";
		$result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		return $data;
	}
	
	public function GetPositionsByDepartmenId($departmentId){
		$myconn = createDB();
		
		$sql = "select * from t_position where dept_id = '" . $departmentId . "'";
		$result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		return $data;
	}
	
	public function GetDepartmentEmployees($departmentId, $index, $size){
		$myconn = createDB();
		
		$sql = "select * from t_employee where dept_id = '" . $departmentId . "'";
		$result=mysql_query($sql,$myconn);
		$data = array();
		while($row=mysql_fetch_array($result))
		{
			array_push($data,$row);
		}
		
		$total = count($data);
		
		$start = $index * $size;
		$end = $start + $size;
		if($start > count($data)){
			$start = count($data);
		};
		if($end > count($data)){
			$end = count($data);
		};
		$pagingData = array_slice($data,$start,$end);
		$resultData = array("total"=>$total,"data"=>$pagingData);
		
		return $resultData;
	}
	
	public function UpdateEmployee($user){
		$db_user = $this->GetEmployee($user["id"]);
		foreach ($user as $key=>$value){ 
			 $db_user[$key] = $value;
		}  
		
		$this->DeleteEmployee($user["id"]);
		$this->InsertEmployee($db_user);
	}
	
	public function UpdateDepartment($d){
		$myconn = createDB();
		
		$db_d = $this->GetDepartment($d["id"]);
		$db_d["manager_name"] = $d["manager_name"];
		$sql = "update t_department set name = '{$db_d["name"]}',manager = '{$db_d["manager"]}',manager_name = '{$db_d["manager_name"]}' where id = '{$db_d["id"]}'";
		mysql_query($sql,$myconn);
	}
}
?>