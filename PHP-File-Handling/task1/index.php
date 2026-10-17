<?php

$file = fopen("welcome.txt","w");
$text="welcome to PHP File Handking !";
fwrite($file,$text);
fclose($file);
echo"File 'welcome.txt' has been created and written successfully!";






?>