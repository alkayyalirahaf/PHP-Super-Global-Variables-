<?php

$file = fopen("fruits.txt","w");
$text = "Apple\nBanana\nWatermelon\nBlueberry\nStrawberry";
fwrite($file,$text);
fclose($file);
echo "File 'fruits.txt' created and written successfully!";

?>