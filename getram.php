<?php 
		exec('typeperf -sc 1 "\Memory\Available bytes"', $ramusage);
		//save time waiting for typeperf by storing max ram manually
		$maxram = 64;
		//take out any qoutes from return
		$ramusage = str_replace('"','',$ramusage);
		//break relevant results into array
		$ramusage = explode(',', $ramusage[2]);
		//take the total free ram in bytes
		$ramusage=$ramusage[1];
		//divide bytes into kb, mb, gb, put into 2 decimal place
		$ramusage = number_format(((($ramusage/1024)/1024)/1024),2);
		//get ram usage in gb, against max ram value, multiply by 100, 2 decimal place, now have free mem in %
		$ramusage = number_format(($ramusage/$maxram)*100,2);
		//take the free mem in % away from 100, to get the used ram in %
		$ramusage = 100-$ramusage;
		//return ramusage
		echo $ramusage;
?>