<?php 
	exec('typeperf -sc 1 "\Network Interface(*)\Bytes Received/sec"', $netusage);
	$netusage = str_replace('"','',$netusage);
	$netusage = explode(',', $netusage[2]);
	$netusage=$netusage[2];
	//convert to MBits
	//$netusage = number_format(($netusage / 131072),3);
	//convert to MBs
	$netusage = number_format((($netusage/1024)/1024),3);
	echo $netusage;
?>