<?php
	$cmd = "sudo /var/www/html/bash/stop_script.sh> /dev/null 2>&1 & echo $!;"; 
	$filename = "/var/www/html/bash/stop_script.sh";
	if (file_exists($filename)){
		/**echo "$filename is exist";**/
		$pid = exec($cmd, $output);
	} else {
		echo "$filename does not exist!";
	}
 	echo "Live stream stopped";
?>
