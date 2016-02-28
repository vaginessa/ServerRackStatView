<?php 
		exec('typeperf -sc 1 "\Processor(*)\% Processor Time"', $cpuusage);
		$cpuusage = str_replace('"','',$cpuusage);
		$cpuusage = explode(',', $cpuusage[2]);
		$cpuusage=$cpuusage[9];
		echo $cpuusage;
?>