###kindeditor-4.1.4使用方法
		1、修改文件内容(图片上传路径 ck_thinkphp\upload\image\20160815\20160815173157_69238.jpg)
		修改file_manager_json.php
		$root_path = $php_path . '../../../../upload/';
		$root_url = $php_url . '../../../../upload/';
		修改upload_json.php
		$save_path = $php_path . '../../../../upload/';
		$save_url = $php_url . '../../../../upload/';

		2、页面添加代码
		<textarea name="content" style="width:700px;height:200px;visibility:hidden;">KindEditor</textarea>
		
		引用js文件
		<link rel="stylesheet" href="__STATIC__/kindeditor-4.1.4/themes/default/default.css" />
        <script charset="utf-8" src="__STATIC__/kindeditor-4.1.4/kindeditor-min.js"></script>
        <script charset="utf-8" src="__STATIC__/kindeditor-4.1.4/lang/zh-CN.js"></script>
	
		添加js
		<script>
           var editor;
           KindEditor.ready(function(K) {
              editor = K.create('textarea[name="content"]', {
	              //filterMode : false,    //关闭HTML过滤
	              resizeType : 2,         //1时只能改变高度，0时不能拖动，2时可以拖动改变高度，宽度
	              autoHeightMode : true,    //自动调整高度
	              allowPreviewEmoticons : true,	//鼠标放在表情上可以预览表情。
				  allowImageUpload : true,
	              allowFileManager : true,
	              uploadJson : '__STATIC__/kindeditor-4.1.4/php/upload_json.php',
	              fileManagerJson : '__STATIC__/kindeditor-4.1.4/php/file_manager_json.php',
	              minWidth:"600px",    //编辑器最小宽度
	              minHeight:"500px",    //编辑器最小高度
	              afterChange : function() {
					  K('.word_count1').html(this.count());
					  K('.word_count2').html(this.count('text'));
				  },
				  items : [
					  'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					  'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					  'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link','code','fullscreen']
				});
			});
		</script>

		3、添加隐藏表单；提交时把编辑器的值充填隐藏表单
		<input type="hidden" id="contents" name="contents" value=""/>

		4、后台过滤隐藏表单值
		$content = html_entity_decode( I("contents"));//htmlspecialchars_decode
		

		