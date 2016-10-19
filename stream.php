<?php
	echo("Start streaming ...");
	$cmd = "sudo /var/www/html/bash/stream_script.sh> /dev/null 2>&1 & echo $!;"; 
	$filename = "/var/www/html/bash/stream_script.sh";
	if (file_exists($filename)){
		/**echo "$filename is exist";**/
		$pid = exec($cmd, $output); 
	} else {
		echo "$filename does not exist!";
	}


/**	$command = "bash --init-file <(echo '/var/www/html/bash/stream_script.sh')";**/
/**	echo("<script language='javascript'> window.location.href('http://210.117.31.104:10002/?action=stream');</script>");
	header("Location: http://210.117.31.104:10002/?action=stream");
	die();**/
/**	echo shell_exec("/usr/bin/php -v");
	echo("<pre> $output </pre>");
<img src = "http://210.117.31.104:10002/?action=stream" />**/

?>

