<?php
$line = $_GET['indice'].';'.$_GET['urlb'].';'.$_GET['isrer'];
print_r($line);
file_put_contents('../conf/lines.conf', $line . "\n", FILE_APPEND);
echo json_encode(array( "line"=>$line));
?>