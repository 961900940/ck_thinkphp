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
  +-----------------------------------------------------------------------------------------
 * 删除目录及目录下所有文件或删除指定文件
  +-----------------------------------------------------------------------------------------
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
  +-----------------------------------------------------------------------------------------
 * @return bool 返回删除状态
  +-----------------------------------------------------------------------------------------
 */
function delDirAndFile($path, $delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}


/**
 * 功能：检测一个字符串是否是邮件地址格式
 * @param string $value    待检测字符串
 * @return boolean
 */
function is_email($value) {
    return preg_match("/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i", $value);
}

/**
  +----------------------------------------------------------
 * 功能：计算文件大小
  +----------------------------------------------------------
 * @param int $bytes
  +----------------------------------------------------------
 * @return string 转换后的字符串
  +----------------------------------------------------------
 */
function byteFormat($bytes) {
    $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}

/**
  +----------------------------------------------------------
 * 生成随机字符串
  +----------------------------------------------------------
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
  +----------------------------------------------------------
 * @return string
  +----------------------------------------------------------
 */
function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    $code='';
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } else if ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str[$i] = $string[rand(0, $count)];
        $code .= $str[$i];
    }
    return $code;
}
