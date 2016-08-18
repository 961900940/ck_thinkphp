###ueditor1_ 4_ 3_3-utf8-php(推荐)
		1、修改配置文件 ck_thinkphp/Public/static/ueditor1_4_3_3-utf8-php/php/config.json
		"imagePathFormat": "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */

		2、页面添加代码
		<form action="__SELF__" method="post">
            <!-- 加载编辑器的容器 -->
            <script id="container" name="content" type="text/plain">

            </script>
            <!-- 配置文件 -->
            <script type="text/javascript" src="__STATIC__/ueditor1_4_3_3-utf8-php/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="__STATIC__/ueditor1_4_3_3-utf8-php/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container',{
                    toolbars: [
                        [
                           'anchor', //锚点
                           'undo', //撤销
                           'redo', //重做
                           'bold', //加粗
                           'indent', //首行缩进
                           'snapscreen', //截图
                           'italic', //斜体
                           'underline', //下划线
                           'strikethrough', //删除线
                           'subscript', //下标
                           'fontborder', //字符边框
                           'superscript', //上标
                           'formatmatch', //格式刷
                           'source', //源代码
                           'blockquote', //引用
                           'pasteplain', //纯文本粘贴模式
                           'selectall', //全选
                           'print', //打印
                           'preview', //预览
                           'horizontal', //分隔线
                           'removeformat', //清除格式
                           'time', //时间
                           'date', //日期
                           'unlink', //取消链接
                           'insertrow', //前插入行
                           'insertcol', //前插入列
                           'mergeright', //右合并单元格
                           'mergedown', //下合并单元格
                           'deleterow', //删除行
                           'deletecol', //删除列
                           'splittorows', //拆分成行
                           'splittocols', //拆分成列
                           'splittocells', //完全拆分单元格
                           'deletecaption', //删除表格标题
                           'inserttitle', //插入标题
                           'mergecells', //合并多个单元格
                           'deletetable', //删除表格
                           'cleardoc', //清空文档
                           'insertparagraphbeforetable', //"表格前插入行"
                           'insertcode', //代码语言
                           'fontfamily', //字体
                           'fontsize', //字号
                           'paragraph', //段落格式
                           'simpleupload', //单图上传
                           'insertimage', //多图上传
                           'edittable', //表格属性
                           'edittd', //单元格属性
                           'link', //超链接
                           'emotion', //表情
                           'spechars', //特殊字符
                           'searchreplace', //查询替换
                           'map', //Baidu地图
                           'gmap', //Google地图
                           'insertvideo', //视频
                           'help', //帮助
                           'justifyleft', //居左对齐
                           'justifyright', //居右对齐
                           'justifycenter', //居中对齐
                           'justifyjustify', //两端对齐
                           'forecolor', //字体颜色
                           'backcolor', //背景色
                           'insertorderedlist', //有序列表
                           'insertunorderedlist', //无序列表
                           'fullscreen', //全屏
                           'directionalityltr', //从左向右输入
                           'directionalityrtl', //从右向左输入
                           'rowspacingtop', //段前距
                           'rowspacingbottom', //段后距
                           'pagebreak', //分页
                           'insertframe', //插入Iframe
                           'imagenone', //默认
                           'imageleft', //左浮动
                           'imageright', //右浮动
                           'attachment', //附件
                           'imagecenter', //居中
                           'wordimage', //图片转存
                           'lineheight', //行间距
                           'edittip ', //编辑提示
                           'customstyle', //自定义标题
                           'autotypeset', //自动排版
                           'webapp', //百度应用
                           'touppercase', //字母大写
                           'tolowercase', //字母小写
                           'background', //背景
                           'template', //模板
                           'scrawl', //涂鸦
                           'music', //音乐
                           'inserttable', //插入表格
                           'drafts', // 从草稿箱加载
                           'charts', // 图表
                       ]
                    ],
                    // autoHeight:true,
                    autoHeightEnabled: true,
                    autoFloatEnabled: true,
                });
                var lang = ue.getOpt('lang'); //默认返回：zh-cn,读取配置项可以通过getOpt方法读取
                //alert(lang);
            </script>
			<div class="commonBtnArea">
				<button class="btn submit" type="submit">提交</button>
			</div>
        </form>	

		3、控制器添加代码(过滤)
		$data['content'] = htmlspecialchars_decode(I('editor'));

		4、路径地址：/ck_thinkphp/upload/image/20160817/1471430770127120.jpg
		图片文件夹：ck_thinkphp/upload/image/20160817/


