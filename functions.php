<?php 

if (!function_exists('getHostname')) {	
	function getHostname() {
   		 return trim(shell_exec("hostname"));
	}
  }

if (!function_exists('getUpTime')) {
	function getUptime() {
   		 return trim(shell_exec("uptime -p")); 
	}
  }

if (!function_exists(function: 'getLoggedInUsersCount')){
	function getLoggedInUsersCount() {
		$count = trim(shell_exec("who | wc -l"));
		return (int)$count;
	}
}  

if (!function_exists('getMemory')) {
	function getMemory() {
    	$memInfo = shell_exec("free -m");
    	preg_match_all('/\d+/', $memInfo, $matches);
   	 	return [
        	'total_MB' => (int)$matches[0][0],
        	'used_MB' => (int)$matches[0][1],
        	'free_MB' => (int)$matches[0][2],
   	 ];
	}
}

if (!function_exists('getDisk')) {
	function getDisk() {
    	$disk = shell_exec("df -h /");
    	$lines = explode("\n", trim($disk));
    	$parts = preg_split('/\s+/', $lines[1]);
    	return [
        'size' => $parts[1],
        'used' => $parts[2],
        'available' => $parts[3],
        'usage_percent' => $parts[4],
   	 ];
	}
}