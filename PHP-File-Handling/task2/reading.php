<?php
$filename = "fruits.txt";

if (file_exists($filename)) {

    $fruits = file($filename);

    echo "<ul>";
   
    foreach ($fruits as $fruit) {
        echo "<li>" . htmlspecialchars($fruit) . "</li>";
    }
    echo "</ul>";
} else {
    echo "The file does not exist.";
}
?>