<?php
require_once('invoke.php');

function create_guid() {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
        .substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12)
        .chr(125);// "}"
        return $uuid;
    }

function LoadTree(){
	
	$myconn = createDB();
	
	$sql = "select * from plus_file order by num";
	$result=mysql_query($sql,$myconn);
	$data = array();
	
	while($row=mysql_fetch_array($result,MYSQL_ASSOC))
	{
		array_push($data,$row);
	}
	
	writeJSON($data);
}

function LoadNodes(){
	$id = $_GET["id"];
	if(empty($id) || $id == null){
		$id = "-1";
	}
	
	$myconn = createDB();
	
	$sql = "select * from plus_file where pid = '" . $id . "' order by num";
	$result=mysql_query($sql,$myconn);
	$data = array();
	
	while($row=mysql_fetch_array($result))
	{
		
		$nodeId = $row["id"];
		
		$sql2 = "select * from plus_file where pid = '" . $nodeId . "' order by num";
		$result2=mysql_query($sql2,$myconn);
		$node = mysql_fetch_array($result2);
		if($node){
			$row["isLeaf"] = false;
			$row["expanded"] = false;
		}
		
		array_push($data,$row);
	}
	
	writeJSON($data);
}

function SaveTree(){
	$myconn = createDB();
	require_once('TestDB.php');
	$testDB = new TestDB();
	
	$dataJSON = request("data");
	$removedJSON = request("removed");
	
	$tree = php_json_decode($dataJSON);
	$removed = php_json_decode($removedJSON);
	
	require_once('TreeUtil.php');
	$treeUtil = new TreeUtil();
	
	//����ת��Ϊ�б�
	$list = $treeUtil->ToList($tree,"-1","children","id","pid");
	
	//����id
	for($i=0,$l=count($list);$i<$l;$i++){
		if($list[$i]["id"] == null){
			
			$guid = create_guid();
			$list[$i]["id"] = $guid;
		}
		$list[$i]["num"] = $i;   //�����ţ���ȡ��ʱ��order by numһ��
		/*array_push($arr,$node);*/
	}
	
	//����pid
	$treeUtil->ToList($list,"-1","children","id","pid",true);
	
	for($i=0,$l=count($list);$i<$l;$i++){
		$node = $list[$i];
		$state = $node["_state"];
		
		if($node["createdate"] == null){
			$node["createdate"] = date('Y-m-d H:i:s',time());
		}
		if($node["updatedate"] == null){
			$node["updatedate"] = date('Y-m-d H:i:s',time());
		}
		
		if($state == "added"){
			$testDB->InsertNode($node);
		}else{
			$testDB->UpdateTreeNode($node);
		}
	}
	
	//removeNode
	if($removed != null){
		for($i=0,$l=count($removed);$i<$l;$i++){
			$removedNode = $removed[$i];
			$testDB->RemoveNode($removedNode);
		}
	}
}



function FilterTree(){
	$data = array();
	
	$myconn = createDB();
	
	//��ȡ��ѯ����
	$json = request("name");
	
	$text = strtolower($json);
	
	//��ȡ����������
	$sql = "select * from plus_file";
	$nodes = mysql_query($sql,$myconn);
	
	//�ҳ����ϲ�ѯ�����Ľڵ�
	while($node=mysql_fetch_array($nodes)){
		if(strpos(strtolower($node["name"]),$text) !== false){
			array_push($data,$node);
			
			//���븸�����нڵ�
			$pid = $node["pid"];
			if($pid != "-1"){
				$data2 = SearchParentNode($pid,mysql_query($sql,$myconn));
				$data = array_merge($data,$data2);
			}
		}
	}
	
	
	//ȥ���ظ��ڵ�
	$idMaps;
	for($i=count($data)-1;$i>=0;$i--){
		$node = $data[$i];
		$id = $node["id"];
		if($idMaps[$id] == null){
			$idMaps[$id] = $node;
		}else{
			array_splice($data,$i,1);
		}
	}
	//����JSON
	$dataJson = writeJSON($data);
	print_r($dataJson);
}

function SearchParentNode($pid,$nodes){
	$data = array();
	
	while($node=mysql_fetch_array($nodes)){
		if($node["id"] == $pid){
			array_push($data,$node);
			if($node["pid"] != "-1"){
				$data2 = SearchParentNode($node["pid"],$nodes);
				$data = array_merge($data,$data2);
			}
		}
	}
	return $data;
}
?>