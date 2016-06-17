<?php  
// guid.php  
class System {  
	function currentTimeMillis() {  
		list($usec, $sec) = explode(" ",microtime());  
		return $sec.substr($usec, 2, 3);  
	}  
}  

class NetAddress {  
	var $name = 'localhost';  
	var $ip   = '127.0.0.1';  
	function getHost($coumputer_name, $ip) { // static  
		$address = new NetAddress();  
		$address->name = $coumputer_name;  
		$address->ip   = $ip;  
		
		return $address;  
	}  
	
	function toString() {  
		return strtolower($this->name.'/'.$this->ip);  
	}  
}  

class Random {  
	function nextLong() {  
		$tmp = rand(0,1)?'-':'';  
		return $tmp.rand(1000, 9999).rand(1000, 9999).rand(1000, 9999).rand(100, 999).rand(100, 999);  
	}  
}  

class Guid{  
	var $valueBeforeMD5;  
	var $valueAfterMD5;  
	function Guid($computer_name, $ip){  
		$this->getGuid($computer_name, $ip);  
	}  
	
	function getGuid($coumputer_name, $ip){  
		$address = NetAddress::getHost($coumputer_name, $ip);  
		$this->valueBeforeMD5 = $address->toString().':'.System::currentTimeMillis().':'.Random::nextLong();  
		$this->valueAfterMD5 = md5($this->valueBeforeMD5);  
	}  
	
	function newGuid() {  
		$Guid = new Guid();  
		return $Guid;  
	}  
	
	function toString() {  
		$raw = strtoupper($this->valueAfterMD5);  
		return substr($raw,0,8).'-'.substr($raw,8,4).'-'.substr($raw,12,4).'-'.substr($raw,16,4).'-'.substr($raw,20);  
	}  
}  
?> 