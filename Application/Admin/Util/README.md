###分页类的使用1: 	     12 条记录 1/6 页 1 2 3 4 5 下一页 尾页
		1、控制器添加方法：ck_thinkphp\Application\Admin\Util\Page.class - 副本.php
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$pagenum = 3;
		$page = $_GET['p'] ? $_GET['p'] : 1;
		$article = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
			->field('a.*,b.category_name')
			->where($where)
			->order("update_time desc")
			->page($page,$pagenum)
			->select();
		$this->assign('article',$article);	// 赋值数据集
		
		// 查询满足要求的总记录数
		$count = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
			->field('a.*,b.category_name')
			->where($where)
			->order("a.update_time desc")
			->count("a.id");
		//$Page = new \Think\Page($count,$pagenum);// 实例化分页类 (框架自带分页类调用方法)
		$Page = new \Admin\Util\Page($count,$pagenum);// 实例化分页类
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
        $this->display();

		2、页面引用
		<load href="__PUBLIC__/static/bootstrap/css/bootstrap.css"/>
		<load href="__Admin_CSS__/page_index.css"/>
		<div class="pagination" style="width:100%">{$page}</div>

		<div class="pagination">{$page}</div> //基本样式
		<div class="pagination pagination-large">{$page}</div>//大号数字样式


###分页类的使用2: 	< 12 条记录 1/6 页 下一页  12345 >> 末页>
		注意：修改相应样式，只需取 page.css 里面的class即可
		1、控制器添加方法：ck_thinkphp\Application\Admin\Util\Page3.class.php
		2、页面引用
		<load href="__Admin_CSS__/page.css" / >
        <div class="manu"><{$page}><div/>

###分页类的使用2: 	<< 1 2 3 4
		1、控制器添加方法：ck_thinkphp\Application\Admin\Util\Page2.class.php
		
		2、页面引用
		<load href="__STATIC__/bootstrap/css/bootstrap.min.css"/>
		<div class="pagination" style="width:100%">{$page}</div>
		