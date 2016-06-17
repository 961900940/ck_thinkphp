<?php

/**
 * 验证验证码
 * @param $code
 * @param string $id
 * @return bool
 */
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
*格式化输出
*/
function p($content){
    echo '<pre>';
    print_r($content);
    echo '</pre>';
}

/**
*获取客户端真实IP地址
*/
function getIP() { 
	if (getenv('HTTP_CLIENT_IP')) { 
		$ip = getenv('HTTP_CLIENT_IP'); 
	}elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
		$ip = getenv('HTTP_X_FORWARDED_FOR'); 
	}elseif (getenv('HTTP_X_FORWARDED')) { 
		$ip = getenv('HTTP_X_FORWARDED'); 
	}elseif (getenv('HTTP_FORWARDED_FOR')) { 
		$ip = getenv('HTTP_FORWARDED_FOR'); 
	}elseif (getenv('HTTP_FORWARDED')) { 
		$ip = getenv('HTTP_FORWARDED'); 
	}else { 
		$ip = $_SERVER['REMOTE_ADDR']; 
	} 
	return $ip; 
} 
/**
 * 功能：检测一个目录是否存在，不存在则创建它
 * @param string    $path      待检测的目录
 * @return boolean
 */
function mkdirs($path) {
    return is_dir($path) or (mkdirs(dirname($path)) and @mkdir($path, 0777));
}

/**
 * 功能：检测一个字符串是否是邮件地址格式
 * @param string $value    待检测字符串
 * @return boolean
 */
function is_email($value) {
    return preg_match("/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i", $value);
}
