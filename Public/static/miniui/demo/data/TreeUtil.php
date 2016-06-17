<?php
class TreeUtil{
	public function ToList($tree,$parentId,$childrenField,$idField,$parentIdField,$isList){
		
		$list = array();
		
		for($i=0,$len=count($tree);$i<$len;$i++){
			$task = $tree[$i];
			$task[$parentIdField] = $parentId;
			
			$children = $task[$childrenField];
			if($children != null && count($children) > 0){
				$id = $task[$idField] == null ? "" : $task[$idField];
				$treeUtil = new TreeUtil();
				$list2 = $treeUtil->ToList($children,$id,$childrenField,$idField,$parentIdField);
				$list = array_merge($list,$list2);
			}
			//unset($task[$childrenField]);
			array_push($list,$task);
		}
		//如果传递的数据已经是list，需要删除重复的数据
		if($parentId == "-1" && $isList == true){
			for($m=0,$l=count($list);$m<$l;$m++){
				for($j=$m+1,$s=count($list);$j<$s;$j++){
					if($list[$m]["_id"] == $list[$j]["_id"]){
						if($list[$m][$idField] == null){
							$list[$j][$parentIdField] = $list[$m][$parentIdField];
							unset($list[$m]);
						}else{
							$list[$m][$parentIdField] = $list[$j][$parentIdField];	
							unset($list[$j]);
						}
						
					}
				}
			}
		}
		return $list;
	}
}
?>