###kindeditor使用方法
		1、修改文件内容(图片上传路径)
	    修改file_manager_json.php
	    $root_path = $php_path . '../../../../upload/';
	    $root_url = $php_url . '../../../../upload/';
	    修改upload_json.php
	    $save_path = $php_path . '../../../../upload/';
	    $save_url = $php_url . '../../../../upload/';

		2、页面添加代码
		<form action="{:U('Product/addProduct')}" method="post">
			<script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
			<script type="text/javascript" src="__STATIC__/kindeditor/kindeditor-all-min.js"></script>
			<script type="text/javascript" src="__STATIC__/kindeditor/lang/zh_CN.js"></script>
			<!--  <script charset="utf-8" src="__PUBLIC__/editor/kindeditor/plugins/code/prettify.js"></script> -->
			<link rel="stylesheet" type="text/css" href="__STATIC__/kindeditor/themes/default/default.css ">
	
			<textarea name="content" id="content" style="width:800px;height:300px"></textarea>
			<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('#content');
				});
			</script>
			</script>
	        <div class="commonBtnArea">
	            <button class="btn submit" type="submit">提交</button>
	        </div>
		</form>

		3、控制器 htmlspecialchars_decode转换一下
		$data['content'] = htmlspecialchars_decode($content);

		4、路径地址：/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160817/20160817190352_41582.jpg
		图片文件夹 ck_thinkphp/upload/image/20160817/


###kindeditor-4.1.4使用方法
		1、修改文件内容(图片上传路径)
		修改file_manager_json.php
		$root_path = $php_path . '../../../../upload/';
		$root_url = $php_url . '../../../../upload/';
		修改upload_json.php
		$save_path = $php_path . '../../../../upload/';
		$save_url = $php_url . '../../../../upload/';

		2、页面添加代码
		<form action="__SELF__" method="post" enctype="multipart/form-data">
            <link rel="stylesheet" href="__STATIC__/kindeditor-4.1.4/themes/default/default.css" />
    		<script charset="utf-8" src="__STATIC__/kindeditor-4.1.4/kindeditor-min.js"></script>
    		<script charset="utf-8" src="__STATIC__/kindeditor-4.1.4/lang/zh-CN.js"></script>

            <textarea name="content" style="width:700px;height:200px;visibility:hidden;">KindEditor</textarea>
            <p>
				<!-- 您当前输入了 <span class="word_count1">0</span> 个文字。（字数统计包含HTML代码。）<br /> -->
				您当前输入了 <span class="word_count2">0</span> 个文字。（字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字。）
			</p>
            <input type="hidden" id="contents" name="contents" value=""/>
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
        </form>
        <div class="commonBtnArea">
            <button class="btn submit" type="submit">提交</button>
        </div>

		添加隐藏表单；提交时把编辑器的值充填隐藏表单，so添加js
		<script type="text/javascript">
            $(".submit").click(function() {
                $("#contents").val(editor.html());
                $("form").submit();
            });
        </script>

		3、后台过滤隐藏表单值
		$content = html_entity_decode( I("contents"));//htmlspecialchars_decode
		

###umeditor1 _2 _2-utf8-php
		1、修改上传文件路径 ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/imageUp.php
		"savePath" => "images/" ,
		 $Path = "images/";

		2、页面添加代码
		<form action="__SELF__" method="post">
			<!--样式图片和样式文件-->
			<link href="__STATIC__/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
			<!--第三方插件-->
			<script type="text/javascript" src="__STATIC__/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
			<!-- 配置文件 -->
			<script type="text/javascript" src="__STATIC__/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
			<!-- 编辑器源码文件 -->
			<script type="text/javascript" src="__STATIC__/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
			<!-- 语言包文件 -->
			<script type="text/javascript" charset="utf-8" src="__STATIC__/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>
			<!-- 实例化编辑器 -->
			<script type="text/javascript">
				$(function(){
					var um = UM.getEditor('editor');
				});
	
			</script>
	        <!-- 加载编辑器的容器 -->
			<script type="text/plain" id="editor" name="editor" style="width:100%;height:360px;"></script>
			<div class="commonBtnArea">
				<button class="btn submit" type="submit">提交</button>
			</div>
    	</form>

		3、控制器添加代码(过滤)
		$data['content'] = htmlspecialchars_decode(I('editor'));

		4、路径地址：http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714306455675.jpg
		文件夹地址：http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/



		