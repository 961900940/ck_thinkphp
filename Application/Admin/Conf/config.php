<?php
return array(
	/* 数据库设置 */
	'DB_TYPE'   => 'mysql',		// 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'knowledgesummary',  // 数据库名
    'DB_USER'   => 'root',		// 用户名
    'DB_PWD'    => '',		// 密码
    'DB_PORT'   => 3306,		// 端口
    'DB_PREFIX' => 'ks_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8',		// 字符集
    'DB_DEBUG'  =>  TRUE,		// 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    'SHOW_PAGE_TRACE' =>true,   // 显示页面Trace信息

	'URL_HTML_SUFFIX'=>'html|shtml|xml',	//URL伪静态后缀设置

    //修改模板引擎为smarty
    // 'TMPL_ENGINE_TYPE'		=>  'Smarty',

	/* 以下是RBAC认证配置信息 */


	/* SESSION设置 */
	'SESSION_AUTO_START'=>true,					// 是否自动开启Session

	/* 日志设置 */
	'LOG_RECORD' => true,		// 开启日志记录
    'LOG_LEVEL'  =>'INFO,EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误

	'admin_sub_menu' => array(
        'Common' => array(
            'Index/myInfo' => '修改密码',
            'Index/cache' => '缓存清理',
            'News/add' => '新闻发布'
        ),
        'Webinfo' => array(
            'index' => '站点配置',
            'setEmailConfig' => '邮箱配置',
            'setSafeConfig' => '安全配置',
            'setWeixin'=>'微信配置',
            'setListNum'=>'显示配置',
        ),
        'Models'=>array(
            'index'=>'模型列表',
            'add'=>'添加模型',
            ),
        'Fields'=>array(
            'conist/Models/index'=>'模型列表',
            'conist/Models/add'=>'添加模型',
            ),
        'Member' => array(
            'index' => '注册用户列表',
        ),
        'News' => array(
            'index' => '新闻列表',
            'category' => '新闻分类管理',
            'add' => '发布新闻',
        ),
        'Product'=>array(
            'index' => '产品列表',
            'category' => '产品分类管理',
            'add' => '发布产品',
        ),
        'Siteinfo'=>array(
            'index'=>'导航菜单',
            'adindex'=>'轮播管理',
            'page'=>'单页管理',
            'tag_index'=>'标签管理',
            'create_tag'=>'模版标签',
            'file_index'=>'文件管理',
            'link_index'=>'友情链接',
            'message'=>'留言信息'
        ),
        'SysData' => array(
            'index' => '数据库备份',
            'restore' => '数据库导入',
            'zipList' => '数据库压缩包',
            'repair' => '数据库优化修复'
        ),
        'Access' => array(
            'index' => '后台用户',
            'nodeList' => '节点管理',
            'roleList' => '角色管理',
            'addAdmin' => '添加管理员',
            'addNode' => '添加节点',
            'addRole' => '添加角色',
        ),
    ),

);
