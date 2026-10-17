<?php
$filename = "config.txt";
$newname = "config.bak";

if (file_exists($filename)) {
    if (rename($filename, $newname)) {
        echo "File successfully renamed to '$newname'.";
    } else {
        echo "Failed to rename the file.";
    }
} else {
    die("Error: The file '$filename' does not exist in the current directory!");
}
?>