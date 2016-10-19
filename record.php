<?php
	$record_time = 5;
        $cmd1 = "sudo /var/www/html/bash/stop_script.sh> /dev/null 2>&1 & echo $!;";
        $cmd2 = "sudo /var/www/html/bash/record.sh> /dev/null 2>&1 & echo $!;";
        $cmd3 = "sudo /var/www/html/dewarp.sh> /dev/null 2>&1 & echo $!;";
        $filename = "/var/www/html/bash/record.sh";
        if (file_exists($filename)){
                /**echo "$filename is exist";**/
                exec($cmd1, $output1);
		exec($cmd2, $output2);
        } else {
                echo "$filename does not exist!";
        }

	sleep($record_time);
	echo "Recording is done!";
	/**exec($cmd3, $output3);**/
?>
