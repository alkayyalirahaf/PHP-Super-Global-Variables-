<?php

if(!isset($_COOKIE['visit_count'])){

$visits = 1;
echo " the first visit";
}
else{
    $visits =  $_COOKIE['visit_count']+1;

}

setcookie("visit_count",$visits);
echo " 'the'.$visits.'visits'    "



?>